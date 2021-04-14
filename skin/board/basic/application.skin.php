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
<?php if ($_GET['bo_idx'] == 1) {  ?>
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
                            <input type="text" name="quest_number" id="quest_number"  class="input_text" placeholder="선발 후 부여 됩니다" value="" readonly>
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
                            <input type="text" name="en_title" id="en_title"  class="input_text input_border_true" placeholder="과제명(영문)" >
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
                        <input type="text" name="phone" id="phone"  class="input_text input_border_true" placeholder="숫자만 기재" > 
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
                        <th scope="col" class="view_table_header"colspan="1" >제목</th>
                        <td scope="col" class="view_table_title" colspan="5" >
                            <input type="text" name="title_view" id="title_view"  class="input_text " placeholder="제목" value="<?= $row['wr_subject']; ?>"  readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" >공동연구원</th>
                        <td scope="col" class="view_table_text view_table_padding" colspan="1" >
                            <input type="text" name="main_member" id="main_member"  class="input_text input_border_true" placeholder="명 ( * 연구책임자 제외 )">
                        </td>
                        <th scope="col" class="view_table_header" >연구원보조</th>
                        <td scope="col" class="view_table_text view_table_padding" colspan="3" >
                            <input type="text" name="sub_member" id="sub_member"  class="input_text input_border_true" placeholder="명">
                        </td>
                    </tr>
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">연구정보</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1">연구비신청액</th>
                        <td scope="col" class="view_table_text view_table_padding" colspan="5" >
                            <input type="text" name="money" id="money"  class="input_text input_border_true money" placeholder="숫자만 기재 (원)" >
                        </td>
                    </tr>
                </tbody>
                <tbody class="file_table_all">
                    <tr class="view_table_header_table"></tr>
                    <tr class="all_user_file">
                        <th scope="col" class="view_table_header " colspan="9">자료 첨부</th>
                    </tr>
                </tbody>
                <tbody class="file_table_rater">
                    <tr class="view_table_header_table"></tr>
                    <tr class="rater_user_file">
                        <th scope="col" class="view_table_header " colspan="9">심사자용 자료 첨부(인적사항 무기입)</th>
                    </tr>
                </tbody>
            </table>
        

            <div class ="btn_confirm write_div btn-cont">
                <div class="next_prev_bar">
                <label for="upload01" id="file-label-btn" class="file-label file-label-btn"><img src="<?= G5_IMG_URL ?>/upload.png" alt=""> 파일 업로드</label>
                <label for="upload1_01" id="file-label-btn1" class="file-label file-label-btn"><img src="<?= G5_IMG_URL ?>/upload.png" alt=""> 심사자용 업로드</label>

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
                        <td scope="col" class="view_table_title" colspan="8" style="width: 90%;">
                            <input type="text" name="title_view" id="title_view"  class="input_text " placeholder="제목" value="<?= $row['wr_subject']; ?>"  readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" style="width: 10%;">접수번호</th>
                        <td scope="col" class="view_table_text" colspan="4" style="width: 40%;">
                        <input type="text" name="info_number_view" id="info_number_view"  class="input_text" placeholder="접수 완료시 자동부여됩니다."  readonly>
                        </td>
                        <th scope="col" class="view_table_header" style="width: 10%;">과제번호</th>
                        <td scope="col" class="view_table_text" colspan="4" style="width: 40%;">
                        <input type="text" name="quest_number_view" id="quest_number_view"  class="input_text" placeholder="선발 후 부여 됩니다" value="" readonly>
                        </td>
                    </tr>
                </thead>
                <tbody id="input_file_cont">
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">연구과제명</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >과제명(국문)</th>
                        <td scope="col" class="view_table_text" colspan="8" >
                        <input type="text" name="ko_title_view" id="ko_title_view"  class="input_text" placeholder="과제명(국문)"readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >과제명(영문)</th>
                        <td scope="col" class="view_table_text" colspan="8" >
                        <input type="text" name="en_title_view" id="en_title_view"  class="input_text" placeholder="과제명(영문)" readonly>
                        </td>
                    </tr>
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">연구책임자</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >성명</th>
                        <td scope="col" class="view_table_text" colspan="4" >
                        <input type="text" name="name_view" id="name_view"  class="input_text" placeholder="성명" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" >전공(학위)</th>
                        <td scope="col" class="view_table_text" colspan="3" >
                        <input type="text" name="degree_view" id="degree_view"  class="input_text" placeholder="전공(학위)" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >소속</th>
                        <td scope="col" class="view_table_text" colspan="4" >
                        <input type="text" name="belong_view" id="belong_view"  class="input_text" placeholder="소속" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" >직급</th>
                        <td scope="col" class="view_table_text" colspan="3" >
                        <input type="text" name="rank_view" id="rank_view"  class="input_text" placeholder="직급" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >이메일</th>
                        <td scope="col" class="view_table_text" colspan="4" >
                        <input type="text" name="email_view" id="email_view"  class="input_text" placeholder="이메일" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" >전화</th>
                        <td scope="col" class="view_table_text" colspan="3" >
                        <input type="text" name="phone_view" id="phone_view"  class="input_text" placeholder="전화" readonly>
                        </td>
                    </tr>
                
                    <tr>
                        <th scope="col" class="view_table_header" >공동연구원</th>
                        <td scope="col" class="view_table_text" colspan="4" >
                        <input type="text" name="main_member_view" id="main_member_view"  class="input_text" placeholder="명" readonly>
                        </td>
                        <th scope="col" class="view_table_header" >연구원보조</th>
                        <td scope="col" class="view_table_text" colspan="3" >
                        <input type="text" name="sub_member_view" id="sub_member_view"  class="input_text" placeholder="명" readonly>
                        </td>
                    </tr>
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">연구정보</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >연구비신청액</th>
                        <td scope="col" class="view_table_text" colspan="8" >
                        <input type="text" name="money_view" id="money_view"  class="input_text" placeholder="연구비신청액" readonly>
                        </td>
                    </tr>
                    
                </tbody>
                <tbody id="view_table_upload">
                <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">자료 첨부</th>
                    </tr>
                </tbody>

                <tbody id="view_table_upload_rater">
                <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">심사자용 자료 첨부(인적사항 무기입)</th>
                    </tr>
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
            $('.btn_step1').click(function(){
                $('.step').removeClass('step_view');
                $('.step1').addClass('step_view');
            });
            $('.btn_step2').click(function(){
                // validation
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
                var date_start = $('.date_start').val();
                var date_end = $('.date_end').val();

                if($('#value').val() == "") return alert("연구비신청액이 비어있습니다");
                //정규식 설정
                var regex= /^[0-9]+$/;
                //정규식 결과 저장
                var main_memberResult = regex.test( $("#main_member").val() );
                if(!main_memberResult) return alert("공동연구원에 숫자만 입력해주세요");
                
                var sub_memberResult = regex.test($("#sub_member").val());
                if(!sub_memberResult) return alert("연구원보조에 숫자만 입력해주세요");

                var moneyResult = regex.test( $("#money").val());
                if(!moneyResult) return alert("연구비신청액에 숫자만 입력해주세요");

               
                $('#date_start_view').val($('.date_start').val()+" ~ "+$('.date_end').val());

                if($(".file-upload").val() =="") return alert("파일을 업로드 해주세요");    
                    
                // logic
                $('.step').removeClass('step_view');
                $('.step3').addClass('step_view');
            });
            var money_sum = 0;
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
                $('#main_member_view').val($(this).val().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+"명");
            });
            $('#sub_member').change(function(){
                $('#sub_member_view').val($(this).val().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+"명");
            });
            $('#one_year').change(function(){
                money_sum = Number($(this).val()) + Number($('#two_year').val());
                $('#money').val(money_sum);
                $('#money_view').val($('#money').val().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+"원");
                $('#one_year_view').val($(this).val().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+"원");
            });
            $('#two_year').change(function(){
                money_sum = Number($(this).val()) + Number($('#one_year').val());
                $('#money').val(money_sum);
                $('#money_view').val($('#money').val().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+"원");
                $('#two_year_view').val($(this).val().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+"원");
            });
            $('.money').change(function(){
                $('#money_view').val($(this).val().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+"원");
            });

            $(".input_date").datepicker();

            
            var file_number = 1;
            var file_number_rater = 1;

            var html = '<tr class="input-file_list ">'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일명</th>'
                        +'<td scope="col" class="view_table_text" colspan="1" style="width:40%">'
                        +'    <input type="text" style="margin: 0 -2px;" id="file_label_view1" readonly="readonly" class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="파일명"/> '
                        +'</td>'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 사이즈</th>'
                        +'<td scope="col" class="view_table_text" colspan="1" style="width:20%">'
                        +'    <input type="text" id="file-size-'+file_number+'" class="file-name file-size" style="margin: 0 -2px;" value="용량" readonly="readonly"/>'
                        +'    <input type="file" name="bf_file_null[]" id="upload01" class="file-upload" <?= $row44['report'] ==2? "disabled": ""; ?> />'
                        +'</td>'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 삭제</th>'
                        +'<td scope="col" class="view_table_text" colspan="1" style="width:10%">'
                        +'<button type="button" class="file-label file-del " id="file-del<?= $i ?>" <?= $row44['report'] ==2? "disabled": ""; ?>>삭제</button>'
                        +'</td>'
                        +'</tr>';


            var html2 = '<tr class="input-file_list ">'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일명</th>'
                        +'<td scope="col" class="view_table_text" colspan="1" style="width:40%">'
                        +'    <input type="text" style="margin: 0 -2px;" id="file_label_view1" readonly="readonly" class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="파일명"/> '
                        +'</td>'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 사이즈</th>'
                        +'<td scope="col" class="view_table_text" colspan="1" style="width:20%">'
                        +'    <input type="text" id="file-size-'+file_number_rater+'" class="file-name file-size" style="margin: 0 -2px;" value="용량" readonly="readonly"/>'
                        +'    <input type="file" name="bf_file_null[]" id="upload1_01" class="file-upload" <?= $row44['report'] ==2? "disabled": ""; ?> />'
                        +'</td>'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 삭제</th>'
                        +'<td scope="col" class="view_table_text" colspan="1" style="width:10%">'
                        +'<button type="button" class="file-label file-del " id="file-del<?= $i ?>" <?= $row44['report'] ==2? "disabled": ""; ?>>삭제</button>'
                        +'</td>'
                        +'</tr>';

            $('.file_table_all').append(html);
            $('.file_table_rater').append(html2);


            //클릭이벤트 unbind 
            $("#file-label-btn").unbind("click"); 

            var file_upload_check = true;
            //클릭이벤트 bind
            $("#file-label-btn").bind("click",function(){ 
                    if(file_upload_check){
                    file_upload_check = false;
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
                            $(this).after('<input type="hidden" name="file_type[]" value ="0" />');
                            $(this).attr('name' , 'bf_file[]');

                            var html = '<tr class="input_form_info upload0'+file_number+'">'
                            +'    <th scope="col" class="view_table_header " colspan="1" style="width:10%; height: 58px;">첨부파일</th>'
                            +'    <td scope="col" class="view_table_text " colspan="1" style="width:10%">'
                            +'       <img src="<?php echo G5_IMG_URL ?>/download_icon.png" alt="<?php echo $config['cf_title']; ?>">'
                            +'    </th>'
                            +'    <td scope="col" class="view_table_text_name " colspan="7">'+  fileName+'</th>'
                            +'</tr>';

                            $('#view_table_upload').append(html);

                            file_number++;

                            // var html = '<div class="input-file"><input type="text" id="file_label_view'+file_number+'" readonly="readonly" class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="파일명"/><input type="text" id="file-size-'+file_number+'" class="file-name file-size" value="용량" readonly="readonly"/><input type="file" name="bf_file[]" id="upload0'+file_number+'" class="file-upload" <?= $row44['report'] ==2? "disabled": ""; ?>/><button type="button" class="file-label file-del " id="file-del'+file_number+'" <?= $row44['report'] ==2? "disabled": ""; ?>style="background:<?= $row44['report'] ==2? '#ccc !important': 'crimson'; ?>">삭제</button></div>';
                            var html ='<tr class="input-file_list input-file_list_all">'
                            +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일명</th>'
                            +'<td scope="col" class="view_table_text" colspan="1" style="width:40%">'
                            +'    <input type="text" id="file_label_view'+file_number+'" readonly="readonly" class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="파일명"/>'
                            +'</td>'
                            +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 사이즈</th>'
                            +'<td scope="col" class="view_table_text" colspan="1" style="width:20%">'
                            +'    <input type="text" id="file-size-'+file_number+'" class="file-name file-size" value="용량" readonly="readonly"/>'
                            +'    <input type="file" name="bf_file_null[]" id="upload0'+file_number+'" class="file-upload" <?= $row44['report'] ==2? "disabled": ""; ?>/>'
                            +'</td>'
                            +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 삭제</th>'
                            +'<td scope="col" class="view_table_text" colspan="1" style="width:10%">'
                            +'<button type="button" class="file-label file-del " id="file-del'+file_number+'" <?= $row44['report'] ==2? "disabled": ""; ?>>삭제</button>'
                            +'</td>'
                            +'</tr>';

                            $('.file_table_all').append(html);

                            $("#file-label-btn").attr('for', 'upload0'+file_number);
                            file_upload_check = true;
                        }

                })

                    }
            })
            var file_upload_check_rater = true;
            $("#file-label-btn1").bind("click",function(){
                if(file_upload_check_rater){ 
                    file_upload_check_rater = false;
                    $('#upload1_0'+file_number_rater).change(function(){
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
                            $(this).after('<input type="hidden" name="file_type[]" value ="1" />');
                            $(this).attr('name' , 'bf_file[]');

                            var html = '<tr class="input_form_info upload1_0'+file_number_rater+'">'
                            +'    <th scope="col" class="view_table_header " colspan="1" style="width:10%; height: 58px;">첨부파일</th>'
                            +'    <td scope="col" class="view_table_text " colspan="1" style="width:10%">'
                            +'       <img src="<?php echo G5_IMG_URL ?>/download_icon.png" alt="<?php echo $config['cf_title']; ?>">'
                            +'    </th>'
                            +'    <td scope="col" class="view_table_text_name " colspan="7">'+ fileName+'</th>'
                            +'</tr>';


                            $('#view_table_upload_rater').append(html);

                            file_number_rater++;

                            // var html = '<div class="input-file"><input type="text" id="file_label_view'+file_number+'" readonly="readonly" class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="파일명"/><input type="text" id="file-size-'+file_number+'" class="file-name file-size" value="용량" readonly="readonly"/><input type="file" name="bf_file[]" id="upload0'+file_number+'" class="file-upload" <?= $row44['report'] ==2? "disabled": ""; ?>/><button type="button" class="file-label file-del " id="file-del'+file_number+'" <?= $row44['report'] ==2? "disabled": ""; ?>style="background:<?= $row44['report'] ==2? '#ccc !important': 'crimson'; ?>">삭제</button></div>';
                            var html ='<tr class="input-file_list">'
                            +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일명</th>'
                            +'<td scope="col" class="view_table_text" colspan="1" style="width:40%">'
                            +'    <input type="text" id="file_label_view'+file_number_rater+'" readonly="readonly" class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="파일명"/>'
                            +'</td>'
                            +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 사이즈</th>'
                            +'<td scope="col" class="view_table_text" colspan="1" style="width:20%">'
                            +'    <input type="text" id="file-size-'+file_number_rater+'" class="file-name file-size" value="용량" readonly="readonly"/>'
                            +'    <input type="file" name="bf_file_null[]" id="upload1_0'+file_number_rater+'" class="file-upload" <?= $row44['report'] ==2? "disabled": ""; ?>/>'
                            +'</td>'
                            +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 삭제</th>'
                            +'<td scope="col" class="view_table_text" colspan="1" style="width:10%">'
                            +'<button type="button" class="file-label file-del " id="file-del'+file_number_rater+'" <?= $row44['report'] ==2? "disabled": ""; ?>>삭제</button>'
                            +'</td>'
                            +'</tr>';
                            $('.file_table_rater').append(html);

                            $("#file-label-btn1").attr('for', 'upload1_0'+file_number_rater);
                            file_upload_check_rater = true;
                        }
                    })
                }

            })

            $(document).off().on('click','.file-del',function(){
                var val = $(this).parent().find('.file-upload').prev().val();
                var file_id = $(this).parent().prev().prev().find('.file-upload').attr('id');
                // alert(val);
                var next = $(this).parent().parent().next('tr').val();
                var index_form = $(this).parent().parent().index('.input-file_list')+1;
                if(val != undefined){
                    $(this).parent().parent().remove();
                    $('.'+file_id+'').remove();
                    
                } else {
                    if(next == ""){
                        $(this).parent().parent().remove();
                        $('.'+file_id+'').remove();
                    } 
                }    
            })
        })
    </script>
