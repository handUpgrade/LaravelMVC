<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class ProfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        // 동일한 Controller의 show로 리다이렉트 해줌. 들어가자 마자 로그인한 아이디로 show 실행
        return redirect("/profile"."/".auth()->user()->user_id);  
    }


    public function show($id)
    {
        // if(!auth()->check()){
        //     return redirect('/login');
        // }
        if($id != auth()->user()->user_id){ // 위에서 받아온 $id 와 로그인한 user_id가 같은지 확인
            return redirect("/profile"."/".auth()->user()->user_id); // 틀릴경우 show 다시 재 리다이렉트
            # 나누기 연산으로 착각함.. 0 / a  로  인식해서 오류 발생. 따라서 /profile  /  따로 
        }

        $user_info = \App\User::where('user_id',$id)->first(); // 유저 테이블에서 로그인한 user_id와 동일한 로우를 가져옴 json 객체
        $user_questions = \App\Question::where('user_id',auth()->user()->id)->latest()->paginate(5); // Question테이블에서 user_id가 로그인한 회원은 id와 동일한 로우를 내림차순으로 페이징(5개씩) 
        $user_q_a_num = []; // 배열생성
        foreach($user_questions as $question){ //배열의 각각 요소에 {}안 적용 value : $question
            $user_q_a_num[$question->id] = $question->answers()->count(); //$user_q_a_num 배열에 key를 $question, value 는 이 $question을 부모로 둔 답변의 개수로 지정
        }        

        if($user_info->admin == 1){ // 로그인한 유저의 admin 값이 1 (로그인일 경우)
            $users = \App\User::get(); //User 테이블 데이터 전부가져옴
            return view("profile.index",compact('user_info','user_questions','user_q_a_num','users')); // profile 폴더의 index 블레이드 반환 ( 로그인한 유저 정보, 유저가 한 질문 리스트, 질문에 달린 답변 수, 모든 회원정보 )
        }else{
            return view("profile.index",compact('user_info','user_questions','user_q_a_num')); // profile 폴더의 index 블레이드 반환 ( 로그인한 유저 정보, 유저가 한 질문 리스트, 질문에 달린 답변 수 )
        }
        
        
    }

    # 정보 변경 ( 비밀번호 미포함 )
    public function edit_info($id) //$id -> 로그인한 회원의 아이디
    {
        
        $info = \App\User::where('user_id',$id)->first(); // 로그인한 회원의 회원 정보를 가져옴
        return view('profile.edit_info',compact('info'));

    }
    public function update_info(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [ // 유효성 검사기 생성
            'name' => 'required|max:255|min:2',
            'email' => 'required|max:255',
            'phone' =>'required|max:255',
            'birth' =>'required|max:255',      
        ]);
        
        $validator->validate(); // 검사실행
        
        if($validator->fails()){
            return response()->json([
                'status'=>'error',
            ], 200);
        }

        # $request->all() 써도 됨.
        $user = \App\User::find(auth()->user()->id)->update([ // 받아온 $request값으로 회원 정보 수정
            'name' => $request->name,
            'email'=> $request->email,
            'phone'=> $request->phone,
            'birth'=> $request->birth,
        ]);
        
        return redirect('/profile'); // 프로필 설정으로 리다이렉트

    }

    public function edit_pwd($id)
    {
        //
        return view('profile.edit_pwd');
    }
    public function update_pwd(Request $request, $id) # 유저 패스워드 변경
    {
        $validator = Validator::make($request->all(), [ // 유효성 검사기 생성
            'password' => 'required|confirmed|min:6',
        ]);
        $validator->validate(); // 유효성 검사 실행
        
        if($validator->fails()){
            return response()->json([
                'status'=>'error',
            ], 200);
        }
        $password = Hash::make($request->password); // 입력받은 비밀번호 해싱(암호화)

        $user = \App\User::find(auth()->user()->id)->update([ // 지금 로그인한 회원 정보 수정
            'password' => $password,
        ]);
        return redirect('/profile'); // 프로필 설정으로 리다이렉트
    }


    public function destroy($id) # 관리자가 유저 아이디 삭제 $id = 삭제할 유저 id
    {
        if(auth()->user()->id == $id){ // 지금 로그인한 회원의 id와 삭제할 유저 id가 동일하다면
            $message['message'] = "자신의 계정을 삭제할 수 없습니다.";
            return $message;
        }
        if(auth()->user()->admin ==0 ){ // 지금 로그인한 회원의 admin이 0일경우 (관리자가 아닐경우)
            return redirect('/'); // 홈으로 리다이렉트
        }
        \App\User::where('id',$id)->delete(); // 입력받은 id와 동일한 id를 가지고 있는 유저 정보 삭제
        $users = \App\User::get(); // 유저정보 전부 받아옴
        return $users; // 리턴
    }
    public function put_admin($id) # 관리자가 유저에게 관리자 권한 부여
    {   
        if(auth()->user()->id == $id){  // 지금 로그인한 회원의 id와 삭제할 유저 id가 동일하다면
            $message['message'] = "자신의 권한은 관리할 수 없습니다.";
            return $message;
        }

        if(auth()->user()->admin ==0 ){ // 지금 로그인한 회원의 admin이 0일경우 (관리자가 아닐경우)
            return redirect('/');
        }
        if(\App\User::where('id',$id)->first()->admin){ // 입력받은 id와 동일한 id를 가지고 있는 유저 정보 중 admin 값 (null or 1(관리자)) [선택당한 유저가 관리자일 경우]
            \App\User::where('id',$id)->update(['admin'=>0]); // admin 값을 0으로 일반회원으로
        }else{            
            \App\User::where('id',$id)->update(['admin'=>1]); // admin 값을 1으로 관리자로
        }
        $users = \App\User::get(); // 유저정보 전부 받아옴
        return $users; // 리턴
        
    }
}

