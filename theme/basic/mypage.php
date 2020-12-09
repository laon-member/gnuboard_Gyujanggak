<?php
define('_INDEX_', true);
// if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if (G5_IS_MOBILE) {
    include_once(G5_THEME_MOBILE_PATH.'/index.php');
    return;
}

include_once(G5_THEME_PATH.'/head.php');
?>

<?php
// if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
//     if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
//     ?>
    <?php echo outlogin('theme/basic'); // 외부 로그인, 테마의 스킨을 사용하려면 스킨을 theme/basic 과 같이 지정 ?>
    <?php echo poll('theme/basic'); // 설문조사, 테마의 스킨을 사용하려면 스킨을 theme/basic 과 같이 지정 
    
    
    
    
    
    
    
    
    include_once(G5_THEME_MOBILE_PATH.'/tail.php');?>
