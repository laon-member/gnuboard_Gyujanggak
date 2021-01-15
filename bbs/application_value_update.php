<?php
include_once('./_common.php');


$g5['title'] = '평가 업로드';

$sql = "select * from g5_write_business where wr_id = '{$_GET['us_idx']}'";
$result = sql_query($sql);
$row=sql_fetch_array($result);

if ($row['value'] == 0){
    alert("심사위원 의뢰를 먼저 진행해주세요");
}

if($row['value'] == 1){
    alert("합격자를 먼저 선발 해주세요");
}

if($row['value'] == 3){
    alert("이미 발표를 했습니다.");
}

$sql1 = "select count(*) as cnt from g5_business_propos where bo_idx = '{$_GET['us_idx']}'";
$result1 = sql_query($sql1);
$row1=sql_fetch_array($result1);


if($row1['cnt'] > 0){
    $sql2 = "select * from g5_business_propos where bo_idx = '{$_GET['us_idx']}'";
    $result2 = sql_query($sql2);
    for($j=1; $row2=sql_fetch_array($result2); $j++) {
        if($_GET['bo_idx'] == 1){
            if($row2['value'] == 4 || $row2['value'] == 3){
                alert("이미 발표를 했습니다.");
            }else if($row2['value'] == 0){
                $sql = " UPDATE g5_business_propos set value = '3' where bo_idx = '{$_GET['us_idx']}'";
                sql_query($sql);

                $sql2 = " update g5_write_business set value = '3' where wr_id = '{$_GET['us_idx']}'";
                sql_query($sql2);

                alert('평가완료'); 
            } else if($row1['value'] == 1) {
                $sql = " UPDATE g5_business_propos set value = '4' where bo_idx = '{$_GET['us_idx']}'";
                sql_query($sql);
                
                $sql2 = " update g5_write_business set value = '3' where wr_id = '{$_GET['us_idx']}'";
                sql_query($sql2);
                alert('평가완료');
            }
        } else if($_GET['bo_idx'] == 2) {
            if($row2['wr_8'] == 4 || $row2['value'] == 3){
                alert("이미 발표를 했습니다.");
            }else if($row2['value'] == 0){
                $sql = " UPDATE g5_business_propos set value = '3' where bo_idx = '{$_GET['us_idx']}'";
                sql_query($sql);

                $sql2 = " update g5_write_business set wr_8 = '3' where wr_id = '{$_GET['us_idx']}'";
                sql_query($sql2);

                alert('평가완료'); 
            } else if($row1['wr_8'] == 1) {
                $sql = " UPDATE g5_business_propos set value = '4' where bo_idx = '{$_GET['us_idx']}'";
                sql_query($sql);
                
                $sql2 = " update g5_write_business set wr_8 = '3' where wr_id = '{$_GET['us_idx']}'";
                sql_query($sql2);
                alert('평가완료');
            }

        } else if($_GET['bo_idx'] == 3) {
            if($row2['value'] == 4 || $row2['value'] == 3){
                alert("이미 발표를 했습니다.");
            }else if($row2['wr_9'] == 0){
                $sql = " UPDATE g5_business_propos set value = '3' where bo_idx = '{$_GET['us_idx']}'";
                sql_query($sql);

                $sql2 = " update g5_write_business set wr_9 = '3' where wr_id = '{$_GET['us_idx']}'";
                sql_query($sql2);

                alert('평가완료'); 
            } else if($row1['wr_9'] == 1) {
                $sql = " UPDATE g5_business_propos set value = '4' where bo_idx = '{$_GET['us_idx']}'";
                sql_query($sql);
                
                $sql2 = " update g5_write_business set wr_9 = '3' where wr_id = '{$_GET['us_idx']}'";
                sql_query($sql2);
                alert('평가완료');
            }
        }

        
    }
}


?>
 