<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 분류 사용 여부
$is_category = false;
$category_option = '';
if ($board['bo_use_category']) {
    $is_category = true;
    $category_href = get_pretty_url($bo_table);

    $category_option .= '<li><a href="'.$category_href.'"';
    if ($sca=='')
        $category_option .= ' id="bo_cate_on"';
    $category_option .= '>전체</a></li>';

    $categories = explode('|', $board['bo_category_list']); // 구분자가 , 로 되어 있음
    for ($i=0; $i<count($categories); $i++) {
        $category = trim($categories[$i]);
        if ($category=='') continue;
        $category_option .= '<li><a href="'.(get_pretty_url($bo_table,'','sca='.urlencode($category))).'"';
        $category_msg = '';
        if ($category==$sca) { // 현재 선택된 카테고리라면
            $category_option .= ' id="bo_cate_on"';
            $category_msg = '<span class="sound_only">열린 분류 </span>';
        }
        $category_option .= '>'.$category_msg.$category.'</a></li>';
    }
}

$sop = strtolower($sop);
if ($sop != 'and' && $sop != 'or')
    $sop = 'and';

// 분류 선택 또는 검색어가 있다면
$stx = trim($stx);
//검색인지 아닌지 구분하는 변수 초기화
$is_search_bbs = false;


if( $_GET['bo_idx'] == 1) {
    $value = 'value';
} else if($_GET['bo_idx'] == 2){
    $value = 'report_val_1';
}

if ($sca || $stx || $stx === '0') {     //검색이면
    $p = 0;

    $is_search_bbs = true;      //검색구분변수 true 지정
    $sql_search = get_sql_search($sca, $sfl, $stx, $sop);

    // 가장 작은 번호를 얻어서 변수에 저장 (하단의 페이징에서 사용)
    $sql = " select MIN(wr_num) as min_wr_num from g5_business_propos ";
    $row = sql_fetch($sql);
    $min_spt = (int)$row['min_wr_num'];

    if (!$spt) $spt = $min_spt;

    $sql_search .= " and (wr_id between {$spt} and ({$spt} + {$config['cf_search_part']})) ";

    // 원글만 얻는다. (코멘트의 내용도 검색하기 위함)
    // 라엘님 제안 코드로 대체 http://sir.kr/g5_bug/2922
    $sql2 = " SELECT count(bo_idx) as cnt FROM g5_business_propos as gbp INNER JOIN g5_write_business as gwb ON bo_idx = wr_id WHERE gwb.mb_id='{$member['mb_id']}' AND wr_subject LIKE '%".$stx."%'";
    $row = sql_fetch($sql2);
    $total_count = $row['cnt'];
    
    $title_text = '검색';

   
} else {
    $sql_search = "";

    $sql = " SELECT COUNT(DISTINCT `idx`) AS `cnt` FROM g5_business_propos where mb_id = '$member[mb_id]' AND $value = '4'";
    $row = sql_fetch($sql);
    $total_count = $row['cnt'];

}

$page_rows = 10;
$list_page_rows = 10;

if ($page < 1) { $page = 1; } // 페이지가 없으면 첫 페이지 (1 페이지)

// 년도 2자리
$today2 = G5_TIME_YMD;

$list = array();
$i = 0;
$notice_count = 0;
$notice_array = array();

$total_page  = ceil($total_count / $page_rows);  // 전체 페이지 계산
$from_record = ($page - 1) * $page_rows; // 시작 열을 구함


// 공지글이 있으면 변수에 반영
if(!empty($notice_array)) {
    $from_record -= count($notice_array);

    if($from_record < 0)
        $from_record = 0;

    if($notice_count > 0)
        $page_rows -= $notice_count;

    if($page_rows < 0)
        $page_rows = $list_page_rows;
}

// 관리자라면 CheckBox 보임
$is_checkbox = false;
if ($is_member && ($is_admin == 'super' || $group['gr_admin'] == $member['mb_id'] || $board['bo_admin'] == $member['mb_id']))
    $is_checkbox = true;

