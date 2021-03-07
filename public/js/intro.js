var weeknd = [ '월요일', '화요일', '수요일', '목요일', '금요일', '토요일', '일요일' ];     // 요일 데이터베이스에 1234567로 되어 있기때문에 이를 문자열로 변환해 주기 위한 배열
var attrs = ['title', 'place', 'master', 'weekset', 'starttime', 'endtime', 'append',]  // 유효성 검사를 위해서 FORMDATA의 KEY값들을 넣은 배열
var attrKo = {  // 오류문을 한글로 변환하기 위한 배열
    'title' : '제목',
    'place' : '장소',
    'master' : '담당자',
    'weekset' : '요일',
    'starttime' : '시작시간',
    'endtime' : '종료시간',
    'append' : '내용',
};
function load_page(id,str = ''){
    $('.page').load('/intros/'+id+str); // ajax get 으로 보내와서 받는 리턴값을 전부 html로 변환해서 넣어주는 함수
}
function get_list(lv){
    var board_div= $('.page'); // div class page 선택
    board_div.html(''); // 초기화
    var b_ul = $('<ul class="b_ul">'); // ul 태그 생성 클래스를 b_ul로 지정해줍니다.
    for(i = 9; i <= 18; i++){ // 9 ~ 18까지 반복해 줍니다.
        var ti = (`<li>${i}시 --</li>`); //왼쪽에있는 시간을 나타내줍니다.
        b_ul.append(ti); 
    }
    board_div.append(b_ul); //.page 에 추가
    $.ajax({
        method:'GET',
        url: '/intros/list', //->  web.php 에 가서
        })
        .done(function( board_list ) { // return 받아 옴
            console.log(board_list);
            var key = 0; // 변수 key 0 지정
            board_list.map(board=>{ //map을 통해 배열 요소 하나하나에 적용, board = 배열의 값
                var a_ul = $('<ul class="a_ul">'); // ul 태그 생성 클레스 a_ul 지정
                var c_ul = $('<ul>'); // ul 태그 생성
                a_ul.append(c_ul); 
                var li = $('<li> ' + weeknd[key] + ' </li>');
                c_ul.append(li); 
                board.map(list=>{ // 위에 똑같이 요소하나하나 적용
                    var time = parseInt(list.endtime) - parseInt(list.starttime); // 끝시간 - 시작시간으로 사이시간을 구함
                    var y_fix = (parseInt(list.starttime)-9)*60+40; //높이 정해주기 시작시간에서 9(균형)빼고 60(시간)곱하고 40(맨위 제목 블록) 더함
                    var c_ul = $(`<li style="height:${(time*60)}px; top:${y_fix}px"><div>${list.title}</div></li>`); //li 태그 생성 리스트 타이틀
                    c_ul.bind('click' , function(e) {load_page(list.id)}); // 클릭 이벤트 loat_page(id) 함수를 실행
                    // intros/3
                    a_ul.append(c_ul); 
                });
                board_div.append(a_ul);
                key++;
            });
            if(lv){ // 관리자 1 0 1트루 0팔스 
                var button = $(`<div class='form-group'><button type="button" class="btn btn-primary">등록하기</button></div>`); //버튼 등록하기 생성
                button.bind('click' , function(e) {load_page('create')}); // 클릭시 loat_page('create') 실행
                board_div.append(button);
            }
        });
}
function valid_chk(data){ // data = FormData
    var err = 0; // err 변수에 0 
    var filter = ''; // filter 초기화
    var txt = '[ '; //txt에 [ 추가
    attrs.map(function(attr){ //요소 하나하나에 적용
        if (data.get(attr) === filter){ 
            // .get을 사용해서 태그 하나하나 내용을 공백값과 비교해서 맞을경우 색을 변경
            $(`#${attr}`).css('background','#FAECC5');
            $(`#${attr}`).css('border','solid 1px #FFBB00');
            txt += attrKo[attr] + ' '; //에러메세지에 추가
            err++;
        }else{
            // 원래 색으로 변경
            $(`#${attr}`).css('background','white');
            $(`#${attr}`).css('border','solid 1px black');
        }
    });
    txt += '] 입력해주세요'; // 에러메세지
    if(err !== 0) alert(txt); // 에러메세지 경고 출력
    return (err === 0) ? true : false; // 하나라도 잘못될 경우 false 리턴 다 잘될경우 true 리턴
}
function readURL(input) {
    if (input.files && input.files[0]) {    // 가져온 파일이 있을경우
        var reader = new FileReader(); // 파일리더 객체생성
        reader.onload = function (e) { //리더가 되었을 경우 e = input.files[0]
            $('.img_section').html(''); // img_section 부분 초기화
            var i = imageResize(e.target.result); // 이미지 리사이즈 함수 실행, e.target.result 이벤트가 실행된 대상의 result 값
            $('.img_section').append(i); // imageReszie리턴값으로 이미지 추가
            
        }
        reader.readAsDataURL(input.files[0]); // readAsDataURL : 파일을 읽어오느 함수 이게 되면 위에 온로드가 실행됨
    }
}
function imageResize(img_src){
    var i = new Image(); // 이미지 객체생성
    i.src = img_src; // 이미 경로 지정 경로는 받아온 reader 값
    if(i.width > i.height) i.width = 200; //그 원본 이미지 크기가 가로가 더크면 가로를 기준
    else i.height = 200; //세로가 더크면 세로가 기준
    return i; //리턴
}