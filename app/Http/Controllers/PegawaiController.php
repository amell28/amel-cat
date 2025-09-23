<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $name = "Siti Amelia Larasati";

        // Hitung umur dari tanggal lahir (contoh: 15 Mei 1995)
        $tanggal_lahir = new \DateTime('2006-06-28');
        $today = new \DateTime();
        $umur = $today->diff($tanggal_lahir)->y;

        // Data hobi (minimal 5 item)
        $hobbies = [
            'Membaca',
            'Bermain Musik',
            'Olahraga',
            'Programming',
            'Traveling',
            'Fotografi'
        ];

        // Tanggal harus wisuda (contoh: 30 Juni 2024)
        $tgl_harus_wisuda = new \DateTime('2028-10-30');

        // Jarak hari dari tgl_harus_wisuda dengan hari ini
        $jarak_hari = $today->diff($tgl_harus_wisuda)->days;

        // Semester saat ini
        $current_semester = 4;

        // Informasi berdasarkan semester
        $info_semester = '';
        if ($current_semester < 3) {
            $info_semester = "Masih Awal, Kejar TAK";
        } else {
            $info_semester = "Jangan main-main, kurang-kurangi main game!";
        }

        // Cita-cita
        $future_goal = "Menjadi Software Engineer Professional";

        // Data yang akan dipassing ke view
        $data = [
            'name' => $name,
            'my_age' => $umur,
            'hobbies' => $hobbies,
            'tgl_harus_wisuda' => $tgl_harus_wisuda->format('d F Y'),
            'time_to_study_left' => $jarak_hari,
            'current_semester' => $current_semester,
            'semester_info' => $info_semester,
            'future_goal' => $future_goal
        ];

        // Return view dengan data
        return view('pegawai', $data);
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
        //
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
