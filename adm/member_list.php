<?php
$sub_menu = "200100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

$sql_common = " from {$g5['member_table']} ";

$sql_search = " where (1) ";
if ($stx) {
    $sql_search .= " and ( ";
    switch ($sfl) {
        case 'mb_point' :
            $sql_search .= " ({$sfl} >= '{$stx}') ";
            break;
        case 'mb_level' :
            $sql_search .= " ({$sfl} = '{$stx}') ";
            break;
        case 'mb_tel' :
        case 'mb_hp' :
            $sql_search .= " ({$sfl} like '%{$stx}') ";
            break;
        default :
            $sql_search .= " ({$sfl} like '{$stx}%') ";
            break;
    }
    $sql_search .= " ) ";
}

if ($is_admin != 'super')
    $sql_search .= " and mb_level <= '{$member['mb_level']}' ";

if (!$sst) {
    $sst = "mb_datetime";
    $sod = "desc";
}

$sql_order = " order by {$sst} {$sod} ";

$sql = " select count(*) as cnt {$sql_common} {$sql_search} {$sql_order} ";
$row = sql_fetch($sql);
$total_count = $row['cnt'];

$rows = 10;
$total_page  = ceil($total_count / $rows);  // 전체 페이지 계산
if ($page < 1) $page = 1; // 페이지가 없으면 첫 페이지 (1 페이지)
$from_record = ($page - 1) * $rows; // 시작 열을 구함

// 탈퇴회원수
$sql = " select count(*) as cnt {$sql_common} {$sql_search} and mb_leave_date <> '' {$sql_order} ";
$row = sql_fetch($sql);
$leave_count = $row['cnt'];

// 차단회원수
$sql = " select count(*) as cnt {$sql_common} {$sql_search} and mb_intercept_date <> '' {$sql_order} ";
$row = sql_fetch($sql);
$intercept_count = $row['cnt'];

$listall = '<a href="'.$_SERVER['SCRIPT_NAME'].'" class="ov_listall">전체목록</a>';

$g5['title'] = '회원관리';
include_once('./admin.head1.php');

$sql = " select * {$sql_common} {$sql_search} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);

$colspan = 16;
?>

<div class="local_ov01 local_ov">
    <?php echo $listall ?>
    <span class="btn_ov01"><span class="ov_txt">총회원수 </span><span class="ov_num"> <?php echo number_format($total_count) ?>명 </span></span>
    <a href="?sst=mb_intercept_date&amp;sod=desc&amp;sfl=<?php echo $sfl ?>&amp;stx=<?php echo $stx ?>" class="btn_ov01" data-tooltip-text="차단된 순으로 정렬합니다.&#xa;전체 데이터를 출력합니다."> <span class="ov_txt">차단 </span><span class="ov_num"><?php echo number_format($intercept_count) ?>명</span></a>
    <a href="?sst=mb_leave_date&amp;sod=desc&amp;sfl=<?php echo $sfl ?>&amp;stx=<?php echo $stx ?>" class="btn_ov01" data-tooltip-text="탈퇴된 순으로 정렬합니다.&#xa;전체 데이터를 출력합니다."> <span class="ov_txt">탈퇴  </span><span class="ov_num"><?php echo number_format($leave_count) ?>명</span></a>
</div>

<form id="fsearch" name="fsearch" class="local_sch01 local_sch" method="get">

<label for="sfl" class="sound_only">검색대상</label>
<select name="sfl" id="sfl">
    <option value="mb_id"<?php echo get_selected($_GET['sfl'], "mb_id"); ?>>회원아이디</option>
    <option value="mb_name"<?php echo get_selected($_GET['sfl'], "mb_name"); ?>>이름</option>
</select>
<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
<input type="text" name="stx" value="<?php echo $stx ?>" id="stx" required class="required frm_input">
<input type="submit" class="btn_submit" value="검색">

</form>

<div class="local_desc01 local_desc">
    <p>
        회원자료 삭제 시 다른 회원이 기존 회원아이디를 사용하지 못하도록 회원아이디, 이름, 닉네임은 삭제하지 않고 영구 보관합니다.
    </p>
</div>


<form name="fmemberlist" id="fmemberlist" action="./member_list_update.php" onsubmit="return fmemberlist_submit(this);" method="post">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<input type="hidden" name="token" value="">

