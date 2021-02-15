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
    <h2 class="aside_nav_title">심사 관리</h2>
   
    <a class="aside_nav <?= $_GET['bo_idx'] == 1?"aisde_click":""; ?>" href="<?= G5_BBS_URL ?>/board.rater.php?bo_table=<?= $bo_table ?>&bo_idx=1">지원자 선발</a>
    <a class="aside_nav <?= $_GET['bo_idx'] == 2?"aisde_click":""; ?>" href="<?= G5_BBS_URL ?>/board.rater.php?bo_table=<?= $bo_table ?>&bo_idx=2">중간보고서</a>
    <a class="aside_nav <?= $_GET['bo_idx'] == 3?"aisde_click":""; ?>" href="<?= G5_BBS_URL ?>/board.rater.php?bo_table=<?= $bo_table ?>&bo_idx=3">결과(연차)보고서</a>
</aside>
<div id="bo_list" >
    <?php 
       
    ?>
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

    <!-- 게시판 페이지 정보 및 버튼 시작 { -->
    <div id="bo_btn_top">
        <?php if($_GET['bo_idx'] == 1){ ?>
            <h1 id="">지원자 선발</h1>
        <?php } else if($_GET['bo_idx'] == 2){ ?>
            <h1 id="">중간보고서</h1>
        <?php } else if($_GET['bo_idx'] == 3){ ?>
            <h1 id="">결과(연차)보고서</h1>
        <?php } ?>
    </div>
    <!-- } 게시판 페이지 정보 및 버튼 끝 -->
        	
    <div class="tbl_head01 tbl_wrap">
        <table>
        <caption><?php echo $board['bo_subject'] ?> 목록</caption>
        <thead>
        <tr>
            <th scope="col" style="width:10%">번호</th>
            <th scope="col" style="width:15%">과제번호</th>
            <th scope="col" style="width:60%">제목</th>
            <th scope="col" style="width:15%">심사대상</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $sql = "select * from rater where user_id = '{$member['mb_id']}' AND value = '2' AND test_id = '{$_GET['bo_idx']}' ORDER BY idx DESC";
        $result = sql_query($sql);
        for ($i=0; $i<count($list); $i++) {
        	

            $sql44 = " select * from g5_write_business where wr_id= '{$list[$i]['business_idx']}'";
            $result44 = sql_query($sql44);
            $row44 = sql_fetch_array($result44);
		?>
        <tr class="<?php if ($list[$i]['is_notice']) echo "bo_notice"; ?> <?php echo $lt_class ?> tr_hover">
            
            <td class="td_idx td_center">
            <?php echo $list[$i]['num']; ?>
            </td>

            <td class="td_center">
                <?= $row44['wr_quest_number'] ?> 
            </td>
            <td class="td_title ">
               
                <a href="<?= G5_BBS_URL ?>/board.rater.php?bo_table=<?=$_GET['bo_table']; ?>&wr_idx=<?php echo $row44['wr_id']; ?>&bo_idx=<?= $_GET['bo_idx'] ?>">
                    <?php
                        $sql5 = " select * from g5_write_business_title where idx= '{$row44['wr_title_idx']}'";
                        $result5 = sql_query($sql5);
                        $row5 = sql_fetch_array($result5);
                    ?>
                    [<?= $row5['title'] ?>]
                    <?= $row44['wr_subject']; ?>
                </a>

            </td>
            <td class="td_datetime td_center">
                <?php 
                    if($_GET['bo_idx'] == 1){
                        $sql55 = " select COUNT(DISTINCT `idx`) as cnt from g5_business_propos where bo_idx = '{$row44['wr_id']}'";
                    } else if($_GET['bo_idx'] == 2){
                        $sql55 = " select COUNT(DISTINCT `idx`) as cnt from g5_business_propos where value = '4' AND bo_idx = '{$row44['wr_id']}'";
                    } else if($_GET['bo_idx'] == 3){
                        $sql55 = " select COUNT(DISTINCT `idx`) as cnt from g5_business_propos where report_val_1 = '4' AND bo_idx = '{$row44['wr_id']}' ";
                    }
                    $result55 = sql_query($sql55);
                    $row55 = sql_fetch_array($result55);
                    echo $row55['cnt'];
                 ?>
            </td>
        </tr>
        <?php } ?>
        <?php if (count($list) == 0) { echo '<tr><td colspan="6" class="empty_table">심사 관리 내용이 없습니다.</td></tr>'; } ?>
        </tbody>
        </table>
    </div>

	
	
    
    </form>

  
</div>
 <!-- 페이지 -->
 <?php echo $write_pages; ?>
	<!-- 페이지 -->
<?php if($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>
<?php } ?>

<?php if ($is_checkbox) { ?>
<script>

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



</script>
<?php } ?>
<!-- } 게시판 목록 끝 -->