<?php } else if ($_GET['bo_idx'] == 2) { ?>
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
                            <input type="text" name="quest_number" id="quest_number"  class="input_text" placeholder="선발 후 부여 됩니다" value="" readonly>
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
                            <input type="text" name="en_title" id="en_title"  class="input_text input_border_true" placeholder="과제명(영문)" >
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
                        <input type="text" name="phone" id="phone"  class="input_text input_border_true" placeholder="숫자만 기재" > 
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
                        <th scope="col" class="view_table_header"colspan="1" >제목</th>
                        <td scope="col" class="view_table_title" colspan="5" >
                            <input type="text" name="title_view" id="title_view"  class="input_text " placeholder="제목" value="<?= $row['wr_subject']; ?>"  readonly>
                        </td>
                    </tr>
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="8">연구참여자</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" style="width:12%">공동연구원<br>연구책임자 제외</th>
                        <td scope="col" class="view_table_text view_table_padding" colspan="1" >
                            <input type="text" name="main_member" id="main_member"  class="input_text input_border_true" placeholder="명 ( * 연구책임자 제외 )">
                        </td>
                        <th scope="col" class="view_table_header" >연구원보조</th>
                        <td scope="col" class="view_table_text view_table_padding" colspan="3" >
                            <input type="text" name="sub_member" id="sub_member"  class="input_text input_border_true" placeholder="명">
                        </td>
                    </tr>
                    <!-- <tr>
                        <th scope="col" class="view_table_header" colspan="1" >총 연구 기간</th>
                        <td scope="col" class="view_table_text view_table_padding" colspan="1" >
                            <input type="text" name="date_start" id=" datepicker1"  class="date_start input_text input_date input_border_true" max="9999-12-31" readonly placeholder="연도-월-일" >
                        </td>
                        <td scope="col" class="view_table_text view_table_padding" colspan="4" >
                            <input type="text" name="date_end" id=" datepicker2" class="date_end input_text input_date input_border_true" max="9999-12-31"  readonly placeholder="연도-월-일">
                        </td>
                    </tr> -->
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="8">연구정보</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1">연구비신청액</th>
                        <td scope="col" class="view_table_text " colspan="5" >
                            <input type="text" name="money" id="money"  class="input_text money" placeholder="숫자만 기재 (원)" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1">1차년 연구비</th>
                        <td scope="col" class="view_table_text view_table_padding" colspan="1" >
                            <input type="text" name="one_year" id="one_year"  class="input_text input_border_true" placeholder="1차년 연구비 (원)">
                        </td>
                        <th scope="col" class="view_table_header" colspan="1">2차년 연구비</th>
                        <td scope="col" class="view_table_text view_table_padding" colspan="3" >
                            <input type="text" name="two_year" id="two_year"  class="input_text input_border_true" placeholder="2차년 연구비 (원)">
                        </td>
                    </tr>
                </tbody>
                <tbody class="file_table_all">
                    <tr class="view_table_header_table"></tr>
                    <tr class="all_user_file">
                        <th scope="col" class="view_table_header " colspan="9">자료 첨부</th>
                    </tr>
                </tbody>
                <tbody class="file_table_rater">
                    <tr class="view_table_header_table"></tr>
                    <tr class="rater_user_file">
                        <th scope="col" class="view_table_header " colspan="9">심사자용 자료 첨부(인적사항 무기입)</th>
                    </tr>
                </tbody>



            </table>
        

            <div class ="btn_confirm write_div btn-cont">
                <div class="next_prev_bar">
                <label for="upload01" id="file-label-btn" class="file-label file-label-btn"><img src="<?= G5_IMG_URL ?>/upload.png" alt=""> 파일 업로드</label>
                <label for="upload1_01" id="file-label-btn1" class="file-label file-label-btn"><img src="<?= G5_IMG_URL ?>/upload.png" alt=""> 심사자용 업로드</label>


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
                        <th scope="col" class="view_table_header"colspan="1" style="width: 12%;">제목</th>
                        <td scope="col" class="view_table_title" colspan="8" style="width: 88%;">
                            <input type="text" name="title_view" id="title_view"  class="input_text " placeholder="제목" value="<?= $row['wr_subject']; ?>"  readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" style="width: 12%;">접수번호</th>
                        <td scope="col" class="view_table_text" colspan="4" style="width: 38%;">
                        <input type="text" name="info_number_view" id="info_number_view"  class="input_text" placeholder="접수 완료시 자동부여됩니다."  readonly>
                        </td>
                        <th scope="col" class="view_table_header" style="width: 12%;">과제번호</th>
                        <td scope="col" class="view_table_text" colspan="4" style="width: 38%;">
                        <input type="text" name="quest_number_view" id="quest_number_view"  class="input_text" placeholder="선발 후 부여 됩니다" value="" readonly>
                        </td>
                    </tr>
                </thead>
                <tbody id="input_file_cont">
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">연구과제명</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >과제명(국문)</th>
                        <td scope="col" class="view_table_text" colspan="8" >
                        <input type="text" name="ko_title_view" id="ko_title_view"  class="input_text" placeholder="과제명(국문)"readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >과제명(영문)</th>
                        <td scope="col" class="view_table_text" colspan="8" >
                        <input type="text" name="en_title_view" id="en_title_view"  class="input_text" placeholder="과제명(영문)" readonly>
                        </td>
                    </tr>
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">연구책임자</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >성명</th>
                        <td scope="col" class="view_table_text" colspan="4" >
                        <input type="text" name="name_view" id="name_view"  class="input_text" placeholder="성명" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" >전공(학위)</th>
                        <td scope="col" class="view_table_text" colspan="3" >
                        <input type="text" name="degree_view" id="degree_view"  class="input_text" placeholder="전공(학위)" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >소속</th>
                        <td scope="col" class="view_table_text" colspan="4" >
                        <input type="text" name="belong_view" id="belong_view"  class="input_text" placeholder="소속" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" >직급</th>
                        <td scope="col" class="view_table_text" colspan="3" >
                        <input type="text" name="rank_view" id="rank_view"  class="input_text" placeholder="직급" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >이메일</th>
                        <td scope="col" class="view_table_text" colspan="4" >
                        <input type="text" name="email_view" id="email_view"  class="input_text" placeholder="이메일" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" >전화</th>
                        <td scope="col" class="view_table_text" colspan="3" >
                        <input type="text" name="phone_view" id="phone_view"  class="input_text" placeholder="전화" readonly>
                        </td>
                    </tr>
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">연구참여자</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" >공동연구원<br>연구책임자 제외</th>
                        <td scope="col" class="view_table_text" colspan="4" >
                        <input type="text" name="main_member_view" id="main_member_view"  class="input_text" placeholder="명" readonly>
                        </td>
                        <th scope="col" class="view_table_header" >연구원보조</th>
                        <td scope="col" class="view_table_text" colspan="3" >
                        <input type="text" name="sub_member_view" id="sub_member_view"  class="input_text" placeholder="명" readonly>
                        </td>
                    </tr>
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">연구정보</th>
                    </tr>
                    
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >연구비신청액</th>
                        <td scope="col" class="view_table_text" colspan="8" >
                        <input type="text" name="money_view" id="money_view"  class="input_text" placeholder="연구비신청액" readonly>
                        </td>
                    </tr>
                    <?php if($_GET['bo_idx'] == 2){ ?>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >1차년 연구비</th>
                        <td scope="col" class="view_table_text" colspan="4" style=" width:40%">
                        <input type="text" name="one_year_view" id="one_year_view"  class="input_text" placeholder="1차년 연구비" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" >2차년 연구비</th>
                        <td scope="col" class="view_table_text" colspan="3" >
                            <input type="text" name="two_year_view" id="two_year_view"  class="input_text" placeholder="2차년 연구비" readonly>
                        </td>
                    </tr>
                    <?php } ?>
                    </tbody>
                    <tbody id="view_table_upload">
                    <tr class="view_table_header_table"></tr>
                        <tr>
                            <th scope="col" class="view_table_header " colspan="9">자료 첨부</th>
                        </tr>
                    </tbody>

                    <tbody id="view_table_upload_rater">
                    <tr class="view_table_header_table"></tr>
                        <tr>
                            <th scope="col" class="view_table_header " colspan="9">심사자용 자료 첨부(인적사항 무기입)</th>
                        </tr>
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
                if($('#one_year').val() == "") return alert("1차년 연구비가 비어있습니다");
                if($('#two_year').val() == "") return alert("2차년 연구비가 비어있습니다");
                //정규식 설정
                var regex= /^[0-9]+$/;
                //정규식 결과 저장
                var main_memberResult = regex.test( $("#main_member").val() );
                if(!main_memberResult) return alert("공동연구원에 숫자만 입력해주세요");
                
                var sub_memberResult = regex.test($("#sub_member").val());
                if(!sub_memberResult) return alert("연구원보조에 숫자만 입력해주세요");

                var moneyResult = regex.test( $("#money").val());
                if(!moneyResult) return alert("연구비신청액에 숫자만 입력해주세요");

                var one_yearResult = regex.test( $("#one_year").val());
                if(!one_yearResult) return alert("1차년 연구비에 숫자만 입력해주세요");

                var two_yearResult = regex.test( $("#two_year").val());
                if(!two_yearResult) return alert("2차년 연구비에 숫자만 입력해주세요");

                if($(".file-upload").val() =="") return alert("파일을 업로드 해주세요");    
                    
                // logic
                $('.step').removeClass('step_view');
                $('.step3').addClass('step_view');
            });
            var money_sum = 0;
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
                $('#main_member_view').val($(this).val().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+"명");
            });
            $('#sub_member').change(function(){
                $('#sub_member_view').val($(this).val().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+"명");
            });
            // $('.date_start').on("propertychange change keyup paste input textchange", function(){
            //     alert("d");
            //     $('#date_start_view').val($('.date_start').val()+" ~ "+$('.date_end').val());
            // });
            // $('.date_end').on("propertychange change keyup paste input textchange", function(){
            //     alert("D");
            //     $('#date_start_view').val($('.date_start').val()+" ~ "+$('.date_end').val());
            // });
            $('#one_year').change(function(){
                money_sum = Number($(this).val()) + Number($('#two_year').val());
                $('#money').val(money_sum);
                $('#money_view').val($('#money').val().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+"원");
                $('#one_year_view').val($(this).val().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+"원");
            });
            $('#two_year').change(function(){
                money_sum = Number($(this).val()) + Number($('#one_year').val());
                $('#money').val(money_sum);
                $('#money_view').val($('#money').val().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+"원");
                $('#two_year_view').val($(this).val().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+"원");
            });
            $('.money').change(function(){
                $('#money_view').val($(this).val().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+"원");
                // alert(
                //     $('#money_view').val($(this).val().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+"원")
                // );
            });
            $(".input_date").datepicker();

            var file_number = 1;
            var file_number_rater = 1;

            var html = '<tr class="input-file_list ">'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일명</th>'
                        +'<td scope="col" class="view_table_text" colspan="1" style="width:40%">'
                        +'    <input type="text" style="margin: 0 -2px;" id="file_label_view1" readonly="readonly" class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="파일명"/> '
                        +'</td>'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 사이즈</th>'
                        +'<td scope="col" class="view_table_text" colspan="1" style="width:20%">'
                        +'    <input type="text" id="file-size-'+file_number+'" class="file-name file-size" style="margin: 0 -2px;" value="용량" readonly="readonly"/>'
                        +'    <input type="file" name="bf_file_null[]" id="upload01" class="file-upload" <?= $row44['report'] ==2? "disabled": ""; ?> />'
                        +'</td>'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 삭제</th>'
                        +'<td scope="col" class="view_table_text" colspan="1" style="width:10%">'
                        +'<button type="button" class="file-label file-del " id="file-del<?= $i ?>" <?= $row44['report'] ==2? "disabled": ""; ?>>삭제</button>'
                        +'</td>'
                        +'</tr>';


            var html2 = '<tr class="input-file_list ">'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일명</th>'
                        +'<td scope="col" class="view_table_text" colspan="1" style="width:40%">'
                        +'    <input type="text" style="margin: 0 -2px;" id="file_label_view1" readonly="readonly" class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="파일명"/> '
                        +'</td>'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 사이즈</th>'
                        +'<td scope="col" class="view_table_text" colspan="1" style="width:20%">'
                        +'    <input type="text" id="file-size-'+file_number_rater+'" class="file-name file-size" style="margin: 0 -2px;" value="용량" readonly="readonly"/>'
                        +'    <input type="file" name="bf_file_null[]" id="upload1_01" class="file-upload" <?= $row44['report'] ==2? "disabled": ""; ?> />'
                        +'</td>'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 삭제</th>'
                        +'<td scope="col" class="view_table_text" colspan="1" style="width:10%">'
                        +'<button type="button" class="file-label file-del " id="file-del<?= $i ?>" <?= $row44['report'] ==2? "disabled": ""; ?>>삭제</button>'
                        +'</td>'
                        +'</tr>';

            $('.file_table_all').append(html);
            $('.file_table_rater').append(html2);


            //클릭이벤트 unbind 
            $("#file-label-btn").unbind("click"); 

            var file_upload_check = true;
            //클릭이벤트 bind
            $("#file-label-btn").bind("click",function(){ 
                    if(file_upload_check){
                    file_upload_check = false;
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
                            $(this).after('<input type="hidden" name="file_type[]" value ="0" />');
                            $(this).attr('name' , 'bf_file[]');

                            var html = '<tr class="input_form_info upload0'+file_number+'">'
                            +'    <th scope="col" class="view_table_header " colspan="1" style="width:10%; height: 58px;">첨부파일</th>'
                            +'    <td scope="col" class="view_table_text " colspan="1" style="width:10%">'
                            +'       <img src="<?php echo G5_IMG_URL ?>/download_icon.png" alt="<?php echo $config['cf_title']; ?>">'
                            +'    </th>'
                            +'    <td scope="col" class="view_table_text_name " colspan="7">'+  fileName+'</th>'
                            +'</tr>';

                            $('#view_table_upload').append(html);

                            file_number++;

                            // var html = '<div class="input-file"><input type="text" id="file_label_view'+file_number+'" readonly="readonly" class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="파일명"/><input type="text" id="file-size-'+file_number+'" class="file-name file-size" value="용량" readonly="readonly"/><input type="file" name="bf_file[]" id="upload0'+file_number+'" class="file-upload" <?= $row44['report'] ==2? "disabled": ""; ?>/><button type="button" class="file-label file-del " id="file-del'+file_number+'" <?= $row44['report'] ==2? "disabled": ""; ?>style="background:<?= $row44['report'] ==2? '#ccc !important': 'crimson'; ?>">삭제</button></div>';
                            var html ='<tr class="input-file_list input-file_list_all">'
                            +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일명</th>'
                            +'<td scope="col" class="view_table_text" colspan="1" style="width:40%">'
                            +'    <input type="text" id="file_label_view'+file_number+'" readonly="readonly" class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="파일명"/>'
                            +'</td>'
                            +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 사이즈</th>'
                            +'<td scope="col" class="view_table_text" colspan="1" style="width:20%">'
                            +'    <input type="text" id="file-size-'+file_number+'" class="file-name file-size" value="용량" readonly="readonly"/>'
                            +'    <input type="file" name="bf_file_null[]" id="upload0'+file_number+'" class="file-upload" <?= $row44['report'] ==2? "disabled": ""; ?>/>'
                            +'</td>'
                            +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 삭제</th>'
                            +'<td scope="col" class="view_table_text" colspan="1" style="width:10%">'
                            +'<button type="button" class="file-label file-del " id="file-del'+file_number+'" <?= $row44['report'] ==2? "disabled": ""; ?>>삭제</button>'
                            +'</td>'
                            +'</tr>';

                            $('.file_table_all').append(html);

                            $("#file-label-btn").attr('for', 'upload0'+file_number);
                            file_upload_check = true;
                        }

                })

                    }
            })
            var file_upload_check_rater = true;
            $("#file-label-btn1").bind("click",function(){
                if(file_upload_check_rater){ 
                    file_upload_check_rater = false;
                    $('#upload1_0'+file_number_rater).change(function(){
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
                            $(this).after('<input type="hidden" name="file_type[]" value ="1" />');
                            $(this).attr('name' , 'bf_file[]');

                            var html = '<tr class="input_form_info upload1_0'+file_number_rater+'">'
                            +'    <th scope="col" class="view_table_header " colspan="1" style="width:10%; height: 58px;">첨부파일</th>'
                            +'    <td scope="col" class="view_table_text " colspan="1" style="width:10%">'
                            +'       <img src="<?php echo G5_IMG_URL ?>/download_icon.png" alt="<?php echo $config['cf_title']; ?>">'
                            +'    </th>'
                            +'    <td scope="col" class="view_table_text_name " colspan="7">'+ fileName+'</th>'
                            +'</tr>';


                            $('#view_table_upload_rater').append(html);

                            file_number_rater++;

                            // var html = '<div class="input-file"><input type="text" id="file_label_view'+file_number+'" readonly="readonly" class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="파일명"/><input type="text" id="file-size-'+file_number+'" class="file-name file-size" value="용량" readonly="readonly"/><input type="file" name="bf_file[]" id="upload0'+file_number+'" class="file-upload" <?= $row44['report'] ==2? "disabled": ""; ?>/><button type="button" class="file-label file-del " id="file-del'+file_number+'" <?= $row44['report'] ==2? "disabled": ""; ?>style="background:<?= $row44['report'] ==2? '#ccc !important': 'crimson'; ?>">삭제</button></div>';
                            var html ='<tr class="input-file_list">'
                            +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일명</th>'
                            +'<td scope="col" class="view_table_text" colspan="1" style="width:40%">'
                            +'    <input type="text" id="file_label_view'+file_number_rater+'" readonly="readonly" class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="파일명"/>'
                            +'</td>'
                            +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 사이즈</th>'
                            +'<td scope="col" class="view_table_text" colspan="1" style="width:20%">'
                            +'    <input type="text" id="file-size-'+file_number_rater+'" class="file-name file-size" value="용량" readonly="readonly"/>'
                            +'    <input type="file" name="bf_file_null[]" id="upload1_0'+file_number_rater+'" class="file-upload" <?= $row44['report'] ==2? "disabled": ""; ?>/>'
                            +'</td>'
                            +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 삭제</th>'
                            +'<td scope="col" class="view_table_text" colspan="1" style="width:10%">'
                            +'<button type="button" class="file-label file-del " id="file-del'+file_number_rater+'" <?= $row44['report'] ==2? "disabled": ""; ?>>삭제</button>'
                            +'</td>'
                            +'</tr>';
                            $('.file_table_rater').append(html);

                            $("#file-label-btn1").attr('for', 'upload1_0'+file_number_rater);
                            file_upload_check_rater = true;
                        }
                    })
                }
            })


            $(document).off().on('click','.file-del',function(){
                var val = $(this).parent().find('.file-upload').prev().val();
                var file_id = $(this).parent().prev().prev().find('.file-upload').attr('id');
                // alert(val);
                var next = $(this).parent().parent().next('tr').val();
                var index_form = $(this).parent().parent().index('.input-file_list')+1;
                if(val != undefined){
                    $(this).parent().parent().remove();
                    $('.'+file_id+'').remove();
                    
                } else {
                    if(next == ""){
                        $(this).parent().parent().remove();
                        $('.'+file_id+'').remove();
                    } 
                }    
            })
        })
    </script>
