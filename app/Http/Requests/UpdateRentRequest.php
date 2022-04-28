<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRentRequest extends FormRequest
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
            'from_date'     => 'required',
            'until_date'    => 'required',
            'description'   => 'required',
            'note'          => 'required'
        ];
    }
}
