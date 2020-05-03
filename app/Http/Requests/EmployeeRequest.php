<?php

namespace App\Http\Requests;

use App\Models\Company;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmployeeRequest extends FormRequest
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
            'first_name'    => ['required', 'string', 'max:255'],
            'last_name'    => ['required', 'string', 'max:255'],
            'phone'    => ['required', 'string','min:9','max:11'],
            'company_id'    => ['required', 'numeric'],
            'email'   => ['required', 'email', Rule::unique((new Employee())->getTable())->ignore($this->route()->employee->id ?? null)],
        ];
    }
}
