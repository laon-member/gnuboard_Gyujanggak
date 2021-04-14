<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);

// WHERE idx = {$view['wr_title_idx']}
$sql1 = " SELECT * FROM `g5_write_business_title` where bo_table = '{$_GET['bo_table']}'";
$result1 = sql_query($sql1);


?>

<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>

<!-- 게시물 읽기 시작 { -->
    <aside id="bo_side">
    <h2 class="aside_nav_title">사업공고 관리</h2>
    <?php 
        for($k=1; $row1=sql_fetch_array($result1); $k++) {
            $class_get = $view['wr_title_idx'] == $row1['idx']?"aisde_click":"";
            echo '<a class="aside_nav '.$class_get.'" href="'.G5_BBS_URL .'/board.app.php?bo_table=business&bo_idx='.$k.'&u_id=1&page=1">'.$row1['title'].'</a>';
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
        <?php ob_start(); ?>
        <table id="view_table">
            <thead>
                <tr>
                    <th scope="col" class="view_table_header"colspan="1" style="width:10%;">제목</th>
                    <td scope="col" class="view_table_title td_title" colspan="6" style="width:90%;"> <?php echo cut_str(get_text($view['wr_subject']), 70); // 글제목 출력 ?></td>
                </tr>
                <tr>
                    <th scope="col" class="view_table_header" style="width:10%;">지원기간</th>
                    <td scope="col" class="view_table_text" colspan="2" style="width:40%;"><?php echo $view['wr_date_start']; ?> ~ <?php echo $view['wr_date_end']; ?></td>
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
            $link_buttons = ob_get_contents();
            ob_end_flush();
        ?>
        <!-- } 게시물 상단 버튼 끝 -->
    </header>
    
    <section id="bo_v_atc">
        <h2 id="bo_v_atc_title">본문</h2>

        <!-- 본문 내용 시작 { -->
            <div id="bo_v_con"><?php echo nl2br($view['wr_content']); ?></div>
        <!-- } 본문 내용 끝 -->

        <?php if ($is_signature) { ?><p><?php echo $signature ?></p><?php } ?>
    </section>
   

   
    <!-- 첨부파일 시작 { -->
    <section id="bo_v_files" class="td_right">
        <ul class="btn_container text_float text_inline_block">
        <?php if ($prev_href || $next_href) { ?>
            <?php if ($prev_href) { ?>
                <li class=" btn_next_prv" >
                    <?php
                        if( $_GET['u_id']==1){
                            $u_id = "u_id=1";
                        }
                    
                    ?>
                    <a href="<?= G5_BBS_URL ?>/board.app.php?bo_table=business&wr_id=<?php echo $prev_href; ?>&u_id=1">
                        <span class="nb_tit">
                            <i class="fa fa-chevron-up" aria-hidden="true" style="transform: rotate(-90deg);"></i>
                        </span >
                    이전</a> 
                </li>
            <?php } ?>
            <?php if ($next_href) { ?>
                <li class="btn_next btn_next_prv">
                    <?php
                        if( $_GET['u_id']==1){
                            $u_id = "u_id=1";
                        }
                    
                    ?>
                    <a href="<?= G5_BBS_URL ?>/board.app.php?bo_table=business&wr_id=<?php echo $next_href; ?>&u_id=1">다음
                        <span class="nb_tit"> 
                            <i class="fa fa-chevron-down" aria-hidden="true" style="transform: rotate(-90deg);"></i>
                        </span>
                    </a>  
                </li>
            <?php } ?>
        <?php } ?>
        </ul>
        <section id="bus_btn "  class="text_inline_block">
            <?php if ($is_admin == 'super') {  ?>
                <a href="<?php echo $write_href ?>&bo_idx=<?= $_GET['bo_idx'] ?>&bo_idx=<?= $view['wr_title_idx'] ?>&w=u&wr_id=<?= $_GET['wr_id'] ?>&u_id=1" class="btn_up_val">수정</a>
                <a href="<?php echo G5_BBS_URL ?>/write_del_business.php?wr_id=<?= $_GET['wr_id'] ?>&bo_idx=<?= $view['wr_title_idx'] ?>" class="btn_del_val">삭제</a>
            <?php } ?>
            <a href="<?php echo G5_BBS_URL ?>/board.app.php?bo_table=business&bo_idx=<?= $view['wr_title_idx'] ?>&page=1&u_id=1" class="btn_next_prv btn_next_prv_link">목록</a>
        </section>
        
    </section>
    <!-- } 첨부파일 끝 -->
    

</article>


<script>
    $(function(){
        $('.btn_del_val').click(function(){
            if(confirm('정말 삭제하시겠습니까')){
                return true;
            } else {
                return false;
            }
        })
    })
</script>

<!-- } 게시글 읽기 끝 -->