@extends('introduce.introducelayout')
@section('content')
    <h1 class = "usershokai">회원 소개</h1>
    <div class="main"></div>

    @if(isset(auth()->user()->admin) ?  (auth()->user()->admin==1)?1:0  : 0 )
        <center>
        <button type="button" class='btn btn-primary creBtn' data-toggle="modal" data-target="#exampleModalLong" style="font-size:30px; width:100px; margin-bottom:10px;">+</button>
        </center>
    @endif
    <!-- Modal -->
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">


        <div class="modal-content">
        <div class="modal-header">


            <h5 class="modal-title" id="exampleModalLongTitle">조원 소개 Modal</h5>
            <button type="button" class="close" data-dismiss="modal" >
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body"></div>
        </div>
    </div>
    </div>
@stop

@section('script')
    <script>
    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.creBtn').on('click', function(e){
        $('.modal-body').load('/introduce/create');
    });

    function intro_edit(id){
        $('.modal-body').load('/introduce/'+id+'/edit');
    }

    function get_list(){
        console.log('정상실행됫음 ㅇㅇ');
        $.ajax({
            method:'GET',
            url:'/introduce/list',
        })
        .done(function( board_list ) {
            var board_div=$('.main'); //main의 재구성
            board_div.html('');//이건 머꼬?
            board_list.map(board=>{

                // var div_card = $(`<div class="card mb-3" style="width: 540px;">`+
                // `<div class="row no-gutters">`+
                // `<div class="col-md-4">`+
                // `<img src="images/${board.photo}" class="card-img" alt="사진없음">`+
                // `</div>`+
                // `<div class="col-md-8">`+
                // `<div class="card-body">`+
                // `<h5 class="card-title text-white">${board.name}</h5>`+
                // `<p class="card-text text-white">${board.intro}</p>`+
                // `<p class="card-text text-white">${board.goal}</p>`+
                // `</div>`+`</div>`+`</div>`+`</div>`);
                // board_div.append(div_card);

                // var button = $(`<li><button type="button"class="btn btn-primary creBtn" data-toggle="modal" data-target="#exampleModalLong">수정하기</button></li>`);
                // button.bind('click' , function(e) {intro_edit(board.id)});

                // board_div.append(button);
                var div_card = $(`<div class="card_user mb-3" style="width: 500px; color: black;">`);
                var div_row = $(`<div class="row no-gutters">`);
                var div_col1 = $(`<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 hovereffect">`);
                var div_card_body = $(`<div class="col-md-8">`+
                `<div class="card-body">`+
                `<h5 class="card-title text-mypick">이름 : ${board.name}</h5>`+
                `<p class="card-text text-mypick">자기소개 : ${board.intro}</p>`+
                `<p class="card-text text-mypick">목표 : ${board.goal}</p>`+
                `</div>`+`</div>`);
                var img = $(`<img src="images/${board.photo}" class="card-img1" alt src="images/1.jpg">`);
                var modal_str = `<div class="overlay creBtn" `;
                if({{$lv}}) modal_str += ` data-toggle="modal" data-target="#exampleModalLong"`;
                var img_script = $(modal_str + '>');
                var script_content = $(`<p>team 3</p>`);
                var script_content1 = $(`<p>${board.name}<p>`);
                if({{$lv}}){
                    img_script.bind('click' , function(e) {
                        intro_edit(board.id)
                        });
                }
                img_script.append(script_content);
                img_script.append(script_content1);
                div_col1.append(img);
                div_col1.append(img_script);
                div_row.append(div_col1);
                div_row.append(div_card_body);
                div_card.append(div_row);
                board_div.append(div_card);
            });
        });
    }
    get_list(); //왜하는지는 모르겠음
    </script>
@stop
