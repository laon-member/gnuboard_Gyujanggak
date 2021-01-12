<?php
include_once('./_common.php');
include_once(G5_EDITOR_LIB);
include_once(G5_CAPTCHA_PATH.'/captcha.lib.php');


if($_POST['save'] == '1' || $_POST['save'] == '2'){
    echo $wr_bo_idx;
    include_once('<?= G5_BBS_URL ?>/view.report.update.php');
} else {
    include_once($board_skin_path.'/view.report.skin.php');

}

@include_once($board_skin_path.'/view.tail.skin.php');
?>