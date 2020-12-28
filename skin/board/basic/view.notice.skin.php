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
    <h2 class="aside_nav">공지상항</h2>
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
                echo '<a class="aside_nav '.$class_get.'" href="'.G5_BBS_URL .'/board.notice.php?bo_table=notice&bo_idx='.$k.'&page=1&bo_title='.$_GET['bo_title'].'">'.$row1['title'].'</a>';
               
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
        <div id="bo_v_top">
            <h1 class="category_title"><?php
                echo $category_title;
             ?></h1>
     
        </div>
        <div class="bo_b_tit_container">
            <span class="bo_v_tit">
                <?php echo cut_str(get_text($view['wr_subject']), 70);  // 글제목 출력 ?>
            </span>
        </div>       
        <div class="profile_info_container">
            <div class="profile_info">
                <ul class="download_file">
                    <?php
                        $cnt = 0;
                        if ($view['file']['count']) {
                            for ($i=0; $i<count($view['file']); $i++) {
                                if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'] && !$view['file'][$i]['view'])
                                    $cnt++;
                            }
                        }
                        
                        if($cnt) {
                        // 가변 파일
                            for ($i=0; $i< $view['file']['count']; $i++) {
                                if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'] && !$view['file'][$i]['view']) {
                        ?>
                                <li class="">
                                    <i class="fa fa-download" aria-hidden="true"></i>
                                    <span class="view_file_download_text"><?php echo $view['file'][$i]['source'] ?></span> 
                                    <a href="<?php echo $view['file'][$i]['href'];  ?>" class="view_file_download btn_next_prv" >다운로드</a>
                                </li>
                        <?php
                            }
                        }
                    }
                    ?>
            
                </ul>
            </div>
            <div class="profile_info">
                <span>등록일 : <?php echo date("y.m.d", strtotime($view['wr_datetime'])) ?></span>
                <span>조회 : <?php echo number_format($view['wr_hit']) ?></span>
            </div>
        </div>
        
     
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
    <section id="bo_v_files ">
        
        <?php if ($prev_href || $next_href) { ?>
        <ul class="btn_container">
            <?php if ($prev_href) { ?>
                <li class=" btn_next_prv" >
                    <a href="../bbs/board.notice.php?bo_idx=<?=$_GET['bo_idx']; ?>&bo_table=notice&wr_id=<?= $prev['wr_id']; ?>&bo_title=<?= $_GET['bo_title']; ?>">
                        <span class="nb_tit">
                            <i class="fa fa-chevron-up" aria-hidden="true" style="transform: rotate(-90deg);"></i>
                        </span >
                    이전글</a> 
                </li>
            <?php } ?>
            <?php if ($next_href) { ?>
                <li class="btn_next btn_next_prv">
                <a href="../bbs/board.notice.php?bo_idx=<?=$_GET['bo_idx']; ?>&bo_table=notice&wr_id=<?= $next['wr_id']; ?>&bo_title=<?= $_GET['bo_title']; ?>">다음글
                        <span class="nb_tit"> 
                            <i class="fa fa-chevron-down" aria-hidden="true" style="transform: rotate(-90deg);"></i>
                        </span>
                    </a>  
                </li>
            <?php } ?>
                <li class="btn_next_prv"><a  href="<?php echo G5_BBS_URL .'/board.notice.php?bo_table=notice&bo_idx='.$_GET['bo_idx'].'&page=1'; ?>&bo_title=<?= $_GET['bo_title']; ?>"  class="btn_list">목록</a></li>
        </ul>
        <?php } ?>
        
    </section>
    <!-- } 첨부파일 끝 -->

    <section id="bus_btn">
        <a href="<?php echo G5_BBS_URL .'/board.notice.php?bo_table=notice&bo_idx='.$_GET['bo_idx'].'&page=1'; ?>&bo_title=<?= $_GET['bo_title']; ?>" class="btn_next_prv btn_next_prv_link">목록보기</a>
    </section>
    
</article>


<script>
<?php if ($board['bo_download_point'] < 0) { ?>
// $(function() {
//     $("a.view_file_download").click(function() {
//         if(!g5_is_member) {
//             alert("다운로드 권한이 없습니다.\n회원이시라면 로그인 후 이용해 보십시오.");
//             return false;
//         }

//         var msg = "파일을 다운로드 하시면 포인트가 차감(<?php echo number_format($board['bo_download_point']) ?>점)됩니다.\n\n포인트는 게시물당 한번만 차감되며 다음에 다시 다운로드 하셔도 중복하여 차감하지 않습니다.\n\n그래도 다운로드 하시겠습니까?";

//         if(confirm(msg)) {
//             var href = $(this).attr("href")+"&js=on";
//             $(this).attr("href", href);

//             return true;
//         } else {
//             return false;
//         }
//     });
// });
<?php } ?>

// function board_move(href)
// {
//     window.open(href, "boardmove", "left=50, top=50, width=500, height=550, scrollbars=1");
// }
</script>

<script>
// $(function() {
//     $("a.view_image").click(function() {
//         window.open(this.href, "large_image", "location=yes,links=no,toolbar=no,top=10,left=10,width=10,height=10,resizable=yes,scrollbars=no,status=no");
//         return false;
//     });

//     // 이미지 리사이즈
//     $("#bo_v_atc").viewimageresize();
// });


</script>
<!-- } 게시글 읽기 끝 -->