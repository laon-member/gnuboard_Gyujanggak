<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
    
$sql1 = " SELECT * FROM `g5_write_business_title` ";
$result1 = sql_query($sql1);

$sql = " SELECT * FROM `g5_write_business` where wr_id = {$_GET[bo_idx]} ";
$result = sql_query($sql);
$row=sql_fetch_array($result);
?>
<aside id="bo_side">
    <h2 class="aside_nav">사업 공고</h2>
    <?php 
        for($k=1; $row1=sql_fetch_array($result1); $k++) {
            $class_get = $_GET['bo_idx'] == $row1['idx']?"aisde_click":"";
            echo '<a class="aside_nav '.$class_get.'" href="'.G5_BBS_URL .'/board.php?bo_table=business&bo_idx='.$k.'&page=1">'.$row1['title'].'</a>';
           
            if($_GET['bo_idx'] == $row1['idx']){
                $category_title =  $row1['title']; 
                $category_idx = $row1['idx'];
            }
        }
        
    ?>
</aside>
<section id="bo_v" style="width:80%;">
    <h2 class="sound_only"><?php echo $g5['title'] ?></h2>
    <!-- 게시물 작성/수정 시작 { -->
    <form name="fwrite" id="fwrite" action="<?php echo $action_url; ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" style="width:<?php echo $width; ?>">
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
    
    <div class ="step step1 step_view">
        <div class="bo_w_tit write_div">
            <h1>
                <?php echo $category_title; ?>
            </h1>
            <p><?php echo $row['wr_subject']; ?></p>
        </div>

        <div class="step_con">
            <div class="step_bar">
            <p class="step_text">step 1</p> 
            </div>
        </div>

        <div class="write_div">
            <label for="info_number" class="label_text">접수번호</label>
            <input type="text" name="info_number" id="info_number"  class="input_text input_text_50 " placeholder="접수번호">
            <label for="quest_number" class="label_text">과제번호</label>
            <input type="text" name="quest_number" id="quest_number"  class="input_text input_text_50" placeholder="과제번호">

            <p>연구과제명</p>
            <label for="ko_title" class="label_text">과제명(국문)</label>
            <input type="text" name="ko_title" id="ko_title"  class="input_text " placeholder="과제명(국문)" >
            <label for="en_title" class="label_text">과제명(영문)</label>
            <input type="text" name="en_title" id="en_title"  class="input_text " placeholder="과제명(영문)" >
    
            <p>연구책임자</p>
            <label for="name" class="label_text">성명</label>
            <input type="text" name="name" id="name"  class="input_text input_text_50" placeholder="성명" value="<?= $member['mb_name'] ?>">
            <label for="degree" class="label_text">전공(학위)</label>
            <input type="text" name="degree" id="degree"  class="input_text input_text_50" placeholder="전공(학위)" >
            <label for="belong" class="label_text">소속</label>
            <input type="text" name="belong" id="belong"  class="input_text input_text_50" placeholder="소속"  >
            <label for="rank" class="label_text">직급</label>
            <input type="text" name="rank" id="rank"  class="input_text input_text_50" placeholder="직급" >
            <label for="email" class="label_text">이메일</label>
            <input type="text" name="email" id="email"  class="input_text input_text_50" placeholder="이메일" value="<?= $member['mb_email'] ?>">
            <label for="phone" class="label_text">전화</label>
            <input type="text" name="phone" id="phone"  class="input_text input_text_50" placeholder="전화" > 
        </div>

        <div class="btn_confirm write_div btn-cont">
            <button type="button" id="btn_submit" accesskey="s" class="btn_submit btn btn_step2">다음</button>
        </div>
    </div>
    <div class ="step step2 ">
        <div class="bo_w_tit write_div">
            <h1>
                <?php echo $category_title; ?>
            </h1>
            <p><?php echo $row['wr_subject']; ?></p>
        </div>

        <div class="step_con">
            <div class="step_bar">
            <p class="step_text">step 2</p> 
            </div>
        </div>

        <div class="write_div">
            <label for="main_member" class="label_text">공동연구원</label>
            <input type="text" name="main_member" id="main_member"  class="input_text input_text_50 input_text_right" placeholder="명">
            <label for="sub_member" class="label_text">연구원보조</label>
            <input type="text" name="sub_member" id="sub_member"  class="input_text input_text_50 input_text_right" placeholder="명">
            <p class="sub_text">* 연구책임자 제외</p>

            <label for="date_start" class="label_text">총 연구 기간</label>
            <input type="date" name="date_start" id="date_start"  class="input_text input_text_50">
            <input type="date" name="date_end" id="date_end"  class="input_text input_text_50">
            <br>
            <label for="value" class="label_text">연구비신청액</label>
            <input type="text" name="value" id="value"  class="input_text " placeholder="연구비신청액" >
            <label for="one_year" class="label_text">1차년 연구비</label>
            <input type="text" name="one_year" id="one_year"  class="input_text input_text_50" placeholder="1차년 연구비">
            <label for="two_year" class="label_text">2차년 연구비</label>
            <input type="text" name="two_year" id="two_year"  class="input_text input_text_50" placeholder="2차년 연구비">

        </div>
        <div class="bo_w_flie write_div">
            <p>자료첨부</p>
            <?php for ($i=0; $is_file && $i<4; $i++) { ?>
                <div class="input-file">
                    <input type="text" id="file_label_view<?= $i ?>" readonly="readonly" class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능"/>
                    <label for="upload0<?php echo $i ?>" class="file-label">찾아보기</label>
                    <input type="file" name="bf_file[<?php echo $i ?>]" id="upload0<?php echo $i ?>" class="file-upload" value=""/>
                    <button type="button" class="file-label file-del " id="file-del<?= $i ?>">삭제</button>
                </div>
            <?php } ?>
        </div>

        <div class="btn_confirm write_div btn-cont">
            <button type="button" id="btn_submit1" accesskey="s" class="btn_cancel btn btn_step1">이전</button>
            <button type="button" id="btn_submit2" accesskey="s" class="btn_submit btn btn_step3">다음</button>
        </div>
    </div>
    <div class ="step step3">
        <div class="bo_w_tit write_div">
            <h1>
                <?php echo $category_title; ?>
            </h1>
            <p><?php echo $row['wr_subject']; ?></p>
        </div>

        <div class="step_con">
            <div class="step_bar">
            <p class="step_text">step 3</p> 
            </div>
        </div>

        <div class="write_div">
            <label for="info_number_view" class="label_text">접수번호</label>
            <input type="text" name="info_number_view" id="info_number_view"  class="input_text input_text_50 input_text_end" placeholder="접수번호"  readonly>

            <label for="quest_number_view" class="label_text">과제번호</label>
            <input type="text" name="quest_number_view" id="quest_number_view"  class="input_text input_text_50 input_text_end" placeholder="과제번호" value="<?php echo $quest_number ?>" readonly>

            <p>연구과제명</p>
            <label for="ko_title_view" class="label_text">과제명(국문)</label>
            <input type="text" name="ko_title_view" id="ko_title_view"  class="input_text input_text_end" placeholder="과제명(국문)"readonly>
            
            <label for="en_title_view" class="label_text">과제명(영문)</label>
            <input type="text" name="en_title_view" id="en_title_view"  class="input_text input_text_end" placeholder="과제명(영문)" readonly>
    
            <p>연구책임자</p>
            <label for="name_view" class="label_text">성명</label>
            <input type="text" name="name_view" id="name_view"  class="input_text input_text_50 input_text_end" placeholder="성명" readonly>
            
            <label for="degree_view" class="label_text">전공(학위)</label>
            <input type="text" name="degree_view" id="degree_view"  class="input_text input_text_50 input_text_end" placeholder="전공(학위)" readonly>

            <label for="belong_view" class="label_text">소속</label>
            <input type="text" name="belong_view" id="belong_view"  class="input_text input_text_50 input_text_end" placeholder="소속" readonly>

            <label for="rank_view" class="label_text">직급</label>
            <input type="text" name="rank_view" id="rank_view"  class="input_text input_text_50 input_text_end" placeholder="직급" readonly>

            <label for="email_view" class="label_text">이메일</label>
            <input type="text" name="email_view" id="email_view"  class="input_text input_text_50 input_text_end" placeholder="이메일" readonly>

            <label for="phone_view" class="label_text">전화</label>
            <input type="text" name="phone_view" id="phone_view"  class="input_text input_text_50 input_text_end" placeholder="전화" readonly>

            <label for="main_member_view" class="label_text">공동연구원</label>
            <input type="text" name="main_member_view" id="main_member_view"  class="input_text input_text_50  input_text_end" placeholder="명" readonly>

            <label for="sub_member_view" class="label_text">연구원보조</label>
            <input type="text" name="sub_member_view" id="sub_member_view"  class="input_text input_text_50  input_text_end" placeholder="명" readonly>
            
            <p class="">연구정보</p>
            <label for="date_start_view" class="label_text">총 연구 기간</label>
            <input type="date" name="date_start_view" id="date_start_view"  class="input_text input_text_50 input_text_end" readonly>
            <input type="date" name="date_end_view" id="date_end_view"  class="input_text input_text_50 input_text_end" readonly>
            <br>
            <label for="money_view" class="label_text">연구비신청액</label>
            <input type="text" name="money_view" id="money_view"  class="input_text input_text_end" placeholder="연구비신청액" value="<?php echo $value ?>" readonly>
            
            <label for="one_year_view" class="label_text">1차년 연구비</label>
            <input type="text" name="one_year_view" id="one_year_view"  class="input_text input_text_50 input_text_end" placeholder="1차년 연구비" readonly>

            <label for="two_year_view" class="label_text">2차년 연구비</label>
            <input type="text" name="two_year_view" id="two_year_view"  class="input_text input_text_50 input_text_end" placeholder="2차년 연구비" readonly>

            <label for="" class="label_text">자료첨부</label>
            <div class="input_file_cont">
                <input type="text" name="form_file0" id="form_file0"  class="input_text_100 input_text input_text_end form_file" readonly>
                <input type="text" name="form_file1" id="form_file1"  class="input_text_100 input_text input_text_end form_file" readonly>
                <input type="text" name="form_file2" id="form_file2"  class="input_text_100 input_text input_text_end form_file" readonly>
                <input type="text" name="form_file3" id="form_file3"  class="input_text_100 input_text input_text_end form_file" readonly>
            </div>
        </div>

        <div class="btn_confirm write_div btn-cont">
            <button type="button" id="btn_submit1" accesskey="s" class="btn_cancel btn btn_step2">이전</button>
            <button type="submit" id="btn_submit2" accesskey="s" class="btn_submit btn btn_step4">다음</button>
        </div>
    </div>
    </form>
</section>

<script>
    
    $(function(){
        $('.btn_step1').click(function(){
            $('.step').removeClass('step_view');
            $('.step1').addClass('step_view');
        });
        $('.btn_step2').click(function(){
            $('.step').removeClass('step_view');
            $('.step2').addClass('step_view');
        });
        $('.btn_step3').click(function(){
            $('.step').removeClass('step_view');
            $('.step3').addClass('step_view');
        });
        $('#info_number').change(function(){
            $('#info_number_view').val($(this).val());
        });
        $('#quest_number').change(function(){
            $('#quest_number_view').val($(this).val());
        });
        $('#ko_title').change(function(){
            $('#ko_title_view').val($(this).val());
        });
        $('#en_title').change(function(){
            $('#en_title_view').val($(this).val());
        });
        $('#name').change(function(){
            $('#name_view').val($(this).val());
        });
        $('#degree').change(function(){
            $('#degree_view').val($(this).val());
        });
        $('#belong').change(function(){
            $('#belong_view').val($(this).val());
        });
        $('#rank').change(function(){
            $('#rank_view').val($(this).val());
        });
        $('#email').change(function(){
            $('#email_view').val($(this).val());
        });
        $('#phone').change(function(){
            $('#phone_view').val($(this).val());
        });
        $('#main_member').change(function(){
            $('#main_member_view').val($(this).val());
        });
        $('#sub_member').change(function(){
            $('#sub_member_view').val($(this).val());
        });
        $('#date_start').change(function(){
            $('#date_start_view').val($(this).val());
        });
        $('#date_end').change(function(){
            $('#date_end_view').val($(this).val());
        });
        $('#money').change(function(){
            $('#money_view').val($(this).val());
        });
        $('#one_year').change(function(){
            $('#one_year_view').val($(this).val());
        });
        $('#two_year').change(function(){
            $('#two_year_view').val($(this).val());
        });
        $('#upload00').change(function(){
            var fileValue = $(this).val().split("\\");
            var fileName = fileValue[fileValue.length-1]; // 파일명
            if(fileName != ""){
                $('#file_label_view0').val(fileName);
                $('#form_file0').removeClass('form_file');
                $('#form_file0').addClass('form_file_view');
                $('#form_file0').val(fileName);
            } else {
                $('#form_file0').removeClass('form_file_view');
                $('#form_file0').addClass('form_file');
            }
        })
        $('#upload01').change(function(){
            var fileValue = $(this).val().split("\\");
            var fileName = fileValue[fileValue.length-1]; // 파일명
            if(fileName != ""){
                $('#file_label_view1').val(fileName);
                $('#form_file1').removeClass('form_file');
                $('#form_file1').addClass('form_file_view');
                $('#form_file1').val(fileName);
            }  else {
                $('#form_file1').removeClass('form_file_view');
                $('#form_file1').addClass('form_file');
            }  
        })
        $('#upload02').change(function(){
            var fileValue = $(this).val().split("\\");
            var fileName = fileValue[fileValue.length-1]; // 파일명
            if(fileName != ""){
                $('#file_label_view2').val(fileName);
                $('#form_file2').removeClass('form_file');
                $('#form_file2').addClass('form_file_view');
                $('#form_file2').val(fileName);
            } else {
                $('#form_file2').removeClass('form_file_view');
                $('#form_file2').addClass('form_file');
            }   
        })
        $('#upload03').change(function(){
            var fileValue = $(this).val().split("\\");
            var fileName = fileValue[fileValue.length-1]; // 파일명
            if(fileName != ""){
                $('#file_label_view3').val(fileName);
                $('#form_file3').removeClass('form_file');
                $('#form_file3').addClass('form_file_view');
                $('#form_file3').val(fileName);
            } else {
                $('#form_file3').removeClass('form_file_view');
                $('#form_file3').addClass('form_file');
            }
        })

            $('#file-del0').click(function(){
                $('#upload00').val("");
                $('#file_label_view0').val("");
                $('#form_file0').removeClass('form_file_view');
                $('#form_file0').addClass('form_file');
                $('#form_file0').val("");
            })
            $('#file-del1').click(function(){
                $('#upload01').val("");
                $('#file_label_view1').val("");
                $('#form_file1').removeClass('form_file_view');
                $('#form_file1').addClass('form_file');
                $('#form_file1').val("");
            })
            $('#file-del2').click(function(){
                $('#upload02').val("");
                $('#file_label_view2').val("");
                $('#form_file2').removeClass('form_file_view');
                $('#form_file2').addClass('form_file');
                $('#form_file2').val("");
            })
            $('#file-del3').click(function(){
                $('#upload03').val("");
                $('#file_label_view3').val("");
                $('#form_file3').removeClass("form_file_view");
                $('#form_file3').addClass('form_file_view');
                $('#form_file').val("");
            })

    })
</script>


<!-- } 게시물 작성/수정 끝 -->

