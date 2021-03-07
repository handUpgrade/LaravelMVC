<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use \App\Http\Requests\IntrosRequest;
use \App\Intro;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
class IntrosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        # 로그인 되어 있는 지 확인 -> 
        #되어있으면 :
                    #어드민인지 확인 : 어드민이면 1  아니면 0  
        #되어 있지 않으면: 0
        return view('intro.index',['lv'=>(isset(auth()->user()->admin) ? ((auth()->user()->admin == 1) ? 1 : 0) : 0)]);  
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() # 관리자인 것인지 확인
    {
        return view('intro.create',['lv'=>(isset(auth()->user()->admin) ? ((auth()->user()->admin == 1) ? 1 : 0) : 0)]);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) # 현지 학기제 일정 저장
    {
        $validator = \Validator::make($request->all(), [ # 유효성 검사기 생성
            'title' => 'required',
            'place' => 'required',
            'master' => 'required',
            'weekset' => 'required',
            'starttime' => 'required',
            'endtime' => 'required',
            'append' => 'required',
        ]);
        if ($validator->fails()) # 유효성 검사에 실패한 경우
        {
            return response()->json(['error'=>$validator->errors()->all()]); # error 에 에러 사항 저장해서 전송
        }
        # app/helper.php 에 있는 함수들  
        $weekset = week_check($request); # 시작 시간, 끝 시간 이 올바른지 체크, 기존의 시간표와 같은 것인지 체크 맞으면 true 틀리면 false 반환 -> helper.php
        if($weekset['status']){  # 정상적인 시간표이면
            if ($request->hasFile('photo')) { # 사진이 있으면
                $photo = $request->file('photo'); 
                $filename = Str::random(15).filter_var($photo->getClientOriginalName(),FILTER_SANITIZE_URL);
                // 중복방지를 위해 랜덤문자열15자 + filter_var(첫번째 인자값의 내용중 두번째인자 필터를 이용해서 필터링)
                // getClientOriginalName : 기존 파일이름,  FILTER_SANITIZE_URL : URL로 부적절한 이름 필터링
                $photo->move(attachements_path(),$filename);
                // 파일을 원하는 위치로 옮기는 구문(경로, 파일이름)
            }
            # 현지학기제 정보 생성
            $intro = Intro::create([
                'title' => $request->title,
                'append' => $request->append,
                'place' => $request->place,
                'master' => $request->master,
                'weekset' => $weekset['message'],
                'starttime' => $request->starttime,
                'endtime' => $request->endtime,
                'photo' => isset($filename) ? $filename : '', // 파일이 있을경우 파일이름을 없을 경우 공백
            ]);
            return response()->json([
                'message'=>'등록되었습니다.',
                'status'=>true
            ],201);
        } # 정상적인 시간표가 아니면
        return response()->json(['message'=>$weekset['message'],'status'=>$weekset['status']],201); 
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) #  보여주기
    {
        $intro = Intro::where('id','=', $id)->first(); 
        $weeknd = [ '월', '화', '수', '목', '금', '토', '일' ];
        for($i = 0; $i < 7; $i++){
            # 요일이 DB 에는 숫자로 들어가 있음. -> 문자로 바꿔주기 154=> 월 금 목
            # 문자열 치환   바뀔 문자, 바꿀 문자, 대상이 되는 문자열   
            $intro->weekset = str_replace(($i+1),$weeknd[$i],$intro->weekset);
        }
        # 현지학기 정보와 유저가 관리자 인지 반환
        return view('intro.show',['intro'=>$intro,'lv'=>(isset(auth()->user()->admin) ? ((auth()->user()->admin == 1) ? 1 : 0) : 0)]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */ 
    public function edit($id) # 수정 뷰 제공
    {
        $intro = Intro::where('id', $id)->first(); # 아이디에 해당하는 항목 정보 가져옴
        # 뷰와, 현지학기 정보, 관리지 여부  전송
        return view('intro.edit',['intro'=>$intro,'lv'=>(isset(auth()->user()->admin) ? ((auth()->user()->admin == 1) ? 1 : 0) : 0)]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(IntrosRequest $request, $id) # 업데이트
    {
        $weekset = week_check($request,$id);     # 올바른 요일인지 체크 ->helper.php week_check($request 객체, $id = 수정할 시간표 id값)
        if($weekset['status']){                  # 올바른 요일일 경우
            $oldPhoto = Intro::where('id','=', $id)->first(); # 수정할 시간표 데이터
            if ($request->hasFile('photo')) { # 사진이 있을경우 위와 동일
                $photo = $request->file('photo');
                # 랜덤 문자열
                $filename = Str::random(15).filter_var($photo->getClientOriginalName(),FILTER_SANITIZE_URL);
                $photo->move(attachements_path(),$filename);# 파일 저장
                if($oldPhoto->$photo === '' || file_exists(storage_path('../public/images/'.$oldPhoto->photo))){ // photo 값이 공백이 아니거나 데이터에 맞는 사진이 있을경우
                    unlink(storage_path('../public/images/'.$oldPhoto->photo)); // 기존파일 삭제
                }
                //unlink : 파일삭제 storage_path: 주어진 파일의 절대경로 반환
            }
            $intro = Intro::where('id', $id)->update([ # DB 업데이트
                'title' => $request->title,
                'append' => $request->append,
                'place' => $request->place,
                'master' => $request->master,
                'weekset' => $weekset['message'],
                'starttime' => $request->starttime,
                'endtime' => $request->endtime,
                'photo' => isset($filename) ? $filename : $oldPhoto->photo,
            ]);
            return response()->json([
                'message'=>'수정되었습니다.',
                'status'=>true
            ],201);
        }
        return response()->json(['message'=>$weekset['message'],'status'=>$weekset['status']],201);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) # 현지학기제 항목 삭제
    {
        $oldPhoto = Intro::where('id','=', $id)->first(); # 삭제할 정보
        if($oldPhoto->photo !== '' && file_exists(storage_path('../public/images/'.$oldPhoto->photo))){
            unlink(storage_path('../public/images/'.$oldPhoto->photo)); // 기존 사진 파일 삭제
        }
        
        Intro::where('id', $id)->delete(); # 삭제 
        return response()->json([
            'message'=>'삭제되었습니다.',
            'status'=>true
        ],201);
    }
}