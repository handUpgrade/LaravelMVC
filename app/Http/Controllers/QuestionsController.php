<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Http\Requests\QuestionsRequest; # 질문 등록에 관한 규칙 정의.

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = \App\Question::with('user')->latest()->paginate(5); # Question 테이블 중간테이블(user관계설정됨) 엑세스해서 끝에서 5개씩 페이징
        $answers_num = [];
        foreach($questions as $question){
            $answers_num[$question->id] = $question->answers()->count();
        }
        // dd($answers_num);
        return view('question.index',compact(['questions','answers_num']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // 로그인 하지 않았을 경우 글을 추가 못하게 하기.
        
        if(!auth()->check()){
            return redirect('/login');
        }
        return view('question.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * 
     */
    public function store(QuestionsRequest $request)
    { # QuestionsRequest  유효성 검사
        //
       
       # 로그인 확인 
        if(!auth()->check()){
            return redirect('/login');
        }
        $question = auth()->user()->questions()->create($request->all());
        
        
        
        return redirect(route('questions.index'))->with('flash_message','작성한 글이 저장되었습니다.');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $question = \App\Question::findOrFail($id); # 있으면 찾고, 없으면 fail
        // $user_name = \App\Question::find(1)->user()->first()->user_id;
        $answers = \App\Question::findOrFail($id)->answers()->get();

        return view('question.show',compact(['question','answers']));   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // find() findId findUser_id 
        $question = \App\Question::find($id); // object (json 구조)
        return view('question.edit',compact('question')); 
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(QuestionsRequest $request, $id)
    {
        //
        // print($request);
        $question = \App\Question::find($id)->update(['title'=>$request->title,'content'=>$request->content]);
        return redirect()->route('questions.show',[$id])->with('flash_message','글이 수정되었습니다.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $qeustion = \App\Question::find($id)->delete();
        return redirect()->route('questions.index')->with('flash_message','글이 삭제되었습니다.');
    }
}
