<?php
include_once('./_common.php');
// include_once(G5_LIB_PATH.'/naver_syndi.lib.php');
// include_once(G5_CAPTCHA_PATH.'/captcha.lib.php');

// 토큰체크
// check_write_token($bo_table);


// $bo_table = 'g5_business_propos';



$g5['title'] = '평가 업로드';

// $msg = array();


$sql1 = "select * from g5_business_propos where bo_idx = '{$_GET['bo_idx']}' and value > 0";
$result1 = sql_query($sql1);
$num = 0;
for($j=1; $row1=sql_fetch_array($result1); $j++) {
    if($row['value'] == 1){
        $sql = " UPDATE g5_business_propos
        set value = '3' where bo_idx = '{$_GET['bo_idx']}'";

        sql_query($sql);

        alert('평가완료'); 
    } else if($row['value'] == 2){} {
        $sql = " UPDATE g5_business_propos
        set value = '4' where bo_idx = '{$_GET['bo_idx']}'";

        sql_query($sql);

        alert('평가완료');
    }
}

?>
 