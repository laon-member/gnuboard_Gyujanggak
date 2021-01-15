<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
    
$sql1 = " select * from g5_write_business_title where bo_table = '{$_GET['bo_table']}'";
$result1 = sql_query($sql1);

$sql = " SELECT * FROM `g5_write_business` where wr_id = {$_GET['wr_id']} ";
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
            <p class="step_text step_bar1">Step 1</p> 
            </div>
        </div>

        <div class="write_div">
            <label for="info_number" class="label_text">접수번호</label>
            <input type="text" name="info_number" id="info_number"  class="input_text input_text_50 " placeholder="접수번호">
            <label for="quest_number" class="label_text">과제번호</label>
            <input type="text" name="quest_number" id="quest_number"  class="input_text input_text_50" placeholder="과제번호" value="<?= $row['wr_quest_number']; ?>" readonly>

            <p>연구과제명</p>
            <label for="ko_title" class="label_text">과제명(국문)</label>
            <input type="text" name="ko_title" id="ko_title"  class="input_text " placeholder="과제명(국문)" >
            <label for="en_title" class="label_text">과제명(영문)</label>
            <input type="text" name="en_title" id="en_title"  class="input_text " placeholder="과제명(영문)" onkeydown="onlyAlphabet(this)">
    
            <p>연구책임자</p>
            <label for="name" class="label_text">성명</label>
            <input type="text" name="name" id="name"  class="input_text input_text_50" placeholder="성명">
            <label for="degree" class="label_text">전공(학위)</label>
            <input type="text" name="degree" id="degree"  class="input_text input_text_50" placeholder="전공(학위)" >
            <label for="belong" class="label_text">소속</label>
            <input type="text" name="belong" id="belong"  class="input_text input_text_50" placeholder="소속"  >
            <label for="rank" class="label_text">직급</label>
            <input type="text" name="rank" id="rank"  class="input_text input_text_50" placeholder="직급" >
            <label for="email" class="label_text">이메일</label>
            <input type="text" name="email" id="email"  class="input_text input_text_50" placeholder="이메일">
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
            <div class="step_bar step_bar2">
            <p class="step_text ">Step 2</p> 
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
            <input type="text" name="money" id="money"  class="input_text " placeholder="연구비신청액" >
            <label for="one_year" class="label_text">1차년 연구비</label>
            <input type="text" name="one_year" id="one_year"  class="input_text input_text_50" placeholder="1차년 연구비">
            <label for="two_year" class="label_text">2차년 연구비</label>
            <input type="text" name="two_year" id="two_year"  class="input_text input_text_50" placeholder="2차년 연구비">

        </div>
            <label for="" id="bo_side"  class="label_text" style="text-align:left">자료첨부</label>
            <section id="bo_v"  class="bo_class">
            <?php echo "<script>var file_number = 1;</script>"; ?> 
            <?php $file_number = "<script>document.writeln(file_number);</script>"; ?>
                <label for="upload01" id="file-label-btn" class="file-label" style="background:<?= $row44['report'] ==2? '#ccc': '#3a8afd'; ?>">파일 업로드</label>
                <div class="input-file input_file_text">
                    <p class="file-name">파일명</p>
                    <p class="file-name file-size">파일 용량</p>
                    <p class="file-name file-size">파일 삭제</p>
                </div>
            </section>
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
            <div class="step_bar step_bar3">
            <p class="step_text ">Step 3</p> 
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
            <input type="text" name="date_start_view" id="date_start_view"  class="input_text input_text_50 input_text_end" readonly>
            <input type="text" name="date_end_view" id="date_end_view"  class="input_text input_text_50 input_text_end" readonly>
            <br>
            <label for="money_view" class="label_text">연구비신청액</label>
            <input type="text" name="money_view" id="money_view"  class="input_text input_text_end" placeholder="연구비신청액" value="<?php echo $value ?>" readonly>
            
            <label for="one_year_view" class="label_text">1차년 연구비</label>
            <input type="text" name="one_year_view" id="one_year_view"  class="input_text input_text_50 input_text_end" placeholder="1차년 연구비" readonly>

            <label for="two_year_view" class="label_text">2차년 연구비</label>
            <input type="text" name="two_year_view" id="two_year_view"  class="input_text input_text_50 input_text_end" placeholder="2차년 연구비" readonly>

            <label for="" class="label_text">자료첨부</label>
            <div class="input_file_cont" id="input_file_cont" onkeydown="return event.key != 'Enter';"> 
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
    function onlyAlphabet(ele) {
        ele.value = ele.value.replace(/[^//a-z]/gi,"");
    }
    $(function(){
        $('.btn_step1').click(function(){
            $('.step').removeClass('step_view');
            $('.step1').addClass('step_view');
        });
        $('.btn_step2').click(function(){
            // validation
            if($('#info_number').val() == "") return alert("접수번호가 비어있습니다");
            if($('#quest_number').val() == "") return alert("과제번호가 비어있습니다");
            if($('#ko_title').val() == "") return alert("국문 과제명이 비어있습니다");
            if($('#en_title').val() == "") return alert("영문 과제명이 비어있습니다");
            if($('#name').val() == "") return alert("성명이 비어있습니다");
            if($('#degree').val() == "") return alert("전공(학위)이 비어있습니다");
            if($('#rank').val() == "") return alert("소속이 비어있습니다");
            if($('#belong').val() == "") return alert("직급이 비어있습니다");
            if($('#email').val() == "") return alert("이메일이 비어있습니다");
            if($('#phone').val() == "") return alert("전화번호가 비어있습니다");
            
            // logic
            $('.step').removeClass('step_view');
            $('.step2').addClass('step_view');
                                                
        });
        $('.btn_step3').click(function(){
            // validation   
            if($('#main_member').val() == "") return alert("공동연구원이 비어있습니다");
            if($('#sub_member').val() == "") return alert("연구원보조가 비어있습니다");
            if($('#date_start').val() == "") return alert("연구 기간 시작이 비어있습니다");
            if($('#date_end').val() == "") return alert("연구 기간 끝이 비어있습니다");
            if($('#value').val() == "") return alert("연구비신청액이 비어있습니다");
            if($('#one_year').val() == "") return alert("1차년 연구비가 비어있습니다");
            if($('#two_year').val() == "") return alert("2차년 연구비가 비어있습니다");
            
            // logic
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
            $('#phone_view').val($(this).val().replace(/\B(?=(\d{4})+(?!\d))/g, "-"));
        });
        $('#main_member').change(function(){
            $('#main_member_view').val($(this).val()+"명");
        });
        $('#sub_member').change(function(){
            $('#sub_member_view').val($(this).val()+"명");
        });
        $('#date_start').change(function(){
            $('#date_start_view').val($(this).val());
        });
        $('#date_end').change(function(){
            $('#date_end_view').val($(this).val());
        });
        $('#money').change(function(){
            $('#money_view').val($(this).val().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+"원");
        });
        $('#one_year').change(function(){
            $('#one_year_view').val($(this).val().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+"원");
        });
        $('#two_year').change(function(){
            $('#two_year_view').val($(this).val().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+"원");
        });
    
        var html = '<div class="input-file"><input type="text" style="margin: 0 -2px;" id="file_label_view1" readonly="readonly" class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="파일명"/> <input type="text" id="file-size-'+file_number+'" class="file-name file-size" style="margin: 0 -2px;" value="용량" readonly="readonly"/><input type="file" name="bf_file[]" id="upload01" class="file-upload" <?= $row44['report'] ==2? "disabled": ""; ?> /><button type="button" class="file-label file-del " id="file-del<?= $i ?>" <?= $row44['report'] ==2? "disabled": ""; ?>style="background:<?= $row44['report'] ==2? '#ccc !important': 'crimson'; ?>">삭제</button></div>';

        $('.bo_class').append(html);
        

        //클릭이벤트 unbind 
        $("#file-label-btn").unbind("click"); 
        
        //클릭이벤트 bind
        $("#file-label-btn").bind("click",function(){ 
            $('#upload0'+file_number).change(function(){
                var fileValue = $(this).val().split("\\");
                var fileName = fileValue[fileValue.length-1]; // 파일명
                var fileSize = this.files[0].size;
                var str;

                //MB 단위 이상일때 MB 단위로 환산
                if (fileSize >= 1024 * 1024) {
                    fileSize = fileSize / (1024 * 1024);
                    var convertlastpage = fileSize.toFixed(2);
                    str = convertlastpage + ' MB';
                }
    
                else {
                    fileSize = fileSize / 1024;
                    var convertlastpage = fileSize.toFixed(2);
                    str = convertlastpage + ' KB';
                }
                
                if($(this).val() != ""){
                    file_number++;
                    $(this).prev().val(str);
                    $(this).prev().prev().val(fileName);
                    // <input type="text" id="file-size-'+file_number+'" value="'.str.'" />
                    // value="'+fileName+'"
                    // value="'+str+'" 
                    var html = '<div class="input-file"><input type="text" id="file_label_view'+file_number+'" readonly="readonly" class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="파일명"/><input type="text" id="file-size-'+file_number+'" class="file-name file-size" value="용량" readonly="readonly"/><input type="file" name="bf_file[]" id="upload0'+file_number+'" class="file-upload" <?= $row44['report'] ==2? "disabled": ""; ?>/><button type="button" class="file-label file-del " id="file-del'+file_number+'" <?= $row44['report'] ==2? "disabled": ""; ?>style="background:<?= $row44['report'] ==2? '#ccc !important': 'crimson'; ?>">삭제</button></div>';
                    $('.bo_class').append(html);

                    var html = '<input type="text" name="form_file'+file_number+'" id="form__file'+file_number+'"  class="input_text_100 input_text input_text_end input_form" value="'+ fileName+'" readonly>';
                    $('#input_file_cont').append(html);

                    $("#file-label-btn").attr('for', 'upload0'+file_number)
                }
            })
        })

        $(document).off().on('click','.file-del',function(){
            var val = $(this).prev().val();
            var next = $(this).parent().next().find('.file-upload').val();
            var index_form = $(this).parent().index() -1;

            if(val != ""){
                $(this).parent().remove();
                $('.input_form:nth-of-type('+index_form+')').remove();
            } else {
                if(next == ""){
                    $(this).parent().remove();
                    $('.input_form:nth-of-type('+index_form+')').remove();
                } 
            }    
        })

        $(document).on("keydown", "input[type=file]", function(event) { 
            return event.key != "Enter";
        });

    })
</script>


<!-- } 게시물 작성/수정 끝 -->

