<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style1.css">', 0);

include_once(G5_THEME_PATH.'/head2.php');
?>

<!-- 로그인 시작 { -->
<div id="mb_login" class="mbskin">
    <img src="<?=G5_IMG_URL ?>/login_icon.png" alt="user_icon">
    <div class="mbskin_box">
        <form name="flogin" action="<?php echo $login_action_url ?>" onsubmit="return flogin_submit(this);" method="post">
        <input type="hidden" name="url" value="<?php echo $login_url ?>">
        <fieldset id="login_fs">
            <legend>회원로그인</legend>
            <label for="login_id" class="sound_only2">아이디<strong class="sound_only"> 필수</strong></label>
            <input type="text" name="mb_id" id="login_id" required class="frm_input2 required" size="20" maxLength="20" placeholder="아이디">
            <label for="login_pw" class="sound_only2">비밀번호<strong class="sound_only"> 필수</strong></label>
            <input type="password" name="mb_password" id="login_pw" required class="frm_input2 required2" size="20" maxLength="20" placeholder="비밀번호">
            <button type="submit" class="btn_submit">로그인</button>
            
            <div id="login_info">
                <div class="login_if_lpl">
                    <strong><a class="login_nav" href="<?php echo G5_BBS_URL ?>/id_pw_check_form.php?title=id">아이디 찾기</a></strong> 
                    <strong><a class="login_nav" href="<?php echo G5_BBS_URL ?>/id_pw_check_form.php?title=pw">비밀번호 찾기</a></strong>
                    게정이 없으신가요? 
                    <strong>
                        <a href="<?php echo G5_BBS_URL ?>/register_form.php" class="login_submit">회원가입</a>
                    </strong>
                </div>
            </div>
        </fieldset> 
        </form>
        <?php @include_once(get_social_skin_path().'/social_login.skin.php'); // 소셜로그인 사용시 소셜로그인 버튼 ?>
    </div>
</div>

<script>
jQuery(function($){
    $("#login_auto_login").click(function(){
        if (this.checked) {
            this.checked = confirm("자동로그인을 사용하시면 다음부터 회원아이디와 비밀번호를 입력하실 필요가 없습니다.\n\n공공장소에서는 개인정보가 유출될 수 있으니 사용을 자제하여 주십시오.\n\n자동로그인을 사용하시겠습니까?");
        }
    });
});

function flogin_submit(f)
{
    if( $( document.body ).triggerHandler( 'login_sumit', [f, 'flogin'] ) !== false ){
        return true;
    }
    return false;
}
</script>
<!-- } 로그인 끝 -->
