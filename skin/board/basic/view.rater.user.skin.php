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

$sql33 = "  select * from rater_board where propos_idx = '{$_GET['us_idx']}' and test_idx = '{$_GET['bo_idx']}'";
$row33 = sql_fetch($sql33);
if($row33['value']){
    $admin_val = $row33['value'];
} else {
    $admin_val = 0;
}


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
        <h1 id="">[<?= $row2['title'];?>]<?= $row['wr_subject'];?></h1>
    </div>
    <!-- } 게시판 페이지 정보 및 버튼 끝 -->
    <form action="<?= $action_url ?>" method="post"> 
        <input type="hidden" name="value" value="3">
        <div class="tbl_head01 tbl_wrap">
            <table>
            <caption><?php echo $board['bo_subject'] ?> 목록</caption>
            <thead>
                <tr>
                    <th colspan="7">심사위원 배정</th>
                </tr>
                <tr class="view_table_header_table"></tr>
                <tr>
                    <th scope="col" style="width:10%">번호</th>
                    <th scope="col" style="width:15%">성명</th>
                    <th scope="col" style="width:15%">소속</th>
                    <th scope="col" style="width:15%">학력</th>
                    <th scope="col" style="width:15%">직책</th>
                    <th scope="col" style="width:15%">연구분야</th>
                    <th scope="col" style="width:15%">심사자 선택</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $sql = "select COUNT(DISTINCT `idx`) as cnt from rater where business_idx = '{$_GET['wr_idx']}' and test_id ='{$_GET['bo_idx']}''";
            $row11 = sql_fetch($sql);

            $sql = "select * from rater where business_idx = '{$_GET['wr_idx']}'and propos_idx = '{$_GET['us_idx']}' and test_id ='{$_GET['bo_idx']}'";
            $result = sql_query($sql);
            $count = 0;

            for ($i=0; $row = sql_fetch_array($result); $i++) {
                $sql22 = " select * from g5_member where mb_id = '{$row['user_id']}' ";
                $result22 = sql_query($sql22);
                $row22 = sql_fetch_array($result22);

            ?>
            
            <tr class="<?php echo $lt_class ?> tr_hover">
                <td class="hidden" style="display:none;">
                    <input type="hidden" class="sql_idx" name="sql_idx" value="<?= $_GET['bo_idx'] ?>">
                    <input type="hidden" class="sql_title" name="sql_title" value="<?php echo $row['title']; ?>">
                    <input type="hidden" class="sql_ko_title" name="sql_ko_title" value="<?php echo $row['ko_title']; ?>">
                    <input type="hidden" class="sql_us_idx" name="us_idx" value="<?php echo $row['idx']; ?>">
                </td>
                <td class="td_idx td_center"><?php echo $list[$i]['num']; ?></td>
                <td class="td_center">
                    <?= $row22['mb_name'] ?> 
                </td>
                <td class="td_datetime td_center"><?php echo $row22['belong']; ?></td>
                <td class="td_datetime td_center"><?php echo $row22['degree']; ?></td>
                <td class="td_datetime td_center"><?php echo $row22['rank']; ?></td>
                <td class="td_datetime td_center"><?php echo $row22['category']; ?></td>
                <td class="td_datetime td_center">
                    <label for="checkbox_checked<?= $i ?>" id="checkbox_label<?= $i ?>" class="value_btn value_btn_esc_checked"style="background:<?= $admin_val > 0 ? "#ccc" :"#1F4392"; ?>" onclick="return <?= $admin_val < 0 ? 'true' :'false'; ?>">제외</label>
                    <input type="checkbox" name="checkbox[]" class="checkbox_input" id="checkbox_checked<?= $i ?>" value="<?= $row['idx']?>" style="display:none;">
                </td>
            </tr>
        
            <?php $count++; ?>
            <?php } ?>
            <?php if ($count == 0) { echo '<tr><td colspan="7" class="empty_table">선택된 심사위원이 없습니다.</td></tr>'; } ?>
            </tbody>
            </table>
        </div>
    
        <div class ="btn_confirm write_div btn-cont">
            <div class="rater_btn_container">
                <button type="button" class="<?= $admin_val > 0 ? "btn_bo_val_false" :"btn_bo_val_true"; ?> btn_bo_val text_float"><?= $admin_val > 0 ? "심사위원 선발 완료" :"+ 심사위원 추가"; ?> </button>
            </div>
            <a href="<?= G5_BBS_URL ?>/board.rater.admin.php?bo_table=qa&bo_idx=<?= $_GET['bo_idx'] ?>&u_id=1" style="text-align:center;" class="btn_color_white" >취소</a>
            <button id="value_btn_submit" class="value_btn_submit_save" style="display:inline-block; background:<?= $admin_val > 0 ? "#ccc" :"#1D2E58"; ?>" <?= $admin_val > 0? "disabled" :""; ?> ><?= $count > 0? "수정":"저장"; ?></button>
            <a href="<?= $action_url ?>?value=2&idx=<?= $_GET['wr_idx'] ?>&bo_idx=<?= $_GET['bo_idx']; ?>&us_idx=<?= $_GET['us_idx'] ?>" id="value_btn_submit" class="btn_color_white value_btn_submit_save  value_btn <?= $admin_val > 0 ?'' : 'value_rater_btn'; ?>" onclick="return <?= $admin_val > 0 ?'false' : 'true'; ?>" style="display:inline-block; background:<?= $admin_val > 0 ? "#ccc" :"#1D2E58"; ?>" <?= $admin_val > 0? "disabled" :""; ?>>
                의뢰
            </a>
        </div>
    </form>
