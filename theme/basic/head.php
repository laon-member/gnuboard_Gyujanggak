<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once('./_common.php');

session_start();


include_once(G5_THEME_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/latest.lib.php');
include_once(G5_LIB_PATH.'/outlogin.lib.php');
include_once(G5_LIB_PATH.'/poll.lib.php');
include_once(G5_LIB_PATH.'/visit.lib.php');
include_once(G5_LIB_PATH.'/connect.lib.php');
include_once(G5_LIB_PATH.'/popular.lib.php');

if($_GET['no_alt'] == 'yes'){
    $_SESSION['notice'] = "header_esc_end";
}

?>

<!-- 상단 시작 { -->
<div id="hd">
    <div class="hd_wrapper_menu">
        <ul class="hd_login layout">    
            <li class="text_float_left" style="float:left; cursor: context-menu;">
            <?php 
                if($board_user == 1) echo "지원자 페이지";
                if($board_user == 2) echo "심사자 페이지";
                if($board_user == 3) echo "관리자 페이지";
            ?>
            </li>    
            <?php if ($is_member) {  ?>
            <li style="cursor: context-menu;"><?php echo $member['mb_name']; ?>님</li>
            <li><a href="<?php echo G5_BBS_URL ?>/mypage_form.php?page=1">마이페이지</a></li>
            <?php if ($member['mb_level'] == 10 && $is_admin =="super") { ?><li><li><a href="../adm/config_form.php">관리자</a></li><?php } ?>
            <li><a href="<?php echo G5_BBS_URL ?>/logout.php">로그아웃</a></li>
                
            <?php } else {  ?>
            <li><a href="<?php echo G5_BBS_URL ?>/login.php">로그인</a></li>
            <?php }  ?>
            
            
        </ul>
    </div>

    <div id="hd_wrapper_contianer">
        <div id="hd_wrapper">
            <div class="board_nav_container">
                <a href="<?php echo G5_URL ?>"><img src="<?php echo G5_IMG_URL ?>/logo.png" alt="<?php echo $config['cf_title']; ?>"></a>
                <ul class="board_nav">
                    <?php if($board_user == 1 && $_GET['u_id'] == ""){ ?>
                    <?php  
                        if($member['mb_level'] > 2 && $member['mb_level'] < 10 ){
                            alert('심사자는 접근이 불가합니다.', G5_URL);
                        }    
                        ?>
                        <li class="board_nav_list board_nav_list_hover <?= $board_border ?>">
                            <a href="<?= G5_BBS_URL ?>/board.php?bo_table=business&bo_idx=1"  >사업공고</a>
                            <ul class="sub_menu">
                                <li><a href="<?= G5_BBS_URL ?>/board.php?bo_table=business&bo_idx=1">한국학 연구용역</a> </li>
                                <li><a href="<?= G5_BBS_URL ?>/board.php?bo_table=business&bo_idx=2">한국학 저술지원</a></li>
                                <li><a href="<?= G5_BBS_URL ?>/board.php?bo_table=business&bo_idx=3">집중 클러스터</a></li>
                                <li><a href="<?= G5_BBS_URL ?>/board.php?bo_table=business&bo_idx=4">중소규모 집담회</a></li>
                                <li><a href="<?= G5_BBS_URL ?>/board.php?bo_table=business&bo_idx=5">한국학 학술대회</a></li>
                                <li><a href="<?= G5_BBS_URL ?>/board.php?bo_table=business&bo_idx=6">신진학자 초청 초류</a></li>
                            </ul>
                        </li>
                        <li class="board_nav_list board_nav_list_hover <?= $board_value_border ?>">
                            <a href="<?= G5_BBS_URL ?>/board.value.php?bo_table=business&bo_idx=7" class="">지원결과 확인</a>
                            <ul class="sub_menu">
                                <li><a href="<?= G5_BBS_URL ?>/board.value.php?bo_table=business&bo_idx=7">지원결과 확인</a></li>
                            </ul>
                        </li>
                        <li class="board_nav_list board_nav_list_hover <?= $board_report_border ?>" >
                            <a href="<?= G5_BBS_URL ?>/board.report.php?bo_table=business&bo_idx=1" class=" ">보고서 제출</a>
                            <ul class="sub_menu">
                                <li><a href="<?= G5_BBS_URL ?>/board.report.php?bo_table=business&bo_idx=1">중간보고서</a></li>
                                <li><a href="<?= G5_BBS_URL ?>/board.report.php?bo_table=business&bo_idx=2">결과(연차)보고서</a></li>
                            </ul>
                        </li>
                        <li class="board_nav_list board_nav_list_hover <?= $board_notice_border ?>">
                            <a href="<?= G5_BBS_URL ?>/board.notice.php?bo_table=notice&bo_idx=7&bo_title=1" class=" <?= $board_notice_border ?>" >자료실</a>
                            <ul class="sub_menu">
                                <li><a href="<?= G5_BBS_URL ?>/board.notice.php?bo_table=notice&bo_idx=7&bo_title=1">공지사항</a></li>
                                <li><a href="<?= G5_BBS_URL ?>/board.notice.php?bo_table=notice&bo_idx=8&bo_title=1">서식 다운로드</a></li>
                            </ul>
                        </li>

                    <?php } ?>
                    
                    <?php if($board_user == 2) { ?>
                        <?php 
                            if (!$is_member)
                                goto_url(G5_BBS_URL."/login.php");
                
                            if($member['mb_level'] < 5){
                                alert('심사자이상만 접근 가능합니다.', G5_URL);
                            }    
                        ?>
                        <li class="board_nav_list board_nav_list_hover <?= $board_rater_border ?>">
                            <a href="<?= G5_BBS_URL ?>/board.rater.php?bo_table=qa&bo_idx=1" class=" " >심사 관리</a>
                            <ul class="sub_menu">
                                <li><a href="<?= G5_BBS_URL ?>/board.rater.php?bo_table=qa&bo_idx=1">지원자 선발</a></li>
                                <li><a href="<?= G5_BBS_URL ?>/board.rater.php?bo_table=qa&bo_idx=2">중간보고서</a></li>
                                <li><a href="<?= G5_BBS_URL ?>/board.rater.php?bo_table=qa&bo_idx=3">결과(연차)보고서</a></li>
                            </ul>
                        </li>
                        <li class="board_nav_list board_nav_list_hover <?= $board_notice_border ?>">
                            <a href="<?= G5_BBS_URL ?>/board.notice.php?bo_table=notice&bo_idx=7&bo_title=2" class=" ">공지사항</a>
                            <ul class="sub_menu">
                                <li><a href="<?= G5_BBS_URL ?>/board.notice.php?bo_table=notice&bo_idx=7&bo_title=2">공지사항</a></li>
                            </ul>
                        </li>
                    <?php } ?>


                    <?php if($board_user == 3 && $_GET['u_id'] == "1") { ?>
                    <?php
                        if (!$is_member)
                            goto_url(G5_BBS_URL."/login.php");

                        if($member['mb_level'] < 10){
                            alert('관리자 이상만 접근 가능합니다.', G5_URL);
                        }
                    ?>
                        <li class="board_nav_list board_nav_list_hover <?= $board_app_border ?>">
                            <a href="<?= G5_BBS_URL ?>/board.app.php?bo_table=business&bo_idx=1&u_id=1">사업공고 관리</a>
                            <ul class="sub_menu">
                                <li><a href="<?= G5_BBS_URL ?>/board.app.php?bo_table=business&bo_idx=1&u_id=1">한국학 연구용역</a> </li>
                                <li><a href="<?= G5_BBS_URL ?>/board.app.php?bo_table=business&bo_idx=2&u_id=1">한국학 저술지원</a></li>
                                <li><a href="<?= G5_BBS_URL ?>/board.app.php?bo_table=business&bo_idx=3&u_id=1">집중 클러스터</a></li>
                                <li><a href="<?= G5_BBS_URL ?>/board.app.php?bo_table=business&bo_idx=4&u_id=1">중소규모 집담회</a></li>
                                <li><a href="<?= G5_BBS_URL ?>/board.app.php?bo_table=business&bo_idx=5&u_id=1">한국학 학술대회</a></li>
                                <li><a href="<?= G5_BBS_URL ?>/board.app.php?bo_table=business&bo_idx=6&u_id=1">신진학자 초청 초류</a></li>
                            </ul>
                        </li>
                        <li class="board_nav_list board_nav_list_hover <?= $board_rater_border ?>">
                            <a href="<?= G5_BBS_URL ?>/board.rater.admin.php?bo_table=qa&bo_idx=1&u_id=1">심사 관리</a>
                            <ul class="sub_menu">
                                <li><a href="<?= G5_BBS_URL ?>/board.rater.admin.php?bo_table=qa&bo_idx=1&u_id=1">지원자 선발</a></li>
                                <li><a href="<?= G5_BBS_URL ?>/board.rater.admin.php?bo_table=qa&bo_idx=2&u_id=1">중간보고서</a></li>
                                <li><a href="<?= G5_BBS_URL ?>/board.rater.admin.php?bo_table=qa&bo_idx=3&u_id=1">결과(연차)보고서</a></li>
                            </ul>
                        </li>
                        <li class="board_nav_list board_nav_list_hover <?= $board_rater_admin ?>">
                            <a href="<?= G5_BBS_URL ?>/board_admin.php?bo_table=business&bo_idx=1&u_id=1">보고서 관리</a>
                            <ul class="sub_menu">
                                <li><a href="<?= G5_BBS_URL ?>/board_admin.php?bo_table=business&bo_idx=1&u_id=1">한국학 연구용역</a> </li>
                                <li><a href="<?= G5_BBS_URL ?>/board_admin.php?bo_table=business&bo_idx=2&u_id=1">한국학 저술지원</a></li>
                                <li><a href="<?= G5_BBS_URL ?>/board_admin.php?bo_table=business&bo_idx=3&u_id=1">집중 클러스터</a></li>
                                <li><a href="<?= G5_BBS_URL ?>/board_admin.php?bo_table=business&bo_idx=4&u_id=1">중소규모 집담회</a></li>
                                <li><a href="<?= G5_BBS_URL ?>/board_admin.php?bo_table=business&bo_idx=5&u_id=1">한국학 학술대회</a></li>
                                <li><a href="<?= G5_BBS_URL ?>/board_admin.php?bo_table=business&bo_idx=6&u_id=1">신진학자 초청 초류</a></li>
                            </ul>
                        </li>
                        <li class="board_nav_list board_nav_list_hover <?= $board_notice_border ?>">
                            <a href="<?= G5_BBS_URL ?>/board.notice.php?bo_table=notice&bo_idx=7&bo_title=3&u_id=1">자료실</a>
                            <ul class="sub_menu">
                                <li><a href="<?= G5_BBS_URL ?>/board.notice.php?bo_table=notice&bo_idx=7&bo_title=3&u_id=1">공지사항</a></li>
                                <li><a href="<?= G5_BBS_URL ?>/board.notice.php?bo_table=notice&bo_idx=8&bo_title=3&u_id=1">서식 다운로드</a></li>
                                <li><a href="<?= G5_BBS_URL ?>/board.notice.php?bo_table=notice&bo_idx=9&bo_title=3&u_id=1">지원실 파일 공유</a></li>
                            </ul>
                        </li>
                    <?php }  ?>
                    
                    <li class="board_nav_list board_nav_list_menu">
                        <div class="menu slide_up"> 
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </li>
                    <div class="board_nav_list_menu_back"></div>
                </ul>
            </div>
        </div>
    </div>

    <div class="header_notice_back <?=  $_SESSION['notice'] ?>">
        <div class="header_notice">

        <?php
            $sql1 = " SELECT * FROM g5_write_notice where notice_table = 7 order by wr_id desc limit 0, 5 ";
            $result1 = sql_query($sql1);

            if($board_user == 3) {
                $u_id = "&u_id=1";
            }
        ?>
            <p>공지사항 </p>
            <div class="notice_container">
                <ul class="header_notice_nav">
                    <?php for($j=1; $row=sql_fetch_array($result1); $j++) { ?>
                        <li class="header_notice_list header_notice_list<?= $j ?>">
                            <a href="<?= G5_BBS_URL ?>/board.notice.php?bo_idx=<?= $row['notice_table']; ?>&bo_table=notice&wr_id=<?= $row['wr_id'] ;?>&bo_title=<?php echo $board_user; echo $u_id; ?>"><?= $row['wr_subject']; ?></a>
                        </li>
                    <?php } ?>
                    
                </ul>
            </div>
            <?php
                $http_host = $_SERVER['HTTP_HOST'];
                $request_uri = $_SERVER['REQUEST_URI'];
                $url = 'http://' . $http_host . $request_uri;
                $url .= '&no_alt=yes';
            ?>
            <a href="<?= $url ?>" class="header_esc"><img src="<?php echo G5_IMG_URL ?>/x.png" alt="header_esc"></a>

        </div>
    </div>

    <script>
    
        


    jQuery(function($){

        function slideMenu(){
            $('.header_notice_nav').animate({'margin-top':'-70px'}, 500)

            setTimeout(() => {
                var clone = "";
                clone = $('.header_notice_list:first-child').clone();
                $(".header_notice_nav").append(clone);
                $('.header_notice_list:first-child').remove();
                $('.header_notice_nav').css({'margin-top':'0px'})
            }, 1000);
        }

        setInterval(slideMenu, 2000);
        
        var open = true;

        $('.board_nav_list_menu').on('click', function(){
            
            if(open){
                open = false;
                if($(this).attr('id') != 'slide'){
                    $(this).attr('id', 'slide');
                    $('.sub_menu').css({'height':'300px'});
                    $('.sub_menu').slideDown(400, function(){
                        open = true;
                    });
                    $('.board_nav_list').removeClass("board_nav_list_hover");

                    $('.menu span:nth-child(1)').css({'left':'50%', 'top':'50%','transform':'translate(-50%, -50%) rotate(45deg)'});
                    $('.menu span:nth-child(2)').css({'display':'none'});
                    $('.menu span:nth-child(3)').css({'left':'50%', 'top':'50%','transform':'translate(-50%, -50%) rotate(-45deg)'});
                } else {
                    $(this).removeAttr('id', 'slide');
                    // $('.sub_menu').css({'height':'0px'});
                    $('.sub_menu').slideUp(400, function(){
                        open = true;
                    });
                    $('.board_nav_list').addClass("board_nav_list_hover");
                    

                    $('.menu span:nth-child(1)').css({'left':'50%', 'top':'5px','transform':'translateX(-50%) rotate(0)'});
                    $('.menu span:nth-child(2)').css({'left':'50%', 'top':'50%','transform':'translate(-50%, -50%) rotate(0)','display':'block'});
                    $('.menu span:nth-child(3)').css({'left':'50%', 'top':'22px','transform':'translateX(-50%) rotate(0)'});
                }
            }
          
        })
        
        // $('.board_nav_list_hover').hover(function(){
        //     $(this).find('.sub_menu').off('slideToggle');
            
        //     if($(".board_nav_list_hover").is(".board_nav_list_hover")){
        //         $(this).find('.sub_menu').slideToggle();
        //     }
        // }); 
        
    });
    </script>
</div>

        

<!-- } 상단 끝 -->


<hr>

<!-- 콘텐츠 시작 { -->
<div id="wrapper">
    <div id="container_wr">
   
    <div id="container">
        

