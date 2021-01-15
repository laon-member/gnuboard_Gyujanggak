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
    <h2 class="aside_nav">심사관리</h2>
   
    <a class="aside_nav <?= $_GET['bo_idx'] == 1?"aisde_click":""; ?>" href="<?= G5_BBS_URL ?>/board.rater.admin.php?bo_table=<?= $bo_table ?>&bo_idx=1&u_id=1">지원자 선발</a>
    <a class="aside_nav <?= $_GET['bo_idx'] == 2?"aisde_click":""; ?>" href="<?= G5_BBS_URL ?>/board.rater.admin.php?bo_table=<?= $bo_table ?>&bo_idx=2&u_id=1">중간보고서</a>
    <a class="aside_nav <?= $_GET['bo_idx'] == 3?"aisde_click":""; ?>" href="<?= G5_BBS_URL ?>/board.rater.admin.php?bo_table=<?= $bo_table ?>&bo_idx=3&u_id=1">결과(연차)보고서</a>
</aside>
<div id="bo_list" >
    
    
    

    <!-- 게시판 페이지 정보 및 버튼 시작 { -->
    <div id="bo_btn_top">
    <?php 
        $sql = " select * from g5_write_business where wr_id = '{$_GET['border_idx']}'";
        $row44 = sql_fetch($sql);

        $sql = " select * from g5_write_business_title where idx = '{$row44['wr_title_idx']}'";
        $row22 = sql_fetch($sql)
    ?>
    
        <h1 id="">[<?= $row22['title'] ?>]<?= $row11['wr_subject'] ?></h1>
    </div>
    <p>지원자 심사 결과</p>

    <!-- } 게시판 페이지 정보 및 버튼 끝 -->
     
    <div class="tbl_head01 tbl_wrap">
    <form action="<?= G5_BBS_URL ?>/application_user_update.php" id="form_data" method="POST">
        <input type="hidden" name="value" value="4">
        <input type="hidden" name="bo_idx_list" value="<?= $_GET['bo_idx'] ?>">
        <table>
            <caption><?php echo $board['bo_subject'] ?> 목록</caption>
            <thead>
                <tr>
                    <th scope="col" style="width:5%">번호</th>
                    <th scope="col" style="width:10%">접수번호</th>
                    <th scope="col" style="width:30%">과제명</th>
                    <th scope="col" style="width:10%">책임연구원</th>
                    <th scope="col" style="width:15%">평점평균<br>(단순)</th>
                    <th scope="col" style="width:15%">평점평균<br>(최고/최저점 제외)</th>
                    <th scope="col" style="width:15%">합격자</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $sql = "  select COUNT(DISTINCT `idx`) as cnt from rater where user_id = '{$member['mb_id']}' and test_id = '{$_GET['bo_idx']}'";
                $row11 = sql_fetch($sql);
                $total_count = $row11['cnt'];
                
                if($_GET['bo_idx'] == 1){
                    $sql44 = " select * from g5_business_propos where bo_idx = '{$_GET['border_idx']}'";
                    $result44 = sql_query($sql44);
                } else if($_GET['bo_idx'] == 2){
                    $sql44 = " select * from g5_business_propos where bo_idx = '{$_GET['border_idx']}' and report_val_1 = 2 and value = 4";
                    $result44 = sql_query($sql44);
                } else if($_GET['bo_idx'] == 3){
                    $sql44 = " select * from g5_business_propos where bo_idx = '{$_GET['border_idx']}' and report_val_2 = 2 and value = 4";
                    $result44 = sql_query($sql44);
                }

                $list_num = 0;
                for ($i=0; $i<$row = sql_fetch_array($result44); $i++) {
                    $list_num ++;
            ?>
                    <tr class="<?php echo $lt_class ?> tr_hover">
                        <td class="hidden" style="display:none;">
                            <input type="hidden" id="sql_us_idx" name="idx_id" value="<?php echo $row['idx']; ?>">
                            <input type="hidden" id="sql_wr_idx" name="wr_id" value="<?php echo $_GET['border_idx']; ?>">
                            <input type="hidden" id="sql_bo_idx" name="sql_bo_idx" value="<?php echo $_GET['bo_idx']; ?>">
                        </td>
                        
                        <td class="td_idx td_center"><?= $list[$i]['num']; ?></td>

                        <td class="td_center"><?= $row['quest_number'] ?> </td>
                        <td class="td_download ko_title" ><?= $row['ko_title']; ?></td>
                        <td class="td_datetime td_center"><?php echo $row['name'];  ?></td>
                        <td class="td_center">
                            <?php
                            $average = 0;
                                $sql333 = " select count(*) as cnt from rater where business_idx = '{$_GET['border_idx']}'";
                                $result333 = sql_query($sql333);
                                $row333 = sql_fetch_array($result333);
                                
                                $sql = " select * from rater where business_idx = '{$_GET['border_idx']}'";
                                $result = sql_query($sql);
                                $sum = 0;
                                
                                for ($j=0; $j<$row33 = sql_fetch_array($result); $j++) {
                                    $sql = "  select * from rater_value where rater_idx = '{$row33['idx']}'";
                                    $row11 = sql_fetch($sql);
                                    $sum = $sum + $row11['test_sum'];
                                }
                                $average = $sum/$row333['cnt'];
                                $average = sprintf('%0.0f', $average);

                            ?>
                            <?= $average ?>/80
                        </td>
                        <td class="td_center">
                            <?php
                            $average_max_min_not = 0;
                                $sql333 = " select count(*) as cnt from rater where business_idx = '{$_GET['border_idx']}'";
                                $result333 = sql_query($sql333);
                                $row333 = sql_fetch_array($result333);
                                if($row333['cnt'] > 2){
                                    $sql = " select * from rater where business_idx = '{$_GET['border_idx']}'";
                                    $result = sql_query($sql);
                                    $sum = 0;
                                    
                                    
                                    $sql = "SELECT sum(test_sum) AS sum FROM rater_value WHERE report_idx = '{$row['idx']}'";
                                    $sql_sum = sql_fetch($sql);

                                    $sql = "SELECT max(test_sum) AS max FROM rater_value WHERE report_idx = '{$row['idx']}'";
                                    $sql_max = sql_fetch($sql);

                                    $sql = "SELECT min(test_sum) AS min FROM rater_value WHERE report_idx = '{$row['idx']}'";
                                    $sql_min = sql_fetch($sql);

                                   
                                    $sql_min_max_sum = $sql_max['max'] + $sql_min['min'];
                                    $sql_test_sum =$sql_sum['sum'] - $sql_min_max_sum;

                                    $rater_user = $row333['cnt'] - 2;
                                    $average_max_min_not = $sql_test_sum/$rater_user;
                                } else {
                                    $sql = " select * from rater where business_idx = '{$_GET['border_idx']}'";
                                    echo $sql;
                                    $result = sql_query($sql);
                                    $sum = 0;

                                    
                                    for ($j=0; $j<$row33 = sql_fetch_array($result); $j++) {
                                        $sql = "  select * from rater_value where rater_idx = '{$row33['idx']}' ";
                                        $row11 = sql_fetch($sql);
                                        $sum = $sum + $row11['test_sum'];
                                    }
                                    $average_max_min_not = $sum/$row333['cnt'];
                                    
                                }
                                $average_max_min_not = sprintf('%0.0f', $average_max_min_not);
                            ?>
                            <?= $average_max_min_not ?>/80
                        </td>
                        <td class="td_datetime td_center">
                                <input type="hidden" id="sql_list_idx" name="bo_id" value="<?php echo $row['idx']; ?>">
                                <?php
                                    $value_num;
                                    $value_idx;
                                    if($_GET['bo_idx'] == 1){
                                        $value_num = $row['value'];
                                        $value_idx = $row['idx'];
                                    } else if($_GET['bo_idx'] == 2){
                                        $sql55 = " select * from report where business_idx = '{$row['idx']}' and report_idx = 2";
                                        $row55 = sql_fetch($sql55);
                                        $value_num = $row55['value'];
                                        $value_idx = $row55['idx'];
                                    } else if($_GET['bo_idx'] == 3){
                                        $sql55 = " select * from report where business_idx = '{$row['idx']}' and report_idx = 2";
                                        $row55 = sql_fetch($sql55);
                                        $value_num = $row55['value'];
                                        $value_idx = $row55['idx'];
                                    }

                                    if($value_num == 3 || $value_num == 4){
                                ?>
                                    <label for="" id="" class="value_btn" style="background: #ccc !important">선택 완료</label>
                                <?php } else  if($value_num == 1 || $value_num == 2){ ?>
                                    <a href="<?=https_url(G5_BBS_DIR)?>/application_user_update.php?bo_idx=<?= $_GET['bo_idx'] ?>&border_idx=<?= $value_idx ?>&value=5" class="value_btn value_tel" style="background: #ccc !important">해제</a>
                                <?php } else if($value_num == 0 ){ ?>
                                    <label for="checkbox<?= $i ?>" id="checkbox_label<?= $i ?>" class="value_btn value_btn_click">선택</label>
                                    <input type="checkbox" name="checkbox[]" class="checkbox_input" id="checkbox<?= $i ?>" value="<?= $row['idx']?>" style="display:none;">
                                <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            <?php if ($list_num == 0) { echo '<tr><td colspan="7" class="empty_table">지원자가 없습니다.</td></tr>'; } ?>
            </tbody>
        </table>
        <div class = "submit_btn_contianer">
            <a href="<?= G5_BBS_URL ?>/board.rater.admin.php?bo_table=qa&bo_idx=1&u_id=1" class="value_btn" style="text-align:center;display:inline-block">목록</a>
            <?php if ( $row44['value'] < 3) {  ?>
                <button type="submit" class="value_btn value_submit" style="display:inline-block; background:"> 저장 </button>
            <?php } ?>
        </div>
        
        </form>
    </div>
    
	<!-- 페이지 -->

    <!-- 현재 URL 주소 -->
    <!-- 게시판 검색 시작 { -->
    <script>
        jQuery(function($){
            // 게시판 검색
            var us_idx;
            var wr_idx;
            var bo_idx;
            $(".ko_title").on("click", function() {
                us_idx = $(this).parents('.tr_hover').find('#sql_us_idx').attr('value');
                bo_idx = $(this).parents('.tr_hover').find('#sql_bo_idx').attr('value');
                wr_idx = $(this).parents('.tr_hover').find('#sql_wr_idx').attr('value');
               
                $('.bo_sch_wrap').toggle();
        
                $.ajax({
                    url : "<?= G5_BBS_URL ?>/mysql.php",
                    type : "post",
                    data : {
                        tbl : us_idx,
                        wrid : bo_idx,
                        wr_idx: wr_idx
                    },
                    success : function(res) {
                        if(res) {
                            $("#tbody").html(res);
                        }

                        if(res.error){
                            var html = "<tr class='tr_hover'><td colspan='7' class='td_datetime td_center'>심사자 평가가 없습니다</td></tr>";
                            $("#tbody").html(html)
                        }
                    }
                });
            });
            $('.bo_sch_bg, .bo_sch_cls, .btn_esc, #top_esc').click(function(){
                $('.bo_sch_wrap').hide();
            });
           
            $('.value_btn_click').on('click', function (e) {
                var value = $(this).next().is(':checked');                
                if (value) {    
                    $(this).text("선택");
                    $(this).css({"background": "#3a8afd"});

                } else {
                    $(this).text("해제");
                    $(this).css({"background": "#CCC"});

                }
            });
        });
    </script>
    <div class="bo_sch_wrap">
        <fieldset class="bo_sch" style="width:800px; max-height:noen;height:600px;">
                <p id="sql_title_view" class="td_center">심사결과 상세현황</p>
                
                <table>
                <thead>
                <tr>
                    <th scope="col" style="width:10%" class=" td_center">심사위원</th>
                    <th scope="col" style="width:20%" class=" td_center">연구진 평가점수</th>
                    <th scope="col" style="width:20%" class=" td_center">주제 평가점수</th>
                    <th scope="col" style="width:20%" class=" td_center">계획 평가점수</th>
                    <th scope="col" style="width:10%" class=" td_center">총점</th>
                    <th scope="col" style="width:10%" class=" td_center">종합평가</th>
                    <th scope="col" style="width:10%" class=" td_center">평가의견</th>
                </tr>
                </thead>
                <tbody id="tbody">
                
                </tbody>
                </table>
                <button type="button" id="top_esc">  취소</button>
        </fieldset>
        <div class="bo_sch_bg"></div>
    </div>
    <!-- } 게시판 검색 끝 --> 
</div>

<?php if($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>

<?php } ?>
