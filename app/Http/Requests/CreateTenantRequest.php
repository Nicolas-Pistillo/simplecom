<?php

namespace App\Http\Requests;

use App\Models\Superadmin;
use Illuminate\Foundation\Http\FormRequest;

class CreateTenantRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user() instanceof Superadmin;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'tenant_name'    => ['required', 'string', 'unique:tenants,name', 'regex:/^\S*$/u'],
            'ecommerce_name' => ['required', 'string'],
            'sector_id'      => ['required', 'exists:sectors,id'],
            'plan_id'        => ['required', 'exists:plans,id'],
            'admin_name'     => ['required', 'string'],
            'admin_email'    => ['required', 'email'],
            'admin_password' => ['required', 'min:8', 'alpha_num']
        ];
    }
}
