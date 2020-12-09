<?php
    if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
    include_once(G5_THEME_PATH.'/head.php');
    ?>
    <?php echo outlogin('theme/basic'); // 외부 로그인, 테마의 스킨을 사용하려면 스킨을 theme/basic 과 같이 지정 ?>
    <?php echo poll('theme/basic'); // 설문조사, 테마의 스킨을 사용하려면 스킨을 theme/basic 과 같이 지정 ?>
