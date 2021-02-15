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
    <h2 class="aside_nav_title">
        <?php 
        
            if($_GET['bo_title'] == 1 || $_GET['bo_title'] == 3){
                 echo '자료실';
            } else if( $_GET['bo_title'] == 2){
                echo '공지사항';
            }
        ?>
    </h2>
    <?php 
        if($board_user == 1){
            $board_user_num =9;
        } else if($board_user == 2){
            $board_user_num =8;
        } else if($board_user == 3){
            $board_user_num =10;
        }
        // &u_id=1
        for($k=7; $row1=sql_fetch_array($result1); $k++) {
            if($k < $board_user_num){
                $class_get = $_GET['bo_idx'] == $row1['idx']?"aisde_click":"";
                echo '<a class="aside_nav '.$class_get.'" href="'.G5_BBS_URL .'/board.notice.php?bo_table=notice&bo_idx='.$k.'&page=1&bo_title='.$_GET['bo_title'].$admin_notice.'">'.$row1['title'].'</a>';
               
                if($_GET['bo_idx'] == $row1['idx']){
                    $category_title =  $row1['title']; 
                }
            }
        }

    ?>
</aside>
<article id="bo_v">
    <header>
        <?php ob_start(); ?>
        <!-- 게시물 상단 버튼 시작 { -->
       
        <div id="bo_btn_top">
            <h1 class="view_title"><?= $category_title ?></h1>
        </div>
        <table id="view_table">
            <thead>
                <tr>
                    <th scope="col" class="view_table_header "colspan="1" style="width:10%;">제목</th>
                    <td scope="col" class="view_table_title td_title" colspan="6" style="width:90%;"> <?php echo cut_str(get_text($view['wr_subject']), 70); // 글제목 출력 ?></td>
                </tr>
                <tr>
                    <th scope="col" class="view_table_header" style="width:10%;">작성자</th>
                    <td scope="col" class="view_table_text" colspan="2" style="width:40%;"><?php echo $view['wr_name']; ?></td>
                    <th scope="col" class="view_table_header" style="width:10%;">등록일</th>
                    <td scope="col" class="view_table_text" style="width:20%;"><?php echo date("y.m.d", strtotime($view['wr_datetime'])) ?></td>
                    <th scope="col" class="view_table_header" style="width:10%;">조회</th>
                    <td scope="col" class="view_table_text" style="width:10%;"><?php echo number_format($view['wr_hit']) ?></td>
                </tr>

            <?php
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
        

        <?php
        // // 파일 출력
        // $v_img_count = count($view['file']);
        // if($v_img_count) {
        //     echo "<div id=\"bo_v_img\">\n";

        //     for ($i=0; $i<=count($view['file']); $i++) {
        //         echo get_file_thumbnail($view['file'][$i]);
        //     }

        //     echo "</div>\n";
      
        // }
         ?>

        <!-- 본문 내용 시작 { -->
        <div id="bo_v_con"><?php echo get_view_thumbnail($view['content']); ?></div>
        <?php //echo $view['rich_content']; // {이미지:0} 과 같은 코드를 사용할 경우 ?>
        <!-- } 본문 내용 끝 -->

        <?php if ($is_signature) { ?><p><?php echo $signature ?></p><?php } ?>


      
    </section>
    
    <!-- 첨부파일 시작 { -->
    <section id="bo_v_files " class="td_right">
        <ul class="btn_container text_float">
            <?php if ($prev_href || $next_href) { ?>
                <?php if ($prev_href) { ?>
                    <li class=" btn_next_prv" >
                        <a href="<?= G5_BBS_URL ?>/board.notice.php?bo_idx=<?=$_GET['bo_idx']; ?>&bo_table=notice&wr_id=<?= $prev['wr_id']; ?>&bo_title=<?= $_GET['bo_title']; ?><?= $admin_notice ?>">
                            <span class="nb_tit">
                                <i class="fa fa-chevron-up" aria-hidden="true" style="transform: rotate(-90deg);"></i>
                            </span >
                            이전
                        </a> 
                    </li>
                <?php } ?>
                <?php if ($next_href) { ?>
                    <li class="btn_next btn_next_prv">
                        <a href="<?= G5_BBS_URL ?>/board.notice.php?bo_idx=<?=$_GET['bo_idx']; ?>&bo_table=notice&wr_id=<?= $next['wr_id']; ?>&bo_title=<?= $_GET['bo_title']; ?><?= $admin_notice ?>">
                        다음
                        <span class="nb_tit"> 
                            <i class="fa fa-chevron-down" aria-hidden="true" style="transform: rotate(-90deg);"></i>
                        </span>
                    </a>  
                    </li>
                <?php } ?>
            <?php } ?>
            

               
            </ul>
        
            <section id="bus_btn text_inline_block" >
            <?php if ($is_admin == 'super' && $_GET['bo_title'] == 3) {  ?>
            <a href="<?= G5_BBS_URL ?>/write_notice.php?bo_table=notice&bo_idx=<?= $_GET['bo_idx'] ?>&w=u&wr_id=<?= $_GET['wr_id'] ?>&bo_title=3&u_id=1" class="btn_up_val">수정</a>
            <a href="<?php echo G5_BBS_URL ?>/write_del.php?wr_id=<?= $_GET['wr_id'] ?>&bo_idx=<?= $_GET['bo_idx'] ?>" class="btn_del_val">삭제</a>
            <?php } ?>

            <a href="<?php echo G5_BBS_URL .'/board.notice.php?bo_table=notice&bo_idx='.$_GET['bo_idx'].'&page=1'; ?>&bo_title=<?= $_GET['bo_title']; ?><?= $admin_notice ?>" class="btn_next_prv btn_next_prv_link">목록보기</a>
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