<?php } else if ($_GET['bo_idx'] == 3) { ?>
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
                            <input type="text" name="quest_number" id="quest_number"  class="input_text" placeholder="선발 후 부여 됩니다" value="" readonly>
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
                            <input type="text" name="en_title" id="en_title"  class="input_text input_border_true" placeholder="과제명(영문)" >
                        </td>
                    </tr>
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="8">집단회 개최</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" >소속 기관</th>
                        <td scope="col" class="view_table_text view_table_padding" colspan="7" >
                        <input type="text" name="meeting_agency" id="meeting_agency"  class="input_text input_border_true" placeholder="소속 기관" >
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" >개최장소</th>
                        <td scope="col" class="view_table_text view_table_padding" colspan="3" >
                        <input type="text" name="meeting_venue" id="meeting_venue"  class="input_text input_border_true" placeholder="개최장소" >
                        </td>
                        <th scope="col" class="view_table_header" >집담회 규모(인원)</th>
                        <td scope="col" class="view_table_text view_table_padding" colspan="3" >
                        <input type="text" name="meeting_scale" id="meeting_scale"  class="input_text input_border_true" placeholder="명" >
                        </td>
                    </tr>
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="8">책임자현황</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1"style="width:10%;">성명</th>
                        <td scope="col" class="view_table_text view_table_padding"  colspan="3" style="width:40%;">
                            <input type="text" name="normal_manager_name" id="normal_manager_name"  class="input_text input_border_true" placeholder="성명">
                        </td>
                        <th scope="col" class="view_table_header" colspan="1"style="width:10%;">전공(학위)</th>
                        <td scope="col" class="view_table_text view_table_padding" colspan="3" style="width:40%;">
                            <input type="text" name="normal_manager_degree" id="normal_manager_degree"  class="input_text input_border_true" placeholder="전공(학위)" >
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%;">소속</th>
                        <td scope="col" class="view_table_text view_table_padding" colspan="3" style="width:40%;">
                            <input type="text" name="normal_manager_belong" id="normal_manager_belong"  class="input_text input_border_true" placeholder="소속"  >
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%;">직급</th>
                        <td scope="col" class="view_table_text view_table_padding" colspan="3" style="width:40%;">
                            <input type="text" name="normal_manager_rank" id="normal_manager_rank"  class="input_text input_border_true" placeholder="직급" >
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%;">이메일</th>
                        <td scope="col" class="view_table_text view_table_padding" colspan="3" style="width:40%;">
                            <input type="text" name="normal_manager_email" id="normal_manager_email"  class="input_text input_border_true" placeholder="이메일">
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%;">전화</th>
                        <td scope="col" class="view_table_text view_table_padding" colspan="3" style="width:40%;">
                        <input type="text" name="normal_manager_phone" id="normal_manager_phone"  class="input_text input_border_true" placeholder="숫자만 기재" > 
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
                        <th scope="col" class="view_table_header"colspan="1" >제목</th>
                        <td scope="col" class="view_table_title" colspan="7" >
                            <input type="text" name="title_view" id="title_view"  class="input_text " placeholder="제목" value="<?= $row['wr_subject']; ?>"  readonly>
                        </td>
                    </tr>
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">소속기관 현황</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="1">소속기관</th>
                        <td scope="col" class="view_table_text view_table_padding" colspan="8" >
                            <input type="text" name="belong_agency" id="belong_agency" placeholder="소속기관"  class="input_text input_border_true"  >
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="col" class="view_table_header" rowspan="3">기관 책임자</th>
                        <th scope="col" class="view_table_header" colspan="1" style=" width:10%">성명</th>
                        <td scope="col" class="view_table_text view_table_padding" colspan="1" >
                        <input type="text" name="agency_name" id="agency_name"  class="input_text input_border_true" placeholder="성명" >
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" >전공(학위)</th>
                        <td scope="col" class="view_table_text view_table_padding" colspan="5" >
                        <input type="text" name="agency_degree" id="agency_degree"  class="input_text input_border_true" placeholder="전공(학위)" >
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >소속</th>
                        <td scope="col" class="view_table_text view_table_padding" colspan="1" >
                        <input type="text" name="agency_belong" id="agency_belong"  class="input_text input_border_true" placeholder="소속" >
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" >직급</th>
                        <td scope="col" class="view_table_text view_table_padding" colspan="5" >
                        <input type="text" name="agency_rank" id="agency_rank"  class="input_text input_border_true" placeholder="직급" >
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >이메일</th>
                        <td scope="col" class="view_table_text view_table_padding" colspan="1" >
                        <input type="text" name="agency_email" id="agency_email"  class="input_text input_border_true" placeholder="이메일" >
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" >전화</th>
                        <td scope="col" class="view_table_text view_table_padding" colspan="5" >
                        <input type="text" name="agency_phone" id="agency_phone"  class="input_text input_border_true" placeholder="전화" >
                        </td>
                    </tr>

                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">연구정보</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1">연구비신청액</th>
                        <td scope="col" class="view_table_text view_table_padding" colspan="7" >
                            <input type="text" name="money" id="money"  class="input_text input_border_true money" placeholder="숫자만 기재 (원)" >
                        </td>
                    </tr>

                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">자료첨부</th>
                    </tr>
                </tbody>
            </table>
        

            <div class ="btn_confirm write_div btn-cont">
                <div class="next_prev_bar">
                <label for="upload01" id="file-label-btn" class="file-label file-label-btn"><img src="<?= G5_IMG_URL ?>/upload.png" alt=""> 파일 업로드</label>

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
                        <td scope="col" class="view_table_title" colspan="8" style="width: 90%;">
                            <input type="text" name="title_view" id="title_view"  class="input_text " placeholder="제목" value="<?= $row['wr_subject']; ?>"  readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" style="width: 10%;">접수번호</th>
                        <td scope="col" class="view_table_text" colspan="4" style="width: 40%;">
                        <input type="text" name="info_number_view" id="info_number_view"  class="input_text" placeholder="접수 완료시 자동부여됩니다."  readonly>
                        </td>
                        <th scope="col" class="view_table_header" style="width: 10%;">과제번호</th>
                        <td scope="col" class="view_table_text" colspan="4" style="width: 40%;">
                        <input type="text" name="quest_number_view" id="quest_number_view"  class="input_text" placeholder="선발 후 부여 됩니다" value="" readonly>
                        </td>
                    </tr>
                </thead>
                <tbody id="input_file_cont">
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">연구과제명</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >과제명(국문)</th>
                        <td scope="col" class="view_table_text" colspan="8" >
                        <input type="text" name="ko_title_view" id="ko_title_view"  class="input_text" placeholder="과제명(국문)"readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >과제명(영문)</th>
                        <td scope="col" class="view_table_text" colspan="8" >
                        <input type="text" name="en_title_view" id="en_title_view"  class="input_text" placeholder="과제명(영문)" readonly>
                        </td>
                    </tr>
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">집단회 개최</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" >소속 기관</th>
                        <td scope="col" class="view_table_text" colspan="8" >
                        <input type="text" name="meeting_agency_view" id="meeting_agency_view"  class="input_text" placeholder="" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" >개최장소</th>
                        <td scope="col" class="view_table_text" colspan="4" >
                        <input type="text" name="meeting_venue_view" id="meeting_venue_view"  class="input_text" placeholder="" readonly>
                        </td>
                        <th scope="col" class="view_table_header" >집담회 규모(인원)</th>
                        <td scope="col" class="view_table_text" colspan="3" >
                        <input type="text" name="meeting_scale_view" id="meeting_scale_view"  class="input_text" placeholder="명" readonly>
                        </td>
                    </tr>
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">책임자현황</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >성명</th>
                        <td scope="col" class="view_table_text" colspan="4" >
                        <input type="text" name="normal_manager_name_view" id="normal_manager_name_view"  class="input_text" placeholder="성명" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" >전공(학위)</th>
                        <td scope="col" class="view_table_text" colspan="3" >
                        <input type="text" name="normal_manager_degree_view" id="normal_manager_degree_view"  class="input_text" placeholder="전공(학위)" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >소속</th>
                        <td scope="col" class="view_table_text" colspan="4" >
                        <input type="text" name="normal_manager_belong_view" id="normal_manager_belong_view"  class="input_text" placeholder="소속" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" >직급</th>
                        <td scope="col" class="view_table_text" colspan="3" >
                        <input type="text" name="normal_manager_rank_view" id="normal_manager_rank_view"  class="input_text" placeholder="직급" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >이메일</th>
                        <td scope="col" class="view_table_text" colspan="4" >
                        <input type="text" name="normal_manager_email_view" id="normal_manager_email_view"  class="input_text" placeholder="이메일" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" >전화</th>
                        <td scope="col" class="view_table_text" colspan="3" >
                        <input type="text" name="normal_manager_phone_view" id="normal_manager_phone_view"  class="input_text" placeholder="전화" readonly>
                        </td>
                    </tr>
                
                    
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">소속기관 현황</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1">소속기관</th>
                        <td scope="col" class="view_table_text" colspan="8" >
                            <input type="text" name="belong_agency_view" id="belong_agency_view" placeholder=""  class="input_text"  readonly>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="col" class="view_table_header" rowspan="3">소속기관</th>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%">성명</th>
                        <td scope="col" class="view_table_text" colspan="3" >
                        <input type="text" name="agency_name_view" id="agency_name_view"  class="input_text" placeholder="성명" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%">전공(학위)</th>
                        <td scope="col" class="view_table_text" colspan="4" >
                        <input type="text" name="agency_degree_view" id="agency_degree_view"  class="input_text" placeholder="전공(학위)" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%">소속</th>
                        <td scope="col" class="view_table_text" colspan="3" >
                        <input type="text" name="agency_belong_view" id="agency_belong_view"  class="input_text" placeholder="소속" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%">직급</th>
                        <td scope="col" class="view_table_text" colspan="4" >
                        <input type="text" name="agency_rank_view" id="agency_rank_view"  class="input_text" placeholder="직급" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%">이메일</th>
                        <td scope="col" class="view_table_text" colspan="3" >
                        <input type="text" name="agency_email_view" id="agency_email_view"  class="input_text" placeholder="이메일" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%">전화</th>
                        <td scope="col" class="view_table_text" colspan="4" >
                        <input type="text" name="agency_phone_view" id="agency_phone_view"  class="input_text" placeholder="전화" readonly>
                        </td>
                    </tr>
                    
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">연구정보</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1">연구비신청액</th>
                        <td scope="col" class="view_table_text " colspan="7" >
                            <input type="text" name="money_view" id="money_view"  class="input_text  money" placeholder="숫자만 기재 (원)" readonly>
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
            $('.btn_step1').click(function(){
                $('.step').removeClass('step_view');
                $('.step1').addClass('step_view');
            });
            $('.btn_step2').click(function(){
                // // validation
                if($('#ko_title').val() == "") return alert("국문 과제명이 비어있습니다");
                if($('#en_title').val() == "") return alert("영문 과제명이 비어있습니다");

                if($('#meeting_agency').val() == "") return alert("소속기관이 비어있습니다");
                if($('#meeting_venue').val() == "") return alert("개최장소가 비어있습니다");
                if($('#meeting_scale').val() == "") return alert("칩담회 규모(인원)가 비어있습니다");

                if($('#normal_manager_name').val() == "") return alert("책임자 성명이 비어있습니다");
                if($('#normal_manager_degree').val() == "") return alert("책임자 전공이 비어있습니다");
                if($('#normal_manager_belong').val() == "") return alert("책임자 소속이 비어있습니다");
                if($('#normal_manager_rank').val() == "") return alert("책임자 직급이 비어있습니다");
                if($('#normal_manager_email').val() == "") return alert("책임자 이메일이 비어있습니다");
                if($('#normal_manager_phone').val() == "") return alert("책임자 전화번호가 비어있습니다");
                
                
                //정규식 설정
                var fncTest = /^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]+(\.[a-zA-Z]{2,3}){1,4}$/i;
                var regex= /^[0-9]+$/;

                //정규식 결과 저장
                var meeting_scale = regex.test( $("#meeting_scale").val());
                var normal_manager_email = fncTest.test( $("#normal_manager_email").val());
                var normal_manager_phone = regex.test( $("#normal_manager_phone").val() );

                if(!meeting_scale) return alert("집담회 규모(인원)에 숫자만 입력해주세요.");
                if(!normal_manager_email) return alert("E-mail 주소가 형식에 맞지 않습니다.");
                if(!normal_manager_phone) return alert("전화번호에 숫자만 입력해주세요");

                // // logic
                $('.step').removeClass('step_view');
                $('.step2').addClass('step_view');
            });
            $('.btn_step3').click(function(){
                // // validation   
                if($('#belong_agency').val() == "") return alert("소속기관이 비어있습니다");
                if($('#agency_name').val() == "") return alert("기관 책임자 성명이 비어있습니다");
                if($('#agency_degree').val() == "") return alert("기관 책임자 전공이 비어있습니다");
                if($('#agency_belong').val() == "") return alert("기관 책임자 소속이 비어있습니다");
                if($('#agency_rank').val() == "") return alert("기관 책임자 직급이 비어있습니다");
                if($('#agency_email').val() == "") return alert("기관 책임자 이메일이 비어있습니다");
                if($('#agency_phone').val() == "") return alert("기관 책임자 전화번호가 비어있습니다");  
                if($('#money').val() == "") return alert("연구비신청액이 비어있습니다");
                if($(".file-upload").val() =="") return alert("파일을 업로드 해주세요");  

                //정규식 설정
                // 숫자 체크
                var regex= /^[0-9]+$/;
                var fncTest = /^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]+(\.[a-zA-Z]{2,3}){1,4}$/i;

                //정규식 결과 저장
                var money = regex.test( $("#money").val());
                var agency_phone = regex.test( $("#agency_phone").val());
                var agency_email = fncTest.test( $("#agency_email").val() );

                if(!agency_email) return alert("E-mail 주소가 형식에 맞지 않습니다.");
                if(!agency_phone) return alert("소속기관 책임자 전화번호에 숫자만 입력해주세요");
                if(!money) return alert("연구비신청액에 숫자만 입력해주세요");
                    
                // // logic
                $('.step').removeClass('step_view');
                $('.step3').addClass('step_view');
            });   

            // 신청 내용 최종 세션에 값 넣기
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
            $('#meeting_agency').change(function(){
                $('#meeting_agency_view').val($(this).val());
            });
            $('#meeting_venue').change(function(){
                $('#meeting_venue_view').val($(this).val());
            });
            $('#meeting_scale').change(function(){
                $('#meeting_scale_view').val($(this).val().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+"명");
            });
            $('#normal_manager_name').change(function(){
                $('#normal_manager_name_view').val($(this).val());
            });
            $('#normal_manager_degree').change(function(){
                $('#normal_manager_degree_view').val($(this).val());
            });
            $('#normal_manager_belong').change(function(){
                $('#normal_manager_belong_view').val($(this).val());
            });
            $('#normal_manager_rank').change(function(){
                $('#normal_manager_rank_view').val($(this).val());
            });
            $('#normal_manager_degree').change(function(){
                $('#normal_manager_degree_member_view').val($(this).val());
            });
            $('#normal_manager_email').change(function(){
                $('#normal_manager_email_view').val($(this).val());
            });
            $('#normal_manager_phone').change(function(){
                $('#normal_manager_phone_view').val($(this).val());
            });


            $('#belong_agency').change(function(){
                $('#belong_agency_view').val($(this).val());
            });
            $('#agency_name').change(function(){
                $('#agency_name_view').val($(this).val());
            });
            $('#agency_degree').change(function(){
                $('#agency_degree_view').val($(this).val());
            });
            $('#agency_belong').change(function(){
                $('#agency_belong_view').val($(this).val());
            });
            $('#agency_rank').change(function(){
                $('#agency_rank_view').val($(this).val());
            });
            $('#agency_email').change(function(){
                $('#agency_email_view').val($(this).val());
            });
            $('#agency_phone').change(function(){
                $('#agency_phone_view').val($(this).val());
            });
            $('.money').change(function(){
                $('#money_view').val($(this).val().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+"원");
            });
            
            var file_number = 1;
            var html = '<tr class="input-file_list">'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일명</th>'
                        +'<td scope="col" class="view_table_text" colspan="2" style="width:40%">'
                        +'    <input type="text" style="margin: 0 -2px;" id="file_label_view1" readonly="readonly" class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="파일명"/> '
                        +'</td>'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 사이즈</th>'
                        +'<td scope="col" class="view_table_text" colspan="2" style="width:20%">'
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

            var file_upload_check = true;
            //클릭이벤트 bind
            $("#file-label-btn").bind("click",function(){ 
                    if(file_upload_check){
                    file_upload_check = false;
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
                            $(this).after('<input type="hidden" name="file_type[]" value ="0" />');
                            $(this).attr('name' , 'bf_file[]');

                            var html = '<tr class="input_form_info upload0'+file_number+'">'
                            +'    <th scope="col" class="view_table_header " colspan="1" style="width:10%; height: 58px;">첨부파일</th>'
                            +'    <td scope="col" class="view_table_text " colspan="1" style="width:10%">'
                            +'       <img src="<?php echo G5_IMG_URL ?>/download_icon.png" alt="<?php echo $config['cf_title']; ?>">'
                            +'    </th>'
                            +'    <td scope="col" class="view_table_text_name " colspan="7">'+  fileName+'</th>'
                            +'</tr>';

                            $('#view_table_upload').append(html);

                            file_number++;

                            // var html = '<div class="input-file"><input type="text" id="file_label_view'+file_number+'" readonly="readonly" class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="파일명"/><input type="text" id="file-size-'+file_number+'" class="file-name file-size" value="용량" readonly="readonly"/><input type="file" name="bf_file[]" id="upload0'+file_number+'" class="file-upload" <?= $row44['report'] ==2? "disabled": ""; ?>/><button type="button" class="file-label file-del " id="file-del'+file_number+'" <?= $row44['report'] ==2? "disabled": ""; ?>style="background:<?= $row44['report'] ==2? '#ccc !important': 'crimson'; ?>">삭제</button></div>';
                            var html ='<tr class="input-file_list input-file_list_all">'
                            +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일명</th>'
                            +'<td scope="col" class="view_table_text" colspan="1" style="width:40%">'
                            +'    <input type="text" id="file_label_view'+file_number+'" readonly="readonly" class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="파일명"/>'
                            +'</td>'
                            +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 사이즈</th>'
                            +'<td scope="col" class="view_table_text" colspan="1" style="width:20%">'
                            +'    <input type="text" id="file-size-'+file_number+'" class="file-name file-size" value="용량" readonly="readonly"/>'
                            +'    <input type="file" name="bf_file_null[]" id="upload0'+file_number+'" class="file-upload" <?= $row44['report'] ==2? "disabled": ""; ?>/>'
                            +'</td>'
                            +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 삭제</th>'
                            +'<td scope="col" class="view_table_text" colspan="1" style="width:10%">'
                            +'<button type="button" class="file-label file-del " id="file-del'+file_number+'" <?= $row44['report'] ==2? "disabled": ""; ?>>삭제</button>'
                            +'</td>'
                            +'</tr>';

                            $('.file_table_all').append(html);

                            $("#file-label-btn").attr('for', 'upload0'+file_number);
                            file_upload_check = true;
                        }
                    })
                }
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
        })
    </script>
