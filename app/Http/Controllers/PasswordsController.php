<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class PasswordsController extends Controller
{
    public function __contruct(){
        $this->middleware('guest'); // 비회원
    }

    public function getRemind(){
        return view('auth.remind');
    }

    public function postRemind(Request $request){
        $this->validate($request, ['user_id'=> 'required|max:255]|exists:users'],);

        $user_id = $request->user_id;
        $token = Str::random(64);  // 버전 업 되면서 문법이 바뀜 str_random() => Str::random()

        \DB::table('password_resets')->insert([
            'user_id' => $user_id,
            'token' => $token,
            'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
        ]);
        
        return redirect('/reset'.'/'.$token);
    }

    //변경 파트
    public function getReset($token = null){
        return view('auth.reset', compact('token'));
    }

    public function postReset(Request $request){

        $validator = Validator::make($request->all(), [
            'user_id' => 'required|max:255',
            'password' => 'required|string|confirmed|min:6',
        ]);
        
        $validator->validate();
        
        $token = $request->token;
        
        if(! \DB::table('password_resets')->whereToken($token)-> first()){
            flash('url이 정확하지 않습니다');

            return back()->withInput();
        }

        \App\User::whereUser_id($request->input('user_id'))->first()->update([
            'password' => Hash::make($request->input('password'))
        ]);

        \DB::table('password_resets')->whereToken($token)->delete();

        flash('비밀번호 변경 완료');
        
        return redirect()->route('login.index');   
        // 비밀번호를 바꾸고 난 다음 보여지는 화면에서 
        // 바꾼 비밀번호로 다시 로그인을 하려고 하면 안됨.
    }
}
