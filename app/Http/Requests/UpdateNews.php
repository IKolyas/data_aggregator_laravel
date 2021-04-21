<?php

namespace App\Http\Requests;

use App\Enums\StatusNews;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property string slug
 * @property string title
 */
class UpdateNews extends FormRequest
{
    /**
     * @var mixed
     */

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
            'title' => 'string|min:3',
            'slug' => 'string',
            'category_id' => 'numeric',
            'description' => 'string|min:10',
            'image' => 'nullable|string',
            'status' => Rule::in(StatusNews::STATUSES)
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => ($this->slug) ?? \Str::slug($this->title, '-')
        ]);
    }
}
