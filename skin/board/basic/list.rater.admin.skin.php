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




// $sql = "  select COUNT(DISTINCT `idx`) as cnt from rater where user_id = '{$member['mb_id']}' and test_id = '{$_GET['bo_idx']}'";
// echo $sql;
// $row11 = sql_fetch($sql);
// $total_count = $row11['cnt'];

// $sql = " select * from rater where user_id = '{$member['mb_id']}' and test_id = '{$_GET['bo_idx']}'";
// $result = sql_query($sql);



// for ($i=0; $i<$row = sql_fetch_array($result); $i++) {

// $sql1 = " SELECT * FROM {$write_table} WHERE wr_title_idx = {$bo_idx} ";
// $result1 = sql_query($sql1);
// $num = 0;
// for($j=1; $row=sql_fetch_array($result1); $j++) {
    
//     $num ++;
// }

?>
<!-- 게시판 목록 시작 { -->
<aside id="bo_side">
    <h2 class="aside_nav_title">심사관리</h2>
   
    <a class="aside_nav <?= $_GET['bo_idx'] == 1?"aisde_click":""; ?>" href="<?= G5_BBS_URL ?>/board.rater.admin.php?bo_table=<?= $bo_table ?>&bo_idx=1&u_id=1">지원자 선발</a>
    <a class="aside_nav <?= $_GET['bo_idx'] == 2?"aisde_click":""; ?>" href="<?= G5_BBS_URL ?>/board.rater.admin.php?bo_table=<?= $bo_table ?>&bo_idx=2&u_id=1">중간보고서</a>
    <a class="aside_nav <?= $_GET['bo_idx'] == 3?"aisde_click":""; ?>" href="<?= G5_BBS_URL ?>/board.rater.admin.php?bo_table=<?= $bo_table ?>&bo_idx=3&u_id=1">결과(연차)보고서</a>
</aside>
<div id="bo_list" >
    <?php 
       
    ?>
    

    <!-- 게시판 페이지 정보 및 버튼 시작 { -->
    <div id="bo_btn_top">
        <?php if($_GET['bo_idx'] == 1){ ?>
           <h1 id="">지원자 선발</h1>
        <?php } else if($_GET['bo_idx'] == 2) {?>
            <h1 id="">중간보고서</h1>
        <?php } else if($_GET['bo_idx'] == 3) {?>
            <h1 id="">결과(연차)보고서</h1>
        <?php } ?>

        <ul class="btn_bo_user">
            <li>
                <?php
                    $http_host = $_SERVER['HTTP_HOST'];
                    $request_uri = $_SERVER['REQUEST_URI'];
                    $url = 'http://' . $http_host . $request_uri;
                
                    $url = preg_replace('#&page=[0-9]*#', '', $url);
                ?>
                <fieldset class="bo_sch_input">
                    <form name="fsearch" method="POST" action="<?= $url?>">
                    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
                    <input type="hidden" name="sca" value="<?php echo $sca ?>">
                    <input type="hidden" name="sop" value="and">
                    <input type="hidden" name="sop" value="and">
                    <input type="hidden" name="bo_idx" value="<?= $_GET['bo_idx'] ?>">
                    <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
                    <select name="sfl" id="sfl">
                        <option value="0" <?= $sfl == "0" ? "selected": ""?>>전체</option>
                        <option value="1" <?= $sfl == "1" ? "selected": ""?>>한국학 연구용역</option>
                        <option value="2" <?= $sfl == "2" ? "selected": ""?>>한국학 저술지원</option>
                        <option value="3" <?= $sfl == "3" ? "selected": ""?>>집중 클러스터</option>
                        <option value="4" <?= $sfl == "4" ? "selected": ""?>>중소규모 집담회</option>
                        <option value="5" <?= $sfl == "5" ? "selected": ""?>>한국학 학술대회</option>
                        <option value="6" <?= $sfl == "6" ? "selected": ""?>>신진학자 초청 교류</option>
                    </select>
                    <div class="sch_bar">
                        <input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" required id="stx" class="sch_input" size="25" maxlength="20" placeholder=" 검색어를 입력해주세요">
                        <button type="submit" value="검색" class="sch_btn"><i class="fa fa-search" aria-hidden="true"></i><span class="sound_only">검색</span></button>
                    </div>
                    </form>
                </fieldset>
            </li>
        </ul>
    </div>
    <!-- } 게시판 페이지 정보 및 버튼 끝 -->
        	
    <div class="tbl_head01 tbl_wrap">
    <form name="fboardlist" id="fboardlist" action="<?php echo G5_BBS_URL; ?>/board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
    
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="sw" value="">
        <table>

        <caption><?php echo $board['bo_subject'] ?> 목록</caption>
        <thead>
        <tr>
            <th scope="col" style="width: 10%;">번호</th>
            <th scope="col" style="width: 15%;">과제번호</th>
            <th scope="col" style="width: 31%;">제목</th>
            <th scope="col" style="width: 22%;">심사위원</th>
            <th scope="col" style="width: 22%;">심사결과</th>
        </tr>
        </thead>
        <tbody>
        <?php
            $sql = "select * from g5_write_business";


            if(!empty($notice_array))
                $sql .= " and wr_id not in (".implode(', ', $notice_array).") ";
            $sql .= " {$sql_order} limit {$from_record}, $page_rows ";
            $result = sql_query($sql);
       
        
        for ($i=0; $i < count($list); $i++) {
            

            if($_GET['bo_idx'] == 1){
                $admin_val = $list[$i]['value'];
            } else if($_GET['bo_idx'] == 2){
                $admin_val = $list[$i]['wr_8'];
            } else if($_GET['bo_idx'] == 3){
                $admin_val = $list[$i]['wr_9'];
            }

		?>
        <tr class="<?php if ($list[$i]['is_notice']) echo "bo_notice"; ?> <?php echo $lt_class ?> tr_hover">
            <td class="td_idx td_center td_info" style="display:none">
                <input type="hidden" id="idx_id" name="us_idx" value ="<?php echo $list[$i]['wr_id']; ?>">
            </td>
            <td class="td_idx td_center">
            <?php
                echo $list[$i]['num'];
             ?>
            </td>

            <td class=" td_center">
                <?= $list[$i]['wr_quest_number'] ?>
            </td>
            <td class="td_title " >
               
                <a href="<?= G5_BBS_URL ?>/board.rater.admin.php?bo_table=<?=$_GET['bo_table']; ?>&wr_idx=<?php echo $list[$i]['wr_id']; ?>&bo_idx=<?= $_GET['bo_idx'] ?>&u_id=1">
                <?php
                    $sql66 = " select * from g5_write_business_title where idx = '{$list[$i]['wr_title_idx']}'";
                    $result66 = sql_query($sql66);
                    $row66 = sql_fetch_array($result66);
                    
                ?>
                    [<?= $row66['title'] ?>]  <?= $list[$i]['wr_subject'] ?>
                </a>

            </td>
            
            <td class="td_datetime td_center">
                <a href="<?= G5_BBS_URL ?>/board.rater.admin.php?bo_table=<?=$_GET['bo_table']; ?>&wr_idx=<?php echo $list[$i]['wr_id']; ?>&bo_idx=<?= $_GET['bo_idx'] ?>&us_idx=<?= $list[$i]['wr_id']; ?>&u_id=1&rater=1" class="value_btn" style="display:inline-block; background:#1F4392">
                  배정
                </a>
                <a href="<?= $action_url ?>?value=2&idx=<?= $list[$i]['wr_id'] ?>&bo_idx=<?= $_GET['bo_idx']; ?>" class="value_btn <?= $admin_val > 0 ?'' : 'value_rater_btn'; ?>" onclick="return <?= $admin_val > 0 ?'false' : 'true'; ?>" style="display:inline-block; background:<?= $admin_val > 0 ? "#ccc" :"#1F4392"; ?>" <?= $admin_val > 0? "disabled" :""; ?>>
                    의뢰
                </a>
            </td>
            <td class="td_datetime td_center">
                <!-- <button type="button" class="value_btn btn_bo_val" style="display:inline-block;vertical-align: top;">선발</button> -->
                <a href="<?= G5_BBS_URL ?>/board.rater.admin.php?bo_table=<?=$_GET['bo_table']; ?>&border_idx=<?php echo $list[$i]['wr_id']; ?>&bo_idx=<?= $_GET['bo_idx'] ?>&u_id=1" class="value_btn" style="display:inline-block; background:#1F4392">
                   선발
                </a>
                <a href="<?= $action_url_value ?>?us_idx=<?= $list[$i]['wr_id'] ?>&bo_idx=<?= $_GET['bo_idx']?>" class="value_btn  <?= $admin_val > 2 ? "" : 'value_admin_btn'; ?>" onclick="return <?= $admin_val > 2 ?'false' : 'true'; ?>"  style="display:inline-block; background:<?= $admin_val > 2 ? "#ccc" :"#1F4392"; ?>" <?= $admin_val > 2? "disabled" :""; ?>>
                   발표
                </a>
            </td>
        </tr>
        <?php } ?>
        <?php if ($total_count == 0) { echo '<tr><td colspan="6" class="empty_table">심사관리 내용이 없습니다.</td></tr>'; } ?>
        </tbody>
        </table>
    </form>
        
    </div>

	
</div>
 <!-- 페이지 -->

 <?php echo $write_pages ?>
	<!-- 페이지 -->
<?php if($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>
<?php } ?>

<?php if ($is_checkbox) { ?>
<script>
function a_event(ev){
    var result = confirm('정말 '+ev+'하시겠습니까?'); 
        
    if(result) {  
        return true;

    } else { 
        return false;
    }
}

function all_checked(sw) {
    var f = document.fboardlist;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]")
            f.elements[i].checked = sw;
    }
}

