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

$sql = " select * from g5_write_business where wr_id = '{$_GET['wr_idx']}'";
$result = sql_query($sql);
$row88 = sql_fetch_array($result);

$sql = " select * from g5_write_business_title where idx = '{$row88['wr_title_idx']}'";
$result = sql_query($sql);
$row99 = sql_fetch_array($result);


?>
<!-- 게시판 목록 시작 { -->
<aside id="bo_side">
    <h2 class="aside_nav_title">심사 관리</h2>
   
    <a class="aside_nav <?= $_GET['bo_idx'] == 1?"aisde_click":""; ?>" href="<?= G5_BBS_URL ?>/board.rater.php?bo_table=<?= $bo_table ?>&bo_idx=1">지원자 선발</a>
    <a class="aside_nav <?= $_GET['bo_idx'] == 2?"aisde_click":""; ?>" href="<?= G5_BBS_URL ?>/board.rater.php?bo_table=<?= $bo_table ?>&bo_idx=2">중간보고서</a>
    <a class="aside_nav <?= $_GET['bo_idx'] == 3?"aisde_click":""; ?>" href="<?= G5_BBS_URL ?>/board.rater.php?bo_table=<?= $bo_table ?>&bo_idx=3">결과(연차)보고서</a>
</aside>
<div id="bo_list" >
    <!-- 게시판 페이지 정보 및 버튼 시작 { -->
    <div id="bo_btn_top">
        <h1 id="">[<?= $row99['title']?>]<?= $row88['wr_subject'] ?></h1>

    </div>
    <!-- } 게시판 페이지 정보 및 버튼 끝 -->
        	
    <div class="tbl_head01 tbl_wrap">
        <table>
        <caption><?php echo $board['bo_subject'] ?> 목록</caption>
        <thead>
        <tr>
            <th scope="col" style="width:10%">번호</th>
            <th scope="col" style="width:10%">접수번호</th>
            <th scope="col" style="width:50%">과제명</th>
            <th scope="col" style="width:15%">평가</th>
            <th scope="col" style="width:15%">심사결과 제출</th>
        </tr>
        </thead>
        <tbody>
        <?php
        

        $sql = " select count(*) as cnt from rater where user_id = '{$member['mb_id']}' and business_idx = '{$_GET['wr_idx']}' and test_id = '{$_GET['bo_idx']}'";
        $result = sql_query($sql);
        $row66 = sql_fetch_array($result);
        if($row66['cnt'] == 0){
            alert("권한이 없습니다");
        }
        $list_count = 0;

        if ($_GET['bo_idx'] == 1) {
            $sql = " select * from g5_business_propos where bo_idx = '{$_GET['wr_idx']}' order by info_number desc";
            $result = sql_query($sql);
        } else if ($_GET['bo_idx'] == 2) {
            $sql = " select * from g5_business_propos where bo_idx = '{$_GET['wr_idx']}' and value = 4 order by info_number desc";
            $result = sql_query($sql);
        } else if ($_GET['bo_idx'] == 3) {
            $sql = " select * from g5_business_propos where bo_idx = '{$_GET['wr_idx']}' and report_val_1 = 4 order by info_number desc";
            $result = sql_query($sql);
        }

        
        for($i =0; $row = sql_fetch_array($result); $i ++){   
            $list_count ++;

            $sql23 = "select * from rater where business_idx = '{$_GET['wr_idx']}' and  propos_idx = '{$row['idx']}' and user_id ='{$member['mb_id']}' and test_id = '{$_GET['bo_idx']}'";
            $result23 = sql_query($sql23);
            $row23 = sql_fetch_array($result23);


            $sql3 = " select * from rater_value where rater_idx = '{$row23['idx']}'";
            $result22 = sql_query($sql3);
            $row22 = sql_fetch_array($result22);
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
                <?= $row['info_number'] ?>
            </td>
            <td class="td_download td_title"  >
                <a href="<?= G5_BBS_URL ?>/board.rater.php?bo_table=qa&bo_idx=<?= $_GET['bo_idx'] ?>&wr_idx=<?= $_GET['wr_idx'] ?>&us_idx=<?= $row['idx']; ?>"><?= $row['ko_title']; ?></a>
            </td>
            <td class="td_datetime td_center"><button type="button" class="value_btn_a btn_bo_val_val" style="background:#1F4392"> <?= $row22['value']==2? "확인" :"평가"; ?></button></td>
            <td class="td_datetime td_center" value="<?= $i ?>">
                <form name="fboardlist" id="fboardlist" action="<?= https_url(G5_BBS_DIR)."/application_rater_update.php"; ?>" method="post">
                    <input type="hidden" name="business_idx" class= "business_idx_form" value="<?php echo $_GET['wr_idx']; ?>">
                    <input type="hidden" name="rater_idx" class= "sql_rater_idx" value="<?php echo $row23['idx']; ?>">
                    <input type="hidden" name="test_id" class="test_id"  value="<?= $_GET['bo_idx']?>">
                    <input type="hidden" name="value_id"  value="2">
                    <input type="hidden" class="sql_us_idx " name="us_idx" value="<?php echo $row['idx']; ?>">
                    <input type="hidden" class="sql_fild_value " name="sql_fild_value" value="<?= $row22['value'] ?>">
                    <button type="submit" class="value_btn btn_bo_val_submit value_btn_a" <?= $row22['value']==2? "disabled" :""; ?> style="background:<?= $row22['value']==2? "#ccc" :"#1F4392"; ?>" ><?= $row22['value']==2? "제출완료" :"미제출"; ?></button> 
                </form>
            </td>
        </tr>

        <?php } ?>
        <?php if ($list_count == 0) { echo '<tr><td colspan="6" class="empty_table">사업공고 내용이 없습니다.</td></tr>'; } ?>
        </tbody>
        </table>
    </div>
    
	<!-- 페이지 -->

    <!-- 현재 URL 주소 -->
    <div class="btn_confirm write_div btn-cont list_btn_right">
        <a href="<?= G5_BBS_URL ?>/board.rater.php?bo_table=qa&bo_idx=1" class="value_btn value_list_btn" style="text-align:center">목록</a>
    </div>
            <!-- 게시판 검색 시작 { -->

</div>
<div class="bo_sch_wrap">
    <fieldset class="bo_sch" style="width:1030px; max-height:noen;height:780px;">
    
        <?php
            $result = sql_query($sql);
            $row = sql_fetch_array($result);

            $sql2 = "select * from rater where business_idx = '{$_GET['wr_idx']}' and user_id ='{$member['mb_id']}' and test_id = '{$_GET['bo_idx']}'";
            $result2 = sql_query($sql2);
            $row2 = sql_fetch_array($result2);

            $sql3 = " select * from rater_value where rater_idx = '{$row2['idx']}'";
            $result3 = sql_query($sql3);
            $row3 = sql_fetch_array($result3);
        ?>
        <div id="bo_btn_top_app" class="bo_btn_view_title">
            <h1 class="view_title">[<?= $row99['title']?>]<?= $row88['wr_subject'] ?></h1>
        </div>
        <form name="fsearch" method="POST" action="<?= https_url(G5_BBS_DIR)."/application_rater_update.php" ?>" enctype="multipart/form-data">
        <input type="hidden" name="business_idx" id= "business_idx" value="<?= $_GET['wr_idx'] ?>">
        <input type="hidden" name="test_id"  value="<?= $_GET['bo_idx']?>">
        <input type="hidden" name="value_id"  value="1">
        <input type="hidden" name="us_idx" id="us_idx"  value="<?= $row['idx']; ?>">
        <input type="hidden" name="rater_idx" id="rater_idx"  value="<?= $row2['idx'] ?>">
        <table class="view_table_app">
            <thead>
                <th colspan="1" style="width:10%" class="input_text_center">제목</th>
                <td  colspan="5" id="bo_title_view"><?= $row['ko_title']; ?></td>
            </thead>
     
            <tbody class="rater_form">
                <tr class="view_table_header_table "></tr>
                <tr class="input_text_center">
                    <th colspan="6">항목평가</th>
                </tr>
                <?php
                    $sql4 = " select * from rater_category where category_idx = '{$row88['wr_title_idx']}' and test_step = '{$_GET['bo_idx']}'";
                    $result4 = sql_query($sql4);
                    $row4 = sql_fetch_array($result4);
        
                    $sql6 = " select count(idx) as cnt from rater_fild where test_fild_idx = '{$row4['idx']}'";
                    $result6 = sql_query($sql6);
                    $row6 = sql_fetch_array($result6);

                    $sql7 = " select * from rater_fild where test_fild_idx = '{$row4['idx']}'";
                    $result7 = sql_query($sql7);
                    
                    $sum = 0;
                    ?>
                    <?php
                        for($i = 1; $row7 = sql_fetch_array($result7);$i ++){
                            if($_GET['bo_idx'] == 2){
                    ?>
                                <tr>
                                    <th style="width:10%" class="input_text_center"><?= $row7['test_name'] ?></th>  
                                    <td style="width:40%" colspan="5">
                                       <input type="radio" name="test_fild_1" class="test_fild test_fild_radio" id="test_radio_1" value="1" <?= $row3['test_fild_1'] == 1? 'checked' : '' ?> >
                                       <label for="test_radio_1">지원</label>
                                       <input type="radio" name="test_fild_1" class="test_fild test_fild_radio" id="test_radio_2" value="0" <?= $row3['test_fild_1'] == 0? 'checked' : '' ?> >
                                       <label for="test_radio_2">미지원</label>
                                    </td>
                                </tr>
                    <?php
                            } else {
                                $sum = $sum + $row7['test_score'];
                                if($i % 2 == 1) echo "<tr>";
                    ?>
                                    <th style="width:10%" class="input_text_center"><?= $row7['test_name'] ?></th>  
                                    <td style="width:40%" colspan="<?= $i % 2 == 1? '1': '3' ?>">
                                        <input type="number" name="test_fild_<?= $i ?>" id="test_fild_<?= $i ?>"  class="input_text input_text_80  input_text_end test_fild" placeholder="<?= $row7['test_name'] ?>" value="<?= $row3['test_fild_'.$i] ?>" min="0" max="<?= $row7['test_score'] ?>" <?= $row3['value'] == 2 ? 'disabled' : '' ?>> 
                                        <span>/<?= $row7['test_score'] ?></span>
                                    </td>
                    <?php 
                                if($i == $row6['cnt'] && $i % 2 == 0){
                    ?>
                                    <tr>
                                        <th style="width:10%" class="input_text_center">총 점</th>  
                                        <td style="width:90%" colspan="5">
                                            <input type="number" name="test_fild_sum" id="test_fild_sum"  class="input_text input_text_80  input_text_end" placeholder="총 점" value="<?= $row3['test_sum'] ?>" min="0" max="80" readonly> 
                                            <span>/<?= $sum ?></span>
                                        </td>
                                    </tr>
                    <?php 
                                } else if($i == $row6['cnt'] && $i % 2 == 1){
                    ?>                                  
                                        <th style="width:10%" class="input_text_center">총 점</th>  
                                        <td style="width:40%" colspan="3">
                                            <input type="number" name="test_fild_sum" id="test_fild_sum"  class="input_text input_text_80  input_text_end" placeholder="총 점" value="<?= $row3['test_sum'] ?>" min="0" max="80" readonly> 
                                            <span>/<?= $sum ?></span>
                                        </td>
                                    </tr>
                    <?php 
                                }  else if($i != $row6['cnt'] && $i % 2 == 0) echo "</tr>";
                            }
                        }
                    ?>
                  <tr class="input_text_center">
                    <th>평가의견</th>
                    <td colspan="6">
                        <textarea name="test_opinion" id="test_opinion" class="input_text input_text_100 input_text_hight"  <?= $row3['value'] == 2 ? 'disabled' : '' ?> cols="20" rows="10" minlength="100"><?= $row3['test_opinion'] ?></textarea>
                    </td>
                </tr>
            </tbody>
            <tbody class="file_table_all file_table_all_rater">
                <tr class="view_table_header_table"></tr>
                <tr class="all_user_file">
                    <th scope="col" class="view_table_header " colspan="9" style="text-align:center">자료 첨부</th>
                </tr>
            </tbody>
        </table> 
        <div class="rater_value_btn_contianer">
        <?php if($row3['value'] != 2){ ?>
            <label for="upload01" id="file-label-btn" class="file-label file-label-btn"><img src="<?= G5_IMG_URL ?>/upload.png" alt=""> 파일 업로드</label>
        <?php } ?>
            <button type="button" class="btn_esc btn_color_white" style="float:right;">취소</button>
            <?php if($row3['value'] != 2){ ?>
            <button type="submit" class="btn_submit" id="value_btn_submit" style="float:right;">저장</button>
            <?php } ?>
        </div>
    </form>
    </fieldset>
    <div class="bo_sch_bg"></div>
    
    <script>
        $(function(){
            var us_idx = 0;
            var test_rater_value = 0;
            $('.btn_bo_val_val').click(function(){
                var rater_idx = $(this).parent().next().find('.sql_rater_idx').val();
                us_idx = $(this).parent().next().find('.sql_us_idx').val();
                test_rater_value = $(this).parent().next().find('.sql_fild_value').val();
                var bo_idx = '<?= $_GET['bo_idx'] ?>';
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

            $('.bo_sch_bg, .bo_sch_cls, .btn_esc').click(function(){
                $('.bo_sch_wrap').hide();
                location.reload();
            });

            if($('#test_opinion').val() != "")
                test_opinion = true;
            else 
                test_opinion = false;


            $('.test_fild, #test_opinion').on("propertychange change keyup paste input", function(){
                test_sum = 0;
                var bo_idx = '<?= $_GET['bo_idx']; ?>';
                
                if(bo_idx != 2){
                    var test_fild_length = $('.test_fild').length;

                    for(var p = 1; p <= test_fild_length; p++){
                        if($('#test_fild_'+p).val() != "")
                            test_fild_value = true;
                        else 
                            test_fild_value = false;

                            test_sum = Number(test_sum) +  Number($('#test_fild_'+p).val());
                    }

                } else {
                    if($('.test_fild_radio[name=test_fild_1]').is(':checked'))
                        test_fild_value = true;
                    else
                        test_fild_value = false;
                }
                if($('#test_opinion').val() != "")
                    test_opinion = true;
                else 
                    test_opinion = false;

               
                $('#test_fild_sum').val(test_sum);
                if(test_fild_value && test_opinion){
                    $('#value_btn_submit').attr('disabled', false);
                    $('#value_btn_submit').css({"background":"#1D2E58"});
                } else {
                    $('#value_btn_submit').attr('disabled', true);
                    $('#value_btn_submit').css({"background":"#ccc"});
                }
            });
            
            $('.btn_bo_val_submit').click(function(){
                var result = confirm('정말 의뢰하시겠습니까?'); 
                
                if(result) {  
                    return true;

                } else { 
                    return false;
                }

            })

            var file_number = 1;

            var disabled = '<?= $row3['value']  == 2? false : true; ?>';
            if(disabled){
                var html = '<tr class="input-file_list ">'
                            +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일명</th>'
                            +'<td scope="col" class="view_table_text" colspan="1" style="width:40%">'
                            +'    <input type="text" style="margin: 0 -2px;" id="file_label_view1" readonly="readonly" class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="파일명"/> '
                            +'</td>'
                            +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 사이즈</th>'
                            +'<td scope="col" class="view_table_text" colspan="1" style="width:20%">'
                            +'    <input type="text" id="file-size-'+file_number+'" class="file-name file-size" style="margin: 0 -2px;" value="용량" readonly="readonly"/>'
                            +'    <input type="file" name="bf_file_null[]" id="upload01" class="file-upload" />'
                            +'</td>'
                            +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 삭제</th>'
                            +'<td scope="col" class="view_table_text" colspan="1" style="width:10%">'
                            +'<button type="button" class="file-label file-del   " id="file-del<?= $i ?>">삭제</button>'
                            +'</td>'
                            +'</tr>';
                $('.file_table_all_rater').append(html);
            }

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
                        $(this).after('<input type="hidden" name="file_type[]" value ="0" />');
                        $(this).attr('name' , 'bf_file[]');

                        file_number++;

                        var html ='<tr class="input-file_list input-file_list_all">'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일명</th>'
                        +'<td scope="col" class="view_table_text" colspan="1" style="width:40%">'
                        +'    <input type="text" id="file_label_view'+file_number+'" readonly="readonly" class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="파일명"/>'
                        +'</td>'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 사이즈</th>'
                        +'<td scope="col" class="view_table_text" colspan="1" style="width:20%">'
                        +'    <input type="text" id="file-size-'+file_number+'" class="file-name file-size" value="용량" readonly="readonly"/>'
                        +'    <input type="file" name="bf_file_null[]" id="upload0'+file_number+'" class="file-upload"/>'
                        +'</td>'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 삭제</th>'
                        +'<td scope="col" class="view_table_text" colspan="1" style="width:10%">'
                        +'<button type="button" class="file-label file-del " id="file-del'+file_number+'">삭제</button>'
                        +'</td>'
                        +'</tr>';

                        $('.file_table_all').append(html);

                        $("#file-label-btn").attr('for', 'upload0'+file_number);

                    }
                })

                
            })

            $(document).on("keydown", "input[type=file]", function(event) {
                return event.key != "Enter";
            });

            $(document).off().on('click','.file-del',function(){
                var val = $(this).parent().prev().prev().find('.file-upload').val();
                var next = $(this).parent().parent().next().find('.file-upload').val();

                if(val != ""){
                    $(this).parent().parent().remove();
                } else {
                    if(next != undefined){
                        $(this).parent().parent().remove();
                    } 
                }    
            })
           
        });
    </script>
</div>

            <!-- } 게시판 검색 끝 --> 


<?php if($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>

<?php } ?>
