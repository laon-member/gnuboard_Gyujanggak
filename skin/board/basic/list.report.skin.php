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

  




?>
<!-- 게시판 목록 시작 { -->
<aside id="bo_side">
    <h2 class="aside_nav">보고서 제출</h2>
    <?php $class_get =  $_GET['bo_idx'] == '1'?"aisde_click":""; ?>
    <a class="aside_nav <?php echo $class_get =  $_GET['bo_idx'] == '1'?"aisde_click":""; ?>" href="<?= G5_BBS_URL ?>/board.report.php?bo_table=business&bo_idx=1">중간보고서</a>
    <a class="aside_nav <?php echo $class_get =  $_GET['bo_idx'] == '2'?"aisde_click":""; ?>" href="<?= G5_BBS_URL ?>/board.report.php?bo_table=business&bo_idx=2">결과(연차)보고서</a>
</aside>
<!-- $bo_title -->
<div id="bo_list" >
<!-- 게시판 페이지 정보 및 버튼 시작 { -->
    <div id="bo_btn_top">
        <h1 id="">
            <?php
                if($_GET['bo_idx'] == '1'){
                    echo "중간보고서";
                } else if($_GET['bo_idx'] == '2') {
                    echo "결과(연차)보고서"; 
                }
            ?>
        </h1>
        <ul class="btn_bo_user">
            <li>
                <?php
                    $http_host = $_SERVER['HTTP_HOST'];
                    $request_uri = $_SERVER['REQUEST_URI'];
                    $url = 'http://' . $http_host . $request_uri;
                
                    $url = preg_replace('#&page=[0-9]*#', '', $url);
                ?>
                <fieldset class="bo_sch_input">
                    <form name="fsearch" method="POST" action="<?= $url?>">
                    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
                    <input type="hidden" name="sca" value="<?php echo $sca ?>">
                    <input type="hidden" name="sop" value="and">
                    <input type="hidden" name="sop" value="and">
                    <input type="hidden" name="bo_idx" value="<?= $_GET['bo_idx'] ?>">
                    <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
                    <select name="sfl" id="sfl">
                    <option value="wr_subject">제목</option>
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
                    <a href="<?php echo $write_href ?>&bo_idx=<?= $_GET['bo_idx'] ?><?= $_GET['u_id'] == 1?"&u_id=1" : "" ?>" class="btn_b01 btn" title="글쓰기"><i class="fa fa-pencil" aria-hidden="true"></i><span class="sound_only">글쓰기</span></a>
                </li>
        	<?php }  ?>
        </ul>
    </div>
    <!-- } 게시판 페이지 정보 및 버튼 끝 -->
    
    <form name="fboardlist" id="fboardlist" action="<?php echo G5_BBS_URL; ?>/board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
    
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="sw" value="">

    
        	
    <div class="tbl_head01 tbl_wrap">
        <table>
        <caption><?php echo $board['bo_subject'] ?> 목록</caption>
        <thead>
        <tr>
            <th scope="col">번호</th>
            <th scope="col">지원사업 분야</th>
            <th scope="col">제목</th>
            <th scope="col">마감일</th>
            <th scope="col">상태</th>
        </tr>
        </thead>
        <tbody>
        <?php

            for ($i=0; $i<count($list); $i++) {
                if ($i%2==0) $lt_class = "even";
                else $lt_class = "";

                $sql = " select * from report where mb_id= '{$member['mb_id']}' AND business_idx = '{$list[$i]['idx']}'";
                $result = sql_query($sql);
                $row22 = sql_fetch_array($result);

                $bo_text_idx = $list[$i]['wr_title_idx'] == "" ? $list[$i]['bo_title_idx'] : $list[$i]['wr_title_idx'];

                $sql = " select * from g5_write_business_title where idx= '$bo_text_idx'";
                $result = sql_query($sql);
                $row33 = sql_fetch_array($result);

                $sql = " select * from g5_write_business where wr_id= '{$list[$i]['bo_idx']}'";
                $result = sql_query($sql);
                $row44 = sql_fetch_array($result);
		?>
        <tr class="<?= $lt_class ?> tr_hover">
            <td class="td_idx td_center">
           <?=
             $list[$i]['num'];
             ?>
            </td>

            <td class="td_download td_center">
                 <?= $row33['title']; ?>
            </td>
            <td class="td_title" style="padding-left:<?php echo $list[$i]['reply'] ? (strlen($list[$i]['wr_reply'])*10) : '0'; ?>px">
                <a href="<?= G5_BBS_URL ?>/board.report.php?bo_table=<?=$_GET['bo_table']; ?>&bo_idx=<?= $_GET['bo_idx'] ?>&wr_bo_idx=<?php echo $list[$i]['idx']; ?>&wr_idx=<?= $list[$i]['wr_id'] == ""? $list[$i]['bo_idx']:$list[$i]['wr_id']; ?>">
                    <?= $row44['wr_subject'] == ""? $list[$i]['wr_subject']:$row44['wr_subject']; ?>
                </a>
            </td>
            <td class="td_datetime td_center"><?= $row44['wr_date_end'] == ""? $list[$i]['wr_date_end']:$row44['wr_date_end']; ?></td>
            <td class="td_end td_center">
                <?php  
                    if($row22['report'] == 2){
                        echo '제출완료';
                    }else if($row22['report'] == 1){
                        echo '작성중';
                    }else{
                        echo '미작성';
                    }  ?>
            </td>
            

        </tr>

        <?php }?>

        

        <?php if (count($list) == 0) { echo '<tr><td colspan="6" class="empty_table">게시물이 없습니다.</td></tr>'; } ?>

        </tbody>
        </table>
    </div>

	<!-- 페이지 -->
    <?php echo $write_pages ?>
	<!-- 페이지 -->
	
    
    </form>

    
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

    // if(<?php //echo $_GET['bo_idx'] == 1? true : false ?> ){
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
