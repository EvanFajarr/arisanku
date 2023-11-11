<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kas extends Model
{
    use HasFactory;
    protected $fillable = ['peserta_id', 'tanggal_pembayaran', 'jumlah_pembayaran', 'status_pembayaran'];
    protected $table = 'kas';
    public function peserta()
    {
        return $this->belongsTo(peserta::class);
    }
}
