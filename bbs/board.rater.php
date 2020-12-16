<?php
include_once('./_common.php');
// if (!$member['mb_id'])
// {
//     alert('로그인 하십시오.', G5_BBS_URL.'/login.php?url=' . urlencode(correct_goto_url(G5_ADMIN_URL)));
// }


if (!$board['bo_table']) {
    alert('존재하지 않는 게시판입니다.', G5_URL);
 }



check_device($board['bo_device']);

if (isset($write['wr_is_comment']) && $write['wr_is_comment']) {
    goto_url(get_pretty_url($bo_table, $write['wr_parent'], '#c_'.$wr_id));
}

if (!$bo_table) {
    $msg = "bo_table 값이 넘어오지 않았습니다.\\n\\nboard.php?bo_table=code 와 같은 방식으로 넘겨 주세요.";
    alert($msg);
}

$g5['board_title'] = ((G5_IS_MOBILE && $board['bo_mobile_subject']) ? $board['bo_mobile_subject'] : $board['bo_subject']);

$g5['title'] = $g5['board_title'].' '.$page.' 페이지';

$board_border = "title_border";
$board_user = 2;

include_once(G5_PATH.'/head.sub.php');

$width = $board['bo_table_width'];
if ($width <= 100)
    $width .= '%';
else
    $width .='px';

// IP보이기 사용 여부
$ip = "";
$is_ip_view = $board['bo_use_ip_view'];
if ($is_admin) {
    $is_ip_view = true;
    if ($write && array_key_exists('wr_ip', $write)) {
        $ip = $write['wr_ip'];
    }
} else {
    // 관리자가 아니라면 IP 주소를 감춘후 보여줍니다.
    if (isset($write['wr_ip'])) {
        $ip = preg_replace("/([0-9]+).([0-9]+).([0-9]+).([0-9]+)/", G5_IP_DISPLAY, $write['wr_ip']);
    }
}

// 분류 사용
$is_category = false;
$category_name = '';
if ($board['bo_use_category']) {
    $is_category = true;
    if (array_key_exists('ca_name', $write)) {
        $category_name = $write['ca_name']; // 분류명
    }
}

// 추천 사용
$is_good = false;
if ($board['bo_use_good'])
    $is_good = true;

// 비추천 사용
$is_nogood = false;
if ($board['bo_use_nogood'])
    $is_nogood = true;

$admin_href = "";
// 최고관리자 또는 그룹관리자라면
if ($member['mb_id'] && ($is_admin === 'super' || $group['gr_admin'] === $member['mb_id']))
    $admin_href = G5_ADMIN_URL.'/board_form.php?w=u&amp;bo_table='.$bo_table;

$board_rater_border = "board_nav_list title_border";
$board_user = '';
$board_user = 2;
include_once(G5_BBS_PATH.'/board_head.php');

// 게시물 아이디가 있다면 게시물 보기를 INCLUDE
if (isset($_GET['wr_idx']) && empty($_GET['us_idx'])) {
    include_once(G5_BBS_PATH.'/view.rater.php');
} else if(isset($_GET['wr_idx']) && isset($_GET['us_idx'])){
    include_once (G5_BBS_PATH.'/application.rater.php');
} else{
    include_once (G5_BBS_PATH.'/list.rater.php');
}

// 전체목록보이기 사용이 "예" 또는 wr_id 값이 없다면 목록을 보임
//if ($board['bo_use_list_view'] || empty($wr_id))
if ($member['mb_level'] >= $board['bo_list_level'] && $board['bo_use_list_view'] || empty($wr_id))

include_once(G5_BBS_PATH.'/board_tail.php');

echo "\n<!-- 사용스킨 : ".(G5_IS_MOBILE ? $board['bo_mobile_skin'] : $board['bo_skin'])." -->\n";

include_once(G5_PATH.'/tail.sub.php');
?>
