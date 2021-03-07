<style>
    .p_title{text-align:center;}
    .page{padding-top: 2%;}
    .form-control2{
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: 0.25rem;
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
    margin-bottom: 20px;
margin-top:20px;}
    .btnBlk{
        text-align:center;
        margin-top: 30px;
        margin-bottom: 30px;
    }
    .btnCls{
        text-align:center;
    
    }
</style>
<div class="container">
    <div class="form-group">
        <p class='p_title'>제목</p>
        <p class="form-control">{{$intro->title}}</p>
    </div>
    <div class="form-group">
        <p class='p_title'>담당자</p>
        <p class="form-control">{{$intro->master}}</p>
    </div>
    <div class="form-group">
        <p class='p_title'>장소</p>
        <p class="form-control">{{$intro->place}}</p>
    </div>
    <div class="form-group">
        <p class='p_title'>요일</p>
        <p class="form-control">{{$intro->weekset}}</p>
    </div>
    <div class="form-group">
        <p class='p_title'>시간</p>
        <p class="form-control">{{$intro->starttime}} ~ {{$intro->endtime}}</p>
    </div>
    <div class="form-group story-small">
    <p class='p_title'>상세내용</p>
        <p class="form-control2">
            {{$intro->append}}<br/><br/>
            @if($intro->photo!='')
            <img src = "/images/{{$intro->photo}}" alt="{{$intro->title}}" height="200"/>
            @endif
            
        </p>
    </div>
</div>
<div class='btnBlk'>
    @if($lv)
    <button type="button" class="btn btn-primary" onclick='load_page({{$intro->id}},"/edit")'>수정하기</button>
    <button type="button" class='delBtn btn btn-primary'>삭제하기</button>
    @endif
</div>
<div class='btnCls'>
    <button type='button' class='clsBtn btn btn-primary'>닫기</button>
</div>
<script>
$(document).ready(function() {
    $('.clsBtn').on('click',function(e){
        get_list({{$lv}});  // 닫기 버튼 누르면 get_list()함수 실행
    });
        
    $('.delBtn').on('click',function(e){
        if(confirm('글을 삭제합니다.')){
            $.ajax({
                headers:{
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
                },
                type: 'DELETE',
                url: '/intros/' + {{$intro->id}},
            }).done(function(data){
                alert(data.message);
                get_list({{$lv}});
            });
        }
    });
});
</script>