</div>
<script>
jQuery(function($){
    // 게시판 검색
    $(".btn_bo_val").on("click", function() {
        if( <?= $admin_val ?> <= 0){
            $('.bo_sch_wrap').toggle();

            var sql_title_view = $(this).parents('.tr_hover').find('.sql_title').attr('value');
            $('#sql_title_view').text(sql_title_view);
            var sql_ko_title = $(this).parents('.tr_hover').find('.sql_ko_title').attr('value')
            $('#sql_ko_title_view').text(sql_ko_title);
            var business_idx_form = $(this).parents('.tr_hover').find('#business_idx_form').attr('value');
            $('#business_idx').text(business_idx_form);
            var us_idx = $(this).parents('.tr_hover').find('.sql_us_idx').attr('value');
            $('#us_idx').val(us_idx);
            
        }
    })
    $('.bo_sch_bg, .bo_sch_cls, .btn_esc, .button_esc').click(function(){
        $('.bo_sch_wrap').hide();
    });
    var test_user = 0;
    var test_title = 0;
    var test_plan = 0;
    var test_sum = 0;

    $('#test_user').change(function(){
        test_user = parseFloat ($('#test_user').val());
        test_sum = (test_user + test_title + test_plan)/3;
        $('#test_sum').val(test_sum);
    });
    $('#test_title').change(function(){
        test_title = parseFloat ($('#test_title').val());
        test_sum = (test_user + test_title + test_plan)/3;
        $('#test_sum').val(test_sum);
    });
    $('#test_plan').change(function(){
        test_plan = parseFloat ($('#test_plan').val());
        test_sum = (test_user + test_title + test_plan)/3;
        $('#test_sum').val(test_sum);
    });
   
});
</script>
<div class="bo_sch_wrap">
    <fieldset class="bo_sch" style="width:1030px; max-height:noen;height:820px;">
        <form action="<?= $action_url ?>" method="post"> 
        <input type="hidden" name="wr_idx" value="<?= $_GET['wr_idx'] ?>">
        <input type="hidden" name="bo_idx" value="<?=$_GET['bo_idx'] ?>">
        <input type="hidden" name="us_idx" value="<?=$_GET['us_idx'] ?>">
        <input type="hidden" name="value" value="1">
            <div id="bo_btn_top">
                <h1 id="">심사위원 목록</h1>
            </div>
            <table id="view_table">
            <thead>
            <tr>
                <th scope="col" style="width:16.66%" class=" td_center td_height_56">성명</th>
                <th scope="col" style="width:16.66%" class=" td_center td_height_56">소속</th>
                <th scope="col" style="width:16.66%" class=" td_center td_height_56">학력</th>
                <th scope="col" style="width:16.66%" class=" td_center td_height_56">직책</th>
                <th scope="col" style="width:16.66%" class=" td_center td_height_56">연구분야</th>
                <th scope="col" style="width:16.66%" class=" td_center td_height_56">심사자 선택</th>
            </tr>
            </thead>
            <tbody>
            <?php
            
            $sql = " select * from g5_member where mb_level = 5;";
            $result = sql_query($sql);
            $count_rater = 0;
            for ($i=0; $row = sql_fetch_array($result); $i++) {
                $sql2 = " select * from rater where business_idx ='{$_GET['wr_idx']}' and propos_idx = '{$_GET['us_idx']}' and test_id = '{$_GET['bo_idx']}' and user_name ='{$row['mb_name']}'";
                $result2 = sql_query($sql2);
                $row2 = sql_fetch_array($result2);
                if($row2['idx'] == ""){
            ?>
                
            <tr class="<?php echo $lt_class ?> tr_hover">
                <td class="td_center td_height_56"><?= $row['mb_name'] ?></td>
                <td class="td_datetime td_center td_height_56"><?php echo $row['belong']; ?></td>
                <td class="td_datetime td_center td_height_56"><?php echo $row['degree']; ?></td>
                <td class="td_datetime td_center td_height_56"><?php echo $row['rank']; ?></td>
                <td class="td_datetime td_center td_height_56"><?php echo $row['category']; ?></td> 
                <td class="td_datetime td_center td_height_56">
                    <label for="checkbox<?= $i ?>" id="checkbox_label<?= $i ?>" class="value_btn value_btn_esc">선택</label>
                    <input type="checkbox" name="checkbox[]" class="checkbox_input" id="checkbox<?= $i ?>" value="<?= $row['mb_no']?>" style="display:none;">
                </td>
            </tr>
              
            <?php 
                $count_rater++;
                }
            } 
            if ($count_rater == 0){ echo '<tr><td colspan="6" class="empty_table">선택 가능한 심사위원이 없습니다.</td></tr>'; } 
            ?>
            
            </tbody>
            </table>
            <div class="rater_value_btn_contianer">
            <button type="button" class="btn_color_white btn_esc">취소</button>
            <button id="value_btn_submit" class="value_btn_submit_save">저장</button>
            </div>
        </form>
    </fieldset>
    <div class="bo_sch_bg"></div>
    <script>
    $(document).ready(function(){
        $('.value_btn_esc').on('click', function (e) {
            if(<?= $admin_val ?> == 0 ){
            var value = $(this).next().is(':checked');  
                
                if (value) {    
                    $(this).text("선택");
                    $(this).css({"background": "#1D2E58"});

                } else {
                    $(this).text("해제");
                    $(this).css({"background": "#CCC"});

                }

            }
        });

        $('.value_btn_esc_checked').on('click', function (e) {
            if(<?= $admin_val ?> == 0){
                var value = $(this).next().is(':checked');
                if (value) {    
                    $(this).text("제외");
                    $(this).css({"background": "#1F4392"});
                    $(this).next().attr("checked",false);

                } else {
                    $(this).text("해제");
                    $(this).css({"background": "#CCC"});
                    $(this).next().attr("checked",true);

                }
            }
        });

    });
    </script>
    
</div>

        


<?php if($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>

<?php } ?>
