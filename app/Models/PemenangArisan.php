<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PemenangArisan extends Model
{
    use HasFactory;

    protected $fillable = [
        'arisan_id',
        'peserta_id',
    ];


    public function arisan()
    {
        return $this->belongsTo(Arisan::class);
    }

    public function peserta()
    {
        return $this->belongsTo(Peserta::class);
    }
}
