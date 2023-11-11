<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\detail_arisan;

class UniquePesertaInArisan implements Rule
{
    private $arisan_id;

    public function __construct($arisan_id)
    {
        $this->arisan_id = $arisan_id;
    }

    public function passes($attribute, $value)
    {
        $count = detail_arisan::where('arisan_id', $this->arisan_id)
                            ->where('peserta_id', $value)
                            ->count();

        return $count === 0;
    }

    public function message()
    {
        return 'Peserta sudah terdaftar dalam arisan ini.';
    }
}
