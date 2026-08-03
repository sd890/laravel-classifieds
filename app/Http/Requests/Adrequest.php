<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Adrequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // مجوز استفاده (فعلاً همه میتونن)
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules=[
             'title'=>['required','min:5'],
            'short_description'=>['required','min:10'],
            'description'=>['required','min:32'],

            
        ];
                // اگر در حالت ایجاد هستیم (POST)، تصویر اجباری باشه

        if($this->isMethod('post'))
            {
                $rules['image']=['nullable','image','mimes:jpeg,png,jpg,gif','max:2048'];

            }

            if($this->isMethod('put') || $this->isMethod('patch'))
            {
                 $rules['image']=['nullable','image','mimes:jpeg,png,jpg,gif','max:2048'];
            }

            return $rules;

    }
}
