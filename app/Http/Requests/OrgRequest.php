<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class OrgRequest extends Request
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
            //'name' => 'required',
            //'short_desc' => 'required',
            //'logo' => 'required|image',
            //'website' => 'required',
            //'technology_list' => 'required',
            //'industry_list' => 'required',
            //'domain_list' => 'required'
        ];
    }
}
