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
   
    <a class="aside_nav <?= $_GET['bo_idx'] == 1?"aisde_click":""; ?>" href="<?= G5_BBS_URL ?>/board.rater.admin.php?bo_table=<?= $bo_table ?>&bo_idx=1&u_id=1">지원자 선발</a>
    <a class="aside_nav <?= $_GET['bo_idx'] == 2?"aisde_click":""; ?>" href="<?= G5_BBS_URL ?>/board.rater.admin.php?bo_table=<?= $bo_table ?>&bo_idx=2&u_id=1">중간보고서</a>
    <a class="aside_nav <?= $_GET['bo_idx'] == 3?"aisde_click":""; ?>" href="<?= G5_BBS_URL ?>/board.rater.admin.php?bo_table=<?= $bo_table ?>&bo_idx=3&u_id=1">결과(연차)보고서</a>
</aside>
<div id="bo_list" >
    
    <!-- 게시판 페이지 정보 및 버튼 시작 { -->
    <div id="bo_btn_top">
    <?php 
        $sql = " select * from g5_write_business where wr_id = '{$_GET['border_idx']}'";
        $row66 = sql_fetch($sql);
        
        $sql = " select * from g5_write_business_title where idx = '{$row66['wr_title_idx']}'";
        $row22 = sql_fetch($sql)
    ?>
    
        <h1 id="">[<?= $row22['title'] ?>]<?= $row66['wr_subject'] ?></h1>
    </div>

    <!-- } 게시판 페이지 정보 및 버튼 끝 -->
     
    <div class="tbl_head01 tbl_wrap">
    <form action="<?= G5_BBS_URL ?>/application_user_update.php" id="form_data" method="POST">
        <input type="hidden" name="value" value="4">
        <input type="hidden" name="bo_idx_list" value="<?= $_GET['bo_idx'] ?>">
        <table>
            <caption><?php echo $board['bo_subject'] ?> 목록</caption>
            <thead>
                <tr>
                    <th colspan="7">지원자 심사 결과</th>
                </tr>
                <tr class="view_table_header_table"></tr>

                <tr>
                    <th scope="col" style="width:5%">번호</th>
                    <th scope="col" style="width:10%">접수번호</th>
                    <th scope="col" style="width:30%">과제명</th>
                    <!-- <th scope="col" style="width:10%">책임연구원</th> -->
                    <th scope="col" style="width:15%">평점평균<br>(단순)</th>
                    <th scope="col" style="width:15%">평점평균<br>(최고/최저점 제외)</th>
                    <th scope="col" style="width:15%">합격자</th>
                </tr>
            </thead>
            <tbody>
            <?php
                if($_GET['bo_idx'] == 1){
                    $sql444 = " select count(*) as cnt from g5_business_propos where bo_idx = '{$_GET['border_idx']}' order by info_number desc";

                    $sql44 = " select * from g5_business_propos where bo_idx = '{$_GET['border_idx']}' order by info_number desc";
                } else if($_GET['bo_idx'] == 2){
                    $sql444 = " select count(*) as cnt  from g5_business_propos where bo_idx = '{$_GET['border_idx']}' and value = 4 order by info_number desc";

                    $sql44 = " select * from g5_business_propos where bo_idx = '{$_GET['border_idx']}' and value = 4 order by info_number desc";
                } else if($_GET['bo_idx'] == 3){
                    $sql444 = " select count(*) as cnt from g5_business_propos where bo_idx = '{$_GET['border_idx']}' and report_val_1 = 4 order by info_number desc";

                    $sql44 = " select * from g5_business_propos where bo_idx = '{$_GET['border_idx']}' and report_val_1 = 4 order by info_number desc";
                }
                $result444 = sql_query($sql444);
                $total_count = sql_fetch_array($result444);
                $total_count=  $total_count['cnt'];

                $result44 = sql_query($sql44);

                $list_num = 0;
                for ($i=0; $i<$row = sql_fetch_array($result44); $i++) {
                    $list_num ++;
                    if($_GET['bo_idx'] == 1){
                        $row_value = $row['value'];
                    } else if($_GET['bo_idx'] == 2){
                        $row_value = $row['report_val_1'];
                    } else if($_GET['bo_idx'] == 3){
                        $row_value = $row['report_val_2'];
                    }

                    $value_num == 0;
                    $value_idx == 0;
                    if($_GET['bo_idx'] == 1){
                        $value_num = $row['value'];
                    } else if($_GET['bo_idx'] == 2){
                        $sql55 = " select * from report where business_idx = '{$row['idx']}' and report_idx = 1";
                        $row55 = sql_fetch($sql55);
                        $value_num = $row['report_val_1'];
                    } else if($_GET['bo_idx'] == 3){
                        $sql55 = " select * from report where business_idx = '{$row['idx']}' and report_idx = 2";
                        $row55 = sql_fetch($sql55);
                        $value_num = $row['report_val_2'];
                    }
                    $value_idx = $row['idx'];

                    $rater_category_sql = " select * from rater_category where category_idx = '{$row['bo_title_idx']}' and test_step = '{$_GET['bo_idx']}'";
                    $rater_category = sql_fetch($rater_category_sql);
                    $rater_category_idx = $rater_category['idx'];

                    $rater_fild_sql = " select sum(test_score) as sum from rater_fild where test_fild_idx = '{$rater_category_idx}'";
                    $rater_fild_row = sql_fetch($rater_fild_sql);
                    $rater_max_score = $rater_fild_row['sum'] == ''? 0 : $rater_fild_row['sum'];

            ?>
                    <tr class="<?php echo $lt_class ?> tr_hover">
                        <td class="hidden" style="display:none;">
                            <input type="hidden" id="sql_us_idx" name="idx_id" value="<?php echo $row['idx']; ?>">
                            <input type="hidden" id="sql_wr_idx" name="wr_id" value="<?php echo $_GET['border_idx']; ?>">
                            <input type="hidden" id="sql_bo_idx" name="sql_bo_idx" value="<?php echo $_GET['bo_idx']; ?>">
                            <input type="hidden" id="sql_title_idx" name="sql_title_idx" value="<?php echo $row['bo_title_idx']; ?>">
                        </td>
                        
                        <td class="td_idx td_center"><?= $list[$i]['num']; ?></td>

                        <td class="td_center"><?= $row['info_number'] ?> </td>
                        <td class="td_download ko_title td_title td_cursor" >
                        <?php 
                              if($value_num == 3){ 
                                echo '[불합격]';
                              } else if( $value_num == 4){
                                echo '[합격]';
                              }  
                        ?>
                            <?= $row['ko_title']; ?>    
                        </td>
                        <!-- <td class="td_datetime td_center"><?php echo $row['name'];  ?></td> -->
                        <td class="td_center wr_average">
                            <?php
                                $sum =0;
                                $average = 0;
                                $row_count = 0;

                                $sql444 = " select * from rater where business_idx = '{$_GET['border_idx']}' and test_id = '{$_GET['bo_idx']}'";
                                $result444 = sql_query($sql444);
                                $row444 = sql_fetch_array($result444);

                                $sql555 = " select * from rater where business_idx = '{$_GET['border_idx']}' and test_id = '{$_GET['bo_idx']}'";
                                $result555 = sql_query($sql555);
                                for($k =0; $k < $row555 = sql_fetch_array($result555); $k){
                                    $sql333 = " select * from rater_value where rater_idx = '{$row555['idx']}' and report_idx= '{$value_idx}' and value = 2";
                                    $result333 = sql_query($sql333);
                                    $row332 = sql_fetch_array($result333);

                                    if($row332){
                                        $row_count ++;
                                        $sum =  $sum + $row332['test_sum'];
                                    }
                                }

                                

                                if($row_count > 0){
                                    $average = @$sum/$row_count;
                                    $average = @sprintf('%0.0f', $average);
                                } else {
                                    $average = 0;
                                }
                                

                            ?>
                            <?= $average ?>/<?= $rater_max_score?>
                        </td>
                        <td class="td_center wr_average_max_min">
                            <?php
                                $average_max_min_not = 0;
                                $row_count =0;
                                $sum =0;
                                $max = 0;
                                $min = 80;

                                $sql444 = " select * from rater where business_idx = '{$_GET['border_idx']}' and test_id = '{$_GET['bo_idx']}'";
                                $result444 = sql_query($sql444);
                                $row444 = sql_fetch_array($result444);

                                $sql555 = " select * from rater where business_idx = '{$_GET['border_idx']}' and test_id = '{$_GET['bo_idx']}'";
                                $result555 = sql_query($sql555);
                                for($k =0; $k < $row555 = sql_fetch_array($result555); $k){
                                    $sql333 = " select * from rater_value where rater_idx = '{$row555['idx']}' and report_idx= '{$row['idx']}' and value = 2";
                                    $result333 = sql_query($sql333);
                                    $row332 = sql_fetch_array($result333);

                                    if($row332){
                                        if($max < $row332['test_sum']){
                                            $max = $row332['test_sum'];
                                        }
                                        if($min > $row332['test_sum']){
                                            $min = $row332['test_sum'];
                                        }

                                        $sum =  $sum + $row332['test_sum'];
                                        $row_count ++;
                                    }
                                }

                                if($row_count > 2){
                                    $sql_min_max_sum = $max + $min;
                                    $sql_test_sum =$sum - $sql_min_max_sum;

                                    $rater_user = $row_count - 2;
                                    $average_max_min_not = $sql_test_sum/$rater_user;
                                } else {
                                   if($row_count == 0){
                                    @$average_max_min_not = 0;
                                   } else {
                                    @$average_max_min_not = $sum/$row_count;
                                   }

                                    
                                    
                                }
                                $average_max_min_not = sprintf('%0.0f', $average_max_min_not);
                            ?>
                            <?= $average_max_min_not ?>/<?= $rater_max_score?>
                        </td>
                        <td class="td_datetime td_center">
                                <input type="hidden" id="sql_list_idx" name="bo_id" value="<?php echo $row['idx']; ?>">
                                <?php
                                   

                                    if($value_num == 3 || $value_num == 4){
                                ?>
                                    <label for="" id="" class="value_btn " style="background: #ccc !important">선택 완료 </label>
                                <?php } else  if($value_num == 1 || $value_num == 2){ ?>
                                    <a href="<?=https_url(G5_BBS_DIR)?>/application_user_update.php?bo_idx=<?= $_GET['bo_idx'] ?>&border_idx=<?= $value_idx ?>&value=5" class="value_btn value_tel" style="background: #ccc !important td_cursor">해제</a>
                                <?php } else if($value_num == 0 ){ ?>
                                    <label for="checkbox<?= $i ?>" id="checkbox_label<?= $i ?>" class="value_btn value_btn_click td_cursor" >선택</label>
                                    <input type="checkbox" name="checkbox[]" class="checkbox_input" id="checkbox<?= $i ?>" value="<?= $value_idx ?>" style="display:none;">
                                <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            <?php if ($total_count == 0) { echo '<tr><td colspan="7" class="empty_table">지원자가 없습니다.</td></tr>'; } ?>
            </tbody>
        </table>
        <div class = "td_right btn-cont text_block">
            <?php 
                if($_GET['bo_idx'] == 1){
                    $row_value = $row66['value'];
                } else if($_GET['bo_idx'] == 2){
                    $row_value = $row66['wr_8'];
                } else if($_GET['bo_idx'] == 3){
                    $row_value = $row66['wr_9'];
                }

            ?>

            <a href="<?= G5_BBS_URL ?>/board.rater.admin.php?bo_table=qa&bo_idx=<?= $_GET['bo_idx'] ?>&u_id=1" class="btn_color_white" style="text-align:center;display:inline-block"><?= $row_value < 3 ? "취소" : "확인"; ?></a>
            <?php if ( $row_value < 3) {  ?>
                <button type="submit" class="btn_next_prv btn_next_prv_link text_inline_block  value_submit" style="display:inline-block; background:"> <?= $row_value < 2 ? "저장" : "수정"; ?> </button>
            <?php } ?>
        </div>
        </form>
    </div>
    <script>
        jQuery(function($){
            // 게시판 검색
            var us_idx;
            var wr_idx;
            var bo_idx;
            var title_idx = $('#sql_title_idx').attr('value');
            $(".ko_title").on("click", function() {
                if(title_idx == 6) return false;
                    
                $('.bo_sch_wrap').toggle();

                $('#ko_title').text($(this).text());
                $('#wr_average').text($(this).next().next().text());
                $('#wr_average_max_min').text($(this).next().next().next().text());
        
                us_idx = $(this).parents('.tr_hover').find('#sql_us_idx').attr('value');
                bo_idx = $(this).parents('.tr_hover').find('#sql_bo_idx').attr('value');
                wr_idx = $(this).parents('.tr_hover').find('#sql_wr_idx').attr('value');

                $.ajax({
                    url : "<?= G5_BBS_URL ?>/mysql.php",
                    type : "post",
                    data : {
                        tbl : us_idx,
                        bo_idx : bo_idx,
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
                    $(this).css({"background": "#1D2E58"});
                } else {
                    $(this).text("해제");
                    $(this).css({"background": "#CCC"});
                }
            });
        });
    </script>
    <div class="bo_sch_wrap">
        <fieldset class="bo_sch" style="width:1030px; max-height:noen;height:820px; padding: 20px;">
            <?php 
                $sql = " select * from g5_write_business where wr_id = '{$_GET['border_idx']}'";
                $row66 = sql_fetch($sql);
            ?>
            <div id="bo_btn_top">
                <h1 id="">심사결과 상세현황</h1>
            </div>
            <table id="view_table">
            <thead>
            <tr>
                <th style="width:5%" class=" td_center">과제명</th>
                <td style="width:95%" colspan="7" class="td_title"><?= $row66['wr_subject'] ?></td>
                
            </tr>
            <tr>
                <th style="width:5%" class=" td_center">과제명</th>
                <td style="width:95%" colspan="7" id="ko_title" class="td_title"></td>
                
            </tr>
            <!-- <tr>
                <th style="width:8%" class=" td_center">평점평균<br>(단순)</th>
                <td style="width:40%" colspan="5" id="wr_average" class="td_title">70 / 80</td>
                <th style="width:8%" class=" td_center">평점평균<br>(최고/최저점 제외)</th>
                <td style="width:42%" id="wr_average_max_min" class="td_title">70 / 80</td>
            </tr> -->
            
            <tr class="view_table_header_table"></tr>
            <tr>
                <th scope="col" style="width:8%" class=" td_center">심사위원</th> 
                <?php 
                    $sql = " select idx from rater_category where category_idx = '{$row66['wr_title_idx']}' and test_step = '{$_GET['bo_idx']}'";
                    $row77 = sql_fetch($sql);

                    $sql = " select * from rater_fild where test_fild_idx = '{$row77['idx']}'";
                    $result = sql_query($sql);
                    for($i=0; $row88=sql_fetch_array($result); $i++) {
                ?>
                <th scope="col" style="width:8%" class="` td_center"><?= $row88['test_name'] ?></th>
                <?php

                    }
                ?>
                <?php if($_GET['bo_idx'] != '2'){ ?>
                <th scope="col" style="width:8%" class=" td_center">총점</th>
                <!-- <th scope="col" style="width:8%" class=" td_center">종합평가</th> -->
                <?php } ?>

                <th scope="col" style="width:52%" colspan="2" class=" td_center">평가의견</th>
            </tr>
            </thead>
            <tbody id="tbody">
            </tbody>
            </table>
            <div style="text-align:center">
                <button type="button" style="margin:40px;" id="top_esc" class="btn_next_prv_link">확인</button>
            </div>
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
