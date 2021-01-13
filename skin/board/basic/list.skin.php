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


$sql = " select * from g5_write_business_title where bo_table = '{$_GET['bo_table']}'";
$result = sql_query($sql);

$sql1 = " SELECT * FROM {$write_table} WHERE wr_title_idx = {$bo_idx} ";
$result1 = sql_query($sql1);
$num = 0;
for($j=1; $row123=sql_fetch_array($result1); $j++) {
    
    $num ++;
}

?>
<!-- 게시판 목록 시작 { -->
<aside id="bo_side">
    <h2 class="aside_nav">사업 공고</h2>
    <?php 
        for($k=1; $row34=sql_fetch_array($result); $k++) {
            $class_get =  $_GET['bo_idx'] == $row34['idx']?"aisde_click":"";
            $title_text = $_GET['bo_idx'] == $row34['idx']? $row34['title'] : "";
            echo '<a class="aside_nav '.$class_get.'" href="'.G5_BBS_URL .'/board.php?bo_table='.$bo_table.'&bo_idx='.$k.'">'.$row34["title"].'</a>';
        }
    ?>
</aside>
<div id="bo_list" >
    <?php 
        $sql = " select * from g5_write_business_title where idx = '{$_GET['bo_idx']}'";
        $result = sql_query($sql);
        $row = sql_fetch_array($result);
    ?>
    

    <!-- 게시판 페이지 정보 및 버튼 시작 { -->
    <div id="bo_btn_top">
        <h1 id=""><?php  echo $row['title']; ?></h1>

        <ul class="btn_bo_user">
            
            <li>
                <fieldset class="bo_sch">
                    <form name="fsearch" method="POST">
                    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
                    <input type="hidden" name="sca" value="<?php echo $sca ?>">
                    <input type="hidden" name="sop" value="and">
                    <input type="hidden" name="sop" value="and">
                    <input type="hidden" name="bo_idx" value="<?= $_GET['bo_idx'] ?>">
                    <input type="hidden" name="sfl" value="wr_subject">
                    <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
                    <div class="sch_bar">
                        <input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" required id="stx" class="sch_input" size="25" maxlength="20" placeholder=" 검색어를 입력해주세요">
                        <button type="submit" value="검색" class="sch_btn"><i class="fa fa-search" aria-hidden="true"></i><span class="sound_only">검색</span></button>
                    </div>
                    </form>
                </fieldset>
            </li>
        	<?php if ($is_admin == 'super') {  ?>
                <li>
                    <a href="<?php echo $write_href ?>&bo_idx=<?= $_GET['bo_idx'] ?><?= $_GET['u_id'] == 1?"&u_id=1" : "" ?>" class="btn_b01 btn" title="글쓰기"><i class="fa fa-pencil" aria-hidden="true"></i><span class="sound_only">글쓰기</span></a>
                </li>
        	<?php }  ?>
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
            <th scope="col">번호</th>
            <th scope="col">제목</th>
            <th scope="col">첨부</th>
            <th scope="col">등록일</th>
            <th scope="col">조회</th>
            <th scope="col">상태</th>
        </tr>
        </thead>
        <tbody>
        <?php
        for ($i=0; $i<count($list); $i++) {
            
        	if ($i%2==0) $lt_class = "even";
            else $lt_class = "";
		?>
        <tr class="<?php if ($list[$i]['is_notice']) echo "bo_notice"; ?> <?php echo $lt_class ?> tr_hover">
            
            <td class="td_idx td_center">
            <?php
                echo $list[$i]['num'];
             ?>
            </td>

            <td class="td_title" style="padding-left:<?php echo $list[$i]['reply'] ? (strlen($list[$i]['wr_reply'])*10) : '0'; ?>px">
                <?php
                if ($is_category && $list[$i]['ca_name']) {
				?>
                <a href="<?php echo $list[$i]['ca_name_href'] ?>" class="bo_cate_link"><?php echo $list[$i]['ca_name'] ?></a>
                <?php } ?>
                <div class="bo_tit">
                    <a href="<?php echo $list[$i]['href'] ?>">
                        <?php echo $list[$i]['icon_reply'] ?>
                        <?php
                            if (isset($list[$i]['icon_secret'])) echo rtrim($list[$i]['icon_secret']);
                         ?>
                        <?php echo $list[$i]['wr_subject'] ?>
                    </a>
                    
                </div>
            </td>
            <td class="td_download td_center">
                <?php if ($list[$i]['wr_file'] > 0) { ?>
                    <i class="fa fa-download" aria-hidden="true"></i>
                    <?php } ?>
            </td>
            <td class="td_datetime td_center"><?php echo $list[$i]['datetime'] ?></td>
            <td class="td_hit td_center"><?php echo $list[$i]['wr_hit'] ?></td>
            <td class="td_end td_center">
                <?php 
                    // echo $list[$i]['name'];
                    $timenow = date("Y-m-d H:i:s"); 
                    $timetarget = $list[$i]['wr_date_end'];
                    $today = date("Ymd");
                    
                    $nDate = date("Y-m-d",time()); // 오늘 날짜를 출력하겠지요?
                    $valDate = $list[$i]['wr_date_end']; // 폼에서 POST로 넘어온 value 값('yyyy-mm-dd' 형식)
                    $leftDate = intval((strtotime($valDate) - strtotime($nDate)) / 86400); // 나머지 날짜값이 나옵니다.
                    

                    if($list[$i]['wr_date_end'] < $nDate) {
                        echo "접수마감";
                        echo "<br>";
                        echo "D-".$leftDate;

                    } else if($list[$i]['wr_date_end'] > $nDate && $nDate > $list[$i]['wr_date_start']) {
                        echo "접수중";
                        echo "<br>";
                        echo "D-".$leftDate;
                    } else if($list[$i]['wr_date_end'] > $nDate && $nDate  < $list[$i]['wr_date_start']) {
                        echo "접수예정";
                        echo "<br>";
                        echo "D-".$leftDate;
                    }



                ?>
            </td>
            

        </tr>
        <?php } ?>
        <?php if (count($list) == 0) { echo '<tr><td colspan="6" class="empty_table">사업공고 내용이 없습니다.</td></tr>'; } ?>
        </tbody>
        </table>
    </form>

    </div>

	<!-- 페이지 -->

    <!-- 현재 URL 주소 -->
    <?php
        $http_host = $_SERVER['HTTP_HOST'];
        $request_uri = $_SERVER['REQUEST_URI'];
        $url = 'http://' . $http_host . $request_uri;
    ?>    
    
    <!-- 총 게시판 -->

    <?php echo get_paging('15', $page, $total_page, $url); ?>
	<!-- 페이지 -->
	
</div>

<?php if($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>
<?php } ?>

<?php if ($is_checkbox) { ?>
<script>
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

    // if(<?php echo $_GET['bo_idx'] == 1? true : false ?> ){
    //     alert('fdsa');
    // }

    // $('.aside_nav').click(function(){
    //     $('.aside_nav').removeClass('.aisde_click');
    //     $(this).addClass('.aisde_click');
    // });

});
</script>
<?php } ?>
<!-- } 게시판 목록 끝 -->
