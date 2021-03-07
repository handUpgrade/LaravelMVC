<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
class IntroduceContoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  
    public function index() # 현재 로그인 한 사람의 admin 값을 lv 에 담아서 전송
    {                             
        return view('introduce.index',['lv'=>isset(auth()->user()->admin) ? ((auth()->user()->admin == 1) ? 1 : 0 ) : 0 ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() # introduce/create.blade.php 로딩      ajax  
    {
        return view('introduce.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)  # 조원 저장 
    {   
        $validator = \Validator::make($request->all(), [ # 유효성 검사
            'name' => 'required|max:10',
            'intro' => 'required|max:30',
            'goal' => 'required|max:30',
        ]);

        if ($validator->fails())  # 유효성 검사에서 실패한 경우
        {
            return response()->json(['error'=>$validator->errors()->all()]); # json 형식으로 에러 전송
        }

        if ($request->hasFile('photo')) { # request 에 photo 가 있으면  
            $photo = $request->file('photo'); 
            $filename = Str::random(15).filter_var($photo->getClientOriginalName(),FILTER_SANITIZE_URL);
            // 중복방지를 위해 랜덤문자열 + filter_var(첫번째 인자값의 내용중 두번째인자 필터를 이용해서 필터링)
            // getClientOriginalName : 기존 파일이름,  FILTER_SANITIZE_URL : URL로 부적절한 이름 필터링
            $photo->move(attachements_path(),$filename);
            // 파일을 원하는 위치로 옮기는 구문  app/helper.php
        }

        $members = \App\Member::create([ # Member table  에 저장
            "name"=>$request->name,
            "intro"=>$request->intro,
            "goal"=>$request->goal,
            "photo"=>isset($filename) ? $filename : '이미지없음',
        ]);
   
        
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function show($id) # 사용 X  redirect 
    {
        return redirect()->route('introduce.index');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) # 수정을 위한 view 를 return
    {  
        $member = \App\Member::where('id',$id)->first();
       
        return view('introduce.edit', ['member' => $member]);
        
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) # 조원 소개 업데이트
    {
        $validator = \Validator::make($request->all(), [ # 유효성 검사
            'name' => 'required|max:10',
            'intro' => 'required|max:30',
            'goal' => 'required|max:30',
            'user_id' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) # 유효성 검사에서 실패한 경우
        {
            return response()->json(['error'=>$validator->errors()->all()]); # 에러정보 전송
        }
    
        $oldPhoto = \App\Member::where('id','=', $id)->first(); # 기존 이미지 이름을 가져옴
        if ($request->hasFile('photo')) {  # 요청에 이미지가 있으면 
            $photo = $request->file('photo');
            $filename = Str::random(15).filter_var($photo->getClientOriginalName(),FILTER_SANITIZE_URL);
            // 중복방지를 위해 랜덤문자열 + filter_var(첫번째 인자값의 내용중 두번째인자 필터를 이용해서 필터링)
            // getClientOriginalName : 기존 파일이름,  FILTER_SANITIZE_URL : URL로 부적절한 이름 필터링
            $photo->move(attachements_path(),$filename);
            // 파일을 원하는 위치로 옮기는 구문  

            if(file_exists(storage_path('../public/images/'.$oldPhoto->photo))){ # 기존 이미지 파일이 있으면
                unlink(storage_path('../public/images/'.$oldPhoto->photo)); // 기존파일 삭제
                //unlink : 파일삭제 storage_path: 주어진 파일의 절대경로 반환
            }
        }
        
        # ( 관리자만 수정할 수 있게 하기 )
        # request 로 온 유저 아이디가 관리자 아이디이면 
        $users = \App\User::where('user_id',$request->user_id)->where('admin',1)->first();

        if($users){ 
            if (!password_verify($request->password, $users->password)) {
                # 암호화 되지 않은 request 의 비밀번호와  암호화 된 users 의 비밀번호가 동일한지 검사 

                # 동일하지 않으면 
                return "passx";
            }
            $member = \App\Member::where('id',$id)->update([   # 멤버 id 를 받아서 업데이트 
                "name"=>$request->name, 
                "intro"=>$request->intro,
                "goal"=>$request->goal,
                "photo"=>isset($filename) ? $filename : $oldPhoto->photo,
            ]);
        }else{ # table 에서 검색 결과가 없을 경우
            return "idx";
        }
        
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(request $request ,$id) // 조원 소개 삭제
    {
        # request 로 넘어온 유저 정보가 관리자 이면
        $users = \App\User::where('user_id', $request->user_id)->where('admin',1)->first();
        if($users){
            if (!password_verify($request->password, $users->password)) {
                # 암호화 되지 않은 request 의 비밀번호와  암호화 된 users 의 비밀번호가 동일한지 검사 

                # 동일하지 않으면  
                return "passx";
            }

            $oldPhoto = \App\Member::where('id','=', $id)->first();  

            if ($oldPhoto->photo != '이미지없음') { # 기존 사진이 있는 경우
            unlink(storage_path('../public/images/'.$oldPhoto->photo)); # 파일 삭제
            }
            \App\Member::where('id', $id)->delete(); // 조원소개 삭제
            return response()->json([],204);   // 성공
        }
        else{ # 관리자가 아니면
            return "idx";
        }
        
        
       
    }
}