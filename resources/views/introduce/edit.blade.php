<form id="formData" enctype="multipart/form-data" >
 {!! csrf_field() !!}
 <!-- {!! method_field('PUT')!!} -->
    <div class="print-error-msg" style="display:none">
        <ul></ul>
    </div>
    <div class="form-group">
        <div class="edit">
            <P>이름</P>
            <input name="name" id ="name" value="{{ old('name',$member->name)}}"></input>
            <P>자기소개</P>
            <textarea cols='62' rows='3' name='intro' id='intro'>{{ old('intro', $member->intro ) }}</textarea>
            <P>목표</P> 
            <textarea cols='62' rows='3' name="goal" id ="goal">{{ old('goal',$member->goal) }}</textarea>
            <div class = img_wrap>
                <p>현재 사진</P>
                <div class = "save_img">
                    <img src="/images/{{ $member->photo }}" width="300" alt="photo x"></br>
                </div>
                <p>바꿀 사진</p>
                <input type="file" name="photo" id="photo" value="{{ old('photo',$member->photo )}}"></br>
                <div class = "change_img">   
                    <!-- 미리보기 출력 -->
                    <p><최근 선택한 이미지></p>
                    <img id ="nowPhoto" />
                </div>
            </div>
        </div>
        <div class="authenticate">
            <h3>관리자 인증</h3>
            <P>아이디</P>
            <input name="user_id" id="user_id"></input>
            <P>비밀번호</P>
            <input type=password name="password" id="password" ></input>
        </div>
    </div>
    <hr>
    <div>
        <button type="submit" class="saveBtn btn btn-secondary" data-id="{{$member->id}}">저장하기</button>
        <button type="button" class="clsBtn btn btn-secondary" data-id="{{$member->id}}" data-dismiss="modal">삭제하기</button>
    </div>
</form>

<script>
    //이미지 미리보기 
    var sel_file;
    $(document).ready(function(){
        $('#photo').on("change", handleImgFileSelect);
    });
    function handleImgFileSelect(e){
        var files = e.target.files;
        var filesArr = Array.prototype.slice.call(files);
        filesArr.forEach(function(f){
            if(!f.type.match("image.*")) {
                alert("사진출력은 이미지 확장자만 가능합니다.");
                return;
            }
            sel_file = f;
            var reader = new FileReader();
            reader.onload = function(e){
                $("#nowPhoto").attr("src", e.target.result);
            }
            reader.readAsDataURL(f);
        });
    }
    
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.clsBtn').on('click', function(e){
        var clsId = $(this).attr('data-id');
        if(confirm('삭제하시겠습니까?')){
        $.ajax({
            type: 'DELETE',
            data: {
                user_id : $('#user_id').val(),
                password : $('#password').val(),  
            },
            url: '/introduce/' + clsId,   
            }).then(function(data) {
                if(data=="idx"){
                    alert("관리자 아이디가 아닙니다.");
                }
                else if(data=='passx'){
                    alert("password가 일치하지않습니다.");
                }
                else{
                    get_list();
                    $('.modal-body').empty();
                    $('#myModal').modal('hide');
                }
            });
         }
    });
    
    $('.saveBtn').on('click', function(e){ 
        //GET form
        var form = $('#formData')[0];
        var introId = $(this).attr('data-id'); // member의 id값을 가져옴
        //js의 this : 이벤트가 발생한 태그요소가 표시
        //jquery의 $(this) : 이벤트가 발생한 요소의 정보들이 object로 표시
        //.attr('속성') : 속성의 값을 가져옴
        //Create an FormData object
        var data = new FormData(form); // 뭔지모르겟다 
        data.append('_method', 'PATCH'); // PATCH?
        e.preventDefault();// 서브밋 행동취소
        $.ajax({
            type: 'POST', //ajax는 patch 안먹음
            url: '/introduce/' + introId,
            data: data, 
            processData: false,
            contentType: false,
            cache: false, 
            success : function(data){
                if($.isEmptyObject(data.error)){
                    if(data=="idx"){
                        alert("관리자 아이디가 아닙니다.");
                        $('.print-error-msg').hide();
                    }
                    else if(data=='passx'){
                        alert("password가 일치하지않습니다.");
                        $('.print-error-msg').hide();
                    }
                    else{
                        console.log(data);
                        get_list();// introduce에서 get_list함수를 호출 
                        $('.modal-body').empty();
                        $('#exampleModalLong').modal('hide');
                        // $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();
                    }
                }else{
                    console.log(data.error);
	                printErrorMsg(data.error);
	            }    
            }
        });
    });
    function printErrorMsg (msg) {
			$(".print-error-msg").find("ul").html('');
			$.each( msg, function( key, value ) {
				$(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                $(".print-error-msg").show();
			});
		}
</script>