<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once(G5_THEME_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');
?>

<!-- 상단 시작 { -->
<div id="hd">
    <div id="hd_wrapper">
        <div id="logo">
            <a href="<?php echo G5_URL ?>">
                <img src="<?php echo G5_IMG_URL ?>/main_logo.png" alt="logo">
                <img src="<?php echo G5_IMG_URL ?>/main_logo_text.png" alt="logo_text">
                <!-- <p>21세기 신규장각 자료구축사업 <span>과제관리시스템</span></p>  -->
            </a>
        </div>
    </div>
</div>
<!-- } 상단 끝 -->

<hr>

<!-- 콘텐츠 시작 { -->
<div id="wrapper">
<img src="<?=G5_THEME_URL ?>/img/main_background.png" alt="user_icon" class="main_back">
<div class="main_back_filter"></div>
    <div id="container_wr">
   
    <div id="container_layout">
        

