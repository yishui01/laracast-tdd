<?php

namespace App\Http\Requests;

class ThreadRequest extends HttpRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
           'title'=>'required',
           'body'=>'required'
        ];
    }

    public function messages()
    {
        return [
            'body.required'=>'文章内容 不能为空啊'
        ];
    }
}
