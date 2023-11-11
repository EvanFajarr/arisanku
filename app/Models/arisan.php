<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class arisan extends Model
{
    use HasFactory;
    protected $fillable = ['tanggal_pelaksanaan', 'keterangan', 'tempat_pelaksanaan','nominal'];
    protected $table = 'arisan';
    public function detail()
    {
        return $this->belongsTo(detail::class);
    }

    public function acakPemenang()
    {
        $peserta = $this->peserta()->inRandomOrder()->first();
        return $peserta;
    }

    public function peserta()
{
    return $this->belongsTo(peserta::class, 'tempat_pelaksanaan');
}

}
