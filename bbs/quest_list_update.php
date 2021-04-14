<?php
include_once('./_common.php');


$row = sql_fetch(" select * from g5_business_propos where idx = '{$_POST['us_idx']}'");

$sql = " update g5_business_propos set quest_number = '{$_POST['number']}' where idx = '{$_POST['us_idx']}'";

sql_query($sql);

alert("과제번호 배정 완료");