<div class="tbl_head01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <thead>
    <!-- <tr>
        <th scope="col" id="mb_list_chk" rowspan="2" >
            <label for="chkall" class="sound_only">회원 전체</label>
            <input type="checkbox" name="chkall" value="1" id="chkall" onclick="check_all(this.form)">
        </th>
        <th scope="col" id="mb_list_id" colspan="2"><?php echo subject_sort_link('mb_id') ?>아이디</a></th>
        <th scope="col" rowspan="2" id="mb_list_cert"><?php echo subject_sort_link('mb_certify', '', 'desc') ?>본인확인</a></th>
        <th scope="col" id="mb_list_mailc"><?php echo subject_sort_link('mb_email_certify', '', 'desc') ?>메일인증</a></th>
        <th scope="col" id="mb_list_open"><?php echo subject_sort_link('mb_open', '', 'desc') ?>정보공개</a></th>
        <th scope="col" id="mb_list_mailr"><?php echo subject_sort_link('mb_mailling', '', 'desc') ?>메일수신</a></th>
        <th scope="col" id="mb_list_auth">상태</th>
        <th scope="col" id="mb_list_mobile">휴대폰</th>
        <th scope="col" id="mb_list_lastcall"><?php echo subject_sort_link('mb_today_login', '', 'desc') ?>최종접속</a></th>
        <th scope="col" id="mb_list_grp">접근그룹</th>
        <th scope="col" rowspan="2" id="mb_list_mng">관리</th>
    </tr>
    <tr>
        <th scope="col" id="mb_list_name"><?php echo subject_sort_link('mb_name') ?>이름</a></th>
        <th scope="col" id="mb_list_nick"><?php echo subject_sort_link('mb_nick') ?>닉네임</a></th>
        <th scope="col" id="mb_list_sms"><?php echo subject_sort_link('mb_sms', '', 'desc') ?>SMS수신</a></th>
        <th scope="col" id="mb_list_adultc"><?php echo subject_sort_link('mb_adult', '', 'desc') ?>성인인증</a></th>
        <th scope="col" id="mb_list_auth"><?php echo subject_sort_link('mb_intercept_date', '', 'desc') ?>접근차단</a></th>
        <th scope="col" id="mb_list_deny"><?php echo subject_sort_link('mb_level', '', 'desc') ?>권한</a></th>
        <th scope="col" id="mb_list_tel">전화번호</th>
        <th scope="col" id="mb_list_join"><?php echo subject_sort_link('mb_datetime', '', 'desc') ?>가입일</a></th>
        <th scope="col" id="mb_list_point"><?php echo subject_sort_link('mb_point', '', 'desc') ?> 포인트</a></th>
    </tr> -->

    <tr>
        <th scope="col" id="mb_list_id">아이디</th>
        <th scope="col" id="mb_list_id">이름</th>
        <th scope="col" id="mb_list_join"><?php echo subject_sort_link('mb_datetime', '', 'desc') ?>가입일</a></th>
        <th scope="col" id="mb_list_cert">소속</th>
        <th scope="col" id="mb_list_mailc">학력</th>
        <th scope="col" id="mb_list_open">직책</th>
        <th scope="col" id="mb_list_mailr">분야</th>
        <th scope="col" id="mb_list_user">일반유저</th>
        <th scope="col" id="mb_list_mailr">심사위원</th>
        <?php if($is_admin == 'super'){ ?>
        <th scope="col" id="mb_list_mailr">관리자</th>
        <?php } ?>
        <th scope="col" id="mb_list_auth">선택</th>
    </tr>
    </thead>
    <tbody>
    <?php

    for ($i=0; $row=sql_fetch_array($result); $i++) {
       ?>
  
    <tr class="<?php echo $bg; ?> form_raters">
            
            <td headers="mb_list_id" class="td_name sv_use"><?php echo $row['mb_id'] ?></td>
            <td headers="mb_list_name" class="td_mbname"><?php echo get_text($row['mb_name']); ?></td>
            <td headers="mb_list_name" class="td_mbname"><?= substr($row['mb_datetime'],5,5); ?></td>
            <td headers="mb_list_cert"  class="td_mbcert">
                <input type="text" name="belong" placeholder="소속" class="belong" value="<?= $row['belong']? $row['belong'] : "" ?>">
            </td>
            <td headers="mb_list_mailc">
                <input type="text" name="degree" placeholder="학력" class="degree" value="<?= $row['degree'] ?>">
            </td>
            <td headers="mb_list_open">
                <input type="text" name="rank" placeholder="직책" class="rank" value="<?= $row['rank'] ?>">
            </td>
            <td headers="mb_list_mailr">
                <input type="text" name="category" placeholder="분야" class="category" value="<?= $row['category'] ?>">
            </td>
            <td headers="mb_list_mailr">
                <input type="radio" class="level" id="rater<?= $i ?>" name="drone<?= $i ?>" value="1" <?= $row['mb_level'] == 2?"checked": "" ?>>
            </td>
            <td headers="mb_list_mailr">
                <input type="radio" class="level" id="rater<?= $i ?>" name="drone<?= $i ?>" value="2" <?= $row['mb_level'] == 5?"checked": "" ?>>
            </td>
            <?php if($is_admin == 'super'){ ?>
            <td headers="mb_list_mailr">
                <input type="radio" class="level" id="admin<?= $i ?>" name="drone<?= $i ?>" value="3" <?= $row['mb_level'] == 10?"checked": "" ?>>
            </td>
            <?php } ?>
            <td headers="mb_list_auth" class="td_mbstat">
                <form name="fboardlist" class="form_rater" name="form_rater"  method="POST" action="../adm/member_list_update.php" >
                    <input type="hidden" name="idx" class="rater_idx" value="<?= $row['mb_no'] ?>">
                    <input type="hidden" name="belong" class="rater_belong" value="<?= $row['belong']? $row['belong'] : ""?>">
                    <input type="hidden" name="degree" class="rater_degree" value="<?= $row['degree']? $row['degree'] : ""?>">
                    <input type="hidden" name="rank" class="rater_rank" value="<?= $row['rank']? $row['rank'] : ""?>">
                    <input type="hidden" name="category" class="rater_category" value="<?= $row['category']? $row['category'] : ""?>">
                    <input type="hidden" name="level" class="rater_level" value="">
                    <button type="submit" class="btn btn_03 btn_rater">선발</button>
                </form>
            </td>
            
        </tr>

    <?php
    }
    if ($i == 0)
        echo "<tr><td colspan=\"".$colspan."\" class=\"empty_table\">자료가 없습니다.</td></tr>";
    ?>
    </tbody>
    </table>
