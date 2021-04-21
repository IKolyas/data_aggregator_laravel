<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property boolean is_admin
 */
class UpdateUser extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
                'name' => 'required|string|min:3',
                'email' => 'required|email:rfc,dns',
                'is_admin' => 'sometimes',
        ];
    }

    protected function prepareForValidation() :void
    {
        $this->merge([
            'is_admin' => ($this->is_admin) ?? false,
        ]);
    }
}
