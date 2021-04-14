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

$sql2 = "select * from rater where business_idx = '{$_GET['wr_idx']}' and  propos_idx = '{$_GET['us_idx']}' and user_id ='{$member['mb_id']}' and test_id = '{$_GET['bo_idx']}'";
$result2 = sql_query($sql2);
$row2 = sql_fetch_array($result2);

$sql3 = " select * from rater_value where rater_idx = '{$row2['idx']}' and report_idx = '{$_GET['us_idx']}'";
$result3 = sql_query($sql3);
$row3 = sql_fetch_array($result3);
?>
<aside id="bo_side">
    <h2 class="aside_nav_title">심사 관리</h2>
   
    <a class="aside_nav <?= $_GET['bo_idx'] == 1?"aisde_click":""; ?>" href="<?= G5_BBS_URL ?>/board.rater.php?bo_table=<?= $bo_table ?>&bo_idx=1">지원자 선발</a>
    <a class="aside_nav <?= $_GET['bo_idx'] == 2?"aisde_click":""; ?>" href="<?= G5_BBS_URL ?>/board.rater.php?bo_table=<?= $bo_table ?>&bo_idx=2">중간보고서</a>
    <a class="aside_nav <?= $_GET['bo_idx'] == 3?"aisde_click":""; ?>" href="<?= G5_BBS_URL ?>/board.rater.php?bo_table=<?= $bo_table ?>&bo_idx=3">결과(연차)보고서</a>
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
            <div id="bo_btn_top_app ">
                <h1 class="view_title"><?=  $category_title ?>[<?= $row33['title']?>]<?php echo $row22['wr_subject']; ?></h1>
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
                        <input type="text" name="name_view" id="name_view"  class="input_text" placeholder="성명"  value="<?= str_replace($row['name'], '*****', $row['name']); ?>" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" >전공(학위)</th>
                        <td scope="col" class="view_table_text" colspan="3" >
                        <input type="text" name="degree_view" id="degree_view"  class="input_text" placeholder="전공(학위)"  value="<?= str_replace($row['degree'], '*****', $row['degree']); ?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >소속</th>
                        <td scope="col" class="view_table_text" colspan="4" >
                        <input type="text" name="belong_view" id="belong_view"  class="input_text" placeholder="소속"  value="<?= str_replace($row['belong'], '*****', $row['belong']); ?>" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" >직급</th>
                        <td scope="col" class="view_table_text" colspan="3" >
                        <input type="text" name="rank_view" id="rank_view"  class="input_text" placeholder="직급"  value="<?= str_replace($row['rank'], '*****', $row['rank']); ?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >이메일</th>
                        <td scope="col" class="view_table_text" colspan="4" >
                        <input type="text" name="email_view" id="email_view"  class="input_text" placeholder="이메일"  value="<?= str_replace($row['email'], '*****', $row['email']); ?>" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" >전화</th>
                        <td scope="col" class="view_table_text" colspan="3" >
                        <input type="text" name="phone_view" id="phone_view"  class="input_text" placeholder="전화"  value="<?= str_replace($row['phone'], '*****', $row['phone']); ?>" readonly>
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

            <div class="btn_confirm write_div btn-cont">
                <a href="<?= G5_BBS_URL ?>/board.rater.php?bo_table=qa&bo_idx=<?= $_GET['bo_idx'] ?>&wr_idx=<?= $_GET['wr_idx'] ?>" class=" btn_color_white">이전</a>
                <button type="button" id="btn_submit2" accesskey="s" class="btn_submit btn btn_step4 btn_bo_val btn_color_white"><?= $row3['value']==2? "확인" :"평가"; ?></button>
                <form name="fboardlist" id="fboardlist" action="<?= https_url(G5_BBS_DIR)."/application_rater_update.php"; ?>" method="post">
                    <input type="hidden" name="business_idx" class= "business_idx_form" value="<?php echo $_GET['wr_idx']; ?>">
                    <input type="hidden" name="rater_idx" class= "sql_rater_idx" value="<?php echo $row2['idx']; ?>">
                    <input type="hidden" name="test_id" class="test_id"  value="<?= $_GET['bo_idx']?>">
                    <input type="hidden" name="value_id"  value="2">
                    <input type="hidden" class="sql_us_idx " name="us_idx" value="<?php echo $row['idx']; ?>">
                    <input type="hidden" class="sql_fild_value " name="sql_fild_value" value="<?= $row3['value'] ?>">
                    <button type="submit" id="btn_submit3" accesskey="s" class="btn_submit value_admin_btn btn btn_step4" <?= $row3['value']==2? "disabled" :""; ?> style="background:<?= $row3['value']==2? "#ccc" :"#1D2E58"; ?>" ><?= $row3['value']==2? "제출완료" :"제출"; ?></button>
                </form>
            </div>
        </form>
    </section>
    <script>
        $(function(){
            $('.date_value').click(function(){
                var beforeStr = $('#date_value').val();
                


                if(beforeStr > 0){
                    alert('평가가 시작되어 수정이 불가능 합니다');
                    return false;
                }
            })
        })
    </script>

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
            <div id="bo_btn_top_app ">
                <h1 class="view_title"><?=  $category_title ?>[<?= $row33['title']?>]<?php echo $row22['wr_subject']; ?></h1>
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
                        <input type="text" name="name_view" id="name_view"  class="input_text" placeholder="성명" value="<?=  str_replace($row['name'], '*****', $row['name']); ?>" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" >전공(학위)</th>
                        <td scope="col" class="view_table_text" colspan="3" >
                        <input type="text" name="degree_view" id="degree_view"  class="input_text" placeholder="전공(학위)" value="<?= str_replace($row['degree'], '*****', $row['degree']); ?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >소속</th>
                        <td scope="col" class="view_table_text" colspan="4" >
                        <input type="text" name="belong_view" id="belong_view"  class="input_text" placeholder="소속" value="<?= str_replace($row['belong'], '*****', $row['belong']); ?>" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" >직급</th>
                        <td scope="col" class="view_table_text" colspan="3" >
                        <input type="text" name="rank_view" id="rank_view"  class="input_text" placeholder="직급" value="<?= str_replace($row['rank'], '*****', $row['rank']); ?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >이메일</th>
                        <td scope="col" class="view_table_text" colspan="4" >
                        <input type="text" name="email_view" id="email_view"  class="input_text" placeholder="이메일" value="<?= str_replace($row['email'], '*****', $row['email']); ?>" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" >전화</th>
                        <td scope="col" class="view_table_text" colspan="3" >
                        <input type="text" name="phone_view" id="phone_view"  class="input_text" placeholder="전화" value="<?= str_replace($row['phone'], '*****', $row['phone']); ?>" readonly>
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

            <div class="btn_confirm write_div btn-cont">
                <a href="<?= G5_BBS_URL ?>/board.rater.php?bo_table=qa&bo_idx=<?= $_GET['bo_idx'] ?>&wr_idx=<?= $_GET['wr_idx'] ?>" class=" btn_color_white">이전</a>
                <button type="button" id="btn_submit2" accesskey="s" class="btn_submit btn btn_step4 btn_bo_val btn_color_white"><?= $row3['value']==2? "확인" :"평가"; ?></button>
                <form name="fboardlist" id="fboardlist" action="<?= https_url(G5_BBS_DIR)."/application_rater_update.php"; ?>" method="post">
                    <input type="hidden" name="business_idx" class= "business_idx_form" value="<?php echo $_GET['wr_idx']; ?>">
                    <input type="hidden" name="rater_idx" class= "sql_rater_idx" value="<?php echo $row2['idx']; ?>">
                    <input type="hidden" name="test_id" class="test_id"  value="<?= $_GET['bo_idx']?>">
                    <input type="hidden" name="value_id"  value="2">
                    <input type="hidden" class="sql_us_idx " name="us_idx" value="<?php echo $row['idx']; ?>">
                    <input type="hidden" class="sql_fild_value " name="sql_fild_value" value="<?= $row3['value'] ?>">
                    <button type="submit" id="btn_submit3" accesskey="s" class="btn_submit value_admin_btn btn btn_step4" <?= $row3['value']==2? "disabled" :""; ?> style="background:<?= $row3['value']==2? "#ccc" :"#1D2E58"; ?>" ><?= $row3['value']==2? "제출완료" :"제출"; ?></button>
                </form>
            </div>
        </form>
    </section>
    <script>
        $(function(){
            $('.date_value').click(function(){
                var beforeStr = $('#date_value').val();
                


                if(beforeStr > 0){
                    alert('평가가 시작되어 수정이 불가능 합니다');
                    return false;
                }
            })
        })
    </script>
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
            <div id="bo_btn_top_app ">
                <h1 class="view_title"><?=  $category_title ?>[<?= $row33['title']?>]<?php echo $row22['wr_subject']; ?></h1>
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
                        <input type="text" name="normal_manager_name_view" id="normal_manager_name_view"  class="input_text" placeholder="성명" value="<?= str_replace($row['normal_manager_name'], '*****', $row['normal_manager_name']); ?>" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" >전공(학위)</th>
                        <td scope="col" class="view_table_text" colspan="3" >
                        <input type="text" name="normal_manager_degree_view" id="normal_manager_degree_view"  class="input_text" placeholder="전공(학위)" value="<?= str_replace($row['normal_manager_degree'], '*****', $row['normal_manager_degree']); ?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >소속</th>
                        <td scope="col" class="view_table_text" colspan="4" >
                        <input type="text" name="normal_manager_belong_view" id="normal_manager_belong_view"  class="input_text" placeholder="소속" value="<?= str_replace($row['normal_manager_belong'], '*****', $row['rannormal_manager_belongk']); ?>" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" >직급</th>
                        <td scope="col" class="view_table_text" colspan="3" >
                        <input type="text" name="normal_manager_rank_view" id="normal_manager_rank_view"  class="input_text" placeholder="직급" value="<?= str_replace($row['normal_manager_rank'], '*****', $row['normal_manager_rank']); ?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >이메일</th>
                        <td scope="col" class="view_table_text" colspan="4" >
                        <input type="text" name="normal_manager_email_view" id="normal_manager_email_view"  class="input_text" placeholder="이메일" value="<?= str_replace($row['normal_manager_email'], '*****', $row['normal_manager_email']); ?>" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" >전화</th>
                        <td scope="col" class="view_table_text" colspan="3" >
                        <input type="text" name="normal_manager_phone_view" id="normal_manager_phone_view"  class="input_text" placeholder="전화" value="<?= str_replace($row['normal_manager_phone'], '*****', $row['normal_manager_phone']); ?>" readonly>
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

            <div class="btn_confirm write_div btn-cont">
                <a href="<?= G5_BBS_URL ?>/board.rater.php?bo_table=qa&bo_idx=<?= $_GET['bo_idx'] ?>&wr_idx=<?= $_GET['wr_idx'] ?>" class=" btn_color_white">이전</a>
                <button type="button" id="btn_submit2" accesskey="s" class="btn_submit btn btn_step4 btn_bo_val btn_color_white"><?= $row3['value']==2? "확인" :"평가"; ?></button>
                <form name="fboardlist" id="fboardlist" action="<?= https_url(G5_BBS_DIR)."/application_rater_update.php"; ?>" method="post">
                    <input type="hidden" name="business_idx" class= "business_idx_form" value="<?php echo $_GET['wr_idx']; ?>">
                    <input type="hidden" name="rater_idx" class= "sql_rater_idx" value="<?php echo $row2['idx']; ?>">
                    <input type="hidden" name="test_id" class="test_id"  value="<?= $_GET['bo_idx']?>">
                    <input type="hidden" name="value_id"  value="2">
                    <input type="hidden" class="sql_us_idx " name="us_idx" value="<?php echo $row['idx']; ?>">
                    <input type="hidden" class="sql_fild_value " name="sql_fild_value" value="<?= $row3['value'] ?>">
                    <button type="submit" id="btn_submit3" accesskey="s" class="btn_submit value_admin_btn btn btn_step4" <?= $row3['value']==2? "disabled" :""; ?> style="background:<?= $row3['value']==2? "#ccc" :"#1D2E58"; ?>" ><?= $row3['value']==2? "제출완료" :"제출"; ?></button>
                </form>
            </div>
        </form>
    </section>
    <script>
        $(function(){
            $('.date_value').click(function(){
                var beforeStr = $('#date_value').val();
                


                if(beforeStr > 0){
                    alert('평가가 시작되어 수정이 불가능 합니다');
                    return false;
                }
            })
        })
    </script>
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
            <div id="bo_btn_top_app ">
                <h1 class="view_title"><?=  $category_title ?>[<?= $row33['title']?>]<?php echo $row22['wr_subject']; ?></h1>
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
                        <input type="text" name="normal_manager_name_view" id="normal_manager_name_view"  class="input_text" placeholder="성명" value="<?= str_replace($row['normal_manager_name'], '*****', $row['normal_manager_name']); ?>" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" >전공(학위)</th>
                        <td scope="col" class="view_table_text" colspan="3" >
                        <input type="text" name="normal_manager_degree_view" id="normal_manager_degree_view"  class="input_text" placeholder="전공(학위)" value="<?= str_replace($row['normal_manager_degree'], '*****', $row['normal_manager_degree']); ?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >소속</th>
                        <td scope="col" class="view_table_text" colspan="4" >
                        <input type="text" name="normal_manager_belong_view" id="normal_manager_belong_view"  class="input_text" placeholder="소속" value="<?= str_replace($row['normal_manager_belong'], '*****', $row['normal_manager_belong']); ?>" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" >직급</th>
                        <td scope="col" class="view_table_text" colspan="3" >
                        <input type="text" name="normal_manager_rank_view" id="normal_manager_rank_view"  class="input_text" placeholder="직급" value="<?= str_replace($row['normal_manager_rank'], '*****', $row['normal_manager_rank']); ?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >이메일</th>
                        <td scope="col" class="view_table_text" colspan="4" >
                        <input type="text" name="normal_manager_email_view" id="normal_manager_email_view"  class="input_text" placeholder="이메일" value="<?= str_replace($row['normal_manager_email'], '*****', $row['normal_manager_email']); ?>" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" >전화</th>
                        <td scope="col" class="view_table_text" colspan="3" >
                        <input type="text" name="normal_manager_phone_view" id="normal_manager_phone_view"  class="input_text" placeholder="전화" value="<?= str_replace($row['normal_manager_phone'], '*****', $row['normal_manager_phone']); ?>" readonly>
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

            <div class="btn_confirm write_div btn-cont">
                <a href="<?= G5_BBS_URL ?>/board.rater.php?bo_table=qa&bo_idx=<?= $_GET['bo_idx'] ?>&wr_idx=<?= $_GET['wr_idx'] ?>" class=" btn_color_white">이전</a>
                <button type="button" id="btn_submit2" accesskey="s" class="btn_submit btn btn_step4 btn_bo_val btn_color_white"><?= $row3['value']==2? "확인" :"평가"; ?></button>
                <form name="fboardlist" id="fboardlist" action="<?= https_url(G5_BBS_DIR)."/application_rater_update.php"; ?>" method="post">
                    <input type="hidden" name="business_idx" class= "business_idx_form" value="<?php echo $_GET['wr_idx']; ?>">
                    <input type="hidden" name="rater_idx" class= "sql_rater_idx" value="<?php echo $row2['idx']; ?>">
                    <input type="hidden" name="test_id" class="test_id"  value="<?= $_GET['bo_idx']?>">
                    <input type="hidden" name="value_id"  value="2">
                    <input type="hidden" class="sql_us_idx " name="us_idx" value="<?php echo $row['idx']; ?>">
                    <input type="hidden" class="sql_fild_value " name="sql_fild_value" value="<?= $row3['value'] ?>">
                    <button type="submit" id="btn_submit3" accesskey="s" class="btn_submit value_admin_btn btn btn_step4" <?= $row3['value']==2? "disabled" :""; ?> style="background:<?= $row3['value']==2? "#ccc" :"#1D2E58"; ?>" ><?= $row3['value']==2? "제출완료" :"제출"; ?></button>
                </form>
            </div>
    </section>
    <script>
        $(function(){
            $('.date_value').click(function(){
                var beforeStr = $('#date_value').val();

                if(beforeStr > 0){
                    alert('평가가 시작되어 수정이 불가능 합니다');
                    return false;
                }
            })
        })
    </script>
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
            <div id="bo_btn_top_app ">
                <h1 class="view_title"><?=  $category_title ?>[<?= $row33['title']?>]<?php echo $row22['wr_subject']; ?></h1>
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
                        <input type="text" name="institute_manager_name_view" id="institute_manager_name_view"  class="input_text" placeholder="성명" value="<?= str_replace($row['institute_manager_name'], '*****', $row['institute_manager_name']); ?>" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" >전공(학위)</th>
                        <td scope="col" class="view_table_text" colspan="4" >
                        <input type="text" name="institute_manager_degree_view" id="institute_manager_degree_view"  class="input_text" placeholder="전공(학위)" value="<?= str_replace($row['institute_manager_degree'], '*****', $row['institute_manager_degree']); ?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >소속</th>
                        <td scope="col" class="view_table_text" colspan="2" >
                        <input type="text" name="institute_manager_belong_view" id="institute_manager_belong_view"  class="input_text" placeholder="소속" value="<?= str_replace($row['institute_manager_belong'], '*****', $row['institute_manager_belong']); ?>" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" >직급</th>
                        <td scope="col" class="view_table_text" colspan="4" >
                        <input type="text" name="institute_manager_rank_view" id="institute_manager_rank_view"  class="input_text" placeholder="직급" value="<?= str_replace($row['institute_manager_rank'], '*****', $row['institute_manager_rank']); ?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >이메일</th>
                        <td scope="col" class="view_table_text" colspan="2" >
                        <input type="text" name="institute_manager_email_view" id="institute_manager_email_view"  class="input_text" placeholder="이메일" value="<?= str_replace($row['institute_manager_email'], '*****', $row['institute_manager_email']); ?>" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" >전화</th>
                        <td scope="col" class="view_table_text" colspan="4" >
                        <input type="text" name="institute_manager_phone_view" id="institute_manager_phone_view"  class="input_text" placeholder="전화" value="<?= str_replace($row['institute_manager_phone'], '*****', $row['institute_manager_phone']); ?>" readonly>
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

            <div class="btn_confirm write_div btn-cont">
                <a href="<?= G5_BBS_URL ?>/board.rater.php?bo_table=qa&bo_idx=<?= $_GET['bo_idx'] ?>&wr_idx=<?= $_GET['wr_idx'] ?>" class=" btn_color_white">이전</a>
                <button type="button" id="btn_submit2" accesskey="s" class="btn_submit btn btn_step4 btn_bo_val btn_color_white"><?= $row3['value']==2? "확인" :"평가"; ?></button>
                <form name="fboardlist" id="fboardlist" action="<?= https_url(G5_BBS_DIR)."/application_rater_update.php"; ?>" method="post">
                    <input type="hidden" name="business_idx" class= "business_idx_form" value="<?php echo $_GET['wr_idx']; ?>">
                    <input type="hidden" name="rater_idx" class= "sql_rater_idx" value="<?php echo $row2['idx']; ?>">
                    <input type="hidden" name="test_id" class="test_id"  value="<?= $_GET['bo_idx']?>">
                    <input type="hidden" name="value_id"  value="2">
                    <input type="hidden" class="sql_us_idx " name="us_idx" value="<?php echo $row['idx']; ?>">
                    <input type="hidden" class="sql_fild_value " name="sql_fild_value" value="<?= $row3['value'] ?>">
                    <button type="submit" id="btn_submit3" accesskey="s" class="btn_submit value_admin_btn btn btn_step4" <?= $row3['value']==2? "disabled" :""; ?> style="background:<?= $row3['value']==2? "#ccc" :"#1D2E58"; ?>" ><?= $row3['value']==2? "제출완료" :"제출"; ?></button>
                </form>
            </div>
        </form>
    </section>
    <script>
        $(function(){
            $('.date_value').click(function(){
                var beforeStr = $('#date_value').val();
                


                if(beforeStr > 0){
                    alert('평가가 시작되어 수정이 불가능 합니다');
                    return false;
                }
            })
        })
    </script>
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
            <div id="bo_btn_top_app ">
                <h1 class="view_title"><?=  $category_title ?>[<?= $row33['title']?>]<?php echo $row22['wr_subject']; ?></h1>
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
                        <input type="text" name="name_view" id="name_view"  class="input_text" placeholder="성명" value="<?= str_replace($row['name'], '*****', $row['name']); ?>" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" >전공(학위)</th>
                        <td scope="col" class="view_table_text" colspan="3" >
                        <input type="text" name="degree_view" id="degree_view"  class="input_text" placeholder="전공(학위)" value="<?= str_replace($row['degree'], '*****', $row['degree']); ?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >소속</th>
                        <td scope="col" class="view_table_text" colspan="4" >
                        <input type="text" name="belong_view" id="belong_view"  class="input_text" placeholder="소속" value="<?= str_replace($row['belong'], '*****', $row['belong']); ?>" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" >직급</th>
                        <td scope="col" class="view_table_text" colspan="3" >
                        <input type="text" name="rank_view" id="rank_view"  class="input_text" placeholder="직급" value="<?= str_replace($row['rank'], '*****', $row['rank']); ?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" >이메일</th>
                        <td scope="col" class="view_table_text" colspan="4" >
                        <input type="text" name="email_view" id="email_view"  class="input_text" placeholder="이메일" value="<?= str_replace($row['email'], '*****', $row['email']); ?>" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" >전화</th>
                        <td scope="col" class="view_table_text" colspan="3" >
                        <input type="text" name="phone_view" id="phone_view"  class="input_text" placeholder="전화" value="<?= str_replace($row['phone'], '*****', $row['phone']); ?>" readonly>
                        </td>
                    </tr>
                </tbody>
                <tbody id="view_table_upload">
                <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">자료 첨부</th>
                    </tr>
                         <?php 
                        echo $row['idx'];
                        $sql2 = " select * from g5_board_file where bo_table = 'g5_business_propos ' and wr_id = '{$row['idx']}' and bf_user_type = 0";
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

            <div class="btn_confirm write_div btn-cont">
                <a href="<?= G5_BBS_URL ?>/board.rater.php?bo_table=qa&bo_idx=<?= $_GET['bo_idx'] ?>&wr_idx=<?= $_GET['wr_idx'] ?>" class=" btn_color_white">이전</a>
                <button type="button" id="btn_submit2" accesskey="s" class="btn_submit btn btn_step4 btn_bo_val btn_color_white"><?= $row3['value']==2? "확인" :"평가"; ?></button>
                <form name="fboardlist" id="fboardlist" action="<?= https_url(G5_BBS_DIR)."/application_rater_update.php"; ?>" method="post">
                    <input type="hidden" name="business_idx" class= "business_idx_form" value="<?php echo $_GET['wr_idx']; ?>">
                    <input type="hidden" name="rater_idx" class= "sql_rater_idx" value="<?php echo $row2['idx']; ?>">
                    <input type="hidden" name="test_id" class="test_id"  value="<?= $_GET['bo_idx']?>">
                    <input type="hidden" name="value_id"  value="2">
                    <input type="hidden" class="sql_us_idx " name="us_idx" value="<?php echo $row['idx']; ?>">
                    <input type="hidden" class="sql_fild_value " name="sql_fild_value" value="<?= $row3['value'] ?>">
                    <button type="submit" id="btn_submit3" accesskey="s" class="btn_submit value_admin_btn btn btn_step4" <?= $row3['value']==2? "disabled" :""; ?> style="background:<?= $row3['value']==2? "#ccc" :"#1D2E58"; ?>" ><?= $row3['value']==2? "제출완료" :"제출"; ?></button>
                </form>
            </div>
        </form>
    </section>
    <script>
        $(function(){
            $('.date_value').click(function(){
                var beforeStr = $('#date_value').val();
                


                if(beforeStr > 0){
                    alert('평가가 시작되어 수정이 불가능 합니다');
                    return false;
                }
            })
        })
    </script>