</div>

<div class="btn_fixed_top">
    <!-- <input type="submit" name="act_button" value="선택수정" onclick="document.pressed=this.value" class="btn btn_02">
    <input type="submit" name="act_button" value="선택삭제" onclick="document.pressed=this.value" class="btn btn_02"> -->
    <?php if ($is_admin == 'super') { ?>
    <a href="./member_form.php" id="member_add" class="btn btn_01">회원추가</a>
    <?php } ?>

</div>


</form>

<?php echo get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;page='); ?>

<script>
function fmemberlist_submit(f)
{
    // if (!is_checked("chk[]")) {
    //     alert(document.pressed+" 하실 항목을 하나 이상 선택하세요.");
    //     return false;
    // }

    if(document.pressed == "선택삭제") {
        if(!confirm("선택한 자료를 정말 삭제하시겠습니까?")) {
            return false;
        }
    }

    return true;
}

$(function(){
    $(function(){
        $('.rater_button').click(function() {
            if(confirm("선발 하시겠습니까?")){
                return true;
            }
            return false;
        });

        $('.belong').change(function(){
            var belong = $('.belong').val();
            $('.belong').parents('.form_raters').find('.rater_belong').val(belong);
        })
        $('.degree').change(function(){
            var degree = $('.belong').val();
            $('.belong').parents('.form_raters').find('.rater_degree').val(degree);
        })
        $('.rank').change(function(){
            var rank = $('.belong').val();
            $('.belong').parents('.form_raters').find('.rater_rank').val(rank);
        })

        $('.category').change(function(){
            var category = $('.belong').val();
            $('.belong').parents('.form_raters').find('.rater_category').val(category);
        })

        $('.btn_rater').click(function(){
            var level = $(this).parents('.form_raters').find('.level:checked').val();
            $(this).parent().find('.rater_level').val(level);
        })
    })
})
</script>

<?php
include_once ('./admin.tail.php');
?>
