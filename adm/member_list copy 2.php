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

if($is_admin != 'super'){
    $admin = "and mb_level < 10";
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
include_once('./admin.head copy.php');

$sql = " select * {$sql_common} {$sql_search} {$admin} {$sql_order} limit {$from_record}, {$rows} ";
$result = sql_query($sql);

$colspan = 16;
?>
<div class="tbl_head01 tbl_wrap">
    <table>
    <caption><?php echo $g5['title']; ?> 목록</caption>
    <thead>
    <tr>
        <th scope="col" id="mb_list_id">아이디</th>
        <th scope="col" id="mb_list_id">이름</th>
        <th scope="col" id="mb_list_cert">소속</th>
        <th scope="col" id="mb_list_mailc">학력</th>
        <th scope="col" id="mb_list_open">직책</th>
        <th scope="col" id="mb_list_mailr">분야</th>
        <th scope="col" id="mb_list_mailr">심사위원</th>
        <?php if($is_admin == 'super'){ ?>
        <th scope="col" id="mb_list_mailr">관리자</th>
        <?php } ?>
        <th scope="col" id="mb_list_auth">선택</th>
    </tr>
    </thead>
    <tbody>
    <?php for ($i=0; $row=sql_fetch_array($result); $i++) { 
            if ($row['mb_name'] != '최고관리자'){
        ?> 
        <tr class="<?php echo $bg; ?> form_rater">
            
            <td headers="mb_list_id" class="td_name sv_use"><?php echo $row['mb_id'] ?></td>
            <td headers="mb_list_name" class="td_mbname"><?php echo get_text($row['mb_name']); ?></td>
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
                <input type="radio" class="level" id="rater<?= $i ?>" name="drone<?= $i ?>" value="1" <?= $row['mb_level'] == 5?"checked": "" ?>>
            </td>
            <?php if($is_admin == 'super'){ ?>
            <td headers="mb_list_mailr">
                <input type="radio" class="level" id="admin<?= $i ?>" name="drone<?= $i ?>" value="2" <?= $row['mb_level'] == 10?"checked": "" ?>>
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
                    <button type="submit" class="rater_button">선발</button>
                </form>
            </td>
        </tr>
    <?php
        }
    }
    

    if ($i == 0)
        echo "<tr><td colspan=\"".$colspan."\" class=\"empty_table\">자료가 없습니다.</td></tr>";
    ?>
    </tbody>
    </table>
</div>
        <?= $total_page ?>
    <?php echo get_paging( $config['cf_write_pages'], $page, $total_page, '?'.$qstr.'&amp;page='); ?>
<script>
    $(function(){
        $('.rater_button').click(function() {
            if(confirm("선발 하시겠습니까?")){
                return true;
            }
            return false;
        });

        $('.belong').change(function(){
            var belong = $(this).val();
            $(this).parents('.form_rater').find('.rater_belong').val(belong);
        })
        $('.degree').change(function(){
            var degree = $(this).val();
            $(this).parents('.form_rater').find('.rater_degree').val(degree);
        })
        $('.rank').change(function(){
            var rank = $(this).val();
            $(this).parents('.form_rater').find('.rater_rank').val(rank);
        })

        $('.category').change(function(){
            var category = $(this).val();
            $(this).parents('.form_rater').find('.rater_category').val(category);
        })

        $('.level').change(function(){
            var level = $(this).val();
            $(this).parents('.form_rater').find('.rater_level').val(level);
        })
    })

</script>

<?php
    include_once('./admin.tail copy.php');
?>
