<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);

           
$sql = " select * from g5_business_propos where bo_idx= '{$_GET[wr_idx]}'";
$result = sql_query($sql);
$row22 = sql_fetch_array($result);

$sql = " select * from g5_write_business_title where idx= '{$row22['bo_title_idx']}'";
$result = sql_query($sql);
$row33 = sql_fetch_array($result);

$sql = " select * from report where business_idx= '{$row22['idx']}' && mb_id = '{$row22['mb_id']}' && report_idx = '{$_GET['bo_idx']}'  ";
$result = sql_query($sql);
$row44 = sql_fetch_array($result);

$sql = " select * from g5_board_file where bo_table= 'report' AND wr_id = '{$row44['idx']}'";
// echo $sql;
$result = sql_query($sql);
$il_file = array();
$j=0;
while ($row55=sql_fetch_array($result)){
    $il_file[$j] = $row55['bf_source'];
    
    $j ++;
}

// echo count($row55['bf_source']);


?>
<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>

<!-- 게시물 읽기 시작 { -->
<aside id="bo_side">
    <h2 class="aside_nav">보고서 제출</h2>
    <a class="aside_nav " href="<?= G5_BBS_URL ?>/board.report.php?bo_table=<?= $bo_table ?>&bo_idx=1">중간보고서</a>
    <a class="aside_nav " href="<?= G5_BBS_URL ?>/board.report.php?bo_table=<?= $bo_table ?>&bo_idx=2">결과(연차)보고서</a>
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
               <?= $row22['wr_subject']; ?>

            </span>
        </div>       
        <?php
            $link_buttons = ob_get_contents();
            ob_end_flush();
        ?>
        <!-- } 게시물 상단 버튼 끝 -->
    </header>
    <?php // echo $action_url; ?>
    <form name="fwrite" id="fwrite" action="" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" style="width:<?php echo $width; ?>">
        <?php  if(isset($row44)) { ?>
            <input type="hidden" name="save_db" value="1">
        <?php } ?>
    
        <label for="" id="bo_side" class="label_text">상세설명</label>
        <section id="bo_v" class="bo_class">
            <h2 id="bo_v_atc_title">본문</h2>
            <input type="text" name="contents" class="input_text input_text_hight" value="<?= $row44['contents']; ?>"<?= $row44['report'] ==2? "disabled": ""; ?>> 
        </section>


        <label for="" id="bo_side"  class="label_text">자료첨부</label>
        <section id="bo_v"  class="bo_class">
            <?php for ($i=0; $i<4; $i++) { ?>
                <div class="input-file">
                    <input type="text" id="file_label_view<?= $i ?>" readonly="readonly" class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능"  value="<?=  $il_file[$i]?>"/>
                    <label for="upload0<?php echo $i ?>" class="file-label" style="background:<?= $row44['report'] ==2? '#ccc': '#3a8afd'; ?>">찾아보기</label>
                    <input type="file" name="bf_file[<?php echo $i ?>]" id="upload0<?php echo $i ?>" class="file-upload" value="" <?= $row44['report'] ==2? "disabled": ""; ?> />
                    <button type="button" class="file-label file-del " id="file-del<?= $i ?>" <?= $row44['report'] ==2? "disabled": ""; ?>style="background:<?= $row44['report'] ==2? '#ccc !important': 'crimson'; ?>">삭제</button>
                </div>
            <?php } ?>
        </section>
        <section id="bus_btn" >
            <button type="submit" formaction="../bbs/write.report.php?bo_table=<?= $_GET['bo_table'] ?>&bo_idx=1&wr_bo_idx=<?= $_GET['wr_bo_idx'] ?>" class="btn_next_prv btn_next_prv_link" id="save" title="저장하기" <?= $row44['report'] ==2? "disabled": ""; ?> style="background:<?= $row44['report'] ==2? '#ccc': '#3a8afd'; ?>">저장하기</button>
            <button type="submit" formaction="../bbs/board.report.php?bo_table=business&bo_idx=1" class="btn_next_prv btn_next_prv_link" id="cancel" title="취소">취소</button>
            <button type="submit" formaction="../bbs/write.report.php?bo_table=<?= $_GET['bo_table'] ?>&bo_idx=1&wr_bo_idx=<?= $_GET['wr_bo_idx'] ?>" class="btn_next_prv btn_next_prv_link" id="submission" title="신청하기" <?= $row44['report'] ==2? "disabled": ""; ?> style="background:<?= $row44['report'] ==2? '#ccc': '#3a8afd'; ?>">신청하기</button>
        </section>
    </form>
    <?php
        // 파일 출력
        $v_img_count = count($view['file']);
        if($v_img_count) {
            echo "<div id=\"bo_v_img\">\n";

            for ($i=0; $i<=count($view['file']); $i++) {
                echo get_file_thumbnail($view['file'][$i]);
            }

            echo "</div>\n";
      
        }
         ?>
    <!-- 첨부파일 시작 { -->
    
    <!-- } 첨부파일 끝 -->
    

    


</article>

<script>
    $(function(){
        $('#save').click(function(){
            $("#fwrite").append('<input type="hidden" name="save" value="1">');
        });
        $('#submission').click(function(){
            $("#fwrite").append('<input type="hidden" name="save" value="2">');
        });
        $('#upload00').change(function(){
            var fileValue = $(this).val().split("\\");
            var fileName = fileValue[fileValue.length-1]; // 파일명
            if(fileName != ""){
                $('#file_label_view0').val(fileName);
            }
        })
        $('#upload01').change(function(){
            var fileValue = $(this).val().split("\\");
            var fileName = fileValue[fileValue.length-1]; // 파일명
            if(fileName != ""){
                $('#file_label_view1').val(fileName);
            }  
        })
        $('#upload02').change(function(){
            var fileValue = $(this).val().split("\\");
            var fileName = fileValue[fileValue.length-1]; // 파일명
            if(fileName != ""){
                $('#file_label_view2').val(fileName);
            }
        })
        $('#upload03').change(function(){
            var fileValue = $(this).val().split("\\");
            var fileName = fileValue[fileValue.length-1]; // 파일명
            if(fileName != ""){
                $('#file_label_view3').val(fileName);
                $('#form_file3').val(fileName);
            }
        })

        if($row44['report'] != 2){
            $('#file-del0').click(function(){
                $('#upload00').val("");
                $('#file_label_view0').val("");
            })
            $('#file-del1').click(function(){
                $('#upload01').val("");
                $('#file_label_view1').val("");
            })
            $('#file-del2').click(function(){
                $('#upload02').val("");
                $('#file_label_view2').val("");
            })
            $('#file-del3').click(function(){
                $('#upload03').val("");
                $('#file_label_view3').val("");
            })
            }
    })
</script>







