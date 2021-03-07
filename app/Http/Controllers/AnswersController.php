<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Http\Requests\AnswersRequest; # 질문 등록에 관한 규칙 정의.

class AnswersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request) # 질문에 해당하는 답변 로딩 ( ajax 요청받음)
    {
        
        $answers = \App\Question::find($request->question_id)->answers()->get(); # 배열
        
        # user 에서 user_id 를 받기에는 laravel 에서 기본키, 오토 인크리먼트 만을  외래키로 사용 가능. ajax 로 데이터를 주기 때문에 프론트 웨어에서 name 값을 뿌리는 것은 무리
        // $data = array_map('add_name',$answers);
        
        $data = return_user_name($answers);
        return $data;

        // 다른 항목도 존재.
        // [ 0 => Answer{array:7 [
        //     "id" => 2
        //     "question_id" => 1
        //     "user_id" => 2
        //     "content" => """
        //       adsfsdafadsfsadfasdfasdf
        //       sda
        //       f
        //       sd
        //       fsad
        //       afsd
        //       sdf
        //       fds
        //       """
        //     "created_at" => "2019-12-05 02:36:15"
        //     "updated_at" => "2019-12-05 02:36:29"
        //     "u_name" => "aaa"
        //   ]}]
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() # 사용하지 않음. -> index 로  redirect 
    {
        //
        return redirect()->route('questions.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AnswersRequest $request) # 
    {
    
        if (!auth()->check()){ #로그인 되어 있지 않을 경우
            return redirect()->route('questions.index');
        }

        $answer = auth()->user()->answers()->create($request->all()); # 답변 작성
        $answers = \App\Question::find($request->question_id)->answers()->get(); # 질문에 해당하는 모든 답변 가져오기 ( 배열 )

        $data = return_user_name($answers); #app\helper.php 에 선언한 함수로 데이터를 주면 기존 데이터에 u_name 이라는 키 값에 유저의 이름을 저장

        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) # 사용 X redirect
    {
        return redirect()->route('questions.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) # 사용 X  redirect   resource 안쓰고 web.php 에 하나 씩 선언해 줘도 상관 없음.
    {
        return redirect()->route('questions.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AnswersRequest $request, $id) # 답변 업데이트   ajax
    {
        $answerUpdata = \App\Answer::find($id)->update(['content'=>$request->content]);
        $answers = \App\Question::find($request->question_id)->answers()->get();
        $data = return_user_name($answers);
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)  # 답변 삭제      ajax
    {
        \App\Answer::find($id)->delete();
        $answers = \App\Question::find($request->question_id)->answers()->get(); 
        $data = return_user_name($answers);
        return $data;
    }
}
