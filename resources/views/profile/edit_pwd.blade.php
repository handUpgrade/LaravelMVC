<form id="formData" action="/profile/{{auth()->user()->user_id}}/update_pwd" enctype="multipart/form-data" method="post">
{!! method_field('PUT')!!}
{!! csrf_field() !!}
    <p>정보 변경</p>
    <div class="change_pw">   
    <table>
        <tr>
            <td>변경할 비밀번호</td>
            <td><input type="password" name="password" value="" required autofocus></td>
        </tr>
        <tr>
            <td>비밀번호 확인</td>
            <td><input type="password" name="password_confirmation" value="" required></td>
        </tr>
    </table>
    <div class="choice_btn"  style="text-align:center">
    <button type="submit" class='update'>저장</button> 
    <a href="/profile" class='back'>취소</a>
    </div>
    </div>   
</form>