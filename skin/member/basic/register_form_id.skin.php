<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

session_start();

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
include_once('./_common.php');
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);


if(empty($_SESSION['FORM']['mb_id'])){
// 세션값이 없으면..
	$form_id = "";
	$form_name = "";
	$form_pw = "";
	$form_pw_re = "";
	$form_email = "";
} else {
	// 세션값이 존재하면
	// 즉, 폼값에 오류가 있어 저장에 실패한 경우 임
	$form_id = $_SESSION['FORM']['mb_id'];
	$form_name = $_SESSION['FORM']['mb_name'];
	$form_pw = $_SESSION['FORM']['mb_password'];
	$form_pw_re = $_SESSION['FORM']['mb_password_re'];
	$form_email = $_SESSION['FORM']['mb_email'];
}


?>

<!-- 회원정보 입력/수정 시작 { -->
<div class="register">
<script src="<?php echo G5_JS_URL ?>/jquery.register_form.js"></script>
<?php if($config['cf_cert_use'] && ($config['cf_cert_ipin'] || $config['cf_cert_hp'])) { ?>
<script src="<?php echo G5_JS_URL ?>/certify.js?v=<?php echo G5_JS_VER; ?>"></script>
<?php } ?>

	<form id="fregisterform" name="fregisterform" onsubmit="return fregisterform_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
	<input type="hidden" name="check_user" value="id">
	<input type="hidden" name="url" value="<?php echo $urlencode ?>">
	<input type="hidden" name="agree" value="<?php echo $agree ?>">
	<input type="hidden" name="agree2" value="<?php echo $agree2 ?>">
	<input type="hidden" name="cert_type" value="<?php echo $member['mb_certify']; ?>">
	<input type="hidden" name="cert_no" value="">
	<?php if (isset($member['mb_sex'])) {  ?><input type="hidden" name="mb_sex" value="<?php echo $member['mb_sex'] ?>"><?php }  ?>
	<?php if (isset($member['mb_nick_date']) && $member['mb_nick_date'] > date("Y-m-d", G5_SERVER_TIME - ($config['cf_nick_modify'] * 86400))) { // 닉네임수정일이 지나지 않았다면  ?>
	<input type="hidden" name="mb_nick_default" value="<?php echo get_text($member['mb_nick']) ?>">
	<input type="hidden" name="mb_nick" value="<?php echo get_text($member['mb_nick']) ?>">
	<?php }  ?>
	<aside class="register_form_aside">
		<h2 class="aisde_title">로그인 정보</h2>
		<a class="aside_nav" href="<?php echo G5_BBS_URL ?>/register_form.php">회원가입</a>
		<a class="aside_nav aisde_click" href="<?php echo G5_BBS_URL ?>/id_pw_check_form.php?title=id">아이디 찾기</a>
		<a class="aside_nav" href="<?php echo G5_BBS_URL ?>/id_pw_check_form.php?title=pw">비밀번호 찾기</a>
	</aside>
	<div id="register_form" class="form_01">   
	    <div class="register_form_inner">
	        <h2>아이디 찾기</h2>
	        <ul>
				<li>
	                <label for="reg_mb_name">이름</label>
	                <input type="text" id="reg_mb_name" name="mb_name" value="<?php echo $form_name ?>" <?php echo $readonly; ?> class="frm_input full_input <?php echo $readonly ?>" placeholder="이름">
	            </li>
				<li>
	                <label for="reg_mb_email">E-mail</label>
	                <input type="text" name="mb_email" value="<?php echo $form_email ?>" id="reg_mb_email"  class="frm_input  full_input " laceholder="E-mail"  placeholder="E-mail">
	            </li>
				<?php if($_SESSION['id'] != "") { ?>
				<li>
	                <label for="reg_mb_result">결과</label>
	                <input type="text" name="mb_result" value="<?php echo $_SESSION['id'] ?>" id="reg_mb_result"  class="frm_input  full_input " placeholder="결과" disabled>
				</li>
				<?php } ?>
			</ul>
			<div class="btn_confirm">
				<input type="submit" id="btn_submit" class="btn_submit" accesskey="s" value="아이디 찾기" formaction="<?php echo G5_BBS_URL ?>/register_form_result.php"/>
				<a href="<?php echo G5_URL ?>" class="btn_close">취소</a>
			</div> 
	    </div>
	</div>

	</form>
</div>

<script>
</script>
