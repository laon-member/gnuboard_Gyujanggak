<?php
include_once('./_common.php');

sql_query("delete from {$g5['board_file_table']} where bo_table = '{$_POST['sql_file_tabel']}' and wr_id = '{$_POST['sql_file_id']}' and bf_no = '{$_POST['sql_file_no']}' ");

$sql123 = " select * from {$g5['board_file_table']} where bo_table = '{$_POST['sql_file_tabel']}' and wr_id = '{$_POST['sql_file_id']}' ";
$result123 = sql_query($sql123);
for($i=0; $row123=sql_fetch_array($result123); $i++) {
    $sql1212 = " update {$g5['board_file_table']} set bf_no = '{$i}' where bo_table = '{$_POST['sql_file_tabel']}' and wr_id = '{$_POST['sql_file_id']}' and bf_no = '{$row123['bf_no']}' ";
    sql_query($sql1212);
}

?>
<script>
    $(function(){
        $("#<?= $_POST['sql_file_btn'] ?>").parent().remove();
    })
</script>