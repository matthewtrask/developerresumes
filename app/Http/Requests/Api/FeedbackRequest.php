<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class FeedbackRequest extends FormRequest
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

    public function getFeedback()
    {
        return $this->get('feedback');
    }

    public function getResumeId()
    {
        return $this->get('resumeId');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'resumeId' => 'required|int',
            'feedback' => 'required|string',
        ];
    }
}