<?php }  ?>

<script>
jQuery(function($){
    var test_fild_1 = 0;
    var test_fild_2 = 0;
    var test_fild_3 = 0;
    var test_fild_4 = 0;
    
    var test_fild_value = false;
    var test_opinion = false;

    var test_sum = 0;
    var test_fild_length = $('.test_fild').length;

    $('.bo_sch_bg, .bo_sch_cls, .btn_esc').click(function(){
        $('.bo_sch_wrap').hide();
    });

    $('.btn_bo_val').click(function(){
        var td_title = $('#title_view').val();
        $('#sql_ko_title_view').text(td_title);
        $('.bo_sch_wrap').toggle();
    }) 

    if($('#test_opinion').val() != "")
        test_opinion = true;
    else 
        test_opinion = false;

    for(var p = 1; p <= test_fild_length; p++){
        if($('#test_fild_'+p).val() != "")
            test_fild_value = true;
            
        else 
            test_fild_value = false;

            test_sum = Number(test_sum) +  Number($('#test_fild_'+p).val());
    }

    if(test_fild_value && test_opinion){
        $('#value_btn_submit').attr('disabled', false);
        $('#value_btn_submit').css({"background":"#1D2E58"});
    } else {
        $('#value_btn_submit').attr('disabled', true);
        $('#value_btn_submit').css({"background":"#ccc"});
    }

    $('.test_fild, #test_opinion').on("propertychange change keyup paste input", function(){
        test_sum = 0;

        if($('#test_opinion').val() != "")
            test_opinion = true;
        else 
            test_opinion = false;

        for(var p = 1; p <= test_fild_length; p++){
            if($('#test_fild_'+p).val() != "")
                test_fild_value = true;
            else 
                test_fild_value = false;

                test_sum = Number(test_sum) +  Number($('#test_fild_'+p).val());
        }

        $('#test_fild_sum').val(test_sum);
        if(test_fild_value && test_opinion){
            $('#value_btn_submit').attr('disabled', false);
            $('#value_btn_submit').css({"background":"#1D2E58"});
        } else {
            $('#value_btn_submit').attr('disabled', true);
            $('#value_btn_submit').css({"background":"#ccc"});
        }
    });
});
</script>
<div class="bo_sch_wrap">
<fieldset class="bo_sch" style="width:1030px; max-height:noen;height:780px;">
        <?php
            $sql = " select * from g5_write_business where wr_id = '{$_GET['wr_idx']}'";
            $result = sql_query($sql);
            $row4 = sql_fetch_array($result);

            $sql2 = "select * from rater where business_idx = '{$_GET['wr_idx']}' and  propos_idx = '{$_GET['us_idx']}' and user_id ='{$member['mb_id']}' and test_id = '{$_GET['bo_idx']}'";
            $result2 = sql_query($sql2);
            $row2 = sql_fetch_array($result2);
 
            $sql3 = " select * from rater_value where rater_idx = '{$row2['idx']}' and report_idx = '{$_GET['us_idx']}'";
            $result3 = sql_query($sql3);
            $row3 = sql_fetch_array($result3);
        ?>
        <div id="bo_btn_top_app" class="bo_btn_view_title">
            <h1 class="view_title">[<?= $row33['title']?>]<?php echo $row22['wr_subject']; ?></h1>
        </div>
           
        <form name="fsearch" method="POST" action="<?= G5_BBS_URL ?>/application_rater_update.php" enctype="multipart/form-data">
        <input type="hidden" name="business_idx" id= "business_idx" value="<?= $_GET['wr_idx'] ?>">
        <input type="hidden" name="test_id"  value="<?= $_GET['bo_idx']?>">
        <input type="hidden" name="value_id"  value="1">
        <input type="hidden" name="us_idx" id="us_idx"  value="<?= $_GET['us_idx']?>">
        <input type="hidden" name="rater_idx" id="rater_idx"  value="<?= $row2['idx'] ?>">
        <table class="view_table_app">
            <thead>
                <th colspan="1" style="width:10%" class="input_text_center">제목</th>
                <td  colspan="6" id="bo_title_view"><?= $row['ko_title']; ?></td>
            </thead>
            <tbody>
                <tr class="view_table_header_table "></tr>
                <tr class="input_text_center">
                    <th colspan="7">항목평가</th>
                </tr>
                <?php
                    $sql4 = " select * from rater_category where category_idx = '{$row4['wr_title_idx']}' and test_step = '{$_GET['bo_idx']}'";
                    $result4 = sql_query($sql4);
                    $row4 = sql_fetch_array($result4);
        
                    $sql6 = " select count(idx) as cnt from rater_fild where test_fild_idx = '{$row4['idx']}'";
                    $result6 = sql_query($sql6);
                    $row6 = sql_fetch_array($result6);

                    $sql7 = " select * from rater_fild where test_fild_idx = '{$row4['idx']}'";
                    $result7 = sql_query($sql7);
                    
                    $sum = 0;
                    ?>
                    <?php
                        for($i = 1; $row7 = sql_fetch_array($result7);$i ++){
                            if($row4['wr_title_idx'] == 2){
                    ?>
                                <tr>
                                    <th style="width:10%" class="input_text_center"><?= $row7['test_name'] ?></th>  
                                    <td style="width:40%" colspan="3">
                                       <input type="radio" name="test_fild_<?= $i ?>" id="test_radio_1" value="1" <?= $row3['test_fild_1'] == 1? 'checked' : '' ?> >
                                       <label for="test_radio_1">지원</label>
                                       <input type="radio" name="test_fild_<?= $i ?>" id="test_radio_2" value="0" <?= $row3['test_fild_1'] == 1? 'checked' : '' ?> >
                                       <label for="test_radio_2">미지원</label>
                                    </td>
                                </tr>
                    <?php
                            } else {
                                $sum = $sum + $row7['test_score'];
                                if($i % 2 == 1) echo "<tr>";
                    ?>
                                    <th style="width:10%" class="input_text_center"><?= $row7['test_name'] ?></th>  
                                    <td style="width:40%" colspan="<?= $i % 2 == 1? '1': '3' ?>">
                                        <input type="number" name="test_fild_<?= $i ?>" id="test_fild_<?= $i ?>"  class="input_text input_text_80  input_text_end test_fild" placeholder="<?= $row7['test_name'] ?>" value="<?= $row3['test_fild_'.$i] ?>" min="0" max="<?= $row7['test_score'] ?>" <?= $row3['value'] == 2 ? 'disabled' : '' ?>> 
                                        <span>/<?= $row7['test_score'] ?></span>
                                    </td>
                    <?php 
                                if($i == $row6['cnt'] && $i % 2 == 0){
                    ?>
                                    <tr>
                                        <th style="width:10%" class="input_text_center">총 점</th>  
                                        <td style="width:90%" colspan="5">
                                            <input type="number" name="test_fild_sum" id="test_fild_sum"  class="input_text input_text_80  input_text_end" placeholder="총 점" value="<?= $row3['test_sum'] ?>" min="0" max="80" readonly> 
                                            <span>/<?= $sum ?></span>
                                        </td>
                                    </tr>
                    <?php 
                                } else if($i == $row6['cnt'] && $i % 2 == 1){
                    ?>                                  
                                        <th style="width:10%" class="input_text_center">총 점</th>  
                                        <td style="width:40%" colspan="3">
                                            <input type="number" name="test_fild_sum" id="test_fild_sum"  class="input_text input_text_80  input_text_end" placeholder="총 점" value="<?= $row3['test_sum'] ?>" min="0" max="80" readonly> 
                                            <span>/<?= $sum ?></span>
                                        </td>
                                    </tr>
                    <?php 
                                }  else if($i != $row6['cnt'] && $i % 2 == 0) echo "</tr>";
                            }
                        }
                    ?>
                  <tr class="input_text_center">
                    <th>평가의견</th>
                    <td colspan="6">
                        <textarea name="test_opinion" id="test_opinion" class="input_text input_text_100 input_text_hight"  <?= $row3['value'] == 2 ? 'disabled' : '' ?> cols="20" rows="10" minlength="100"><?= $row3['test_opinion'] ?></textarea>
                    </td>
                </tr>
            </tbody>
            <tbody class="file_table_all file_table_all_rater">
                <tr class="view_table_header_table"></tr>
                <tr class="all_user_file">
                    <th scope="col" class="view_table_header " colspan="9" style="text-align:center">자료 첨부</th>
                </tr>
                <?php 

                $sql2 = " select * from g5_board_file where bo_table = 'rater' and wr_id = '{$row2['idx']}' and bf_user_type = 0";
                $result2 = sql_query($sql2);    

                while ($row55=sql_fetch_array($result2)){ ?>
                    <tr class="input-file_list">
                        <?php
                            //MB 단위 이상일때 MB 단위로 환산
                            if ($row55['bf_filesize'] >= 1024 * 1024) {
                                $fileSize = $row55['bf_filesize'] / (1024 * 1024);
                                $convertlastpage = sprintf('%0.2f', $fileSize); // 520 -> 520.00
                                $str = $convertlastpage . ' MB';
                            }
                
                            else {
                                $fileSize = $row55['bf_filesize'] / 1024;
                                $convertlastpage = sprintf('%0.2f', $fileSize); // 520 -> 520.00
                                $str = $convertlastpage . ' KB';
                            }
                        ?>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%">파일명</th>
                        <td scope="col" class="view_table_text" colspan="1" style="width:40%">
                        <input type="text" id="file_label_view1" readonly="readonly" class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="<?= $row55['bf_source']; ?>" style="margin: 0 -2px;"/>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 사이즈</th>
                        <td scope="col" class="view_table_text" colspan="1" style="width:20%">
                            <input type="hidden" value="<?= $row55['bo_table']; ?>" id="sql_file_tabel">
                            <input type="hidden" value="<?= $row55['wr_id']; ?>" id="sql_file_id">
                            <input type="hidden" value="<?= $row55['bf_no']; ?>" id="sql_file_no">
                            <input type="text" id="file-size-'+file_number+'" class="file-name file-size" style="margin: 0 -2px;" value="<?= $str ?>" readonly="readonly"/>
                            <input type="file" name="bf_file[]" id="upload_0<?= $j ?>" value="<?= $row55['bf_no']; ?>" class="file-upload file_sql_upload" <?= $row44['value'] ==2? "disabled": ""; ?> />
                            <input type="checkbox" class="del-no" id="del-no<?= $j ?>" name="del-no[]" value="<?= $row55['bf_no']; ?>" style="display:none;">
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 삭제</th>
                        <td scope="col" class="view_table_text" colspan="1" style="width:10%">
                            <label for="del-no<?= $j ?>" class="file-label del-no-btn">삭제</label>
                        </td>
                    </tr>
                <?php
                        $j ++;
                    }  
                ?>
            </tbody>
        </table> 
        <!-- <div class="rater_value_btn_contianer">
            <button type="button" class="btn_esc btn_color_white">취소</button>
            <?php if($row3['value'] != 2){ ?>
                <button type="submit" class="btn_submit" id="value_btn_submit" ><?= $row3['idx'] != ""? "수정" : "저장"; ?></button>
            <?php } ?>
        </div> -->
        <div class="rater_value_btn_contianer">
            <label for="upload01" id="file-label-btn" class="file-label file-label-btn"><img src="<?= G5_IMG_URL ?>/upload.png" alt=""> 파일 업로드  </label>

            <button type="button" class="btn_esc btn_color_white" style="float:right;">취소</button>
            <?php if($row3['value'] != 2){ ?>
            <button type="submit" class="btn_submit" id="value_btn_submit" style="float:right;"><?= $row3['idx'] != ""? "수정" : "저장"; ?></button>
            <?php } ?>
        </div>
    </form>
