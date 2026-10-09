<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    protected $table = 'tugas';
    protected $guarded = [];

    protected $casts = [
        'deadline' => 'date',
    ];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class);
    }

    /**
     * Format file size human-readable
     */
    public function getFormattedFileSizeAttribute(): string
    {
        $size = (int) $this->file_size;
        if ($size < 1024) return "{$size} B";
        if ($size < 1048576) return round($size / 1024, 1) . ' KB';
        return round($size / 1048576, 1) . ' MB';
    }
}
