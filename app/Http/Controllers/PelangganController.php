<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\PelangganFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PelangganController extends Controller
{
    public function index(Request $request)
    {
        $filterableColumns = ['gender'];
        $searchableColumns = ['first_name', 'last_name', 'email'];

        // Tambahkan with('files') agar loading gambar di tabel lebih cepat (Eager Loading)
        $data['dataPelanggan'] = Pelanggan::with('files')
            ->filter($request, $filterableColumns)
            ->search($request, $searchableColumns)
            ->paginate(10)->withQueryString();

        return view('admin.pelanggan.index', $data);
    }

    public function create()
    {
        return view('admin.pelanggan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'email'      => 'required|email|unique:pelanggan,email',
            'photos.*'   => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data['first_name'] = $request->first_name;
        $data['last_name']  = $request->last_name;
        $data['birthday']   = $request->birthday;
        $data['gender']     = $request->gender;
        $data['email']      = $request->email;
        $data['phone']      = $request->phone;

        // Simpan data pelanggan dan masukkan ke variabel $pelanggan
        $pelanggan = Pelanggan::create($data);

        // --- PERBAIKAN UTAMA DISINI ---
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('pelanggan_photos', 'public');

                // Gunakan RELASI agar ID otomatis terisi dengan benar.
                // Jangan pakai manual PelangganFile::create(['pelanggan_id' => ...])
                $pelanggan->files()->create([
                    'filename' => $photo->getClientOriginalName(),
                    'path'     => $path,
                ]);
            }
        }

        return redirect()->route('pelanggan.index')->with('success', 'Penambahan Data Berhasil!');
    }

    public function edit(string $id)
    {
        // Gunakan with('files') agar foto lama muncul di halaman edit
        $data['dataPelanggan'] = Pelanggan::with('files')->findOrFail($id);
        return view('admin.pelanggan.edit', $data);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'first_name' => 'required',
            'photos.*'   => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Perbaiki variabel agar konsisten
        $pelanggan = Pelanggan::findOrFail($id);

        $pelanggan->first_name = $request->first_name;
        $pelanggan->last_name  = $request->last_name;
        $pelanggan->birthday   = $request->birthday;
        $pelanggan->gender     = $request->gender;
        $pelanggan->email      = $request->email;
        $pelanggan->phone      = $request->phone;

        $pelanggan->save();

        // --- PERBAIKAN LOGIKA UPDATE FOTO ---
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('pelanggan_photos', 'public');

                // FIX: Gunakan variabel $pelanggan yang benar (sebelumnya Anda pakai $pelanggan padahal definisinya $dataPelanggan)
                // Pakai relasi create() agar aman
                $pelanggan->files()->create([
                    'filename' => $photo->getClientOriginalName(),
                    'path'     => $path,
                ]);
            }
        }

        return redirect()->route('pelanggan.index')->with('success', 'Data Berhasil Diupdate!');
    }

    // Method khusus hapus 1 foto di halaman Edit
    public function destroyFoto($id)
    {
        $file = PelangganFile::findOrFail($id);

        if (Storage::disk('public')->exists($file->path)) {
            Storage::disk('public')->delete($file->path);
        }

        $file->delete();

        return back()->with('success', 'Foto berhasil dihapus!');
    }

    public function destroy(string $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        // Hapus fisik file sebelum hapus data di DB
        foreach ($pelanggan->files as $file) {
            if (Storage::disk('public')->exists($file->path)) {
                Storage::disk('public')->delete($file->path);
            }
        }

        $pelanggan->delete();
        return redirect()->route('pelanggan.index')->with('success', 'Data berhasil dihapus');
    }
}