function fboardlist_submit(f) {
    var chk_count = 0;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked)
            chk_count++;
    }

    if (!chk_count) {
        alert(document.pressed + "할 게시물을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택복사") {
        select_copy("copy");
        return;
    }

    if(document.pressed == "선택이동") {
        select_copy("move");
        return;
    }

    if(document.pressed == "선택삭제") {
        if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다\n\n답변글이 있는 게시글을 선택하신 경우\n답변글도 선택하셔야 게시글이 삭제됩니다."))
            return false;

        f.removeAttribute("target");
        f.action = g5_bbs_url+"/board_list_update.php";
    }

    return true;
}

// 선택한 게시물 복사 및 이동
function select_copy(sw) {
    var f = document.fboardlist;

    if (sw == "copy")
        str = "복사";
    else
        str = "이동";

    var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");

    f.sw.value = sw;
    f.target = "move";
    f.action = g5_bbs_url+"/move.php";
    f.submit();
}

// 게시판 리스트 관리자 옵션
jQuery(function($){
    $(".btn_more_opt.is_list_btn").on("click", function(e) {
        e.stopPropagation();
        $(".more_opt.is_list_btn").toggle();
    });
    $(document).on("click", function (e) {
        if(!$(e.target).closest('.is_list_btn').length) {
            $(".more_opt.is_list_btn").hide();
        }
    });

    $('.value_rater_btn').click(function(){
        var result = confirm('정말 의뢰하시겠습니까?'); 
        
        if(result) {  
            return true;

        } else { 
            return false;
        }

    })
    
    $('.value_admin_btn').click(function(){
        var result = confirm('정말 발표하시겠습니까?'); 
        
        if(result) {  
            return true;

        } else { 
            return false;
        }

    })

});
</script>
<?php } ?>
<!-- } 게시판 목록 끝 -->
