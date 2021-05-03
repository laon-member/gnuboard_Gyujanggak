<?php
include_once "./_common.php";
$table = $_POST['tbl'];
$bo_idx = $_POST['bo_idx'];
$wr_idx = $_POST['wr_idx'];

$sql = "SELECT bo_title_idx FROM g5_business_propos WHERE `idx`='{$table}'";
$result = sql_query($sql);
$row=sql_fetch_array($result);

$sql = "SELECT idx FROM rater_category WHERE category_idx =  '{$row['bo_title_idx']}' and test_step = '{$bo_idx}'";
$result = sql_query($sql);
$row = sql_fetch_array($result);

$sql = "SELECT count(idx) as cnt FROM rater_fild WHERE test_fild_idx =  '{$row['idx']}'";
$result = sql_query($sql);
$row = sql_fetch_array($result);

$category_idx = $row['cnt'] +3;


$sql = "SELECT * FROM rater WHERE `business_idx`='{$wr_idx}' AND  test_id = '{$bo_idx}'";
$result = sql_query($sql);

for($i=0; $row=sql_fetch_array($result); $i++) {

    $sql2 = " select * from rater_value where rater_idx = '{$row['idx']}' AND report_idx = '{$table}' AND value = 2";
    $row2 = sql_fetch($sql2);
    
    if($row2['idx'] != ""){
        echo "<tr class='".$lt_class."tr_hover'>";
        echo "<td class='td_datetime td_center'>".$row['user_name']."</td>";
        
        if($bo_idx == 2){
            if($row2['test_fild_1'] != '') echo "<td class='td_datetime td_center'>".($row2['test_fild_1'] == 1 ? '지원' : '미지원')."</td>";
        } else {
            if($row2['test_fild_1'] != '') echo "<td class='td_datetime td_center'>".$row2['test_fild_1']."</td>";
            if($row2['test_fild_2'] != '') echo "<td class='td_datetime td_center'>".$row2['test_fild_2']."</td>";
            if($row2['test_fild_3'] != '') echo "<td class='td_datetime td_center'>".$row2['test_fild_3']."</td>";
            if($row2['test_fild_4'] != '') echo "<td class='td_datetime td_center'>".$row2['test_fild_4']."</td>";
            echo "<td class='td_datetime td_center'>".$row2['test_sum']."</td>";
        }
        // echo "<td class='td_datetime td_center'>".$row2['test_average']."</td>";
        echo "<td colspan='2' style='word-break: break-all;' class='td_title'>".$row2['test_opinion']."</td>";
        echo "</tr>";
    }
}

$sql = "SELECT * FROM rater WHERE `business_idx`='{$wr_idx}' AND  test_id = '{$bo_idx}'";
$result = sql_query($sql);
$row=sql_fetch_array($result);

if(!$row){
    echo '<tr><td colspan="'.$category_idx.'" class="empty_table">지원자가 없습니다.</td></tr>';
}