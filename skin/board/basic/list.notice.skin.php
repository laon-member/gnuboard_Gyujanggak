<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once('./_common.php');

// 선택옵션으로 인해 셀합치기가 가변적으로 변함
$colspan = 5;

if ($is_checkbox) $colspan++;
if ($is_good) $colspan++;
if ($is_nogood) $colspan++;

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);


$sql = " select * from g5_write_business_title where bo_table = '{$_GET['bo_table']}'";
$result = sql_query($sql);

$sql1 = " SELECT COUNT(DISTINCT `wr_id`) AS `cnt` FROM g5_write_notice where notice_table = ".$_GET['bo_idx']."";
$row = sql_fetch($sql1);
$num = $row['cnt'];


$sql1 = " SELECT * FROM `g5_write_business_title` where bo_table = '{$_GET['bo_table']}'";
$result1 = sql_query($sql1);



if($board_user == 1){
    $board_user_num =9;
    $aside_nav_title = '자료실';
    
} else if($board_user == 2){
    $board_user_num =8;
    $aside_nav_title = '공지사항';
} else if($board_user == 3){
    $board_user_num =10;
    $aside_nav_title = '자료실';
}

?>
<!-- 게시판 목록 시작 { -->
<aside id="bo_side">
    <h2 class="aside_nav"><?= $aside_nav_title ?></h2>
    <?php 

        for($k=7; $row1=sql_fetch_array($result1); $k++) {
            if($k < $board_user_num){
                $class_get = $_GET['bo_idx'] == $row1['idx']?"aisde_click":"";
                echo '<a class="aside_nav '.$class_get.'" href="'.G5_BBS_URL .'/board.notice.php?bo_table=notice&bo_idx='.$k.'&page=1&bo_title='.$_GET['bo_title'].$admin_notice.'">'.$row1['title'].'</a>';
               
                if($_GET['bo_idx'] == $row1['idx']){
                    $category_title =  $row1['title']; 
                }
            }
        }
    ?>
</aside>
<div id="bo_list" >

   
    
    

    <!-- 게시판 페이지 정보 및 버튼 시작 { -->
    <div id="bo_btn_top">
    <h1 class="category_title"><?php
                echo $category_title;
             ?></h1>

        <ul class="btn_bo_user">
            <li>
            <?php
                    // $http_host = $_SERVER['HTTP_HOST'];
                    // $request_uri = $_SERVER['REQUEST_URI'];
                    // $url = 'http://' . $http_host . $request_uri;
                
                    // $url = preg_replace('#&page=[0-9]*#', '&page=1', $url);
                ?>
            <fieldset class="bo_sch_input">
                    <form name="fsearch" method="POST" >
                    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
                    <input type="hidden" name="sca" value="<?php echo $sca ?>">
                    <input type="hidden" name="sop" value="and">
                    <input type="hidden" name="sop" value="and">
                    <input type="hidden" name="bo_idx" value="<?= $_GET['bo_idx'] ?>">
                    <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
                    <select name="sfl" id="sfl">
                        <?php echo get_board_sfl_select_options($sfl); ?>
                    </select>
                    <div class="sch_bar">
                        <input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" required id="stx" class="sch_input" size="25" maxlength="20" placeholder=" 검색어를 입력해주세요">
                        <button type="submit" value="검색" class="sch_btn"><i class="fa fa-search" aria-hidden="true"></i><span class="sound_only">검색</span></button>
                    </div>
                    </form>
                </fieldset>
            </li>
        	<?php if ($is_admin == 'super') {  ?>
                <li>
                    <a href="<?= G5_BBS_URL ?>/write_notice.php?bo_table=notice&bo_idx=<?= $_GET['bo_idx'] ?>&bo_title=3&u_id=1" class="btn_b01 btn" title="글쓰기"><i class="fa fa-pencil" aria-hidden="true"></i><span class="sound_only">글쓰기</span></a>
                </li>
        	<?php }  ?>
        </ul>
    </div>
    <!-- } 게시판 페이지 정보 및 버튼 끝 -->
        	
    <div class="tbl_head01 tbl_wrap">
        <form name="fboardlist" id="fboardlist" action="<?php echo G5_BBS_URL; ?>/board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
        
        <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
        <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
        <input type="hidden" name="stx" value="<?php echo $stx ?>">
        <input type="hidden" name="spt" value="<?php echo $spt ?>">
        <input type="hidden" name="sca" value="<?php echo $sca ?>">
        <input type="hidden" name="sst" value="<?php echo $sst ?>">
        <input type="hidden" name="sod" value="<?php echo $sod ?>">
        <input type="hidden" name="page" value="1">
        <input type="hidden" name="sw" value="">



        <table>
        <caption><?php echo $board['bo_subject'] ?> 목록</caption>
        <thead>
        <tr>
            <th scope="col">번호</th>
            <th scope="col">제목</th>
            <th scope="col">첨부</th>
            <th scope="col">등록일</th>
            <th scope="col">조회</th>
        </tr>
        </thead>
        <tbody>
        <?php

        for ($i=0; $i<count($list); $i++) {
            
        	if ($i%2==0) $lt_class = "even";
            else $lt_class = "";
		?>
        <tr class="<?php if ($list[$i]['is_notice']) echo "bo_notice"; ?> <?php echo $lt_class ?> tr_hover">
            
            <td class="td_idx td_center">
            <?php
                echo $list[$i]['num'];
             ?>
            </td>

            <td class="td_title" style="padding-left:<?php echo $list[$i]['reply'] ? (strlen($list[$i]['wr_reply'])*10) : '0'; ?>px">
                <?php
                if ($is_category && $list[$i]['ca_name']) {
				?>
                <a href="<?php echo $list[$i]['ca_name_href'] ?>" class="bo_cate_link"><?php echo $list[$i]['ca_name'] ?></a>
                <?php } ?>
                <div class="bo_tit">
                    <a href="<?= G5_BBS_URL ?>/board.notice.php?bo_idx=<?= $_GET['bo_idx']; ?>&bo_table=notice&wr_id=<?php echo $list[$i]['wr_id'] ?>&bo_title=<?php echo $_GET['bo_title'] ?><?= $admin_notice ?>">
                        <?php echo $list[$i]['icon_reply'] ?>
                        <?php
                            if (isset($list[$i]['icon_secret'])) echo rtrim($list[$i]['icon_secret']);
                         ?>
                        <?php echo $list[$i]['wr_subject'] ?>
                    </a>
                    
                </div>
            </td>
            <td class="td_download td_center">
                <?php if ($list[$i]['wr_file'] > 0) { ?>
                    <i class="fa fa-download" aria-hidden="true"></i>
                    <?php } ?>
            </td>
            <td class="td_datetime td_center"><?php echo $list[$i]['datetime2'] ?></td>
            <td class="td_hit td_center"><?php echo $list[$i]['wr_hit'] ?></td>
           
            

        </tr>
        <?php } ?>
        <?php if (count($list) == 0) { echo '<tr><td colspan="6" class="empty_table">게시물이 없습니다.</td></tr>'; } ?>
        </tbody>
        </table>
    </form>

    </div>

	<!-- 페이지 -->

    <!-- 현재 URL 주소 -->
    <?php
        // $http_host = $_SERVER['HTTP_HOST'];
        // $request_uri = $_SERVER['REQUEST_URI'];
        // $url = 'http://' . $http_host . $request_uri;
        echo $url;
    ?>    
    
    <!-- 총 게시판 -->

    <?php echo get_paging('15', $page, $total_page, $url); ?>
	<!-- 페이지 -->
	
    

  
</div>

<?php if($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>
<?php } ?>

<?php if ($is_checkbox) { ?>
<script>
function all_checked(sw) {
    var f = document.fboardlist;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]")
            f.elements[i].checked = sw;
    }
}

