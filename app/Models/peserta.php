<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class peserta extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'alamat',
        'no_hp',


    ];
   protected $table = 'peserta';

   public function kas()
   {
       return $this->belongsTo(kas::class);
   }

    public function peserta()
    {
        return $this->belongsTo(tabungan::class);
    }
    public function arisan()
    {
        return $this->belongsTo(arisan::class);
    }

}
