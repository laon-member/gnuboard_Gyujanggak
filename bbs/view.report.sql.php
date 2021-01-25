<?php
include_once('./_common.php');

$row = sql_fetch("select * from rater_value where report_idx = '{$_POST['us_idx']}' and rater_idx = '{$_POST['rater_idx']}'");

if($row == ""){
    $text = "저장";
    $value= false;
    $color  = "#ccc";
}else {
    $text = '수정';
    if($row['test_user'] != "" && $row['test_title'] != "" && $row['test_plan'] != "" && $row['test_sum'] != "" && $row['test_opinion'] != ""){
        $value= true;
        $color  = "#1D2E58";
    }
}

if($row['value'] == "") {
    $value_num = 0;
} else {
    $value_num = $row['value']; 
}

?>
<script>
    $(function(){
        $('#test_user').val("<?= $row['test_user'] ?>");
        $('#test_title').val('<?= $row['test_title'] ?>');
        $('#test_plan').val(<?= $row['test_plan'] ?>);
        $('#test_sum').val('<?= $row['test_sum'] ?>');
        $('#test_opinion').val('<?= $row['test_opinion'] ?>');
        $('#us_idx').val('<?= $_POST['us_idx'] ?>');
        $('#rater_idx').val('<?= $_POST['rater_idx'] ?>');
        $('#value_btn_submit').text('<?= $text ?>');
        $('#value_btn_submit').attr('disabled', '<?= $value ?>');
        $('#value_btn_submit').css({'background': '<?= $color ?>'})
        if (<?= $value_num ?> == 2){
            $('#value_btn_submit').remove();
        } 
    })
</script>
