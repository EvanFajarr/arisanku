<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tabungan extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','nominal'];
    protected $table = 'tabungan';
    public function detailTabungan()
    {
        return $this->hasMany(detail_tabungan::class);
    }
    public function tabungan()
    {
        return $this->belongsTo(peserta::class, 'user_id');
    }
}
