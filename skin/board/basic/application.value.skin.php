<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
    
$sql1 = " SELECT * FROM `g5_business_propos` where idx = '{$_GET['us_idx']}'";
$result1 = sql_query($sql1);
$row=sql_fetch_array($result1);

$sql1 = " SELECT * FROM `g5_write_business` where wr_id = '{$row['bo_idx']}'";
$result1 = sql_query($sql1);
$row22=sql_fetch_array($result1);

?>
<aside id="bo_side">
    <h2 class="aside_nav_title">지원결과 확인</h2>
    <?php $class_get =  $_GET['bo_idx'] == '1'?"aisde_click":""; ?>
    <a class="aside_nav aisde_click" href="<?= G5_BBS_URL ?>/board.value.php?bo_table=business&bo_idx=1">지원결과 확인</a>
</aside>
<section id="bo_v" style="width:80%;">
    <?php
        $sql66 = " select * from rater where user_id = '{$member['mb_id']}' and business_idx = '{$_GET['wr_idx']}' and test_id = '{$_GET['bo_idx']}'";
        $result66 = sql_query($sql66);
        $row66 = sql_fetch_array($result66);
    ?>
    
    <div class =" ">
        <div class="bo_w_tit write_div">
            <div id="bo_btn_top_app">
                <h1 class="view_title">지원결과 확인</h1>
            </div>
        </div>

        <table class="view_table_app">
            <thead>
                <tr>
                    <th scope="col" class="view_table_header"colspan="1" style="width: 10%;">제목</th>
                    <td scope="col" class="view_table_title" colspan="8" style="">
                        <input type="text" name="title_view" id="title_view"  class="input_text " placeholder="제목" value="<?= $row22['wr_subject']; ?>"  readonly>
                    </td>
                </tr>
                <tr>
                    <th scope="col" class="view_table_header" style="">접수번호</th>
                    <td scope="col" class="view_table_text" colspan="4" style="">
                    <input type="text" name="info_number_view" id="info_number_view"  class="input_text" placeholder="접수번호" value="<?= $row['info_number']; ?>"  readonly>
                    </td>
                    <th scope="col" class="view_table_header" style="">과제번호</th>
                    <td scope="col" class="view_table_text" colspan="4" style="">
                    <input type="text" name="quest_number_view" id="quest_number_view"  class="input_text" placeholder="과제번호" value="<?= $row['quest_number']; ?>"readonly>
                    </td>
                </tr>
            </thead>
            <tbody id="input_file_cont">
                <tr class="view_table_header_table"></tr>
                <tr>
                    <th scope="col" class="view_table_header " colspan="9">연구과제명</th>
                </tr>
                <tr>
                    <th scope="col" class="view_table_header" colspan="1" style="">과제명(국문)</th>
                    <td scope="col" class="view_table_text" colspan="8" style="">
                    <input type="text" name="ko_title_view" id="ko_title_view"  class="input_text" placeholder="과제명(국문)" value="<?= $row['ko_title']; ?>" readonly>
                    </td>
                </tr>
                <tr>
                    <th scope="col" class="view_table_header" colspan="1" style="">과제명(영문)</th>
                    <td scope="col" class="view_table_text" colspan="8" style="">
                    <input type="text" name="en_title_view" id="en_title_view"  class="input_text" placeholder="과제명(영문)" value="<?= $row['en_title']; ?>" readonly>
                    </td>
                </tr>
                <tr class="view_table_header_table"></tr>
                <tr>
                    <th scope="col" class="view_table_header " colspan="9">연구책임자</th>
                </tr>
                <tr>
                    <th scope="col" class="view_table_header" colspan="1" style="">성명</th>
                    <td scope="col" class="view_table_text" colspan="4" style="">
                    <input type="text" name="name_view" id="name_view"  class="input_text" placeholder="성명" value="<?= $row['name']; ?>" readonly>
                    </td>
                    <th scope="col" class="view_table_header" colspan="1" style="">전공(학위)</th>
                    <td scope="col" class="view_table_text" colspan="3" style="">
                    <input type="text" name="degree_view" id="degree_view"  class="input_text" placeholder="전공(학위)" value="<?= $row['degree']; ?>" readonly>
                    </td>
                </tr>
                <tr>
                    <th scope="col" class="view_table_header" colspan="1" style="">소속</th>
                    <td scope="col" class="view_table_text" colspan="4" style="">
                    <input type="text" name="belong_view" id="belong_view"  class="input_text" placeholder="소속" value="<?= $row['belong']; ?>" readonly>
                    </td>
                    <th scope="col" class="view_table_header" colspan="1" style="">직급</th>
                    <td scope="col" class="view_table_text" colspan="3" style="">
                    <input type="text" name="rank_view" id="rank_view"  class="input_text" placeholder="직급"  value="<?= $row['rank']; ?>" readonly >
                    </td>
                </tr>
                <tr>
                    <th scope="col" class="view_table_header" colspan="1" style="">이메일</th>
                    <td scope="col" class="view_table_text" colspan="4" style="">
                    <input type="text" name="email_view" id="email_view"  class="input_text" placeholder="이메일" value="<?= $row['email']; ?>" readonly>
                    </td>
                    <th scope="col" class="view_table_header" colspan="1" style="">전화</th>
                    <td scope="col" class="view_table_text" colspan="3" style="">
                    <input type="text" name="phone_view" id="phone_view"  class="input_text" placeholder="전화" value="<?= $row['phone']; ?>" readonly>
                    </td>
                </tr>
            
                <tr>
                    <th scope="col" class="view_table_header" style="">공동연구원</th>
                    <td scope="col" class="view_table_text" colspan="4" style="">
                    <input type="text" name="main_member_view" id="main_member_view"  class="input_text" placeholder="명"  value="<?= number_format($row['main_member']); ?>명" readonly>
                    </td>
                    <th scope="col" class="view_table_header" style="">연구원보조</th>
                    <td scope="col" class="view_table_text" colspan="3" style="">
                    <input type="text" name="sub_member_view" id="sub_member_view"  class="input_text" placeholder="명"  value="<?= number_format($row['sub_member']); ?>명" readonly>
                    </td>
                </tr>
                <tr class="view_table_header_table"></tr>
                <tr>
                    <th scope="col" class="view_table_header " colspan="9">연구정보</th>
                </tr>
                <tr>
                    <th scope="col" class="view_table_header" colspan="1"style="">총 연구 기간</th>
                    <td scope="col" class="view_table_text" colspan="8" style="">
                        <input type="text" name="date_start_view" id="date_start_view" placeholder="총 연구 기간"  class="input_text"  value="<?= $row['date_start']; ?> ~ <?= $row['date_end']; ?>" readonly>
                    </td>
                </tr>
                <tr>
                    <th scope="col" class="view_table_header" colspan="1" style="">연구비신청액</th>
                    <td scope="col" class="view_table_text" colspan="8" style="">
                    <input type="text" name="money_view" id="money_view"  class="input_text" placeholder="연구비신청액" value="<?= number_format($row['money']); ?>원" readonly>
                    </td>
                </tr>
                <tr>
                    <th scope="col" class="view_table_header" colspan="1" style="">1차년 연구비</th>
                    <td scope="col" class="view_table_text" colspan="4" style=" width:40%">
                    <input type="text" name="one_year_view" id="one_year_view"  class="input_text" placeholder="1차년 연구비" value="<?= number_format($row['one_year']); ?>원" readonly>
                    </td>
                    <th scope="col" class="view_table_header" colspan="1" style="">2차년 연구비</th>
                    <td scope="col" class="view_table_text" colspan="3" style="">
                        <input type="text" name="two_year_view" id="two_year_view"  class="input_text" placeholder="2차년 연구비" value="<?= number_format($row['two_year']); ?>원" readonly>
                    </td>
                </tr>
                <tr class="view_table_header_table"></tr>
                <tr>
                    <th scope="col" class="view_table_header " colspan="9">자료 첨부</th>
                </tr>
            </tbody>
            <tbody id="view_table_upload">
                <?php
                    $sql = " select * from g5_board_file where bo_table = 'g5_business_propos' and wr_id = '{$_GET['us_idx']}'";
                    $result = sql_query($sql);

                     for ($i=0; $row_list = sql_fetch_array($result); $i++) {
                        if (isset($row_list['bf_source'][$i])) {
                    ?>
                        <tr class="">
                            <th scope="col" colspan="1" class="view_table_header" style="width:10%;">첨부파일</th>
                            <td scope="col" colspan="1" class="view_table_text" style="width:10%;">
                                <img src="<?php echo G5_IMG_URL ?>/download_icon.png" alt="<?php echo $config['cf_title']; ?>">
                            </td>
                            <td scope="col" colspan="5" class="view_table_text" style="width:80%;">
                                <a href="<?php echo $view['file'][$i]['href']; ?>" class=""><?php echo $row_list['bf_source'] ?></a>
                            </td>
                        </tr>
                    <?php
                        }
                    }
            ?>
            </tbody>
        </table>
        <div class="btn_confirm write_div btn-cont">
        <a href="<?= G5_BBS_URL ?>/board.value.php?bo_table=business&bo_idx=<?= $_GET['bo_idx'] ?>" class="btn_cancel ">확인</a>
        </div>
</div>
</section>


<?php if($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>

<?php } ?>


<!-- } 게시물 작성/수정 끝 -->

