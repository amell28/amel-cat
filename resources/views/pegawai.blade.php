<!DOCTYPE html>
<html>
<head>
    <title>Data Pegawai - Siti Amelia Larasati</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .card {
            border: 1px solid #e0e0e0;
            padding: 20px;
            margin: 15px 0;
            border-radius: 8px;
            background: #fff;
        }
        .info {
            background-color: #e3f2fd;
            padding: 15px;
            border-left: 4px solid #2196f3;
            border-radius: 4px;
        }
        .warning {
            background-color: #fff3e0;
            padding: 15px;
            border-left: 4px solid #ff9800;
            border-radius: 4px;
        }
        h1 { color: #333; text-align: center; }
        h2 { color: #444; border-bottom: 2px solid #eee; padding-bottom: 10px; }
        ul { list-style-type: none; padding: 0; }
        li { padding: 5px 0; border-bottom: 1px dotted #eee; }
        .highlight { color: #e91e63; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <h1>📊 Data Pegawai</h1>

        <div class="card">
            <h2>👤 Informasi Pribadi</h2>
            <p><strong>Nama:</strong> <span class="highlight">{{ $name }}</span></p>
            <p><strong>Umur:</strong> {{ $my_age }} tahun</p>
            <p><strong>Cita-cita:</strong> {{ $future_goal }}</p>
        </div>

        <div class="card">
            <h2>🎯 Hobi</h2>
            <ul>
                @foreach($hobbies as $index => $hobby)
                    <li>{{ $index + 1 }}. {{ $hobby }}</li>
                @endforeach
            </ul>
        </div>

        <div class="card">
            <h2>🎓 Informasi Akademik</h2>
            <p><strong>Tanggal Harus Wisuda:</strong> {{ $tgl_harus_wisuda }}</p>
            <p><strong>Jumlah Hari Menuju Wisuda:</strong>
                <span class="highlight">{{ abs($time_to_study_left) }} hari</span>
                @if($time_to_study_left < 0)
                    (Sudah lewat {{ abs($time_to_study_left) }} hari)
                @else
                    (Masih tersisa {{ $time_to_study_left }} hari)
                @endif
            </p>
            <p><strong>Semester Saat Ini:</strong> {{ $current_semester }}</p>
            <div class="warning">
                <strong>💡 Informasi:</strong> {{ $semester_info }}
            </div>
        </div>
    </div>
</body>
</html>
