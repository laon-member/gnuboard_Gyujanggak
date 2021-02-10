<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
    
$sql1 = " SELECT * FROM `g5_business_propos` where idx = '{$_GET['us_idx']}'";
$result1 = sql_query($sql1);
$row=sql_fetch_array($result1);

$sql1 = " SELECT * FROM `g5_write_business` where wr_id = '{$_GET['wr_idx']}'";
$result1 = sql_query($sql1);
$row22=sql_fetch_array($result1);


$sql1 = " SELECT * FROM `g5_write_business_title` where idx = '{$row['bo_title_idx']}'";
$result1 = sql_query($sql1);
$row33=sql_fetch_array($result1);
?>
<aside id="bo_side">
    <h2 class="aside_nav_title">심사관리</h2>
   
    <a class="aside_nav <?= $_GET['bo_idx'] == 1?"aisde_click":""; ?>" href="<?= G5_BBS_URL ?>/board.rater.php?bo_table=<?= $bo_table ?>&bo_idx=1">지원자 선발</a>
    <a class="aside_nav <?= $_GET['bo_idx'] == 2?"aisde_click":""; ?>" href="<?= G5_BBS_URL ?>/board.rater.php?bo_table=<?= $bo_table ?>&bo_idx=2">중간보고서</a>
    <a class="aside_nav <?= $_GET['bo_idx'] == 3?"aisde_click":""; ?>" href="<?= G5_BBS_URL ?>/board.rater.php?bo_table=<?= $bo_table ?>&bo_idx=3">결과(연차)보고서</a>
