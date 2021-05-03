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


$sql1 = " SELECT * FROM g5_write_business WHERE wr_id = {$_GET['wr_idx']} ";
$result1 = sql_query($sql1);
$row=sql_fetch_array($result1);

$sql2 = " SELECT * FROM g5_write_business_title WHERE idx = {$row['wr_title_idx']} ";
$result2 = sql_query($sql2);
$row2=sql_fetch_array($result2);

?>
<!-- 게시판 목록 시작 { -->
<aside id="bo_side">
    <h2 class="aside_nav_title">심사 관리</h2>
   
    <a class="aside_nav <?= $_GET['bo_idx'] == 1?"aisde_click":""; ?>" href="<?= G5_BBS_URL ?>/board.rater.admin.php?bo_table=<?= $bo_table ?>&bo_idx=1&u_id=1">지원자 선발</a>
    <a class="aside_nav <?= $_GET['bo_idx'] == 2?"aisde_click":""; ?>" href="<?= G5_BBS_URL ?>/board.rater.admin.php?bo_table=<?= $bo_table ?>&bo_idx=2&u_id=1">중간보고서</a>
    <a class="aside_nav <?= $_GET['bo_idx'] == 3?"aisde_click":""; ?>" href="<?= G5_BBS_URL ?>/board.rater.admin.php?bo_table=<?= $bo_table ?>&bo_idx=3&u_id=1">결과(연차)보고서</a>
</aside>
<div id="bo_list" >
    <div id="bo_btn_top">
        <h1 id="">[<?= $row2['title'];?>]<?= $row['wr_subject'];?>ㅇㅇ</h1>
    </div>
    <div class="tbl_head01 tbl_wrap">
        <table>
        <caption><?php echo $board['bo_subject'] ?> 목록</caption>
        <thead>
        <tr>
            <th scope="col" style="width:10%">번호</th>
            <th scope="col" style="width:10%">접수번호</th>
            <th scope="col" style="width:50%">과제명</th>
            <!-- <th scope="col" style="width:10%">연구책임자</th> -->
            <th scope="col" style="width:20%">과제번호 부여</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $sql = "  select COUNT(DISTINCT `idx`) as cnt from rater where user_id = '{$member['mb_id']}' and test_id = '{$_GET['bo_idx']}'";
        $row11 = sql_fetch($sql);
        $total_count = $row11['cnt'];

            if($_GET['bo_idx'] == 1){
                $sql = " select * from g5_business_propos where bo_idx = '{$_GET['wr_idx']}' and value = 4 ORDER BY info_number DESC";
            } else if ($_GET['bo_idx'] == 2) {
                $sql = " select * from g5_business_propos where bo_idx = '{$_GET['wr_idx']}' and report_val_1 = 4 ORDER BY info_number DESC";
            } else if ($_GET['bo_idx'] == 3) {
                $sql = " select * from g5_business_propos where bo_idx = '{$_GET['wr_idx']}' and report_val_2 = 4  ORDER BY info_number DESC";
            }

            $result = sql_query($sql);

        for ($i=0; $i<$row = sql_fetch_array($result); $i++) {
        ?>
        
        <tr class="<?php echo $lt_class ?> tr_hover">
            <td class="hidden" style="display:none;">
                <input type="hidden" class="sql_idx" name="sql_idx" value="<?= $_GET['bo_idx'] ?>">
                <input type="hidden" class="sql_title" name="sql_title" value="<?php echo $row['title']; ?>">
                <input type="hidden" class="sql_ko_title" name="sql_ko_title" value="<?php echo $row['ko_title']; ?>">
                <input type="hidden" class="sql_us_idx" name="us_idx" value="<?php echo $row['idx']; ?>">
            </td>
            
            <td class="td_idx td_center">   
                <?php
                    echo $list[$i]['num'];
                ?>
            </td>

            <td class="td_center">
                <?= $row['info_number'] ?> 
            </td>
            <td class="td_title "  >
                <a href="<?= G5_BBS_URL ?>/board.rater.admin.php?bo_table=qa&bo_idx=<?= $_GET['bo_idx'] ?>&wr_idx=<?= $_GET['wr_idx'] ?>&us_idx=<?= $row['idx']; ?>&u_id=1"><?= $row['ko_title']; ?></a>
            </td>
            <!-- <td class="td_datetime td_center"><?php echo $row['name']; ?></td> -->
            <td class="td_datetime td_center">
                <form action="<?= G5_BBS_URL ?>/quest_list_update.php" method="POST">
                    <input type="hidden" name="bo_table" value="<?=$_GET['bo_table']; ?>">
                    <input type="hidden" name="wr_idx" value="<?php echo $_GET['wr_idx']; ?>">
                    <input type="hidden" name="bo_idx" value="<?= $_GET['bo_idx'] ?>">
                    <input type="hidden" name="us_idx" value="<?= $list[$i]['idx']; ?>">
                    <input type="text" name="number" style="width:70%; height:30px"  value="<?= $list[$i]['quest_number'] == "" ? "" : $list[$i]['quest_number']; ?>"ㄱ>
                    <button type="submit" class ="value_btn" style="width:20%; display:inline-block;"><?= $list[$i]['quest_number'] != "" ? "수정" : "배정"; ?></button>
                </form>
            </td>
        </tr>
        <?php } ?>
        <?php if (count($list) == 0) { echo '<tr><td colspan="6" class="empty_table">합격한 지원자가 없습니다.</td></tr>'; } ?>
        </tbody>
        </table>
    </div>

    <section id="bo_v_files" class="td_right btn-cont text_block">
        <a href="<?= G5_BBS_URL ?>/board.rater.admin.php?bo_table=qa&bo_idx=<?php echo $_GET['bo_idx']; ?>&u_id=1" class="btn_next_prv btn_next_prv_link text_inline_block" title="목록보기">목록보기</a>
    </section>

</div>

<?php if($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>

<?php } ?>
