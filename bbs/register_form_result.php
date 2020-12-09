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

if (!($user == 'id' || $user == 'pw')) {
    alert('user 값이 제대로 넘어오지 않았습니다.');
}

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
    $mb_new_password = $_POST['mb_new_pw'];
    $mb_new_password_re = $_POST['mb_new_pw_re'];

    if(empty($mb_id) || empty($mb_name) || empty($mb_email)  ||empty($mb_new_password)){
        alert('정보가 비어있습니다. 다시 입력해주세요');
    } else {

        if($mb_new_password_re == $mb_new_password){
            $sql = " SELECT * FROM `g5_member` WHERE mb_id = '{$mb_id}' AND mb_name = '{$mb_name}' AND mb_email = '{$mb_email}'";
            $row2 = sql_fetch($sql);
    
            if(isset($row2['mb_password'])){
                $mb_new_pw = get_encrypt_string($mb_new_password);
                $mb_no = $row2['mb_no'];
    
                $sql = "UPDATE `g5_member` mb_password = '{$mb_new_pw}' WHERE mb_no = '{$mb_no}'";
                sql_query($sql);
                alert('정보 수정 완료');
            } else {
                alert('정보가 없습니다.');
            }
        } else {
            alert('새로운 비밀번호가 일치하지 않습니다.');
        }

       
    }
}

?>