</aside>
<section id="bo_v" style="width:80%;">
    <!-- 게시물 작성/수정 시작 { -->
    <form name="fwrite" id="fwrite" action="<?= $action_url; ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" style="width:<?php echo $width; ?>">
    <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
    <input type="hidden" name="w" value="<?php echo $w ?>"> 
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="wr_id" value="<?php echo $_GET['wr_id'] != "" ? $_GET['wr_id'] : $_POST['wr_id']; ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="business_idx" id= "business_idx" value="<?= $_GET['wr_idx'] ?>">
    <input type="hidden" name="test_id"  value="<?= $_GET['bo_idx']?>">
    <input type="hidden" name="value_id"  value="2">
    <input type="hidden" name="us_idx"  value="<?= $_GET['us_idx']; ?>">
    <input type="hidden" name="rater_idx" id="form_rater_idx" value="<?= $row66['idx']; ?>">
    
    <?php
        $sql66 = " select * from rater where user_id = '{$member['mb_id']}' and business_idx = '{$_GET['wr_idx']}' and test_id = '{$_GET['bo_idx']}'";
        $result66 = sql_query($sql66);
        $row66 = sql_fetch_array($result66);

        
    ?>
    
    
    
    <div class =" ">
       <div class="bo_w_tit write_div">
            <div id="bo_btn_top_app ">
                <h1 class="view_title"><?=  $category_title ?>[<?= $row33['title']?>]<?php echo $row22['wr_subject']; ?></h1>
            </div>
        </div>
      
            <table class="view_table_app">
            <thead>
                <tr>
                    <th scope="col" class="view_table_header"colspan="1" style="width: 10%;">제목</th>
                    <td scope="col" class="view_table_title" colspan="8" style="">
                        <input type="text" name="title_view" id="title_view"  class="input_text " placeholder="제목" value="<?= $row['ko_title']; ?>   "  readonly>
                    </td>
                </tr>
                <tr>
                    <th scope="col" class="view_table_header" style="">접수번호</th>
                    <td scope="col" class="view_table_text" colspan="4" style="">
                    <input type="text" name="info_number_view" id="info_number_view"  class="input_text input_text_100 input_text_end" placeholder="접수번호" value="<?= $row['info_number']; ?>"  readonly >
                    </td>
                    <th scope="col" class="view_table_header" style="">과제번호</th>
                    <td scope="col" class="view_table_text" colspan="4" style="">
                        <input type="text" name="quest_number_view" id="quest_number_view"  class="input_text input_text_100 input_text_end" placeholder="과제번호" value="<?= $row['quest_number']; ?>" readonly>
                    </td>
                </tr>
            </thead>
            <tbody id="input_file_cont">
                <tr class="view_table_header_table"></tr>
                <tr>
                    <th scope="col" class="view_table_header " colspan="9">연구과제명</th>
                </tr>
                <tr>
                    <th scope="col" class="view_table_header" colspan="1" style="">과제명(국문)</th>
                    <td scope="col" class="view_table_text" colspan="8" style="">
                    <input type="text" name="ko_title_view" id="ko_title_view"  class="input_text" placeholder="과제명(국문)" value="<?= $row['ko_title']; ?>" readonly>
                    </td>
                </tr>
                <tr>
                    <th scope="col" class="view_table_header" colspan="1" style="">과제명(영문)</th>
                    <td scope="col" class="view_table_text" colspan="8" style="">
                    <input type="text" name="en_title_view" id="en_title_view"  class="input_text" placeholder="과제명(영문)" value="<?= $row['en_title']; ?>" readonly>
                    </td>
                </tr>
                <tr class="view_table_header_table"></tr>
                <tr>
                    <th scope="col" class="view_table_header " colspan="9">연구책임자</th>
                </tr>
                <tr>
                    <th scope="col" class="view_table_header" colspan="1" style="">성명</th>
                    <td scope="col" class="view_table_text" colspan="4" style="">
                    <input type="text" name="name_view" id="name_view"  class="input_text" placeholder="성명" value="<?= $row['name']; ?>" readonly>
                    </td>
                    <th scope="col" class="view_table_header" colspan="1" style="">전공(학위)</th>
                    <td scope="col" class="view_table_text" colspan="3" style="">
                    <input type="text" name="degree_view" id="degree_view"  class="input_text" placeholder="전공(학위)" value="<?= $row['degree']; ?>" readonly>
                    </td>
                </tr>
                <tr>
                    <th scope="col" class="view_table_header" colspan="1" style="">소속</th>
                    <td scope="col" class="view_table_text" colspan="4" style="">
                    <input type="text" name="belong_view" id="belong_view"  class="input_text" placeholder="소속" value="<?= $row['belong']; ?>" readonly>
                    </td>
                    <th scope="col" class="view_table_header" colspan="1" style="">직급</th>
                    <td scope="col" class="view_table_text" colspan="3" style="">
                    <input type="text" name="rank_view" id="rank_view"  class="input_text" placeholder="직급"  value="<?= $row['rank']; ?>" readonly >
                    </td>
                </tr>
                <tr>
                    <th scope="col" class="view_table_header" colspan="1" style="">이메일</th>
                    <td scope="col" class="view_table_text" colspan="4" style="">
                    <input type="text" name="email_view" id="email_view"  class="input_text" placeholder="이메일" value="<?= $row['email']; ?>" readonly>
                    </td>
                    <th scope="col" class="view_table_header" colspan="1" style="">전화</th>
                    <td scope="col" class="view_table_text" colspan="3" style="">
                    <input type="text" name="phone_view" id="phone_view"  class="input_text" placeholder="전화" value="<?= $row['phone']; ?>" readonly>
                    </td>
                </tr>
            
                <tr>
                    <th scope="col" class="view_table_header" style="">공동연구원</th>
                    <td scope="col" class="view_table_text" colspan="4" style="">
                    <input type="text" name="main_member_view" id="main_member_view"  class="input_text" placeholder="명"  value="<?= number_format($row['main_member']); ?>명" readonly>
                    </td>
                    <th scope="col" class="view_table_header" style="">연구원보조</th>
                    <td scope="col" class="view_table_text" colspan="3" style="">
                    <input type="text" name="sub_member_view" id="sub_member_view"  class="input_text" placeholder="명"  value="<?= number_format($row['sub_member']); ?>명" readonly>
                    </td>
                </tr>
                <tr class="view_table_header_table"></tr>
                <tr>
                    <th scope="col" class="view_table_header " colspan="9">연구정보</th>
                </tr>
                <tr>
                    <th scope="col" class="view_table_header" colspan="1"style="">총 연구 기간</th>
                    <td scope="col" class="view_table_text" colspan="8" style="">
                        <input type="text" name="date_start_view" id="date_start_view" placeholder="총 연구 기간"  class="input_text"  value="<?= $row['date_start']; ?> ~ <?= $row['date_end']; ?>" readonly>
                    </td>
                </tr>
                <tr>
                    <th scope="col" class="view_table_header" colspan="1" style="">연구비신청액</th>
                    <td scope="col" class="view_table_text" colspan="8" style="">
                    <input type="text" name="money_view" id="money_view"  class="input_text" placeholder="연구비신청액" value="<?= number_format($row['money']); ?>원" readonly>
                    </td>
                </tr>
                <tr>
                    <th scope="col" class="view_table_header" colspan="1" style="">1차년 연구비</th>
                    <td scope="col" class="view_table_text" colspan="4" style=" width:40%">
                    <input type="text" name="one_year_view" id="one_year_view"  class="input_text" placeholder="1차년 연구비" value="<?= number_format($row['one_year']); ?>원" readonly>
                    </td>
                    <th scope="col" class="view_table_header" colspan="1" style="">2차년 연구비</th>
                    <td scope="col" class="view_table_text" colspan="3" style="">
                        <input type="text" name="two_year_view" id="two_year_view"  class="input_text" placeholder="2차년 연구비" value="<?= number_format($row['two_year']); ?>원" readonly>
                    </td>
                </tr>
            </tbody>
            <?php
            $file_idx = '';
                if($_GET['bo_idx'] == 1){
                    $sql = " select * from rater where user_id = '{$member['mb_id']}' and business_idx = '{$_GET['wr_idx']}' and test_id = '{$_GET['bo_idx']}'";
                    $result = sql_query($sql);
                    $row77 = sql_fetch_array($result);
                    if($row77 == ""){
                        alert("권한이 없습니다");
                    }

                    $file_idx = $row['idx'];

                } else if($_GET['bo_idx'] == 2){
                    $sql = " select * from rater where user_id = '{$member['mb_id']}' and business_idx = '{$_GET['wr_idx']}' and test_id = '{$_GET['bo_idx']}'";
                    $result = sql_query($sql);
                    $row77 = sql_fetch_array($result);
                    if($row77 == ""){
                        alert("권한이 없습니다");
                    }

                    $sql = " select * from report where business_idx = '{$row['idx']}' and report_idx = '1' and report = '2'";
                    $result = sql_query($sql);
                    $row_list = sql_fetch_array($result);

                    $file_idx = $row_list['idx'];
            ?> 
                <tr class="view_table_header_table"></tr>
                <tr>
                    <th scope="col" class="view_table_header " colspan="9">상세설명</th>
                </tr>
                <tr>
                    <td scope="col" class="view_table_text" colspan="9" style="">
                        <textarea name="" id=""class="input_text input_text_hight" readonly><?= $row_list['contents']; ?> </textarea>
                    </td>
                </tr>
            <?php
                } else if($_GET['bo_idx'] == 3){
                    $sql = " select * from report where business_idx = '{$row['idx']}' and report_idx = '2' and report = '2'";
                    $result = sql_query($sql);
                    $row77 = sql_fetch_array($result);
                    if($row77 == ""){
                        alert("권한이 없습니다");
                    }
                    
                    $sql = " select * from g5_business_propos where bo_idx = '{$_GET['wr_idx']}' AND";
                    $result = sql_query($sql);
                    $row_list = sql_fetch_array($result);
                    $file_idx = $row_list['idx'];
            ?>
                <tr class="view_table_header_table"></tr>
                <tr>
                    <th scope="col" class="view_table_header " colspan="9">상세설명</th>
                </tr>
                <tr>
                    <td scope="col" class="view_table_text" colspan="9" style="">
                        <textarea name="" id=""class="input_text input_text_hight" readonly><?= $row_list['contents']; ?> </textarea>
                    </td>
                </tr> 
            <?php
                }
            ?>


            <tbody id="view_table_upload">
                <tr class="view_table_header_table"></tr>
                <tr>
                    <th scope="col" class="view_table_header " colspan="9">자료첨부</th>
                </tr>
                <?php
                        $sql = " select * from g5_board_file where bo_table = 'g5_business_propos' and wr_id = '{$_GET['us_idx']}'";
                        $result = sql_query($sql);
                        
                        // 가변 파일
                            for ($i=0; $row_list = sql_fetch_array($result); $i++) {
                                if (isset($row_list['bf_source'][$i])) {
                        ?>
                                
                                <tr class="">
                                    <th scope="col" colspan="1" class="view_table_header" style="width:10%;">첨부파일</th>
                                    <td scope="col" colspan="1" class="view_table_text" style="width:10%;">
                                        <img src="<?php echo G5_IMG_URL ?>/download_icon.png" alt="<?php echo $config['cf_title']; ?>">
                                    </td>
                                    <td scope="col" colspan="5" class="view_table_text" style="width:80%;">
                                        <a href="<?= G5_BBS_URL ?>/download.php?bo_table=g5_business_propos&wr_id=<?= $row_list['wr_id'] ?>&no=<?= $row_list['bf_no'] ?>" class=""><?php echo $row_list['bf_source'] ?></a>
                                    </td>
                                </tr>
                        <?php
                            }
                        }
                    ?>
                     <?php
                        if($_GET['bo_idx'] == 2){
                            $sql = " select * from report where business_idx = '{$row['idx']}' and report_idx = '1' and report = '2'";
                            $result = sql_query($sql);
                            $row77 = sql_fetch_array($result);

                            $sql2 = " select * from g5_board_file where bo_table = 'report' and wr_id = '{$row77['us_idx']}'";
                            $result2 = sql_query($sql2);    
                        } else if($_GET['bo_idx'] == 3){
                            $sql = " select * from report where business_idx = '{$row['idx']}' and report_idx = '2' and report = '2'";
                            $result = sql_query($sql);
                            $row77 = sql_fetch_array($result);

                            $sql2 = " select * from g5_board_file where bo_table = 'report' and wr_id = '{$row77['idx']}'";
                            $result2 = sql_query($sql2);    
                        }

                        // 가변 파일
                            for ($i=0; $row_list2 = sql_fetch_array($result2); $i++) {
                                if (isset($row_list2['bf_source'][$i])) {
                        ?>
                                <tr class="">
                                    <th scope="col" colspan="1" class="view_table_header" style="width:10%;">첨부파일</th>
                                    <td scope="col" colspan="1" class="view_table_text" style="width:10%;">
                                        <img src="<?php echo G5_IMG_URL ?>/download_icon.png" alt="<?php echo $config['cf_title']; ?>">
                                    </td>
                                    <td scope="col" colspan="5" class="view_table_text" style="width:80%;">
                                        <a href="<?= G5_BBS_URL ?>/download.php?bo_table=g5_business_propos&wr_id=<?= $row_list['wr_id'] ?>&no=<?= $row_list2['bf_no'] ?>" class=""><?= $row_list2['bf_source'] ?></a>
                                    </td>
                                </tr>
                        <?php
                            }
                        }
                        ?>
            </tbody>
        </table>
    </div>
        <?php

            $sql = " select * from g5_write_business where wr_id = '{$_GET['wr_idx']}'";
            $result = sql_query($sql);
            $row4 = sql_fetch_array($result);

            $sql2 = "select * from rater where business_idx = '{$_GET['wr_idx']}' and user_id ='{$member['mb_id']}' and test_id = '{$_GET['bo_idx']}'";
            $result2 = sql_query($sql2);
            $row2 = sql_fetch_array($result2);

            $sql3 = " select * from rater_value where rater_idx = '{$row2['idx']}' and report_idx = '{$_GET['us_idx']}'";
            $result3 = sql_query($sql3);
            $row3 = sql_fetch_array($result3);     
         ?>

        <div class="btn_confirm write_div btn-cont">
            <a href="<?= G5_BBS_URL ?>/board.rater.php?bo_table=qa&bo_idx=<?= $_GET['bo_idx'] ?>&wr_idx=<?= $_GET['wr_idx'] ?>" class=" btn_color_white">이전</a>
            <button type="button" id="btn_submit2" accesskey="s" class="btn_submit btn btn_step4 btn_bo_val btn_color_white"><?= $row3['value']==2? "확인" :"평가"; ?></button>
            <button type="submit" id="btn_submit3" accesskey="s" class="btn_submit btn btn_step4" <?= $row3['value']==2? "disabled" :""; ?> style="background:<?= $row3['value']==2? "#ccc" :"#1D2E58"; ?>" ><?= $row3['value']==2? "제출완료" :"제출"; ?></button>

        </div>
    </div>
    </form>
</section>

<script>
jQuery(function($){
    $('.bo_sch_bg, .bo_sch_cls, .btn_esc').click(function(){
        $('.bo_sch_wrap').hide();
    });

    $('.btn_bo_val').click(function(){
        var td_title = $('#title_view').val();
        $('#sql_ko_title_view').text(td_title);
        $('.bo_sch_wrap').toggle();
    }) 

    var test_user = 0;
    var test_title = 0;
    var test_plan = 0;
    var test_sum = 0;

    $('#test_user').change(function(){
        test_user = parseFloat($('#test_user').val());
        test_title = parseFloat($('#test_title').val());
        test_plan = parseFloat($('#test_plan').val());

        test_sum = Number(test_user) + Number(test_title) + Number(test_plan);
        test_sum = test_sum/3;
        test_sum = test_sum.toFixed(2);
        
        $('#test_sum').val(test_sum);
        if($('#test_opinion').val() == "" || $('#test_user').val() == "" || $('#test_title').val() == "" || $('#test_plan').val() == "" && $('#value_btn_submit').text() == "저장"){
            $('#value_btn_submit').attr('disabled', true);
            $('#value_btn_submit').css({"background":"#ccc"});
        } else {
            $('#value_btn_submit').attr('disabled', false);
            $('#value_btn_submit').css({"background":"#1D2E58"});
        }
    });
    $('#test_title').change(function(){
        test_user = parseFloat($('#test_user').val());
        test_title = parseFloat($('#test_title').val());
        test_plan = parseFloat($('#test_plan').val());

        test_sum = Number(test_user) + Number(test_title) + Number(test_plan);
        test_sum = test_sum/3;
        test_sum = test_sum.toFixed(2);
        $('#test_sum').val(test_sum);
        
        if($('#test_opinion').val() == "" || $('#test_user').val() == "" || $('#test_title').val() == "" || $('#test_plan').val() == "" && $('#value_btn_submit').text() == "저장"){
            $('#value_btn_submit').attr('disabled', true);
            $('#value_btn_submit').css({"background":"#ccc"});
        } else {
            $('#value_btn_submit').attr('disabled', false);
            $('#value_btn_submit').css({"background":"#1D2E58"});
        }
    });
    $('#test_plan').change(function(){
        test_user = parseFloat($('#test_user').val());
        test_title = parseFloat($('#test_title').val());
        test_plan = parseFloat($('#test_plan').val());

        test_sum = Number(test_user) + Number(test_title) + Number(test_plan);
        test_sum = test_sum/3;
        test_sum = test_sum.toFixed(2);
        $('#test_sum').val(test_sum);
        
        if($('#test_opinion').val() == "" || $('#test_user').val() == "" || $('#test_title').val() == "" || $('#test_plan').val() == "" && $('#value_btn_submit').text() == "저장"){
            $('#value_btn_submit').attr('disabled', true);
            $('#value_btn_submit').css({"background":"#ccc"});
        } else {
            $('#value_btn_submit').attr('disabled', false);
            $('#value_btn_submit').css({"background":"#1D2E58"});
        }
    });
    $('#test_opinion').change(function(){
        if($('#test_opinion').val() == "" || $('#test_user').val() == "" || $('#test_title').val() == "" || $('#test_plan').val() == "" && $('#value_btn_submit').text() == "저장"){
            $('#value_btn_submit').attr('disabled', true);
            $('#value_btn_submit').css({"background":"#ccc"});
        } else {
            $('#value_btn_submit').attr('disabled', false);
            $('#value_btn_submit').css({"background":"#1D2E58"});
        }
    });

});
</script>
<div class="bo_sch_wrap">
<fieldset class="bo_sch" style="width:1030px; max-height:noen;height:780px;">
        <?php
            $sql = " select * from g5_write_business where wr_id = '{$_GET['wr_idx']}'";
            $result = sql_query($sql);
            $row4 = sql_fetch_array($result);

            $sql2 = "select * from rater where business_idx = '{$_GET['wr_idx']}' and user_id ='{$member['mb_id']}' and test_id = '{$_GET['bo_idx']}'";
            $result2 = sql_query($sql2);
            $row2 = sql_fetch_array($result2);

            $sql3 = " select * from rater_value where rater_idx = '{$row2['idx']}' and report_idx = '{$_GET['us_idx']}'";
            $result3 = sql_query($sql3);
            $row3 = sql_fetch_array($result3);

        ?>
        <div id="bo_btn_top_app" class="bo_btn_view_title">
            <h1 class="view_title">[<?= $row33['title']?>]<?php echo $row22['wr_subject']; ?></h1>
        </div>
           
        <form name="fsearch" method="POST" action="<?= G5_BBS_URL ?>/application_rater_update.php" >
        <input type="hidden" name="business_idx" id= "business_idx" value="<?= $_GET['wr_idx'] ?>">
        <input type="hidden" name="test_id"  value="<?= $_GET['bo_idx']?>">
        <input type="hidden" name="us_idx"  value="<?= $_GET['us_idx']?>">
        <input type="hidden" name="value_id"  value="1">
        <table class="view_table_app">
            <thead>
                <th colspan="1" style="width:10%" class="input_text_center">제목</th>
                <td  colspan="3" id="bo_title_view"><?= $row['ko_title']; ?></td>
            </thead>
            <tbody>
                <tr class="view_table_header_table "></tr>
                <tr class="input_text_center">
                    <th colspan="4">항목평가</th>
                </tr>
                <tr>
                    <th style="width:10%" class="input_text_center">연구진</th>  
                    <td style="width:40%">
                        <input type="number" name="test_user" id="test_user"  class="input_text input_text_80 input_text_end" placeholder="연구진" value="<?= $row3['test_user'] ?>" min="0" max="80">
                        <span class="">/80</span> 
                    </td>
                    <th style="width:10%" class="input_text_center">주제</th>  
                    <td style="width:40%">
                        <input type="number" name="test_title" id="test_title"  class="input_text input_text_80  input_text_end" placeholder="주제" value="<?= $row3['test_title'] ?>" min="0" max="80" > 
                        <span>/80</span>
                    </td>
                </tr>
                <tr>
                    <th  class="input_text_center">계획</th>  
                    <td>
                        <input type="number" name="test_plan" id="test_plan"  class="input_text input_text_80  input_text_end" placeholder="계획" value="<?= $row3['test_plan'] ?>" min="0" max="80" > 
                        <span>/80</span>
                    </td>
                    <th class="input_text_center">종합평가</th>  
                    <td>
                        <input type="number" name="test_sum" id="test_sum"  class="input_text input_text_80 input_text_end" placeholder="종합평가" value="<?= $row3['test_sum'] ?>" readonly > 
                        <span>/80</span>
                    </td>
                </tr>
                <tr class="input_text_center">
                    <th>평가의견</th>
                    <td colspan="3">
                        <textarea name="test_opinion" id="test_opinion" class="input_text input_text_100 input_text_hight" <?= $row44['report'] ==2? "disabled": ""; ?> cols="20" rows="10"><?= $row3['test_opinion'] ?></textarea>
                    </td>
                </tr>
            </tbody>
        </table> 
        <div class="rater_value_btn_contianer">
            <button type="button" class="btn_esc btn_color_white">취소</button>
            <?php if($row3['value'] != 2){ ?>
                <button type="submit" class="btn_submit" id="value_btn_submit" ><?= $row3['idx'] != ""? "수정" : "저장"; ?></button>
            <?php } ?>
        </div>
    </form>
</fieldset>
<div class="bo_sch_bg"></div>
</div>
<script>
        $(function(){
               
        })
</script>
            <!-- } 게시판 검색 끝 --> 


<?php if($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>

<?php } ?>


<!-- } 게시물 작성/수정 끝 -->

