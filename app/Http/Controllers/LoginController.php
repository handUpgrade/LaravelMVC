<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\User;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function __construct(){
    //     $this->middleware('guest', [
    //         'except' => 'destroy'
    //     ]);
    // }

    public function index() # 로그인 화면 
    {
        return view('auth.auth');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() # 로그인 화면 
    {
        // X
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)# 로그인
    {
        $validator = Validator::make($request->all(), [ # 유효성 검사
            'user_id' => 'required|max:255',
            'password' => 'required|min:6', 
        ]);
        $validator->validate(); #실패했을 경우 redirect + 에러정보 
        
        if(! auth()->attempt($request->only('user_id', 'password'))){ # 로그인에 실패한 경우
            flash('Password was not matched'); #플레쉬 메시지
            return back()->withInput(); # input 입력 값을 가지고 이전 화면으로 감
        }

        flash(auth()->user()->user_id.'님 환영합니다');
        return redirect()->intended('/'); 

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
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        // auth()->logout();
        // Auth::logout();
        // flash('로그아웃');
        // return redirect('/questions');
        print("ddd");

    }
    public function logout(Request $request)
    {
        auth()->logout();

        return redirect('/');
    }
}