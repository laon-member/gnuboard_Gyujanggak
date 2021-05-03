<?php
include_once('./_common.php');
$mb_id = $_POST['mb_id'];
if (trim($mb_id)==''){
    $test = "회원아이디를 입력해 주십시오.";
}else{
    if (preg_match("/[^0-9a-z_]+/i", $mb_id)){
        $test = "회원아이디는 영문자, 숫자만 입력하세요.";
    } else {
        if (strlen($mb_id) < 6){
            $test = "회원아이디는 최소 6글자 이상 입력하세요.";
        } else {
            global $g5;

            $sql = " select *  from `{$g5['member_table']}` where mb_id = '$mb_id' ";
            $row = sql_fetch($sql);
            if ($row && !$row['mb_leave_date'] && !$row['mb_leave_date']){
                $test = "이미 사용중인 회원아이디 입니다.";
            } else if($row && $row['mb_leave_date'] && $row['mb_leave_date'] <= date("Ymd", G5_SERVER_TIME)) {
                $test = "탈퇴한 아이디 입니다.";
            }else {
                global $config;
                if (preg_match("/[\,]?{$mb_id}/i", $config['cf_prohibit_id'])){
                    $test = "이미 예약된 단어로 사용할 수 없는 회원아이디 입니다.";
                }
                else{ 
                    $test = "사용 가능한 아이디 입니다.";
                }
            }
        }
    }
}
echo trim($test);
?>