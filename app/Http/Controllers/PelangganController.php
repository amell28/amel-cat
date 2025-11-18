<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
		$data['dataPelanggan'] = Pelanggan::paginate(10);
		return view('admin.pelanggan.index',$data);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
	return view('admin.pelanggan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());

        $data['first_name'] = $request->first_name;
        $data['last_name']  = $request->last_name;
        $data['birthday']   = $request->birthday;
        $data['gender']     = $request->gender;
        $data['email']      = $request->email;
        $data['phone']      = $request->phone;

        Pelanggan::create($data);

        return redirect()->route('pelanggan.index')->with('success','Penambahan Data Berhasil!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['dataPelanggan'] = Pelanggan::findOrFail($id);
        return view('admin.pelanggan.edit', $data);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pelanggan_id = $id;
        $dataPelanggan = Pelanggan::findOrFail($pelanggan_id);

        $dataPelanggan->first_name = $request->first_name;
        $dataPelanggan->last_name = $request->last_name;
        $dataPelanggan->birthday = $request->birthday;
        $dataPelanggan->gender = $request->gender;
        $dataPelanggan->email = $request->email;
        $dataPelanggan->phone = $request->phone;

        $dataPelanggan->save();
        return redirect()->route('pelanggan.index')->with('success','Data Berhasil Diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        $pelanggan->delete();
        return redirect()->route('pelanggan.index')->with('success', 'Data berhasil dihapus');
    }
}
