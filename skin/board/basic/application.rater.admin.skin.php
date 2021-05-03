<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
    
$sql1 = " SELECT * FROM `g5_business_propos` where idx = '{$_GET['us_idx']}'";
$result1 = sql_query($sql1);
$row=sql_fetch_array($result1);

$sql1 = " SELECT * FROM `g5_write_business` where wr_id = '{$_GET['wr_idx']}'";
$result1 = sql_query($sql1);
$row22=sql_fetch_array($result1);

$sql1 = " SELECT * FROM `g5_write_business_title` where idx = '{$row['bo_title_idx']}'";
$result1 = sql_query($sql1);
$row33=sql_fetch_array($result1);

$category_title = "[".$row33['title']."]".$row22['wr_subject'];
?>
<aside id="bo_side">
    <h2 class="aside_nav_title">심사 관리</h2>
   
    <a class="aside_nav <?= $_GET['bo_idx'] == 1?"aisde_click":""; ?>" href="<?= G5_BBS_URL ?>/board.rater.admin.php?bo_table=<?= $bo_table ?>&bo_idx=1&u_id=1">지원자 선발</a>
    <a class="aside_nav <?= $_GET['bo_idx'] == 2?"aisde_click":""; ?>" href="<?= G5_BBS_URL ?>/board.rater.admin.php?bo_table=<?= $bo_table ?>&bo_idx=2&u_id=1">중간보고서</a>
    <a class="aside_nav <?= $_GET['bo_idx'] == 3?"aisde_click":""; ?>" href="<?= G5_BBS_URL ?>/board.rater.admin.php?bo_table=<?= $bo_table ?>&bo_idx=3&u_id=1">결과(연차)보고서</a>
