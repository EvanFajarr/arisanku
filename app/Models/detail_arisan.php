<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class detail_arisan extends Model
{
    use HasFactory;
    protected $fillable = ['arisan_id', 'nominal', 'peserta_id'];
    protected $table = 'detail_arisan';
    public function Arisan()
    {
        return $this->belongsTo(arisan::class);
    }
    public function peserta()
    {
        return $this->belongsTo(peserta::class);
    }
}
