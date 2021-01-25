<?php
include_once('./_common.php');
// include_once(G5_LIB_PATH.'/naver_syndi.lib.php');
// include_once(G5_CAPTCHA_PATH.'/captcha.lib.php');

// // 토큰체크
// check_write_token($bo_table);

// $g5['title'] = '게시글 저장';


// if ($w == '' || $w == 'r') {
//     if (isset($_SESSION['ss_datetime'])) {
//         if ($_SESSION['ss_datetime'] >= (G5_SERVER_TIME - $config['cf_delay_sec']) && !$is_admin)
//             alert('너무 빠른 시간내에 게시물을 연속해서 올릴 수 없습니다.');
//     }

//     set_session("ss_datetime", G5_SERVER_TIME);
// }

// echo $bo_idx;

if($_GET['bo_idx'] == 1){
    $val = "report_val_1 =".$_POST['save']."";
} else if($_GET['bo_idx'] == 2){
    $val = "report_val_2".$_POST['save']."";
}


if ($_POST['save'] == '1') {
    if($_POST['save_db']){
        $sql = " update report
                set report_idx = '$wr_reply',
                contents = '{$_POST['contents']}',
                report_file = '0',
                report = '1',
                report_value = '0' where idx = '{$_POST['file_idx']}'";
        sql_query($sql);

        $sql = " update g5_business_propos
                set $val
                where idx = '{$_POST['wr_bo_idx']}'";
        sql_query($sql);

    } else {
        if($_POST['contents'] == "") return alert("상세설명이 비어 있습니다");

        $sql = " insert into report
        set business_idx = '$wr_bo_idx',
            mb_id = '$member[mb_id]',
            report_idx = '$bo_idx',
            contents = '{$_POST['contents']}',
            report_file = '0',
            report = '1',
            report_value = '0'";
        sql_query($sql);

        $sql = " update g5_business_propos
                set $val
                where idx = '{$_POST['wr_bo_idx']}'";
        sql_query($sql);
    }
    
} else if ($_POST['save'] == '2') {
    

    if($_POST['save_db']){


        $sql = " update report
                set report_idx = '1',
                contents = '{$_POST['contents']}',
                report_file = '0',
                report = '2',
                report_value = '0' where idx = '{$_POST['file_idx']}'";
        sql_query($sql);

        $sql = " update g5_business_propos
            set $val
            where idx = '{$_POST['wr_bo_idx']}'";
        sql_query($sql);

    } else {
        if($_POST['contents'] == "") return alert("상세설명이 비어 있습니다");

        $sql = " insert into report
        set business_idx = '$wr_bo_idx',
            mb_id = '$member[mb_id]',
            report_idx = '$bo_idx',
            contents = '{$_POST['contents']}',
            report_file = '0',
            report = '2',
            report_value = '0'";
        sql_query($sql);

        $sql = " update g5_business_propos
                set $val
                where idx = '{$_POST['wr_bo_idx']}'";
        sql_query($sql);
    }

} else {
    alert('w 값이 제대로 넘어오지 않았습니다.');
}



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

            $row = sql_fetch(" select * from {$g5['board_file_table']} where bo_table = '{$bo_table}' and wr_id = '{$_POST['file_idx']}' and bf_no = '{$i}' ");

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
            if (!$is_admin && $filesize > $board['bo_upload_size']) {
                $file_upload_msg .= '\"'.$filename.'\" 파일의 용량('.number_format($filesize).' 바이트)이 게시판에 설정('.number_format($board['bo_upload_size']).' 바이트)된 값보다 크므로 업로드 하지 않습니다.\\n';
                continue;
            }

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
// 나중에 테이블에 저장하는 이유는 $wr_id 값을 저장해야 하기 때문입니다.
for ($i=0; $i<count($upload); $i++)
{
    if( $upload[$i]['source'] != ""){
        if (!get_magic_quotes_gpc()) {
            $upload[$i]['source'] = addslashes($upload[$i]['source']);
        }
        $row = sql_fetch(" select count(*) as cnt from {$g5['board_file_table']} where bo_table = 'report' and wr_id = '{$_POST['file_idx']}' and bf_no = '{$i}' ");
        $row22 = sql_fetch(" select * from report where business_idx = '{$wr_bo_idx}'");
        echo " select * from report where business_idx = '{$wr_bo_idx}'";
        echo $row22['idx'];
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
                          where bo_table = 'report'
                                    and wr_id = '{$row22['idx']}'
                                    and bf_no = '{$i}' ";
                sql_query($sql);
            }
            else
            {
                $sql = " update {$g5['board_file_table']}
                            set bf_content = '{$bf_content[$i]}'
                            where bo_table = 'report'
                                      and wr_id = '{$row22['idx']}'
                                      and bf_no = '{$i}' ";
                sql_query($sql);
            }
        }
        else
        {
            $sql = " insert into {$g5['board_file_table']}
                        set bo_table = 'report',
                             wr_id = '{$row22['idx']}',
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
                             bf_datetime = '".G5_TIME_YMDHIS."' ";
            sql_query($sql);
            run_event('write_update_file_insert', $bo_table, $wr_id, $upload[$i], $w);
        }
    }
    
}

// 업로드된 파일 내용에서 가장 큰 번호를 얻어 거꾸로 확인해 가면서
// 파일 정보가 없다면 테이블의 내용을 삭제합니다.
$row = sql_fetch(" select max(bf_no) as max_bf_no from {$g5['board_file_table']} where bo_table = '{$bo_table}' and wr_id = '{$wr_id}' ");
for ($i=(int)$row['max_bf_no']; $i>=0; $i--)
{
    $row2 = sql_fetch(" select bf_file from {$g5['board_file_table']} where bo_table = '{$bo_table}' and wr_id = '{$wr_id}' and bf_no = '{$i}' ");

    // 정보가 있다면 빠집니다.
    if ($row2['bf_file']) break;

    // 그렇지 않다면 정보를 삭제합니다.
    sql_query(" delete from {$g5['board_file_table']} where bo_table = '{$bo_table}' and wr_id = '{$wr_id}' and bf_no = '{$i}' ");
}

// 파일의 개수를 게시물에 업데이트 한다.
$row = sql_fetch(" select count(*) as cnt from {$g5['board_file_table']} where bo_table = 'report' and wr_id = '{$_POST['file_idx']}' ");
sql_query(" update report set wr_file = '{$row['cnt']}' where idx = '{$_POST['file_idx']}' ");



// update report
//                 set report_idx = '1',
//                 contents = '{$_POST['contents']}',
//                 report_file = '0',
//                 report = '2',
//                 report_value = '0' where idx = '{$_POST['file_idx']}'";


// 사용자 코드 실행
@include_once($board_skin_path.'/write_update.skin.php');
@include_once($board_skin_path.'/write_update.tail.skin.php');

delete_cache_latest($bo_table);

$redirect_url = run_replace('write_update_move_url', short_url_clean(G5_HTTP_BBS_URL.'/board.report.php?bo_table=business&bo_idx=1'), $board, $wr_id, $w, $qstr, $file_upload_msg);

run_event('write_update_after', $board, $wr_id, $w, $qstr, $redirect_url);

if ($file_upload_msg)
    alert($file_upload_msg, $redirect_url);
else
    goto_url($redirect_url);
?>
