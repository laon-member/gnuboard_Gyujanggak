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


$sql1 = " SELECT * FROM g5_write_business WHERE wr_id = {$_GET['wr_idx']} ";
$result1 = sql_query($sql1);
$row=sql_fetch_array($result1);

$sql2 = " SELECT * FROM g5_write_business_title WHERE idx = {$row['wr_title_idx']} ";
$result2 = sql_query($sql2);
$row2=sql_fetch_array($result2);

?>

<!-- 게시판 목록 시작 { -->
<aside id="bo_side">
    <h2 class="aside_nav_title">심사 관리</h2>
   
    <a class="aside_nav <?= $_GET['bo_idx'] == 1?"aisde_click":""; ?>" href="<?= G5_BBS_URL ?>/board.rater.admin.php?bo_table=<?= $bo_table ?>&bo_idx=1&u_id=1">지원자 선발</a>
    <a class="aside_nav <?= $_GET['bo_idx'] == 2?"aisde_click":""; ?>" href="<?= G5_BBS_URL ?>/board.rater.admin.php?bo_table=<?= $bo_table ?>&bo_idx=2&u_id=1">중간보고서</a>
    <a class="aside_nav <?= $_GET['bo_idx'] == 3?"aisde_click":""; ?>" href="<?= G5_BBS_URL ?>/board.rater.admin.php?bo_table=<?= $bo_table ?>&bo_idx=3&u_id=1">결과(연차)보고서</a>
</aside>
<div id="bo_list" >
    <div id="bo_btn_top" style="display: block;">
        <h1 id="">[<?= $row2['title'];?>]<?= $row['wr_subject'];?></h1>
        <div style="text-align: right; margin-top:10px">
            <button class="add_btn">추가 지원</button>
        </div>
    </div>

        	
    <div class="tbl_head01 tbl_wrap">
        <table>
        <caption><?php echo $board['bo_subject'] ?> 목록</caption>
        <thead>
        <tr>
            <th scope="col" style="width:10%">번호</th>
            <th scope="col" style="width:10%">접수번호</th>
            <th scope="col" style="width:60%">과제명</th>
            <th scope="col" style="width:20%">취소</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $sql = "  select COUNT(DISTINCT `idx`) as cnt from rater where user_id = '{$member['mb_id']}' and test_id = '{$_GET['bo_idx']}'";
        $row11 = sql_fetch($sql);
        $total_count = $row11['cnt'];

            if($_GET['bo_idx'] == 1){
                $sql = " select * from g5_business_propos where bo_idx = '{$_GET['wr_idx']}' ORDER BY info_number DESC";
            } else if ($_GET['bo_idx'] == 2) {
                $sql = " select * from g5_business_propos where bo_idx = '{$_GET['wr_idx']}' and value = 4  ORDER BY info_number DESC";
            } else if ($_GET['bo_idx'] == 3) {
                $sql = " select * from g5_business_propos where bo_idx = '{$_GET['wr_idx']}' and report_val_1 = 4  ORDER BY info_number DESC";
            }

            $result = sql_query($sql);
        for ($i=0; $i<$row = sql_fetch_array($result); $i++) {

        ?>
        
        <tr class="<?php echo $lt_class ?> tr_hover">
            <td class="hidden" style="display:none;">
                <input type="hidden" class="sql_idx" name="sql_idx" value="<?= $_GET['bo_idx'] ?>">
                <input type="hidden" class="sql_title" name="sql_title" value="<?php echo $row['title']; ?>">
                <input type="hidden" class="sql_ko_title" name="sql_ko_title" value="<?php echo $row['ko_title']; ?>">
                <input type="hidden" class="sql_us_idx" name="us_idx" value="<?php echo $row['idx']; ?>">
            </td>
            
            <td class="td_idx td_center">
                <?php
                    echo $list[$i]['num'];
                ?>
            </td>

            <td class="td_center">
                <?= $row['info_number'] ?> 
            </td>
            <td class="td_title "  >
            <a href="<?= G5_BBS_URL ?>/board.rater.admin.php?bo_table=qa&bo_idx=<?= $_GET['bo_idx'] ?>&wr_idx=<?= $_GET['wr_idx'] ?>&us_idx=<?= $row['idx']; ?>&u_id=1"><?= $row['ko_title']; ?></a>
                    
            </td>
            <td class="td_center">
                <a href="<?= G5_BBS_URL ?>/user_list_del.php?us_idx=<?= $row['idx'] ?>" class="esc_btn">삭제</a>
            </td>
        </tr>
        

        <?php } ?>
        <?php if (count($list) == 0) { echo '<tr><td colspan="6" class="empty_table">신청한 지원자가 없습니다.</td></tr>'; } ?>
        </tbody>
        </table>
    </div>

    <section id="bo_v_files" class="td_right btn-cont text_block">
        <a href="<?= G5_BBS_URL ?>/board.rater.admin.php?bo_table=qa&bo_idx=<?php echo $_GET['bo_idx']; ?>&u_id=1" class="btn_next_prv btn_next_prv_link text_inline_block" title="목록보기">목록보기</a>
    </section>

</div>

<script>
jQuery(function($){
    $('.esc_btn').click(function(){
        var delConfirm = confirm('지원 내역을 취소 하시겠습니까?');
        if (delConfirm) {
            return true;
        }
        else {
            return false;
        }
    })

    // 게시판 검색
    $(".add_btn").on("click", function() {

        $('.bo_sch_wrap').toggle();

    })
    $('.bo_sch_bg, .bo_sch_cls, .btn_esc').click(function(){
        $('.bo_sch_wrap').hide();
    });
});

</script>
<div class="bo_sch_wrap">
    <fieldset class="bo_sch bo_add" style="width:1000px; max-height:noen; height:700px;">
        <?php 
            $sql1 = " SELECT * FROM g5_write_business WHERE wr_id = {$_GET['wr_idx']} ";
            $result1 = sql_query($sql1);
            $row=sql_fetch_array($result1);
        ?>

        <p id="sql_title_view"></p>
        <h1 style="text-align: center;">추가 지원 권한 부여</h1>
        <h3 id="sql_ko_title_view">[<?= $row2['title'];?>]<?= $row['wr_subject'];?></h3>
        <form name="fsearch" method="POST" action="<?= https_url(G5_BBS_DIR)."/add_propos_update.php" ?>" style="text-align: center;" enctype="multipart/form-data"autocomplete="off" >
            <input type="hidden" name="business_idx" id= "business_idx" value="<?= $_GET['wr_idx'] ?>">
            <input type="hidden" name="value_id"  value="1">

            <div class="add_table_info">
                <input type="text" name="member_id" placeholder="회원 아이디" class="add_input">
                <input type="text" name="add_date" placeholder="날짜" class="add_input add_date" id="datepicker" max="9999-12-31">
                <input type="text" name="add_time" placeholder="시간" class="add_input add_time">
                <button type="submit" class="btn_submit" style="font-size: 14px">추가</button>
            </div>
        </form>
        
        <table class="tbl_head01 add_list_table">
            <caption><?php echo $board['bo_subject'] ?> 목록</caption>
            <thead>
                <tr>
                    <th scope="col" style="width:10%">번호</th>
                    <th scope="col" style="width:40%">회원 아이디</th>
                    <th scope="col" style="width:40%">권한 만료 기간</th>
                    <th scope="col" style="width:10%">취소</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "  select COUNT(DISTINCT `idx`) as cnt from add_propos where business_idx = '{$_GET['wr_idx']}'";
                $row11 = sql_fetch($sql);
                $total_count = $row11['cnt'];

                $sql = "  select * from add_propos where business_idx = '{$_GET['wr_idx']}'";
                $result = sql_query($sql);
                for ($i=0; $i<$row = sql_fetch_array($result); $i++) {

                ?>
                
                <tr class="<?php echo $lt_class ?> tr_hover">
                    <td class="hidden" style="display:none;">
                        <input type="hidden" class="sql_idx" name="sql_idx" value="<?= $_GET['bo_idx'] ?>">
                        <input type="hidden" class="sql_title" name="sql_title" value="<?php echo $row['title']; ?>">
                        <input type="hidden" class="sql_ko_title" name="sql_ko_title" value="<?php echo $row['ko_title']; ?>">
                        <input type="hidden" class="sql_us_idx" name="us_idx" value="<?php echo $row['idx']; ?>">
                    </td>
                    
                    <td class="td_idx td_center">
                        <?= $total_count - $i; ?>
                    </td>

                    <td class="td_center">
                        <?= $row['mb_id'] ?> 
                    </td>
                    <td class="td_center">
                        <?= $row['date'] ?>
                    </td>
                    <td class="td_center">
                        <form name="fsearch" method="POST" action="<?= https_url(G5_BBS_DIR)."/add_propos_update.php" ?>" style="text-align: center;" enctype="multipart/form-data"autocomplete="off" >
                            <input type="hidden" name="business_idx" id= "business_idx" value="<?= $_GET['wr_idx'] ?>">
                            <input type="hidden" name="member_id" id= "member_id" value="<?= $row['mb_id'] ?>">
                            <input type="hidden" name="value_id"  value="2">

                            <button type="submit" class="add_esc_btn" style="font-size: 14px">삭제</button>
                        </form>
                    </td>
                </tr>
                <?php } ?>
                <?php if ($total_count == 0) { echo '<tr><td colspan="6" class="empty_table">추가 지원이 가능한 지원자가 없습니다.</td></tr>'; } ?>
            </tbody>
        </table>
        
        <div class="rater_value_btn_contianer">
            <button type="button" class="btn_esc">확인</button>
        </div>
        
        
    </fieldset>
    <div class="bo_sch_bg"></div>
    
</div>
<script>

// function fwrite_submit(f)
//     {
//         <?php echo $editor_js; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>

//         var subject = "";
//         var content = "";
//         $.ajax({
//             url: g5_bbs_url+"/ajax.filter.php",
//             type: "POST",
//             data: {
//                 "subject": f.wr_subject.value,
//                 "content": f.wr_content.value
//             },
//             dataType: "json",
//             async: false,
//             cache: false,
//             success: function(data, textStatus) {
//                 subject = data.subject;
//                 content = data.content;
//             }
//         });

//         if (subject) {
//             alert("제목에 금지단어('"+subject+"')가 포함되어있습니다");
//             f.wr_subject.focus();
//             return false;
//         }

//         if (content) {
//             alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
//             if (typeof(ed_wr_content) != "undefined")
//                 ed_wr_content.returnFalse();
//             else
//                 f.wr_content.focus();
//             return false;
//         }

//         if (document.getElementById("char_count")) {
//             if (char_min > 0 || char_max > 0) {
//                 var cnt = parseInt(check_byte("wr_content", "char_count"));
//                 if (char_min > 0 && char_min > cnt) {
//                     alert("내용은 "+char_min+"글자 이상 쓰셔야 합니다.");
//                     return false;
//                 }
//                 else if (char_max > 0 && char_max < cnt) {
//                     alert("내용은 "+char_max+"글자 이하로 쓰셔야 합니다.");
//                     return false;
//                 }
//             }
//         }

//         <?php echo $captcha_js; // 캡챠 사용시 자바스크립트에서 입력된 캡챠를 검사함  ?>

//         document.getElementById("btn_submit").disabled = "disabled";

//         return true;
//     }
    $(function(){
        $("#datepicker").datepicker(
            { 
            autoClose: true,
            dateFormat: 'yyyy-mm-dd'}
        );
        $('.datepickers-container').css('z-index', 99999999999999);

        $(".add_time").timepicker({
            step: 30,            //시간간격 : 5분
            timeFormat: "H:i"    //시간:분 으로표시
        });
    })
</script>
<?php if($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>

<?php } ?>
