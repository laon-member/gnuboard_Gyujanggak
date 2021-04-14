<?php 
include_once('./_common.php');

$vliew_date_time = $_POST['view_date'] . ' ' .  $_POST['view_time'];
$upload_date_time = $_POST['upload_date'] . ' ' .  $_POST['upload_time'];

if($_POST['business_idx'] == "" || $_POST['view_date'] == "" || $_POST['view_time'] == "" || $_POST['upload_date'] == "" || $_POST['upload_date'] == "" || $_POST['value_id'] == "") {
    alert('내용에 올바르게 입력해주세요.');
    exit;
}

$row = sql_fetch(" select * from report_date where business_idx = '{$_POST['business_idx']}' and report_level = '{$_POST['value_id']}'");

if(!$row){
    $sql = " insert into report_date
                set business_idx = '{$_POST['business_idx']}',
                view_date_time = '$vliew_date_time',
                upload_date_time = '$upload_date_time',
                report_level = '{$_POST['value_id']}'";
    
    sql_query($sql);

    alert('제출기한 설정 완료');
} else {
    $sql = " update report_date
                set business_idx = '{$_POST['business_idx']}',
                view_date_time = '$vliew_date_time',
                upload_date_time = '$upload_date_time',
                report_level = '{$_POST['value_id']}'";

    sql_query($sql);

    alert('제출기한 설정 완료');
}
?>
