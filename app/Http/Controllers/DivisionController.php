<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDivisionReqest;
use App\Http\Requests\UpdateDivisionRequest;
use App\Models\Division;
use App\Services\DivisionServices;
use Illuminate\Http\Request;

class DivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DivisionServices $division)
    {
        $divisions = $division->getAll();
        return view('division.index',[
            "divisions" => $divisions
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDivisionReqest $request, DivisionServices $divisionServices)
    {
        $divisionServices->saveData($request);
        return redirect('/divisions')->with('success', 'Success Save Data');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function edit(Division $division, DivisionServices $divisionServices)
    {
        return view('division.edit',[
            'division' => $division
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDivisionRequest $request, Division $division, DivisionServices $divisionServices)
    {
        $divisionServices->updateData($request,$division);
        return redirect('/divisions')->with('success', 'Success Update Data');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Division  $division
     * @return \Illuminate\Http\Response
     */
    public function destroy(Division $division, DivisionServices $divisionServices)
    {
        $divisionServices->deleteData($division);
        return redirect('/divisions')->with('success', 'Success Delete Data');
        
    }
}
