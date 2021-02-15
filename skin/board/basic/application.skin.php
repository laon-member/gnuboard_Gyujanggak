<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
    

$sql = " SELECT * FROM `g5_write_business` where wr_id = {$_GET['wr_id']} ";
$result = sql_query($sql);
$row=sql_fetch_array($result);

$sql = " select * from g5_write_business_title where bo_table = '{$_GET['bo_table']}'";
$result = sql_query($sql);
?>
<aside id="bo_side">
    <h2 class="aside_nav_title">사업 공고</h2>
    <?php 
        for($k=1; $row1=sql_fetch_array($result); $k++) {
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
            <div id="bo_btn_top_app">
                <h1 class="view_title"><?=  $category_title ?></h1>
            </div>
        </div>

        <div class="step_con">
            <div class="step_bar step_bar1">
                <p class="step_text">Step 1</p>
                <p class="step_text">기본정보 입력</p>
            </div>
            <div class="step_bar ">
                <p class="step_text">Step 2</p> 
            </div>
            <div class="step_bar ">
                <p class="step_text">Step 3</p> 
            </div>
        </div>

        <table class="view_table_app">
            <thead>
                <tr>
                    <th scope="col" class="view_table_header "colspan="1" style="width:10%;">제목</th>
                    <td scope="col" class="view_table_title " colspan="7" style="width:90%;">
                        <input type="text" name="title_view" id="title_view"  class="input_text "  placeholder="제목" value="<?= $row['wr_subject']; ?>"  readonly>
                    </td>
                </tr>
                <tr>
                    <th scope="col" class="view_table_header" style="width:10%;">접수번호</th>
                    <td scope="col" class="view_table_text" colspan="3" style="width:40%;">
                        <input type="text" name="info_number" id="info_number"  class="input_text " placeholder="접수 완료시 자동부여됩니다." readonly>
                    </td>
                    <th scope="col" class="view_table_header" style="width:10%;">과제번호</th>
                    <td scope="col" class="view_table_text" colspan="3" style="width:40%;">
                        <input type="text" name="quest_number" id="quest_number"  class="input_text" placeholder="과제번호" value="<?= $row['wr_quest_number']; ?>" readonly>
                    </td>
                </tr>
            </thead>
            <tbody>
                <tr class="view_table_header_table"></tr>
                <tr>
                    <th scope="col" class="view_table_header " colspan="8">연구과제명</th>
                </tr>
                <tr>
                    <th scope="col" class="view_table_header" style="width:10%;" colspan="1">과제명(국문)</th>
                    <td scope="col" class="view_table_text view_table_padding" colspan="7" style="width:90%;">
                        <input type="text" name="ko_title" id="ko_title"  class="input_text input_border_true" placeholder="과제명(국문)"  >
                    </td>
                </tr>
                <tr>
                    <th scope="col" class="view_table_header" colspan="1" style="width:10%;">과제명(영문)</th>
                    <td scope="col" class="view_table_text view_table_padding" colspan="7" style="width:90%;">
                        <input type="text" name="en_title" id="en_title "  class="input_text input_border_true" placeholder="과제명(영문)" >
                    </td>
                </tr>
                <tr class="view_table_header_table"></tr>
                <tr>
                    <th scope="col" class="view_table_header " colspan="8">연구책임자</th>
                </tr>
                <tr>
                    <th scope="col" class="view_table_header" colspan="1"style="width:10%;">성명</th>
                    <td scope="col" class="view_table_text view_table_padding"  colspan="3" style="width:40%;">
                        <input type="text" name="name" id="name"  class="input_text input_border_true" placeholder="성명">
                    </td>
                    <th scope="col" class="view_table_header" colspan="1"style="width:10%;">전공(학위)</th>
                    <td scope="col" class="view_table_text view_table_padding" colspan="3" style="width:40%;">
                        <input type="text" name="degree" id="degree"  class="input_text input_border_true" placeholder="전공(학위)" >
                    </td>
                </tr>
                <tr>
                    <th scope="col" class="view_table_header" colspan="1" style="width:10%;">소속</th>
                    <td scope="col" class="view_table_text view_table_padding" colspan="3" style="width:40%;">
                        <input type="text" name="belong" id="belong"  class="input_text input_border_true" placeholder="소속"  >
                    </td>
                    <th scope="col" class="view_table_header" colspan="1" style="width:10%;">직급</th>
                    <td scope="col" class="view_table_text view_table_padding" colspan="3" style="width:40%;">
                        <input type="text" name="rank" id="rank"  class="input_text input_border_true" placeholder="직급" >
                    </td>
                </tr>
                <tr>
                    <th scope="col" class="view_table_header" colspan="1" style="width:10%;">이메일</th>
                    <td scope="col" class="view_table_text view_table_padding" colspan="3" style="width:40%;">
                        <input type="text" name="email" id="email"  class="input_text input_border_true" placeholder="이메일">
                    </td>
                    <th scope="col" class="view_table_header" colspan="1" style="width:10%;">전화</th>
                    <td scope="col" class="view_table_text view_table_padding" colspan="3" style="width:40%;">
                    <input type="text" name="phone" id="phone"  class="input_text input_border_true" placeholder="전화" > 
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="btn_confirm write_div btn-cont">
            <button type="button" id="btn_submit" accesskey="s" class="btn_submit btn btn_step2">다음</button>
        </div>
    </div>
    <div class ="step step2 ">
        <div class="bo_w_tit write_div">
            <div id="bo_btn_top_app">
                <h1 class="view_title"><?=  $category_title ?></h1>
            </div>
        </div>


        <div class="step_con">
            <div class="step_bar ">
                <p class="step_text">Step 1</p>
            </div>
            <div class="step_bar step_bar2">
                <p class="step_text">Step 2</p> 
                <p class="step_text">상세정보 입력</p>
            </div>
            <div class="step_bar ">
                <p class="step_text">Step 3</p> 
            </div>
        </div>

        <table class="view_table_app">
            <tbody class="bo_class">
                <tr>
                    <th scope="col" class="view_table_header"colspan="1" style="">제목</th>
                    <td scope="col" class="view_table_title" colspan="5" style="">
                        <input type="text" name="title_view" id="title_view"  class="input_text " placeholder="제목" value="<?= $row['wr_subject']; ?>"  readonly>
                    </td>
                </tr>
                <tr>
                    <th scope="col" class="view_table_header" style="">공동연구원</th>
                    <td scope="col" class="view_table_text view_table_padding" colspan="1" style="">
                        <input type="text" name="main_member" id="main_member"  class="input_text input_border_true" placeholder="명 ( * 연구책임자 제외 )">
                    </td>
                    <th scope="col" class="view_table_header" style="">연구원보조</th>
                    <td scope="col" class="view_table_text view_table_padding" colspan="3" style="">
                        <input type="text" name="sub_member" id="sub_member"  class="input_text input_border_true" placeholder="명">
                    </td>
                </tr>
                <tr>
                    <th scope="col" class="view_table_header" colspan="1" style="">총 연구 기간</th>
                    <td scope="col" class="view_table_text view_table_padding" colspan="1" style="">
                        <input type="text" name="date_start" id="date_start"  class="input_text input_date input_border_true" max="9999-12-31" placeholder="연도-월-일" >
                    </td>
                    <td scope="col" class="view_table_text view_table_padding" colspan="4" style="">
                        <input type="text" name="date_end" id="date_end" max="9999-12-31"class="input_text input_date input_border_true" placeholder="연도-월-일">
                    </td>
                </tr>
                <tr>
                    <th scope="col" class="view_table_header" colspan="1">연구비신청액</th>
                    <td scope="col" class="view_table_text view_table_padding" colspan="5" style="">
                        <input type="text" name="money" id="money"  class="input_text input_border_true" placeholder="연구비신청액" >
                    </td>
                </tr>
                <tr>
                    <th scope="col" class="view_table_header" colspan="1">1차년 연구비</th>
                    <td scope="col" class="view_table_text view_table_padding" colspan="1" style="">
                        <input type="text" name="one_year" id="one_year"  class="input_text input_border_true" placeholder="1차년 연구비">
                    </td>
                    <th scope="col" class="view_table_header" colspan="1">2차년 연구비</th>
                    <td scope="col" class="view_table_text view_table_padding" colspan="3" style="">
                        <input type="text" name="two_year" id="two_year"  class="input_text input_border_true" placeholder="2차년 연구비">
                    </td>
                </tr>
                
            </tbody>
        </table>
    

        <div class ="btn_confirm write_div btn-cont">
            <div class="next_prev_bar">
            <label for="upload01" id="file-label-btn" class="file-label"><img src="<?= G5_IMG_URL ?>/upload.png" alt=""> 파일 업로드</label>

                <button type="button" id="btn_submit1" accesskey="s" class="btn_cancel btn btn_step1">이전</button>
                <button type="button" id="btn_submit2" accesskey="s" class="btn_submit btn btn_step3">다음</button>
            </div>
        </div>
    </div>
    <div class ="step step3">
        <div class="bo_w_tit write_div">
            <div id="bo_btn_top_app">
                <h1 class="view_title"><?=  $category_title ?></h1>
            </div>
        </div>

        <div class="step_con">
            <div class="step_bar ">
                <p class="step_text">Step 1</p>
            </div>
            <div class="step_bar ">
                <p class="step_text">Step 2</p> 
            </div>
            <div class="step_bar step_bar3">
                <p class="step_text">Step 3</p> 
                <p class="step_text">제출확인</p>
            </div>
        </div>


        <table class="view_table_app">
            <thead>
                <tr>
                    <th scope="col" class="view_table_header"colspan="1" style="width: 10%;">제목</th>
                    <td scope="col" class="view_table_title" colspan="8" style="">
                        <input type="text" name="title_view" id="title_view"  class="input_text " placeholder="제목" value="<?= $row['wr_subject']; ?>"  readonly>
                    </td>
                </tr>
                <tr>
                    <th scope="col" class="view_table_header" style="">접수번호</th>
                    <td scope="col" class="view_table_text" colspan="4" style="">
                    <input type="text" name="info_number_view" id="info_number_view"  class="input_text" placeholder="접수 완료시 자동부여됩니다."  readonly>
                    </td>
                    <th scope="col" class="view_table_header" style="">과제번호</th>
                    <td scope="col" class="view_table_text" colspan="4" style="">
                    <input type="text" name="quest_number_view" id="quest_number_view"  class="input_text" placeholder="과제번호" value="<?= $row['wr_quest_number']; ?>" readonly>
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
                    <input type="text" name="ko_title_view" id="ko_title_view"  class="input_text" placeholder="과제명(국문)"readonly>
                    </td>
                </tr>
                <tr>
                    <th scope="col" class="view_table_header" colspan="1" style="">과제명(영문)</th>
                    <td scope="col" class="view_table_text" colspan="8" style="">
                    <input type="text" name="en_title_view" id="en_title_view"  class="input_text" placeholder="과제명(영문)" readonly>
                    </td>
                </tr>
                <tr class="view_table_header_table"></tr>
                <tr>
                    <th scope="col" class="view_table_header " colspan="9">연구책임자</th>
                </tr>
                <tr>
                    <th scope="col" class="view_table_header" colspan="1" style="">성명</th>
                    <td scope="col" class="view_table_text" colspan="4" style="">
                    <input type="text" name="name_view" id="name_view"  class="input_text" placeholder="성명" readonly>
                    </td>
                    <th scope="col" class="view_table_header" colspan="1" style="">전공(학위)</th>
                    <td scope="col" class="view_table_text" colspan="3" style="">
                    <input type="text" name="degree_view" id="degree_view"  class="input_text" placeholder="전공(학위)" readonly>
                    </td>
                </tr>
                <tr>
                    <th scope="col" class="view_table_header" colspan="1" style="">소속</th>
                    <td scope="col" class="view_table_text" colspan="4" style="">
                    <input type="text" name="belong_view" id="belong_view"  class="input_text" placeholder="소속" readonly>
                    </td>
                    <th scope="col" class="view_table_header" colspan="1" style="">직급</th>
                    <td scope="col" class="view_table_text" colspan="3" style="">
                    <input type="text" name="rank_view" id="rank_view"  class="input_text" placeholder="직급" readonly>
                    </td>
                </tr>
                <tr>
                    <th scope="col" class="view_table_header" colspan="1" style="">이메일</th>
                    <td scope="col" class="view_table_text" colspan="4" style="">
                    <input type="text" name="email_view" id="email_view"  class="input_text" placeholder="이메일" readonly>
                    </td>
                    <th scope="col" class="view_table_header" colspan="1" style="">전화</th>
                    <td scope="col" class="view_table_text" colspan="3" style="">
                    <input type="text" name="phone_view" id="phone_view"  class="input_text" placeholder="전화" readonly>
                    </td>
                </tr>
            
                <tr>
                    <th scope="col" class="view_table_header" style="">공동연구원</th>
                    <td scope="col" class="view_table_text" colspan="4" style="">
                    <input type="text" name="main_member_view" id="main_member_view"  class="input_text" placeholder="명" readonly>
                    </td>
                    <th scope="col" class="view_table_header" style="">연구원보조</th>
                    <td scope="col" class="view_table_text" colspan="3" style="">
                    <input type="text" name="sub_member_view" id="sub_member_view"  class="input_text" placeholder="명" readonly>
                    </td>
                </tr>
                <tr class="view_table_header_table"></tr>
                <tr>
                    <th scope="col" class="view_table_header " colspan="9">연구정보</th>
                </tr>
                <tr>
                    <th scope="col" class="view_table_header" colspan="1"style="">총 연구 기간</th>
                    <td scope="col" class="view_table_text" colspan="8" style="">
                        <input type="text" name="date_start_view" id="date_start_view" placeholder="총 연구 기간"  class="input_text" readonly>
                    </td>
                </tr>
                <tr>
                    <th scope="col" class="view_table_header" colspan="1" style="">연구비신청액</th>
                    <td scope="col" class="view_table_text" colspan="8" style="">
                    <input type="text" name="money_view" id="money_view"  class="input_text" placeholder="연구비신청액" value="<?php echo $value ?>" readonly>
                    </td>
                </tr>
                <tr>
                    <th scope="col" class="view_table_header" colspan="1" style="">1차년 연구비</th>
                    <td scope="col" class="view_table_text" colspan="4" style=" width:40%">
                    <input type="text" name="one_year_view" id="one_year_view"  class="input_text" placeholder="1차년 연구비" readonly>
                    </td>
                    <th scope="col" class="view_table_header" colspan="1" style="">2차년 연구비</th>
                    <td scope="col" class="view_table_text" colspan="3" style="">
                        <input type="text" name="two_year_view" id="two_year_view"  class="input_text" placeholder="2차년 연구비" readonly>
                    </td>
                </tr>
                <tr class="view_table_header_table"></tr>
                <tr>
                    <th scope="col" class="view_table_header " colspan="9">자료 첨부</th>
                </tr>
            </tbody>
            <tbody id="view_table_upload">
                
            </tbody>
        </table>

        <div class="btn_confirm write_div btn-cont">
            <button type="button" id="btn_submit1" accesskey="s" class="btn_cancel btn btn_step2">이전</button>
            <button type="submit" id="btn_submit2" accesskey="s" class="btn_submit btn btn_step4">완료</button>
        </div>
    </div>
    </form>
</section>

<script>
    
    $(function(){
        $(".input_date").datepicker(
            {dateFormat: 'yy-mm-dd'}
        );

        $('.btn_step1').click(function(){
            $('.step').removeClass('step_view');
            $('.step1').addClass('step_view');
        });
        $('.btn_step2').click(function(){
            // validation
            // if($('#info_number').val() == "") return alert("접수번호가 비어있습니다");
            // if($('#quest_number').val() == "") return alert("과제번호가 비어있습니다");
            if($('#ko_title').val() == "") return alert("국문 과제명이 비어있습니다");
            if($('#en_title').val() == "") return alert("영문 과제명이 비어있습니다");
            if($('#name').val() == "") return alert("성명이 비어있습니다");
            if($('#degree').val() == "") return alert("전공(학위)이 비어있습니다");
            if($('#belong').val() == "") return alert("소속이 비어있습니다");
            if($('#rank').val() == "") return alert("직급이 비어있습니다");
            if($('#email').val() == "") return alert("이메일이 비어있습니다");
            if($('#phone').val() == "") return alert("전화번호가 비어있습니다");
            
            //정규식 설정
            var fncTest = /^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]+(\.[a-zA-Z]{2,3}){1,4}$/i;
            //정규식 결과 저장
            var emailResult = fncTest.test( $("#email").val() );
            if(!emailResult) return alert("E-mail 주소가 형식에 맞지 않습니다.");

            //정규식 설정
            var regex= /^[0-9]+$/;
            //정규식 결과 저장
            var phoneResult = regex.test( $("#phone").val() );
            if(!phoneResult) return alert("전화번호에 숫자만 입력해주세요");

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
            var date_start = $('#date_start').val();
            var date_end = $('#date_end').val();

            if(date_start > date_end) return  alert("지원기간 끝나는 날짜가 시작하는 날짜보다 빠릅니다");
            // if($('#date_start').val() > $('#date_end').val()) return ("연구 기간 끝나는 날짜가 시작하는 날짜보다 빠릅니다.");
            if($('#value').val() == "") return alert("연구비신청액이 비어있습니다");
            if($('#one_year').val() == "") return alert("1차년 연구비가 비어있습니다");
            if($('#two_year').val() == "") return alert("2차년 연구비가 비어있습니다");

             //정규식 설정
             var regex= /^[0-9]+$/;
            //정규식 결과 저장
            var main_memberResult = regex.test( $("#main_member").val() );
            if(!main_memberResult) return alert("공동연구원에 숫자만 입력해주세요");
            
            var sub_memberResult = regex.test($("#sub_member").val());
            if(!sub_memberResult) return alert("연구원보조에 숫자만 입력해주세요");

            var moneyResult = regex.test( $("#money").val() );
            if(!moneyResult) return alert("연구비신청액에 숫자만 입력해주세요");

            var one_yearResult = regex.test( $("#one_year").val() );
            if(!one_yearResult) return alert("1차년 연구비에 숫자만 입력해주세요");

            var two_yearResult = regex.test( $("#two_year").val() );
            if(!two_yearResult) return alert("2차년 연구비에 숫자만 입력해주세요");


            IsValidDateStart = Date.parse($('#date_start').val());
            if (isNaN(IsValidDateStart)) return alert('총 지원기간 시작 날짜가 없는 날짜 입니다.');
                
            IsValidDateEnd = Date.parse($('#date_end').val());
            if (isNaN(IsValidDateEnd)) return alert('총 지원기간 끝나는 날짜가 없는 날짜 입니다.');
            
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
            $('#phone_view').val($(this).val());
        });
        $('#main_member').change(function(){
            $('#main_member_view').val($(this).val()+"명");
        });
        $('#sub_member').change(function(){
            $('#sub_member_view').val($(this).val()+"명");
        });
        $('#date_start').change(function(){
            $('#date_start_view').val($('#date_start').val()+" ~ "+$('#date_end').val());
        });
        $('#date_end').change(function(){
            $('#date_start_view').val($('#date_start').val()+" ~ "+$('#date_end').val());
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
        var file_number = 1;
        var html = '<tr class="input-file_list">'
                    +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일명</th>'
                    +'<td scope="col" class="view_table_text" colspan="1" style="width:40%">'
                    +'    <input type="text" style="margin: 0 -2px;" id="file_label_view1" readonly="readonly" class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="파일명"/> '
                    +'</td>'
                    +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 사이즈</th>'
                    +'<td scope="col" class="view_table_text" colspan="1" style="width:20%">'
                    +'    <input type="text" id="file-size-'+file_number+'" class="file-name file-size" style="margin: 0 -2px;" value="용량" readonly="readonly"/>'
                    +'    <input type="file" name="bf_file[]" id="upload01" class="file-upload" <?= $row44['report'] ==2? "disabled": ""; ?> />'
                    +'</td>'
                    +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 삭제</th>'
                    +'<td scope="col" class="view_table_text" colspan="1" style="width:10%">'
                    +'<button type="button" class="file-label file-del " id="file-del<?= $i ?>" <?= $row44['report'] ==2? "disabled": ""; ?>>삭제</button>'
                    +'</td>'
                    +'</tr>';
        

        $('.bo_class').append(html);
        

        //클릭이벤트 unbind 
        $("#file-label-btn").unbind("click"); 
        
        //클릭이벤트 bind
        $("#file-label-btn").bind("click",function(){ 
            $('#upload0'+file_number).change(function(){
                var fileValue = $(this).val().split("\\");
                var fileName = fileValue[fileValue.length-1]; // 파일명
                var fileSize = this.files[0].size;
                var str ="";

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
                  
                    $(this).prev().val(str);
                    $(this).parent().prev().prev().children().val(fileName);

                    var html = '<tr class="input_form_info">'
                    +'    <th scope="col" class="view_table_header " colspan="1" style="width:10%;height: 58px;">첨부파일</th>'
                    +'    <td scope="col" class="view_table_text " colspan="1" style="width:10%">'
                    +'       <img src="<?php echo G5_IMG_URL ?>/download_icon.png" alt="<?php echo $config['cf_title']; ?>">'
                    +'    </th>'
                    +'    <td scope="col" class="view_table_text_name " colspan="7">'+ fileName+'</th>'
                    +'</tr>';


                    $('#view_table_upload').append(html);

                    file_number++;

                    // var html = '<div class="input-file"><input type="text" id="file_label_view'+file_number+'" readonly="readonly" class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="파일명"/><input type="text" id="file-size-'+file_number+'" class="file-name file-size" value="용량" readonly="readonly"/><input type="file" name="bf_file[]" id="upload0'+file_number+'" class="file-upload" <?= $row44['report'] ==2? "disabled": ""; ?>/><button type="button" class="file-label file-del " id="file-del'+file_number+'" <?= $row44['report'] ==2? "disabled": ""; ?>style="background:<?= $row44['report'] ==2? '#ccc !important': 'crimson'; ?>">삭제</button></div>';
                    var html ='<tr class="input-file_list">'
                    +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일명</th>'
                    +'<td scope="col" class="view_table_text" colspan="1" style="width:40%">'
                    +'    <input type="text" id="file_label_view'+file_number+'" readonly="readonly" class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="파일명"/>'
                    +'</td>'
                    +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 사이즈</th>'
                    +'<td scope="col" class="view_table_text" colspan="1" style="width:20%">'
                    +'    <input type="text" id="file-size-'+file_number+'" class="file-name file-size" value="용량" readonly="readonly"/>'
                    +'    <input type="file" name="bf_file[]" id="upload0'+file_number+'" class="file-upload" <?= $row44['report'] ==2? "disabled": ""; ?>/>'
                    +'</td>'
                    +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 삭제</th>'
                    +'<td scope="col" class="view_table_text" colspan="1" style="width:10%">'
                    +'<button type="button" class="file-label file-del " id="file-del'+file_number+'" <?= $row44['report'] ==2? "disabled": ""; ?>>삭제</button>'
                    +'</td>'
                    +'</tr>';
                    $('.bo_class').append(html);

                    $("#file-label-btn").attr('for', 'upload0'+file_number);

                }
            })
        })
        

        $(document).off().on('click','.file-del',function(){
            var val = $(this).parent().find('.file-upload').prev().val();
            var next = $(this).parent().parent().next('tr').val();
            var index_form = $(this).parent().parent().index('.input-file_list')+1;
            if(val != undefined){
                $(this).parent().parent().remove();
                $('#view_table_upload tr:nth-child('+index_form+')').remove();
                
            } else {
                if(next == ""){
                    $(this).parent().parent().remove();
                $('#view_table_upload tr:nth-child('+index_form+')').remove();
                } 
            }    
        })

        $(document).on("keydown", "input[type=file]", function(event) { 
            return event.key != "Enter";
        });
    })


</script>


<!-- } 게시물 작성/수정 끝 -->

