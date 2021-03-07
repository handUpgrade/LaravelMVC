<?php
    function attachements_path($path=''){ // 이미지를 업로드할때 사용
        return public_path('images'.($path ? DIRECTORY_SEPARATOR.$path : $path)); 
        // DIRECTORY_SEPARATOR = 해당 운영체제의 경로 문자를 반환해줌( / or \ ) -> IntroController, IntroduceController의 store,update
        //public_path : 우리 프로젝트의 웹 서버 루트 디렉터리(public 폴더)의 절대 경로를 반환하는 함수
        //() 안에 images 를 통해 public 폴더 안의 images 폴더에 들어감
    }
    ##  composer.json  autoload  에  "files": ["app/helper.php"] 추가 후.
    ##  composer dump-autoload --optimize
    function week_check($request,$id = -1){ // 시간표에 시간과 날짜를 비교하는 함수 ( $request객체(Form data) , 시간표 데이터 id (없을 경우-1))
        $starttime = str_replace(':','',$request->starttime);   // str_replace : 문자열 변환함수 (검색할 문자, 변환할 문자, 문자열)
        $endtime = str_replace(':','',$request->endtime);       // ex) ( ':' , '', 18:00:00) = 180000
        $starttime = substr($starttime, 0, 4);  // substr : 문자열 자르기함수(문자열, 시작점(0부터 시작), 문자수)
        $endtime = substr($endtime, 0, 4);      // ex) ( '180000', 0, 4 ) = 1800
        if($starttime > $endtime){ // 시작시간이 종료시간보다 클 경우
            return ['message'=>'시작시간이 종료시간보다 빨라야합니다.','status'=>false];  // 오류문, 상태(false) 두가지 값 리턴
        }
        if($starttime < 900 || $starttime > 1800 || $endtime < 900 || $endtime > 1800){ // 시작, 종료시간이 9시 보다 빠르거나 18시보다 늦을경우
            return ['message'=>'시간은 09시부터 12시까지 가능합니다.','status'=>false];   // 오류문, 상태(false) 두가지 값 리턴
        }
        $weekset = $request->weekset; // 입력받은 요일 값 ex) 157
        $count = strlen($weekset);    // 글자수 세기      ex) 3
        for($i = 0; $i < $count; $i++){ // 글자수 만큼 반복 ($i는 0부터 시작 1씩 증가)
            $key = substr($weekset, $i,1);  // 글자수 자르기 시작점을 $i로 지정 1글자만 ex) 154 라면 처음은 1, 두번째는 5, 세번째는 4
            $dateData = \App\Intro::where('weekset','like', '%'.$key.'%')->Where('id', '!=' , $id)->get(); // 원래 있던 시간표중에서 내가 입력할 요일과 동일한 요일의 값을 가져옴
                                                                            // $id는 수정할때 내 값을 제하기 위해서 (!=) 지정 create 시에는 -1로 고정됨 (id에는 -1이 존재할 수 없음 검색 X )
            foreach($dateData as $data){ // get() -> 배열로 반환 foreach 배열의 각요소요소에 {} 안의 내용 실행
                $oldstart = str_replace(':','',$data->starttime); 
                $oldend = str_replace(':','',$data->endtime);
                $oldstart = substr($oldstart, 0, 4);
                $oldend = substr($oldend, 0, 4); // 위와동일 18:00:00 -> 1800
                // starttime, endtime <- 내가 입력한 시간   oldstart,oldend 이미 존재하는 시간표의 시간
                if($starttime == $oldstart || ($starttime > $oldstart && $starttime < $oldend) || ($starttime < $oldstart && $endtime > $oldstart)) { 
                // 기존 시간표에 중복될 경우 
                    return ['message'=>'이미 존재하는 시간표 입니다.','status'=>false];   // 오류문, 상태(false) 두가지 값 리턴
                }
            }
        }
        return ['message'=>$weekset,'status'=>true];   // 문제없이 종료 되었을 경우 입력한 요일값, 상태(true) 두가지 값 리턴 -> introController.php 의 store, update
    }


    
    # Q&A
    function return_user_name($answers){# 데이터를 받고 , 기존 데이터에  데이터를 작성한 유저의 이름, 관리자 여부 반환.
        
        $data = $answers;
        $count = 0;
        
        foreach($answers as $answer){
            $data[$count]['u_name']=\App\User::find($answer->user_id)->name;
            $data[$count]['u_admin']=\App\User::find($answer->user_id)->admin;
            $count ++;
        }
        return $data;
    }
?>