// 정렬에 사용하는 QUERY_STRING
$qstr2 = 'bo_table='.$bo_table.'&amp;sop='.$sop;

// 0 으로 나눌시 오류를 방지하기 위하여 값이 없으면 1 로 설정
$bo_gallery_cols = $board['bo_gallery_cols'] ? $board['bo_gallery_cols'] : 1;
$td_width = (int)(100 / $bo_gallery_cols);

// 정렬
// 인덱스 필드가 아니면 정렬에 사용하지 않음
//if (!$sst || ($sst && !(strstr($sst, 'wr_id') || strstr($sst, "wr_datetime")))) {
if (!$sst) {
    if ($board['bo_sort_field']) {
        $sst = $board['bo_sort_field'];
    } else {
        $sst  = "wr_num, wr_reply";
        $sod = "";
    }
} else {
    $board_sort_fields = get_board_sort_fields($board, 1);
    if (!$sod && array_key_exists($sst, $board_sort_fields)) {
        $sst = $board_sort_fields[$sst];
    } else {
        // 게시물 리스트의 정렬 대상 필드가 아니라면 공백으로 (nasca 님 09.06.16)
        // 리스트에서 다른 필드로 정렬을 하려면 아래의 코드에 해당 필드를 추가하세요.
        // $sst = preg_match("/^(wr_subject|wr_datetime|wr_hit|wr_good|wr_nogood)$/i", $sst) ? $sst : "";
        $sst = preg_match("/^(wr_datetime|wr_hit|wr_good|wr_nogood)$/i", $sst) ? $sst : "";
    }
}

if(!$sst)
    $sst  = "wr_num, wr_reply";

if ($sst) {
    $sql_order = " order by idx ";
}

$last_idx = "";
// 여기 입니다.
if ($is_search_bbs) {
    $sql = "SELECT idx,bo_idx,bo_title_idx,gwb.mb_id,wr_subject FROM g5_business_propos as gbp INNER JOIN g5_write_business as gwb ON bo_idx = wr_id WHERE gwb.mb_id='{$member['mb_id']}' AND wr_subject LIKE '%".$stx."%' {$sql_order} limit {$from_record}, $page_rows ";
    // $sql = " select  * from {$write_table} where {$sql_search}  and wr_title_idx = '{$_GET['bo_idx']}'";
} else {
    $sql = " select * from g5_business_propos where mb_id = '$member[mb_id]' AND $value = '4'";
    $sql .= " {$sql_order} limit {$from_record}, $page_rows ";
}


