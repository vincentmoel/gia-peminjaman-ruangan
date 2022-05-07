<?php

namespace App\Services;

use App\Http\Requests\StoreRentRequest;
use App\Http\Requests\UpdateRentRequest;
use App\Models\Rent;
use Illuminate\Support\Str;

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
            'from_date'     => date('Y-m-d H:i:s', strtotime($request->from_date)),
            'until_date'    => date('Y-m-d H:i:s', strtotime($request->until_date)),
            'description'   => $request->description,
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
            'from_date'     => date('Y-m-d H:i:s', strtotime($request->from_date)),
            'until_date'    => date('Y-m-d H:i:s', strtotime($request->until_date)),
            'description'   => $request->description,
        ]);

        return $rent ? true : false;
    }

    public function isAvailable($from_date, $until_date, $room_id, $except_id = 0)
    {
        $from_date = date('Y-m-d H:i:s', strtotime($from_date));
        $until_date = date('Y-m-d H:i:s', strtotime($until_date));

        $rent = Rent::where(function ($query) use ($from_date, $until_date) {

            $query->orWhereBetween('from_date', [$from_date, $until_date])
                ->orWhereBetween('until_date', [$from_date, $until_date])
                ->orWhere(function ($query) use ($from_date, $until_date) {
                    $query->where('from_date', '<=', $from_date)
                        ->where('until_date', '>=', $until_date);
                });
        })
            ->where('room_id', $room_id)
            ->where('id','!=',$except_id)
            ->get();

        // dd($from_date, $until_date, Str::replaceArray('?', $rent->getBindings(), $rent->toSql()));
        return $rent->count() == 0 ? 'available' : $rent;
    }

    public function getActiveSchedule()
    {
        $rents = Rent::where('until_date', '>', date('Y-m-d H:i:s'))->orderBy('from_date', 'asc')->get();
        // dd(Str::replaceArray('?', $rents->getBindings(), $rents->toSql()));
        return $rents;
    }
}
