<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/head.php');
    return;
}

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
    <h1 id="hd_h1"><?php echo $g5['title'] ?></h1>
    <div id="skip_to_container"><a href="#container">본문 바로가기</a></div>

    <?php
    if(defined('_INDEX_')) { // index에서만 실행
        include G5_BBS_PATH.'/newwin.inc.php'; // 팝업레이어
    }
    ?>

    <div id="hd_wrapper">

        <div id="logo">
            <a href="<?php echo G5_URL ?>"><img src="<?php echo G5_IMG_URL ?>/logo.png" alt="<?php echo $config['cf_title']; ?>"></a>
        </div>
    
        <ul class="hd_login">        
            <?php if ($is_member) {  ?>
            <li><a href=""><?php echo $member['mb_name']; ?>님</a></li>
            <li><a href="<?php echo G5_BBS_URL ?>/logout.php">로그아웃</a></li>
            <?php //if ($is_admin) {  ?>
            <!-- <li class="tnb_admin"><a href="<?php echo correct_goto_url(G5_ADMIN_URL); ?>">관리자</a></li> -->
            <?php //}  ?>
            <?php } else {  ?>
            <li><a href="<?php echo G5_BBS_URL ?>/login.php">로그인</a></li>
            <?php }  ?>
        </ul>
    </div>
    <div>
        <ul class="board_nav">
            <?php if($user_level1 == 10){ ?>
                <li class="board_nav_list"><a href="">신청서관리</a></li>
                <li class="board_nav_list"><a href="">심사 관리</a></li>
                <li class="board_nav_list"><a href="">보고서 관리</a></li>
                <li class="board_nav_list"><a href="">자료실</a></li>
            <?php } else if($user_level1 == 8) { ?>
                <li class="board_nav_list"><a href="">심사관리</a></li>
                <li class="board_nav_list"><a href="">공지사항</a></li>
            <?php } else { ?>
                <li class="board_nav_list"><a href="../bbs/board.php?bo_table=business&bo_idx=1">사업공고</a></li>
                <li class="board_nav_list"><a href="../bbs/board.report.php?bo_table=business&bo_idx=1">보고서 제출</a></li>
                <li class="board_nav_list"><a href="">지원결과 확인</a></li>
                <li class="board_nav_list"><a href="../bbs/board.notice.php?bo_table=notice&bo_idx=1">자료실</a></li>
            <?php } ?>
            
            
            
        </ul>
    </div>
    <div class="header_notice_back">
        <div class="header_notice">
            <p>공지사항</p>
            <p>공지사항 제목</p>
            <p>X</p>
        </div>
    </div>
</div>
<!-- } 상단 끝 -->


<hr>

<!-- 콘텐츠 시작 { -->
<div id="wrapper">
    <div id="container_wr">
   
    <div id="container">
        

