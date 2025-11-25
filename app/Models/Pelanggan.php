<?php
namespace App\Models;

use App\Models\PelangganFile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Pelanggan extends Model
{
    protected $table      = 'pelanggan';
    protected $primaryKey = 'pelanggan_id';
    protected $fillable   = [
        'first_name',
        'last_name',
        'birthday',
        'gender',
        'email',
        'phone',
    ];

    public function scopeFilter(Builder $query, $request, array $filterableColumns): Builder
    {
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                $query->where($column, $request->input($column));
            }
        }
        return $query;
    }

    public function scopeSearch($query, $request, array $columns)
    {
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request, $columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', '%' . $request->search . '%');
                }
            });
        }
    }

    // Tambahkan ini di dalam class Pelanggan
    public function files()
    {
        // 'pelanggan_id' adalah foreign key di tabel pelanggan_files
        // 'pelanggan_id' (kedua) adalah primary key di tabel pelanggan
        return $this->hasMany(PelangganFile::class, 'pelanggan_id', 'pelanggan_id');
    }
}
