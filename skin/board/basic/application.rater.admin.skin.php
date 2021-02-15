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
    <h2 class="aside_nav_title">심사 관리</h2>
   
    <a class="aside_nav <?= $_GET['bo_idx'] == 1?"aisde_click":""; ?>" href="<?= G5_BBS_URL ?>/board.rater.admin.php?bo_table=<?= $bo_table ?>&bo_idx=1&u_id=1">지원자 선발</a>
    <a class="aside_nav <?= $_GET['bo_idx'] == 2?"aisde_click":""; ?>" href="<?= G5_BBS_URL ?>/board.rater.admin.php?bo_table=<?= $bo_table ?>&bo_idx=2&u_id=1">중간보고서</a>
    <a class="aside_nav <?= $_GET['bo_idx'] == 3?"aisde_click":""; ?>" href="<?= G5_BBS_URL ?>/board.rater.admin.php?bo_table=<?= $bo_table ?>&bo_idx=3&u_id=1">결과(연차)보고서</a>
</aside>
<section id="bo_v" style="width:80%;">
    <h2 class="sound_only"><?php echo $g5['title'] ?></h2>
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
    <input type="hidden" name="bo_idx" value="<?php echo $_GET['bo_idx'] ?>">
    <input type="hidden" name="business_idx" id= "business_idx" value="<?= $_GET['wr_idx'] ?>">
    <input type="hidden" name="test_id"  value="<?= $_GET['bo_idx']?>">
    <input type="hidden" name="value_id"  value="2">
    <input type="hidden" name="us_idx"  value="<?= $row['idx']; ?>">
    
    
    <div class =" ">
        <div class="bo_w_tit write_div">
            <h1 class="view_title"><?=  $category_title ?>[<?= $row33['title']?>]<?php echo $row22['wr_subject']; ?></h1>
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
                    <input type="text" name="info_number_view" id="info_number_view"  class="input_text input_text_100 input_text_end" placeholder="접수번호" value="<?= $row['info_number']; ?>"  readonly required>
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
                    <input type="text" name="ko_title_view" id="ko_title_view"  class="input_text input_text_end" placeholder="과제명(국문)"readonly  value="<?= $row['ko_title']; ?>">
                    </td>
                </tr>
                <tr>
                    <th scope="col" class="view_table_header" colspan="1" style="">과제명(영문)</th>
                    <td scope="col" class="view_table_text" colspan="8" style="">
                    <input type="text" name="en_title_view" id="en_title_view"  class="input_text input_text_end" placeholder="과제명(영문)" readonly value="<?= $row['en_title']; ?>">
                    </td>
                </tr>
                <tr class="view_table_header_table"></tr>
                <tr>
                    <th scope="col" class="view_table_header " colspan="9">연구책임자</th>
                </tr>
                <tr>
                    <th scope="col" class="view_table_header" colspan="1" style="">성명</th>
                    <td scope="col" class="view_table_text" colspan="4" style="">
                    <input type="text" name="name_view" id="name_view"  class="input_text input_text_100 input_text_end" placeholder="성명" readonly value="<?= $row['name']; ?>">
                    </td>
                    <th scope="col" class="view_table_header" colspan="1" style="">전공(학위)</th>
                    <td scope="col" class="view_table_text" colspan="3" style="">
                    <input type="text" name="degree_view" id="degree_view"  class="input_text input_text_100 input_text_end" placeholder="전공(학위)" readonly value="<?= $row['degree']; ?>">
                    </td>
                </tr>
                <tr>
                    <th scope="col" class="view_table_header" colspan="1" style="">소속</th>
                    <td scope="col" class="view_table_text" colspan="4" style="">
                    <input type="text" name="belong_view" id="belong_view"  class="input_text input_text_100 input_text_end" placeholder="소속" readonly value="<?= $row['belong']; ?>">
                    </td>
                    <th scope="col" class="view_table_header" colspan="1" style="">직급</th>
                    <td scope="col" class="view_table_text" colspan="3" style="">
                    <input type="text" name="rank_view" id="rank_view"  class="input_text input_text_100 input_text_end" placeholder="직급" readonly value="<?= $row['rank']; ?>">
                    </td>
                </tr>
                <tr>
                    <th scope="col" class="view_table_header" colspan="1" style="">이메일</th>
                    <td scope="col" class="view_table_text" colspan="4" style="">
                    <input type="text" name="email_view" id="email_view"  class="input_text input_text_100 input_text_end" placeholder="이메일" readonly value="<?= $row['email']; ?>">
                    </td>
                    <th scope="col" class="view_table_header" colspan="1" style="">전화</th>
                    <td scope="col" class="view_table_text" colspan="3" style="">
                    <input type="text" name="phone_view" id="phone_view"  class="input_text input_text_100 input_text_end" placeholder="전화" readonly value="<?= $row['phone']; ?>">
                    </td>
                </tr>
            
                <tr>
                    <th scope="col" class="view_table_header" style="">공동연구원</th>
                    <td scope="col" class="view_table_text" colspan="4" style="">
                    <input type="text" name="main_member_view" id="main_member_view"  class="input_text input_text_100  input_text_end" placeholder="명" readonly value="<?= $row['main_member']; ?>명">

                    </td>
                    <th scope="col" class="view_table_header" style="">연구원보조</th>
                    <td scope="col" class="view_table_text" colspan="3" style="">
            <input type="text" name="sub_member_view" id="sub_member_view"  class="input_text input_text_100  input_text_end" placeholder="명" readonly value="<?= $row['sub_member']; ?>명">
                    </td>
                </tr>
                <tr class="view_table_header_table"></tr>
                <tr>
                    <th scope="col" class="view_table_header " colspan="9">연구정보</th>
                </tr>
                <tr>
                    <th scope="col" class="view_table_header" colspan="1"style="">총 연구 기간</th>
                    <td scope="col" class="view_table_text" colspan="8" style="">
                        <input type="text" name="date_start_view" id="date_start_view" placeholder="총 연구 기간"  class="input_text" value="<?= $row['date_start']; ?> ~ <?= $row['date_end']; ?>" readonly>
                    </td>
                </tr>
                <tr>
                    <th scope="col" class="view_table_header" colspan="1" style="">연구비신청액</th>
                    <td scope="col" class="view_table_text" colspan="8" style="">
                        <input type="text" name="money_view" id="money_view"  class="input_text input_text_end" placeholder="연구비신청액" readonly value="<?= number_format($row['money']); ?>원">
                    </td>
                </tr>
                <tr>
                    <th scope="col" class="view_table_header" colspan="1" style="">1차년 연구비</th>
                    <td scope="col" class="view_table_text" colspan="4" style=" width:40%">
                        <input type="text" name="one_year_view" id="one_year_view"  class="input_text input_text_100 input_text_end" placeholder="1차년 연구비" readonly value="<?= number_format($row['one_year']); ?>원">
                    </td>
                    <th scope="col" class="view_table_header" colspan="1" style="">2차년 연구비</th>
                    <td scope="col" class="view_table_text" colspan="3" style="">
                        <input type="text" name="two_year_view" id="two_year_view"  class="input_text input_text_100 input_text_end" placeholder="2차년 연구비" readonly value="<?= number_format($row['two_year']); ?>원">
                    </td>
                </tr>
            </tbody>
            <?php
            $file_idx = '';
                if($_GET['bo_idx'] == 1){
                    $sql = " select * from rater where user_id = '{$member['mb_id']}' and business_idx = '{$_GET['wr_idx']}' and test_id = '{$_GET['bo_idx']}'";
                    $result = sql_query($sql);
                    $row77 = sql_fetch_array($result);

                    $file_idx = $row['idx'];

                } else if($_GET['bo_idx'] == 2){
                    $sql = " select * from rater where user_id = '{$member['mb_id']}' and business_idx = '{$_GET['wr_idx']}' and test_id = '{$_GET['bo_idx']}'";
                    $result = sql_query($sql);
                    $row77 = sql_fetch_array($result);
                   
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
                    $sql = " select * from rater where user_id = '{$member['mb_id']}' and business_idx = '{$_GET['wr_idx']}' and test_id = '{$_GET['bo_idx']}'";
                    $result = sql_query($sql);
                    $row77 = sql_fetch_array($result);
                    
                    $sql = " select * from report where business_idx = '{$row['idx']}' and report_idx = '2' and report = '2'";
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

                            $sql2 = " select * from g5_board_file where bo_table = 'report' and wr_id = '{$row77['idx']}'";
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
        <div class="btn_confirm write_div btn-cont td_right">
            <a href="javascript:history.back();" class="btn_submit btn btn_step4 text_inline_block" style="display:inlin_block">확인</a>
        </div>
    </div>
    </form>
</section>

<script>
jQuery(function($){
    // 게시판 검색
    $(".btn_bo_val").on("click", function() {
        $('.bo_sch_wrap').toggle();

    })
    $('.bo_sch_bg, .bo_sch_cls, .btn_esc').click(function(){
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
    <fieldset class="bo_sch" style="width:800px; max-height:noen;height:600px;">

        <p id="sql_title_view"><?php echo $row22['wr_subject']; ?></p>
        <h3 id="sql_ko_title_view"><?= $row['ko_title']; ?></h3>
        <form name="fsearch" method="POST" action="<?= $action_url; ?>">
        <input type="hidden" name="business_idx" id= "business_idx" value="<?= $_GET['wr_idx'] ?>">
        <input type="hidden" name="test_id"  value="<?= $_GET['bo_idx']?>">
        <input type="hidden" name="value_id"  value="1">
        <input type="hidden" name="us_idx"  value="<?= $_GET['us_idx'] ?>">
        
        <label for="" class="label_text" style="display:block !important;">항목평가</label>
        <label for="test_user" class="label_text" style="vertical-align: inherit;">연구진</label>
        <input type="number" name="test_user" id="test_user"  class="input_text input_text_40 input_text_end" placeholder="연구진" value="<?= $row['info_number']; ?>"  maxlength="80"> 
        <span>/80</span>
        <label for="test_title" class="label_text" style="vertical-align: inherit;">주제</label>
        <input type="number" name="test_title" id="test_title"  class="input_text input_text_40 input_text_end" placeholder="주제" value="<?= $row['info_number']; ?>"    maxlength="80" > 
        <span>/80</span>
        <label for="test_plan" class="label_text" style="vertical-align: inherit;">계획</label>
        <input type="number" name="test_plan" id="test_plan"  class="input_text input_text_40 input_text_end" placeholder="계획" value="<?= $row['info_number']; ?>"    maxlength="80"> 
        <span>/80</span>
        <label for="test_sum" class="label_text" style="vertical-align: inherit;">종합평가</label>
        <input type="number" name="test_sum" id="test_sum"  class="input_text input_text_40 input_text_end" placeholder="종합평가" readonly > 
        <span>/80</span>
        <label for="test_opinion" class="label_text" style="vertical-align: top;">상세설명</label>
        <input type="text" name="test_opinion" id ="test_opinion" class="input_text input_text_hight" value="<?= $row44['contents']; ?>"<?= $row44['report'] ==2? "disabled": ""; ?>> 
        <div class="rater_value_btn_contianer">
            <button type="button" class="btn_esc">취소</button>
            <button type="submit" class="btn_submit">저장</button>
        </div>
        </form>
        
    </fieldset>
    <div class="bo_sch_bg"></div>
    
</div>






<!-- } 게시물 작성/수정 끝 -->

