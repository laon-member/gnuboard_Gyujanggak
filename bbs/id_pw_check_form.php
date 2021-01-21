<?php
include_once('./_common.php');
include_once(G5_CAPTCHA_PATH.'/captcha.lib.php');
include_once(G5_LIB_PATH.'/register.lib.php');

session_start();
// 불법접근을 막도록 토큰생성
$token = md5(uniqid(rand(), true));
set_session("ss_token", $token);
set_session("ss_cert_no",   "");
set_session("ss_cert_hash", "");
set_session("ss_cert_type", "");

$is_social_login_modify = false;

if( $provider && function_exists('social_nonce_is_valid') ){   //모바일로 소셜 연결을 했다면
    if( social_nonce_is_valid(get_session("social_link_token"), $provider) ){  //토큰값이 유효한지 체크
        $w = 'u';   //회원 수정으로 처리
        $_POST['mb_id'] = $member['mb_id'];
        $is_social_login_modify = true;
    }
}
include_once(G5_THEME_PATH.'/head2.php');
if ($_GET['title'] == "id") {
    include_once($member_skin_path.'/register_form_id.skin.php');
    run_event('register_form_after', $w, $agree, $agree2);

} else if ($_GET['title'] == "pw") {
    if($_GET['idx'] == 1){
        include_once($member_skin_path.'/register_form_pw.skin2.php');
    } else {
        include_once($member_skin_path.'/register_form_pw.skin.php');
    }
    run_event('register_form_after', $w, $agree, $agree2);
} else {
    alert('제대로 된 주소로 들어오세요');
}
include_once('./_tail.sub.php');

?>