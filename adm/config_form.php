<?php
$sub_menu = "100100";
include_once('./_common.php');

auth_check($auth[$sub_menu], 'r');

if ($is_admin != 'super')
    alert('최고관리자만 접근 가능합니다.');


$g5['title'] = '대시보드';
include_once ('./admin.head.php');
?>

<div class="admin_board">
    <div class="admin_board_user">
        <div class="user">
            <img src="" alt="member_img">
            <div class="admin_member_text">
                <p>지원자</p>
                <p>47</p>
            </div>
        </div>
        <div class="user">
            <img src="" alt="member_img">
            <div class="admin_member_text">
                <p>심사자</p>
                <p>13</p>
            </div>
        </div>
        <div class="user">
            <img src="" alt="member_img">
            <div class="admin_member_text">
                <p>관리자</p>
                <p>08</p>
            </div>
        </div>
    </div>
    <div class="admin_board_user">
        <ul>
            <li>
                [공지사항]
                <a href="#">더보기</a>
            </li>
        </ul>
    </div>
</div>
<?php

include_once ('./admin.tail.php');
?>
