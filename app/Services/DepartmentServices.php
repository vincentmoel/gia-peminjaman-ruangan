<?php 

namespace App\Services;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentServices{


    public function getAll()
    {
        return Department::get();
    }

    public function saveData(Request $request)
    {
        $department = Department::create([
            "name"  => $request->name
        ]);
        return $department ? true : false;
    }


}