<?php } else if ($_GET['bo_idx'] == 4) { ?>
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
                            <input type="text" name="quest_number" id="quest_number"  class="input_text" placeholder="선발 후 부여 됩니다" value="" readonly>
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
                            <input type="text" name="en_title" id="en_title"  class="input_text input_border_true" placeholder="과제명(영문)" >
                        </td>
                    </tr>
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="8">집단회 개최</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" >소속 기관</th>
                        <td scope="col" class="view_table_text view_table_padding" colspan="7" >
                        <input type="text" name="meeting_agency" id="meeting_agency"  class="input_text input_border_true" placeholder="소속 기관" >
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" >개최장소</th>
                        <td scope="col" class="view_table_text view_table_padding" colspan="3" >
                        <input type="text" name="meeting_venue" id="meeting_venue"  class="input_text input_border_true" placeholder="개최장소" >
                        </td>
                        <th scope="col" class="view_table_header" >집담회 규모(인원)</th>
                        <td scope="col" class="view_table_text view_table_padding" colspan="3" >
                        <input type="text" name="meeting_scale" id="meeting_scale"  class="input_text input_border_true" placeholder="명" >
                        </td>
                    </tr>
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="8">책임자현황</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1"style="width:10%;">성명</th>
                        <td scope="col" class="view_table_text view_table_padding"  colspan="3" style="width:40%;">
                            <input type="text" name="normal_manager_name" id="normal_manager_name"  class="input_text input_border_true" placeholder="성명">
                        </td>
                        <th scope="col" class="view_table_header" colspan="1"style="width:10%;">전공(학위)</th>
                        <td scope="col" class="view_table_text view_table_padding" colspan="3" style="width:40%;">
                            <input type="text" name="normal_manager_degree" id="normal_manager_degree"  class="input_text input_border_true" placeholder="전공(학위)" >
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%;">소속</th>
                        <td scope="col" class="view_table_text view_table_padding" colspan="3" style="width:40%;">
                            <input type="text" name="normal_manager_belong" id="normal_manager_belong"  class="input_text input_border_true" placeholder="소속"  >
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%;">직급</th>
                        <td scope="col" class="view_table_text view_table_padding" colspan="3" style="width:40%;">
                            <input type="text" name="normal_manager_rank" id="normal_manager_rank"  class="input_text input_border_true" placeholder="직급" >
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%;">이메일</th>
                        <td scope="col" class="view_table_text view_table_padding" colspan="3" style="width:40%;">
                            <input type="text" name="normal_manager_email" id="normal_manager_email"  class="input_text input_border_true" placeholder="이메일">
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%;">전화</th>
                        <td scope="col" class="view_table_text view_table_padding" colspan="3" style="width:40%;">
                        <input type="text" name="normal_manager_phone" id="normal_manager_phone"  class="input_text input_border_true" placeholder="숫자만 기재" > 
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
                        <th scope="col" class="view_table_header"colspan="1" >제목</th>
                        <td scope="col" class="view_table_title" colspan="7" >
                            <input type="text" name="title_view" id="title_view"  class="input_text " placeholder="제목" value="<?= $row['wr_subject']; ?>"  readonly>
                        </td>
                    </tr>
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">소속기관 현황</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="1">소속기관</th>
                        <td scope="col" class="view_table_text view_table_padding" colspan="8" >
                            <input type="text" name="belong_agency" id="belong_agency" placeholder="소속기관"  class="input_text input_border_true"  >
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="col" class="view_table_header" rowspan="3">기관 책임자</th>
                        <th scope="col" class="view_table_header" colspan="1" style=" width:10%">성명</th>
                        <td scope="col" class="view_table_text view_table_padding" colspan="1" >
                        <input type="text" name="agency_name" id="agency_name"  class="input_text input_border_true" placeholder="성명" >
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" >전공(학위)</th>
                        <td scope="col" class="view_table_text view_table_padding" colspan="5" >
                        <input type="text" name="agency_degree" id="agency_degree"  class="input_text input_border_true" placeholder="전공(학위)" >
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >소속</th>
                        <td scope="col" class="view_table_text view_table_padding" colspan="1" >
                        <input type="text" name="agency_belong" id="agency_belong"  class="input_text input_border_true" placeholder="소속" >
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" >직급</th>
                        <td scope="col" class="view_table_text view_table_padding" colspan="5" >
                        <input type="text" name="agency_rank" id="agency_rank"  class="input_text input_border_true" placeholder="직급" >
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >이메일</th>
                        <td scope="col" class="view_table_text view_table_padding" colspan="1" >
                        <input type="text" name="agency_email" id="agency_email"  class="input_text input_border_true" placeholder="이메일" >
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" >전화</th>
                        <td scope="col" class="view_table_text view_table_padding" colspan="5" >
                        <input type="text" name="agency_phone" id="agency_phone"  class="input_text input_border_true" placeholder="전화" >
                        </td>
                    </tr>

                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">연구정보</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1">연구비신청액</th>
                        <td scope="col" class="view_table_text view_table_padding" colspan="7" >
                            <input type="text" name="money" id="money"  class="input_text input_border_true money" placeholder="숫자만 기재 (원)" >
                        </td>
                    </tr>

                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">자료첨부</th>
                    </tr>
                </tbody>
            </table>
        

            <div class ="btn_confirm write_div btn-cont">
                <div class="next_prev_bar">
                <label for="upload01" id="file-label-btn" class="file-label file-label-btn"><img src="<?= G5_IMG_URL ?>/upload.png" alt=""> 파일 업로드</label>
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
                        <td scope="col" class="view_table_title" colspan="8" style="width: 90%;">
                            <input type="text" name="title_view" id="title_view"  class="input_text " placeholder="제목" value="<?= $row['wr_subject']; ?>"  readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" style="width: 10%;">접수번호</th>
                        <td scope="col" class="view_table_text" colspan="4" style="width: 40%;">
                        <input type="text" name="info_number_view" id="info_number_view"  class="input_text" placeholder="접수 완료시 자동부여됩니다."  readonly>
                        </td>
                        <th scope="col" class="view_table_header" style="width: 10%;">과제번호</th>
                        <td scope="col" class="view_table_text" colspan="4" style="width: 40%;">
                        <input type="text" name="quest_number_view" id="quest_number_view"  class="input_text" placeholder="선발 후 부여 됩니다" value="" readonly>
                        </td>
                    </tr>
                </thead>
                <tbody id="input_file_cont">
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">연구과제명</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >과제명(국문)</th>
                        <td scope="col" class="view_table_text" colspan="8" >
                        <input type="text" name="ko_title_view" id="ko_title_view"  class="input_text" placeholder="과제명(국문)"readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >과제명(영문)</th>
                        <td scope="col" class="view_table_text" colspan="8" >
                        <input type="text" name="en_title_view" id="en_title_view"  class="input_text" placeholder="과제명(영문)" readonly>
                        </td>
                    </tr>
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">집단회 개최</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" >소속 기관</th>
                        <td scope="col" class="view_table_text" colspan="8" >
                        <input type="text" name="meeting_agency_view" id="meeting_agency_view"  class="input_text" placeholder="" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" >개최장소</th>
                        <td scope="col" class="view_table_text" colspan="4" >
                        <input type="text" name="meeting_venue_view" id="meeting_venue_view"  class="input_text" placeholder="" readonly>
                        </td>
                        <th scope="col" class="view_table_header" >집담회 규모(인원)</th>
                        <td scope="col" class="view_table_text" colspan="3" >
                        <input type="text" name="meeting_scale_view" id="meeting_scale_view"  class="input_text" placeholder="명" readonly>
                        </td>
                    </tr>
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">책임자현황</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >성명</th>
                        <td scope="col" class="view_table_text" colspan="4" >
                        <input type="text" name="normal_manager_name_view" id="normal_manager_name_view"  class="input_text" placeholder="성명" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" >전공(학위)</th>
                        <td scope="col" class="view_table_text" colspan="3" >
                        <input type="text" name="normal_manager_degree_view" id="normal_manager_degree_view"  class="input_text" placeholder="전공(학위)" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >소속</th>
                        <td scope="col" class="view_table_text" colspan="4" >
                        <input type="text" name="normal_manager_belong_view" id="normal_manager_belong_view"  class="input_text" placeholder="소속" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" >직급</th>
                        <td scope="col" class="view_table_text" colspan="3" >
                        <input type="text" name="normal_manager_rank_view" id="normal_manager_rank_view"  class="input_text" placeholder="직급" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >이메일</th>
                        <td scope="col" class="view_table_text" colspan="4" >
                        <input type="text" name="normal_manager_email_view" id="normal_manager_email_view"  class="input_text" placeholder="이메일" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" >전화</th>
                        <td scope="col" class="view_table_text" colspan="3" >
                        <input type="text" name="normal_manager_phone_view" id="normal_manager_phone_view"  class="input_text" placeholder="전화" readonly>
                        </td>
                    </tr>
                
                    
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">소속기관 현황</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1">소속기관</th>
                        <td scope="col" class="view_table_text" colspan="8" >
                            <input type="text" name="belong_agency_view" id="belong_agency_view" placeholder=""  class="input_text"  readonly>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="col" class="view_table_header" rowspan="3">소속기관</th>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%">성명</th>
                        <td scope="col" class="view_table_text" colspan="3" >
                        <input type="text" name="agency_name_view" id="agency_name_view"  class="input_text" placeholder="성명" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%">전공(학위)</th>
                        <td scope="col" class="view_table_text" colspan="4" >
                        <input type="text" name="agency_degree_view" id="agency_degree_view"  class="input_text" placeholder="전공(학위)" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%">소속</th>
                        <td scope="col" class="view_table_text" colspan="3" >
                        <input type="text" name="agency_belong_view" id="agency_belong_view"  class="input_text" placeholder="소속" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%">직급</th>
                        <td scope="col" class="view_table_text" colspan="4" >
                        <input type="text" name="agency_rank_view" id="agency_rank_view"  class="input_text" placeholder="직급" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%">이메일</th>
                        <td scope="col" class="view_table_text" colspan="3" >
                        <input type="text" name="agency_email_view" id="agency_email_view"  class="input_text" placeholder="이메일" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%">전화</th>
                        <td scope="col" class="view_table_text" colspan="4" >
                        <input type="text" name="agency_phone_view" id="agency_phone_view"  class="input_text" placeholder="전화" readonly>
                        </td>
                    </tr>
                    
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">연구정보</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1">연구비신청액</th>
                        <td scope="col" class="view_table_text " colspan="7" >
                            <input type="text" name="money_view" id="money_view"  class="input_text  money" placeholder="숫자만 기재 (원)" readonly>
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
            $('.btn_step1').click(function(){
                $('.step').removeClass('step_view');
                $('.step1').addClass('step_view');
            });
            $('.btn_step2').click(function(){
                // // validation
                if($('#ko_title').val() == "") return alert("국문 과제명이 비어있습니다");
                if($('#en_title').val() == "") return alert("영문 과제명이 비어있습니다");

                if($('#meeting_agency').val() == "") return alert("소속기관이 비어있습니다");
                if($('#meeting_venue').val() == "") return alert("개최장소가 비어있습니다");
                if($('#meeting_scale').val() == "") return alert("칩담회 규모(인원)가 비어있습니다");

                if($('#normal_manager_name').val() == "") return alert("책임자 성명이 비어있습니다");
                if($('#normal_manager_degree').val() == "") return alert("책임자 전공이 비어있습니다");
                if($('#normal_manager_belong').val() == "") return alert("책임자 소속이 비어있습니다");
                if($('#normal_manager_rank').val() == "") return alert("책임자 직급이 비어있습니다");
                if($('#normal_manager_email').val() == "") return alert("책임자 이메일이 비어있습니다");
                if($('#normal_manager_phone').val() == "") return alert("책임자 전화번호가 비어있습니다");
                
                
                //정규식 설정
                var fncTest = /^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]+(\.[a-zA-Z]{2,3}){1,4}$/i;
                var regex= /^[0-9]+$/;

                //정규식 결과 저장
                var meeting_scale = regex.test( $("#meeting_scale").val());
                var normal_manager_email = fncTest.test( $("#normal_manager_email").val());
                var normal_manager_phone = regex.test( $("#normal_manager_phone").val() );

                if(!meeting_scale) return alert("집담회 규모(인원)에 숫자만 입력해주세요.");
                if(!normal_manager_email) return alert("E-mail 주소가 형식에 맞지 않습니다.");
                if(!normal_manager_phone) return alert("전화번호에 숫자만 입력해주세요");

                // // logic
                $('.step').removeClass('step_view');
                $('.step2').addClass('step_view');
            });
            $('.btn_step3').click(function(){
                // // validation   
                if($('#belong_agency').val() == "") return alert("소속기관이 비어있습니다");
                if($('#agency_name').val() == "") return alert("기관 책임자 성명이 비어있습니다");
                if($('#agency_degree').val() == "") return alert("기관 책임자 전공이 비어있습니다");
                if($('#agency_belong').val() == "") return alert("기관 책임자 소속이 비어있습니다");
                if($('#agency_rank').val() == "") return alert("기관 책임자 직급이 비어있습니다");
                if($('#agency_email').val() == "") return alert("기관 책임자 이메일이 비어있습니다");
                if($('#agency_phone').val() == "") return alert("기관 책임자 전화번호가 비어있습니다");  
                if($('#money').val() == "") return alert("연구비신청액이 비어있습니다");
                if($(".file-upload").val() =="") return alert("파일을 업로드 해주세요");  

                //정규식 설정
                // 숫자 체크
                var regex= /^[0-9]+$/;
                var fncTest = /^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]+(\.[a-zA-Z]{2,3}){1,4}$/i;

                //정규식 결과 저장
                var money = regex.test( $("#money").val());
                var agency_phone = regex.test( $("#agency_phone").val());
                var agency_email = fncTest.test( $("#agency_email").val() );

                if(!agency_email) return alert("E-mail 주소가 형식에 맞지 않습니다.");
                if(!agency_phone) return alert("소속기관 책임자 전화번호에 숫자만 입력해주세요");
                if(!money) return alert("연구비신청액에 숫자만 입력해주세요");
                    
                // // logic
                $('.step').removeClass('step_view');
                $('.step3').addClass('step_view');
            });   

            // 신청 내용 최종 세션에 값 넣기
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
            $('#meeting_agency').change(function(){
                $('#meeting_agency_view').val($(this).val());
            });
            $('#meeting_venue').change(function(){
                $('#meeting_venue_view').val($(this).val());
            });
            $('#meeting_scale').change(function(){
                $('#meeting_scale_view').val($(this).val().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+"명");
            });
            $('#normal_manager_name').change(function(){
                $('#normal_manager_name_view').val($(this).val());
            });
            $('#normal_manager_degree').change(function(){
                $('#normal_manager_degree_view').val($(this).val());
            });
            $('#normal_manager_belong').change(function(){
                $('#normal_manager_belong_view').val($(this).val());
            });
            $('#normal_manager_rank').change(function(){
                $('#normal_manager_rank_view').val($(this).val());
            });
            $('#normal_manager_degree').change(function(){
                $('#normal_manager_degree_member_view').val($(this).val());
            });
            $('#normal_manager_email').change(function(){
                $('#normal_manager_email_view').val($(this).val());
            });
            $('#normal_manager_phone').change(function(){
                $('#normal_manager_phone_view').val($(this).val());
            });


            $('#belong_agency').change(function(){
                $('#belong_agency_view').val($(this).val());
            });
            $('#agency_name').change(function(){
                $('#agency_name_view').val($(this).val());
            });
            $('#agency_degree').change(function(){
                $('#agency_degree_view').val($(this).val());
            });
            $('#agency_belong').change(function(){
                $('#agency_belong_view').val($(this).val());
            });
            $('#agency_rank').change(function(){
                $('#agency_rank_view').val($(this).val());
            });
            $('#agency_email').change(function(){
                $('#agency_email_view').val($(this).val());
            });
            $('#agency_phone').change(function(){
                $('#agency_phone_view').val($(this).val());
            });
            $('.money').change(function(){
                $('#money_view').val($(this).val().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+"원");
            });
            
            var file_number = 1;
            var html = '<tr class="input-file_list">'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일명</th>'
                        +'<td scope="col" class="view_table_text" colspan="2" style="width:40%">'
                        +'    <input type="text" style="margin: 0 -2px;" id="file_label_view1" readonly="readonly" class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="파일명"/> '
                        +'</td>'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 사이즈</th>'
                        +'<td scope="col" class="view_table_text" colspan="2" style="width:20%">'
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

            var file_upload_check = true;
            //클릭이벤트 bind
            $("#file-label-btn").bind("click",function(){ 
                    if(file_upload_check){
                    file_upload_check = false;
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
                            $(this).after('<input type="hidden" name="file_type[]" value ="0" />');
                            $(this).attr('name' , 'bf_file[]');

                            var html = '<tr class="input_form_info upload0'+file_number+'">'
                            +'    <th scope="col" class="view_table_header " colspan="1" style="width:10%; height: 58px;">첨부파일</th>'
                            +'    <td scope="col" class="view_table_text " colspan="1" style="width:10%">'
                            +'       <img src="<?php echo G5_IMG_URL ?>/download_icon.png" alt="<?php echo $config['cf_title']; ?>">'
                            +'    </th>'
                            +'    <td scope="col" class="view_table_text_name " colspan="7">'+  fileName+'</th>'
                            +'</tr>';

                            $('#view_table_upload').append(html);

                            file_number++;

                            // var html = '<div class="input-file"><input type="text" id="file_label_view'+file_number+'" readonly="readonly" class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="파일명"/><input type="text" id="file-size-'+file_number+'" class="file-name file-size" value="용량" readonly="readonly"/><input type="file" name="bf_file[]" id="upload0'+file_number+'" class="file-upload" <?= $row44['report'] ==2? "disabled": ""; ?>/><button type="button" class="file-label file-del " id="file-del'+file_number+'" <?= $row44['report'] ==2? "disabled": ""; ?>style="background:<?= $row44['report'] ==2? '#ccc !important': 'crimson'; ?>">삭제</button></div>';
                            var html ='<tr class="input-file_list input-file_list_all">'
                            +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일명</th>'
                            +'<td scope="col" class="view_table_text" colspan="1" style="width:40%">'
                            +'    <input type="text" id="file_label_view'+file_number+'" readonly="readonly" class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="파일명"/>'
                            +'</td>'
                            +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 사이즈</th>'
                            +'<td scope="col" class="view_table_text" colspan="1" style="width:20%">'
                            +'    <input type="text" id="file-size-'+file_number+'" class="file-name file-size" value="용량" readonly="readonly"/>'
                            +'    <input type="file" name="bf_file_null[]" id="upload0'+file_number+'" class="file-upload" <?= $row44['report'] ==2? "disabled": ""; ?>/>'
                            +'</td>'
                            +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 삭제</th>'
                            +'<td scope="col" class="view_table_text" colspan="1" style="width:10%">'
                            +'<button type="button" class="file-label file-del " id="file-del'+file_number+'" <?= $row44['report'] ==2? "disabled": ""; ?>>삭제</button>'
                            +'</td>'
                            +'</tr>';

                            $('.file_table_all').append(html);

                            $("#file-label-btn").attr('for', 'upload0'+file_number);
                            file_upload_check = true;
                        }
                    })
                }
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
        })
    </script>
