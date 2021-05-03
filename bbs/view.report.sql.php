<?php
include_once('./_common.php');

$row = sql_fetch("select * from rater_value where rater_idx = '{$_POST['rater_idx']}'");
if($row == ""){
    $text = "저장";
    $value= true;
    $color  = "#ccc";
}else {
    $text = '수정';
    $color  = "#1D2E58";
    $value= false;
}

if($row['value'] == "") {
    $value_num = 0;
} else {
    $value_num = $row['value']; 
}

$sql2 = " select * from g5_board_file where bo_table = 'rater' and wr_id = '{$_POST['rater_idx']}' and bf_user_type = 0 order by bf_no desc";
$result2 = sql_query($sql2);    

// 가변 파일
    for ($i=0; $row_list2 = sql_fetch_array($result2); $i++) {
        if (isset($row_list2['bf_source'][$i])) {
?>
<script>
    $(function(){
        $('.all_user_file').after(
            '<tr class="input-file_list">'
            <?php
                //MB 단위 이상일때 MB 단위로 환산
                if ($row_list2['bf_filesize'] >= 1024 * 1024) {
                    $fileSize = $row55['bf_filesize'] / (1024 * 1024);
                    $convertlastpage = sprintf('%0.2f', $fileSize); // 520 -> 520.00
                    $str = $convertlastpage . ' MB';
                } else {
                    $fileSize = $row_list2['bf_filesize'] / 1024;
                    $convertlastpage = sprintf('%0.2f', $fileSize); // 520 -> 520.00
                    $str = $convertlastpage . ' KB';
                }
            ?>
            +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일명</th>'
            +'<td scope="col" class="view_table_text" colspan="1" style="width:40%">'
            +'<input type="text" id="file_label_view1" readonly="readonly" class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="<?= $row_list2['bf_source']; ?>" style="margin: 0 -2px;"/>'
            +'</td>'
            +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 사이즈</th>'
            +'<td scope="col" class="view_table_text" colspan="1" style="width:20%">'
            +    '<input type="hidden" value="<?= $row_list2['bo_table']; ?>" id="sql_file_tabel">'
            +    '<input type="hidden" value="<?= $row_list2['wr_id']; ?>" id="sql_file_id">'
            +    '<input type="hidden" value="<?= $row_list2['bf_no']; ?>" id="sql_file_no">'
            +    '<input type="text" id="file-size-<?= $i ?>" class="file-name file-size" style="margin: 0 -2px;" value="<?= $str ?>" readonly="readonly"/>'
            +    '<input type="file" name="bf_file[]" id="upload_0<?= $i ?>" value="<?= $row_list2['bf_no']; ?>" class="file-upload file_sql_upload" <?= $row['value'] ==2? "disabled": ""; ?> />'
            +    '<input type="checkbox" class="del-no" id="del-_no<?= $i ?>" name="del-no[]" value="<?= $row_list2['bf_no']; ?>" style="display:none;">'
            +'</td>'
            +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 삭제</th>'
            +'<td scope="col" class="view_table_text" colspan="1" style="width:10%">'
            +'    <label for="del-_no<?= $i ?>" class="file-label del-no-btn">삭제</label>'
            +'</td>'
            +'</tr>'
        );
    })
</script>
        
<?php
        }
    }
?>
<script>
    $(function(){
        if('<? $_POST['bo_idx'] ?>' != 2){
            $('#test_fild_1').val('<?= $row['test_fild_1'] ?>');
            $('#test_fild_2').val('<?= $row['test_fild_2'] ?>');
            $('#test_fild_3').val(<?= $row['test_fild_3'] ?>);
            $('#test_fild_4').val(<?= $row['test_fild_4'] ?>);
        } else {
            if('<?= $row['test_fild_1'] ?>' == 1) {
                $('#test_radio_1').prop('checked', true); 
            } else {
                $('#test_radio_2').prop('checked', true);
            }
        }
        
        $('#test_fild_sum').val('<?= $row['test_sum'] ?>');
        $('#test_opinion').val('<?= $row['test_opinion'] ?>');
        $('#us_idx').val('<?= $_POST['us_idx'] ?>');
        $('#rater_idx').val('<?= $_POST['rater_idx'] ?>');
        $('#value_btn_submit').text('<?= $text ?>');
        $('#value_btn_submit').attr('disabled', <?= $value ?>);
        $('#value_btn_submit').css({'background': '<?= $color ?>'})
        if (<?= $value_num ?> == 2){
            $('#value_btn_submit').remove();
        } 
        if(<?= $row['value'] == 2? 'true' : 'false' ?>){
            $("#file-label-btn").attr('for', '');
            $('.rater_form input').attr('disabled', true);
            $('.rater_form textarea').attr('disabled', true);
        }

        var rater_value = '<?= $row['value'] == "" ? 0 : $row['value']; ?>';
        $('.del-no-btn').click(function(){
            if(rater_value < 2){
                var check_val =  $(this).parent().prev().prev().find('input[type="checkbox"].del-no').is(":checked");
                $(this).parent().prev().prev().find('.file_sql_upload').attr('name', 'report_name[]');
                $(this).parent().parent().css({'display':'none'});

            }
        })
    })
</script>


<?php 
                    