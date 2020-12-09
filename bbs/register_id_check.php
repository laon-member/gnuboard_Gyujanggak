<?php


include_once('./_common.php');

session_start();
$_SESSION['FORM'] = $_POST;
$mb_id = $_SESSION['FORM']['mb_id'];
$form_name = $_SESSION['FORM']['mb_name'];
$form_pw = $_SESSION['FORM']['mb_password'];
$form_pw_re = $_SESSION['FORM']['mb_password_re'];
$form_email = $_SESSION['FORM']['mb_email'];


$prevPage = $_SERVER['HTTP_REFERER'];

if (trim($mb_id)==''){
    print "<script language=javascript> alert('회원아이디를 입력해 주십시오.'); location.href='". G5_BBS_URL."/register_form.php';</script>";
}else{
    if (preg_match("/[^0-9a-z_]+/i", $mb_id)){
        print "<script language=javascript> alert('회원아이디는 영문자, 숫자, _ 만 입력하세요.'); location.href='". G5_BBS_URL."/register_form.php';</script>";
    } else {
        if (strlen($mb_id) < 3){
            print "<script language=javascript> alert('회원아이디는 최소 3글자 이상 입력하세요.'); location.href='". G5_BBS_URL."/register_form.php';</script>";
        } else {
            global $g5;

            $sql = " select count(*) as cnt from `{$g5['member_table']}` where mb_id = '$mb_id' ";
            $row = sql_fetch($sql);
            if ($row['cnt']){
                print "<script language=javascript> alert('이미 사용중인 회원아이디 입니다.'); location.href='". G5_BBS_URL."/register_form.php';</script>";
            } else {
                global $config;
                if (preg_match("/[\,]?{$mb_id}/i", $config['cf_prohibit_id']))
                    print "<script language=javascript> alert('이미 예약된 단어로 사용할 수 없는 회원아이디 입니다.'); location.href='". G5_BBS_URL."/register_form.php';</script>";
                else{ 
                    print "<script language=javascript> alert('사용가능한 아이디입니다.'); location.href='". G5_BBS_URL."/register_form.php?btn=disabled';</script>";
                }
            }
        }
    }
}

?>