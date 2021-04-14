<?php
include_once('./_common.php');


if($_POST['value_id'] == 1){
    $DateTime = $_POST['add_date'].' '.$_POST['add_time'];

    // 추가
    $row22 = sql_fetch(" select * from add_propos where business_idx = '{$_POST['business_idx']}' and mb_id = '{$_POST['member_id']}'");

   if($row22 == ""){
       // insert
       $sql = " insert into add_propos
                set business_idx = '{$_POST['business_idx']}',
                mb_id = '{$_POST['member_id']}',
                date = '$DateTime'";

       sql_query($sql);

       alert('추가 지원이 가능합니다.');
   } else {
       //update
       $sql = "update add_propos set date = '$DateTime' where mb_id = '{$_POST['member_id']}' and business_idx = '{$_POST['business_idx']}'";

       sql_query($sql);

       alert('추가 지원이 가능합니다.');
   }

} else if ($_POST['value_id'] == 2){
    //삭제
    $sql = "delete from add_propos where mb_id = '{$_POST['member_id']}' and business_idx = '{$_POST['business_idx']}'";

    sql_query($sql);

    alert('삭제했습니다.');
    
}
?>