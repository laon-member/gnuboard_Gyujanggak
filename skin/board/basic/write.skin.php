<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);

$sql = " select * from g5_write_business_title where bo_table = '{$_GET['bo_table']}'";
$result = sql_query($sql);
?>
<aside id="bo_side">
    <h2 class="aside_nav_title">사업공고 관리</h2>
    <?php 
    $title_text="";
        for($k=1; $row=sql_fetch_array($result); $k++) {
            $class_get =  $_GET['bo_idx'] == $row['idx']?"aisde_click":"";
            if($_GET['bo_idx'] == $row['idx'])
                $title_text = $row['title'];

            echo '<a class="aside_nav '.$class_get.'" href="'.G5_BBS_URL .'/board.app.php?bo_table='.$bo_table.'&bo_idx='.$k.'&u_id=1">'.$row["title"].'</a>';
        }
    ?>
</aside>
<section id="bo_v">
    <!-- 게시물 작성/수정 시작 { -->
    <form name="fwrite" id="fwrite" action="<?php echo $action_url ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" >
    <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
    <input type="hidden" name="w" value="<?php echo $w ?>">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="bo_idx" value="<?php echo $_GET['bo_idx'] ?>">
    <input type="hidden" name="wr_id" value="<?php echo $_GET['wr_id'] ?>">
    <?php
    $option = '';
    $option_hidden = '';
    if ($is_notice || $is_html || $is_secret || $is_mail) { 
        $option = '';
        if ($is_notice) {
            $option .= PHP_EOL.'<li class="chk_box"><input type="checkbox" id="notice" name="notice"  class="selec_chk" value="1" '.$notice_checked.'>'.PHP_EOL.'<label for="notice"><span></span>공지</label></li>';
        }
        if ($is_html) {
            if ($is_dhtml_editor) {
                $option_hidden .= '<input type="hidden" value="html1" name="html">';
            } else {
                $option .= PHP_EOL.'<li class="chk_box"><input type="checkbox" id="html" name="html" onclick="html_auto_br(this);" class="selec_chk" value="'.$html_value.'" '.$html_checked.'>'.PHP_EOL.'<label for="html"><span></span>html</label></li>';
            }
        }
        if ($is_secret) {
            if ($is_admin || $is_secret==1) {
                $option .= PHP_EOL.'<li class="chk_box"><input type="checkbox" id="secret" name="secret"  class="selec_chk" value="secret" '.$secret_checked.'>'.PHP_EOL.'<label for="secret"><span></span>비밀글</label></li>';
            } else {
                $option_hidden .= '<input type="hidden" name="secret" value="secret">';
            }
        }
        if ($is_mail) {
            $option .= PHP_EOL.'<li class="chk_box"><input type="checkbox" id="mail" name="mail"  class="selec_chk" value="mail" '.$recv_email_checked.'>'.PHP_EOL.'<label for="mail"><span></span>답변메일받기</label></li>';
        }
    }
    //echo $option_hidden;
    ?>
    <div id="bo_btn_top">
        <h1 ><?= $title_text ?></h1>
    </div>

    <div class="bo_w_tit write_div">
        <label for="wr_subject" class="sound_only">제목<strong>필수</strong></label>
        
        <div id="autosave_wrapper" class="write_div">
        </div>
        
    </div>

    <table id="view_table">
        <thead>
            <tr>
                <th>제목</th>
                <td colspan="6" class="view_table_padding">
                    <input type="text" name="wr_subject" value="<?php echo $subject ?>" id="wr_subject" required class="input_text frm_input full_input required input_border_true" size="50" maxlength="255" placeholder="제목">
                </td>
            </tr>
        </thead>
        <tbody class="view_table_body">
            <tr>
                <th>과제번호</th>
                <td colspan="6" class="view_table_padding">
                
                    <input type="text" name="quest_number_view" id="quest_number_view"  class="input_text input_text_100 input_text_end input_border_true" placeholder="과제번호" value="<?= $write['wr_quest_number']; ?>" required>
                </td>
            </tr>
            <tr>
                <th>지원기간</th>
                <td colspan="1" class="view_table_padding">
                    <input type="text" name="date_start_act" id="date_start_view"  class="input_text frm_input required full_input input_text_100 input_text_end input_date input_border_true" value='<?= $write['wr_date_start'] ?>' max="9999-12-31" readonly placeholder="연도-월-일"   required>
                </td>
                <td colspan="5" class="view_table_padding">
                    <input type="text" name="date_end_act" id="date_end_view" class="input_text frm_input required full_input input_text_100 input_text_end input_date input_border_true"   value='<?= $write['wr_date_end'] ?>' max="9999-12-31" readonly  placeholder="연도-월-일" required>
                </td>
            </tr>
            <tr>
                <th>상세내용</th>
                <td colspan="6" class="view_table_padding">
                    <div class="wr_content <?php echo $is_dhtml_editor ? $config['cf_editor'] : ''; ?> ">
                        <textarea id="wr_content" name="wr_content" class="input_text input_text_100 input_border_true" maxlength="65536" style="width:100%;height:300px; resize:none"><?php echo  $write['wr_content'] ?></textarea>
                    </div>
                </td>
            </tr>
            <?php
                // 가변 파일
                for ($i=0; $i< $file_count; $i++) {
                    if (isset($file[$i]['source']) && $file[$i]['source'] ) {
                ?>
                    <tr class="input-file_list">
                        <?php
                            //MB 단위 이상일때 MB 단위로 환산
                            if ($file[$i]['size'] >= 1024 * 1024) {
                                $fileSize = $row55['bf_filesize'] / (1024 * 1024);
                                $convertlastpage = sprintf('%0.2f', $fileSize); // 520 -> 520.00
                                $str = $convertlastpage . ' MB';
                            }
                
                            else {
                                $fileSize = $file[$i]['size'] / 1024;
                                $convertlastpage = sprintf('%0.2f', $fileSize); // 520 -> 520.00
                                $str = $convertlastpage . ' KB';
                            }
                        ?>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%">파일명</th>
                        <td scope="col" class="view_table_text " colspan="1" style="width:40%">
                            <input type="text" id="file_label_view1" readonly="readonly" class="input_text file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="<?= $file[$i]['source']; ?>" style="margin: 0 -2px;"/>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 사이즈</th>
                        <td scope="col" class="view_table_text" colspan="2" style="width:20%">
                            <input type="hidden" name="file_idx" value="<?= $_GET['wr_id']; ?>" id="sql_file_id">
                            <input type="hidden" name="file_idx_num[]" value="<?= $file[$i]['no']; ?>" id="sql_file_id">
                            <input type="text" id="file-size-'+file_number+'" class="file-name file-size" style="margin: 0 -2px;" value="<?= $str ?>" readonly="readonly"/>
                            <input type="file" name="bf_file[]" id="upload00" class="file-upload file_sql_upload" value="<?= $file[$i]['bf_no']; ?>"/>
                            <input type="checkbox" id="del-no<?= $i ?>" name="del-no[]" value="<?= $file[$i]['bf_no']; ?>" style="display:none">
                        </td>
                        </td>
                            <th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 삭제</th>
                            <td scope="col" class="view_table_text" colspan="1" style="width:10%">
                            <label for="del-no<?= $i ?>" class="file-label del-no-btn">삭제</label>
                        </td>
                    </tr>

                <?php
                    }

                }
                
            ?>
        </tbody>
    </table>
    <div class ="btn_confirm write_div btn-cont">
        <div class="next_prev_bar">
            <label for="upload01" id="file-label-btn" class="file-label"><img src="<?= G5_IMG_URL ?>/upload.png" alt=""> 파일 업로드</label>
            <a href="<?php echo G5_BBS_URL; ?>/board.app.php?bo_table=business&bo_idx=<?= $_GET['bo_idx'] ?>&u_id=1" class="btn_color_white btn">취소</a>
            <button type="submit" id="btn_submit" accesskey="s" class="btn_submit btn"><?= $w == ""? "저장" : "수정" ?></button>
        </div>
    </div>

    </form>
              
    <script>
    

    // alert(vkvk);
    // alert("DSaf");
    
    <?php if($write_min || $write_max) { ?>
    // 글자수 제한
    var char_min = parseInt(<?php echo $write_min; ?>); // 최소
    var char_max = parseInt(<?php echo $write_max; ?>); // 최대
    check_byte("wr_content", "char_count");

    $(function() {
        

        $("#wr_content").on("keyup", function() {
            check_byte("wr_content", "char_count");
        });

    });
      
    <?php } ?>

    
    function html_auto_br(obj)
    {
        if (obj.checked) {
            result = confirm("자동 줄바꿈을 하시겠습니까?\n\n자동 줄바꿈은 게시물 내용중 줄바뀐 곳을<br>태그로 변환하는 기능입니다.");
            if (result)
                obj.value = "html2";
            else
                obj.value = "html1";
        }
        else
            obj.value = "";
    }

    function fwrite_submit(f)
    {
        <?php echo $editor_js; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>

        var subject = "";
        var content = "";
        $.ajax({
            url: g5_bbs_url+"/ajax.filter.php",
            type: "POST",
            data: {
                "subject": f.wr_subject.value,
                "content": f.wr_content.value
            },
            dataType: "json",
            async: false,
            cache: false,
            success: function(data, textStatus) {
                subject = data.subject;
                content = data.content;
            }
        });

        if (subject) {
            alert("제목에 금지단어('"+subject+"')가 포함되어있습니다");
            f.wr_subject.focus();
            return false;
        }

        if (content) {
            alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
            if (typeof(ed_wr_content) != "undefined")
                ed_wr_content.returnFalse();
            else
                f.wr_content.focus();
            return false;
        }

        if (document.getElementById("char_count")) {
            if (char_min > 0 || char_max > 0) {
                var cnt = parseInt(check_byte("wr_content", "char_count"));
                if (char_min > 0 && char_min > cnt) {
                    alert("내용은 "+char_min+"글자 이상 쓰셔야 합니다.");
                    return false;
                }
                else if (char_max > 0 && char_max < cnt) {
                    alert("내용은 "+char_max+"글자 이하로 쓰셔야 합니다.");
                    return false;
                }
            }
        }

        <?php echo $captcha_js; // 캡챠 사용시 자바스크립트에서 입력된 캡챠를 검사함  ?>

        document.getElementById("btn_submit").disabled = "disabled";

        return true;
    }

    $(function(){
        $(".input_date").datepicker(
            {dateFormat: 'yy-mm-dd'}
        );
        $('#btn_submit').click(function(){
            var date_start = $('#date_start_view').val();
            var date_end = $('#date_end_view').val();

            IsValidDateStart = Date.parse(date_start);
            if (isNaN(IsValidDateStart)){
                alert('총 지원기간 시작 날짜가 없는 날짜 입니다.');
                return false;
            } 
                
            IsValidDateEnd = Date.parse(date_end);
            if (isNaN(IsValidDateEnd)){
                alert('총 지원기간 끝나는 날짜가 없는 날짜 입니다.');
                return false;
            }
            
            if(date_start > date_end) {
                alert("지원기간 끝나는 날짜가 시작하는 날짜보다 빠릅니다");
                return false;
            }
        })


        var file_number = 1;
        var html = '<tr class="input-file_list">'
                    +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일명</th>'
                    +'<td scope="col" class="view_table_text" colspan="1" style="width:40%">'
                    +'    <input type="text" style="margin: 0 -2px;" id="file_label_view1" readonly="readonly" class="input_text file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="파일명"/> '
                    +'</td>'
                    +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 사이즈</th>'
                    +'<td scope="col" class="view_table_text" colspan="2" style="width:20%">'
                    +'    <input type="text" id="file-size-'+file_number+'" class=" input_text file-name file-size" style="margin: 0 -2px;" value="용량" readonly="readonly"/>'
                    +'    <input type="file" name="bf_file[]" id="upload01" class="file-upload"/>'
                    +'</td>'
                    +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 삭제</th>'
                    
                    +'<td scope="col" class="view_table_text" colspan="1" style="width:10%">'
                    +'<button type="button" class="  file-label file-del " id="file-del'+file_number+'">삭제</button>'
                    +'</td>'
                    +'</tr>';
        

        $('.view_table_body').append(html);
        

        

        //클릭이벤트 unbind 
        $("#file-label-btn").unbind("click"); 
        

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


                    file_number++;

                    // var html = '<div class="input-file"><input type="text" id="file_label_view'+file_number+'" readonly="readonly" class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="파일명"/><input type="text" id="file-size-'+file_number+'" class="file-name file-size" value="용량" readonly="readonly"/><input type="file" name="bf_file[]" id="upload0'+file_number+'" class="file-upload" <?= $row44['report'] ==2? "disabled": ""; ?>/><button type="button" class="file-label file-del " id="file-del'+file_number+'" <?= $row44['report'] ==2? "disabled": ""; ?>style="background:<?= $row44['report'] ==2? '#ccc !important': 'crimson'; ?>">삭제</button></div>';
                    var html ='<tr class="input-file_list">'
                    +'<th scope="col" class="view_table_header" colspan="1" style="width:10%; height:58px">파일명</th>'
                    +'<td scope="col" class="view_table_text" colspan="1" style="width:40%">'
                    +'    <input type="text" id="file_label_view'+file_number+'" readonly="readonly" class="input_text file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="파일명"/>'
                    +'</td>'
                    +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 사이즈</th>'
                    +'<td scope="col" class="view_table_text" colspan="2" style="width:20%">'
                    +'    <input type="text" id="file-size-'+file_number+'" class="file-name file-size" value="용량" readonly="readonly"/>'
                    +'    <input type="file" name="bf_file[]" id="upload0'+file_number+'" class="file-upload" <?= $row44['report'] ==2? "disabled": ""; ?>/>'
                    +'</td>'
                    +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 삭제</th>'
                    +'<td scope="col" class="view_table_text" colspan="1" style="width:10%">'
                    +'<button type="button" class="file-label file-del " id="file-del'+file_number+'" <?= $row44['report'] ==2? "disabled": ""; ?>>삭제</button>'
                    +'</td>'
                    +'</tr>';
                    $('.view_table_body').append(html);

                    $("#file-label-btn").attr('for', 'upload0'+file_number);

                }
            })
        })



        $(document).on('click','.file-del',function(){
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

        $('.del-no-btn').click(function(){
                var check_val =  $(this).parent().prev().prev().find('input[type="checkbox"]').is(":checked");
                $(this).parent().prev().prev().find('.file_sql_upload').attr('name', 'report_name[]');
                $(this).parent().parent().css({'display':'none'});
        })
    })
    </script>
</section>
<!-- } 게시물 작성/수정 끝 -->