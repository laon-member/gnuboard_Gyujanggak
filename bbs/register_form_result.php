<?php
include_once('./_common.php');
include_once(G5_CAPTCHA_PATH.'/captcha.lib.php');
include_once(G5_LIB_PATH.'/register.lib.php');
include_once(G5_LIB_PATH.'/mailer.lib.php');
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// 리퍼러 체크
referer_check();
session_start();
$user = $_POST['check_user'];


$_SESSION['id'] = '';


if ($user == 'u' && $is_admin == 'super') {
    if (file_exists(G5_PATH.'/DEMO'))
        alert('데모 화면에서는 하실(보실) 수 없는 작업입니다.');
}

if ($user == 'id') {
    $mb_name = $_POST['mb_name'];
    $mb_email = $_POST['mb_email'];

    if(empty($mb_email) || empty($mb_name)){
        alert('정보가 비어있습니다. 다시 입력해주세요');
    } else {
        $sql = " SELECT * FROM `g5_member` WHERE mb_email = '{$mb_email}'";
        $result2 = sql_query($sql);
        $row3=sql_fetch_array($result2);

        if(!$row3['mb_email']) return alert('없는 이메일 입니다.');
        if($row3['mb_name'] != $mb_name) return alert('없는 이름 입니다.');

        $_SESSION['id'] = $row3['mb_id'];
        $_SESSION['name'] = $row3   ['mb_name'];
        alert('아이디를 찾았습니다.');
        
    }

   

} else if ($user == 'pw') {

    $mb_id = $_POST['mb_id'];
    $mb_email = $_POST['mb_email'];
    $mb_name = $_POST['mb_name'];
    
    if(empty($mb_id) || empty($mb_name) || empty($mb_email)){
        alert('정보가 비어있습니다. 다시 입력해주세요');
    } else {

        $sql = " SELECT * FROM `g5_member` WHERE mb_id = '{$mb_id}'";
        $result2 = sql_query($sql);
        $row3=sql_fetch_array($result2);

        if(!$row3['mb_id']) return alert('없는 아이디 입니다.');
        if($row3['mb_email'] != $mb_email) return alert('없는 이메일 입니다.');
        if($row3['mb_name'] != $mb_name) return alert('없는 이름 입니다.');

        $_SESSION['mb_no'] = $row3['mb_no'];
        alert('비밀번호를 찾았습니다.', G5_BBS_URL ."/id_pw_check_form.php?title=pw&idx=1");
          
    }       
} else if ($user == 'pw2'){
    $mb_new_password = trim($_POST['mb_new_pw']);
    $mb_new_password_re = trim($_POST['mb_new_pw_re']);
    if(empty($mb_new_password) || empty($mb_new_password_re)){
        alert('정보가 비어있습니다. 다시 입력해주세요');
    } else {
        if ($w == '' && !$mb_new_password && !$mb_new_password_re)
        alert('비밀번호가 넘어오지 않았습니다.');

        if(!preg_match('/[a-z0-9A-Z~!@#$%^&*]{9,}/', $mb_new_password)) {
            alert('9자 이상의 영문, 숫자, 특수문자를 혼합만 가능합니다');
        } else {
            if($mb_new_password_re == $mb_new_password){
                $sql = "SELECT * FROM `g5_member` WHERE mb_no = '{$_SESSION['mb_no']}'";
                $result2 = sql_query($sql);
                $row=sql_fetch_array($result2);
                if(login_password_check($row, $mb_new_password, $row['mb_password'])){
                    alert('새비밀번호가 현재 비밀번호랑 일치합니다. ');
                } 
               
                $sql_password= "";
                $sql_password = " mb_password = '".get_encrypt_string($mb_new_password)."' ";

                $sql = "UPDATE `g5_member` set {$sql_password} WHERE mb_no = '{$_SESSION['mb_no']}'";
                sql_query($sql);
                $_SESSION['mb_no'] = '';
                alert('비밀번호를 수정했습니다.', G5_URL);
            } else {
                alert('새로운 비밀번호가 일치하지 않습니다.');
            }
        }
    }
}
?>
