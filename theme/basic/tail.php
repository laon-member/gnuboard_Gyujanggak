<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

?>

    </div>
</div>

</div>
<!-- } 콘텐츠 끝 -->

<hr>

<!-- 하단 시작 { -->
<div id="ft_board">
    <div id="ft_wr_board">
        <div id="ft_company_board" class="">
        <img src="<?php echo G5_IMG_URL ?>/footer_logo.png" alt="footer_logo">
	        <p class="ft_info_baord">
            고유번호증 119-82-08700   대표자 이현희   서울시 관악구 관악로 1, 103동<br>
            전화 02-880-5317 / 팩스 02-883-3012   kyujg@snu.ac.kr
			</p>
	    </div>
    </div>
</div>

<!-- } 하단 끝 -->

<script>
$(function() {
    // 폰트 리사이즈 쿠키있으면 실행
    font_resize("container", get_cookie("ck_font_resize_rmv_class"), get_cookie("ck_font_resize_add_class"));
});
</script>

<?php
include_once(G5_PATH."/tail.sub.php");
?>