function fboardlist_submit(f) {
    var chk_count = 0;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked)
            chk_count++;
    }

    if (!chk_count) {
        alert(document.pressed + "할 게시물을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택복사") {
        select_copy("copy");
        return;
    }

    if(document.pressed == "선택이동") {
        select_copy("move");
        return;
    }

    if(document.pressed == "선택삭제") {
        if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다\n\n답변글이 있는 게시글을 선택하신 경우\n답변글도 선택하셔야 게시글이 삭제됩니다."))
            return false;

        f.removeAttribute("target");
        f.action = g5_bbs_url+"/board_list_update.php";
    }

    return true;
}

// 선택한 게시물 복사 및 이동
function select_copy(sw) {
    var f = document.fboardlist;

    if (sw == "copy")
        str = "복사";
    else
        str = "이동";

    var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");

    f.sw.value = sw;
    f.target = "move";
    f.action = g5_bbs_url+"/move.php";
    f.submit();
}

// 게시판 리스트 관리자 옵션
jQuery(function($){
    $(".btn_more_opt.is_list_btn").on("click", function(e) {
        e.stopPropagation();
        $(".more_opt.is_list_btn").toggle();
    });
    $(document).on("click", function (e) {
        if(!$(e.target).closest('.is_list_btn').length) {
            $(".more_opt.is_list_btn").hide();
        }
    });

    // if(<?php echo $_GET['bo_idx'] == 1? true : false ?> ){
    //     alert('fdsa');
    // }

    // $('.aside_nav').click(function(){
    //     $('.aside_nav').removeClass('.aisde_click');
    //     $(this).addClass('.aisde_click');
    // });

});
</script>
<?php } ?>
<!-- } 게시판 목록 끝 -->
