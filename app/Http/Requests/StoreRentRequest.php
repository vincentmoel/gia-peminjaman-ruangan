<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'room_id'       => 'required',
            'division_id'   => 'required',
            'borrower_name' => 'required',
            'phone'         => 'required',
            'from_date'     => 'required|before:until_date',
            'until_date'    => 'required|after:from_date',
            'description'   => 'required'
        ];
    }
}