<?php } else if ($_GET['bo_idx'] == 5) { ?>
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
                            <input type="text" name="quest_number" id="quest_number"  class="input_text" placeholder="선발 후 부여 됩니다" value="" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" style="width:10%;">과제구분</th>
                        <td scope="col" class="view_table_title " colspan="3" style="width:45%;">
                            <input type="radio" name="quest_division" id="quest_division1" class="quest_division" value="국내학술대회" style="margin-left:10px" checked  readonly>
                            <label for="quest_division1">국내학술대회</label>
                            
                        </td>
                        <td scope="col" class="view_table_title " colspan="4" style="width:45%;">
                            <input type="radio" name="quest_division" id="quest_division2" class="quest_division" value="국제학술대회" style="margin-left:10px"   readonly>
                            <label for="quest_division2">국제학술대회</label>
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
                            <input type="text" name="en_title" id="en_title"  class="input_text input_border_true" placeholder="과제명(영문)" >
                        </td>
                    </tr>
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="8">연구주최</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1"style="width:10%;">주최(주관)<br>기관</th>
                        <td scope="col" class="view_table_text view_table_padding"  colspan="7" style="width:40%;">
                            <input type="text" name="host_name" id="host_name"  class="input_text input_border_true" placeholder="주최(주관)기관">
                        </td>
                    </tr>

                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >개최일시</th>
                        <td scope="col" class="view_table_text view_table_padding" colspan="3" >
                            <input type="text" name="host_date_start" id="host_date_start"  class="date_start input_text input_date input_border_true input_text_40"  max="9999-12-31" readonly placeholder="연도-월-일" >
                            ~
                            <input type="text" name="host_date_end" id="host_date_end" class="date_end input_text input_date input_border_true input_text_40" max="9999-12-31"  readonly placeholder="연도-월-일">
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" >개최장소</th>
                        <td scope="col" class="view_table_text view_table_padding" colspan="3" style="width:40%;">
                            <input type="text" name="host_venue" id="host_venue"  class="input_text input_border_true" placeholder="개최장소"  >
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" style="width:10%;">공동개최 Y/N</th>
                        <td scope="col" class="view_table_title " colspan="3" style="width:45%;">
                            <input type="radio" name="host_public_check" id="host_public_check1" style="margin-left:10px"  class="host_public_check"  placeholder="제목" value="단독" checked readonly>
                            <label for="host_public_check1">단독</label>
                            <input type="radio" name="host_public_check" id="host_public_check2" style="margin-left:10px"  class="host_public_check"  placeholder="제목" value="공동"  readonly>
                            <label for="host_public_check2">공동</label>
                            
                        </td>
                        <th scope="col" class="view_table_header" style="width:10%;">공동개최 기관명</th>
                        <td scope="col" class="view_table_text view_table_padding" colspan="3" style="width:40%;">
                            <input type="text" name="host_public_name" id="host_public_name"  class="input_text input_border_true" placeholder="공동개최 기관명"  >
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%;">후원기관 현황</th>
                        <td scope="col" class="view_table_text " colspan="3" style="width:40%;">
                            <input type="text" name="host_support_count" id="host_support_count"  class="input_text " placeholder="후원기관 현황" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%;">후원기관1</th>
                        <td scope="col" class="view_table_text view_table_padding" colspan="3" style="width:40%;">
                            <input type="text" name="host_support_1" id="host_support_1"  class="host_support input_text input_border_true" placeholder="후원기관1" >
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%;">후원기관2</th>
                        <td scope="col" class="view_table_text view_table_padding" colspan="3" style="width:40%;">
                            <input type="text" name="host_support_2" id="host_support_2"  class="host_support input_text input_border_true" placeholder="후원기관2">
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%;">후원기관3</th>
                        <td scope="col" class="view_table_text view_table_padding" colspan="3" style="width:40%;">
                        <input type="text" name="host_support_3" id="host_support_3"  class="host_support input_text input_border_true" placeholder="후원기관3" > 
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
                        <th scope="col" class="view_table_header"colspan="1" style="width:10%">제목</th>
                        <td scope="col" class="view_table_title" colspan="8" >
                            <input type="text" name="title_view" id="title_view"  class="input_text " placeholder="제목" value="<?= $row['wr_subject']; ?>"  readonly>
                        </td>
                    </tr>

                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">참가예정 인원</th>
                    </tr>

                    <tr>
                        <th scope="col" class="view_table_header" colspan="2" style="width:25%">발표자</th>
                        <td scope="col" class="view_table_text view_table_padding" colspan="2" style="width:25%">
                            <input type="text" name="presenter_user" id="presenter_user"  class="input_text input_border_true" placeholder="발표자">
                        </td>
                        <th scope="col" class="view_table_header" colspan="2" style="width:25%">토론자</th>
                        <td scope="col" class="view_table_text view_table_padding" colspan="3" style="width:25%">
                            <input type="text" name="debater_user" id="debater_user"  class="input_text input_border_true" placeholder="토론자">
                        </td>
                    </tr>

                    <tr>
                        <th scope="col" class="view_table_header" colspan="2" >사회자</th>
                        <td scope="col" class="view_table_text view_table_padding" colspan="2" >
                            <input type="text" name="mc_user" id="mc_user"  class="input_text input_border_true" placeholder="사회자">
                        </td>
                        <th scope="col" class="view_table_header" colspan="2" >일반참가자</th>
                        <td scope="col" class="view_table_text view_table_padding" colspan="3" >
                            <input type="text" name="normal_user" id="normal_user"  class="input_text input_border_true" placeholder="일반참가자">
                        </td>
                    </tr>
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">소속기관 현황</th>
                    </tr>
                    
                    <tr>
                        <th scope="col" class="view_table_header" rowspan="3">기관책임자</th>
                        <th scope="col" class="view_table_header" colspan="1" style=" width:10%">성명</th>
                        <td scope="col" class="view_table_text view_table_padding" colspan="2" >
                        <input type="text" name="institute_manager_name" id="institute_manager_name"  class="input_text input_border_true" placeholder="성명" >
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" >전공(학위)</th>
                        <td scope="col" class="view_table_text view_table_padding" colspan="4" >
                        <input type="text" name="institute_manager_degree" id="institute_manager_degree"  class="input_text input_border_true" placeholder="전공(학위)" >
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >소속</th>
                        <td scope="col" class="view_table_text view_table_padding" colspan="2" >
                        <input type="text" name="institute_manager_belong" id="institute_manager_belong"  class="input_text input_border_true" placeholder="소속" >
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" >직급</th>
                        <td scope="col" class="view_table_text view_table_padding" colspan="4" >
                        <input type="text" name="institute_manager_rank" id="institute_manager_rank"  class="input_text input_border_true" placeholder="직급" >
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >이메일</th>
                        <td scope="col" class="view_table_text view_table_padding" colspan="2" >
                        <input type="text" name="institute_manager_email" id="institute_manager_email"  class="input_text input_border_true" placeholder="이메일" >
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" >전화</th>
                        <td scope="col" class="view_table_text view_table_padding" colspan="4" >
                        <input type="text" name="institute_manager_phone" id="institute_manager_phone"  class="input_text input_border_true" placeholder="전화" >
                        </td>
                    </tr>

                   
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header view_user_header" rowspan="4" colspan="2" >소속기관</th>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%">연번</th>
                        <th scope="col" class="view_table_header" colspan="2" >직위</th>
                        <th scope="col" class="view_table_header" colspan="2" >성명</th>
                        <th scope="col" class="view_table_header" colspan="2" >소속</th>
                    </tr>

                    <tr class="user_table_list">
                        <th scope="col" class="view_table_header" colspan="1" >1</th>
                        <td scope="col" class="view_table_text view_table_padding" colspan="2" >
                            <input type="text" name="1_user_rank" id="1_user_rank"  class="input_text input_border_true" placeholder="직위" >
                        </td>
                        <td scope="col" class="view_table_text view_table_padding" colspan="2" >
                            <input type="text" name="1_user_name" id="1_user_name"  class="input_text input_border_true" placeholder="성명" >
                        </td>
                        <td scope="col" class="view_table_text view_table_padding" colspan="2" >
                            <input type="text" name="1_user_belong" id="1_user_belong"  class="input_text input_border_true" placeholder="소속" >
                        </td>
                    </tr>
                    <tr class="user_table_list">
                        <th scope="col" class="view_table_header" colspan="1" >2</th>
                        <td scope="col" class="view_table_text view_table_padding" colspan="2" >
                            <input type="text" name="2_user_rank" id="2_user_rank"  class="input_text input_border_true" placeholder="직위" >
                        </td>
                        <td scope="col" class="view_table_text view_table_padding" colspan="2" >
                            <input type="text" name="2_user_name" id="2_user_name"  class="input_text input_border_true" placeholder="성명" >
                        </td>
                        <td scope="col" class="view_table_text view_table_padding" colspan="2" >
                            <input type="text" name="2_user_belong" id="2_user_belong"  class="input_text input_border_true" placeholder="소속" >
                        </td>
                    </tr>
                    <tr class="user_table_list">
                        <th scope="col" class="view_table_header" colspan="1" >3</th>
                        <td scope="col" class="view_table_text view_table_padding" colspan="2" >
                            <input type="text" name="3_user_rank" id="3_user_rank"  class="input_text input_border_true" placeholder="직위" >
                        </td>
                        <td scope="col" class="view_table_text view_table_padding" colspan="2" >
                            <input type="text" name="3_user_name" id="3_user_name"  class="input_text input_border_true" placeholder="성명" >
                        </td>
                        <td scope="col" class="view_table_text view_table_padding" colspan="2" >
                            <input type="text" name="3_user_belong" id="3_user_belong"  class="input_text input_border_true" placeholder="소속" >
                        </td>
                    </tr>

                    
                    <tr>
                        <td scope="col" class="view_table_text  vlew_table_user" colspan="9" >
                            <button type="button" id="" class="btn_cancel user_table_del">삭제</button>
                            <button type="button" id="" class="btn_submit user_table_ins">추가</button>
                        </td>
                    </tr>
                   
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">연구정보</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1">연구비신청액</th>
                        <td scope="col" class="view_table_text view_table_padding" colspan="8" >
                            <input type="text" name="money" id="money"  class="input_text input_border_true money" placeholder="숫자만 기재 (원)" >
                        </td>
                    </tr>

                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">자료 첨부</th>
                    </tr>
                </tbody>
            </table>
        

            <div class ="btn_confirm write_div btn-cont">
                <div class="next_prev_bar">
                <label for="upload01" id="file-label-btn" class="file-label file-label-btn"><img src="<?= G5_IMG_URL ?>/upload.png" alt=""> 파일 업로드</label>

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
                        <td scope="col" class="view_table_title" colspan="8" style="width: 90%;">
                            <input type="text" name="title_view" id="title_view"  class="input_text " placeholder="제목" value="<?= $row['wr_subject']; ?>"  readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" style="width: 10%;">접수번호</th>
                        <td scope="col" class="view_table_text" colspan="3" style="width: 40%;">
                        <input type="text" name="info_number_view" id="info_number_view"  class="input_text" placeholder="접수 완료시 자동부여됩니다."  readonly>
                        </td>
                        <th scope="col" class="view_table_header" style="width: 10%;">과제번호</th>
                        <td scope="col" class="view_table_text" colspan="5" style="width: 40%;">
                        <input type="text" name="quest_number" id="quest_number"  class="input_text" placeholder="선발 후 부여 됩니다" value="" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header"colspan="1" style="width: 10%;">과제구분</th>
                        <td scope="col" class="view_table_title" colspan="8" style="width: 90%;">
                            <input type="text" name="quest_division_view" id="quest_division_view"  class="input_text " placeholder="제목" readonly>
                        </td>
                    </tr>
                </thead>
                <tbody id="input_file_cont">
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">연구과제명</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >과제명(국문)</th>
                        <td scope="col" class="view_table_text" colspan="8" >
                        <input type="text" name="ko_title_view" id="ko_title_view"  class="input_text" placeholder="과제명(국문)"readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >과제명(영문)</th>
                        <td scope="col" class="view_table_text" colspan="8" >
                        <input type="text" name="en_title_view" id="en_title_view"  class="input_text" placeholder="과제명(영문)" readonly>
                        </td>
                    </tr>

                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="8">연구주최</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1"style="width:10%;">주최(주관)<br>기관</th>
                        <td scope="col" class="view_table_text "  colspan="7" style="width:40%;">
                            <input type="text" name="host_name_view" id="host_name_view"  class="input_text " placeholder="성명" readonly>
                        </td>
                    </tr>

                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >개최일시</th>
                        <td scope="col" class="view_table_text " colspan="3" >
                            <input type="text" name="host_date_view" id="host_date_view" class=" input_text   " max="9999-12-31"  readonly placeholder="연도-월-일" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" >개최장소</th>
                        <td scope="col" class="view_table_text " colspan="3" style="width:40%;">
                            <input type="text" name="host_venue_view" id="host_venue_view"  class="input_text " placeholder="개최장소"  readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" style="width:10%;">공동개최 Y/N</th>
                        <td scope="col" class="view_table_title " colspan="3" style="width:45%;">
                            <input type="text" name="host_public_check_view" id="host_public_check_view"  class="input_text " readonly>
                        </td>
                        <th scope="col" class="view_table_header" style="width:10%;">공동개최 기관명</th>
                        <td scope="col" class="view_table_text " colspan="3" style="width:40%;">
                            <input type="text" name="host_public_name_view" id="host_public_name_view"  class="input_text " placeholder="공동개최 기관명" readonly >
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%;">후원기관 현황</th>
                        <td scope="col" class="view_table_text " colspan="3" style="width:40%;">
                            <input type="text" name="host_support_count_view" id="host_support_count_view"  class="input_text " placeholder="후원기관 현황" readonly >
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%;">후원기관1</th>
                        <td scope="col" class="view_table_text " colspan="3" style="width:40%;">
                            <input type="text" name="host_support_1_view" id="host_support_1_view"  class="input_text " placeholder="후원기관1"readonly >
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%;">후원기관2</th>
                        <td scope="col" class="view_table_text " colspan="3" style="width:40%;">
                            <input type="text" name="host_support_2_view" id="host_support_2_view"  class="input_text " placeholder="후원기관2" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%;">후원기관3</th>
                        <td scope="col" class="view_table_text " colspan="3" style="width:40%;">
                        <input type="text" name="host_support_3_view" id="host_support_3_view"  class="input_text " placeholder="후원기관3" readonly> 
                        </td>
                    </tr>

                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">참가예정 인원</th>
                    </tr>

                    <tr>
                        <th scope="col" class="view_table_header" colspan="2" style="width:25%">발표자</th>
                        <td scope="col" class="view_table_text " colspan="2" style="width:25%">
                            <input type="text" name="presenter_user_view" id="presenter_user_view"  class="input_text " placeholder="발표자" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="2" style="width:25%">토론자</th>
                        <td scope="col" class="view_table_text " colspan="3" style="width:25%">
                            <input type="text" name="debater_user_view" id="debater_user_view"  class="input_text " placeholder="토론자" readonly>
                        </td>
                    </tr>

                    <tr>
                        <th scope="col" class="view_table_header" colspan="2" >사회자</th>
                        <td scope="col" class="view_table_text " colspan="2" >
                            <input type="text" name="mc_user_view" id="mc_user_view"  class="input_text " placeholder="사회자" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="2" >일반참가자</th>
                        <td scope="col" class="view_table_text " colspan="3" >
                            <input type="text" name="normal_user_view" id="normal_user_view"  class="input_text " placeholder="일반참가자" readonly>
                        </td>
                    </tr>
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">소속기관 현황</th>
                    </tr>
                    
                    <tr>
                        <th scope="col" class="view_table_header" rowspan="3">기관책임자</th>
                        <th scope="col" class="view_table_header" colspan="1" style=" width:10%">성명</th>
                        <td scope="col" class="view_table_text" colspan="2" >
                        <input type="text" name="institute_manager_name_view" id="institute_manager_name_view"  class="input_text" placeholder="성명" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" >전공(학위)</th>
                        <td scope="col" class="view_table_text" colspan="4" >
                        <input type="text" name="institute_manager_degree_view" id="institute_manager_degree_view"  class="input_text" placeholder="전공(학위)" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >소속</th>
                        <td scope="col" class="view_table_text" colspan="2" >
                        <input type="text" name="institute_manager_belong_view" id="institute_manager_belong_view"  class="input_text" placeholder="소속" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" >직급</th>
                        <td scope="col" class="view_table_text" colspan="4" >
                        <input type="text" name="institute_manager_rank_view" id="institute_manager_rank_view"  class="input_text" placeholder="직급" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >이메일</th>
                        <td scope="col" class="view_table_text" colspan="2" >
                        <input type="text" name="institute_manager_email_view" id="institute_manager_email_view"  class="input_text" placeholder="이메일" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" >전화</th>
                        <td scope="col" class="view_table_text" colspan="4" >
                        <input type="text" name="institute_manager_phone_view" id="institute_manager_phone_view"  class="input_text" placeholder="전화" readonly>
                        </td>
                    </tr>

                   
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header view_user_header_view" rowspan="4" colspan="2" >소속기관</th>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%">연번</th>
                        <th scope="col" class="view_table_header" colspan="2" >직위</th>
                        <th scope="col" class="view_table_header" colspan="2" >성명</th>
                        <th scope="col" class="view_table_header" colspan="2" >소속</th>
                    </tr>

                    <tr class="user_table_list_view">
                        <th scope="col" class="view_table_header" colspan="1" >1</th>
                        <td scope="col" class="view_table_text" colspan="2" >
                            <input type="text" name="1_user_rank_view" id="1_user_rank_view"  class="input_text" placeholder="직위" readonly>
                        </td>
                        <td scope="col" class="view_table_text" colspan="2" >
                            <input type="text" name="one_user_name_view" id="1_user_name_view"  class="input_text" placeholder="성명" readonly>
                        </td>
                        <td scope="col" class="view_table_text" colspan="2" >
                            <input type="text" name="one_user_belong_view" id="1_user_belong_view" class="input_text" placeholder="소속" readonly>
                        </td>
                    </tr>
                    <tr class="user_table_list_view">
                        <th scope="col" class="view_table_header" colspan="1" >2</th>
                        <td scope="col" class="view_table_text" colspan="2" >
                            <input type="text" name="2_user_rank_view" id="2_user_rank_view"  class="input_text" placeholder="직위" readonly>
                        </td>
                        <td scope="col" class="view_table_text" colspan="2" >
                            <input type="text" name="2_user_name_view" id="2_user_name_view"  class="input_text" placeholder="성명" readonly>
                        </td>
                        <td scope="col" class="view_table_text" colspan="2" >
                            <input type="text" name="2_user_belong_view" id="2_user_belong_view"  class="input_text" placeholder="소속" readonly>
                        </td>
                    </tr>
                    <tr class="user_table_list_view">
                        <th scope="col" class="view_table_header" colspan="1" >3</th>
                        <td scope="col" class="view_table_text" colspan="2" >
                            <input type="text" name="3_user_rank_view" id="3_user_rank_view"  class="input_text" placeholder="직위" readonly>
                        </td>
                        <td scope="col" class="view_table_text" colspan="2" >
                            <input type="text" name="3_user_name_view" id="3_user_name_view"  class="input_text" placeholder="성명" readonly>
                        </td>
                        <td scope="col" class="view_table_text" colspan="2" >
                            <input type="text" name="3_user_belong_view" id="3_user_belong_view"  class="input_text" placeholder="소속" readonly>
                        </td>
                    </tr>
                  
                   
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">연구정보</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1">연구비신청액</th>
                        <td scope="col" class="view_table_text " colspan="8" >
                            <input type="text" name="money_view" id="money_view"  class="input_text  money" placeholder="숫자만 기재 (원)" >
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
            $('.btn_step1').click(function(){
                $('.step').removeClass('step_view');
                $('.step1').addClass('step_view');
            });
            $('.btn_step2').click(function(){

                
                // // validation
                if($('#ko_title').val() == "") return alert("국문 과제명이 비어있습니다");
                if($('#en_title').val() == "") return alert("영문 과제명이 비어있습니다");

                if($('#host_name').val() == "") return alert("연구주최 주최(주관)기관이 비어있습니다");
                if($('#host_date_start').val() == "") return alert("연구주최 개최일시 시작이 비어있습니다");
                if($('#host_date_end').val() == "") return alert("연구주최 개최일시 끝이 비어있습니다");
                if($('#host_venue').val() == "") return alert("연구주최 장소가 비어있습니다");
                if($('input[name="host_public_check"]:checked').val() == '공동'){
                    if($('#host_public_name').val() == "") return alert("연구주최 공동개최 기관명이 비어있습니다");
                }
                var host_date_start = $('#host_date_start').val();
                var host_date_end = $('#host_date_end').val();

                if(host_date_start > host_date_end) return  alert("개최일시 끝나는 날짜가 시작하는 날짜보다 빠릅니다");

                $('#host_date_view').val($('#host_date_start').val()+" ~ "+$('#host_date_end').val());

                // logic
                $('.step').removeClass('step_view');
                $('.step2').addClass('step_view');

                                                    
            });
            $('.btn_step3').click(function(){
                if($('#presenter_user').val() == "") return alert("발표자가 비어있습니다");
                if($('#debater_user').val() == "") return alert("토론자가 비어있습니다");
                if($('#mc_user').val() == "") return alert("사회자가 비어있습니다");
                if($('#normal_user').val() == "") return alert("일반참가자가 비어있습니다");

                if($('#institute_manager_name').val() == "") return alert("소속기관 책임자 성명이 비어있습니다");
                if($('#institute_manager_degree').val() == "") return alert("소속기관 책임자 전공이 비어있습니다");
                if($('#institute_manager_belong').val() == "") return alert("소속기관 책임자 소속이 비어있습니다");
                if($('#institute_manager_rank').val() == "") return alert("소속기관 책임자 직급이 비어있습니다");
                if($('#institute_manager_email').val() == "") return alert("소속기관 책임자 이메일이 비어있습니다");
                if($('#institute_manager_phone').val() == "") return alert("소속기관 책임자 전화번호가 비어있습니다");


                if($('#money').val() == "") return alert("연구비 신청액이 비어있습니다");

                //정규식 설정
                var fncTest = /^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]+(\.[a-zA-Z]{2,3}){1,4}$/i;
                //정규식 결과 저장
                var institute_manager_email = fncTest.test( $("#institute_manager_email").val() );
                if(!institute_manager_email) return alert("E-mail 주소가 형식에 맞지 않습니다.");

                //정규식 설정
                var regex= /^[0-9]+$/;
                //정규식 결과 저장
                var institute_manager_phone = regex.test( $("#institute_manager_phone").val() );
                if(!institute_manager_phone) return alert("소속기관 책임자 전화번호에 숫자만 입력해주세요");

                var moneyResult = regex.test( $("#money").val());
                if(!moneyResult) return alert("연구비신청액에 숫자만 입력해주세요");

                var presenter_user = regex.test( $("#presenter_user").val());
                if(!presenter_user) return alert("발표자에 숫자만 입력해주세요");

                var debater_user = regex.test( $("#debater_user").val());
                if(!debater_user) return alert("토론자에 숫자만 입력해주세요");

                var mc_user = regex.test( $("#mc_user").val());
                if(!mc_user) return alert("사회자에 숫자만 입력해주세요");

                var normal_user = regex.test( $("#normal_user").val());
                if(!normal_user) return alert("일반참가자에 숫자만 입력해주세요");

                if($(".file-upload").val() =="") return alert("파일을 업로드 해주세요");    
                
                $('#4_user_rank_view').val($('#4_user_rank').val());
                $('#4_user_name_view').val($('#4_user_name').val());
                $('#4_user_belong_view').val($('#4_user_belong').val());

                $('#5_user_rank_view').val($('#5_user_rank').val());
                $('#5_user_name_view').val($('#5_user_name').val());
                $('#5_user_belong_view').val($('#5_user_belong').val());

                $('#6_user_rank_view').val($('#6_user_rank').val());
                $('#6_user_name_view').val($('#6_user_name').val());
                $('#6_user_belong_view').val($('#6_user_belong').val());

                $('#7_user_rank_view').val($('#7_user_rank').val());
                $('#7_user_name_view').val($('#7_user_name').val());
                $('#7_user_belong_view').val($('#7_user_belong').val());

                $('#8_user_rank_view').val($('#8_user_rank').val());
                $('#8_user_name_view').val($('#8_user_name').val());
                $('#8_user_belong_view').val($('#8_user_belong').val());

                $('#9_user_rank_view').val($('#9_user_rank').val());
                $('#9_user_name_view').val($('#9_user_name').val());
                $('#9_user_belong_view').val($('#9_user_belong').val());

                $('#10_user_rank_view').val($('#10_user_rank').val());
                $('#10_user_name_view').val($('#10_user_name').val());
                $('#10_user_belong_view').val($('#10_user_belong').val());



                // logic
                $('.step').removeClass('step_view');
                $('.step3').addClass('step_view');
            });

            var money_sum = 0;
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


            $('#host_name').change(function(){
                $('#host_name_view').val($(this).val());
            });
  
            $('#host_venue').change(function(){
                $('#host_venue_view').val($(this).val());
            });
            
            $('#host_public_name').change(function(){
                $('#host_public_name_view').val($(this).val());
            });
  
            $('#host_venue').change(function(){
                $('#host_venue_view').val($(this).val());
            });
            
            $('#host_support_1').change(function(){
                $('#host_support_1').val($(this).val());
            });
            $('#host_support_2').change(function(){
                $('#host_support_2').val($(this).val());
            });
            $('#host_support_3').change(function(){
                $('#host_support_3').val($(this).val());
            });
  

            

            $('#quest_division_view').val($('.quest_division:checked').val());

            $('.quest_division').click(function(){
                $('#quest_division_view').val($(this).val());
            });

            
            $('#host_public_check_view').val($('.host_public_check:checked').val());
            $('.host_public_check').click(function(){
                $('#host_public_check_view').val($('.host_public_check:checked').val());
            })
            $('#host_public_name').change(function(){
                $('#host_public_name').val($(this).val());
            });

            $('.host_support').change(function(){

                var host_count = $('.host_support').length;
                var host_list_count = 0;
                
                for(var i = 1; i <= host_count; i++){

                    if($('#host_support_'+i).val() != ''){
                        host_list_count = host_list_count +1;
                        // $("#host_support_"+i+"_view").val($('#host_support_'+i).val());
                        // alert("#host_support_"+i+"_view");
                    }

                }

                $('#host_support_count_view').val(host_list_count+'곳');
                $('#host_support_count').val(host_list_count+'곳');
                // host_support_2_view
                // host_support_2_view
                var value_host = "#"+$(this).attr('id')+"_view";
                var view_host = $(this).val();
                $(value_host).val(view_host);
            });

            $('#presenter_user').change(function(){
                $('#presenter_user_view').val($(this).val()+'명');
            });
            $('#debater_user').change(function(){
                $('#debater_user_view').val($(this).val()+'명');
            });
            $('#mc_user').change(function(){
                $('#mc_user_view').val($(this).val()+'명');
            });
            $('#normal_user').change(function(){
                $('#normal_user_view').val($(this).val()+'명');
            });
            $('#institute_manager_name').change(function(){
                $('#institute_manager_name_view').val($(this).val());
            });
            $('#institute_manager_degree').change(function(){
                $('#institute_manager_degree_view').val($(this).val());
            });
            $('#institute_manager_belong').change(function(){
                $('#institute_manager_belong_view').val($(this).val());
            });
            $('#institute_manager_rank').change(function(){
                $('#institute_manager_rank_view').val($(this).val());
            });
            $('#institute_manager_email').change(function(){
                $('#institute_manager_email_view').val($(this).val());
            });
            $('#institute_manager_phone').change(function(){
                $('#institute_manager_phone_view').val($(this).val());
            });
            $('#1_user_rank').change(function(){
                $('#1_user_rank_view').val($(this).val());
            });
            $('#1_user_name').change(function(){
                $('#1_user_name_view').val($(this).val());
            });
            $('#1_user_belong').change(function(){
                $('#1_user_belong_view').val($(this).val());
            });
            $('#2_user_rank').change(function(){
                $('#2_user_rank_view').val($(this).val());
            });
            $('#2_user_name').change(function(){
                $('#2_user_name_view').val($(this).val());
            });
            $('#2_user_belong').change(function(){
                $('#2_user_belong_view').val($(this).val());
            });

            $('#3_user_rank').change(function(){
                $('#3_user_rank_view').val($(this).val());
            });
            $('#3_user_name').change(function(){
                $('#3_user_name_view').val($(this).val());
            });
            $('#3_user_belong').change(function(){
                $('#3_user_belong_view').val($(this).val());
            });

            $(document).on("change","#4_user_rank", function(){
                $('#4_user_rank_view').val($(this).val());
            });
            $(document).on("change", "#4_user_name", function(){
                $('#4_user_name_view').val($(this).val());
            });
            $(document).on("change", "#4_user_belong", function(){
                $('#4_user_belong_view').val($(this).val());
            });

            $(document).on("change", "#5_user_rank", function(){
                $('#5_user_rank_view').val($(this).val());
            });
            $(document).on("change", "#5_user_name", function(){
                $('#5_user_name_view').val($(this).val());
            });
            $(document).on("change", "#5_user_belong", function(){
                $('#5_user_belong_view').val($(this).val());
            });


            $(document).on("change", "#6_user_rank", function(){
                $('#6_user_rank_view').val($(this).val());
            });
            $(document).on("change", "#6_user_name", function(){
                $('#6_user_name_view').val($(this).val());
            });
            $(document).on("change", "#6_user_belong", function(){
                $('#6_user_belong_view').val($(this).val());
            });

            $(document).on("change", "#7_user_rank", function(){
                $('#7_user_rank_view').val($(this).val());
            });
            $(document).on("change", "#7_user_name", function(){
                $('#7_user_name_view').val($(this).val());
            });
            $(document).on("change", "#7_user_belong", function(){
                $('#7_user_belong_view').val($(this).val());
            });


            $(document).on("change", "#8_user_rank", function(){
                $('#8_user_rank_view').val($(this).val());
            });
            $(document).on("change", "#8_user_name", function(){
                $('#8_user_name_view').val($(this).val());
            });
            $(document).on("change", "#8_user_belong", function(){
                $('#8_user_belong_view').val($(this).val());
            });


            $(document).on("change", "#9_user_rank", function(){
                $('#9_user_rank_view').val($(this).val());
            });
            $(document).on("change", "#9_user_name", function(){
                $('#9_user_name_view').val($(this).val());
            });
            $(document).on("change", '#9_user_belong', function(){
                $('#9_user_belong_view').val($(this).val());
            });

            $(document).on("change", "#10_user_rank", function(){
                $('#10_user_rank_view').val($(this).val());
            });
            $(document).on("change", "#10_user_name", function(){
                $('#10_user_name_view').val($(this).val());
            });
            $(document).on("change", "#10_user_belong", function(){
                $('#10_user_belong_view').val($(this).val());
            });
            
            $('.money').change(function(){
                $('#money_view').val($(this).val().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+"원");
            });

            $(".input_date").datepicker();


            var user_table_list_length = 3;
            var user_table_list_header_length = 4;

            $('.user_table_ins').click(function(){
                if(user_table_list_length < 10){
                    user_table_list_length++;
                    user_table_list_header_length ++;

                    var btn_lsit =  '<tr class="user_table_list">'
                                        +'<th scope="col" class="view_table_header" colspan="1" >'+user_table_list_length+'</th>'
                                        +'<td scope="col" class="view_table_text view_table_padding" colspan="2" >'
                                            +'<input type="text" name="'+user_table_list_length+'_user_rank" id="'+user_table_list_length+'_user_rank"  class="input_text input_border_true" placeholder="직위" >'
                                        +'</td>'
                                        +'<td scope="col" class="view_table_text view_table_padding" colspan="2" >'
                                            +'<input type="text" name="'+user_table_list_length+'_user_name" id="'+user_table_list_length+'_user_name"  class="input_text input_border_true" placeholder="성명" >'
                                        +'</td>'
                                        +'<td scope="col" class="view_table_text view_table_padding" colspan="2" >'
                                            +'<input type="text" name="'+user_table_list_length+'_user_belong" id="'+user_table_list_length+'_user_belong"  class="input_text input_border_true" placeholder="소속" >'
                                        +'</td>'
                                    +'</tr>';

                    var btn_lsit_view = '<tr class="user_table_list_view">'
                                            +'<th scope="col" class="view_table_header" colspan="1" >'+user_table_list_length+'</th>'
                                            +'<td scope="col" class="view_table_text" colspan="2" >'
                                                +'<input type="text" name="'+user_table_list_length+'_user_rank_view" id="'+user_table_list_length+'_user_rank_view"  class="input_text" placeholder="직위" readonly>'
                                            +'</td>'
                                            +'<td scope="col" class="view_table_text" colspan="2" >'
                                                +'<input type="text" name="'+user_table_list_length+'_user_name_view" id="'+user_table_list_length+'_user_name_view"  class="input_text" placeholder="성명" readonly>'
                                            +'</td>'
                                            +' <td scope="col" class="view_table_text" colspan="2" >'
                                                +' <input type="text" name="'+user_table_list_length+'_user_belong_view" id="'+user_table_list_length+'_user_belong_view"  class="input_text" placeholder="소속" readonly>'
                                            +'</td>'
                                        +'</tr>';


                    $('.view_user_header').attr('rowspan', user_table_list_header_length);         
                    $('.view_user_header_view').attr('rowspan', user_table_list_header_length); 

                    
                    $('.user_table_list').last().after(btn_lsit);        
                    $('.user_table_list_view').last().after(btn_lsit_view);        

                }

               
            })

            $('.user_table_del').click(function(){
                if(user_table_list_length > 3){
                    user_table_list_length--;
                    user_table_list_header_length --;

                    $('.view_user_header').attr('rowspan', user_table_list_header_length);         
                    $('.view_user_header_view').attr('rowspan', user_table_list_header_length); 

                    
                    $('.user_table_list').last().remove();        
                    $('.user_table_list_view').last().remove();     


                }
            })

            
        var file_number = 1;
        var html = '<tr class="input-file_list">'
                    +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일명</th>'
                    +'<td scope="col" class="view_table_text" colspan="3" style="width:40%">'
                    +'    <input type="text" style="margin: 0 -2px;" id="file_label_view1" readonly="readonly" class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="파일명"/> '
                    +'</td>'
                    +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 사이즈</th>'
                    +'<td scope="col" class="view_table_text" colspan="2" style="width:20%">'
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

        var file_upload_check = true;
            //클릭이벤트 bind
            $("#file-label-btn").bind("click",function(){ 
                    if(file_upload_check){
                    file_upload_check = false;
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
                            $(this).after('<input type="hidden" name="file_type[]" value ="0" />');
                            $(this).attr('name' , 'bf_file[]');

                            var html = '<tr class="input_form_info upload0'+file_number+'">'
                            +'    <th scope="col" class="view_table_header " colspan="1" style="width:10%; height: 58px;">첨부파일</th>'
                            +'    <td scope="col" class="view_table_text " colspan="1" style="width:10%">'
                            +'       <img src="<?php echo G5_IMG_URL ?>/download_icon.png" alt="<?php echo $config['cf_title']; ?>">'
                            +'    </th>'
                            +'    <td scope="col" class="view_table_text_name " colspan="7">'+  fileName+'</th>'
                            +'</tr>';

                            $('#view_table_upload').append(html);

                            file_number++;

                            // var html = '<div class="input-file"><input type="text" id="file_label_view'+file_number+'" readonly="readonly" class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="파일명"/><input type="text" id="file-size-'+file_number+'" class="file-name file-size" value="용량" readonly="readonly"/><input type="file" name="bf_file[]" id="upload0'+file_number+'" class="file-upload" <?= $row44['report'] ==2? "disabled": ""; ?>/><button type="button" class="file-label file-del " id="file-del'+file_number+'" <?= $row44['report'] ==2? "disabled": ""; ?>style="background:<?= $row44['report'] ==2? '#ccc !important': 'crimson'; ?>">삭제</button></div>';
                            var html ='<tr class="input-file_list input-file_list_all">'
                            +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일명</th>'
                            +'<td scope="col" class="view_table_text" colspan="1" style="width:40%">'
                            +'    <input type="text" id="file_label_view'+file_number+'" readonly="readonly" class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="파일명"/>'
                            +'</td>'
                            +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 사이즈</th>'
                            +'<td scope="col" class="view_table_text" colspan="1" style="width:20%">'
                            +'    <input type="text" id="file-size-'+file_number+'" class="file-name file-size" value="용량" readonly="readonly"/>'
                            +'    <input type="file" name="bf_file_null[]" id="upload0'+file_number+'" class="file-upload" <?= $row44['report'] ==2? "disabled": ""; ?>/>'
                            +'</td>'
                            +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 삭제</th>'
                            +'<td scope="col" class="view_table_text" colspan="1" style="width:10%">'
                            +'<button type="button" class="file-label file-del " id="file-del'+file_number+'" <?= $row44['report'] ==2? "disabled": ""; ?>>삭제</button>'
                            +'</td>'
                            +'</tr>';

                            $('.file_table_all').append(html);

                            $("#file-label-btn").attr('for', 'upload0'+file_number);
                            file_upload_check = true;
                        }
                    })
                }
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
        })
    </script>
