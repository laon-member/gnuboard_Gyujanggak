<?php 
include_once('./_common.php');

sql_query("delete from g5_write_notice where wr_id = '{$_GET['wr_id']}'");


alert("삭제 했습니다.", G5_BBS_URL.'/board.notice.php?bo_table=notice&bo_idx='.$_GET['bo_idx'].'&bo_title=3&u_id=1');

?>