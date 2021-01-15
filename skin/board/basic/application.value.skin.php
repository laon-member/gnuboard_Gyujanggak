<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
    
$sql1 = " SELECT * FROM `g5_business_propos` where idx = '{$_GET['us_idx']}'";
$result1 = sql_query($sql1);
$row=sql_fetch_array($result1);



?>
<aside id="bo_side">
    <h2 class="aside_nav">지원결과 확인</h2>
    <?php $class_get =  $_GET['bo_idx'] == '1'?"aisde_click":""; ?>
    <a class="aside_nav aisde_click" href="<?= G5_BBS_URL ?>/board.value.php?bo_table=business&bo_idx=1">지원결과 확인</a>
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
    <input type="hidden" name="business_idx" id= "business_idx" value="<?= $_GET['wr_idx'] ?>">
    <input type="hidden" name="test_id"  value="<?= $_GET['bo_idx']?>">
    <input type="hidden" name="value_id"  value="2">
    <input type="hidden" name="us_idx"  value="<?= $row['idx']; ?>">
    
    <?php
        $sql66 = " select * from rater where user_id = '{$member['mb_id']}' and business_idx = '{$_GET['wr_idx']}' and test_id = '{$_GET['bo_idx']}'";
        $result66 = sql_query($sql66);
        $row66 = sql_fetch_array($result66);

        
    ?>
    
    <input type="hidden" name="us_idx" id="form_us_idx" value="<?= $_GET['bo_idx']; ?>">
    <input type="hidden" name="rater_idx" id="form_rater_idx" value="<?= $row66['idx']; ?>">
    <input type="hidden" name="bo_idx" id="form_rater_idx" value="<?= $_GET['us_idx']; ?>">
    
    
    <div class =" ">
        <div class="bo_w_tit write_div">
            <h1>
                <?php echo $row22['wr_subject']; ?>
            </h1>
            <p class="ko_title"><?= $row['ko_title']; ?></p>
        </div>

        <div class="write_div">
            <label for="info_number_view" class="label_text">접수번호</label>
            <input type="text" name="info_number_view" id="info_number_view"  class="input_text input_text_50 input_text_end" placeholder="접수번호" value="<?= $row['info_number']; ?>"  readonly required>

            <label for="quest_number_view" class="label_text">과제번호</label>
            <input type="text" name="quest_number_view" id="quest_number_view"  class="input_text input_text_50 input_text_end" placeholder="과제번호" value="<?= $row['quest_number']; ?>" readonly>

            <p>연구과제명</p>
            <label for="ko_title_view" class="label_text">과제명(국문)</label>
            <input type="text" name="ko_title_view" id="ko_title_view"  class="input_text input_text_end" placeholder="과제명(국문)"readonly  value="<?= $row['ko_title']; ?>">
            
            <label for="en_title_view" class="label_text">과제명(영문)</label>
            <input type="text" name="en_title_view" id="en_title_view"  class="input_text input_text_end" placeholder="과제명(영문)" readonly value="<?= $row['en_title']; ?>">
    
            <p>연구책임자</p>
            <label for="name_view" class="label_text">성명</label>
            <input type="text" name="name_view" id="name_view"  class="input_text input_text_50 input_text_end" placeholder="성명" readonly value="<?= $row['name']; ?>">
            
            <label for="degree_view" class="label_text">전공(학위)</label>
            <input type="text" name="degree_view" id="degree_view"  class="input_text input_text_50 input_text_end" placeholder="전공(학위)" readonly value="<?= $row['degree']; ?>">

            <label for="belong_view" class="label_text">소속</label>
            <input type="text" name="belong_view" id="belong_view"  class="input_text input_text_50 input_text_end" placeholder="소속" readonly value="<?= $row['belong']; ?>">

            <label for="rank_view" class="label_text">직급</label>
            <input type="text" name="rank_view" id="rank_view"  class="input_text input_text_50 input_text_end" placeholder="직급" readonly value="<?= $row['rank']; ?>">

            <label for="email_view" class="label_text">이메일</label>
            <input type="text" name="email_view" id="email_view"  class="input_text input_text_50 input_text_end" placeholder="이메일" readonly value="<?= $row['email']; ?>">

            <label for="phone_view" class="label_text">전화</label>
            <input type="text" name="phone_view" id="phone_view"  class="input_text input_text_50 input_text_end" placeholder="전화" readonly value="<?= $row['phone']; ?>">

            <label for="main_member_view" class="label_text">공동연구원</label>
            <input type="text" name="main_member_view" id="main_member_view"  class="input_text input_text_50  input_text_end" placeholder="명" readonly value="<?= $row['main_member']; ?>">

            <label for="sub_member_view" class="label_text">연구원보조</label>
            <input type="text" name="sub_member_view" id="sub_member_view"  class="input_text input_text_50  input_text_end" placeholder="명" readonly value="<?= $row['sub_member']; ?>">
            
            <p class="">연구정보</p>
            <label for="date_start_view" class="label_text">총 연구 기간</label>
            <input type="date" name="date_start_view" id="date_start_view"  class="input_text input_text_50 input_text_end" readonly value="<?= $row['date_start']; ?>">
            <input type="date" name="date_end_view" id="date_end_view"  class="input_text input_text_50 input_text_end" readonly value="<?= $row['date_end']; ?>">
            <br>
            <label for="money_view" class="label_text">연구비신청액</label>
            <input type="text" name="money_view" id="money_view"  class="input_text input_text_end" placeholder="연구비신청액" value="<?php echo $value ?>" readonly value="<?= $row['money']; ?>">
            
            <label for="one_year_view" class="label_text">1차년 연구비</label>
            <input type="text" name="one_year_view" id="one_year_view"  class="input_text input_text_50 input_text_end" placeholder="1차년 연구비" readonly value="<?= $row['one_year']; ?>">

            <label for="two_year_view" class="label_text">2차년 연구비</label>
            <input type="text" name="two_year_view" id="two_year_view"  class="input_text input_text_50 input_text_end" placeholder="2차년 연구비" readonly value="<?= $row['two_year']; ?>">
            
           
            

            <!-- 첨부파일 시작 { -->
            <section id="bo_v_files" style="text-align:left;">
                <label for="" class="label_text">자료첨부</label>

                <ul class="download_file download_file_view" style="width: 80%;"> 
                    <?php
                        $sql = " select * from g5_board_file where bo_table = 'g5_business_propos' and wr_id = '{$_GET['us_idx']}'";
                        $result = sql_query($sql);
                        
                        // 가변 파일
                            for ($i=0; $row_list = sql_fetch_array($result); $i++) {
                                if (isset($row_list['bf_source'][$i])) {
                        ?>
                                <li class="" style="text-align:left; margin: 20px 0 10px 10px;">
                                    <a href="<?= G5_BBS_URL ?>/download.php?bo_table=g5_business_propos&wr_id=<?= $row_list['wr_id'] ?>&no=<?= $row_list['bf_no'] ?>" class="" ><i class="fa fa-download" aria-hidden="true" style="padding:0 10px;"></i><?php echo $row_list['bf_source'] ?></a>
                                </li>
                        <?php
                            }
                        }
                    ?>

                    
                </ul>
                
            </section>
            
        </div>

        <div class="btn_confirm write_div btn-cont">
        <a href="<?= G5_BBS_URL ?>/board.value.php?bo_table=business&bo_idx=<?= $_GET['bo_idx'] ?>" class="btn_cancel btn btn_step2">확인</a>
        </div>
    </div>
    </form>
</section>


<?php if($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>

<?php } ?>


<!-- } 게시물 작성/수정 끝 -->

