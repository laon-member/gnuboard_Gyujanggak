<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once('./_common.php');

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

<?php echo $board_user; ?>
    <div id="hd_wrapper">

        <div id="logo">
            <a href="<?php echo G5_URL ?>"><img src="<?php echo G5_IMG_URL ?>/logo.png" alt="<?php echo $config['cf_title']; ?>"></a>
        </div>
    
        <ul class="hd_login">        
            <?php if ($is_member) {  ?>
            <li><a href=""><?php echo $member['mb_name']; ?>님</a></li>
            <li><a href="<?php echo G5_BBS_URL ?>/mypage_form.php?page=1">마이페이지</a></li>
            <?php if ($member['mb_level'] == 10) { ?><li><li><a href="../adm/member_list.php">관리자(원본)</a></li><?php } ?>
            <?php if ($member['mb_level'] == 10) { ?><li><li><a href="../adm/member_list copy.php">관리자</a></li><?php } ?>
            <li><a href="<?php echo G5_BBS_URL ?>/logout.php">로그아웃</a></li>
            	
            <?php } else {  ?>
            <li><a href="<?php echo G5_BBS_URL ?>/login.php">로그인</a></li>
            <?php }  ?>
            
            
        </ul>
    </div>
    <div class="board_nav_container">
        <ul class="board_nav">
            <?php if($board_user == 1 && $_GET['u_id'] == ""){ ?>
            <?php  
                if($member['mb_level'] > 2 && $member['mb_level'] < 10 ){
                    alert('심사자는 접근이 불가합니다.');
                }    
                ?>
                <li class="board_nav_list ">
                    <a href="<?= G5_BBS_URL ?>/board.php?bo_table=business&bo_idx=1" class="<?= $board_border ?> " style="<?= $user == 1? 'border-bottom: 2px solid black;': ''?>">사업공고</a>
                    <ul class="sub_menu">
                        <li><a href="<?= G5_BBS_URL ?>/board.php?bo_table=business&bo_idx=1">한국학 연구용역</a> </li>
                        <li><a href="<?= G5_BBS_URL ?>/board.php?bo_table=business&bo_idx=2">한국학 저술지원</a></li>
                        <li><a href="<?= G5_BBS_URL ?>/board.php?bo_table=business&bo_idx=3">집중 클러스터</a></li>
                        <li><a href="<?= G5_BBS_URL ?>/board.php?bo_table=business&bo_idx=4">중소규모 집담회</a></li>
                        <li><a href="<?= G5_BBS_URL ?>/board.php?bo_table=business&bo_idx=5">한국학 학술대회</a></li>
                        <li><a href="<?= G5_BBS_URL ?>/board.php?bo_table=business&bo_idx=6">신진학자 초청 초류</a></li>
                    </ul>
                </li>
                <li class="board_nav_list ">
                    <a href="<?= G5_BBS_URL ?>/board.value.php?bo_table=business&bo_idx=7" class="<?= $board_value_border ?>" style="<?= $user == 3? 'border-bottom: 2px solid black;': ''?>">지원결과 확인</a>
                    <ul class="sub_menu">
                        <li><a href="<?= G5_BBS_URL ?>/board.value.php?bo_table=business&bo_idx=7">지원결과 확인</a></li>
                    </ul>
                </li>
                <li class="board_nav_list">
                    <a href="<?= G5_BBS_URL ?>/board.report.php?bo_table=business&bo_idx=1" class=" <?= $board_report_border ?>" style="<?= $user == 2? 'border-bottom: 2px solid black;': ''?>">보고서 제출</a>
                    <ul class="sub_menu">
                        <li><a href="<?= G5_BBS_URL ?>/board.report.php?bo_table=business&bo_idx=1">중간보고서</a></li>
                        <li><a href="<?= G5_BBS_URL ?>/board.report.php?bo_table=business&bo_idx=2">결과(연차)보고서</a></li>
                    </ul>
                </li>
                <li class="board_nav_list">
                    <a href="<?= G5_BBS_URL ?>/board.notice.php?bo_table=notice&bo_idx=7&bo_title=1" class=" <?= $board_notice_border ?>" style="<?= $user == 4? 'border-bottom: 2px solid black;': ''?>" >자료실</a>
                    <ul class="sub_menu">
                        <li><a href="<?= G5_BBS_URL ?>/board.notice.php?bo_table=notice&bo_idx=7&bo_title=1">공지사항</a></li>
                        <li><a href="<?= G5_BBS_URL ?>/board.notice.php?bo_table=notice&bo_idx=8&bo_title=1">서식 다운로드</a></li>
                    </ul>
                </li>

            <?php } ?>
            
             <?php if($board_user == 2) { ?>
                <?php 
                    if (!$is_member)
                        alert('로그인 후 이용하여 주십시오.', G5_BBS_URL."/login.php");
        
                    if($member['mb_level'] < 5){
                        alert('심사자이상만 접근 가능합니다.');
                    }    
                ?>
                <li class="board_nav_list">
                    <a href="<?= G5_BBS_URL ?>/board.rater.php?bo_table=qa&bo_idx=1" class=" <?= $board_rater_border ?>" style="<?= $rater == 1? 'border-bottom: 2px solid black;': ''?>">심사관리</a>
                    <ul class="sub_menu">
                        <li><a href="<?= G5_BBS_URL ?>/board.rater.php?bo_table=qa&bo_idx=1">지원자 선발</a></li>
                        <li><a href="<?= G5_BBS_URL ?>/board.rater.php?bo_table=qa&bo_idx=2">중간보고서</a></li>
                        <li><a href="<?= G5_BBS_URL ?>/board.rater.php?bo_table=qa&bo_idx=3">결과(연차)보고서</a></li>
                    </ul>
                </li>
                <li class="board_nav_list">
                    <a href="<?= G5_BBS_URL ?>/board.notice.php?bo_table=notice&bo_idx=7&bo_title=2" class=" <?= $board_notice_border ?>" style="<?= $rater == 2? 'border-bottom: 2px solid black;': ''?>" >공지사항</a>
                    <ul class="sub_menu">
                        <li><a href="/bbs/board.notice.php?bo_table=notice&bo_idx=7&bo_title=2">공지사항</a></li>
                    </ul>
                </li>
            <?php } ?>


            <?php if($board_user == 3 && $_GET['u_id'] == "1") { ?>
            <?php
                if (!$is_member)
                    alert('로그인 후 이용하여 주십시오.', G5_BBS_URL."/login.php");

                if($member['mb_level'] < 10){
                    alert('관리자이상만 접근 가능합니다.');
                }
            ?>
                <li class="board_nav_list">
                    <a href="<?= G5_BBS_URL ?>/board.app.php?bo_table=business&bo_idx=1&u_id=1"  style="<?= $admin == 1? 'border-bottom: 2px solid black;': ''?>">신청서관리</a>
                    <ul class="sub_menu">
                        <li><a href="<?= G5_BBS_URL ?>/board.app.php?bo_table=business&bo_idx=1&u_id=1">한국학 연구용역</a> </li>
                        <li><a href="<?= G5_BBS_URL ?>/board.app.php?bo_table=business&bo_idx=2&u_id=1">한국학 저술지원</a></li>
                        <li><a href="<?= G5_BBS_URL ?>/board.app.php?bo_table=business&bo_idx=3&u_id=1">집중 클러스터</a></li>
                        <li><a href="<?= G5_BBS_URL ?>/board.app.php?bo_table=business&bo_idx=4&u_id=1">중소규모 집담회</a></li>
                        <li><a href="<?= G5_BBS_URL ?>/board.app.php?bo_table=business&bo_idx=5&u_id=1">한국학 학술대회</a></li>
                        <li><a href="<?= G5_BBS_URL ?>/board.app.php?bo_table=business&bo_idx=6&u_id=1">신진학자 초청 초류</a></li>
                    </ul>
                </li>
                <li class="board_nav_list">
                    <a href="<?= G5_BBS_URL ?>/board.rater.admin.php?bo_table=qa&bo_idx=1&u_id=1" style="<?= $admin == 2? 'border-bottom: 2px solid black;': ''?>">심사 관리</a>
                    <ul class="sub_menu">
                        <li><a href="<?= G5_BBS_URL ?>/board.rater.admin.php?bo_table=qa&bo_idx=1&u_id=1">지원자 선발</a></li>
                        <li><a href="<?= G5_BBS_URL ?>/board.rater.admin.php?bo_table=qa&bo_idx=2&u_id=1">중간보고서</a></li>
                        <li><a href="<?= G5_BBS_URL ?>/board.rater.admin.php?bo_table=qa&bo_idx=3&u_id=1">결과(연차)보고서</a></li>
                    </ul>
                </li>
                <li class="board_nav_list">
                    <a href="<?= G5_BBS_URL ?>/board_admin.php?bo_table=business&bo_idx=1&u_id=1" style="<?= $admin == 3? 'border-bottom: 2px solid black;': ''?>">보고서 관리</a>
                    <ul class="sub_menu">
                        <li><a href="<?= G5_BBS_URL ?>/board_admin.php?bo_table=business&bo_idx=1&u_id=1">한국학 연구용역</a> </li>
                        <li><a href="<?= G5_BBS_URL ?>/board_admin.php?bo_table=business&bo_idx=2&u_id=1">한국학 저술지원</a></li>
                        <li><a href="<?= G5_BBS_URL ?>/board_admin.php?bo_table=business&bo_idx=3&u_id=1">집중 클러스터</a></li>
                        <li><a href="<?= G5_BBS_URL ?>/board_admin.php?bo_table=business&bo_idx=4&u_id=1">중소규모 집담회</a></li>
                        <li><a href="<?= G5_BBS_URL ?>/board_admin.php?bo_table=business&bo_idx=5&u_id=1">한국학 학술대회</a></li>
                        <li><a href="<?= G5_BBS_URL ?>/board_admin.php?bo_table=business&bo_idx=6&u_id=1">신진학자 초청 초류</a></li>
                    </ul>
                </li>
                <li class="board_nav_list">
                    <a href="<?= G5_BBS_URL ?>/board.notice.php?bo_table=notice&bo_idx=7&bo_title=3&u_id=1" style="<?= $admin == 4? 'border-bottom: 2px solid black;': ''?>">자료실</a>
                    <ul class="sub_menu">
                        <li><a href="<?= G5_BBS_URL ?>/board.notice.php?bo_table=notice&bo_idx=7&bo_title=3&u_id=1">공지사항</a></li>
                        <li><a href="<?= G5_BBS_URL ?>/board.notice.php?bo_table=notice&bo_idx=8&bo_title=3&u_id=1">서식 다운로드</a></li>
                        <li><a href="<?= G5_BBS_URL ?>/board.notice.php?bo_table=notice&bo_idx=9&bo_title=3&u_id=1">지원실 파일 공유</a></li>
                    </ul>
                </li>
            <?php }  ?>
            
            <li class="board_nav_list board_nav_list_menu" style="<?= $admin == 1? 'border-bottom: 2px solid black;': ''?>">
                <div class="menu slide_up"> 
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </li>
            <div class="board_nav_list_menu_back"></div>
        </ul>
    </div>
    <div class="header_notice_back">
        <div class="header_notice">

        <?php
            $sql1 = " SELECT * FROM g5_write_notice order by wr_id desc limit 0, 5 ";
            $result1 = sql_query($sql1);
        ?>
            <p>공지사항</p>
            <div class="notice_container">
                <ul class="header_notice_nav">
                    <?php for($j=1; $row=sql_fetch_array($result1); $j++) { ?>
                        <li class="header_notice_list">
                            <a href="http://localhost/bbs/board.notice.php?bo_table=notice&bo_titile=<?= $_GET['bo_title'] ?>&wr_id=<?= $row['wr_id'] ;?>"><?= $row['wr_subject']; ?></a>
                        </li>
                    <?php } ?>
                    
                </ul>
            </div>
            <p class="header_esc">X</p>
        </div>
    </div>
    <style>
        #hd{position: relative;}
        .header_notice_back{position: absolute;top: 100%;width: 100%; }
        .header_notice_nav, .header_notice_list{list-style:none; height: 50px; padding:15px 0;}
        .notice_container{overflow:hidden;}
        .header_notice_nav{ } /* slide를 8초동안 진행하며 무한반복 함 */
        @keyframes slide {
        0% {margin-top:0;} /* 0 ~ 10  : 정지 */
        10% {margin-top:0;} /* 10 ~ 25 : 변이 */
        20% {margin-top:-100%;} /* 25 ~ 35 : 정지 */
        30% {margin-top:-100%;} /* 35 ~ 50 : 변이 */
        40% {margin-top:-200%;}
        50% {margin-top:-200%;}
        60% {margin-top:-300%;}
        70% {margin-top:-400%;}
        80% {margin-top:-500%;}
        90% {margin-top:-500%;}
        100% {margin-top:0;}
        }
    </style>
    <script>
        jQuery(function($){
        // 게시판 검색
        
        $('.header_esc').click(function(){
            $('.header_notice_back').hide();
        });

        
        $('.board_nav_list_menu').on('click', function(){

            if($(this).attr('id') != 'slide'){
                $(this).attr('id', 'slide');
                $('.sub_menu').slideDown(500); 
                $('.board_nav_list_menu_back').css({'display':'block'});
            } else {
                $(this).removeAttr('id');
                $('.sub_menu').slideUp(500);
                $('.board_nav_list_menu_back').css({'display':'none'});
            }

        })
        $('.board_nav_list').hover(function(){
                $(this).find('.sub_menu').slideToggle();
            }); 

        $('#showDatesCheckbox').click(function(){
            $('#ajaxgif').fadeIn();
            var table = $('#planningViewTable').find('tr');
            if ($('#showDatesCheckbox').is(':checked')) {
                table.find('.textDate').stop().animate({
                    "opacity": 1
                }, 1000);
                table.find('.inlineTextDate').stop().animate({
                    "opacity": 1
                }, 1000);
            }
            else {
                table.find('.textDate').stop().animate({
                    "opacity": 0
                }, 1000);
                table.find('.inlineTextDate').stop().animate({
                    "opacity": 0
                }, 1000);
            };$('#ajaxgif').fadeOut();
        });
        
    });
    </script>
</div>

        

<!-- } 상단 끝 -->


<hr>

<!-- 콘텐츠 시작 { -->
<div id="wrapper">
    <div id="container_wr">
   
    <div id="container">
        

