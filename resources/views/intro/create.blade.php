<form id="formData2" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="title">제목 : </label>
        </label><input type="text" name="title" id="title" class="form-control" >
    </div>
    <div class="form-group">
       <label for="place">장소 : </label>
        <input type="text" name="place" id="place" class="form-control" >
    </div>
    <div class="form-group">
        <label for="master">담당자 : </label>
        <input type="text" name="master" id="master" class="form-control" >
    </div>
    <div class="form-group">
    <label>요일 : </label>
        <div class='select_bar' id='weekset'>
            <button type="button" data-value="1" class='selec_off'>월요일</button>
            <button type="button" data-value="2" class='selec_off'>화요일</button>
            <button type="button" data-value="3" class='selec_off'>수요일</button>
            <button type="button" data-value="4" class='selec_off'>목요일</button>
            <button type="button" data-value="5" class='selec_off'>금요일</button>
            <button type="button" data-value="6" class='selec_off'>토요일</button>
            <button type="button" data-value="7" class='selec_off'>일요일</button>
        </div>
    </div>
    <div class="form-group">
        <label for="starttime">시작시간 : </label>
        <input type="time" name="starttime" id="starttime" class="form-control">
    </div>
    <div class="form-group">
        <label for="endtime">종료시간 : </label>
        <input type="time" name="endtime" id="endtime" class="form-control">
    </div>
    <div class="form-group">
        <textarea name="append" cols="30" rows="10" id="title" class="form-control" placeholder="세부사항"></textarea>
    </div>
    <div class="form-group">
        <label for="photo">사진 : </label>
        <input type="file" name="photo" id="photo">
        <span class='img_section'></span>
    </div>
    <div class="form-group">
        @if($lv)
        <button type='submit' class='btn btn-primary'> 등록하기 </button>
        @endif
        <button type='button' class='clsBtn btn btn-primary'>닫기</button>
    </div>
</form>
<script>
$(document).ready(function() {
    
    var weekset = ''; // 변수 weekset 비어있는 상태로 생성 = 요일 값
    $('.clsBtn').on('click',function(e){ //클레스 clsBtn인 오브젝트를 클릭하면
        get_list({{$lv}}); // get_list 실행
    });
    $('.select_bar > button').on('click',function(){ //클레스가 select_bar div 안에 버튼을 클릭하면 
        var val = $(this).attr('data-value'); // 그 객체의 속성 data-value val 변수에 넣음
        if($(this).hasClass("selec_off")){ //그 객체가 클레스 selec_off를 가지고 있다면
            $(this).removeClass('selec_off'); // selec_off 제거
            $(this).addClass('selec_on'); // selec_on 추가
            weekset += val; // 값을 weekset 변수에 추가
        }else{
            $(this).removeClass('selec_on'); // selec_on 지움
            $(this).addClass('selec_off'); // selec_off 추가
            weekset = weekset.replace(val,''); // weekset에서 val 삭제
        }
    });
    
    $('#formData2').on('submit',function(e){
        e.preventDefault();
        var form = $('#formData2')[0]; //# formData2 객체 
        // Create an FormData object 
        var data = new FormData(form); // 객체 안의 내용을 javascript FormData를 이용해서 새 객체 생성
        data.append('weekset',weekset); // data객체에 weekset(요일값) 추가
        if(valid_chk(data)){ //->intro.js
            $.ajax({
                type: 'POST',
                enctype: 'multipart/form-data',
                url: '/intros',
                data: data,
                processData: false, // 기본값 : true query 문자열로 데이터를 전송할지 여부
                contentType: false, // 기본값 : 'application/x-www-form-urlencoded; charset=UTF-8' 기본 인코딩을 utf8
                cache: false,       // 브라우저에 캐쉬 여부 GET제외하고 그닥 사용 없음
                success : function(data){
                    alert(data["message"]);
                    if(data["status"]) get_list({{$lv}});
                }
            });
        }
    });
    $("#photo").change(function(){
        readURL(this);//intro.js --> 이미지 태그에 사진을 변경했을 때 
    });
});
</script>
<style>
    .select_bar button { padding:15px 20px; font:bold 12px malgun gothic; }
    .select_bar .selec_off {background:#bbbbbb; color:#444444; border:solid 2px #dddddd; }
    .select_bar .selec_on {background:#0069d9; color:white; border:solid 2px #007bff;}
</style>