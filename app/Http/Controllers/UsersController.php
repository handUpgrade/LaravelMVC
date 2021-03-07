<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\User;
use Illuminate\Support\Facades\Hash;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        # 사용 X
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        # 사용 X
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|max:255|unique:users',
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'phone' =>'required|max:255',
            'birth' =>'required|max:255',
            'password' => 'required|string|confirmed|min:6',
        ]);
        
        $validator->validate();
        
        if($validator->fails()){
            return response()->json([
                'status'=>'error',
            ], 200);
        }
        
        $user=new User; //User 모델로 객체생성
        $user->fill($request->all()); // User 모델을 request 객체의 키와 값으로 구성
        $user->password = Hash::make($request->password); // Hash 파사드로 password 해싱
        $user->save(); // 데이터베이스에 값 생성 
        
        flash('가입 완료');
        
        // return view('auth.login');
        return redirect('/login');
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
    }
}