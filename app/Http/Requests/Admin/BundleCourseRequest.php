<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BundleCourseRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'title'           => 'required',
            'organization_id' => 'required',
            'instructor_ids'  => 'required',
            'course_ids'      => 'required',
            'price'           => 'required_without:is_free',
            'meta_image'      => 'nullable|integer',
        ];

        return $rules;
    }
}
