<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Core\Domain\Entity;

class CompanyRequest extends FormRequest
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
            'document' => 'required',
            'uf' => 'required|unique:companies,document'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'the company name field cannot be empty',
            'document.required' => 'the cnpj field cannot be empty',
            'document.unique' => 'cnpj is already created',
            'uf.required' => 'the uf field cannot be empty',
        ];
        
    }
}
