<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class ActivityLog extends Model
{
    protected $fillable = ['user_id', 'aksi', 'route', 'detail', 'ip_address'];

    protected $casts = [
        'detail' => 'array', // otomatis encode/decode JSON, ga perlu json_encode manual lagi
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Guard: tabel ini read-only, ga boleh dihapus siapapun lewat Eloquent.
     */
    protected static function booted(): void
    {
        static::deleting(function () {
            return false;
        });
    }
}