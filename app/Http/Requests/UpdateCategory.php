<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed is_visible
 */
class UpdateCategory extends FormRequest
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
            'title' => ['required', 'string', 'min:3'],
            'is_visible' => ['sometimes']
        ];
    }

    protected function prepareForValidation() :void
    {
        $this->merge([
            'is_visible' => ($this->is_visible) ?? false,
        ]);
    }

}
