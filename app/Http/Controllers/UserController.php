<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage; // PENTING: Tambahkan ini

class UserController extends Controller
{
    public function index()
    {
        $data['dataUser'] = User::paginate(10);
        return view('admin.user.index', $data);
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        // Validasi input (opsional tapi disarankan)
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validasi gambar
        ]);

        $data['name'] = $request->name;
        $data['email']  = $request->email;
        $data['password'] = Hash::make($request->password);

        // LOGIKA UPLOAD FOTO
        if ($request->hasFile('profile_photo')) {
            $path = $request->file('profile_photo')->store('profile_photos', 'public');
            $data['profile_photo'] = $path;
        }

        User::create($data);

        return redirect()->route('user.index')->with('success','Penambahan Data Berhasil!');
    }

    // ... method show ...

    public function edit(string $id)
    {
       $data['dataUser'] = User::findOrFail($id);
       return view('admin.user.edit', $data);
    }

    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $user->name = $request->name;
        $user->email = $request->email;

        // Update password hanya jika diisi
        if($request->filled('password')){
            $user->password = Hash::make($request->password);
        }

        // LOGIKA UPDATE FOTO
        if ($request->hasFile('profile_photo')) {
            // 1. Hapus foto lama jika ada
            if ($user->profile_photo && Storage::disk('public')->exists($user->profile_photo)) {
                Storage::disk('public')->delete($user->profile_photo);
            }

            // 2. Simpan foto baru
            $path = $request->file('profile_photo')->store('profile_photos', 'public');
            $user->profile_photo = $path;
        }

        $user->save();
        return redirect()->route('user.index')->with('success','Data Berhasil Diupdate!');
    }

    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        // Hapus foto dari storage saat user dihapus
        if ($user->profile_photo && Storage::disk('public')->exists($user->profile_photo)) {
            Storage::disk('public')->delete($user->profile_photo);
        }

        $user->delete();
        return redirect()->route('user.index')->with('success', 'Data berhasil dihapus');
    }
}
