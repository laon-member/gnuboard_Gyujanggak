<?php
include_once('./_common.php');

$value = $_POST['value'] !=  "" ? $_POST['value'] : $_GET['value']; 

if($value == 1){
    // 심사위원 추가
    $count = @count($_POST['checkbox']);
    if($_GET['bo_idx'] != 3 || $row['wr_title_idx'] != 3 || $row['wr_title_idx'] != 4 || $row['wr_title_idx'] != 5 || $row['wr_title_idx'] != 6){

    }
    
    if($count == 0 ){
        alert('심사위원을 선택해주세요');
    }
    $count_num=0;
    for($i=0; $i<$count; $i++){
        $row = sql_fetch(" select * from g5_member where mb_no = '{$_POST['checkbox'][$i]}'");
        $row22 = sql_fetch(" select * from rater where user_id = '{$row['mb_id']}' and business_idx = '{$_GET['idx']}' and propos_idx = '{$_GET['us_idx']}' and test_id= '{$_POST['bo_idx']}'");
        $row33 = sql_fetch(" select * from rater_board where propos_idx = '{$_POST['us_idx']}' and test_idx= '{$_POST['bo_idx']}'");
        
        if($row22['idx'] == "" ){
            $sql = " insert into rater
            set business_idx = '{$_POST['wr_idx']}',
                 propos_idx = '{$_POST['us_idx']}',
                 user_id = '{$row['mb_id']}',
                 user_name = '{$row['mb_name']}',
                 test_id = '{$_POST['bo_idx']}',
                 value = '1'";
            sql_query($sql);

            $count_num ++;
        }
          
        if($row33 == ''){
            $sql = " insert into rater_board
            set propos_idx = '{$_POST['us_idx']}',
            test_idx = '{$_POST['bo_idx']}',
            value = '0'";

            sql_query($sql);
        }

    }
    alert($count_num."명을 저장하였습니다");
} else if($value == 2){
    // 심사위원 의뢰
    $row22 = sql_fetch(" select * from rater where business_idx = '{$_GET['idx']}'and propos_idx = '{$_GET['us_idx']}' and test_id = '{$_GET['bo_idx']}'");
    if($row22['idx'] == ""){
        alert('심사위원을 추가해주세요');
    } else {
        $row = sql_fetch("UPDATE rater SET value = '2' WHERE business_idx = '{$_GET['idx']}' and propos_idx = '{$_GET['us_idx']}'");

        if($_GET['bo_idx'] == 1){
            $sql = " update g5_write_business set value = '1' where wr_id = '{$_GET['idx']}'";
        } else if($_GET['bo_idx'] == 2){
            $sql = " update g5_write_business set wr_8 = '1' where wr_id = '{$_GET['idx']}'";
        } else if($_GET['bo_idx'] == 3){
            $sql = " update g5_write_business set wr_9 = '1' where wr_id = '{$_GET['idx']}'";
        }
        sql_query($sql);

        $sql = " update rater_board set value = '1' where propos_idx = '{$_GET['us_idx']}'";
        sql_query($sql);

        alert("심사위원을 의뢰했습니다.");

    }
} else if($value == 3){
    // 심사위원 제외
    if(@count($_POST['checkbox']) == 0) return alert('제외할 심사위원을 선택해주세요');

    for($i=0; $i<count($_POST['checkbox']); $i++){
        $row = sql_fetch("DELETE FROM rater WHERE idx = {$_POST['checkbox'][$i]}");
    }

    alert('심사위원을 제외했습니다.');
    
} else if($value == 4){
    // 합격자 배정
    if ($_POST['bo_idx_list'] == 1){
        for($i=0; $i<@count($_POST['checkbox']); $i++){
            $position = $_POST['checkbox'];
            sql_fetch("UPDATE g5_business_propos SET value = 1 WHERE idx = '{$position[$i]}'");
        }
    } else if ($_POST['bo_idx_list'] == 2){
        for($i=0; $i<@count($_POST['checkbox']); $i++){
            $position = $_POST['checkbox'];
            sql_fetch("UPDATE g5_business_propos SET report_val_1 = '1' WHERE idx = '{$position[$i]}'");
        }
    } else if ($_POST['bo_idx_list'] == 3){
        for($i=0; $i<@count($_POST['checkbox']); $i++){
            $position = $_POST['checkbox'];
            sql_fetch("UPDATE g5_business_propos SET report_val_2 = '1' WHERE idx = '{$position[$i]}'");
        }
    }

    if($_POST['sql_bo_idx'] == 1){
        $sql = " update g5_write_business set value = '2' where wr_id = '{$_POST['wr_id']}'";
    } else if($_POST['sql_bo_idx'] == 2){
        $sql = " update g5_write_business set wr_8 = '2' where wr_id = '{$_POST['wr_id']}'";
    } else if($_POST['sql_bo_idx'] == 3){
        $sql = " update g5_write_business set wr_9 = '2' where wr_id = '{$_POST['wr_id']}'";
    }
    sql_query($sql);

    alert('합격자를 선발 했습니다');
        
} else if($value == 5){
    // 합격자 제외
    if($_GET['bo_idx'] == 1){
        sql_fetch("UPDATE g5_business_propos SET value = '0' WHERE idx = '{$_GET['border_idx']}'");
    } else if($_GET['bo_idx'] == 2){
        sql_fetch("UPDATE g5_business_propos SET report_val_1 = '0' WHERE idx = '{$_GET['border_idx']}'");
    } else if($_GET['bo_idx'] == 3){
        sql_fetch("UPDATE g5_business_propos SET report_val_2 = '0' WHERE idx = '{$_GET['border_idx']}'");
    }
    alert('합격자에서 제외 되었습니다.');
}