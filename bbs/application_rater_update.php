<?php
include_once('./_common.php');
// include_once(G5_LIB_PATH.'/naver_syndi.lib.php');
// include_once(G5_CAPTCHA_PATH.'/captcha.lib.php');

// 토큰체크
// check_write_token($bo_table);


// $bo_table = 'g5_business_propos';


// $g5['title'] = '평가 업로드';

// $msg = array();

$row = sql_fetch("select * from rater where business_idx = '{$_POST['business_idx']}' and  propos_idx = '{$_POST['us_idx']}' and user_id ='{$member['mb_id']}' and test_id = '{$_POST['test_id']}'");
if(isset($row)){
    if($_POST['value_id'] == 1){
        $row22 = sql_fetch("select * from rater_value where rater_idx = '{$row['idx']}' and report_idx = '{$_POST['us_idx']}'");

        $sql4 = " select * from rater_category where category_idx = '{$_POST['category_idx']}' and test_step = '{$_POST['bo_idx']}'";
        $result4 = sql_query($sql4);
        $row4 = sql_fetch_array($result4);

        $sql6 = " select count(idx) as cnt from rater_fild where test_fild_idx = '{$row4['idx']}'";
        $result6 = sql_query($sql6);
        $row6 = sql_fetch_array($result6);

        $sql7 = " select * from rater_fild where test_fild_idx = '{$row4['idx']}'";
        $result7 = sql_query($sql7);
       
        if(isset($row22)){
            // 평가 저장본이 있다면 update
            if($row22['value'] == 2){
                alert('이미 제출을 완료 했습니다.');
            }else {
                $test_fild_cnt = 0;
                for($i = 1; $row7 = sql_fetch_array($result7);$i ++){
                    if($_POST['test_fild_'.$i] != ""){
                        if(is_numeric($_POST['test_fild_'.$i])){
                            if($_POST['test_fild_'.$i] <= $row7['test_score']){
                                $test_fild_value = true;
                                $test_fild_cnt = $test_fild_cnt + 1;
                            } else {alert(" 점수가 ".$row7['test_score']."점이 넘습니다"); $test_fild_value = false;}
                        } else { alert(" 점수를 숫자만 입력해주세요"); $test_fild_value = false;}
                    } else { $test_fild_value = false;}
                }

                if($_POST['test_opinion'] != ""){
                    $test_opinion_value =  true;
                    $test_opinion = 'test_opinion = "'.$_POST['test_opinion'].'"';
                } else { $test_opinion_value = false; $test_opinion = ''; }

                @$average =  $_POST['test_fild_sum'] / $fild_cnt;
        
                $sql = " update rater_value set
                        test_fild_1 = '{$_POST['test_fild_1']}', 
                        test_fild_2 = '{$_POST['test_fild_2']}', 
                        test_fild_3 = '{$_POST['test_fild_3']}', 
                        test_fild_4 = '{$_POST['test_fild_4']}', 
                        test_sum = '{$_POST['test_fild_sum']}',   
                        test_average = '$average',
                        test_opinion = '{$_POST['test_opinion']}'
                        where idx = '{$row22['idx']}' and report_idx = {$_POST['us_idx']}";
                sql_query($sql);

                // 파일개수 체크
                $file_count   = 0;
                $upload_count = (isset($_FILES['bf_file']['name']) && is_array($_FILES['bf_file']['name'])) ? count($_FILES['bf_file']['name']) : 0;
                
                for ($i=0; $i<$upload_count; $i++) {
                    if($_FILES['bf_file']['name'][$i] && is_uploaded_file($_FILES['bf_file']['tmp_name'][$i]))
                        $file_count++;
                }

                // 디렉토리가 없다면 생성합니다. (퍼미션도 변경하구요.)
                @mkdir(G5_DATA_PATH.'/file/'.$bo_table, G5_DIR_PERMISSION);
                @chmod(G5_DATA_PATH.'/file/'.$bo_table, G5_DIR_PERMISSION);

                $chars_array = array_merge(range(0,9), range('a','z'), range('A','Z'));

                // 가변 파일 업로드
                $file_upload_msg = '';
                $upload = array();

                $count_del =  @count($_POST['del-no']);
                $count_file_num = @count($_FILES['bf_file']);


                if($count_del > 0 ){
                    for($k=0; $k < $count_del; $k++ ){
                        sql_query("delete from {$g5['board_file_table']} where bo_table = 'rater' and wr_id = '{$_POST['rater_idx']}' and bf_no = '{$_POST['del-no'][$k]}' ");

                        $count_file_num;
                    }

                    $sql7 = " select * from {$g5['board_file_table']} where bo_table = 'rater' and wr_id = '{$_POST['rater_idx']}'";
                    $result7 = sql_query($sql7);
                    for($i = 0; $row7 = sql_fetch_array($result7);$i ++){
                        sql_query("UPDATE {$g5['board_file_table']} SET bf_no = $i WHERE bo_table = 'rater' and wr_id = '{$_POST['rater_idx']}' and bf_no = '{$row7['bf_no']}'");
                    }

                }

                if(isset($_FILES['bf_file']['name']) && is_array($_FILES['bf_file']['name'])) {
                    for ($i=0; $i<count($_FILES['bf_file']['name']); $i++) {
                        $upload[$i]['file']     = '';
                        $upload[$i]['source']   = '';
                        $upload[$i]['filesize'] = 0;
                        $upload[$i]['image']    = array();
                        $upload[$i]['image'][0] = 0;
                        $upload[$i]['image'][1] = 0;
                        $upload[$i]['image'][2] = 0;
                        $upload[$i]['fileurl'] = '';
                        $upload[$i]['thumburl'] = '';
                        $upload[$i]['storage'] = '';
                
                        // 삭제에 체크가 되어있다면 파일을 삭제합니다.
                        if (isset($_POST['bf_file_del'][$i]) && $_POST['bf_file_del'][$i]) {
                            $upload[$i]['del_check'] = true;
                
                            $row = sql_fetch(" select * from {$g5['board_file_table']} where bo_table = 'rater' and wr_id = '{$_POST['us_idx']}' and bf_no = '{$i}' ");
                
                            $delete_file = run_replace('delete_file_path', G5_DATA_PATH.'/file/'.$bo_table.'/'.str_replace('../', '', $row['bf_file']), $row);
                            if( file_exists($delete_file) ){
                                @unlink($delete_file);
                            }
                            
                        }
                        else
                            $upload[$i]['del_check'] = false;
                
                        $tmp_file  = $_FILES['bf_file']['tmp_name'][$i];
                        $filesize  = $_FILES['bf_file']['size'][$i];
                        $filename  = $_FILES['bf_file']['name'][$i];
                        $filename  = get_safe_filename($filename);
                
                        // 서버에 설정된 값보다 큰파일을 업로드 한다면
                        if ($filename) {
                            if ($_FILES['bf_file']['error'][$i] == 1) {
                                $file_upload_msg .= '\"'.$filename.'\" 파일의 용량이 서버에 설정('.$upload_max_filesize.')된 값보다 크므로 업로드 할 수 없습니다.\\n';
                                continue;
                            }
                            else if ($_FILES['bf_file']['error'][$i] != 0) {
                                $file_upload_msg .= '\"'.$filename.'\" 파일이 정상적으로 업로드 되지 않았습니다.\\n';
                                continue;
                            }
                        }
                
                        if (is_uploaded_file($tmp_file)) {
                            // 관리자가 아니면서 설정한 업로드 사이즈보다 크다면 건너뜀
                            // if (!$is_admin && $filesize > 104857600) {
                            //     $file_upload_msg .= '\"'.$filename.'\" 파일의 용량('.number_format($filesize).' 바이트)이 게시판에 설정(104857600 바이트)된 값보다 크므로 업로드 하지 않습니다.\\n';
                            //     continue;
                            // }
                
                            //=================================================================\
                            // 090714
                            // 이미지나 플래시 파일에 악성코드를 심어 업로드 하는 경우를 방지
                            // 에러메세지는 출력하지 않는다.
                            //-----------------------------------------------------------------
                            $timg = @getimagesize($tmp_file);
                            // image type
                            if ( preg_match("/\.({$config['cf_image_extension']})$/i", $filename) ||
                                 preg_match("/\.({$config['cf_flash_extension']})$/i", $filename) ) {
                                if ($timg['2'] < 1 || $timg['2'] > 16)
                                    continue;
                            }
                            //=================================================================
                
                            $upload[$i]['image'] = $timg;
                
                
                            // 프로그램 원래 파일명
                            $upload[$i]['source'] = $filename;
                            $upload[$i]['filesize'] = $filesize;
                
                            // 아래의 문자열이 들어간 파일은 -x 를 붙여서 웹경로를 알더라도 실행을 하지 못하도록 함
                            $filename = preg_replace("/\.(php|pht|phtm|htm|cgi|pl|exe|jsp|asp|inc)/i", "$0-x", $filename);
                
                            shuffle($chars_array);
                            $shuffle = implode('', $chars_array);
                
                            // 첨부파일 첨부시 첨부파일명에 공백이 포함되어 있으면 일부 PC에서 보이지 않거나 다운로드 되지 않는 현상이 있습니다. (길상여의 님 090925)
                            $upload[$i]['file'] = abs(ip2long($_SERVER['REMOTE_ADDR'])).'_'.substr($shuffle,0,8).'_'.replace_filename($filename);
                
                            $dest_file = G5_DATA_PATH.'/file/'.$bo_table.'/'.$upload[$i]['file'];
                
                            // 업로드가 안된다면 에러메세지 출력하고 죽어버립니다.
                            $error_code = move_uploaded_file($tmp_file, $dest_file) or die($_FILES['bf_file']['error'][$i]);
                
                            // 올라간 파일의 퍼미션을 변경합니다.
                            chmod($dest_file, G5_FILE_PERMISSION);
                
                            $dest_file = run_replace('write_update_upload_file', $dest_file, $board, $wr_id, $w);
                            $upload[$i] = run_replace('write_update_upload_array', $upload[$i], $dest_file, $board, $wr_id, $w);
                            
                        }
                    }   // end for
                }   // end if

                $all_file = 0;
                // 나중에 테이블에 저장하는 이유는 $wr_id 값을 저장해야 하기 때문입니다.
                for ($i=0; $i<$upload_count; $i++){
                    if( $upload[$i]['source'] != ""){
                        $row = sql_fetch(" select count(*) as cnt from {$g5['board_file_table']} where bo_table = 'rater' and wr_id = '{$_POST['rater_idx']}' and bf_no = '{$i}' ");
                        if ($row['cnt'] )
                        {
                            // 삭제에 체크가 있거나 파일이 있다면 업데이트를 합니다.
                            // 그렇지 않다면 내용만 업데이트 합니다.
                            if ($upload[$i]['del_check'] || $upload[$i]['file'])
                            {
                                $sql = " update {$g5['board_file_table']}
                                            set bf_source = '{$upload[$i]['source']}',
                                                bf_file = '{$upload[$i]['file']}',
                                                bf_content = '{$bf_content[$i]}',
                                                bf_fileurl = '{$upload[$i]['fileurl']}',
                                                bf_thumburl = '{$upload[$i]['thumburl']}',
                                                bf_storage = '{$upload[$i]['storage']}',
                                                bf_filesize = '".(int)$upload[$i]['filesize']."',
                                                bf_width = '".(int)$upload[$i]['image'][0]."',
                                                bf_height = '".(int)$upload[$i]['image'][1]."',
                                                bf_type = '".(int)$upload[$i]['image'][2]."',
                                                bf_datetime = '".G5_TIME_YMDHIS."'
                                        where bo_table = 'rater'
                                                    and wr_id = '{$_POST['rater_idx']}'
                                                    and bf_no = '{$i}' ";
                                sql_query($sql);
                            }
                            else
                            {
                                $sql = " update {$g5['board_file_table']}
                                            set bf_content = '{$bf_content[$i]}'
                                            where bo_table = 'rater'
                                                    and wr_id = '{$_POST['rater_idx']}'
                                                    and bf_no = '{$i}' ";
                                sql_query($sql);
                            }
                        }
                        else
                        {
                            $sql = " insert into {$g5['board_file_table']}
                                        set bo_table = 'rater',
                                           wr_id = '{$_POST['rater_idx']}',
                                            bf_no = '{$i}',
                                            bf_source = '{$upload[$i]['source']}',
                                            bf_file = '{$upload[$i]['file']}',
                                            bf_content = '{$bf_content[$i]}',
                                            bf_fileurl = '{$upload[$i]['fileurl']}',
                                            bf_thumburl = '{$upload[$i]['thumburl']}',
                                            bf_storage = '{$upload[$i]['storage']}',
                                            bf_download = 0,
                                            bf_filesize = '".(int)$upload[$i]['filesize']."',
                                            bf_width = '".(int)$upload[$i]['image'][0]."',
                                            bf_height = '".(int)$upload[$i]['image'][1]."',
                                            bf_type = '".(int)$upload[$i]['image'][2]."',
                                            bf_datetime = '".G5_TIME_YMDHIS."',
                                            bf_user_type = 0 ";
                            sql_query($sql);
                            run_event('write_update_file_insert', $bo_table, $wr_id, $upload[$i], $w);
                        }
                    }


                    
                }



                // 업로드된 파일 내용에서 가장 큰 번호를 얻어 거꾸로 확인해 가면서
                // 파일 정보가 없다면 테이블의 내용을 삭제합니다.
                $row = sql_fetch(" select max(bf_no) as max_bf_no from {$g5['board_file_table']} where bo_table = 'g5_business_propos' and wr_id = '{$row2['idx']}' ");
                $row2 = sql_fetch(" select * from g5_business_propos where bo_idx = '{$_POST['wr_id']}' and mb_id = '{$member['mb_id']}'");
                for ($i=(int)$row['max_bf_no']; $i>=0; $i--)
                {
                    $row2 = sql_fetch(" select bf_file from {$g5['board_file_table']} where bo_table = 'g5_business_propos' and wr_id = '{$row2['idx']}' and bf_no = '{$i}' ");

                    // 정보가 있다면 빠집니다.
                    if ($row2['bf_file']) break;

                    // 그렇지 않다면 정보를 삭제합니다.
                    sql_query(" delete from {$g5['board_file_table']} where bo_table = 'g5_business_propos' and wr_id = '{$row2['idx']}' and bf_no = '{$i}' ");
                }

                // 파일의 개수를 게시물에 업데이트 한다.
                $row2 = sql_fetch(" select * from g5_business_propos where bo_idx = '{$_POST['wr_id']}' and mb_id = '{$member['mb_id']}'");
                $row = sql_fetch(" select count(*) as cnt from {$g5['board_file_table']} where bo_table = 'g5_business_propos' and wr_id = '{$row2['idx']}' ");
                sql_query(" update g5_business_propos set file = '{$file_count}' where idx = '{$row2['idx']}' ");
                alert('업데이트 완료');
            }
        } else {
            //없다면 insert
            $sql4 = " select * from rater_category where category_idx = '{$_POST['category_idx']}' and test_step = '{$_POST['test_id']}'";
            $result4 = sql_query($sql4);
            $row4 = sql_fetch_array($result4);

            $sql6 = " select count(idx) as cnt from rater_fild where test_fild_idx = '{$row4['idx']}'";
            $result6 = sql_query($sql6);
            $row6 = sql_fetch_array($result6);
            $fild_cnt = $row6['cnt'];

            $sql7 = " select * from rater_fild where test_fild_idx = '{$row4['idx']}'";
            $result7 = sql_query($sql7);

            $test_fild_cnt = 0;
            for($i = 1; $row7 = sql_fetch_array($result7);$i ++){
                if($_POST['test_fild_'.$i] != ""){
                    if(is_numeric($_POST['test_fild_'.$i])){
                        if($_POST['test_fild_'.$i] <= $row7['test_score']){
                            $test_fild_value = true;
                            $test_fild_cnt = $test_fild_cnt + 1;
                        } else {alert(" 점수가 ".$row7['test_score']."점이 넘습니다"); $test_fild_value = false;}
                    } else { alert(" 점수를 숫자만 입력해주세요"); $test_fild_value = false;}
                } else { $test_fild_value = false;}
            }

            if($_POST['test_opinion'] != ""){
                $test_opinion_value =  true;
                $test_opinion = 'test_opinion = "'.$_POST['test_opinion'].'"';
            } else { $test_opinion_value = false; $test_opinion = ''; }

            $average =  $_POST['test_fild_sum'] / $fild_cnt;
            
            $sql = " insert into rater_value
                                set rater_idx = '{$row['idx']}',
                                    report_idx = '{$_POST['us_idx']}',
                                    test_fild_1 = '{$_POST['test_fild_1']}',
                                    test_fild_2 = '{$_POST['test_fild_2']}',
                                    test_fild_3 = '{$_POST['test_fild_3']}',
                                    test_fild_4 = '{$_POST['test_fild_4']}',
                                    $test_opinion,
                                    test_sum = '{$_POST['test_fild_sum']}',
                                    test_average = '$average',
                                    value = '{$_POST['value_id']}'";

            sql_query($sql);

            // 파일개수 체크
            $file_count   = 0;
            $upload_count = (isset($_FILES['bf_file']['name']) && is_array($_FILES['bf_file']['name'])) ? count($_FILES['bf_file']['name']) : 0;
            
            for ($i=0; $i<$upload_count; $i++) {
                if($_FILES['bf_file']['name'][$i] && is_uploaded_file($_FILES['bf_file']['tmp_name'][$i]))
                    $file_count++;
            }

            // 디렉토리가 없다면 생성합니다. (퍼미션도 변경하구요.)
            @mkdir(G5_DATA_PATH.'/file/'.$bo_table, G5_DIR_PERMISSION);
            @chmod(G5_DATA_PATH.'/file/'.$bo_table, G5_DIR_PERMISSION);

            $chars_array = array_merge(range(0,9), range('a','z'), range('A','Z'));

            // 가변 파일 업로드
            $file_upload_msg = '';
            $upload = array();

            $count_del =  @count($_POST['del-no']);
            $count_file_num = @count($_FILES['bf_file']);


            if($count_del > 0 ){
                for($k=0; $k < $count_del; $k++ ){
                    sql_query("delete from {$g5['board_file_table']} where bo_table = 'rater' and wr_id = '{$_POST['rater_idx']}' and bf_no = '{$_POST['del-no'][$k]}' ");

                    $count_file_num;
                }

                $sql7 = " select * from {$g5['board_file_table']} where bo_table = 'rater' and wr_id = '{$_POST['rater_idx']}'";
                $result7 = sql_query($sql7);
                for($i = 0; $row7 = sql_fetch_array($result7);$i ++){
                    sql_query("UPDATE {$g5['board_file_table']} SET bf_no = $i WHERE bo_table = 'rater' and wr_id = '{$_POST['rater_idx']}' and bf_no = '{$row7['bf_no']}'");
                }

            }

            if(isset($_FILES['bf_file']['name']) && is_array($_FILES['bf_file']['name'])) {
                for ($i=0; $i<count($_FILES['bf_file']['name']); $i++) {
                    $upload[$i]['file']     = '';
                    $upload[$i]['source']   = '';
                    $upload[$i]['filesize'] = 0;
                    $upload[$i]['image']    = array();
                    $upload[$i]['image'][0] = 0;
                    $upload[$i]['image'][1] = 0;
                    $upload[$i]['image'][2] = 0;
                    $upload[$i]['fileurl'] = '';
                    $upload[$i]['thumburl'] = '';
                    $upload[$i]['storage'] = '';
            
                    // 삭제에 체크가 되어있다면 파일을 삭제합니다.
                    if (isset($_POST['bf_file_del'][$i]) && $_POST['bf_file_del'][$i]) {
                        $upload[$i]['del_check'] = true;
            
                        $row = sql_fetch(" select * from {$g5['board_file_table']} where bo_table = 'rater' and wr_id = '{$_POST['us_idx']}' and bf_no = '{$i}' ");
            
                        $delete_file = run_replace('delete_file_path', G5_DATA_PATH.'/file/'.$bo_table.'/'.str_replace('../', '', $row['bf_file']), $row);
                        if( file_exists($delete_file) ){
                            @unlink($delete_file);
                        }
                        
                    }
                    else
                        $upload[$i]['del_check'] = false;
            
                    $tmp_file  = $_FILES['bf_file']['tmp_name'][$i];
                    $filesize  = $_FILES['bf_file']['size'][$i];
                    $filename  = $_FILES['bf_file']['name'][$i];
                    $filename  = get_safe_filename($filename);
            
                    // 서버에 설정된 값보다 큰파일을 업로드 한다면
                    if ($filename) {
                        if ($_FILES['bf_file']['error'][$i] == 1) {
                            $file_upload_msg .= '\"'.$filename.'\" 파일의 용량이 서버에 설정('.$upload_max_filesize.')된 값보다 크므로 업로드 할 수 없습니다.\\n';
                            continue;
                        }
                        else if ($_FILES['bf_file']['error'][$i] != 0) {
                            $file_upload_msg .= '\"'.$filename.'\" 파일이 정상적으로 업로드 되지 않았습니다.\\n';
                            continue;
                        }
                    }
            
                    if (is_uploaded_file($tmp_file)) {
                        // 관리자가 아니면서 설정한 업로드 사이즈보다 크다면 건너뜀
                        // if (!$is_admin && $filesize > 104857600) {
                        //     $file_upload_msg .= '\"'.$filename.'\" 파일의 용량('.number_format($filesize).' 바이트)이 게시판에 설정(104857600 바이트)된 값보다 크므로 업로드 하지 않습니다.\\n';
                        //     continue;
                        // }
            
                        //=================================================================\
                        // 090714
                        // 이미지나 플래시 파일에 악성코드를 심어 업로드 하는 경우를 방지
                        // 에러메세지는 출력하지 않는다.
                        //-----------------------------------------------------------------
                        $timg = @getimagesize($tmp_file);
                        // image type
                        if ( preg_match("/\.({$config['cf_image_extension']})$/i", $filename) ||
                             preg_match("/\.({$config['cf_flash_extension']})$/i", $filename) ) {
                            if ($timg['2'] < 1 || $timg['2'] > 16)
                                continue;
                        }
                        //=================================================================
            
                        $upload[$i]['image'] = $timg;
            
            
                        // 프로그램 원래 파일명
                        $upload[$i]['source'] = $filename;
                        $upload[$i]['filesize'] = $filesize;
            
                        // 아래의 문자열이 들어간 파일은 -x 를 붙여서 웹경로를 알더라도 실행을 하지 못하도록 함
                        $filename = preg_replace("/\.(php|pht|phtm|htm|cgi|pl|exe|jsp|asp|inc)/i", "$0-x", $filename);
            
                        shuffle($chars_array);
                        $shuffle = implode('', $chars_array);
            
                        // 첨부파일 첨부시 첨부파일명에 공백이 포함되어 있으면 일부 PC에서 보이지 않거나 다운로드 되지 않는 현상이 있습니다. (길상여의 님 090925)
                        $upload[$i]['file'] = abs(ip2long($_SERVER['REMOTE_ADDR'])).'_'.substr($shuffle,0,8).'_'.replace_filename($filename);
            
                        $dest_file = G5_DATA_PATH.'/file/'.$bo_table.'/'.$upload[$i]['file'];
            
                        // 업로드가 안된다면 에러메세지 출력하고 죽어버립니다.
                        $error_code = move_uploaded_file($tmp_file, $dest_file) or die($_FILES['bf_file']['error'][$i]);
            
                        // 올라간 파일의 퍼미션을 변경합니다.
                        chmod($dest_file, G5_FILE_PERMISSION);
            
                        $dest_file = run_replace('write_update_upload_file', $dest_file, $board, $wr_id, $w);
                        $upload[$i] = run_replace('write_update_upload_array', $upload[$i], $dest_file, $board, $wr_id, $w);
                        
                    }
                }   // end for
            }   // end if

            $all_file = 0;
            // 나중에 테이블에 저장하는 이유는 $wr_id 값을 저장해야 하기 때문입니다.
            for ($i=0; $i<$upload_count; $i++){
                if( $upload[$i]['source'] != ""){
                    $row = sql_fetch(" select count(*) as cnt from {$g5['board_file_table']} where bo_table = 'rater' and wr_id = '{$_POST['rater_idx']}' and bf_no = '{$i}' ");
                    if ($row['cnt'] )
                    {
                        // 삭제에 체크가 있거나 파일이 있다면 업데이트를 합니다.
                        // 그렇지 않다면 내용만 업데이트 합니다.
                        if ($upload[$i]['del_check'] || $upload[$i]['file'])
                        {
                            $sql = " update {$g5['board_file_table']}
                                        set bf_source = '{$upload[$i]['source']}',
                                            bf_file = '{$upload[$i]['file']}',
                                            bf_content = '{$bf_content[$i]}',
                                            bf_fileurl = '{$upload[$i]['fileurl']}',
                                            bf_thumburl = '{$upload[$i]['thumburl']}',
                                            bf_storage = '{$upload[$i]['storage']}',
                                            bf_filesize = '".(int)$upload[$i]['filesize']."',
                                            bf_width = '".(int)$upload[$i]['image'][0]."',
                                            bf_height = '".(int)$upload[$i]['image'][1]."',
                                            bf_type = '".(int)$upload[$i]['image'][2]."',
                                            bf_datetime = '".G5_TIME_YMDHIS."'
                                    where bo_table = 'rater'
                                                and wr_id = '{$_POST['rater_idx']}'
                                                and bf_no = '{$i}' ";
                            sql_query($sql);
                        }
                        else
                        {
                            $sql = " update {$g5['board_file_table']}
                                        set bf_content = '{$bf_content[$i]}'
                                        where bo_table = 'rater'
                                                and wr_id = '{$_POST['rater_idx']}'
                                                and bf_no = '{$i}' ";
                            sql_query($sql);
                        }
                    }
                    else
                    {
                        $sql = " insert into {$g5['board_file_table']}
                                    set bo_table = 'rater',
                                       wr_id = '{$_POST['rater_idx']}',
                                        bf_no = '{$i}',
                                        bf_source = '{$upload[$i]['source']}',
                                        bf_file = '{$upload[$i]['file']}',
                                        bf_content = '{$bf_content[$i]}',
                                        bf_fileurl = '{$upload[$i]['fileurl']}',
                                        bf_thumburl = '{$upload[$i]['thumburl']}',
                                        bf_storage = '{$upload[$i]['storage']}',
                                        bf_download = 0,
                                        bf_filesize = '".(int)$upload[$i]['filesize']."',
                                        bf_width = '".(int)$upload[$i]['image'][0]."',
                                        bf_height = '".(int)$upload[$i]['image'][1]."',
                                        bf_type = '".(int)$upload[$i]['image'][2]."',
                                        bf_datetime = '".G5_TIME_YMDHIS."',
                                        bf_user_type = 0 ";
                        sql_query($sql);
                        run_event('write_update_file_insert', $bo_table, $wr_id, $upload[$i], $w);
                    }
                }


                
            }



            // 업로드된 파일 내용에서 가장 큰 번호를 얻어 거꾸로 확인해 가면서
            // 파일 정보가 없다면 테이블의 내용을 삭제합니다.
            $row = sql_fetch(" select max(bf_no) as max_bf_no from {$g5['board_file_table']} where bo_table = 'g5_business_propos' and wr_id = '{$row2['idx']}' ");
            $row2 = sql_fetch(" select * from g5_business_propos where bo_idx = '{$_POST['wr_id']}' and mb_id = '{$member['mb_id']}'");
            for ($i=(int)$row['max_bf_no']; $i>=0; $i--)
            {
                $row2 = sql_fetch(" select bf_file from {$g5['board_file_table']} where bo_table = 'g5_business_propos' and wr_id = '{$row2['idx']}' and bf_no = '{$i}' ");

                // 정보가 있다면 빠집니다.
                if ($row2['bf_file']) break;

                // 그렇지 않다면 정보를 삭제합니다.
                sql_query(" delete from {$g5['board_file_table']} where bo_table = 'g5_business_propos' and wr_id = '{$row2['idx']}' and bf_no = '{$i}' ");
            }

            // 파일의 개수를 게시물에 업데이트 한다.
            $row2 = sql_fetch(" select * from g5_business_propos where bo_idx = '{$_POST['wr_id']}' and mb_id = '{$member['mb_id']}'");
            $row = sql_fetch(" select count(*) as cnt from {$g5['board_file_table']} where bo_table = 'g5_business_propos' and wr_id = '{$row2['idx']}' ");
            sql_query(" update g5_business_propos set file = '{$file_count}' where idx = '{$row2['idx']}' ");

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