</fieldset>
<div class="bo_sch_bg"></div>
</div>
<script>
        $(function(){
            $('.value_admin_btn').click(function(){
                var result = confirm('정말 발표하시겠습니까?'); 
                
                if(result) {  
                    return true;

                } else { 
                    return false;
                }

             })

             $('#save').click(function(){
            $("#fwrite").append('<input type="hidden" name="save" value="1">');
        });
        $('#submission').click(function(){
            $("#fwrite").append('<input type="hidden" name="save" value="2">');
        });
        var file_number = 1;
        var disabled = '<?= $row3['value']  == 2? false : true; ?>';
        if(disabled){
            var html = '<tr class="input-file_list ">'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일명</th>'
                        +'<td scope="col" class="view_table_text" colspan="1" style="width:40%">'
                        +'    <input type="text" style="margin: 0 -2px;" id="file_label_view1" readonly="readonly" class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="파일명"/> '
                        +'</td>'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 사이즈</th>'
                        +'<td scope="col" class="view_table_text" colspan="1" style="width:20%">'
                        +'    <input type="text" id="file-size-'+file_number+'" class="file-name file-size" style="margin: 0 -2px;" value="용량" readonly="readonly"/>'
                        +'    <input type="file" name="bf_file_null[]" id="upload01" class="file-upload" />'
                        +'</td>'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 삭제</th>'
                        +'<td scope="col" class="view_table_text" colspan="1" style="width:10%">'
                        +'<button type="button" class="file-label file-del   " id="file-del<?= $i ?>">삭제</button>'
                        +'</td>'
                        +'</tr>';
            $('.file_table_all_rater').append(html);
        }


        //클릭이벤트 unbind 
        $("#file-label-btn").unbind("click"); 
        
        //클릭이벤트 bind
        $("#file-label-btn").bind("click",function(){ 
                $('#upload0'+file_number).change(function(){
                    var fileValue = $(this).val().split("\\");
                    var fileName = fileValue[fileValue.length-1]; // 파일명
                    var fileSize = this.files[0].size;
                    var str ="";

                    //MB 단위 이상일때 MB 단위로 환산
                    if (fileSize >= 1024 * 1024) {
                        fileSize = fileSize / (1024 * 1024);
                        var convertlastpage = fileSize.toFixed(2);
                        str = convertlastpage + ' MB';
                    }

                    else {
                        fileSize = fileSize / 1024;
                        var convertlastpage = fileSize.toFixed(2);
                        str = convertlastpage + ' KB';
                    }

                    if($(this).val() != ""){
                    
                        $(this).prev().val(str);
                        $(this).parent().prev().prev().children().val(fileName);
                        $(this).after('<input type="hidden" name="file_type[]" value ="0" />');
                        $(this).attr('name' , 'bf_file[]');

                        file_number++;

                        var html ='<tr class="input-file_list input-file_list_all">'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일명</th>'
                        +'<td scope="col" class="view_table_text" colspan="1" style="width:40%">'
                        +'    <input type="text" id="file_label_view'+file_number+'" readonly="readonly" class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="파일명"/>'
                        +'</td>'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 사이즈</th>'
                        +'<td scope="col" class="view_table_text" colspan="1" style="width:20%">'
                        +'    <input type="text" id="file-size-'+file_number+'" class="file-name file-size" value="용량" readonly="readonly"/>'
                        +'    <input type="file" name="bf_file_null[]" id="upload0'+file_number+'" class="file-upload"/>'
                        +'</td>'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 삭제</th>'
                        +'<td scope="col" class="view_table_text" colspan="1" style="width:10%">'
                        +'<button type="button" class="file-label file-del " id="file-del'+file_number+'">삭제</button>'
                        +'</td>'
                        +'</tr>';

                        $('.file_table_all').append(html);

                        $("#file-label-btn").attr('for', 'upload0'+file_number);

                    }
                })
            })

        $(document).on("keydown", "input[type=file]", function(event) {
            return event.key != "Enter";
        });

        $(document).off().on('click','.file-del',function(){
            var val = $(this).parent().prev().prev().find('.file-upload').val();
            var next = $(this).parent().parent().next().find('.file-upload').val();

            if(val != ""){
                $(this).parent().parent().remove();
            } else {
                if(next != undefined){
                    $(this).parent().parent().remove();
                } 
            }    
        })
        var rater_value = '<?= $row3['value'] == "" ? 0 : $row3['value']; ?>';
        $('.del-no-btn').click(function(){
            if(rater_value < 2){
                var check_val =  $(this).parent().prev().prev().find('input[type="checkbox"]').is(":checked");
                $(this).parent().prev().prev().find('.file_sql_upload').attr('name', 'report_name[]');
                $(this).parent().parent().css({'display':'none'});

            }
        })
    })
</script>
            <!-- } 게시판 검색 끝 --> 


<?php if($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>

<?php } ?>


<!-- } 게시물 작성/수정 끝 -->

