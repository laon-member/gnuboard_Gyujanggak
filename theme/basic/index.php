<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}
unset($_SESSION['FORM']);
unset($_SESSION['id']);

include_once(G5_THEME_PATH.'/head1.php');
?>


<div class="login_info">
    <a href="../bbs/board.php?bo_table=business&bo_idx=1" class="login_info_user">지원자</a>
    <a href="../bbs/board.rater.php?bo_table=qa&bo_idx=1" class="login_info_user">심사자</a>
    <a href="../bbs/board.php?bo_table=qa" class="login_info_user">관리자</a>
</div>




<?php

//echo poll('theme/basic'); // 설문조사, 테마의 스킨을 사용하려면 스킨을 theme/basic 과 같이 지정 
    
include_once(G5_THEME_PATH.'/tail.php');
?>