<?php } else if ($_GET['bo_idx'] == 6) { ?>
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
                            <input type="text" name="quest_number" id="quest_number"  class="input_text" placeholder="선발 후 부여 됩니다" value="" readonly>
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
                            <input type="text" name="en_title" id="en_title"  class="input_text input_border_true" placeholder="과제명(영문)" >
                        </td>
                    </tr>
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="8">지원자</th>
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
                        <input type="text" name="phone" id="phone"  class="input_text input_border_true" placeholder="숫자만 기재" > 
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
                        <th scope="col" class="view_table_header"colspan="1" >제목</th>
                        <td scope="col" class="view_table_title" colspan="5" >
                            <input type="text" name="title_view" id="title_view"  class="input_text " placeholder="제목" value="<?= $row['wr_subject']; ?>"  readonly>
                        </td>
                    </tr>
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">자료 첨부</th>
                    </tr>
                 
                </tbody>
            </table>
        

            <div class ="btn_confirm write_div btn-cont">
                <div class="next_prev_bar">
                <label for="upload01" id="file-label-btn" class="file-label file-label-btn"><img src="<?= G5_IMG_URL ?>/upload.png" alt=""> 파일 업로드</label>

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
                        <td scope="col" class="view_table_title" colspan="8" style="width: 90%;">
                            <input type="text" name="title_view" id="title_view"  class="input_text " placeholder="제목" value="<?= $row['wr_subject']; ?>"  readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" style="width: 10%;">접수번호</th>
                        <td scope="col" class="view_table_text" colspan="4" style="width: 40%;">
                        <input type="text" name="info_number_view" id="info_number_view"  class="input_text" placeholder="접수 완료시 자동부여됩니다."  readonly>
                        </td>
                        <th scope="col" class="view_table_header" style="width: 10%;">과제번호</th>
                        <td scope="col" class="view_table_text" colspan="4" style="width: 40%;">
                        <input type="text" name="quest_number_view" id="quest_number_view"  class="input_text" placeholder="선발 후 부여 됩니다" value="" readonly>
                        </td>
                    </tr>
                </thead>
                <tbody id="input_file_cont">
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">연구과제명</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >과제명(국문)</th>
                        <td scope="col" class="view_table_text" colspan="8" >
                        <input type="text" name="ko_title_view" id="ko_title_view"  class="input_text" placeholder="과제명(국문)"readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >과제명(영문)</th>
                        <td scope="col" class="view_table_text" colspan="8" >
                        <input type="text" name="en_title_view" id="en_title_view"  class="input_text" placeholder="과제명(영문)" readonly>
                        </td>
                    </tr>
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">지원자</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >성명</th>
                        <td scope="col" class="view_table_text" colspan="4" >
                        <input type="text" name="name_view" id="name_view"  class="input_text" placeholder="성명" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" >전공(학위)</th>
                        <td scope="col" class="view_table_text" colspan="3" >
                        <input type="text" name="degree_view" id="degree_view"  class="input_text" placeholder="전공(학위)" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >소속</th>
                        <td scope="col" class="view_table_text" colspan="4" >
                        <input type="text" name="belong_view" id="belong_view"  class="input_text" placeholder="소속" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" >직급</th>
                        <td scope="col" class="view_table_text" colspan="3" >
                        <input type="text" name="rank_view" id="rank_view"  class="input_text" placeholder="직급" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >이메일</th>
                        <td scope="col" class="view_table_text" colspan="4" >
                        <input type="text" name="email_view" id="email_view"  class="input_text" placeholder="이메일" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" >전화</th>
                        <td scope="col" class="view_table_text" colspan="3" >
                        <input type="text" name="phone_view" id="phone_view"  class="input_text" placeholder="전화" readonly>
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
                

                //정규식 설정
                var regex= /^[0-9]+$/;
                //정규식 결과 저장

                if($(".file-upload").val() =="") return alert("파일을 업로드 해주세요");    

                
                // logic
                $('.step').removeClass('step_view');
                $('.step3').addClass('step_view');
            });
            var money_sum = 0;
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
                $('#main_member_view').val($(this).val().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+"명");
            });
            $('#sub_member').change(function(){
                $('#sub_member_view').val($(this).val().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+"명");
            });
            // $('.date_start').on("propertychange change keyup paste input textchange", function(){
            //     alert("d");
            //     $('#date_start_view').val($('.date_start').val()+" ~ "+$('.date_end').val());
            // });
            // $('.date_end').on("propertychange change keyup paste input textchange", function(){
            //     alert("D");
            //     $('#date_start_view').val($('.date_start').val()+" ~ "+$('.date_end').val());
            // });
            $('#one_year').change(function(){
                money_sum = Number($(this).val()) + Number($('#two_year').val());
                $('#money').val(money_sum);
                $('#money_view').val($('#money').val().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+"원");
                $('#one_year_view').val($(this).val().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+"원");
            });
            $('#two_year').change(function(){
                money_sum = Number($(this).val()) + Number($('#one_year').val());
                $('#money').val(money_sum);
                $('#money_view').val($('#money').val().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+"원");
                $('#two_year_view').val($(this).val().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+"원");
            });
            $('.money').change(function(){
                $('#money_view').val($(this).val().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+"원");
                // alert(
                //     $('#money_view').val($(this).val().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+"원")
                // );
            });

            $(".input_date").datepicker();

            
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
                        +'<td scope="col" class="view_table_text" colspan="" style="width:10%">'
                        +'<button type="button" class="file-label file-del " id="file-del<?= $i ?>" <?= $row44['report'] ==2? "disabled": ""; ?>>삭제</button>'
                        +'</td>'
                        +'</tr>';
            

            $('.bo_class').append(html);
            

            //클릭이벤트 unbind 
            $("#file-label-btn").unbind("click"); 
            
            var file_upload_check = true;
            //클릭이벤트 bind
            $("#file-label-btn").bind("click",function(){ 
                    if(file_upload_check){
                    file_upload_check = false;
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
                            $(this).after('<input type="hidden" name="file_type[]" value ="0" />');
                            $(this).attr('name' , 'bf_file[]');

                            var html = '<tr class="input_form_info upload0'+file_number+'">'
                            +'    <th scope="col" class="view_table_header " colspan="1" style="width:10%; height: 58px;">첨부파일</th>'
                            +'    <td scope="col" class="view_table_text " colspan="1" style="width:10%">'
                            +'       <img src="<?php echo G5_IMG_URL ?>/download_icon.png" alt="<?php echo $config['cf_title']; ?>">'
                            +'    </th>'
                            +'    <td scope="col" class="view_table_text_name " colspan="7">'+  fileName+'</th>'
                            +'</tr>';

                            $('#view_table_upload').append(html);

                            file_number++;

                            // var html = '<div class="input-file"><input type="text" id="file_label_view'+file_number+'" readonly="readonly" class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="파일명"/><input type="text" id="file-size-'+file_number+'" class="file-name file-size" value="용량" readonly="readonly"/><input type="file" name="bf_file[]" id="upload0'+file_number+'" class="file-upload" <?= $row44['report'] ==2? "disabled": ""; ?>/><button type="button" class="file-label file-del " id="file-del'+file_number+'" <?= $row44['report'] ==2? "disabled": ""; ?>style="background:<?= $row44['report'] ==2? '#ccc !important': 'crimson'; ?>">삭제</button></div>';
                            var html ='<tr class="input-file_list input-file_list_all">'
                            +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일명</th>'
                            +'<td scope="col" class="view_table_text" colspan="1" style="width:40%">'
                            +'    <input type="text" id="file_label_view'+file_number+'" readonly="readonly" class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="파일명"/>'
                            +'</td>'
                            +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 사이즈</th>'
                            +'<td scope="col" class="view_table_text" colspan="1" style="width:20%">'
                            +'    <input type="text" id="file-size-'+file_number+'" class="file-name file-size" value="용량" readonly="readonly"/>'
                            +'    <input type="file" name="bf_file_null[]" id="upload0'+file_number+'" class="file-upload" <?= $row44['report'] ==2? "disabled": ""; ?>/>'
                            +'</td>'
                            +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 삭제</th>'
                            +'<td scope="col" class="view_table_text" colspan="1" style="width:10%">'
                            +'<button type="button" class="file-label file-del " id="file-del'+file_number+'" <?= $row44['report'] ==2? "disabled": ""; ?>>삭제</button>'
                            +'</td>'
                            +'</tr>';

                            $('.file_table_all').append(html);

                            $("#file-label-btn").attr('for', 'upload0'+file_number);
                            file_upload_check = true;
                        }
                    })
                }
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
        })
    </script>
