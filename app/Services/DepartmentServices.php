<?php 

namespace App\Services;

use App\Models\Department;

class DepartmentServices{


    public function getAll()
    {
        return Department::get();
    }


}

