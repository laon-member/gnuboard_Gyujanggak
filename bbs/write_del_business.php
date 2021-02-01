<?php 
include_once('./_common.php');

sql_query("delete from g5_write_business where wr_id = '{$_GET['wr_id']}'");
$sql = " select * from g5_business_propos where bo_idx = '{$_GET['bo_idx']}'";
$result = sql_query($sql);
$row = sql_fetch_array($result);

for($i=0; $row = sql_fetch_array($result); $i++){
    sql_query("delete from report where business_idx = '{$row['idx']}'");
}

sql_query("delete from g5_business_propos where bo_idx = '{$_GET['wr_id']}'");

$sql = " select * from rater where business_idx = '{$_GET['bo_idx']}'";
$result = sql_query($sql);
$row = sql_fetch_array($result);

for($i=0; $row = sql_fetch_array($result); $i++){
    sql_query("delete from rater_value where rater_idx = '{$row['idx']}'");
}

sql_query("delete from rater where business_idx = '{$_GET['wr_id']}'");

alert("삭제 했습니다.", G5_BBS_URL.'/board.app.php?bo_table=business&bo_idx='.$_GET['bo_idx'].'&u_id=1');

?>