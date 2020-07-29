<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InquiryRequest extends FormRequest
{
    public function getRedirectUrl()
    {
        return route('inquiry.form');

        // return parent::getRedirectUrl(); // TODO: Change the autogenerated stub
    }

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
            'type'  => [
                'required',
                'string',
                // TODO:in
            ],
            'name'  => [
                'required',
                'string',
                'max:50'
            ],
            'email' => [
                'required',
                'string',
                'email',
            ],
            'body'  => [
                'required',
                'string',
                'max:10000'
            ],
        ];
    }

    public function attributes()
    {
        return [
            'type' => '種別',
            'name' => '氏名',
            'email' => 'メールアドレス',
            'body' => '本文',
        ];

        // return parent::attributes(); // TODO: Change the autogenerated stub
    }
}