// 페이지의 공지개수가 목록수 보다 작을 때만 실행
$j = 0;
if($page_rows > 0) {
    

    $result = sql_query($sql);
    $k = 0;
    // if ($is_search_bbs) {
    //     while ($row = sql_fetch_array($result)) {
    //         $sql2 = " select  * from g5_business_propos where bo_idx='{$row['wr_id']}' and mb_id = '{$member['mb_id']}'";
            
    //         $result2 = sql_query($sql2);
    //         $row2 = sql_fetch_array($result2);
            
    //         if($row2['idx'] != ""){

    //             // 검색일 경우 wr_id만 얻었으므로 다시 한행을 얻는다
    //             // if ($is_search_bbs)
    //             //     $row = sql_fetch(" select * from {$write_table} where wr_id = '{$row['wr_parent']}' and wr_title_idx = '{$_GET['bo_idx']}'");
    //             $list[$i] = get_list($row, $board, $board_skin_url, G5_IS_MOBILE ? $board['bo_mobile_subject_len'] : $board['bo_subject_len']);
    //             // if (strstr($sfl, 'subject')) {
    //             //     $list[$i]['subject'] = search_font($stx, $list[$i]['subject']);
    //             // }
    //             $list[$i]['idx'] = $row2['idx'];
    //             $list[$i]['is_notice'] = false;
    //             $list_num = $total_count - ($page - 1) * $list_page_rows - $notice_count;
    //             $list[$i]['num'] = $list_num - $k;
                    
    //             $last_idx = $row2['bo_idx'];
    //             $i++;
    //             $k++;
    //         }
    //         if(10 == $k){ break;}
    //     }
    // } else {
        while ($row = sql_fetch_array($result))
        {
            // 검색일 경우 wr_id만 얻었으므로 다시 한행을 얻는다
            // if ($is_search_bbs)
            //     $row = sql_fetch(" select * from {$write_table} where wr_id = '{$row['wr_parent']}' and wr_title_idx = '{$_GET['bo_idx']}'");
            $list[$i] = get_list($row, $board, $board_skin_url, G5_IS_MOBILE ? $board['bo_mobile_subject_len'] : $board['bo_subject_len']);
            // if (strstr($sfl, 'subject')) {
            //     $list[$i]['subject'] = search_font($stx, $list[$i]['subject']);
            // }
            $list[$i]['is_notice'] = false;
            $list_num = $total_count - ($page - 1) * $list_page_rows - $notice_count;
            $list[$i]['num'] = $list_num - $k;
            
            $i++;
            $k++;
        }
    // }
    
}
g5_latest_cache_data($board['bo_table'], $list);


$http_host = $_SERVER['HTTP_HOST'];
$request_uri = $_SERVER['REQUEST_URI'];
$url = 'http://' . $http_host . $request_uri;

if($stx == ""){
    $stx_text = "";
} else {
    $stx_text = '&stx='.$stx;
}

$bo_idx_text = '&bo_idx='.$_GET['bo_idx'];
$write_pages = get_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, G5_BBS_URL.'/board.report.php?bo_table=business'.$bo_idx_text.$stx_text);

$list_href = '';
$prev_part_href = '';
$next_part_href = '';
if ($is_search_bbs) {
    $list_href = get_pretty_url($bo_table);

    $patterns = array('#&amp;page=[0-9]*#', '#&amp;spt=[0-9\-]*#');

    //if ($prev_spt >= $min_spt)
    $prev_spt = $spt - $config['cf_search_part'];
    if (isset($min_spt) && $prev_spt >= $min_spt) {
        $qstr1 = preg_replace($patterns, '', $qstr);
        $prev_part_href = get_pretty_url($bo_table,0,$qstr1.'&amp;spt='.$prev_spt.'&amp;page=1');
        $write_pages = page_insertbefore($write_pages, '<a href="'.$prev_part_href.'" class="pg_page pg_prev">이전검색</a>');
    }

    $next_spt = $spt + $config['cf_search_part'];
    if ($next_spt < 0) {
        $qstr1 = preg_replace($patterns, '', $qstr);
        $next_part_href = get_pretty_url($bo_table,0,$qstr1.'&amp;spt='.$next_spt.'&amp;page=1');
        $write_pages = page_insertafter($write_pages, '<a href="'.$next_part_href.'" class="pg_page pg_end">다음검색</a>');
    }
}


$write_href = '';
if ($member['mb_level'] >= $board['bo_write_level']) {
    $write_href = short_url_clean(G5_BBS_URL.'/write.report.php?bo_table='.$bo_table);
}

$nobr_begin = $nobr_end = "";
if (preg_match("/gecko|firefox/i", $_SERVER['HTTP_USER_AGENT'])) {
    $nobr_begin = '<nobr>';
    $nobr_end   = '</nobr>';
}

// RSS 보기 사용에 체크가 되어 있어야 RSS 보기 가능 061106
$rss_href = '';
if ($board['bo_use_rss_view']) {
    $rss_href = G5_BBS_URL.'/rss.php?bo_table='.$bo_table;
}


$stx = get_text(stripslashes($stx));
include_once($board_skin_path.'/list.report.skin.php');
?>
