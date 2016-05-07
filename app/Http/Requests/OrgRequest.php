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
            'name' => 'required',
            'website' => 'required',
            'short_desc' => 'required|max:160',
            'logo' => 'required|image',
            'technology_list' => 'required',
            'industry_list' => 'required',
            'domain_list' => 'required'
        ];
    }
}
