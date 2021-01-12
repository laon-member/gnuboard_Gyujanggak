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




// $sql1 = " SELECT * FROM {$write_table} WHERE wr_title_idx = {$bo_idx} ";
// $result1 = sql_query($sql1);
// $num = 0;
// for($j=1; $row=sql_fetch_array($result1); $j++) {
    
//     $num ++;
// }

?>
<!-- 게시판 목록 시작 { -->
<aside id="bo_side">
    <h2 class="aside_nav">심사관리</h2>
   
    <a class="aside_nav <?= $_GET['bo_idx'] == 1?"aisde_click":""; ?>" href="<?= G5_BBS_URL ?>/board.rater.php?bo_table=<?= $bo_table ?>&bo_idx=1">지원자 선발</a>
    <a class="aside_nav <?= $_GET['bo_idx'] == 2?"aisde_click":""; ?>" href="<?= G5_BBS_URL ?>/board.rater.php?bo_table=<?= $bo_table ?>&bo_idx=2">중간보고서</a>
    <a class="aside_nav <?= $_GET['bo_idx'] == 3?"aisde_click":""; ?>" href="<?= G5_BBS_URL ?>/board.rater.php?bo_table=<?= $bo_table ?>&bo_idx=3">결과(연차)보고서</a>
</aside>
<div id="bo_list" >
    <!-- 게시판 페이지 정보 및 버튼 시작 { -->
    <div id="bo_btn_top">
        <h1 id="">심사관리</h1>

    </div>
    <!-- } 게시판 페이지 정보 및 버튼 끝 -->
        	
    <div class="tbl_head01 tbl_wrap">
        <table>
        <caption><?php echo $board['bo_subject'] ?> 목록</caption>
        <thead>
        <tr>
            <th scope="col" style="width:5%">번호</th>
            <th scope="col" style="width:10%">접수번호</th>
            <th scope="col" style="width:45%">과제명</th>
            <th scope="col" style="width:10%">연구책임자</th>
            <th scope="col" style="width:15%">평가</th>
            <th scope="col" style="width:15%">심사결과 제출</th>
        </tr>
        </thead>
        <tbody>
        <?php
        

        $sql = " select * from rater where user_id = '{$member['mb_id']}' and business_idx = '{$_GET['wr_idx']}' and test_id = '{$_GET['bo_idx']}'";
        $result = sql_query($sql);
        $row66 = sql_fetch_array($result);
        if($row66 == ""){
            alert("권한이 없습니다");
        }


        if ($_GET['bo_idx'] == 1) {
            $sql = " select * from g5_business_propos where bo_idx = '{$_GET['wr_idx']}'";
            $result = sql_query($sql);
        } else if ($_GET['bo_idx'] == 2) {
            $sql = " select * from g5_business_propos where bo_idx = '{$_GET['wr_idx']}' and report_val_1 = 2";
            $result = sql_query($sql);
        } else if ($_GET['bo_idx'] == 3) {
            $sql = " select * from g5_business_propos where bo_idx = '{$_GET['wr_idx']}' and report_val_2 = 2";
            $result = sql_query($sql);
        }

        for ($i=0; $i<$row = sql_fetch_array($result); $i++) {

            $sql77 = " select * from rater where business_idx = '{$_GET['wr_idx']}' and user_id = '{$member['mb_id']}' and test_id = '{$_GET['bo_idx']}'";
            $result77 = sql_query($sql77);
            $row77 = sql_fetch_array($result77);  

            $row22 = sql_fetch(" select * from rater_value where rater_idx = '{$row77['idx']}' and report_idx = '{$row['idx']}'");
        ?>
        
        <tr class="<?php echo $lt_class ?> tr_hover">
            <td class="hidden" style="display:none;">
                <input type="hidden" class="sql_idx" name="sql_idx" value="<?= $_GET['bo_idx'] ?>">
                <input type="hidden" class="sql_title" name="sql_title" value="<?php echo $row['title']; ?>">
                <input type="hidden" class="sql_ko_title" name="sql_ko_title" value="<?php echo $row['ko_title']; ?>">
                <input type="hidden" class="sql_us_idx" name="sql_us_idx" value="<?php echo $row['idx']; ?>">

                
            </td>
            
            <td class="td_idx td_center">
                <?php
                    echo $list[$i]['num'];
                ?>
            </td>

            <td class="td_center ">
                <?= $row['quest_number'] ?> 
            </td>
            <td class="td_download td_title"  >
            <a href="<?= G5_BBS_URL ?>/board.rater.php?bo_table=qa&bo_idx=<?= $_GET['bo_idx'] ?>&wr_idx=<?= $_GET['wr_idx'] ?>&us_idx=<?= $row['idx']; ?>"><?= $row['ko_title']; ?></a>
                    
            </td>
            <td class="td_datetime td_center"><?php echo $row['name']; ?></td>
            <td class="td_datetime td_center"><button type="button" class="value_btn btn_bo_val"> <?= $row22['value']==2? "확인" :"평가"; ?></button></td>
            <td class="td_datetime td_center" value="<?= $i ?>">
                <form name="fboardlist" id="fboardlist" action="<?= https_url(G5_BBS_DIR)."/application_rater_update.php"; ?>" method="post">
                
                    <input type="hidden" name="business_idx" class= "business_idx_form" value="<?php echo $_GET['wr_idx']; ?>">
                    <input type="hidden" name="rater_idx" class= "sql_rater_idx" value="<?php echo $row66['idx']; ?>">
                    <input type="hidden" name="test_id" class="test_id"  value="<?= $_GET['bo_idx']?>">
                    <input type="hidden" name="value_id"  value="2">
                    <input type="hidden" class="sql_us_idx" name="us_idx" value="<?php echo $row['idx']; ?>">
                    <button type="submit" class="value_btn btn_bo_val_submit value_btn_a" <?= $row22['value']==2? "disabled" :""; ?> style="background:<?= $row22['value']==2? "#ccc" :"#3a8afd"; ?>" ><?= $row22['value']==2? "제출완료" :"제출"; ?></button> 
                </form>
            </td>
        </tr>

        <?php } ?>
        <?php if (count($list) == 0) { echo '<tr><td colspan="6" class="empty_table">사업공고 내용이 없습니다.</td></tr>'; } ?>
        </tbody>
        </table>
    </div>
    
	<!-- 페이지 -->

    <!-- 현재 URL 주소 -->
    <a href="<?= G5_BBS_URL ?>/board.rater.php?bo_table=qa&bo_idx=1" class="value_btn" style="text-align:center">목록</a>
            <!-- 게시판 검색 시작 { -->

</div>
<script>
jQuery(function($){
    $('.bo_sch_bg, .bo_sch_cls, .btn_esc').click(function(){
        $('.bo_sch_wrap').hide();
        location.reload();
    });
    var test_user = 0;
    var test_title = 0;
    var test_plan = 0;
    var test_sum = 0;

    $('#test_user').change(function(){
        test_user = parseFloat ($('#test_user').val());
        test_sum = (test_user + test_title + test_plan)/3;
        $('#test_sum').val(test_sum);
        if($('#test_opinion').val() == "" || $('#test_user').val() == "" || $('#test_title').val() == "" || $('#test_plan').val() == ""){
            $('#value_btn_submit').attr('disabled', true);
            $('#value_btn_submit').css({"background":"#ccc"});
        } else {
            $('#value_btn_submit').attr('disabled', false);
            $('#value_btn_submit').css({"background":"#3a8afd"});
        }
    });
    $('#test_title').change(function(){
        test_title = parseFloat ($('#test_title').val());
        test_sum = (test_user + test_title + test_plan)/3;
        $('#test_sum').val(test_sum);
        if($('#test_opinion').val() == "" || $('#test_user').val() == "" || $('#test_title').val() == "" || $('#test_plan').val() == ""){
            $('#value_btn_submit').attr('disabled', true);
            $('#value_btn_submit').css({"background":"#ccc"});
        } else {
            $('#value_btn_submit').attr('disabled', false);
            $('#value_btn_submit').css({"background":"#3a8afd"});
        }
    });
    $('#test_plan').change(function(){
        test_plan = parseFloat ($('#test_plan').val());
        test_sum = (test_user + test_title + test_plan)/3;
        $('#test_sum').val(test_sum);
        if($('#test_opinion').val() == "" || $('#test_user').val() == "" || $('#test_title').val() == "" || $('#test_plan').val() == ""){
            $('#value_btn_submit').attr('disabled', true);
            $('#value_btn_submit').css({"background":"#ccc"});
        } else {
            $('#value_btn_submit').attr('disabled', false);
            $('#value_btn_submit').css({"background":"#3a8afd"});
        }
    });
    $('#test_opinion').change(function(){
        if($('#test_opinion').val() == "" || $('#test_user').val() == "" || $('#test_title').val() == "" || $('#test_plan').val() == ""){
            $('#value_btn_submit').attr('disabled', true);
            $('#value_btn_submit').css({"background":"#ccc"});
        } else {
            $('#value_btn_submit').attr('disabled', false);
            $('#value_btn_submit').css({"background":"#3a8afd"});
        }
    });
   
});
</script>
<div class="bo_sch_wrap">
    <fieldset class="bo_sch" style="width:800px; max-height:noen;height:600px;">
        <?php
            $sql = " select * from g5_write_business where wr_id = '{$_GET['wr_idx']}'";
            $result = sql_query($sql);
            $row = sql_fetch_array($result);
        ?>
        <p id="sql_title_view"><?= $row['wr_subject'] ?></p>
        <h3 id="sql_ko_title_view"></h3>
        <form name="fsearch" method="POST" action="<?= https_url(G5_BBS_DIR)."/application_rater_update.php" ?>">
        <input type="hidden" name="business_idx" id= "business_idx" value="<?= $_GET['wr_idx'] ?>">
        <input type="hidden" name="test_id"  value="<?= $_GET['bo_idx']?>">
        <input type="hidden" name="value_id"  value="1">
        <input type="hidden" name="us_idx" id="us_idx"  value="">
        
        <label for="" class="label_text" style="display:block;">항목평가</label>
        <label for="test_user" class="label_text" style="vertical-align: inherit;">연구진</label>
        <input type="number" name="test_user" id="test_user"  class="input_text input_text_40 input_text_end" placeholder="접수번호" value="" min="0" max="80"> 
        <span>/80</span>
        <label for="test_title" class="label_text" style="vertical-align: inherit;">주제</label>
        <input type="number" name="test_title" id="test_title"  class="input_text input_text_40 input_text_end" placeholder="접수번호" value="" min="0" max="80" > 
        <span>/80</span>
        <label for="test_plan" class="label_text" style="vertical-align: inherit;">계획</label>
        <input type="number" name="test_plan" id="test_plan"  class="input_text input_text_40 input_text_end" placeholder="접수번호" value="" min="0" max="80" > 
        <span>/80</span>
        <label for="test_sum" class="label_text" style="vertical-align: inherit;">종합평가</label>
        <input type="number" name="test_sum" id="test_sum"  class="input_text input_text_40 input_text_end" placeholder="접수번호" readonly> 
        <span>/80</span>
        <label for="test_opinion" class="label_text" style="vertical-align: top;">상세설명</label>
        <textarea name="test_opinion" id="test_opinion" class="input_text input_text_hight" <?= $row44['report'] ==2? "disabled": ""; ?> cols="20" rows="10"></textarea>
        <button type="button" class="btn_esc">취소</button>
        <button type="submit" class="btn_submit" id="value_btn_submit" >저장</button>
        </form>
        
    </fieldset>
    <div class="bo_sch_bg"></div>
    
    <script>
        $(function(){
            $('.btn_bo_val').click(function(){
                var td_title = $(this).parent().siblings('.td_title').text();
                $('#sql_ko_title_view').text(td_title);
                var us_idx_val = $(this).parent().siblings('.hidden').find('.sql_us_idx').val();
                $('#us_idx').val(us_idx_val);
                var us_idx = $(this).parent().next().find('.sql_us_idx').val();
                var rater_idx = $(this).parent().next().find('.sql_rater_idx').val();
                
                $.ajax({
                    url: "<?= G5_BBS_URL ?>/view.report.sql.php",
                    method: "POST",
                    data: {
                        us_idx: us_idx,
                        rater_idx : rater_idx
                    },
                    dataType: "text",
                    success : function(e){
                        $('.bo_sch').append(e);
                    }
                });

                $('.bo_sch_wrap').toggle();
            })     
        })
      

    </script>
</div>
            <!-- } 게시판 검색 끝 --> 


<?php if($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>

<?php } ?>
