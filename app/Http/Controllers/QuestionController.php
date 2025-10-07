<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
		    'nama'  => 'required|max:10',
		    'email' => ['required','email'],
		    'pertanyaan' => 'required|max:300|min:8',
		],[
            'nama.required'=>'Nama tidak boleh kosong',
            'email.email'=>'Email tidak valid'
        ]);

        $data['nama'] = $request->nama;
        $data['email'] = $request->email;
        $data['pertanyaan'] = $request->pertanyaan;

        return redirect()->route('home')->with('info', 'Terimakasih atas pertanyaanya <b>'.$data['nama']. '</b>!
        Silahkan cek email ada di <b>'.$data['email'].'</b> untuk respon lebih lanjut');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
