<?php
define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once(G5_THEME_PATH.'/head1.php');
?>

<div class="login_info">
    <a href="<?= G5_BBS_URL ?>/board.php?bo_table=business&bo_idx=1" class="login_info_user">
        <img src="<?=G5_THEME_URL ?>/img/user_icon.png" alt="user_icon">
        <p>지원자</p>    
    </a>
    <a href="<?= G5_BBS_URL ?>/board.rater.php?bo_table=qa&bo_idx=1" class="login_info_user">
        <img src="<?=G5_THEME_URL ?>/img/rater_icon.png" alt="rater_icon">
        <p>심사자</p>
    </a>
    <a href="<?= G5_BBS_URL ?>/board.app.php?bo_table=business&bo_idx=1&u_id=1" class="login_info_user">
        <img src="<?=G5_THEME_URL ?>/img/admin_icon.png" alt="admin_icon">
        <p>관리자</p>
    </a>
</div>
<?php
include_once(G5_THEME_PATH.'/tail1.php');
?>