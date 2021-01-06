<?php
// $sub_menu = "200100";
include_once('./_common.php');

// check_demo();

// auth_check($auth[$sub_menu], 'w');

// check_admin_token();

// $mb_datas = array();

// if ($_POST['act_button'] == "선택수정") {

//     for ($i=0; $i<count($_POST['chk']); $i++)
//     {
//         // 실제 번호를 넘김
//         $k = $_POST['chk'][$i];

//         $mb_datas[] = $mb = get_member($_POST['mb_id'][$k]);

//         if (!$mb['mb_id']) {
//             $msg .= $mb['mb_id'].' : 회원자료가 존재하지 않습니다.\\n';
//         } else if ($is_admin != 'super' && $mb['mb_level'] >= $member['mb_level']) {
//             $msg .= $mb['mb_id'].' : 자신보다 권한이 높거나 같은 회원은 수정할 수 없습니다.\\n';
//         } else if ($member['mb_id'] == $mb['mb_id']) {
//             $msg .= $mb['mb_id'].' : 로그인 중인 관리자는 수정 할 수 없습니다.\\n';
//         } else {
//             if($_POST['mb_certify'][$k])
//                 $mb_adult = (int) $_POST['mb_adult'][$k];
//             else
//                 $mb_adult = 0;

//             $sql = " update {$g5['member_table']}
//                         set mb_level = '".sql_real_escape_string($_POST['mb_level'][$k])."',
//                             mb_intercept_date = '".sql_real_escape_string($_POST['mb_intercept_date'][$k])."',
//                             mb_mailling = '".sql_real_escape_string($_POST['mb_mailling'][$k])."',
//                             mb_sms = '".sql_real_escape_string($_POST['mb_sms'][$k])."',
//                             mb_open = '".sql_real_escape_string($_POST['mb_open'][$k])."',
//                             mb_certify = '".sql_real_escape_string($_POST['mb_certify'][$k])."',
//                             mb_adult = '{$mb_adult}'
//                         where mb_id = '".sql_real_escape_string($_POST['mb_id'][$k])."' ";
//             sql_query($sql);
//         }
//     }

// } else if ($_POST['act_button'] == "선택삭제") {

//     for ($i=0; $i<count($_POST['chk']); $i++)
//     {
//         // 실제 번호를 넘김
//         $k = $_POST['chk'][$i];

//         $mb_datas[] = $mb = get_member($_POST['mb_id'][$k]);

//         if (!$mb['mb_id']) {
//             $msg .= $mb['mb_id'].' : 회원자료가 존재하지 않습니다.\\n';
//         } else if ($member['mb_id'] == $mb['mb_id']) {
//             $msg .= $mb['mb_id'].' : 로그인 중인 관리자는 삭제 할 수 없습니다.\\n';
//         } else if (is_admin($mb['mb_id']) == 'super') {
//             $msg .= $mb['mb_id'].' : 최고 관리자는 삭제할 수 없습니다.\\n';
//         } else if ($is_admin != 'super' && $mb['mb_level'] >= $member['mb_level']) {
//             $msg .= $mb['mb_id'].' : 자신보다 권한이 높거나 같은 회원은 삭제할 수 없습니다.\\n';
//         } else {
//             // 회원자료 삭제
//             member_delete($mb['mb_id']);
//         }
//     }
// }

// if ($msg)
//     //echo '<script> alert("'.$msg.'"); </script>';
//     alert($msg);

// run_event('admin_member_list_update', $_POST['act_button'], $mb_datas);

// goto_url('./member_list.php?'.$qstr);


if($_POST['level'] == 1){
    if(isset($_POST['idx']) && $_POST['belong'] !="" && $_POST['degree'] !="" && $_POST['rank'] !="" && $_POST['category'] !=""){
        $sql = " SELECT * FROM `g5_member` WHERE mb_no ='{$_POST['idx']}'";
        $row = sql_fetch($sql);
        if($row['mb_level'] < 5){
            $sql = " update g5_member
                    set belong = '{$_POST['belong']}',
                    degree = '{$_POST['degree']}',
                    rank = '{$_POST['rank']}',
                    category = '{$_POST['category']}',
                    mb_level = '5'
                    WHERE mb_no = '{$_POST['idx']}'";
            sql_query($sql);
            // echo $sql;
            alert('심사위원을 배정했습니다.');
        } else if ($row['mb_level'] == 5){
            $sql = " update g5_member
                    set belong = '{$_POST['belong']}',
                    degree = '{$_POST['degree']}',
                    rank = '{$_POST['rank']}',
                    category = '{$_POST['category']}'
                    WHERE mb_no = '{$_POST['idx']}'";
            sql_query($sql);
            alert('심사위원의 정보를 수정했습니다.'); 
        } else {
            alert('자신의 권한보다 높은사람은 수정이 불가능합니다.'); 
        }
    } else {
        alert('빈칸 없이 입력해주세요.'); 
    }
} else if($_POST['level'] == 2){
    if(isset($_POST['idx']) && $_POST['belong'] !="" && $_POST['degree'] !="" && $_POST['rank'] !="" && $_POST['category'] !=""){
        $sql = " SELECT * FROM `g5_member` WHERE mb_no ='{$_POST['idx']}'";
        $row = sql_fetch($sql);
        if($row['mb_name'] == '최고관리자'){
            alert('최고관리자는 수정 불가능 합니다');
        } else if($row['mb_level'] < 10){
            $sql = " update g5_member
                    set belong = '{$_POST['belong']}',
                    degree = '{$_POST['degree']}',
                    rank = '{$_POST['rank']}',
                    category = '{$_POST['category']}',
                    mb_level = '10'
                    WHERE mb_no = '{$_POST['idx']}'";
            sql_query($sql);
            // echo $sql;
            alert('관리자를 배정했습니다.');
        } else if ($row['mb_level'] == 10){
            $sql = " update g5_member
                    set belong = '{$_POST['belong']}',
                    degree = '{$_POST['degree']}',
                    rank = '{$_POST['rank']}',
                    category = '{$_POST['category']}'
                    WHERE mb_no = '{$_POST['idx']}'";
            sql_query($sql);
            alert('관리자를 정보를 수정했습니다.'); 
        }
    } else {
        alert('빈칸 없이 입력해주세요.'); 
    }
} else {
    alert('권한을 선택해주세요');
}
?>
