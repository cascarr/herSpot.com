<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMembers extends FormRequest
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
            // Storing the rules for members data entry
            'name'      =>  'required|alpha|max:100',
            'address'   =>  'required|alpha|max:300',
            'age'       =>  'required|numeric|digits_between:1,2',
            'profile_img' => 'required|image|mimes:png,jpeg,gif|max:10000'
        ];
    }
}
