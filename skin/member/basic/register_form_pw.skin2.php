<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

session_start();

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
include_once('./_common.php');
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);

if(empty($_SESSION['FORM']['mb_id'])){
// 세션값이 없으면..
	$form_result = "";
	
} else {
	// 세션값이 존재하면
	// 즉, 폼값에 오류가 있어 저장에 실패한 경우 임
	$form_email = $_SESSION['FORM']['result'];
}


?>

<!-- 회원정보 입력/수정 시작 { -->
<div class="register">
<script src="<?php echo G5_JS_URL ?>/jquery.register_form.js"></script>
<?php if($config['cf_cert_use'] && ($config['cf_cert_ipin'] || $config['cf_cert_hp'])) { ?>
<script src="<?php echo G5_JS_URL ?>/certify.js?v=<?php echo G5_JS_VER; ?>"></script>
<?php } ?>

	<form id="fregisterform" name="fregisterform" onsubmit="return fregisterform_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
	<input type="hidden" name="check_user" value="pw2">
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
	<div id="register_form" class="form_01">   
	    <div class="register_form_inner">
	        <h1>비밀번호 변경</h1>
	        <ul>
				<li>
	                <label for="reg_mb_pw">새로운 비밀번호</label>
	                <input type="password" name="mb_new_pw" value="<?php echo $form_pw ?>" id="reg_mb_pw"  class="frm_input  full_input " laceholder="E-mail"  placeholder="새로운 비밀번호">
	            </li>
				<li>
	                <label for="reg_mb_pw_re">새로운 비밀번호 확인</label>
	                <input type="password" name="mb_new_pw_re" value="<?php echo $form_result ?>" id="reg_mb_pw_re"  class="frm_input  full_input " placeholder="새로운 비밀번호 확인" >
	            </li>
			</ul>
			<div class="btn_confirm">
				<a href="<?php echo G5_URL ?>" class="btn_close">취소</a>
				<input type="submit" id="btn_submit" class="btn_submit" accesskey="s" value="비밀번호 변경" formaction="<?php echo G5_BBS_URL ?>/register_form_result.php"/>
			</div> 
	    </div>
	</div>

	</form>
</div>

<script>


</script>
