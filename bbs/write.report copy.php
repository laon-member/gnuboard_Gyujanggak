<?php
include_once('./_common.php');
include_once(G5_EDITOR_LIB);
include_once(G5_CAPTCHA_PATH.'/captcha.lib.php');

if (!$board['bo_table']) {
    alert('존재하지 않는 게시판입니다.', G5_URL);
}

if (!$bo_table) {
    alert("bo_table 값이 넘어오지 않았습니다.\\nwrite.php?bo_table=code 와 같은 방식으로 넘겨 주세요.", G5_URL);
}



include_once(G5_PATH.'/head.sub.php');
@include_once ($board_skin_path.'/write.head.skin.php');
include_once('./board_head.php');

$action_url = https_url(G5_BBS_DIR)."/write_update.php";

echo '<!-- skin : '.(G5_IS_MOBILE ? $board['bo_mobile_skin'] : $board['bo_skin']).' -->';
include_once ($board_skin_path.'/write.skin.php');

include_once('./board_tail.php');
@include_once ($board_skin_path.'/write.tail.skin.php');
include_once(G5_PATH.'/tail.sub.php');
?>