<?php
include_once "./_common.php";
$table = $_POST['tbl'];
$wrid = $_POST['wrid'];
$wr_idx = $_POST['wr_idx'];

$sql = "SELECT * FROM rater WHERE `business_idx`='{$wr_idx}' AND  test_id = '{$wrid}' AND value = '2'";
$result = sql_query($sql);

for($i=0; $row=sql_fetch_array($result); $i++) {

    $sql2 = " select * from rater_value where rater_idx = '{$row['idx']}' AND report_idx = '{$table}'";
    $row2 = sql_fetch($sql2);

    if($row2['idx'] != ""){
        echo "<tr class='".$lt_class."tr_hover'>";
        echo "<td class='td_datetime td_center'>".$row['user_name']."</td>";
        echo "<td class='td_datetime td_center'>".$row2['test_user']."</td>";
        echo "<td class='td_datetime td_center'>".$row2['test_title']."</td>";
        echo "<td class='td_datetime td_center'>".$row2['test_plan']."</td>";
        echo "<td class='td_datetime td_center'>".$row2['test_sum']."</td>";
        echo "<td class='td_datetime td_center'>".$row2['test_average']."</td>";
        echo "<td class='td_datetime td_center'>".$row2['test_opinion']."</td>";
        echo "</tr>";
    } 
    
}