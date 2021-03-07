<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnswersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; # 사용자가 이 폼 리퀘스트를 주입받는 메서드에 접근할 권한이 있는지 검사하여 서비스를 보호.
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'content' =>['required','min:1'],
        ];
    }
    public function messages()
    {
        return [
            'required'=>':attribute은(는) 필수 입력 사항입니다.',
            'min' =>':attribute은(는) 최소 :min 글자 이상이 필요합니다.',
        ];
    }
    public function attributes()
    {
        return[
            'content'=> '답변',
        ];
    }
}
