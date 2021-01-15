<?php
include_once('./_common.php');
// include_once(G5_LIB_PATH.'/naver_syndi.lib.php');
// include_once(G5_CAPTCHA_PATH.'/captcha.lib.php');

// 토큰체크
// check_write_token($bo_table);


// $bo_table = 'g5_business_propos';



$g5['title'] = '평가 업로드';

// $msg = array();

$row = sql_fetch("select * from rater where business_idx = '{$_POST['business_idx']}' and user_id = '{$member['mb_id']}' and test_id = '{$_POST['test_id']}'  ");
if(isset($row)){
    if($_POST['value_id'] == 1){
        $row22 = sql_fetch("select * from  rater_value where rater_idx = '{$row['idx']}' and report_idx = '{$_POST['us_idx']}'");
        if(isset($row22)){
            // 평가 저장본이 있다면 update
            if($row22['value'] == 2){
                alert('이미 제출을 완료 했습니다.');
            }else {
                if($_POST['test_user'] != ""){
                    if(is_numeric($_POST['test_user'])){
                        if($_POST['test_user'] <= 80){
                            $test_user =  'test_user = "'. $_POST['test_user'] .'"';
                        } else {alert("연구진 점수가 80점이 넘습니다");}
                    } else { alert("연구진 점수를 숫자만 입력해주세요");}
                } else { $test_user = '';}

                if($_POST['test_title'] != ""){
                    if(is_numeric($_POST['test_title'])){
                        if($_POST['test_title'] <= 80){
                            $test_title =  'test_title = "'.$_POST['test_title'].'"';
                        } else {alert("주제 점수가 80점이 넘습니다");}
                    } else { alert("주제 점수를 숫자만 입력해주세요");}
                } else { $test_title = '';}

                if($_POST['test_plan'] != ""){
                    if(is_numeric($_POST['test_user'])){
                        if($_POST['test_user'] <= 80){
                            $test_plan =  'test_plan = "'.$_POST['test_plan'].'"';
                        } else {alert("계획 점수가 80점이 넘습니다");}
                    } else { alert("계획 점수를 숫자만 입력해주세요");}
                } else { $test_plan = '';}

                if($_POST['test_opinion'] != ""){
                    $test_opinion =  'test_opinion = "'.$_POST['test_opinion'].'"';
                } else { $test_opinion = '';}

                if($_POST['test_sum'] != ""){
                    $test_sum =  'test_sum = "'.$_POST['test_sum'].'"';
                } else { $test_sum = '';}

                $average = $_POST['test_user'] + $_POST['test_title'] + $_POST['test_plan'];

                $sql = " update rater_value set $test_user, $test_title, $test_plan, $test_opinion, $test_sum,   test_average = '$average' where idx = '{$row22['idx']}' and report_idx = {$_POST['us_idx']}";
                sql_query($sql);
                alert('업데이트 완료');
            }
        } else {
            //없다면 insert
            if($_POST['test_user'] != ""){
                if(is_numeric($_POST['test_user'])){
                    if($_POST['test_user'] <= 80){
                        $test_user =  $_POST['test_user'];
                    } else {alert("연구진 점수가 80점이 넘습니다");}
                } else { alert("연구진 점수를 숫자만 입력해주세요");}
            } else { $test_user = '';}

            if($_POST['test_title'] != ""){
                if(is_numeric($_POST['test_title'])){
                    if($_POST['test_title'] <= 80){
                        $test_title = $_POST['test_title'];
                    } else {alert("주제 점수가 80점이 넘습니다");}
                } else { alert("주제 점수를 숫자만 입력해주세요");}
            } else { $test_title = '';}

            if($_POST['test_plan'] != ""){
                if(is_numeric($_POST['test_plan'])){
                    if($_POST['test_plan'] <= 80){
                        $test_plan = $_POST['test_plan'];
                    } else {alert("계획 점수가 80점이 넘습니다");}
                } else { alert("계획 점수를 숫자만 입력해주세요");}
            } else { $test_plan = '';}

            if($_POST['test_opinion'] != ""){
                $test_opinion = $_POST['test_opinion'];
            } else { $test_opinion = '';}
            $average = $_POST['test_user'] + $_POST['test_title'] + $_POST['test_plan'];
            $sql = " insert into rater_value
                                set rater_idx = '{$row['idx']}',
                                    report_idx = '{$_POST['us_idx']}',
                                    test_user = '$test_user',
                                    test_title = '$test_title',
                                    test_plan = '$test_plan',
                                    test_opinion = '$test_opinion',
                                    test_sum = '{$_POST['test_sum']}',
                                    test_average = '$average',
                                    value = '{$_POST['value_id']}'";
            sql_query($sql);
            alert('저장 완료');
        }
    } else if ($_POST['value_id'] == 2){
        $row22 = sql_fetch(" select * from rater_value where rater_idx = '{$row['idx']}' and report_idx = '{$_POST['us_idx']}'");
        if(isset($row22)){
            // 평가 저장본이 있다면 update
            if($row22['value'] == 2){
                alert('이미 제출을 완료 했습니다.');
            } else {
                $sql = " update rater_value set value = '{$_POST['value_id']}' where idx = '{$row22['idx']}' and report_idx = {$_POST['us_idx']}";
                sql_query($sql);

                alert('제출 완료');
            }
        } else {
            //없다면 평가 진행후 다시
            alert ('평가 진행후 저장하고 제출해주세요');
        }
    }
}else {
    //없다면 권한이 없음
    alert ('권한이 없습니다 관리자에게 문의해주세요');
}
?>
