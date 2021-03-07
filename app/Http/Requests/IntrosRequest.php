<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class IntrosRequest extends FormRequest
{
    protected $dontFlash=['photo'];
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
    public function rules() // 유효성 검사 규칙 함수
    {
        return [  
            'title' => ['required'], // required : 값이 비는 규칙
            'append' => ['required'],
            'place' => ['required'],
            'master' => ['required'],
            'weekset' => ['required'],
            'starttime' => ['required'],
            'endtime' => ['required'],
            'photo' => ['mimes:jpeg,jpg,png,gif'], // mimes: 파일형식을 검사
        ]; 
    }
    
    public function message()
    {
        return [
            'required' => ':attribute은(는) 필수 입력 항목입니다.',
            'mimes' => ':attribute은 :min 확장자만 지원합니다.'
        ];
    }
    
    public function attribute(){
        return [
            'title' => '제목',
            'append' => '세부사항',
            'place' => '장소',
            'master' => '담당자',
            'weekset' => '요일',
            'starttime' => '시작시간',
            'endtime' => '종료시간',
            'photo' => '사진',
        ];
    }
}