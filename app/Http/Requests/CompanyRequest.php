<?php

namespace App\Http\Requests;

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'name'    => ['required', 'string', 'max:255'],
            'website' => ['required', 'string'],
            'email'   => ['required', 'email', Rule::unique((new Company())->getTable())->ignore($this->route()->company->id ?? null)],
            'logo'    => ['nullable'],
        ];
    }
}