<?php }  ?>

<script>
    //두개짜리 제어 연결된거 만들어주는 함수
    datePickerSet($("#datepicker1"), $("#datepicker2"), true); //다중은 시작하는 달력 먼저, 끝달력 2번째

    /*
    * 달력 생성기
    * @param sDate 파라미터만 넣으면 1개짜리 달력 생성
    * @example   datePickerSet($("#datepicker"));
    * 
    * 
    * @param sDate, 
    * @param eDate 2개 넣으면 연결달력 생성되어 서로의 날짜를 넘어가지 않음
    * @example   datePickerSet($("#datepicker1"), $("#datepicker2"));
    */
    function datePickerSet(sDate, eDate, flag) {
        //시작 ~ 종료 2개 짜리 달력 datepicker	
        if (!isValidStr(sDate) && !isValidStr(eDate) && sDate.length > 0 && eDate.length > 0) {
            var sDay = sDate.val();
            var eDay = eDate.val();

            if (flag && !isValidStr(sDay) && !isValidStr(eDay)) { //처음 입력 날짜 설정, update...			
                var sdp = sDate.datepicker().data("datepicker");
                sdp.selectDate(new Date(sDay.replace(/-/g, "/")));  //익스에서는 그냥 new Date하면 -을 인식못함 replace필요

                var edp = eDate.datepicker().data("datepicker");
                edp.selectDate(new Date(eDay.replace(/-/g, "/")));  //익스에서는 그냥 new Date하면 -을 인식못함 replace필요
            }

            //시작일자 세팅하기 날짜가 없는경우엔 제한을 걸지 않음
            if (!isValidStr(eDay)) {
                sDate.datepicker({
                    maxDate: new Date(eDay.replace(/-/g, "/"))
                });
            }
            sDate.datepicker({
                language: 'ko',
                autoClose: true,
                dateFormat: 'yyyy-mm-dd',
                onSelect: function () {
                    datePickerSet(sDate, eDate);
                }
            });

            //종료일자 세팅하기 날짜가 없는경우엔 제한을 걸지 않음
            if (!isValidStr(sDay)) {
                eDate.datepicker({
                    minDate: new Date(sDay.replace(/-/g, "/"))
                });
            }
            eDate.datepicker({
                language: 'ko',
                autoClose: true,
                dateFormat: 'yyyy-mm-dd',
                onSelect: function () {
                    datePickerSet(sDate, eDate);
                }
            });
            //한개짜리 달력 datepicker
        } else if (!isValidStr(sDate)) {
            var sDay = sDate.val();
            if (flag && !isValidStr(sDay)) { //처음 입력 날짜 설정, update...			
                var sdp = sDate.datepicker().data("datepicker");
                sdp.selectDate(new Date(sDay.replace(/-/g, "/"))); //익스에서는 그냥 new Date하면 -을 인식못함 replace필요
            }

            sDate.datepicker({
                language: 'ko',
                autoClose: true
            });
        }


        function isValidStr(str) {
            if (str == null || str == undefined || str == "")
                return true;
            else
                return false;
        }
    }

        
$(function(){
    $(document).on("keydown", "input[type=file]", function(event) { 
        return event.key != "Enter";
    });

    $(document).keypress(function(e) { 
        if (e.keyCode == 13) e.preventDefault(); 
    });
});

</script>


<!-- } 게시물 작성/수정 끝 -->

