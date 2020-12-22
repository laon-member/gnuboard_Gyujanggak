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
        $sql = " SELECT * FROM `g5_member` WHERE mb_name = '{$mb_name}' AND mb_email = '{$mb_email}'";
        $row2 = sql_fetch($sql);

        if(isset($row2)){
             $_SESSION['id'] = $row2['mb_id'];
            // echo $row2['mb_id'];
            // echo  $_SESSION['id'];
             alert('아이디를 찾았습니다.');
        } else {
            alert('정보가 없습니다.');
        }
    }

   

} else if ($user == 'pw') {

    $mb_id = $_POST['mb_id'];
    $mb_name = $_POST['mb_name'];
    $mb_email = $_POST['mb_email'];
    
    if(empty($mb_id) || empty($mb_name) || empty($mb_email)){
        alert('정보가 비어있습니다. 다시 입력해주세요');
    } else {
        $sql = " SELECT * FROM `g5_member` WHERE mb_id = '{$mb_id}' AND mb_name = '{$mb_name}' AND mb_email = '{$mb_email}'";
        $row2 = sql_fetch($sql);

        if(isset($row2['mb_password'])){
            $_SESSION['mb_no'] = $row2['mb_no'];
            echo $row2['mb_no'];
            sql_query($sql);
            alert('비밀번호를 찾았습니다.', G5_BBS_URL ."/id_pw_check_form.php?title=pw&idx=1");
        } else {
            alert('정보가 없습니다.');
        }
    }       
} else if ($user == 'pw2'){
    $mb_new_password = trim($_POST['mb_new_pw']);
    $mb_new_password_re = trim($_POST['mb_new_pw_re']);
    if(empty($mb_new_password) || empty($mb_new_password_re)){
        alert('정보가 비어있습니다. 다시 입력해주세요');
    } else {
        if($mb_new_password_re == $mb_new_password){
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
?>
