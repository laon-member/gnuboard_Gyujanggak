<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);


           
$sql = " select * from g5_business_propos where bo_idx= '{$_GET['wr_idx']}'";
$result = sql_query($sql);
$row22 = sql_fetch_array($result);

$sql = " select * from g5_write_business where wr_id= '{$row22['bo_idx']}'";
$result = sql_query($sql);
$row = sql_fetch_array($result);

$sql = " select * from g5_write_business_title where idx= '{$row22['bo_title_idx']}'";
$result = sql_query($sql);
$row33 = sql_fetch_array($result);

if($_GET['bo_idx'] == 1){
    $sql = " select * from report where business_idx= '{$_GET['wr_bo_idx']}' and report_idx = 1 ";
} else if($_GET['bo_idx'] == 2 ){
    $sql = " select * from report where business_idx= '{$_GET['wr_bo_idx']}' and report_idx = 2 ";
}
$result = sql_query($sql);
$row44 = sql_fetch_array($result);


$sql = " select * from g5_board_file where bo_table= 'report' AND wr_id = '{$row44['idx']}' AND wr_id > 0";
$result = sql_query($sql);
$il_file = array();
$j=0;


?>

<!-- 게시물 읽기 시작 { -->
<aside id="bo_side">
    <h2 class="aside_nav_title">보고서 제출</h2>
    <a class="aside_nav <?= $_GET['bo_idx'] ==1 ? "aisde_click" : "" ?>" href="<?= G5_BBS_URL ?>/board.report.php?bo_table=<?= $bo_table ?>&bo_idx=1">중간보고서</a>
    <a class="aside_nav <?= $_GET['bo_idx'] ==2 ? "aisde_click" : "" ?>" href="<?= G5_BBS_URL ?>/board.report.php?bo_table=<?= $bo_table ?>&bo_idx=2">결과(연차)보고서</a>
</aside>
<article id="bo_v">
    <header>
        <?php ob_start(); ?>
        <!-- 게시물 상단 버튼 시작 { -->
        <div class="bo_w_tit write_div">
            <div id="bo_btn_top_app">
                <h1 class="view_title">
                    <?php
                        if( $_GET['bo_idx'] ==1){
                            echo '중간보고서';
                        } else if( $_GET['bo_idx'] ==2){
                            echo '결과(연차)보고서';
                        }
                    ?>
                </h1>
            </div>
        </div>
        <?php
            $link_buttons = ob_get_contents();
            ob_end_flush();

        ?>
       
        <!-- } 게시물 상단 버튼 끝 -->
    </header>
    <?php // echo $action_url; ?>
    <form name="fwrite" id="fwrite" action="" onsubmit="return fwrite_submit(this);" method="POST" enctype="multipart/form-data" autocomplete="off" style="width:<?php echo $width; ?>">
    <input type="hidden" name="wr_bo_idx" value="<?= $_GET['wr_bo_idx']?>"> 
    <input type="hidden" name="file_idx" value="<?= $row44['idx']?>"> 
    <input type="hidden" name="save_db" value="<?= $row44['idx'] != "" ? "true" : ""; ?>"> 
    <input type="hidden" name="report_idx" value="<?= $_GET['bo_idx']; ?>"> 

    <table class="view_table_app">
        <thead>
            <tr>
                <th scope="col" class="view_table_header"colspan="1" style="width: 10%;">제목</th>
                <td scope="col" class="view_table_title" colspan="8" style="">[<?= $row33['title']; ?>]<?= $row['wr_subject']; ?></td>
            </tr>
        </thead>
        <tbody>
            <tr class="view_table_header_table"></tr>
            <tr>
                <td scope="col" class="view_table_title" colspan="8" style="">
                    <h2 id="bo_v_atc_title">본문</h2>
                    <input type="text" name="contents" class="input_text input_text_hight" placeholder="설명을 입력해주세요." value="<?= $row44['contents']; ?>"<?= $row44['report'] ==2? "disabled": ""; ?>> 
                </td>
            </tr>
        </tbody> 
        <tbody id="view_table_upload">
                
                <?php while ($row55=sql_fetch_array($result)){ ?>
                    <tr class="input-file_list">
                        <?php
                            //MB 단위 이상일때 MB 단위로 환산
                            if ($row55['bf_filesize'] >= 1024 * 1024) {
                                $fileSize = $row55['bf_filesize'] / (1024 * 1024);
                                $convertlastpage = sprintf('%0.2f', $fileSize); // 520 -> 520.00
                                $str = $convertlastpage . ' MB';
                            }
                
                            else {
                                $fileSize = $row55['bf_filesize'] / 1024;
                                $convertlastpage = sprintf('%0.2f', $fileSize); // 520 -> 520.00
                                $str = $convertlastpage . ' KB';
                            }
                        ?>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%">파일명</th>
                        <td scope="col" class="view_table_text" colspan="1" style="width:40%">
                        <input type="text" id="file_label_view1" readonly="readonly" class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="<?= $row55['bf_source']; ?>" style="margin: 0 -2px;"/>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 사이즈</th>
                        <td scope="col" class="view_table_text" colspan="1" style="width:20%">
                            <input type="hidden" value="<?= $row55['bo_table']; ?>" id="sql_file_tabel">
                            <input type="hidden" value="<?= $row55['wr_id']; ?>" id="sql_file_id">
                            <input type="hidden" value="<?= $row55['bf_no']; ?>" id="sql_file_no">
                            <input type="text" id="file-size-'+file_number+'" class="file-name file-size" style="margin: 0 -2px;" value="<?= $str ?>" readonly="readonly"/>
                            <input type="file" name="bf_file[]" id="upload00" value="<?= $row55['bf_no']; ?>" class="file-upload file_sql_upload" <?= $row44['report'] ==2? "disabled": ""; ?> />
                            <input type="checkbox" class="del-no" id="del-no<?= $j ?>" name="del-no[]" value="<?= $row55['bf_no']; ?>" style="display:none;">
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 삭제</th>
                        <td scope="col" class="view_table_text" colspan="1" style="width:10%">
                            <label for="del-no<?= $j ?>" class="file-label del-no-btn">삭제</label>
                        </td>
                    </tr>
                <?php
                        $j ++;
                    }  
                ?>
        </tbody>        
    </table>
        <div class ="btn_confirm write_div btn-cont">
            <div class="next_prev_bar">
            <?php if($row44['report'] < 2){ ?>
                <label for="upload01" id="file-label-btn" class="file-label"><img src="<?= G5_IMG_URL ?>/upload.png" alt=""> 파일 업로드</label>

                <button type="submit" formaction="<?= G5_BBS_URL ?>/view.report.update.php?bo_table=report&bo_idx=<?= $_GET['bo_idx'] ?>&wr_bo_idx=<?= $_GET['wr_bo_idx'] ?>" class="btn_next_prv btn_color_white btn_file_del" id="save" title="<?php $row44 == "" ? '저장하기':'수정하기'; ?>" <?= $row44['report'] ==2? "disabled": ""; ?> ><?= $row44 == "" ? '저장':'수정'; ?></button>
            <?php } ?>

                <button type="submit" formaction="<?= G5_BBS_URL ?>/board.report.php?bo_table=business&bo_idx=<?= $_GET['bo_idx'] ?>" class="btn_next_prv  btn_color_white" id="cancel" title="취소">취소하기</button>
            <button type="submit" formaction="<?= G5_BBS_URL ?>/view.report.update.php?bo_table=report&bo_idx=<?= $_GET['bo_idx'] ?>&wr_bo_idx=<?= $_GET['wr_bo_idx'] ?>" class="btn_next_prv btn_next_prv_link btn_file_del" id="submission" title="신청하기" <?= $row44['report'] ==2? "disabled": ""; ?> style="background:<?= $row44['report'] ==2? '#ccc': '#1D2E58'; ?>">신청하기</button>
            </div>
        </div>
</form>

</article>
<script>
   $(function(){
        $('#save').click(function(){
            $("#fwrite").append('<input type="hidden" name="save" value="1">');
        });
        $('#submission').click(function(){
            $("#fwrite").append('<input type="hidden" name="save" value="2">');
        });
        var file_number = 1;
        var disabled = '<?= $row44['report'] == 2? false : true; ?>';
        if(disabled){
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
                    +'<button type="button" class="file-label file-del " id="file-del<?= $i ?>" <?= $row44['report'] ==2? "disabled": ""; ?>">삭제</button>'
                    +'</td>'
                    +'</tr>';
            $('#view_table_upload').append(html);
        }


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
                    $(this).prev().val(str);
                    $(this).parent().prev().prev().children().val(fileName);


                    file_number++;

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
                    $('#view_table_upload').append(html);

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
        var report_value = '<?= $row44['report'] == "" ? 0 : $row44['report']; ?>';
        $('.del-no-btn').click(function(){
            if(report_value < 2){
                var check_val =  $(this).parent().prev().prev().find('input[type="checkbox"]').is(":checked");
                $(this).parent().prev().prev().find('.file_sql_upload').attr('name', 'report_name[]');
                $(this).parent().parent().css({'display':'none'});

            }
        })

    });
</script>
