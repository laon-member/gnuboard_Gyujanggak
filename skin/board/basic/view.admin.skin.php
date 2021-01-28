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


$sql1 = "select * from g5_business_propos where bo_idx = '{$_GET['wr_idx']}'";
$result1 = sql_query($sql1);
$num = 0;
for($j=1; $row=sql_fetch_array($result1); $j++) {
    
    $num ++;
}

?>
<!-- 게시판 목록 시작 { -->
<aside id="bo_side">
    <h2 class="aside_nav_title">보고서 관리</h2>
   
    <?php 
        for($k=1; $row=sql_fetch_array($result); $k++) {
            $class_get =  $_GET['bo_idx'] == $row['idx']?"aisde_click":"";
            echo '<a class="aside_nav '.$class_get.'" href="'.G5_BBS_URL .'/board_admin.php?bo_table='.$bo_table.'&bo_idx='.$k.'&u_id=1">'.$row["title"].'</a>';

            if($_GET['bo_idx'] == $row['idx']){
                $title_text = $row['title'];
            }
        }
    ?>
</aside>
<div id="bo_list" >
    <?php 
       $sql = " select * from g5_write_business where wr_id = '{$_GET['wr_idx']}'";
       $result = sql_query($sql);
       $row = sql_fetch_array($result);

       
    ?>
    
    
    

    <!-- 게시판 페이지 정보 및 버튼 시작 { -->
    <div id="bo_btn_top">
        <h1 id="">[<?= $title_text ?>]<?= $row['wr_subject']; ?></h1>

    </div>
    <!-- } 게시판 페이지 정보 및 버튼 끝 -->
        	
    <div class="tbl_head01 tbl_wrap">
        <table>
        <caption><?php echo $board['bo_subject'] ?> 목록</caption>
        <thead>
        <tr>
            <th scope="col" style="width:10%">번호</th>
            <th scope="col" style="width:13%">접수번호</th>
            <th scope="col" style="width:37%">과제명</th>
            <th scope="col" style="width:14%">연구책임자</th>
            <th scope="col" style="width:13%">중간보고서</th>
            <th scope="col" style="width:13%">결과(연차)보고서</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $sql = "  select COUNT(DISTINCT `idx`) as cnt from rater where user_id = '{$member['mb_id']}' and test_id = '{$_GET['bo_idx']}'";
        $row11 = sql_fetch($sql);
        $total_count = $row11['cnt'];

        $sql = " select * from rater where user_id = '{$member['mb_id']}' and business_idx = '{$_GET['wr_idx']}' and test_id = '{$_GET['bo_idx']}'";
        $result = sql_query($sql);
        $row = sql_fetch_array($result);
     



        $sql = " select * from g5_business_propos where bo_idx = '{$_GET['wr_idx']}'";
        $result = sql_query($sql);
        for ($i=0; $i<$row = sql_fetch_array($result); $i++) {

            // if($_GET['bo_idx'] == 2){
            //     $sql = " select * from g5_business_propos where bo_idx = '{$_GET['wr_idx']}'";
            //     $result = sql_query($sql);
            // } else if ($_GET['bo_idx'] == 3) {
            //     $sql = " select * from rater where user_id = '{$member['mb_id']}' and test_id = '{$_GET['bo_idx']}'";
            //     $result = sql_query($sql);
            // }
            
        	// $sql55 = " select * from g5_write_business where wr_id = '{$row['business_idx']}'";
            // $result55 = sql_query($sql55);
            // $row22 = sql_fetch_array($result55);
        ?>
        
        <tr class="<?php echo $lt_class ?> tr_hover">
            
            <td class="td_idx td_center">
                <?php
                    echo $list[$i]['num'];
                ?>
            </td>

            <td class="td_center">
                <?= $row['quest_number'] ?> 
            </td>
            <td class="td_title "  >
          <?= $row['ko_title']; ?>
                    
            </td>
            <td class="td_datetime td_center"><?php echo $row['name']; ?></td>
            <td class="td_datetime td_center">
                <a href="<?= G5_BBS_URL ?>/board_admin.php?bo_table=business&bo_idx=<?= $_GET['bo_idx'] ?>&wr_idx=<?= $_GET['wr_idx'] ?>&us_idx=<?= $list[$i]['idx']; ?>&u_id=1&report=1" class="value_btn" onclick="<?= $row['report_val_1'] > 1 ? "" : "event.preventDefault();" ?>" style="background:<?= $row['report_val_1'] > 1 ? "#1D2E58" : "#cccccc" ?>">
                    <?= $row['report_val_1'] > 1 ? "바로가기" : "미제출" ?>
                </a>
            </td>
            <td class="td_datetime td_center">
                <a href="<?= G5_BBS_URL ?>/board_admin.php?bo_table=business&bo_idx=<?= $_GET['bo_idx'] ?>&wr_idx=<?= $_GET['wr_idx'] ?>&us_idx=<?= $list[$i]['idx']; ?>&u_id=1&report=2" class="value_btn " onclick="<?= $row['report_val_2'] > 1 ? "" : "event.preventDefault();" ?>" style="background:<?= $row['report_val_2'] > 1 ? "#1D2E58" : "#cccccc" ?>">
                    <?= $row['report_val_2'] > 1  ? "바로가기" : "미제출" ?>
                </a>
            </td>
        </tr>
      

        <?php } ?>
        <?php if ($num == 0) { echo '<tr><td colspan="6" class="empty_table">사업공고 내용이 없습니다.</td></tr>'; } ?>
        </tbody>
        </table>
    </div>
    
	<!-- 페이지 -->

    <!-- 현재 URL 주소 -->
    <section id="bo_v_files" class="td_right btn-cont text_block">
        <a href="<?= G5_BBS_URL ?>/board_admin.php?bo_table=business&bo_idx=1&u_id=1&page=1" class="value_btn btn_bo_val text_inline_block" style="text-align:center">목록</a>
    </section>
</div>
        


<?php if($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>

<?php } ?>
