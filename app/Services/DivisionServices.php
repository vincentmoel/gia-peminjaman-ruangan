<?php

namespace App\Services;

use App\Models\Division;

class DivisionServices{


    public function getAll()
    {
        return Division::get();
    }


}