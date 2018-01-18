<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResumeUploadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user() ?: false;
    }

    /**
     * Must be a valid file with .pdf, .doc, or .docx extension
     * and can not be bigger than 1.5 mb
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'resume' => 'file|mimes:pdf,doc,docx|max:1500'
        ];
    }
}
