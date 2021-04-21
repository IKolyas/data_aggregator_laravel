<?php

namespace App\Http\Requests;

use App\Enums\StatusNews;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property string slug
 * @property string title
 */
class CreateNews extends FormRequest
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
            'category_id' => 'required|numeric',
            'title' => 'required|string|min:3',
            'slug' => 'string',
            'image' => 'nullable|string',
            'description' => 'string|min:10',
            'status' => ['required', Rule::in(StatusNews::STATUSES)]
        ];
    }

    protected function prepareForValidation() :void
    {
        $this->merge([
            'slug' => ($this->slug) ?? \Str::slug($this->title, '-')
        ]);
    }
}
