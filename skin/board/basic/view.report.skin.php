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

$sql = " select * from report where business_idx= '{$row22['idx']}' ";
$result = sql_query($sql);
$row44 = sql_fetch_array($result);

$sql = " select * from g5_board_file where bo_table= 'report' AND wr_id = '{$row44['idx']}'";
$result = sql_query($sql);
$il_file = array();
$j=0;


?>

<!-- 게시물 읽기 시작 { -->
<aside id="bo_side">
    <h2 class="aside_nav">보고서 제출</h2>
    <a class="aside_nav <?= $_GET['bo_idx'] ==1 ? "aisde_click" : "" ?>" href="<?= G5_BBS_URL ?>/board.report.php?bo_table=<?= $bo_table ?>&bo_idx=1">중간보고서</a>
    <a class="aside_nav <?= $_GET['bo_idx'] ==2 ? "aisde_click" : "" ?>" href="<?= G5_BBS_URL ?>/board.report.php?bo_table=<?= $bo_table ?>&bo_idx=2">결과(연차)보고서</a>
</aside>
<article id="bo_v">
    <header>
        <?php ob_start(); ?>
        <!-- 게시물 상단 버튼 시작 { -->
        <div id="bo_v_top">
            <h1 class="category_title">
                <?= $row33['title']; ?>
            </h1>
            
        </div>
        <div class="bo_b_tit_container">
            <span clasos="bo_v_tit">
            [<?= $row33['title']; ?>]<?= $row['wr_subject']; ?>
            </span>
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
        <?php  if(isset($row44)) { ?>
            <input type="hidden" name="save_db" value="1">
        <?php } ?>
        <input type="hidden" name="file_idx" value="<?= $row44['idx']; ?>">
        <label for="" id="bo_side" class="label_text">상세설명</label>
        <section id="bo_v" class="bo_class">
            <h2 id="bo_v_atc_title">본문</h2>
            <input type="text" name="contents" class="input_text input_text_hight" value="<?= $row44['contents']; ?>"<?= $row44['report'] ==2? "disabled": ""; ?>> 
        </section>

        <label for="" id="bo_side"  class="label_text">자료첨부</label>
        <section id="bo_v"  class="bo_class_form bo_class">
            <?php echo "<script>var file_number = 1;</script>"; ?>
            <?php $file_number = "<script>document.writeln(file_number);</script>"; ?>
            <label for="upload01" id="file-label-btn" class="file-label" style="background:<?= $row44['report'] ==2? '#ccc': '#3a8afd'; ?>">파일 업로드</label>
            <div class="input-file input_file_text">
                <p class="file-name">파일명</p>
                <p class="file-name file-size">파일 용량</p>
                <p class="file-name file-size">파일 삭제</p>
            </div>
            <?php 
                while ($row55=sql_fetch_array($result)){
            ?>
            <div class="input-file">
                <input type="text" id="file_label_view1" readonly="readonly" class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="<?= $row55['bf_source']; ?>" style="margin: 0 -2px;"/>
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
                <input type="text" id="file-size-'+file_number+'" class="file-name file-size" style="margin: 0 -2px;" value="<?= $str ?>" readonly="readonly"/>
                <input type="hidden" value="<?= $row55['bo_table']; ?>" id="sql_file_tabel">
                <input type="hidden" value="<?= $row55['wr_id']; ?>" id="sql_file_id">
                <input type="hidden" value="<?= $row55['bf_no']; ?>" id="sql_file_no">
                <input type="file" name="bf_file[]" id="upload00" class="file-upload file_sql_upload" <?= $row44['report'] ==2? "disabled": ""; ?> />
                <button type="button" class="file-label file-del file-event-none" id="file-del-sql-<?= $j ?>" <?= $row44['report'] ==2? "disabled": ""; ?> style="<?= $row44['report'] ==2? 'background:#ccc !important': 'background:crimson'; ?>;margin-left:-4px;">삭제</button>
            </div>
            <?php
                    $j ++;
                }  
            ?>
        </section>
        <section id="bus_btn" >
            <button type="submit" formaction="<?= G5_BBS_URL ?>/view.report.update.php?bo_table=<?= $_GET['bo_table'] ?>&bo_idx=1&wr_bo_idx=<?= $_GET['wr_bo_idx'] ?>" class="btn_next_prv btn_next_prv_link" id="save" title="<?php $row44 == "" ? '저장하기':'수정하기'; ?>" <?= $row44['report'] ==2? "disabled": ""; ?> style="background:<?= $row44['report'] ==2? '#ccc': '#3a8afd'; ?>"><?= $row44 == "" ? '저장하기':'수정하기'; ?></button>
            <button type="submit" formaction="<?= G5_BBS_URL ?>/board.report.php?bo_table=business&bo_idx=1" class="btn_next_prv btn_next_prv_link" id="cancel" title="취소">취소</button>
            <button type="submit" formaction="<?= G5_BBS_URL ?>/view.report.update.php?bo_table=<?= $_GET['bo_table'] ?>&bo_idx=1&wr_bo_idx=<?= $_GET['wr_bo_idx'] ?>" class="btn_next_prv btn_next_prv_link" id="submission" title="신청하기" <?= $row44['report'] ==2? "disabled": ""; ?> style="background:<?= $row44['report'] ==2? '#ccc': '#3a8afd'; ?>">신청하기</button>
        </section>
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

        var disabled = '<?= $row44['report'] == 2? false : true; ?>'
        if(disabled){
            var html = '<div class="input-file"><input type="text" style="margin: 0 -2px;" id="file_label_view1" readonly="readonly" class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="파일명"/> <input type="text" id="file-size-'+file_number+'" class="file-name file-size" style="margin: 0 -2px;" value="용량" readonly="readonly"/><input type="file" name="bf_file[]" id="upload01" class="file-upload" <?= $row44['report'] ==2? "disabled": ""; ?> /><button type="button" class="file-label file-del " id="file-del<?= $i ?>" <?= $row44['report'] ==2? "disabled": ""; ?>style="background:<?= $row44['report'] ==2? '#ccc !important': 'crimson'; ?>">삭제</button></div>';

            $('.bo_class_form').append(html);
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
                    file_number++;
                    $(this).prev().val(str);
                    $(this).prev().prev().val(fileName);
                    // <input type="text" id="file-size-'+file_number+'" value="'.str.'" />
                    // value="'+fileName+'"
                    // value="'+str+'" 
                    var html = '<div class="input-file"><input type="text" id="file_label_view'+file_number+'" readonly="readonly" class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="파일명"/><input type="text" id="file-size-'+file_number+'" class="file-name file-size" value="용량" readonly="readonly"/><input type="file" name="bf_file[]" id="upload0'+file_number+'" class="file-upload" <?= $row44['report'] ==2? "disabled": ""; ?>/><button type="button" class="file-label file-del " id="file-del'+file_number+'" <?= $row44['report'] ==2? "disabled": ""; ?>style="background:<?= $row44['report'] ==2? '#ccc !important': 'crimson'; ?>">삭제</button></div>';
                    $('.bo_class_form').append(html);

                    var html = '<input type="text" name="form_file'+file_number+'" id="form__file'+file_number+'"  class="input_text_100 input_text input_text_end input_form" value="'+ fileName+'" readonly>';
                    $('#input_file_cont').append(html);

                    $("#file-label-btn").attr('for', 'upload0'+file_number)
                }
            })
        })
        $(document).off().on('click','.file-del',function(){
            if($(this).hasClass("file-event-none") === true)
                exit;

            if(disabled){
                exit;
            }

            var val = $(this).prev().val();
            var next = $(this).parent().next().find('.file-upload').val();

            console.log(next);

            if(val != ""){
                $(this).parent().remove();
            } else {
                if($(this).prev().hasClass("file_sql_upload") === true) {
                        $(this).parent().remove();
                } else {
                    if(next != "" && next != undefined){
                        $(this).parent().remove();
                    }
                }
            } 
        })

        $(document).on("keydown", "input[type=file]", function(event) {
            return event.key != "Enter";
        });

        $('.file-event-none').click(function(){
            var sql_file_tabel = $(this).siblings('#sql_file_tabel').val();
            var sql_file_id = $(this).siblings('#sql_file_id').val();
            var sql_file_no = $(this).siblings('#sql_file_no').val();
            var sql_file_btn = $(this).attr('id');
            alert(sql_file_tabel);
            alert(sql_file_id);
            alert(sql_file_no);
            $.ajax({
                url: "<?= G5_BBS_URL ?>/file_del.php",
                method: "POST",
                data: {
                    sql_file_tabel: sql_file_tabel,
                    sql_file_id : sql_file_id,
                    sql_file_no: sql_file_no,
                    sql_file_btn: sql_file_btn
                },
                dataType: "text",
                success : function(e){
                    
                }
            });
            $(this).parent().css({"display":"none"}); 
        })     
    })
</script>
