<form action="{{ route('introduce.store') }}" id="formData" method="POST" enctype="multipart/form-data">
 {!! csrf_field() !!}
    <div class="print-error-msg" style="display:none">
        <ul></ul>
    </div>
    <div class="form-group">
        <div class ="create">
            <P>이름</P>
            <input name="name" id ="name" value="{{ old('name')}}"></input>
            <P>자기소개</P>
            <textarea cols='62' rows='3' name='intro' id='intro'>{{ old('intro') }}</textarea>
            <P>목표</P> 
            <textarea cols='62' rows='3' name="goal" id ="goal">{{ old('goal') }}</textarea>
        </div>
        <div class = img_wrap>
            <p>사진</p> 
            <input type="file" name="photo" id="photo">
            <!-- 미리보기 출력 -->
            <p><최근 선택한 이미지></p>  
            <img id ="nowPhoto"/>
        </div>
    </div>

    <div>
    </br>
        <button type="submit" class="addBtn btn btn-secondary">저장하기</button>
        <button type="button" class="clsBtn btn btn-secondary" data-dismiss="modal">취소</button>
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
    $('.clsBtn').on('click', function(e){
        get_list();
    });
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('.addBtn').on('click', function(e){  
        //GET form
        //제이쿼리에서 .은 클래스 #은 id로 접근시 사용한다.
        var form = $('#formData')[0]; // 뭐지이건
        //Create an FormData object
        var data = new FormData(form); // 뭔지모르겟다 
        e.preventDefault();// 서브밋 행동취소(왜 쓰는지는 모르겟음)
        
        
        $.ajax({
            type: 'POST',
            enctype: 'multipart/form-data',
            url: '/introduce',
            data: data, // 모르겠다
            processData: false,
            contentType: false,
            cache: false, 
            success : function(data){
                if($.isEmptyObject(data.error)){
                    console.log(data);
                    get_list();// introduce에서 get_list함수를 호출 
                    $('.modal-body').empty();
                    $('#exampleModalLong').modal('hide');
                    // $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                    
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