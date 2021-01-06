<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

session_start();

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
include_once('./_common.php');
add_stylesheet('<link rel="stylesheet" href="'.$member_skin_url.'/style.css">', 0);


?>

<!-- 회원정보 입력/수정 시작 { -->
<div class="register">
<script src="<?php echo G5_JS_URL ?>/jquery.register_form.js"></script>
<?php if($config['cf_cert_use'] && ($config['cf_cert_ipin'] || $config['cf_cert_hp'])) { ?>
<script src="<?php echo G5_JS_URL ?>/certify.js?v=<?php echo G5_JS_VER; ?>"></script>
<?php } ?>

	<form id="fregisterform" name="fregisterform" onsubmit="return fregisterform_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
	<input type="hidden" name="w" value="<?php echo $w ?>">
	<input type="hidden" name="url" value="<?php echo $urlencode ?>">
	<input type="hidden" name="agree" value="<?php echo $agree ?>">
	<input type="hidden" name="agree2" value="<?php echo $agree2 ?>">
	<input type="hidden" name="cert_type" value="<?php echo $member['mb_certify']; ?>">
	<input type="hidden" name="cert_no" value="">
	<input type="hidden" name="mypage" value="1">

	<?php if (isset($member['mb_sex'])) {  ?><input type="hidden" name="mb_sex" value="<?php echo $member['mb_sex'] ?>"><?php }  ?>
	<?php if (isset($member['mb_nick_date']) && $member['mb_nick_date'] > date("Y-m-d", G5_SERVER_TIME - ($config['cf_nick_modify'] * 86400))) { // 닉네임수정일이 지나지 않았다면  ?>
	<input type="hidden" name="mb_nick_default" value="<?php echo get_text($member['mb_nick']) ?>">
	<input type="hidden" name="mb_nick" value="<?php echo get_text($member['mb_nick']) ?>">
	<?php }  ?>
	<aside class="register_form_aside">
		<h2 class="aisde_title">마이페이지</h2>
		<a class="aside_nav aisde_click" href="<?php echo G5_BBS_URL ?>/mypage_form.php?page=1">회원정보</a>
		<a class="aside_nav" href="<?php echo G5_BBS_URL ?>/mypage_form.php?page=2">회원탈퇴</a>
	</aside>
	<div id="register_form" class="form_01">   
	    <div class="register_form_inner">
	        <h2>회원정보</h2>
	        <ul>
				<li>
	                <label for="reg_mb_id">아이디</label>
					<input type="text" name="mb_id" value="<?php echo $member['mb_id'] ?>" id="reg_mb_id" readonly class="frm_input full_input <?php echo $readonly ?>" placeholder="아이디">
				</li>
				<li>
	                <label for="reg_mb_name">이름</label>
	                <input type="text" id="reg_mb_name" name="mb_name" value="<?php echo $member['mb_name'] ?>" <?php echo $readonly; ?> class="frm_input full_input <?php echo $readonly ?>" placeholder="이름">
	            </li>
				<li>
	                <label for="reg_mb_email">E-mail</label>
	                <input type="text" name="mb_email" value="<?php echo $member['mb_email'] ?>" id="reg_mb_email"  class="frm_input  full_input " laceholder="E-mail"  placeholder="E-mail">
	            </li>
				<li>
	                <label for="reg_mb_password">비밀번호</label>
					<input type="password" name="mb_password" id="reg_mb_password" <?php echo $form_pw ?> class="frm_input full_input "  placeholder="비밀번호">
				</li>
	            <li>
	                <label for="reg_mb_password_re">비밀번호 확인</label>
					<input type="password" name="mb_password_re" id="reg_mb_password_re" <?php echo $form_pw_re ?> class="frm_input full_input "  placeholder="비밀번호 확인">
				</li>
			</ul>
			<div class="btn_confirm">
				<input type="submit" id="btn_submit" class="btn_submit" accesskey="s" value="수정" formaction="<?php echo G5_BBS_URL ?>/mypage_form_update.php"/>
				<a href="<?php echo G5_URL ?>" class="btn_close">취소</a>
			</div> 
	    </div>
	</div>

	</form>
</div>