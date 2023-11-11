<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_tabungan extends Model
{
    use HasFactory;
    protected $fillable = ['tabungan_id', 'nominal', 'tanggal'];
    protected $table = 'detail_tabungan';
    public function tabungan()
    {
        return $this->belongsTo(Tabungan::class);
    }
}
