<?php

namespace App\Services;

use App\Http\Requests\StoreDivisionReqest;
use App\Http\Requests\UpdateDivisionRequest;
use App\Models\Division;
use App\Models\Divison;

class DivisionServices{


    public function getAll()
    {
        return Division::get();
    }

    public function saveData(StoreDivisionReqest $request)
    {
        $division = Division::create([
            "name"  => $request->name
        ]);
        return $division ? true : false;
    }

    public function deleteData(Division $division)
    {
        $division->delete();
    }

    public function updateData(UpdateDivisionRequest $request, Division $division)
    {
        $division = Division::where('id',$division->id)->update([
            'name' => $request->name
        ]);

        return $division ? true : false;

    }


}