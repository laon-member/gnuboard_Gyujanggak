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

$sql1 = "select count(*) as cnt from g5_business_propos where bo_idx = '{$_GET['wr_idx']}' and value = 4";
$result1 = sql_query($sql1);
$row=sql_fetch_array($result1);
$num = $row['cnt'];
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
    <div id="bo_btn_top" style="display: block;">
        <h1 id="">[<?= $title_text ?>]<?= $row['wr_subject']; ?></h1>
        <div style="text-align: right; margin-top:10px">
            <button class="add_btn add_btn_1" style="width:220px">중간보고서 제출기간 설정</button>
            <button class="add_btn add_btn_2" style="width:220px">결과보고서 제출기간 설정</button>
        </div>
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
            <!-- <th scope="col" style="width:14%">연구책임자</th> -->
            <th scope="col" style="width:13%">중간보고서</th>
            <th scope="col" style="width:13%">결과(연차)보고서</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $sql = "  select COUNT(DISTINCT `idx`) as cnt from rater where user_id = '{$member['mb_id']}' and test_id = '{$_GET['bo_idx']}'";
        $row11 = sql_fetch($sql);
        $total_count = $row11['cnt'];

        $sql = " select * from rater where user_id = '{$member['mb_id']}' and business_idx = '{$_GET['wr_idx']}' and test_id = '{$_GET['bo_idx']}' order by idx desc";
        $result = sql_query($sql);
        $row = sql_fetch_array($result);
     
        $sql = " select * from g5_business_propos where bo_idx = '{$_GET['wr_idx']}' and value = 4 order by idx desc";
        $result = sql_query($sql);
        for ($i=0; $row = sql_fetch_array($result); $i++) {

        ?>
        
        <tr class="<?php echo $lt_class ?> tr_hover">
            
            <td class="td_idx td_center">
                <?php
                    echo $list[$i]['num'];
                ?>
            </td>

            <td class="td_center">
                <?= $row['info_number'] ?> 
            </td>
            <td class="td_title ">
                <?= $row['ko_title']; ?>
            </td>
            <!-- <td class="td_datetime td_center">
                <?php echo $row['name']; ?>
            </td> -->
            <td class="td_datetime td_center">
                <?php 
                    $sql1 = " select * from report where business_idx = '{$row['idx']}' and report_idx = '1' order by idx desc";
                    $result1 = sql_query($sql1);
                    $value = sql_fetch_array($result1);
                ?>
                <a href="<?= G5_BBS_URL ?>/board_admin.php?bo_table=business&bo_idx=<?= $_GET['bo_idx'] ?>&wr_idx=<?= $_GET['wr_idx'] ?>&us_idx=<?= $row['idx']; ?>&u_id=1&report=1" class="value_btn" onclick="<?= $value['report'] == 2  ? "" : "event.preventDefault();" ?>" style="background:<?=$value['report'] == 2  ? "#1D2E58" : "#cccccc" ?>">
                    <?= $value['report'] == 2 ? "바로가기" : "미제출" ?>
                </a>
            </td>
            <td class="td_datetime td_center">
                <?php 
                    $sql1 = " select * from report where business_idx = '{$row['idx']}' and report_idx = '2'";
                    $result1 = sql_query($sql1);
                    $value = sql_fetch_array($result1);
                ?>
                <a href="<?= G5_BBS_URL ?>/board_admin.php?bo_table=business&bo_idx=<?= $_GET['bo_idx'] ?>&wr_idx=<?= $_GET['wr_idx'] ?>&us_idx=<?= $row['idx']; ?>&u_id=1&report=2" class="value_btn " onclick="<?= $value['report'] == 2  ? "" : "event.preventDefault();" ?>" style="background:<?=$value['report'] == 2  ? "#1D2E58" : "#cccccc" ?>">
                    <?= $value['report'] == 2  ? "바로가기" : "미제출" ?>
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
        
<div class="bo_sch_wrap report_wrap_1">
    <fieldset class="bo_sch bo_add" style="width:700px; max-height:noen; height:670px;">
        <?php 
            $sql1 = " SELECT * FROM g5_write_business WHERE wr_id = {$_GET['wr_idx']} ";
            $result1 = sql_query($sql1);
            $row=sql_fetch_array($result1);

            $sql = " select * from g5_write_business_title where bo_table = '{$_GET['bo_table']}'";
            $result = sql_query($sql);
            $row2 = sql_fetch_array($result);

            $sql = "  select * from report_date where business_idx = '{$_GET['wr_idx']}' and report_level = '1'";
            $result = sql_query($sql);
            $row3 = sql_fetch_array($result);
        ?>

        <p id="sql_title_view"></p>
        <h1 style="text-align: center;">중간보고서 제출 기한 설정</h1>
        <h3 id="sql_ko_title_view">[<?= $row2['title'];?>]<?= $row['wr_subject'];?></h3>
        <form name="fsearch" method="POST" action="<?= https_url(G5_BBS_DIR)."/report_date_time_update.php" ?>" style="text-align: center;" enctype="multipart/form-data"autocomplete="off" >
            <input type="hidden" name="business_idx" id= "business_idx" value="<?= $_GET['wr_idx'] ?>">
            <input type="hidden" name="value_id"  value="1">

            <label for="" class="report_add_label">중간보고서 제출 기한</label>
            <div class="add_table_info">
                <input type="text" name="view_date" placeholder="날짜" value="<?= $row3['view_date_time'] != '' ? date("Y-m-d", strtotime($row3['view_date_time'])) : ''; ?>" class="report_add_input add_date" id="datepicker1" max="9999-12-31" readonly>
                <input type="text" name="view_time" placeholder="시간" value="<?= $row3['view_date_time'] != '' ? date("H:i", strtotime($row3['view_date_time'])) : ''; ?>" class="report_add_input add_time">
            </div>
            <label for="" class="report_add_label">중간보고서 업로드 가능 기한</label>
            <div class="add_table_info">
                <input type="text" name="upload_date" placeholder="날짜" value="<?= $row3['view_date_time'] != '' ? date("Y-m-d", strtotime($row3['upload_date_time'])) : ''; ?>" class="report_add_input add_date" id="datepicker2" max="9999-12-31" readonly> 
                <input type="text" name="upload_time" placeholder="시간" value="<?= $row3['view_date_time'] != '' ? date("H:i", strtotime($row3['upload_date_time'])) : ''; ?>" class="report_add_input add_time">
            </div>
            <div class="add_table_info">
                <button type="submit" class="btn_submit" style="font-size: 14px; width:100%; border:none !important; margin-top : 20px;">저장</button>
            </div>
        </form>
       
        <div class="rater_date_table">   
            <table class="tbl_head01 rater_list_table">
                <caption><?php echo $board['bo_subject'] ?> 목록</caption>
                <thead>
                    <tr>
                        <th scope="col" style="width:10%">번호</th>
                        <th scope="col" style="width:45%">중간보고서 제출 기한</th>
                        <th scope="col" style="width:45%">중간보고서 업로드 가능 기한</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    
                    if($row3){
                    ?>
                    
                    <tr class="<?php echo $lt_class ?> tr_hover">
                        
                        <td class="td_idx td_center">
                            1
                        </td>

                        <td class="td_center">
                            ~ <?= date("Y년 m월 d일 H시 i분", strtotime($row3['view_date_time'])); ?> 까지
                        </td>
                        <td class="td_center">
                        ~ <?= date("Y년 m월 d일 h시 i분", strtotime($row3['upload_date_time'])); ?> 까지
                        </td>
                    </tr>
                    <?php } else if ($total_count == 0) { echo '<tr><td colspan="4" rowspan="1" style="text-align: center">보고서 제출 기한 설정이 없습니다.</td></tr>'; } ?>
                </tbody>
            </table>
        </div>
        
        
        <div class="rater_value_btn_contianer">
            <button type="button" class="btn_esc">확인</button>
        </div>
    </fieldset>
    <div class="bo_sch_bg"></div>
    
</div>
        
<div class="bo_sch_wrap report_wrap_2">
    <fieldset class="bo_sch bo_add" style="width:700px; max-height:noen; height:670px;">
        <?php 
            $sql1 = " SELECT * FROM g5_write_business WHERE wr_id = {$_GET['wr_idx']} ";
            $result1 = sql_query($sql1);
            $row=sql_fetch_array($result1);

            $sql = " select * from g5_write_business_title where bo_table = '{$_GET['bo_table']}'";
            $result = sql_query($sql);
            $row2 = sql_fetch_array($result);

            $sql = "  select * from report_date where business_idx = '{$_GET['wr_idx']}' and report_level = '2'";
            $result = sql_query($sql);
            $row3 = sql_fetch_array($result);
        ?>

        <p id="sql_title_view"></p>
        <h1 style="text-align: center;">결과(연차)보고서 제출 기한 설정</h1>
        <h3 id="sql_ko_title_view">[<?= $row2['title'];?>]<?= $row['wr_subject'];?></h3>
        <form name="fsearch" method="POST" action="<?= https_url(G5_BBS_DIR)."/report_date_time_update.php" ?>" style="text-align: center;" enctype="multipart/form-data"autocomplete="off" >
            <input type="hidden" name="business_idx" id= "business_idx" value="<?= $_GET['wr_idx'] ?>">
            <input type="hidden" name="value_id"  value="2">

            <label for="" class="report_add_label">결과(연차)보고서 제출 기한</label>
            <div class="add_table_info">
                <input type="text" name="view_date" placeholder="날짜" class="report_add_input add_date" value="<?= $row3['upload_date_time'] != "" ? date("Y-m-d", strtotime($row3['view_date_time'])) : ''; ?>" id="datepicker1" max="9999-12-31" readonly>
                <input type="text" name="view_time" placeholder="시간" class="report_add_input add_time" value="<?= $row3['upload_date_time'] != "" ? date("H:i", strtotime($row3['view_date_time'])) : ''; ?>">
            </div>
            <label for="" class="report_add_label">결과(연차)보고서 업로드 가능 기한</label>
            <div class="add_table_info">
                <input type="text" name="upload_date" placeholder="날짜" value="<?= $row3['upload_date_time'] != "" ? date("Y-m-d", strtotime($row3['upload_date_time'])) : ''; ?>" class="report_add_input add_date" id="datepicker2" max="9999-12-31" readonly> 
                <input type="text" name="upload_time" placeholder="시간" value="<?= $row3['upload_date_time'] != "" ? date("H:i", strtotime($row3['upload_date_time'])) : ''; ?>" class="report_add_input add_time">
            </div>
            <div class="add_table_info">
                <button type="submit" class="btn_submit" style="font-size: 14px; width:100%; border:none !important; margin-top : 20px;">저장</button>
            </div>
        </form>
        <div class="rater_date_table">   
            <table class="tbl_head01 rater_list_table">
                <caption><?php echo $board['bo_subject'] ?> 목록</caption>
                <thead>
                    <tr>
                        <th scope="col" style="width:10%">번호</th>
                        <th scope="col" style="width:45%">결과(연차)보고서 제출 기한</th>
                        <th scope="col" style="width:45%">결과(연차)보고서 업로드 가능 기한</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    
                    if($row3){
                    ?>
                    
                    <tr class="<?php echo $lt_class ?> tr_hover">
                        
                        <td class="td_idx td_center">
                            1
                        </td>

                        <td class="td_center">
                            ~ <?= date("Y년 m월 d일 H시 i분", strtotime($row3['view_date_time'])); ?>까지
                        </td>
                        <td class="td_center">
                        ~ <?= date("Y년 m월 d일 H시 i분", strtotime($row3['upload_date_time'])); ?>까지
                        </td>
                    </tr>
                    <?php } else if ($total_count == 0) { echo '<tr><td colspan="4" rowspan="1" style="text-align: center">보고서 제출 기한 설정이 없습니다.</td></tr>'; } ?>
                </tbody>
            </table>
        </div>
        
        
        <div class="rater_value_btn_contianer">
            <button type="button" class="btn_esc">확인</button>
        </div>
    </fieldset>
    <div class="bo_sch_bg"></div>
    
</div>
<?php if($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>
<?php } ?>

<script>
    $(function(){
        // 게시판 검색
        $(".add_btn_1").on("click", function() {
            $('.report_wrap_1').toggle();
        })
        $(".add_btn_2").on("click", function() {
            $('.report_wrap_2').toggle();
        })

        $('.bo_sch_bg, .bo_sch_cls, .btn_esc').click(function(){
            $('.bo_sch_wrap').hide();
        });

        $("#datepicker1").datepicker(
            { 
            autoClose: true,
            dateFormat: 'yyyy-mm-dd'}
        );
        $("#datepicker2").datepicker(
            { 
            autoClose: true,
            dateFormat: 'yyyy-mm-dd'}
        );
        $('.datepickers-container').css('z-index', 99999999999999);

        $(".add_time").timepicker({
            step: 30,            //시간간격 : 5분
            timeFormat: "H:i"    //시간:분 으로표시
        });
    })
</script>
