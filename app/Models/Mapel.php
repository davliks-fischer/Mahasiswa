<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    protected $table = 'mapel';
    protected $guarded = [];

    public function dosen() {
        return $this->belongsTo(Dosen::class);
    }
    public function fakultas() {
        return $this->belongsTo(Fakultas::class);
    }
}