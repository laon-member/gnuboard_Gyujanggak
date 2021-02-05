<?php
$sub_menu = "100100";
include_once('./_common.php');



auth_check($auth[$sub_menu], 'r');

if ($is_admin != 'super')
    alert('최고관리자만 접근 가능합니다.');


$g5['title'] = '대시보드';
include_once('./admin.head.php');
$sql = "select * from g5_member ";
$result = sql_query($sql);

$user = 0;
$rater = 0;
$admin = 0;

for($i=0; $i<$row = sql_fetch_array($result); $i++){
    if($row['mb_level'] == 2){
        $user ++;
    } else if($row['mb_level'] == 5){
        $rater ++;
    } else if($row['mb_level'] == 10){
        $admin ++;
    }

}


?>

<div class="admin_board">
    <div class="admin_board_user admin_board_user_flex">
        <div class="user">
            <img src="<?=G5_IMG_URL ?>/admin_user_icon.png" alt="user_icon">
            <div class="admin_member_text">
                <p>지원자</p>
                <p><?= $user ?></p>
            </div>
        </div>
        <div class="user">
            <img src="<?=G5_IMG_URL ?>/admin_rater_icon.png" alt="rater_icon">
            <div class="admin_member_text">
                <p>심사자</p>
                <p><?= $rater ?></p>
            </div>
        </div>
        <div class="user">
            <img src="<?=G5_IMG_URL ?>/admin_admin_icon.png" alt="admin_icon">
            <div class="admin_member_text">
                <p>관리자</p>
                <p><?= $admin ?></p>
            </div>
        </div>
    </div>
    <div class="admin_board_user">
        <?php
            $sql1 = "SELECT * FROM g5_write_notice where notice_table = 7 order by wr_id desc limit 0, 5";
            $result1 = sql_query($sql1);
        ?>
        <ul class="header_notice_nav">
            <?php for($j=1; $notice=sql_fetch_array($result1); $j++) { ?>
                <li class="header_notice_list header_notice_list<?= $j ?>">
                    [공지사항]
                    <span>
                    <?php  if(strlen($notice['wr_subject'], "UTF-8") > 30){
                        echo iconv_substr( $notice['wr_subject'], 0, 30, "utf-8");
                        echo '...';
                    } else {
                        echo $notice['wr_subject'];
                    }
                    ?>
                    </span>
                    <a href="<?= G5_BBS_URL ?>/board.notice.php?bo_idx=<?= $notice['notice_table']; ?>&bo_table=notice&wr_id=<?= $notice['wr_id'] ;?>&bo_title=3&u_id=1">더보기</a>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>
<div class="admin_board">
    <?php 
        $sql = "select * from g5_write_business";
        $result = sql_query($sql);
        
        $going = 0;
        $rating = 0;
        $complete = 0;

        $application = 0;
        $report1 = 0;
        $report2 = 0;
        for($j = 0; $j < $row=sql_fetch_array($result); $j++){
            if($row['value'] == 0){
                $going++;
                $application ++;
            } else if($row['value'] == 1 || $row['value'] == 2 ){
                $rating++;
                $application ++;
                
            } else if($row['value'] == 3){
                if($row['wr_8'] == 0){
                    $going++;
                    $report1 ++;
                } else if($row['wr_8'] == 1 || $row['wr_8'] == 2 ){
                    $rating++;
                    $report1 ++;
                } else if($row['wr_8'] == 3){
                    if($row['wr_9'] == 0){
                        $going++;
                        $report2++;
                    } else if($row['wr_9'] == 1 || $row['wr_9'] == 2 ){
                        $rating++;
                        $report2++;
                    } else if($row['wr_9'] == 3){
                        $complete ++;
                        $report2++;
                    }
                }
            }
        }

        $sql = "select count(*) as cnt from g5_write_business";
        $result = sql_query($sql);
        $row=sql_fetch_array($result);
    ?>
    <div class="admin_board_user admin_score_board">
       <h1>사업공고 현황</h1>
        <div class="admin_score_flex">
            <div class="score_container">
                <p class="score_title">전체</p>
                <div class="score_number color1">
                    <?= $row['cnt'] ?>
                </div>
            </div>
            <div class="score_container">
                <p class="score_title">진행 중</p>
                <div class="score_number color2">
                    <?= $going ?>
                </div>
            </div>
            <div class="score_container">
                <p class="score_title">심사 중</p>
                <div class="score_number color3">
                    <?= $rating ?>
                </div>
            </div>
            <div class="score_container">
                <p class="score_title">완료</p>
                    <div class="score_number color4">  
                    <?= $complete ?>
                </div>
            </div>
        </div>
       
    </div>
    <div class="admin_board_user admin_score_board">
        <h1>사업진행 현황</h1>
        <div class="admin_score_flex">
            <div class="score_container">
                <p class="score_title">선발</p>
                <div class="score_number color1">
                    <?= $application ?>
                </div>
            </div>
            <div class="score_container">
                <p class="score_title">중간보고서</p>
                <div class="score_number color2">
                <?= $report1 ?>
                </div>
            </div>
            <div class="score_container score_container_long">
                <p class="score_title">결과(연차)보고서</p>
                <div class="score_number color3">
                <?= $report2 ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="admin_board">
    <div class="admin_board_user admin_list_board">
        <h1>사업공고 현황 리스트</h1>
        <div class="admin_score_flex">
           <table class="category_list">
               <thead>
                   <tr>
                       <th style="width:8%">NO</th>
                       <th style="width:23%">분야</th>
                       <th style="width:23%">진행 중</th>
                       <th style="width:23%">심사중</th>
                       <th style="width:23%">완료</th>
                   </tr>
               </thead>
               <tbody>
               <?php 
                for($k =1; $k< 7; $k++){

                    $sql = "select * from g5_write_business where wr_title_idx = $k";
                    $result = sql_query($sql);
                    
                    $going = 0;
                    $rating = 0;
                    $complete = 0;

                    $application = 0;
                    $report1 = 0;
                    $report2 = 0;
                    for($j = 0; $j < $row=sql_fetch_array($result); $j++){
                        if($row['value'] == 0){
                            $going++;
                            $application ++;
                        } else if($row['value'] == 1 || $row['value'] == 2 ){
                            $rating++;
                            $application ++;
                            
                        } else if($row['value'] == 3){
                            if($row['wr_8'] == 0){
                                $going++;
                                $report1 ++;
                            } else if($row['wr_8'] == 1 || $row['wr_8'] == 2 ){
                                $rating++;
                                $report1 ++;
                            } else if($row['wr_8'] == 3){
                                if($row['wr_9'] == 0){
                                    $going++;
                                    $report2++;
                                } else if($row['wr_9'] == 1 || $row['wr_9'] == 2 ){
                                    $rating++;
                                    $report2++;
                                } else if($row['wr_9'] == 3){
                                    $complete ++;
                                    $report2++;
                                }
                            }
                        }
                    }

                    $sql11 = "select * from g5_write_business_title where  idx = $k";
                    $result11 = sql_query($sql11);
                    $row11=sql_fetch_array($result11);
                    ?>

                    <tr>
                        <td><?= $k ?></td>
                        <td><?= $row11['title'] ?></td>
                        <td><?= $going == 0? '-' : $going; ?></td>
                        <td><?= $rating == 0? '-' : $rating; ?></td>
                        <td><?= $complete == 0? '-' : $complete; ?></td>
                    </tr>
                    <?php 
                   
                }

                ?>


               </tbody>
           </table>
        </div>
    </div>
    <div class="admin_board_user admin_list_board">
        <h1>사업공고 현황 리스트</h1>
        <div class="admin_score_flex">
           <table class="category_list">
               <thead>
                   <tr>
                       <th style="width:8%">NO</th>
                       <th style="width:23%">분야</th>
                       <th style="width:23%">선발</th>
                       <th style="width:23%">중간보고서</th>
                       <th style="width:23%">결과(연차)보고서</th>
                   </tr>
               </thead>
               <tbody>
               <?php 
                for($k =1; $k< 7; $k++){

                    $sql = "select * from g5_write_business where wr_title_idx = $k";
                    $result = sql_query($sql);
                    
                    $going = 0;
                    $rating = 0;
                    $complete = 0;

                    $application = 0;
                    $report1 = 0;
                    $report2 = 0;
                    for($j = 0; $j < $row=sql_fetch_array($result); $j++){
                        if($row['value'] == 0){
                            $going++;
                            $application ++;
                        } else if($row['value'] == 1 || $row['value'] == 2 ){
                            $rating++;
                            $application ++;
                            
                        } else if($row['value'] == 3){
                            if($row['wr_8'] == 0){
                                $going++;
                                $report1 ++;
                            } else if($row['wr_8'] == 1 || $row['wr_8'] == 2 ){
                                $rating++;
                                $report1 ++;
                            } else if($row['wr_8'] == 3){
                                if($row['wr_9'] == 0){
                                    $going++;
                                    $report2++;
                                } else if($row['wr_9'] == 1 || $row['wr_9'] == 2 ){
                                    $rating++;
                                    $report2++;
                                } else if($row['wr_9'] == 3){
                                    $complete ++;
                                    $report2++;
                                }
                            }
                        }
                    }

                    $sql11 = "select * from g5_write_business_title where  idx = $k";
                    $result11 = sql_query($sql11);
                    $row11=sql_fetch_array($result11);
                    ?>

                    <tr>
                        <td><?= $k ?></td>
                        <td><?= $row11['title'] ?></td>
                        <td><?= $application == 0? '-' : $application; ?></td>
                        <td><?= $report1 == 0? '-' : $report1; ?></td>
                        <td><?= $report2 == 0? '-' : $report2; ?></td>
                    </tr>
                    <?php 
                   
                }

                ?>


               </tbody>
           </table>
        </div>
    </div>
</div>


<?php

include_once ('./admin.tail.php');
?>
