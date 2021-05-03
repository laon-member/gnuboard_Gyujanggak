<?php
include_once('./_common.php');


$g5['title'] = '평가 업로드';

$sql = "select * from g5_write_business where wr_id = '{$_GET['us_idx']}'";
$result = sql_query($sql);
$row=sql_fetch_array($result);

if($_GET['bo_idx'] == 1){
    $row_value = $row['value'];
} else if ($_GET['bo_idx'] == 2){
    $row_value = $row['wr_8'];
}else if ($_GET['bo_idx'] == 3){
    $row_value = $row['wr_9'];
}

if($_GET['bo_idx'] != 3 || $row['wr_title_idx'] != 3 || $row['wr_title_idx'] != 4 || $row['wr_title_idx'] != 5 || $row['wr_title_idx'] != 6){
    // 집중 클러스터, 중소규모 집담회, 한국학 학술대회, 신진학자 초청 교류 카테고리는
    // 결과보고서를 제출후 웹페이지에서 평가하는게 아닌 내부 오프라인 회의로 합격자 선발을 하기 때문에 심사위원 배정 건너뜀  
    if( $_GET['bo_idx'] != 1 || $row['wr_title_idx'] != 6){
        //신진학자 카테고리 는 지원신청후 따로 심사위원을 배정 안함
        if ($row_value == 0) alert("심사위원 의뢰를 먼저 진행해주세요"); 
    }
}
if($row_value == 1) alert("합격자를 먼저 선발 해주세요");
if($row_value == 3) alert("이미 발표를 했습니다.");

$sql1 = "select count(*) as cnt from g5_business_propos where bo_idx = '{$_GET['us_idx']}'";
$result1 = sql_query($sql1);
$row1=sql_fetch_array($result1);

if($row1['cnt'] > 0){
    if($_GET['bo_idx'] == 1){
        $sql = " UPDATE g5_business_propos set value = '3' where bo_idx = '{$_GET['us_idx']}' and value = '0'";
        sql_query($sql);

        $sql = " UPDATE g5_business_propos set value = '4' where bo_idx = '{$_GET['us_idx']}' and value = '1'";
        sql_query($sql);

        $sql2 = " update g5_write_business set value = '3' where wr_id = '{$_GET['us_idx']}'";
        sql_query($sql2);

        if($row['wr_title_idx'] != 1 && $row['wr_title_idx'] != 2){
            $sql = " UPDATE g5_business_propos set report_val_1 = '4' where bo_idx = '{$_GET['us_idx']}' and  value = '4'";
            echo $sql;
            sql_query($sql);
        }
    } else if($_GET['bo_idx'] == 2) {
        $sql = " UPDATE g5_business_propos set report_val_1 = '3' where bo_idx = '{$_GET['us_idx']}' and report_val_1 = '0'";
        sql_query($sql);

        $sql = " UPDATE g5_business_propos set report_val_1 = '4' where bo_idx = '{$_GET['us_idx']}' and report_val_1 = '1'";
        sql_query($sql);
        
        $sql2 = " update g5_write_business set wr_8 = '3' where wr_id = '{$_GET['us_idx']}'";
        sql_query($sql2);
    } else if($_GET['bo_idx'] == 3) {
        $sql = " UPDATE g5_business_propos set report_val_2 = '3' where bo_idx = '{$_GET['us_idx']}' and report_val_2 = '0'";
        sql_query($sql);

        $sql = " UPDATE g5_business_propos set report_val_2 = '4' where bo_idx = '{$_GET['us_idx']}' and report_val_2 = '1'";
        sql_query($sql);
        
        $sql2 = " update g5_write_business set wr_9 = '3' where wr_id = '{$_GET['us_idx']}'";
        sql_query($sql2);
    }
    alert('심사결과를 발표 했습니다.');
}
alert('심사결과를 발표하지 못 했습니다.');
?>
 