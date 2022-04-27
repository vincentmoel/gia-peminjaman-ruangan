<?php 

namespace App\Services;

use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentServices{


    public function getAll()
    {
        return Department::get();
    }

    public function saveData(StoreDepartmentRequest $request)
    {
        $department = Department::create([
            "name"  => $request->name
        ]);
        return $department ? true : false;
    }

    public function deleteData(Department $department)
    {
        $department->delete();
    }

    public function updateData(UpdateDepartmentRequest $request, Department $department)
    {
        $department = Department::where('id',$department->id)->update([
            'name' => $request->name
        ]);

        return $department ? true : false;

    }


}

