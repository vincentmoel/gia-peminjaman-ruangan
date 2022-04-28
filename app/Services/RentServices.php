<?php

namespace App\Services;

use App\Http\Requests\StoreRentRequest;
use App\Http\Requests\UpdateRentRequest;
use App\Models\Rent;

class RentServices
{
    public function getAll()
    {
        return Rent::get();
    }

    public function saveData(StoreRentRequest $request)
    {
        $rent = Rent::create([
            'room_id'       => $request->room_id,
            'division_id'   => $request->division_id,
            'borrower_name' => $request->borrower_name,
            'phone'         => $request->phone,
            'from_date'     => $request->from_date,
            'until_date'    => $request->until_date,
            'description'   => $request->description,
            'note'          => $request->note
        ]);
        return $rent ? true : false;
    }

    public function deleteData(Rent $rent)
    {
        $rent->delete();
    }

    public function updateData(UpdateRentRequest $request, Rent $rent)
    {
        $rent = Rent::where('id', $rent->id)->update([
            'room_id'       => $request->room_id,
            'division_id'   => $request->division_id,
            'borrower_name' => $request->borrower_name,
            'phone'         => $request->phone,
            'from_date'     => $request->from_date,
            'until_date'    => $request->until_date,
            'description'   => $request->description,
            'note'          => $request->note
        ]);

        return $rent ? true : false;
    }
}
