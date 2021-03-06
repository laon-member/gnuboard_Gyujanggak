<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);

$sql="select * from add_propos where business_idx = '{$_GET['wr_id']}' and mb_id = '{$member['mb_id']}'";
$result=sql_query($sql);
$row=sql_fetch_array($result);

$nowDate = date("Y-m-d H:i:s");

$add_propos_check = $row['date'] >= $nowDate? 'true' : 'false';

// WHERE idx = {$view['wr_title_idx']}
$sql1 = " SELECT * FROM `g5_write_business_title` where bo_table = '{$_GET['bo_table']}'";
$result1 = sql_query($sql1);


?>

<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>

<!-- 게시물 읽기 시작 { -->
    <aside id="bo_side">
    <h2 class="aside_nav_title">사업 공고</h2>
    <?php 
        for($k=1; $row1=sql_fetch_array($result1); $k++) {
            $class_get = $view['wr_title_idx'] == $row1['idx']?"aisde_click":"";
            echo '<a class="aside_nav '.$class_get.'" href="'.G5_BBS_URL .'/board.php?bo_table=business&bo_idx='.$k.'&page=1">'.$row1['title'].'</a>';
           
            if($view['wr_title_idx'] == $row1['idx']){
                $category_title =  $row1['title']; 
            }
        }
    ?>
</aside>
<article id="bo_v">
    <header>
        <div id="bo_btn_top">
            <h1 class="view_title"><?= $category_title ?></h1>
        </div>

        <?php //ob_start(); ?>
        <table id="view_table">
            <thead>
                <tr>
                    <th scope="col" class="view_table_header"colspan="1" style="width:10%;">제목</th>
                    <td scope="col" class="view_table_title td_title" colspan="6" style="width:90%;"> <?php echo cut_str(get_text($view['wr_subject']), 70); // 글제목 출력 ?></td>
                </tr>
                <tr>
                    <th scope="col" class="view_table_header" style="width:10%;">지원기간</th>
                    <td scope="col" class="view_table_text" id="board_date" colspan="2" style="width:40%;"><?= date("Y.m.d H:i", strtotime($view['wr_date_start'])); ?> ~ <?= date("Y.m.d H:i", strtotime($view['wr_date_end'])); ?></td>
                    <th scope="col" class="view_table_header" style="width:10%;">등록일</th>
                    <td scope="col" class="view_table_text" style="width:20%;"><?php echo date("y.m.d", strtotime($view['wr_datetime'])) ?></td>
                    <th scope="col" class="view_table_header" style="width:10%;">조회</th>
                    <td scope="col" class="view_table_text" style="width:10%;"><?php echo number_format($view['wr_hit']) ?></td>
                </tr>

            <?php
                $cnt = 0;
                if ($view['file']['count']) {
                    for ($i=0; $i<count($view['file']); $i++) {
                        if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'] )
                            $cnt++;
                    }
                }
                
            if($cnt) {
                // 가변 파일
                for ($i=0; $i< $view['file']['count']; $i++) {
                    if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'] ) {
                ?>
                    <tr class="">
                        <th scope="col" colspan="1" class="view_table_header" style="width:10%;">첨부파일</th>
                        <td scope="col" colspan="1" class="view_table_text" style="width:10%;">
                            <img src="<?php echo G5_IMG_URL ?>/download_icon.png" alt="<?php echo $config['cf_title']; ?>">
                        </td>
                        <td scope="col" colspan="5" class="view_table_text" style="width:80%;">
                            <a href="<?php echo $view['file'][$i]['href']; ?>" class=""><?= $view['file'][$i]['source'] ?></a>
                        </td>
                    </tr>
                <?php
                    }
                }
            }
            ?>
    
            </thead>
        </table>
        <?php
            // $link_buttons = ob_get_contents();
            // ob_end_flush();
        ?>
    </header>
    
    <section id="bo_v_atc">
        <h2 id="bo_v_atc_title">본문</h2>

        <!-- 본문 내용 시작 { -->
        <div id="bo_v_con"><?php echo nl2br($view['wr_content']); ?></div>
        <!-- } 본문 내용 끝 -->

        <?php if ($is_signature) { ?><p><?php echo $signature ?></p><?php } ?>
    </section>
   
    <?php
    $cnt = 0;
    if ($view['file']['count']) {
        for ($i=0; $i<count($view['file']); $i++) {
            if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'] )
                $cnt++;
        }
    }
    
	?>
    <!-- 첨부파일 시작 { -->
    <section id="bo_v_files" class="td_right">
        <ul class="btn_container text_float text_inline_block">
        <?php if ($prev_href || $next_href) { ?>
            <?php if ($prev_href) { ?>
                <li class=" btn_next_prv" >
                    <a href="<?php echo $prev_href ?>">
                        <span class="nb_tit">
                            <i class="fa fa-chevron-up" aria-hidden="true" style="transform: rotate(-90deg);"></i>
                        </span >
                    이전</a> 
                </li>
            <?php } ?>
            <?php if ($next_href) { ?>
                <li class="btn_next btn_next_prv">
                    <a href="<?php echo $next_href ?>">다음
                        <span class="nb_tit"> 
                            <i class="fa fa-chevron-down" aria-hidden="true" style="transform: rotate(-90deg);"></i>
                        </span>
                    </a>  
                </li>
            <?php } ?>
        <?php } ?>

                <li class="btn_next_prv"><a href="<?php echo G5_BBS_URL ?>/board.php?bo_table=business&bo_idx=<?= $view['wr_title_idx'] ?>" >목록</a></li>
        </ul>
       
        <section id="bus_btn"  class="text_inline_block">
            <a href="<?= G5_BBS_URL ?>/application.php?bo_table=business&bo_idx=<?php echo $view['wr_title_idx']; ?>&wr_id=<?php echo $_GET['wr_id']; ?>" class="btn_next_prv btn_next_prv_link" title="신청하기">신청하기</a>
        </section>
    </section>
    <!-- } 첨부파일 끝 -->
    
</article>
<script>
    $(function(){

        var board_date_start = '<?=  $view['wr_date_start']; ?>';
        var board_date_end = '<?=  $view['wr_date_end']; ?>';

        var board_date_add = <?= $add_propos_check ?>;
        var board_value = <?= $view['value'] ?>;

        var Now = new Date();

        var NowTime = Now.getFullYear();
            NowTime += '-' + ((Now.getMonth() + 1) >= 10? (Now.getMonth() + 1) : '0'+(Now.getMonth() + 1));
            NowTime += '-' + (Now.getDate() >= 10? Now.getDate(): '0'+Now.getDate());
            NowTime += ' ' + Now.getHours();
            NowTime += ':' + Now.getMinutes();

        $('.btn_next_prv_link').click(function(){

            

            if(NowTime > board_date_end || NowTime < board_date_start || board_value > 2){
                if(!board_date_add){
                    alert('접수 기간이 아닙니다.');
                    return false;
                }
            }
        })

    })

</script>

<!-- } 게시글 읽기 끝 -->