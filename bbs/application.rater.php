<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 게시판에서 두단어 이상 검색 후 검색된 게시물에 코멘트를 남기면 나오던 오류 수정
$sop = strtolower($sop);
if ($sop != 'and' && $sop != 'or')
    $sop = 'and';

@include_once($board_skin_path.'/view.head.skin.php');

$sql_search = "";
// 검색이면
if ($sca || $stx || $stx === '0') {
    // where 문을 얻음
    $sql_search = get_sql_search($sca, $sfl, $stx, $sop);
    $search_href = get_pretty_url($bo_table,'','&amp;page='.$page.$qstr);
    $list_href = get_pretty_url($bo_table);
} else {
    $search_href = '';
    $list_href = get_pretty_url($bo_table,'',$qstr);
}

if (!$board['bo_use_list_view']) {
    if ($sql_search)
        $sql_search = " and " . $sql_search;

    // 윗글을 얻음
    $sql = " select wr_id, wr_subject, wr_datetime from {$write_table} where wr_is_comment = 0 and wr_num = '{$write['wr_num']}' and wr_reply < '{$write['wr_reply']}' {$sql_search} order by wr_num desc, wr_reply desc limit 1 ";
    $prev = sql_fetch($sql);
    // 위의 쿼리문으로 값을 얻지 못했다면
    if (!$prev['wr_id'])     {
        $sql = " select wr_id, wr_subject, wr_datetime from {$write_table} where wr_is_comment = 0 and wr_num < '{$write['wr_num']}' {$sql_search} order by wr_num desc, wr_reply desc limit 1 ";
        $prev = sql_fetch($sql);
    }

    // 아래글을 얻음
    $sql = " select wr_id, wr_subject, wr_datetime from {$write_table} where wr_is_comment = 0 and wr_num = '{$write['wr_num']}' and wr_reply > '{$write['wr_reply']}' {$sql_search} order by wr_num, wr_reply limit 1 ";
    $next = sql_fetch($sql);
    // 위의 쿼리문으로 값을 얻지 못했다면
    if (!$next['wr_id']) {
        $sql = " select wr_id, wr_subject, wr_datetime from {$write_table} where wr_is_comment = 0 and wr_num > '{$write['wr_num']}' {$sql_search} order by wr_num, wr_reply limit 1 ";
        $next = sql_fetch($sql);
    }
}


// 최고, 그룹관리자라면 글 복사, 이동 가능
$copy_href = $move_href = '';
if ($write['wr_reply'] == '' && ($is_admin == 'super' || $is_admin == 'group')) {
    $copy_href = G5_BBS_URL.'/move.php?sw=copy&amp;bo_table='.$bo_table.'&amp;wr_id='.$wr_id.'&amp;page='.$page.$qstr;
    $move_href = G5_BBS_URL.'/move.php?sw=move&amp;bo_table='.$bo_table.'&amp;wr_id='.$wr_id.'&amp;page='.$page.$qstr;
}

$scrap_href = '';
$good_href = '';
$nogood_href = '';
if ($is_member) {
    // 스크랩 링크
    $scrap_href = G5_BBS_URL.'/scrap_popin.php?bo_table='.$bo_table.'&amp;wr_id='.$wr_id;

    // 추천 링크
    if ($board['bo_use_good'])
        $good_href = G5_BBS_URL.'/good.php?bo_table='.$bo_table.'&amp;wr_id='.$wr_id.'&amp;good=good';

    // 비추천 링크
    if ($board['bo_use_nogood'])
        $nogood_href = G5_BBS_URL.'/good.php?bo_table='.$bo_table.'&amp;wr_id='.$wr_id.'&amp;good=nogood';
}



$view = get_view($write, $board, $board_skin_path);

if (strstr($sfl, 'subject'))
    $view['subject'] = search_font($stx, $view['subject']);

$html = 0;
if (strstr($view['wr_option'], 'html1'))
    $html = 1;
else if (strstr($view['wr_option'], 'html2'))
    $html = 2;

$view['content'] = conv_content($view['wr_content'], $html);
if (strstr($sfl, 'content'))
    $view['content'] = search_font($stx, $view['content']);

//$view['rich_content'] = preg_replace("/{이미지\:([0-9]+)[:]?([^}]*)}/ie", "view_image(\$view, '\\1', '\\2')", $view['content']);
function conv_rich_content($matches)
{
    global $view;
    return view_image($view, $matches[1], $matches[2]);
}
$view['rich_content'] = preg_replace_callback("/{이미지\:([0-9]+)[:]?([^}]*)}/i", "conv_rich_content", $view['content']);


// 임시 저장된 글 수
$autosave_count = autosave_count($member['mb_id']);

include_once(G5_PATH.'/head.sub.php');
@include_once ($board_skin_path.'/write.head.skin.php');
include_once('./board_head.php');

$action_url = https_url(G5_BBS_DIR)."/application_rater_update.php";

echo '<!-- skin : '.(G5_IS_MOBILE ? $board['bo_mobile_skin'] : $board['bo_skin']).' -->';
include_once ($board_skin_path.'/application.rater.skin.php');

include_once('./board_tail.php');
@include_once ($board_skin_path.'/write.tail.skin.php');
include_once(G5_PATH.'/tail.sub.php');


?>