<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTemplateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'title'=>'required',
            'kfline'=>'required',
            'appload'=>'required',
            'gamedesc'=>'required',
            'hdesc'=>'required',
        ];
    }

    //信息
    public function messages()
    {
        return [
            'title.required'=>'标题必须填写! ',
            'kfline.required'=>'客服连接地址必须填写! ',
            'appload.required'=>'app连接地址必须填写! ',
            'gamedesc.required'=>'规则必须填写! ',
            'hdesc.required'=>'活动必须填写! ',
        ];
    }
}
