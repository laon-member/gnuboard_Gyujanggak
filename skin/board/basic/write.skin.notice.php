<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);

$sql1 = " SELECT * FROM `g5_write_business_title` where bo_table = '{$_GET['bo_table']}'";
$result1 = sql_query($sql1);
?>

<aside id="bo_side">
    <h2 class="aside_nav_title">자료실</h2>
    <?php 
        for($k=7; $row1=sql_fetch_array($result1); $k++) {
            $class_get = $_GET['bo_idx'] == $row1['idx']?"aisde_click":"";
            echo '<a class="aside_nav '.$class_get.'" href="'.G5_BBS_URL .'/board.notice.php?bo_table=notice&bo_idx='.$k.'&page=1&bo_title='.$_GET['bo_title'].'&u_id=1">'.$row1['title'].'</a>';
           
            if($_GET['bo_idx'] == $row1['idx']){
                $category_title =  $row1['title']; 
            }
        }
    ?>
</aside>
<section id="bo_v">
    <div id="bo_btn_top">
        <h1 class=""><?= $category_title ?></h1>
    </div>
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
    <input type="hidden" name="bo_title" value="<?php echo $_GET['bo_title'] ?>">
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
    echo $option_hidden;
    ?>
 
  
    

    <div class="bo_w_tit write_div">
        <label for="wr_subject" class="sound_only">제목<strong>필수</strong></label>
        
        <div id="autosave_wrapper" class="write_div">
        </div>
        
    </div>

    <table id="view_table">
        <thead>
            <tr>
                <th>제목</th>
                <td colspan="6">
                    <input type="text" name="wr_subject" value="<?php echo $subject ?>" id="wr_subject" required class="input_text frm_input full_input required" size="50" maxlength="255" placeholder="제목">
                </td>
            </tr>
        </thead>
        <tbody class="view_table_body">
            
            <tr>
                <th>상세내용</th>
                <td colspan="6">
                    <div class="wr_content <?php echo $is_dhtml_editor ? $config['cf_editor'] : ''; ?> ">
                        <?php if($write_min || $write_max) { ?>
                        <!-- 최소/최대 글자 수 사용 시 -->
                        <p id="char_count_desc">이 게시판은 최소 <strong><?php echo $write_min; ?></strong>글자 이상, 최대 <strong><?php echo $write_max; ?></strong>글자 이하까지 글을 쓰실 수 있습니다.</p>
                        <?php } ?>
                        <textarea id="wr_content" name="wr_content" class="input_text input_text_100" maxlength="65536" style="width:100%;height:300px"></textarea>
                        <?php if($write_min || $write_max) { ?>
                        <!-- 최소/최대 글자 수 사용 시 -->
                        <div id="char_count_wrap"><span id="char_count"></span>글자</div>
                        <?php } ?>
                    </div>
                </td>
            </tr>

        </tbody>
    </table>
  

    <div class ="btn_confirm write_div btn-cont">
        <?php 
        
        if($_GET['bo_title'] == 1){
           $lilnk_admin = "";
        } else if($_GET['bo_title'] == 2){
           $lilnk_admin = "";
       } else if($_GET['bo_title'] == 3){
           $lilnk_admin = "&u_id=1";
       }


       ?>
       
        <div class="next_prev_bar">
            <label for="upload01" id="file-label-btn" class="file-label"><img src="<?= G5_IMG_URL ?>/upload.png" alt=""> 파일 업로드</label>
            <a href="<?= G5_BBS_URL ?>/board.notice.php?bo_table=notice&bo_idx=<?= $_GET['bo_idx']; ?>&bo_title=<?= $_GET['bo_title'] ?>&u_id=1" class="btn_color_white btn">취소</a>
            <button type="submit" id="btn_submit" accesskey="s" class="btn_submit btn">작성완료</button>
        </div>
    </div>
    </form>
              
    <script>
    

    <?php if($write_min || $write_max) { ?>
    var char_min = parseInt(<?php echo $write_min; ?>); // 최소
    var char_max = parseInt(<?php echo $write_max; ?>); // 최대
    check_byte("wr_content", "char_count");

    $(function() {
        $("#wr_content").on("keyup", function() {
            check_byte("wr_content", "char_count");
        });

        // $('#btn_submit').click(function(){
        //     IsValidDateStart = Date.parse($('#date_start').val());
        //     if (isNaN(IsValidDateStart)) return alert('총 연구기간 시작 날짜가 유효하지 않습니다.');
                
        //     IsValidDateEnd = Date.parse($('#date_end').val());
        //     if (isNaN(IsValidDateEnd)) return alert('총 연구기간 끝나는 날짜가 유효하지 않습니다.');
        // })
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
        var file_number = 1;
        var html = '<tr class="input-file_list">'
                    +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일명</th>'
                    +'<td scope="col" class="view_table_text" colspan="1" style="width:40%">'
                    +'    <input type="text" style="margin: 0 -2px;" id="file_label_view1" readonly="readonly" class="input_text file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="파일명"/> '
                    +'</td>'
                    +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 사이즈</th>'
                    +'<td scope="col" class="view_table_text" colspan="2" style="width:20%">'
                    +'    <input type="text" id="file-size-'+file_number+'" class=" input_textfile-name file-size" style="margin: 0 -2px;" value="용량" readonly="readonly"/>'
                    +'    <input type="file" name="bf_file[]" id="upload01" class="file-upload"/>'
                    +'</td>'
                    +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 삭제</th>'
                    +'<td scope="col" class="view_table_text" colspan="1" style="width:10%">'
                    +'<button type="button" class=" input_text file-label file-del " id="file-del'+file_number+'">삭제</button>'
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
                    +'<th scope="col" class="view_table_header" colspan="1" style="width:10%;height: 58px;">파일명</th>'
                    +'<td scope="col" class="view_table_text" colspan="1" style="width:40%">'
                    +'    <input type="text" id="file_label_view'+file_number+'" readonly="readonly" class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="파일명"/>'
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

        $(document).on("keydown", "input[type=file]", function(event) { 
            return event.key != "Enter";
        });

       
    })
    </script>
</section>
<!-- } 게시물 작성/수정 끝 -->