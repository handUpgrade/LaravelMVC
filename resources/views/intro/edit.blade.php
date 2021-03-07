<form id="formData2" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="title">제목 : </label>
        </label><input type="text" name="title" id="title" class="form-control" value="{{$intro->title}}">
    </div>
    <div class="form-group">
       <label for="place">장소 : </label>
        <input type="text" name="place" id="place" class="form-control" value="{{$intro->place}}">
    </div>
    <div class="form-group">
        <label for="master">담당자 : </label>
        <input type="text" name="master" id="master" class="form-control" value="{{$intro->master}}">
    </div>
    <div class="form-group">
    <label for="weekset">요일 : </label>
        <div class='select_bar' id='weekset'>
        </div>
    </div>
    <div class="form-group">
        <label for="starttime">시작시간 : </label>
        <input type="time" name="starttime" id="starttime" class="form-control" value="{{$intro->starttime}}">
    </div>
    <div class="form-group">
        <label for="endtime">종료시간 : </label>
        <input type="time" name="endtime" id="endtime" class="form-control" value="{{$intro->endtime}}">
    </div>
    <div class="form-group">
        <textarea name="append" cols="30" rows="10" id="title" class="form-control" placeholder="세부사항">{{$intro->append}}</textarea>
    </div>
    <div class="form-group">
        <label for="photo">사진 : </label>
        <input type="file" name="photo" id="photo">
        <span class='img_section'></span>
    </div>
    <div class='btnBlk'>
        @if($lv)
        <button type="submit" class="modBtn btn btn-primary"> 수정하기 </button>
        @endif
        <button type="button" class="clsBtn btn btn-primary">닫기</button>
    </div>
</form>

<script>
    var weekset = ''; // 초기화
    var select = $('#weekset'); // id가 weekset인 div
    var key = "{{$intro->weekset}}"; // 수정할 데이터의 weekset 값
    for(i = 0; i<7; i++){// 변수 i는 0이고 7보다 작을때가지 반복 i씩 증가(7번 반복)
        var l = i + 1;
        var option = $(`<button type="button" data-value="${l}" class='selec_off'>${weeknd[i]}</button>`); // selec_off클래스의 button 생성 
        if( key.indexOf(l) != -1){ // 문자열 찾기 수정할 데이터의 weekset 값과 동일한 요일의 버튼일 경우 
            option = $(`<button type="button" data-value="${l}" class='selec_on'>${weeknd[i]}</button>`); // selec_on클래스의 버튼 생성
            weekset += l;       // weekset 변수에 1증가
        }
        select.append(option);
    }
    $('.select_bar > button').on('click',function(){    // create와 동일 버튼 선택시 스타일을 주고 값을 등록
        var val = $(this).attr('data-value');
        if($(this).hasClass("selec_off")){
            $(this).removeClass('selec_off');
            $(this).addClass('selec_on');
            weekset += val;
        }else{
            $(this).removeClass('selec_on');
            $(this).addClass('selec_off');
            weekset = weekset.replace(val,'');
        }
    });
    $('.clsBtn').on('click',function(e){
        load_page({{$intro->id}});  // 뒤로가기 누르면 load_page() 함수실행
    });
    $('.modBtn').on('click',function(e){
        e.preventDefault(); // event 막음
        // Get form
        console.log(date);
        var form = $('#formData2')[0]; // Object -> HTMLFormElement
        console.log($('#formData2'));
        // Create an FormData object 
        var data = new FormData(form); // FormData
        console.log(data);
        data.append('weekset',weekset);
        data.append('_method', 'PATCH'); //_method의 값을 patch laravel 시스템상 _method = method
        if(valid_chk(data)){ // 벨리데이터 체크
            $.ajax({
                type:'POST',
                url: '/intros/' + {{$intro->id}},   // IntroController update경로
                data:data,
                processData:false,
                contentType:false,
                cache:false,
                success : function(data){
                    alert(data["message"]);
                    if(data["status"]) load_page({{$intro->id}}); // status가 false(오류가 발생)일 때 load_page() 실행
                }
            });
        }
    });
    $("#photo").change(function(){  //사진을 변경하면 -> Intro.js의 readURL함수 실행
        readURL(this); 
    });
</script>
<style>
    .select_bar button { padding:15px 20px; font:bold 12px malgun gothic; }
    .select_bar .selec_off {background:#bbbbbb; color:#444444; border:solid 2px #dddddd; }
    .select_bar .selec_on {background:#0069d9; color:white; border:solid 2px #007bff;}
</style>