<?php
include_once('./_common.php');
include_once(G5_CAPTCHA_PATH.'/captcha.lib.php');
include_once(G5_LIB_PATH.'/register.lib.php');

run_event('register_form_before');

// 불법접근을 막도록 토큰생성
$token = md5(uniqid(rand(), true));
set_session("ss_token", $token);
set_session("ss_cert_no",   "");
set_session("ss_cert_hash", "");
set_session("ss_cert_type", "");

$is_social_login_modify = false;

$page = $_POST['mypage'];

if ($page == "1") {
    $g5['title'] = '회원정보 수정';
    
    

    $mb_new_password = trim($_POST['mb_password']);
    $mb_new_password_re = trim($_POST['mb_password_re']);


    $sql_password= "";
    $sql_name= "";
    $sql_email= "";


    if($mb_new_password == "" || $mb_new_password_re == ""){
        alert("비밀번호가 비어있습니다.");
    }

    if($mb_new_password_re != $mb_new_password){    
        alert('비밀번호가 일치하지 않습니다.');
    }

    if(!preg_match('/[a-z0-9A-Z~!@#$%^&*]{9,}/', $mb_new_password)) {
        alert('9자 이상의 영문, 숫자, 특수문자를 혼합만 가능합니다');
    }

    $sql_password = " mb_password = '".get_encrypt_string($mb_new_password)."', ";

    

    if($_POST['mb_name'] != "")
        $sql_name = " mb_name= '".$_POST['mb_name'] . "',";

    if($_POST['mb_email'] != "")
        $sql_email = " mb_email= '".$_POST['mb_email'] . "'";

    $sql = "UPDATE `g5_member` set {$sql_password} {$sql_name} {$sql_email} WHERE mb_id = '{$member['mb_id']}'";
    sql_query($sql);
    alert('회원정보를 수정했습니다.', G5_URL);

} else if ($page == '2') {
    $g5['title'] = '회원 탈퇴';

    // $sql = "select * from `g5_member` WHERE mb_id = '{$member['mb_id']}'";
    // sql_query($sql);

    if($_POST['mb_password'] != ""){
        if(check_password($_POST['mb_password'], $member['mb_password'])){
            echo "fdsa";
            if ($is_admin == 'super'){
                alert('최고 관리자는 탈퇴할 수 없습니다');
            } else {
                // DELETE FROM [테이블] WHERE [조건]
                $sql = "DELETE FROM `g5_member` WHERE mb_id = '{$member['mb_id']}'";
                sql_query($sql);
                alert('회원탈퇴 완료', G5_URL);     
            }

        } else {
            alert("비밀번호가 일치하지 않습니다.");
        }
    } else {
        alert("비밀번호를 입력해주세요");
    }
    
} else {
    alert('page 값이 제대로 넘어오지 않았습니다.');
}

// include_once(G5_THEME_PATH.'/head1.php');


// // 회원아이콘 경로
// $mb_icon_path = G5_DATA_PATH.'/member/'.substr($member['mb_id'],0,2).'/'.get_mb_icon_name($member['mb_id']).'.gif';
// $mb_icon_url  = G5_DATA_URL.'/member/'.substr($member['mb_id'],0,2).'/'.get_mb_icon_name($member['mb_id']).'.gif';

// // 회원이미지 경로
// $mb_img_path = G5_DATA_PATH.'/member_image/'.substr($member['mb_id'],0,2).'/'.get_mb_icon_name($member['mb_id']).'.gif';
// $mb_img_url  = G5_DATA_URL.'/member_image/'.substr($member['mb_id'],0,2).'/'.get_mb_icon_name($member['mb_id']).'.gif';

// $register_action_url = G5_BBS_URL.'/register_form_update.php';
// $req_nick = !isset($member['mb_nick_date']) || (isset($member['mb_nick_date']) && $member['mb_nick_date'] <= date("Y-m-d", G5_SERVER_TIME - ($config['cf_nick_modify'] * 86400)));
// $required = ($w=='') ? 'required' : '';
// $readonly = ($w=='u') ? 'readonly' : '';

// $agree  = preg_replace('#[^0-9]#', '', $agree);
// $agree2 = preg_replace('#[^0-9]#', '', $agree2);

// // add_javascript('js 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
// if ($config['cf_use_addr'])
//     add_javascript(G5_POSTCODE_JS, 0);    //다음 주소 js



// if($_GET['page'] == 1){
//     include_once($member_skin_path.'/mypage_form.skin.php');
// } else if($_GET['page'] == 2){
//     include_once($member_skin_path.'/mypage_form.skin2.php');
// } else {
//     alert("잘못된 경로입니다.");
// }

// run_event('register_form_after', $w, $agree, $agree2);

// include_once('./_tail.php');
// ?>