</aside>
<?php if ($row['bo_title_idx'] == 1) {  ?>
    <section id="bo_v" style="width:80%;">
        <h2 class="sound_only"><?php echo $g5['title'] ?></h2>
        <!-- 게시물 작성/수정 시작 { -->
        <form name="fwrite" id="fwrite" action="<?php echo $action_url; ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" style="width:<?php echo $width; ?>">
        <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
        <input type="hidden" name="w" value="<?php echo $w ?>">
        <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
        <input type="hidden" name="wr_id" value="<?php echo $_GET['wr_id'] != "" ? $_GET['wr_id'] : $_POST['wr_id']; ?>">
        <input type="hidden" name="sca" value="<?php echo $sca ?>">
        <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
        <input type="hidden" name="stx" value="<?php echo $stx ?>">
        <input type="hidden" name="spt" value="<?php echo $spt ?>">
        <input type="hidden" name="sst" value="<?php echo $sst ?>">
        <input type="hidden" name="sod" value="<?php echo $sod ?>">
        <input type="hidden" name="page" value="<?php echo $page ?>">
        <input type="hidden" name="bo_idx" value="<?php echo $_GET['bo_idx'] ?>">
        <input type="hidden" id="date_value"  name="date_value" value="<?php echo $row22['value'] ?>">
        
            <div class="bo_w_tit write_div">
                <div id="bo_btn_top_app">
                    <h1 class="view_title"><?=  $category_title ?></h1>
                </div>
            </div>



            <table class="view_table_app">
                <thead>
                    <tr>
                        <th scope="col" class="view_table_header"colspan="1" style="width: 10%;">제목</th>
                        <td scope="col" class="view_table_title" colspan="8" style="width: 90%;">
                            <input type="text" name="title_view" id="title_view"  class="input_text " placeholder="제목" value="<?= $row22['wr_subject']; ?>"  readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" style="width: 10%;">접수번호</th>
                        <td scope="col" class="view_table_text" colspan="4" style="width: 40%;">
                        <input type="text" name="info_number_view" id="info_number_view"  class="input_text" placeholder="접수 완료시 자동부여됩니다."  value="<?= $row['info_number']; ?>" readonly>
                        </td>
                        <th scope="col" class="view_table_header" style="width: 10%;">과제번호</th>
                        <td scope="col" class="view_table_text" colspan="4" style="width: 40%;">
                        <input type="text" name="quest_number_view" id="quest_number_view"  class="input_text" placeholder="선발 후 부여됩니다" value="<?= $row['quest_number']; ?>" readonly>
                        </td>
                    </tr>
                </thead>
                <tbody id="input_file_cont">
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">연구과제명</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >과제명(국문)</th>
                        <td scope="col" class="view_table_text" colspan="8" >
                        <input type="text" name="ko_title_view" id="ko_title_view"  class="input_text" placeholder="과제명(국문)"  value="<?= $row['ko_title']; ?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >과제명(영문)</th>
                        <td scope="col" class="view_table_text" colspan="8" >
                        <input type="text" name="en_title_view" id="en_title_view"  class="input_text" placeholder="과제명(영문)"  value="<?= $row['en_title']; ?>" readonly>
                        </td>
                    </tr>
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">연구책임자</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >성명</th>
                        <td scope="col" class="view_table_text" colspan="4" >
                        <input type="text" name="name_view" id="name_view"  class="input_text" placeholder="성명"  value="<?= $row['name']; ?>" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" >전공(학위)</th>
                        <td scope="col" class="view_table_text" colspan="3" >
                        <input type="text" name="degree_view" id="degree_view"  class="input_text" placeholder="전공(학위)"  value="<?= $row['degree']; ?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >소속</th>
                        <td scope="col" class="view_table_text" colspan="4" >
                        <input type="text" name="belong_view" id="belong_view"  class="input_text" placeholder="소속"  value="<?= $row['belong']; ?>" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" >직급</th>
                        <td scope="col" class="view_table_text" colspan="3" >
                        <input type="text" name="rank_view" id="rank_view"  class="input_text" placeholder="직급"  value="<?= $row['rank']; ?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >이메일</th>
                        <td scope="col" class="view_table_text" colspan="4" >
                        <input type="text" name="email_view" id="email_view"  class="input_text" placeholder="이메일"  value="<?= $row['email']; ?>" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" >전화</th>
                        <td scope="col" class="view_table_text" colspan="3" >
                        <input type="text" name="phone_view" id="phone_view"  class="input_text" placeholder="전화"  value="<?= $row['phone']; ?>" readonly>
                        </td>
                    </tr>
                
                    <tr>
                        <th scope="col" class="view_table_header" >공동연구원</th>
                        <td scope="col" class="view_table_text" colspan="4" >
                        <input type="text" name="main_member_view" id="main_member_view"  class="input_text" placeholder="명" value="<?= number_format($row['main_member']); ?>명" readonly>
                        </td>
                        <th scope="col" class="view_table_header" >연구원보조</th>
                        <td scope="col" class="view_table_text" colspan="3" >
                        <input type="text" name="sub_member_view" id="sub_member_view"  class="input_text" placeholder="명" value="<?= number_format($row['sub_member']); ?>명" readonly>
                        </td>
                    </tr>
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">연구정보</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >연구비신청액</th>
                        <td scope="col" class="view_table_text" colspan="8" >
                        <input type="text" name="money_view" id="money_view"  class="input_text" placeholder="연구비신청액"  value="<?= number_format($row['money']); ?>원" readonly>
                        </td>
                    </tr>
                    
                <tbody id="view_table_upload">
                <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">자료 첨부</th>
                    </tr>
                         <?php 

                        $sql2 = " select * from g5_board_file where bo_table = 'g5_business_propos' and wr_id = '{$row['idx']}' and bf_user_type = 0";
                        $result2 = sql_query($sql2);    

                        // 가변 파일
                            for ($i=0; $row_list2 = sql_fetch_array($result2); $i++) {
                                if (isset($row_list2['bf_source'][$i])) {
                        ?>
                                <tr class="">
                                    <th scope="col" colspan="1" class="view_table_header" style="width:10%;">첨부파일</th>
                                    <td scope="col" colspan="1" class="view_table_text" style="width:10%;">
                                        <img src="<?php echo G5_IMG_URL ?>/download_icon.png" alt="<?php echo $config['cf_title']; ?>">
                                    </td>
                                    <td scope="col" colspan="6" class="view_table_text" style="width:80%;">
                                        <a href="<?= G5_BBS_URL ?>/download.php?bo_table=g5_business_propos&wr_id=<?= $row_list2['wr_id'] ?>&no=<?= $row_list2['bf_no'] ?>" class=""><?= $row_list2['bf_source'] ?></a>
                                    </td>
                                </tr>
                        <?php
                                }
                            }
                        ?>
                </tbody>
                <tbody id="view_table_upload">
                <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">심사자용 자료 첨부(인적사항 무기입)</th>
                    </tr>
                         <?php 

                        $sql2 = " select * from g5_board_file where bo_table = 'g5_business_propos' and wr_id = '{$row['idx']}' and bf_user_type = 1";
                        $result2 = sql_query($sql2);    

                        // 가변 파일
                            for ($i=0; $row_list2 = sql_fetch_array($result2); $i++) {
                                if (isset($row_list2['bf_source'][$i])) {
                        ?>
                                <tr class="">
                                    <th scope="col" colspan="1" class="view_table_header" style="width:10%;">첨부파일</th>
                                    <td scope="col" colspan="1" class="view_table_text" style="width:10%;">
                                        <img src="<?php echo G5_IMG_URL ?>/download_icon.png" alt="<?php echo $config['cf_title']; ?>">
                                    </td>
                                    <td scope="col" colspan="6" class="view_table_text" style="width:80%;">
                                        <a href="<?= G5_BBS_URL ?>/download.php?bo_table=g5_business_propos&wr_id=<?= $row_list2['wr_id'] ?>&no=<?= $row_list2['bf_no'] ?>" class=""><?= $row_list2['bf_source'] ?></a>
                                    </td>
                                </tr>
                                <?php
                                }
                            }
                        ?>
                </tbody>
            </table>

            <div class="btn_confirm write_div btn-cont td_right">
            <a href="javascript:history.back();" class="btn_submit btn btn_step4 text_inline_block" style="display:inlin_block">확인</a>
        </div>
        </form>
    </section>

<?php } else if ($row['bo_title_idx'] == 2) { ?>
    <section id="bo_v" style="width:80%;">
        <h2 class="sound_only"><?php echo $g5['title'] ?></h2>
        <!-- 게시물 작성/수정 시작 { -->
        <form name="fwrite" id="fwrite" action="<?php echo $action_url; ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" style="width:<?php echo $width; ?>">
        <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
        <input type="hidden" name="w" value="<?php echo $w ?>">
        <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
        <input type="hidden" name="wr_id" value="<?php echo $_GET['wr_id'] != "" ? $_GET['wr_id'] : $_POST['wr_id']; ?>">
        <input type="hidden" name="sca" value="<?php echo $sca ?>">
        <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
        <input type="hidden" name="stx" value="<?php echo $stx ?>">
        <input type="hidden" name="spt" value="<?php echo $spt ?>">
        <input type="hidden" name="sst" value="<?php echo $sst ?>">
        <input type="hidden" name="sod" value="<?php echo $sod ?>">
        <input type="hidden" name="page" value="<?php echo $page ?>">
        <input type="hidden" name="bo_idx" value="<?php echo $_GET['bo_idx'] ?>">
        <input type="hidden" id="date_value"  name="date_value" value="<?php echo $row22['value'] ?>">
        
            <div class="bo_w_tit write_div">
                <div id="bo_btn_top_app">
                    <h1 class="view_title"><?=  $category_title ?></h1>
                </div>
            </div>

            <table class="view_table_app">
                <thead>
                    <tr>
                        <th scope="col" class="view_table_header"colspan="1" style="width: 12%;">제목</th>
                        <td scope="col" class="view_table_title" colspan="8" style="width: 88%;">
                            <input type="text" name="title_view" id="title_view"  class="input_text " placeholder="제목" value="<?= $row22['wr_subject']; ?>"  readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" style="width: 10%;">접수번호</th>
                        <td scope="col" class="view_table_text" colspan="4" style="width: 40%;">
                        <input type="text" name="info_number_view" id="info_number_view"  class="input_text" placeholder="접수 완료시 자동부여됩니다."  value="<?= $row['info_number']; ?>"  readonly>
                        </td>
                        <th scope="col" class="view_table_header" style="width: 10%;">과제번호</th>
                        <td scope="col" class="view_table_text" colspan="4" style="width: 40%;">
                        <input type="text" name="quest_number_view" id="quest_number_view"  class="input_text" placeholder="선발 후 부여됩니다" value="<?= $row['quest_number']; ?>" readonly>
                        </td>
                    </tr>
                </thead>
                <tbody id="input_file_cont">
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">연구과제명</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >과제명(국문)</th>
                        <td scope="col" class="view_table_text" colspan="8" >
                        <input type="text" name="ko_title_view" id="ko_title_view"  class="input_text" placeholder="과제명(국문)" value="<?= $row['ko_title']; ?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >과제명(영문)</th>
                        <td scope="col" class="view_table_text" colspan="8" >
                        <input type="text" name="en_title_view" id="en_title_view"  class="input_text" placeholder="과제명(영문)" value="<?= $row['en_title']; ?>" readonly>
                        </td>
                    </tr>
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">연구책임자</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >성명</th>
                        <td scope="col" class="view_table_text" colspan="4" >
                        <input type="text" name="name_view" id="name_view"  class="input_text" placeholder="성명" value="<?= $row['name']; ?>" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" >전공(학위)</th>
                        <td scope="col" class="view_table_text" colspan="3" >
                        <input type="text" name="degree_view" id="degree_view"  class="input_text" placeholder="전공(학위)" value="<?= $row['degree']; ?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >소속</th>
                        <td scope="col" class="view_table_text" colspan="4" >
                        <input type="text" name="belong_view" id="belong_view"  class="input_text" placeholder="소속" value="<?= $row['belong']; ?>" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" >직급</th>
                        <td scope="col" class="view_table_text" colspan="3" >
                        <input type="text" name="rank_view" id="rank_view"  class="input_text" placeholder="직급" value="<?= $row['rank']; ?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >이메일</th>
                        <td scope="col" class="view_table_text" colspan="4" >
                        <input type="text" name="email_view" id="email_view"  class="input_text" placeholder="이메일" value="<?= $row['email']; ?>" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" >전화</th>
                        <td scope="col" class="view_table_text" colspan="3" >
                        <input type="text" name="phone_view" id="phone_view"  class="input_text" placeholder="전화" value="<?= $row['phone']; ?>" readonly>
                        </td>
                    </tr>
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">연구참여자</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" >공동연구원<br>연구책임자 제외</th>
                        <td scope="col" class="view_table_text" colspan="4" >
                        <input type="text" name="main_member_view" id="main_member_view"  class="input_text" placeholder="명" value="<?= number_format($row['main_member']); ?>명" readonly>
                        </td>
                        <th scope="col" class="view_table_header" >연구원보조</th>
                        <td scope="col" class="view_table_text" colspan="3" >
                        <input type="text" name="sub_member_view" id="sub_member_view"  class="input_text" placeholder="명" value="<?=number_format( $row['sub_member']); ?>명" readonly>
                        </td>
                    </tr>
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">연구정보</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >연구비신청액</th>
                        <td scope="col" class="view_table_text" colspan="8" >
                        <input type="text" name="money_view" id="money_view"  class="input_text" placeholder="연구비신청액" value="<?= number_format($row['money']); ?>원" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >1차년 연구비</th>
                        <td scope="col" class="view_table_text" colspan="4" style=" width:40%">
                        <input type="text" name="one_year_view" id="one_year_view"  class="input_text" placeholder="1차년 연구비" value="<?= number_format($row['one_year']); ?>원" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" >2차년 연구비</th>
                        <td scope="col" class="view_table_text" colspan="3" >
                            <input type="text" name="two_year_view" id="two_year_view"  class="input_text" placeholder="2차년 연구비" value="<?= number_format($row['two_year']); ?>원" readonly>
                        </td>
                    </tr>
                    
                </tbody>
                <tbody id="view_table_upload">
                <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">자료 첨부</th>
                    </tr>
                         <?php 

                        $sql2 = " select * from g5_board_file where bo_table = 'g5_business_propos' and wr_id = '{$row['idx']}' and bf_user_type = 0";
                        $result2 = sql_query($sql2);    

                        // 가변 파일
                            for ($i=0; $row_list2 = sql_fetch_array($result2); $i++) {
                                if (isset($row_list2['bf_source'][$i])) {
                        ?>
                                <tr class="">
                                    <th scope="col" colspan="1" class="view_table_header" style="width:10%;">첨부파일</th>
                                    <td scope="col" colspan="1" class="view_table_text" style="width:10%;">
                                        <img src="<?php echo G5_IMG_URL ?>/download_icon.png" alt="<?php echo $config['cf_title']; ?>">
                                    </td>
                                    <td scope="col" colspan="6" class="view_table_text" style="width:80%;">
                                        <a href="<?= G5_BBS_URL ?>/download.php?bo_table=g5_business_propos&wr_id=<?= $row_list2['wr_id'] ?>&no=<?= $row_list2['bf_no'] ?>" class=""><?= $row_list2['bf_source'] ?></a>
                                    </td>
                                </tr>
                        <?php
                                }
                            }
                        ?>
                </tbody>
                <tbody id="view_table_upload">
                <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">심사자용 자료 첨부(인적사항 무기입)</th>
                    </tr>
                         <?php 

                        $sql2 = " select * from g5_board_file where bo_table = 'g5_business_propos' and wr_id = '{$row['idx']}' and bf_user_type = 1";
                        $result2 = sql_query($sql2);    

                        // 가변 파일
                            for ($i=0; $row_list2 = sql_fetch_array($result2); $i++) {
                                if (isset($row_list2['bf_source'][$i])) {
                        ?>
                                <tr class="">
                                    <th scope="col" colspan="1" class="view_table_header" style="width:10%;">첨부파일</th>
                                    <td scope="col" colspan="1" class="view_table_text" style="width:10%;">
                                        <img src="<?php echo G5_IMG_URL ?>/download_icon.png" alt="<?php echo $config['cf_title']; ?>">
                                    </td>
                                    <td scope="col" colspan="6" class="view_table_text" style="width:80%;">
                                        <a href="<?= G5_BBS_URL ?>/download.php?bo_table=g5_business_propos&wr_id=<?= $row_list2['wr_id'] ?>&no=<?= $row_list2['bf_no'] ?>" class=""><?= $row_list2['bf_source'] ?></a>
                                    </td>
                                </tr>
                                <?php
                                }
                            }
                        ?>
                </tbody>
            </table>

            <div class="btn_confirm write_div btn-cont td_right">
            <a href="javascript:history.back();" class="btn_submit btn btn_step4 text_inline_block" style="display:inlin_block">확인</a>
        </div>
        </form>
    </section>
  
<?php } else if ($row['bo_title_idx'] == 3) { ?>
    <section id="bo_v" style="width:80%;">
        <h2 class="sound_only"><?php echo $g5['title'] ?></h2>
        <!-- 게시물 작성/수정 시작 { -->
        <form name="fwrite" id="fwrite" action="<?php echo $action_url; ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" style="width:<?php echo $width; ?>">
        <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
        <input type="hidden" name="w" value="<?php echo $w ?>">
        <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
        <input type="hidden" name="wr_id" value="<?php echo $_GET['wr_id'] != "" ? $_GET['wr_id'] : $_POST['wr_id']; ?>">
        <input type="hidden" name="sca" value="<?php echo $sca ?>">
        <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
        <input type="hidden" name="stx" value="<?php echo $stx ?>">
        <input type="hidden" name="spt" value="<?php echo $spt ?>">
        <input type="hidden" name="sst" value="<?php echo $sst ?>">
        <input type="hidden" name="sod" value="<?php echo $sod ?>">
        <input type="hidden" name="page" value="<?php echo $page ?>">
        <input type="hidden" name="bo_idx" value="<?php echo $_GET['bo_idx'] ?>">
        <input type="hidden" id="date_value"  name="date_value" value="<?php echo $row22['value'] ?>">
        
            <div class="bo_w_tit write_div">
                <div id="bo_btn_top_app">
                    <h1 class="view_title"><?=  $category_title ?></h1>
                </div>
            </div>



            <table class="view_table_app">
                <thead>
                    <tr>
                        <th scope="col" class="view_table_header"colspan="1" style="width: 10%;">제목</th>
                        <td scope="col" class="view_table_title" colspan="8" style="width: 90%;">
                            <input type="text" name="title_view" id="title_view"  class="input_text " placeholder="제목" value="<?= $row22['wr_subject']; ?>"  readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" style="width: 10%;">접수번호</th>
                        <td scope="col" class="view_table_text" colspan="4" style="width: 40%;">
                        <input type="text" name="info_number_view" id="info_number_view"  class="input_text" placeholder="접수 완료시 자동부여됩니다." value="<?= $row['info_number']; ?>"  readonly>
                        </td>
                        <th scope="col" class="view_table_header" style="width: 10%;">과제번호</th>
                        <td scope="col" class="view_table_text" colspan="4" style="width: 40%;">
                        <input type="text" name="quest_number_view" id="quest_number_view"  class="input_text" placeholder="선발 후 부여됩니다" value="<?= $row['quest_number']; ?>" readonly>
                        </td>
                    </tr>
                </thead>
                <tbody id="input_file_cont">
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">연구과제명</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >과제명(국문)</th>
                        <td scope="col" class="view_table_text" colspan="8" >
                        <input type="text" name="ko_title_view" id="ko_title_view"  class="input_text" placeholder="과제명(국문)" value="<?= $row['ko_title']; ?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >과제명(영문)</th>
                        <td scope="col" class="view_table_text" colspan="8" >
                        <input type="text" name="en_title_view" id="en_title_view"  class="input_text" placeholder="과제명(영문)" value="<?= $row['en_title']; ?>" readonly>
                        </td>
                    </tr>
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">집단회 개최</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" >소속 기관</th>
                        <td scope="col" class="view_table_text" colspan="8" >
                        <input type="text" name="meeting_agency_view" id="meeting_agency_view"  class="input_text" placeholder="" value="<?= $row['meeting_agency']; ?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" >개최장소</th>
                        <td scope="col" class="view_table_text" colspan="4" >
                        <input type="text" name="meeting_venue_view" id="meeting_venue_view"  class="input_text" placeholder="" value="<?= $row['meeting_venue']; ?>" readonly>
                        </td>
                        <th scope="col" class="view_table_header" >집담회 규모(인원)</th>
                        <td scope="col" class="view_table_text" colspan="3" >
                        <input type="text" name="meeting_scale_view" id="meeting_scale_view"  class="input_text" placeholder="명" value="<?= number_format($row['meeting_scale']); ?>명" readonly>
                        </td>
                    </tr>
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">책임자현황</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >성명</th>
                        <td scope="col" class="view_table_text" colspan="4" >
                        <input type="text" name="normal_manager_name_view" id="normal_manager_name_view"  class="input_text" placeholder="성명" value="<?= $row['normal_manager_name']; ?>" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" >전공(학위)</th>
                        <td scope="col" class="view_table_text" colspan="3" >
                        <input type="text" name="normal_manager_degree_view" id="normal_manager_degree_view"  class="input_text" placeholder="전공(학위)" value="<?= $row['normal_manager_degree']; ?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >소속</th>
                        <td scope="col" class="view_table_text" colspan="4" >
                        <input type="text" name="normal_manager_belong_view" id="normal_manager_belong_view"  class="input_text" placeholder="소속" value="<?= $row['normal_manager_belong']; ?>" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" >직급</th>
                        <td scope="col" class="view_table_text" colspan="3" >
                        <input type="text" name="normal_manager_rank_view" id="normal_manager_rank_view"  class="input_text" placeholder="직급" value="<?= $row['normal_manager_rank']; ?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >이메일</th>
                        <td scope="col" class="view_table_text" colspan="4" >
                        <input type="text" name="normal_manager_email_view" id="normal_manager_email_view"  class="input_text" placeholder="이메일" value="<?= $row['normal_manager_email']; ?>" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" >전화</th>
                        <td scope="col" class="view_table_text" colspan="3" >
                        <input type="text" name="normal_manager_phone_view" id="normal_manager_phone_view"  class="input_text" placeholder="전화" value="<?= $row['normal_manager_phone']; ?>" readonly>
                        </td>
                    </tr>
                
                    
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">소속기관 현황</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1">소속기관</th>
                        <td scope="col" class="view_table_text" colspan="8" >
                            <input type="text" name="belong_agency_view" id="belong_agency_view" placeholder=""  class="input_text"  value="<?= $row['belong_agency']; ?>" readonly>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="col" class="view_table_header" rowspan="3">소속기관</th>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%">성명</th>
                        <td scope="col" class="view_table_text" colspan="3" >
                        <input type="text" name="agency_name_view" id="agency_name_view"  class="input_text" placeholder="성명" value="<?= $row['agency_name']; ?>" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%">전공(학위)</th>
                        <td scope="col" class="view_table_text" colspan="4" >
                        <input type="text" name="agency_degree_view" id="agency_degree_view"  class="input_text" placeholder="전공(학위)" value="<?= $row['agency_degree']; ?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%">소속</th>
                        <td scope="col" class="view_table_text" colspan="3" >
                        <input type="text" name="agency_belong_view" id="agency_belong_view"  class="input_text" placeholder="소속" value="<?= $row['agency_belong']; ?>" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%">직급</th>
                        <td scope="col" class="view_table_text" colspan="4" >
                        <input type="text" name="agency_rank_view" id="agency_rank_view"  class="input_text" placeholder="직급" value="<?= $row['agency_rank']; ?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%">이메일</th>
                        <td scope="col" class="view_table_text" colspan="3" >
                        <input type="text" name="agency_email_view" id="agency_email_view"  class="input_text" placeholder="이메일" value="<?= $row['agency_email']; ?>" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%">전화</th>
                        <td scope="col" class="view_table_text" colspan="4" >
                        <input type="text" name="agency_phone_view" id="agency_phone_view"  class="input_text" placeholder="전화" value="<?= $row['agency_phone']; ?>" readonly>
                        </td>
                    </tr>
                    
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">연구정보</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1">연구비신청액</th>
                        <td scope="col" class="view_table_text " colspan="7" >
                            <input type="text" name="money_view" id="money_view"  class="input_text  money" placeholder="숫자만 기재 (원)" value="<?= number_format($row['money']); ?>원" readonly>
                        </td>
                    </tr>

                   
                </tbody>
                <tbody id="view_table_upload">
                <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">자료 첨부</th>
                    </tr>
                         <?php 

                        $sql2 = " select * from g5_board_file where bo_table = 'g5_business_propos' and wr_id = '{$row['idx']}' and bf_user_type = 0";
                        $result2 = sql_query($sql2);    

                        // 가변 파일
                            for ($i=0; $row_list2 = sql_fetch_array($result2); $i++) {
                                if (isset($row_list2['bf_source'][$i])) {
                        ?>
                                <tr class="">
                                    <th scope="col" colspan="1" class="view_table_header" style="width:10%;">첨부파일</th>
                                    <td scope="col" colspan="1" class="view_table_text" style="width:10%;">
                                        <img src="<?php echo G5_IMG_URL ?>/download_icon.png" alt="<?php echo $config['cf_title']; ?>">
                                    </td>
                                    <td scope="col" colspan="6" class="view_table_text" style="width:80%;">
                                        <a href="<?= G5_BBS_URL ?>/download.php?bo_table=g5_business_propos&wr_id=<?= $row_list2['wr_id'] ?>&no=<?= $row_list2['bf_no'] ?>" class=""><?= $row_list2['bf_source'] ?></a>
                                    </td>
                                </tr>
                                <?php
                                }
                            }
                        ?>
                </tbody>
            </table>
            <div class="btn_confirm write_div btn-cont td_right">
                <a href="javascript:history.back();" class="btn_submit btn btn_step4 text_inline_block" style="display:inlin_block">확인</a>
            </div>
        
        </form>
    </section>
   
<?php } else if ($row['bo_title_idx'] == 4) { ?>
    <section id="bo_v" style="width:80%;">
        <h2 class="sound_only"><?php echo $g5['title'] ?></h2>
        <!-- 게시물 작성/수정 시작 { -->
        <form name="fwrite" id="fwrite" action="<?php echo $action_url; ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" style="width:<?php echo $width; ?>">
        <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
        <input type="hidden" name="w" value="<?php echo $w ?>">
        <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
        <input type="hidden" name="wr_id" value="<?php echo $_GET['wr_id'] != "" ? $_GET['wr_id'] : $_POST['wr_id']; ?>">
        <input type="hidden" name="sca" value="<?php echo $sca ?>">
        <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
        <input type="hidden" name="stx" value="<?php echo $stx ?>">
        <input type="hidden" name="spt" value="<?php echo $spt ?>">
        <input type="hidden" name="sst" value="<?php echo $sst ?>">
        <input type="hidden" name="sod" value="<?php echo $sod ?>">
        <input type="hidden" name="page" value="<?php echo $page ?>">
        <input type="hidden" name="bo_idx" value="<?php echo $_GET['bo_idx'] ?>">
        <input type="hidden" id="date_value"  name="date_value" value="<?php echo $row22['value'] ?>">
        

            <div class="bo_w_tit write_div">
                <div id="bo_btn_top_app">
                    <h1 class="view_title"><?=  $category_title ?></h1>
                </div>
            </div>



            <table class="view_table_app">
                <thead>
                    <tr>
                        <th scope="col" class="view_table_header"colspan="1" style="width: 10%;">제목</th>
                        <td scope="col" class="view_table_title" colspan="8" style="width: 90%;">
                            <input type="text" name="title_view" id="title_view"  class="input_text " placeholder="제목" value="<?= $row22['wr_subject']; ?>"  readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" style="width: 10%;">접수번호</th>
                        <td scope="col" class="view_table_text" colspan="4" style="width: 40%;">
                        <input type="text" name="info_number_view" id="info_number_view"  class="input_text" placeholder="접수 완료시 자동부여됩니다." value="<?= $row['info_number']; ?>"  readonly>
                        </td>
                        <th scope="col" class="view_table_header" style="width: 10%;">과제번호</th>
                        <td scope="col" class="view_table_text" colspan="4" style="width: 40%;">
                        <input type="text" name="quest_number_view" id="quest_number_view"  class="input_text" placeholder="선발 후 부여됩니다" value="<?= $row['quest_number']; ?>" readonly>
                        </td>
                    </tr>
                </thead>
                <tbody id="input_file_cont">
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">연구과제명</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >과제명(국문)</th>
                        <td scope="col" class="view_table_text" colspan="8" >
                        <input type="text" name="ko_title_view" id="ko_title_view"  class="input_text" placeholder="과제명(국문)" value="<?= $row['ko_title']; ?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >과제명(영문)</th>
                        <td scope="col" class="view_table_text" colspan="8" >
                        <input type="text" name="en_title_view" id="en_title_view"  class="input_text" placeholder="과제명(영문)" value="<?= $row['en_title']; ?>" readonly>
                        </td>
                    </tr>
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">집단회 개최</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" >소속 기관</th>
                        <td scope="col" class="view_table_text" colspan="8" >
                        <input type="text" name="meeting_agency_view" id="meeting_agency_view"  class="input_text" placeholder="" value="<?= $row['meeting_agency']; ?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" >개최장소</th>
                        <td scope="col" class="view_table_text" colspan="4" >
                        <input type="text" name="meeting_venue_view" id="meeting_venue_view"  class="input_text" placeholder="" value="<?= $row['meeting_venue']; ?>" readonly>
                        </td>
                        <th scope="col" class="view_table_header" >집담회 규모(인원)</th>
                        <td scope="col" class="view_table_text" colspan="3" >
                        <input type="text" name="meeting_scale_view" id="meeting_scale_view"  class="input_text" placeholder="명" value="<?= number_format( $row['meeting_scale']); ?>명" readonly>
                        </td>
                    </tr>
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">책임자현황</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >성명</th>
                        <td scope="col" class="view_table_text" colspan="4" >
                        <input type="text" name="normal_manager_name_view" id="normal_manager_name_view"  class="input_text" placeholder="성명" value="<?= $row['normal_manager_name']; ?>" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" >전공(학위)</th>
                        <td scope="col" class="view_table_text" colspan="3" >
                        <input type="text" name="normal_manager_degree_view" id="normal_manager_degree_view"  class="input_text" placeholder="전공(학위)" value="<?= $row['normal_manager_degree']; ?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >소속</th>
                        <td scope="col" class="view_table_text" colspan="4" >
                        <input type="text" name="normal_manager_belong_view" id="normal_manager_belong_view"  class="input_text" placeholder="소속" value="<?= $row['normal_manager_belong']; ?>" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" >직급</th>
                        <td scope="col" class="view_table_text" colspan="3" >
                        <input type="text" name="normal_manager_rank_view" id="normal_manager_rank_view"  class="input_text" placeholder="직급" value="<?= $row['normal_manager_rank']; ?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >이메일</th>
                        <td scope="col" class="view_table_text" colspan="4" >
                        <input type="text" name="normal_manager_email_view" id="normal_manager_email_view"  class="input_text" placeholder="이메일" value="<?= $row['normal_manager_email']; ?>" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" >전화</th>
                        <td scope="col" class="view_table_text" colspan="3" >
                        <input type="text" name="normal_manager_phone_view" id="normal_manager_phone_view"  class="input_text" placeholder="전화" value="<?= $row['normal_manager_phone']; ?>" readonly>
                        </td>
                    </tr>
                
                    
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">소속기관 현황</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1">소속기관</th>
                        <td scope="col" class="view_table_text" colspan="8" >
                            <input type="text" name="belong_agency_view" id="belong_agency_view" placeholder=""  class="input_text" value="<?= $row['belong_agency']; ?>" readonly>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="col" class="view_table_header" rowspan="3">소속기관</th>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%">성명</th>
                        <td scope="col" class="view_table_text" colspan="3" >
                        <input type="text" name="agency_name_view" id="agency_name_view"  class="input_text" placeholder="성명" value="<?= $row['agency_name']; ?>" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%">전공(학위)</th>
                        <td scope="col" class="view_table_text" colspan="4" >
                        <input type="text" name="agency_degree_view" id="agency_degree_view"  class="input_text" placeholder="전공(학위)" value="<?= $row['agency_degree']; ?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%">소속</th>
                        <td scope="col" class="view_table_text" colspan="3" >
                        <input type="text" name="agency_belong_view" id="agency_belong_view"  class="input_text" placeholder="소속" value="<?= $row['agency_belong']; ?>" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%">직급</th>
                        <td scope="col" class="view_table_text" colspan="4" >
                        <input type="text" name="agency_rank_view" id="agency_rank_view"  class="input_text" placeholder="직급" value="<?= $row['agency_rank']; ?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%">이메일</th>
                        <td scope="col" class="view_table_text" colspan="3" >
                        <input type="text" name="agency_email_view" id="agency_email_view"  class="input_text" placeholder="이메일" value="<?= $row['agency_email']; ?>" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%">전화</th>
                        <td scope="col" class="view_table_text" colspan="4" >
                        <input type="text" name="agency_phone_view" id="agency_phone_view"  class="input_text" placeholder="전화" value="<?= $row['agency_phone']; ?>" readonly>
                        </td>
                    </tr>
                    
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">연구정보</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1">연구비신청액</th>
                        <td scope="col" class="view_table_text " colspan="7" >
                            <input type="text" name="money_view" id="money_view"  class="input_text  money" placeholder="숫자만 기재 (원)" value="<?= number_format($row['money']); ?>원" readonly>
                        </td>
                    </tr>
                </tbody>
                <tbody id="view_table_upload">
                <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">자료 첨부</th>
                    </tr>
                         <?php 

                        $sql2 = " select * from g5_board_file where bo_table = 'g5_business_propos' and wr_id = '{$row['idx']}' and bf_user_type = 0";
                        $result2 = sql_query($sql2);    

                        // 가변 파일
                            for ($i=0; $row_list2 = sql_fetch_array($result2); $i++) {
                                if (isset($row_list2['bf_source'][$i])) {
                        ?>
                                <tr class="">
                                    <th scope="col" colspan="1" class="view_table_header" style="width:10%;">첨부파일</th>
                                    <td scope="col" colspan="1" class="view_table_text" style="width:10%;">
                                        <img src="<?php echo G5_IMG_URL ?>/download_icon.png" alt="<?php echo $config['cf_title']; ?>">
                                    </td>
                                    <td scope="col" colspan="6" class="view_table_text" style="width:80%;">
                                        <a href="<?= G5_BBS_URL ?>/download.php?bo_table=g5_business_propos&wr_id=<?= $row_list2['wr_id'] ?>&no=<?= $row_list2['bf_no'] ?>" class=""><?= $row_list2['bf_source'] ?></a>
                                    </td>
                                </tr>
                                <?php
                                }
                            }
                        ?>
                </tbody>
            </table>

            <div class="btn_confirm write_div btn-cont td_right">
                <a href="javascript:history.back();" class="btn_submit btn btn_step4 text_inline_block" style="display:inlin_block">확인</a>
            </div>
    </section>

<?php } else if ($row['bo_title_idx'] == 5) { ?>
    <section id="bo_v" style="width:80%;">
        <h2 class="sound_only"><?php echo $g5['title'] ?></h2>
        <!-- 게시물 작성/수정 시작 { -->
        <form name="fwrite" id="fwrite" action="<?php echo $action_url; ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" style="width:<?php echo $width; ?>">
        <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
        <input type="hidden" name="w" value="<?php echo $w ?>">
        <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
        <input type="hidden" name="wr_id" value="<?php echo $_GET['wr_id'] != "" ? $_GET['wr_id'] : $_POST['wr_id']; ?>">
        <input type="hidden" name="sca" value="<?php echo $sca ?>">
        <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
        <input type="hidden" name="stx" value="<?php echo $stx ?>">
        <input type="hidden" name="spt" value="<?php echo $spt ?>">
        <input type="hidden" name="sst" value="<?php echo $sst ?>">
        <input type="hidden" name="sod" value="<?php echo $sod ?>">
        <input type="hidden" name="page" value="<?php echo $page ?>">
        <input type="hidden" name="bo_idx" value="<?php echo $_GET['bo_idx'] ?>">
        <input type="hidden" id="date_value"  name="date_value" value="<?php echo $row22['value'] ?>">

            <div class="bo_w_tit write_div">
                <div id="bo_btn_top_app">
                    <h1 class="view_title"><?=  $category_title ?></h1>
                </div>
            </div>



            <table class="view_table_app">
                <thead>
                    <tr>
                        <th scope="col" class="view_table_header"colspan="1" style="width: 10%;">제목</th>
                        <td scope="col" class="view_table_title" colspan="8" style="width: 90%;">
                            <input type="text" name="title_view" id="title_view"  class="input_text " placeholder="제목" value="<?= $row22['wr_subject']; ?>"  readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" style="width: 10%;">접수번호</th>
                        <td scope="col" class="view_table_text" colspan="3" style="width: 40%;">
                        <input type="text" name="info_number_view" id="info_number_view"  class="input_text" placeholder="접수 완료시 자동부여됩니다." value="<?= $row['info_number']; ?>"  readonly>
                        </td>
                        <th scope="col" class="view_table_header" style="width: 10%;">과제번호</th>
                        <td scope="col" class="view_table_text" colspan="5" style="width: 40%;">
                        <input type="text" name="quest_number" id="quest_number"  class="input_text" placeholder="선발 후 부여됩니다" value="<?= $row['quest_number']; ?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header"colspan="1" style="width: 10%;">과제구분</th>
                        <td scope="col" class="view_table_title" colspan="8" style="width: 90%;">
                            <input type="text" name="quest_division_view" id="quest_division_view"  class="input_text " placeholder="제목" value="<?= $row['quest_division']; ?>" readonly>
                        </td>
                    </tr>
                </thead>
                <tbody id="input_file_cont">
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">연구과제명</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >과제명(국문)</th>
                        <td scope="col" class="view_table_text" colspan="8" >
                        <input type="text" name="ko_title_view" id="ko_title_view"  class="input_text" placeholder="과제명(국문)" value="<?= $row['ko_title']; ?>"readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >과제명(영문)</th>
                        <td scope="col" class="view_table_text" colspan="8" >
                        <input type="text" name="en_title_view" id="en_title_view"  class="input_text" placeholder="과제명(영문)" value="<?= $row['en_title']; ?>" readonly>
                        </td>
                    </tr>

                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="8">연구주최</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1"style="width:10%;">주최(주관)<br>기관</th>
                        <td scope="col" class="view_table_text "  colspan="7" style="width:40%;">
                            <input type="text" name="host_name_view" id="host_name_view"  class="input_text " placeholder="성명" value="<?= $row['host_name']; ?>" readonly>
                        </td>
                    </tr>

                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >개최일시</th>
                        <td scope="col" class="view_table_text " colspan="3" >
                            <input type="text" name="host_date_view" id="host_date_view" class=" input_text   " max="9999-12-31"  readonly placeholder="연도-월-일" value="<?= $row['host_date_start']; ?> ~ <?= $row['host_date_end']; ?>" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" >개최장소</th>
                        <td scope="col" class="view_table_text " colspan="3" style="width:40%;">
                            <input type="text" name="host_venue_view" id="host_venue_view"  class="input_text " placeholder="개최장소" value="<?= $row['host_venue']; ?>"  readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" style="width:10%;">공동개최 Y/N</th>
                        <td scope="col" class="view_table_title " colspan="3" style="width:45%;">
                            <input type="text" name="host_public_check_view" id="host_public_check_view"  class="input_text "  value="<?= $row['host_public_check']; ?>" readonly>
                        </td>
                        <th scope="col" class="view_table_header" style="width:10%;">공동개최 기관명</th>
                        <td scope="col" class="view_table_text " colspan="3" style="width:40%;">
                            <input type="text" name="host_public_name_view" id="host_public_name_view"  class="input_text " placeholder="공동개최 기관명" value="<?= $row['host_public_name']; ?>" readonly >
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%;">후원기관 현황</th>
                        <td scope="col" class="view_table_text " colspan="3" style="width:40%;">
                            <input type="text" name="host_support_count_view" id="host_support_count_view"  class="input_text " placeholder="후원기관 현황" value="<?= $row['host_support_count']; ?>" readonly >
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%;">후원기관1</th>
                        <td scope="col" class="view_table_text " colspan="3" style="width:40%;">
                            <input type="text" name="host_support_1_view" id="host_support_1_view"  class="input_text " placeholder="후원기관1" value="<?= $row['host_support_1']; ?>" readonly >
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%;">후원기관2</th>
                        <td scope="col" class="view_table_text " colspan="3" style="width:40%;">
                            <input type="text" name="host_support_2_view" id="host_support_2_view"  class="input_text " placeholder="후원기관2" value="<?= $row['host_support_2']; ?>" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%;">후원기관3</th>
                        <td scope="col" class="view_table_text " colspan="3" style="width:40%;">
                        <input type="text" name="host_support_3_view" id="host_support_3_view"  class="input_text " placeholder="후원기관3" value="<?= $row['host_support_3']; ?>" readonly> 
                        </td>
                    </tr>

                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">참가예정 인원</th>
                    </tr>

                    <tr>
                        <th scope="col" class="view_table_header" colspan="2" style="width:25%">발표자</th>
                        <td scope="col" class="view_table_text " colspan="2" style="width:25%">
                            <input type="text" name="presenter_user_view" id="presenter_user_view"  class="input_text " placeholder="발표자" value="<?= number_format($row['presenter_user']); ?>명" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="2" style="width:25%">토론자</th>
                        <td scope="col" class="view_table_text " colspan="3" style="width:25%">
                            <input type="text" name="debater_user_view" id="debater_user_view"  class="input_text " placeholder="토론자" value="<?= number_format($row['debater_user']); ?>명" readonly>
                        </td>
                    </tr>

                    <tr>
                        <th scope="col" class="view_table_header" colspan="2" >사회자</th>
                        <td scope="col" class="view_table_text " colspan="2" >
                            <input type="text" name="mc_user_view" id="mc_user_view"  class="input_text " placeholder="사회자" value="<?= number_format($row['mc_user']); ?>명" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="2" >일반참가자</th>
                        <td scope="col" class="view_table_text " colspan="3" >
                            <input type="text" name="normal_user_view" id="normal_user_view"  class="input_text " placeholder="일반참가자" value="<?= number_format($row['normal_user']); ?>명" readonly>
                        </td>
                    </tr>
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">소속기관 현황</th>
                    </tr>
                    
                    <tr>
                        <th scope="col" class="view_table_header" rowspan="3">기관책임자</th>
                        <th scope="col" class="view_table_header" colspan="1" style=" width:10%">성명</th>
                        <td scope="col" class="view_table_text" colspan="2" >
                        <input type="text" name="institute_manager_name_view" id="institute_manager_name_view"  class="input_text" placeholder="성명" value="<?= $row['institute_manager_name']; ?>" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" >전공(학위)</th>
                        <td scope="col" class="view_table_text" colspan="4" >
                        <input type="text" name="institute_manager_degree_view" id="institute_manager_degree_view"  class="input_text" placeholder="전공(학위)" value="<?= $row['institute_manager_degree']; ?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >소속</th>
                        <td scope="col" class="view_table_text" colspan="2" >
                        <input type="text" name="institute_manager_belong_view" id="institute_manager_belong_view"  class="input_text" placeholder="소속" value="<?= $row['institute_manager_belong']; ?>" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" >직급</th>
                        <td scope="col" class="view_table_text" colspan="4" >
                        <input type="text" name="institute_manager_rank_view" id="institute_manager_rank_view"  class="input_text" placeholder="직급" value="<?= $row['institute_manager_rank']; ?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >이메일</th>
                        <td scope="col" class="view_table_text" colspan="2" >
                        <input type="text" name="institute_manager_email_view" id="institute_manager_email_view"  class="input_text" placeholder="이메일" value="<?= $row['institute_manager_email']; ?>" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" >전화</th>
                        <td scope="col" class="view_table_text" colspan="4" >
                        <input type="text" name="institute_manager_phone_view" id="institute_manager_phone_view"  class="input_text" placeholder="전화" value="<?= $row['institute_manager_phone']; ?>" readonly>
                        </td>
                    </tr>

                   
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header" rowspan="11" colspan="2" >소속기관</th>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%">연번</th>
                        <th scope="col" class="view_table_header" colspan="2" >직위</th>
                        <th scope="col" class="view_table_header" colspan="2" >성명</th>
                        <th scope="col" class="view_table_header" colspan="2" >소속</th>
                    </tr>

                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >1</th>
                        <td scope="col" class="view_table_text" colspan="2" >
                            <input type="text" name="one_user_rank_view" id="one_user_rank_view"  class="input_text" placeholder="직위" value="<?= $row['1_user_rank']; ?>" readonly>
                        </td>
                        <td scope="col" class="view_table_text" colspan="2" >
                            <input type="text" name="one_user_name_view" id="one_user_name_view"  class="input_text" placeholder="성명" value="<?= $row['1_user_name']; ?>" readonly>
                        </td>
                        <td scope="col" class="view_table_text" colspan="2" >
                            <input type="text" name="one_user_belong_view" id="one_user_belong_view" class="input_text" placeholder="소속" value="<?= $row['1_user_belong']; ?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >2</th>
                        <td scope="col" class="view_table_text" colspan="2" >
                            <input type="text" name="two_user_rank_view" id="two_user_rank_view"  class="input_text" placeholder="직위" value="<?= $row['2_user_rank']; ?>" readonly>
                        </td>
                        <td scope="col" class="view_table_text" colspan="2" >
                            <input type="text" name="two_user_name_view" id="two_user_name_view"  class="input_text" placeholder="성명" value="<?= $row['2_user_name']; ?>" readonly>
                        </td>
                        <td scope="col" class="view_table_text" colspan="2" >
                            <input type="text" name="two_user_belong_view" id="two_user_belong_view"  class="input_text" placeholder="소속" value="<?= $row['2_user_belong']; ?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >3</th>
                        <td scope="col" class="view_table_text" colspan="2" >
                            <input type="text" name="three_user_rank_view" id="three_user_rank_view"  class="input_text" placeholder="직위" value="<?= $row['3_user_rank']; ?>" readonly>
                        </td>
                        <td scope="col" class="view_table_text" colspan="2" >
                            <input type="text" name="three_user_name_view" id="three_user_name_view"  class="input_text" placeholder="성명" value="<?= $row['3_user_name']; ?>" readonly>
                        </td>
                        <td scope="col" class="view_table_text" colspan="2" >
                            <input type="text" name="three_user_belong_view" id="three_user_belong_view"  class="input_text" placeholder="소속" value="<?= $row['3_user_belong']; ?>" readonly>
                        </td>
                    </tr>

                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >4</th>
                        <td scope="col" class="view_table_text" colspan="2" >
                            <input type="text" name="three_user_rank_view" id="three_user_rank_view"  class="input_text" placeholder="직위" value="<?= $row['4_user_rank']; ?>" readonly>
                        </td>
                        <td scope="col" class="view_table_text" colspan="2" >
                            <input type="text" name="three_user_name_view" id="three_user_name_view"  class="input_text" placeholder="성명" value="<?= $row['4_user_name']; ?>" readonly>
                        </td>
                        <td scope="col" class="view_table_text" colspan="2" >
                            <input type="text" name="three_user_belong_view" id="three_user_belong_view"  class="input_text" placeholder="소속" value="<?= $row['4_user_belong']; ?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >5</th>
                        <td scope="col" class="view_table_text" colspan="2" >
                            <input type="text" name="three_user_rank_view" id="three_user_rank_view"  class="input_text" placeholder="직위" value="<?= $row['5_user_rank']; ?>" readonly>
                        </td>
                        <td scope="col" class="view_table_text" colspan="2" >
                            <input type="text" name="three_user_name_view" id="three_user_name_view"  class="input_text" placeholder="성명" value="<?= $row['5_user_name']; ?>" readonly>
                        </td>
                        <td scope="col" class="view_table_text" colspan="2" >
                            <input type="text" name="three_user_belong_view" id="three_user_belong_view"  class="input_text" placeholder="소속" value="<?= $row['5_user_belong']; ?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >6</th>
                        <td scope="col" class="view_table_text" colspan="2" >
                            <input type="text" name="three_user_rank_view" id="three_user_rank_view"  class="input_text" placeholder="직위" value="<?= $row['6_user_rank']; ?>" readonly>
                        </td>
                        <td scope="col" class="view_table_text" colspan="2" >
                            <input type="text" name="three_user_name_view" id="three_user_name_view"  class="input_text" placeholder="성명" value="<?= $row['6_user_name']; ?>" readonly>
                        </td>
                        <td scope="col" class="view_table_text" colspan="2" >
                            <input type="text" name="three_user_belong_view" id="three_user_belong_view"  class="input_text" placeholder="소속" value="<?= $row['6_user_belong']; ?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >7</th>
                        <td scope="col" class="view_table_text" colspan="2" >
                            <input type="text" name="three_user_rank_view" id="three_user_rank_view"  class="input_text" placeholder="직위" value="<?= $row['7_user_rank']; ?>" readonly>
                        </td>
                        <td scope="col" class="view_table_text" colspan="2" >
                            <input type="text" name="three_user_name_view" id="three_user_name_view"  class="input_text" placeholder="성명" value="<?= $row['7_user_name']; ?>" readonly>
                        </td>
                        <td scope="col" class="view_table_text" colspan="2" >
                            <input type="text" name="three_user_belong_view" id="three_user_belong_view"  class="input_text" placeholder="소속" value="<?= $row['7_user_belong']; ?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >8</th>
                        <td scope="col" class="view_table_text" colspan="2" >
                            <input type="text" name="three_user_rank_view" id="three_user_rank_view"  class="input_text" placeholder="직위" value="<?= $row['8_user_rank']; ?>" readonly>
                        </td>
                        <td scope="col" class="view_table_text" colspan="2" >
                            <input type="text" name="three_user_name_view" id="three_user_name_view"  class="input_text" placeholder="성명" value="<?= $row['8_user_name']; ?>" readonly>
                        </td>
                        <td scope="col" class="view_table_text" colspan="2" >
                            <input type="text" name="three_user_belong_view" id="three_user_belong_view"  class="input_text" placeholder="소속" value="<?= $row['8_user_belong']; ?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >9</th>
                        <td scope="col" class="view_table_text" colspan="2" >
                            <input type="text" name="three_user_rank_view" id="three_user_rank_view"  class="input_text" placeholder="직위" value="<?= $row['9_user_rank']; ?>" readonly>
                        </td>
                        <td scope="col" class="view_table_text" colspan="2" >
                            <input type="text" name="three_user_name_view" id="three_user_name_view"  class="input_text" placeholder="성명" value="<?= $row['9_user_name']; ?>" readonly>
                        </td>
                        <td scope="col" class="view_table_text" colspan="2" >
                            <input type="text" name="three_user_belong_view" id="three_user_belong_view"  class="input_text" placeholder="소속" value="<?= $row['9_user_belong']; ?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >10</th>
                        <td scope="col" class="view_table_text" colspan="2" >
                            <input type="text" name="three_user_rank_view" id="three_user_rank_view"  class="input_text" placeholder="직위" value="<?= $row['10_user_rank']; ?>" readonly>
                        </td>
                        <td scope="col" class="view_table_text" colspan="2" >
                            <input type="text" name="three_user_name_view" id="three_user_name_view"  class="input_text" placeholder="성명" value="<?= $row['10_user_name']; ?>" readonly>
                        </td>
                        <td scope="col" class="view_table_text" colspan="2" >
                            <input type="text" name="three_user_belong_view" id="three_user_belong_view"  class="input_text" placeholder="소속" value="<?= $row['10_user_belong']; ?>" readonly>
                        </td>
                    </tr>

                   
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">연구정보</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1">연구비신청액</th>
                        <td scope="col" class="view_table_text " colspan="8" >
                            <input type="text" name="money_view" id="money_view"  class="input_text  money" placeholder="숫자만 기재 (원)" value="<?= number_format($row['money']); ?>원" >
                        </td>
                    </tr>
                    
                </tbody>
                <tbody id="view_table_upload">
                <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">자료 첨부</th>
                    </tr>
                         <?php 

                        $sql2 = " select * from g5_board_file where bo_table = 'g5_business_propos' and wr_id = '{$row['idx']}' and bf_user_type = 0";
                        $result2 = sql_query($sql2);    

                        // 가변 파일
                            for ($i=0; $row_list2 = sql_fetch_array($result2); $i++) {
                                if (isset($row_list2['bf_source'][$i])) {
                        ?>
                                <tr class="">
                                    <th scope="col" colspan="1" class="view_table_header" style="width:10%;">첨부파일</th>
                                    <td scope="col" colspan="1" class="view_table_text" style="width:10%;">
                                        <img src="<?php echo G5_IMG_URL ?>/download_icon.png" alt="<?php echo $config['cf_title']; ?>">
                                    </td>
                                    <td scope="col" colspan="6" class="view_table_text" style="width:80%;">
                                        <a href="<?= G5_BBS_URL ?>/download.php?bo_table=g5_business_propos&wr_id=<?= $row_list2['wr_id'] ?>&no=<?= $row_list2['bf_no'] ?>" class=""><?= $row_list2['bf_source'] ?></a>
                                    </td>
                                </tr>
                                <?php
                                }
                            }
                        ?>
                </tbody>
            </table>

            <div class="btn_confirm write_div btn-cont td_right">
                <a href="javascript:history.back();" class="btn_submit btn btn_step4 text_inline_block" style="display:inlin_block">확인</a>
            </div>
        </form>
    </section>
   
<?php } else if ($row['bo_title_idx'] == 6) { ?>
    <section id="bo_v" style="width:80%;">
        <h2 class="sound_only"><?php echo $g5['title'] ?></h2>
        <!-- 게시물 작성/수정 시작 { -->
        <form name="fwrite" id="fwrite" action="<?php echo $action_url; ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" style="width:<?php echo $width; ?>">
        <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
        <input type="hidden" name="w" value="<?php echo $w ?>">
        <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
        <input type="hidden" name="wr_id" value="<?php echo $_GET['wr_id'] != "" ? $_GET['wr_id'] : $_POST['wr_id']; ?>">
        <input type="hidden" name="sca" value="<?php echo $sca ?>">
        <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
        <input type="hidden" name="stx" value="<?php echo $stx ?>">
        <input type="hidden" name="spt" value="<?php echo $spt ?>">
        <input type="hidden" name="sst" value="<?php echo $sst ?>">
        <input type="hidden" name="sod" value="<?php echo $sod ?>">
        <input type="hidden" name="page" value="<?php echo $page ?>">
        <input type="hidden" name="bo_idx" value="<?php echo $_GET['bo_idx'] ?>">
        <input type="hidden" id="date_value"  name="date_value" value="<?php echo $row22['value'] ?>">

            <div class="bo_w_tit write_div">
                <div id="bo_btn_top_app">
                    <h1 class="view_title"><?=  $category_title ?></h1>
                </div>
            </div>



            <table class="view_table_app">
                <thead>
                    <tr>
                        <th scope="col" class="view_table_header"colspan="1" style="width: 10%;">제목</th>
                        <td scope="col" class="view_table_title" colspan="8" style="width: 90%;">
                            <input type="text" name="title_view" id="title_view"  class="input_text " placeholder="제목" value="<?= $row22['wr_subject']; ?>"  readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" style="width: 10%;">접수번호</th>
                        <td scope="col" class="view_table_text" colspan="4" style="width: 40%;">
                        <input type="text" name="info_number_view" id="info_number_view"  class="input_text" placeholder="접수 완료시 자동부여됩니다." value="<?= $row['info_number']; ?>" readonly>
                        </td>
                        <th scope="col" class="view_table_header" style="width: 10%;">과제번호</th>
                        <td scope="col" class="view_table_text" colspan="4" style="width: 40%;">
                        <input type="text" name="quest_number_view" id="quest_number_view"  class="input_text" placeholder="선발 후 부여됩니다" value="<?= $row['quest_number']; ?>" readonly>
                        </td>
                    </tr>
                </thead>
                <tbody id="input_file_cont">
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">연구과제명</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >과제명(국문)</th>
                        <td scope="col" class="view_table_text" colspan="8" >
                        <input type="text" name="ko_title_view" id="ko_title_view"  class="input_text" placeholder="과제명(국문)" value="<?= $row['ko_title']; ?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >과제명(영문)</th>
                        <td scope="col" class="view_table_text" colspan="8" >
                        <input type="text" name="en_title_view" id="en_title_view"  class="input_text" placeholder="과제명(영문)" value="<?= $row['en_title']; ?>" readonly>
                        </td>
                    </tr>
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">지원자</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >성명</th>
                        <td scope="col" class="view_table_text" colspan="4" >
                        <input type="text" name="name_view" id="name_view"  class="input_text" placeholder="성명" value="<?= $row['name']; ?>" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" >전공(학위)</th>
                        <td scope="col" class="view_table_text" colspan="3" >
                        <input type="text" name="degree_view" id="degree_view"  class="input_text" placeholder="전공(학위)" value="<?= $row['degree']; ?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >소속</th>
                        <td scope="col" class="view_table_text" colspan="4" >
                        <input type="text" name="belong_view" id="belong_view"  class="input_text" placeholder="소속" value="<?= $row['belong']; ?>" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" >직급</th>
                        <td scope="col" class="view_table_text" colspan="3" >
                        <input type="text" name="rank_view" id="rank_view"  class="input_text" placeholder="직급" value="<?= $row['rank']; ?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >이메일</th>
                        <td scope="col" class="view_table_text" colspan="4" >
                        <input type="text" name="email_view" id="email_view"  class="input_text" placeholder="이메일" value="<?= $row['email']; ?>" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" >전화</th>
                        <td scope="col" class="view_table_text" colspan="3" >
                        <input type="text" name="phone_view" id="phone_view"  class="input_text" placeholder="전화" value="<?= $row['phone']; ?>" readonly>
                        </td>
                    </tr>
                </tbody>
                <tbody id="view_table_upload">
                <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">자료 첨부</th>
                    </tr>
                         <?php 

                        $sql2 = " select * from g5_board_file where bo_table = 'g5_business_propos' and wr_id = '{$row['idx']}' and bf_user_type = 0";
                        $result2 = sql_query($sql2);    

                        // 가변 파일
                            for ($i=0; $row_list2 = sql_fetch_array($result2); $i++) {
                                if (isset($row_list2['bf_source'][$i])) {
                        ?>
                                <tr class="">
                                    <th scope="col" colspan="1" class="view_table_header" style="width:10%;">첨부파일</th>
                                    <td scope="col" colspan="1" class="view_table_text" style="width:10%;">
                                        <img src="<?php echo G5_IMG_URL ?>/download_icon.png" alt="<?php echo $config['cf_title']; ?>">
                                    </td>
                                    <td scope="col" colspan="6" class="view_table_text" style="width:80%;">
                                        <a href="<?= G5_BBS_URL ?>/download.php?bo_table=g5_business_propos&wr_id=<?= $row_list2['wr_id'] ?>&no=<?= $row_list2['bf_no'] ?>" class=""><?= $row_list2['bf_source'] ?></a>
                                    </td>
                                </tr>
                        <?php
                                }
                            }
                        ?>
                </tbody>
            </table>

            <div class="btn_confirm write_div btn-cont td_right">
                <a href="javascript:history.back();" class="btn_submit btn btn_step4 text_inline_block" style="display:inlin_block">확인</a>
            </div>
        </form>
    </section>
<?php }  ?>




<!-- } 게시물 작성/수정 끝 -->

