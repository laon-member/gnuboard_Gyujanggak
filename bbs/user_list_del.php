<?php
include_once('./_common.php');

$sql4 = "select * from g5_business_propos where idx = '{$_GET['us_idx']}' ";
$result4 = sql_query($sql4);
$row4 = sql_fetch_array($result4);

$sql = "select * from rater where propos_idx = '{$_GET['us_idx']}' ";
$result = sql_query($sql);
$row = sql_fetch_array($result);


if($row4['idx'] == "") alert("없는 게시글입니다.");

if($row4['mb_id'] != $member['mb_id'] && $member['mb_level'] < 10) alert("지원한 당사자만 삭제 가능합니다.");


sql_query("delete from rater_value where rater_idx = '{$row['idx']}'");
sql_query("delete from rater where propos_idx = '{$_GET['us_idx']}'");

sql_query("delete from rater_board where propos_idx = '{$_GET['us_idx']}'");
sql_query("delete from report where business_idx = '{$_GET['us_idx']}'");
sql_query("delete from g5_business_propos where idx = '{$_GET['us_idx']}'");

alert("삭제 완료 했습니다.");
