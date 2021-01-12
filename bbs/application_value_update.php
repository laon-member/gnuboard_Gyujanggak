<?php
include_once('./_common.php');
// include_once(G5_LIB_PATH.'/naver_syndi.lib.php');
// include_once(G5_CAPTCHA_PATH.'/captcha.lib.php');

// 토큰체크
// check_write_token($bo_table);


// $bo_table = 'g5_business_propos';



$g5['title'] = '평가 업로드';

// $msg = array();


$sql1 = "select * from g5_business_propos where bo_idx = '{$_GET['us_idx']}'";
$result1 = sql_query($sql1);
for($j=1; $row1=sql_fetch_array($result1); $j++) {
    if($row1['value'] == 0){
        $sql = " UPDATE g5_business_propos set value = '3' where bo_idx = '{$_GET['us_idx']}'";
        sql_query($sql);

        if($_GET['bo_idx'] == 1){
            $sql2 = " update g5_write_business set value = '3' where wr_id = '{$_GET['us_idx']}'";
        } else if($_GET['bo_idx'] == 2){
            $sql2 = " update g5_write_business set wr_8 = '3' where wr_id = '{$_GET['us_idx']}'";
        } else if($_GET['bo_idx'] == 3){
            $sql2 = " update g5_write_business set wr_9 = '3' where wr_id = '{$_GET['us_idx']}'";
        }
        sql_query($sql2);

        alert('평가완료'); 
    } else if($row1['value'] == 1) {
        $sql = " UPDATE g5_business_propos set value = '4' where bo_idx = '{$_GET['us_idx']}'";
        sql_query($sql);
        
        if($_GET['bo_idx'] == 1){
            $sql2 = " update g5_write_business set value = '3' where wr_id = '{$_GET['us_idx']}'";
        } else if($_GET['bo_idx'] == 2){
            $sql2 = " update g5_write_business set wr_8 = '3' where wr_id = '{$_GET['us_idx']}'";
        } else if($_GET['bo_idx'] == 3){
            $sql2 = " update g5_write_business set wr_9 = '3' where wr_id = '{$_GET['us_idx']}'";
        }
        sql_query($sql2);
        alert('평가완료');
    }

    
}
alert("이미 평가를 햇습니다.");
?>
 