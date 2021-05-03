<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$board_skin_url.'/style.css">', 0);
    
$sql1 = " SELECT * FROM `g5_business_propos` where idx = '{$_GET['us_idx']}'";
$result1 = sql_query($sql1);
$row=sql_fetch_array($result1);

$sql1 = " SELECT * FROM `g5_write_business` where wr_id = '{$row['bo_idx']}'";
$result1 = sql_query($sql1);
$row22=sql_fetch_array($result1);


$sql1 = " SELECT * FROM `g5_write_business_title` where idx = '{$row['bo_title_idx']}'";
$result1 = sql_query($sql1);
$row33=sql_fetch_array($result1);
$category_title = $row33['title'];

?>
<aside id="bo_side">
    <h2 class="aside_nav_title">지원결과 확인</h2>
    <?php $class_get =  $_GET['bo_idx'] == '1'?"aisde_click":""; ?>
    <a class="aside_nav aisde_click" href="<?= G5_BBS_URL ?>/board.value.php?bo_table=business&bo_idx=1">지원결과 확인</a>
</aside>


<?php if ($row['bo_title_idx'] == 1) {  ?>
    <section id="bo_v" style="width:80%;">
        <h2 class="sound_only"><?php echo $g5['title'] ?></h2>
        <!-- 게시물 작성/수정 시작 { -->
        <form name="fwrite" id="fwrite" action="<?php echo $action_table_url; ?>" onsubmit=" fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" style="width:<?php echo $width; ?>">
        <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
        <input type="hidden" name="w" value="<?php echo $w ?>">
        <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
        <input type="hidden" name="wr_id" value="<?php echo $_GET['wr_id'] != "" ? $_GET['wr_id'] : $_POST['wr_id']; ?>">
        <input type="hidden" name="sca" value="<?php echo $sca ?>">
        <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
        <input type="hidden" name="stx" value="<?php echo $stx ?>">
        <input type="hidden" name="spt" value="<?php echo $spt ?>">
        <input type="hidden" name="sst" value="<?php echo $sst ?>">
        <input type="hidden" name="sod" value="<?php echo $sod ?>">
        <input type="hidden" name="page" value="<?php echo $page ?>">
        <input type="hidden" name="bo_idx" value="<?php echo $_GET['us_idx'] ?>">
        
            <div class="bo_w_tit write_div">
                <div id="bo_btn_top_app">
                    <h1 class="view_title"><?=  $category_title ?></h1>
                </div>
            </div>



            <table class="view_table_app">
                <thead>
                    <tr>
                        <th scope="col" class="view_table_header"colspan="1" style="width: 10%;">제목</th>
                        <td scope="col" class="view_table_title" colspan="8" style="width: 90%;">
                            <input type="text" name="title" id="title"  class="input_text   " placeholder="제목" value="<?= $row22['wr_subject']; ?>"  readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" style="width: 10%;">접수번호</th>
                        <td scope="col" class=" view_table_text  " colspan="1" style="width: 40%;">
                        <input type="text" name="info_number" id="info_number"  class="input_text  " placeholder="접수 완료시 자동부여됩니다."  value="<?= $row['info_number']; ?>" readonly>
                        </td>
                        <th scope="col" class="view_table_header" style="width: 10%;">과제번호</th>
                        <td scope="col" class=" view_table_text  " colspan="7" style="width: 40%;">
                        <input type="text" name="quest_number" id="quest_number"  class="input_text  " placeholder="선발 후 부여됩니다" value="<?= $row['quest_number']; ?>" readonly>
                        </td>
                    </tr>
                </thead>
                <tbody id="input_file_cont">
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">연구과제명</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1">과제명(국문)</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="8">
                        <input type="text" name="ko_title" id="ko_title"  class="input_text input_border_true" placeholder="과제명(국문)"  value="<?= $row['ko_title']; ?>" >
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1">과제명(영문)</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="8">
                        <input type="text" name="en_title" id="en_title"  class="input_text input_border_true" placeholder="과제명(영문)"  value="<?= $row['en_title']; ?>" >
                        </td>
                    </tr>
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">연구책임자</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1">성명</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="1">
                        <input type="text" name="name" id="name"  class="input_text input_border_true" placeholder="성명"  value="<?= $row['name']; ?>" >
                        </td>
                        <th scope="col" class="view_table_header" colspan="1">전공(학위)</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="6">
                        <input type="text" name="degree" id="degree"  class="input_text input_border_true" placeholder="전공(학위)"  value="<?= $row['degree']; ?>" >
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1">소속</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="1">
                        <input type="text" name="belong" id="belong"  class="input_text input_border_true" placeholder="소속"  value="<?= $row['belong']; ?>" >
                        </td>
                        <th scope="col" class="view_table_header" colspan="1">직급</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="6">
                        <input type="text" name="rank" id="rank"  class="input_text input_border_true" placeholder="직급"  value="<?= $row['rank']; ?>" >
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1">이메일</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="1">
                        <input type="text" name="email" id="email"  class="input_text input_border_true" placeholder="이메일"  value="<?= $row['email']; ?>" >
                        </td>
                        <th scope="col" class="view_table_header" colspan="1">전화</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="6">
                        <input type="text" name="phone" id="phone"  class="input_text input_border_true" placeholder="전화"  value="<?= $row['phone']; ?>" >
                        </td>
                    </tr>
                
                    <tr>
                        <th scope="col" class="view_table_header">공동연구원</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="1">
                        <input type="text" name="main_member" id="main_member"  class="input_text input_border_true" placeholder="명" value="<?= $row['main_member']; ?>" >
                        </td>
                        <th scope="col" class="view_table_header">연구원보조</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="6">
                        <input type="text" name="sub_member" id="sub_member"  class="input_text input_border_true" placeholder="명" value="<?= $row['sub_member']; ?>" >
                        </td>
                    </tr>
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">연구정보</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1">연구비신청액</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="8">
                        <input type="text" name="money" id="money"  class="input_text input_border_true" placeholder="연구비신청액"  value="<?= $row['money']; ?>" >
                        </td>
                    </tr>
                    <tbody class="file_table_all">
                    <tr class="view_table_header_table"></tr>
                    <tr class="all_user_file">
                        <th scope="col" class="view_table_header " colspan="9">자료 첨부</th>
                    </tr>
                    <?php 
                        $sql2 = " select * from g5_board_file where bo_table = 'g5_business_propos' and wr_id = '{$row['idx']}' and bf_user_type = 0";
                        $result2 = sql_query($sql2);    

                        // 가변 파일
                            for ($i=0; $row_list2 = sql_fetch_array($result2); $i++) {
                                if (isset($row_list2['bf_source'][$i])) {
                        ?>
                                <tr class="input-file_list file_list_check" >
                                    <?php
                                        //MB 단위 이상일때 MB 단위로 환산
                                        if ($row_list2['bf_filesize'] >= 1024 * 1024) {
                                            $fileSize = $row_list2['bf_filesize'] / (1024 * 1024);
                                            $convertlastpage = sprintf('%0.2f', $fileSize); // 520 -> 520.00
                                            $str = $convertlastpage . ' MB';
                                        }
                            
                                        else {
                                            $fileSize = $row_list2['bf_filesize'] / 1024;
                                            $convertlastpage = sprintf('%0.2f', $fileSize); // 520 -> 520.00
                                            $str = $convertlastpage . ' KB';
                                        }
                                    ?>
                                    <th scope="col" class="view_table_header" colspan="1" style="width:10%">파일명</th>
                                    <td scope="col" class=" view_table_text view_table_padding" colspan="1" style="width:40%">
                                    <input type="text" id="file_label1"  class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="<?= $row_list2['bf_source']; ?>" style="margin: 0 -2px;" readonly/>
                                    </td>
                                    <th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 사이즈</th>
                                    <td scope="col" class=" view_table_text view_table_padding" colspan="2" style="width:20%">
                                        <input type="hidden" value="<?= $row_list2['bo_table']; ?>" class="sql_file_tabel">
                                        <input type="hidden" value="<?= $row_list2['wr_id']; ?>" class="sql_file_id">
                                        <input type="hidden" value="<?= $row_list2['bf_no']; ?>" class="sql_file_no">
                                        <input type="text" id="file-size-'+file_number+'" class="file-name file-size" style="margin: 0 -2px;" value="<?= $str ?>" readonly/>
                                        <input type="file" name="bf_file[]" id="upload00" value="<?= $row_list2['bf_no']; ?>" class="file-upload file_sql_upload" <?= $row44['report'] ==2? "disabled": ""; ?> />
                                        <input type="checkbox" class="del-no" id="del-no<?= $i ?>" name="del-no[]" value="<?= $row_list2['bf_no']; ?>" style="display:none;">
                                        <input type="hidden" name="file_type[]" value ="0" />
                                    </td>
                                    <th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 삭제</th>
                                    <td scope="col" class=" view_table_text view_table_padding" colspan="2" style="width:10%">
                                        <label for="del-no<?= $i ?>" class="file-label del-no-btn">삭제</label>
                                    </td>
                                </tr>
                                <?php
                                }
                            }
                        ?>
                </tbody>
                <tbody class="file_table_rater">
                    <tr class="view_table_header_table"></tr>
                    <tr class="rater_user_file">
                        <th scope="col" class="view_table_header " colspan="9">심사자용 자료 첨부(인적사항 무기입)</th>
                        
                    </tr>
                    <?php 
                        $sql2 = " select * from g5_board_file where bo_table = 'g5_business_propos' and wr_id = '{$row['idx']}' and bf_user_type = 1";
                        $result2 = sql_query($sql2);    

                        // 가변 파일
                            for ($i=0; $row_list2 = sql_fetch_array($result2); $i++) {
                                if (isset($row_list2['bf_source'][$i])) {
                        ?>
                                <tr class="input-file_list file_list_check">
                                    <?php
                                        //MB 단위 이상일때 MB 단위로 환산
                                        if ($row_list2['bf_filesize'] >= 1024 * 1024) {
                                            $fileSize = $row_list2['bf_filesize'] / (1024 * 1024);
                                            $convertlastpage = sprintf('%0.2f', $fileSize); // 520 -> 520.00
                                            $str = $convertlastpage . ' MB';
                                        }
                            
                                        else {
                                            $fileSize = $row_list2['bf_filesize'] / 1024;
                                            $convertlastpage = sprintf('%0.2f', $fileSize); // 520 -> 520.00
                                            $str = $convertlastpage . ' KB';
                                        }
                                    ?>
                                    <th scope="col" class="view_table_header" colspan="1" style="width:10%">파일명</th>
                                    <td scope="col" class=" view_table_text view_table_padding" colspan="1" style="width:40%">
                                    <input type="text" id="file_label1"  class="file-name file-server-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="<?= $row_list2['bf_source']; ?>" style="margin: 0 -2px;" readonly/>
                                    </td>
                                    <th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 사이즈</th>
                                    <td scope="col" class=" view_table_text view_table_padding" colspan="2" style="width:20%">
                                        <input type="hidden" value="<?= $row_list2['bo_table']; ?>" class="sql_file_tabel">
                                        <input type="hidden" value="<?= $row_list2['wr_id']; ?>" class="sql_file_id">
                                        <input type="hidden" value="<?= $row_list2['bf_no']; ?>" class="sql_file_no">
                                        <input type="text" id="file-size-'+file_number+'" class="file-name file-size" style="margin: 0 -2px;" value="<?= $str ?>" readonly/>
                                        <input type="file" name="bf_file[]" id="upload00" value="<?= $row_list2['bf_no']; ?>" class="file-upload file_sql_upload" <?= $row44['report'] ==2? "disabled": ""; ?> />
                                        <input type="checkbox" class="del-no" id="del-no-<?= $i ?>" name="del-no[]" value="<?= $row_list2['bf_no']; ?>" style="display:none">
                                        <input type="hidden" name="file_type[]" value ="1" />
                                    </td>
                                    <th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 삭제</th>
                                    <td scope="col" class=" view_table_text view_table_padding" colspan="2" style="width:10%">
                                        <label for="del-no-<?= $i ?>" class="file-label del-no-btn">삭제</label>
                                    </td>
                                </tr>
                                <?php
                                }
                            }
                        ?>
                </tbody>
               
            </table>

            <div class="btn_confirm write_div btn-cont">
                <label for="upload01" id="file-label-btn" class="file-label file-label-btn"><img src="<?= G5_IMG_URL ?>/upload.png" alt=""> 파일 업로드</label>
                <label for="upload1_01" id="file-label-btn1" class="file-label file-label-btn"><img src="<?= G5_IMG_URL ?>/upload.png" alt=""> 심사자용 업로드</label>

                <a href="<?= G5_BBS_URL ?>/board.value.php?bo_table=business&bo_idx=<?= $_GET['bo_idx'] ?>" class=" btn_color_white">취소</a>
                <button type="submit" class="btn_next_prv btn_next_prv_link btn-update">수정</button>
            </div>
        </form>
    </section>

    <script>
        $(function(){
            $('.btn-update').click(function(){
                // validation
                if($('#ko_title').val() == "") { alert("국문 과제명이 비어있습니다"); return false;}
                if($('#en_title').val() == "")  {alert("영문 과제명이 비어있습니다"); return false;}
                if($('#name').val() == "")  {alert("성명이 비어있습니다"); return false;}
                if($('#degree').val() == "")  {alert("전공(학위)이 비어있습니다"); return false;}
                if($('#belong').val() == "")  {alert("소속이 비어있습니다"); return false;}
                if($('#rank').val() == "") { alert("직급이 비어있습니다"); return false;}
                if($('#email').val() == "")  {alert("이메일이 비어있습니다"); return false;}
                if($('#phone').val() == "")  {alert("전화번호가 비어있습니다"); return false;}
                if($('#main_member').val() == "")  {alert("공동연구원이 비어있습니다"); return false;}
                if($('#sub_member').val() == "")  {alert("연구원보조가 비어있습니다"); return false;}
                if($('#value').val() == "")  {alert("연구비신청액이 비어있습니다"); return false;}

                if($('.file_table_all .file_list_check').length == 0)  {alert('파일을 업로드 하세요.'); return false;}
                if($('.file_table_rater .file_list_check').length == 0)  {alert('심사자용 파일을 업로드 하세요.'); return false;}

                
                //정규식 설정
                var fncTest = /^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]+(\.[a-zA-Z]{2,3}){1,4}$/i;
                var regex= /^[0-9]+$/;


                //정규식 결과 저장
                var emailResult = fncTest.test( $("#email").val() );
                if(!emailResult)  {alert("E-mail 주소가 형식에 맞지 않습니다."); return false;}

                var phoneResult = regex.test( $("#phone").val() );
                if(!phoneResult)  {alert("전화번호에 숫자만 입력해주세요"); return false;}

                var main_memberResult = regex.test( $("#main_member").val() );
                if(!main_memberResult)  {alert("공동연구원에 숫자만 입력해주세요"); return false;}
                
                var sub_memberResult = regex.test($("#sub_member").val());
                if(!sub_memberResult) { alert("연구원보조에 숫자만 입력해주세요"); return false;}

                var moneyResult = regex.test( $("#money").val());
                if(!moneyResult)  {alert("연구비신청액에 숫자만 입력해주세요"); return false;}


                    

            })
                

            
              
            var file_number = 1;
            var file_number_rater = 1;

            var html = '<tr class="input-file_list ">'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일명</th>'
                        +'<td scope="col" class=" view_table_text view_table_padding" colspan="1" style="width:40%">'
                        +'    <input type="text" style="margin: 0 -2px;" id="file_label1" ="" class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="파일명" readonly/> '
                        +'</td>'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 사이즈</th>'
                        +'<td scope="col" class=" view_table_text view_table_padding" colspan="2" style="width:20%">'
                        +'    <input type="text" id="file-size-'+file_number+'" class="file-name file-size" style="margin: 0 -2px;" value="용량" ="" readonly/>'
                        +'    <input type="file" name="bf_file_null[]" id="upload01" class="file-upload" <?= $row44['report'] ==2? "disabled": ""; ?> />'
                        +'</td>'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 삭제</th>'
                        +'<td scope="col" class=" view_table_text view_table_padding" colspan="2" style="width:10%">'
                        +'<button type="button" class="file-label file-del " id="file-del<?= $i ?>" <?= $row44['report'] ==2? "disabled": ""; ?>>삭제</button>'
                        +'</td>'
                        +'</tr>';


            var html2 = '<tr class="input-file_list ">'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일명</th>'
                        +'<td scope="col" class=" view_table_text view_table_padding" colspan="1" style="width:40%">'
                        +'    <input type="text" style="margin: 0 -2px;" id="file_label1" ="" class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="파일명" readonly/> '
                        +'</td>'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 사이즈</th>'
                        +'<td scope="col" class=" view_table_text view_table_padding" colspan="2" style="width:20%">'
                        +'    <input type="text" id="file-size-'+file_number_rater+'" class="file-name file-size" style="margin: 0 -2px;" value="용량" ="" readonly/>'
                        +'    <input type="file" name="bf_file_null[]" id="upload1_01" class="file-upload" <?= $row44['report'] ==2? "disabled": ""; ?> />'
                        +'</td>'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 삭제</th>'
                        +'<td scope="col" class=" view_table_text view_table_padding" colspan="2" style="width:10%">'
                        +'<button type="button" class="file-label file-del " id="file-del<?= $i ?>" <?= $row44['report'] ==2? "disabled": ""; ?>>삭제</button>'
                        +'</td>'
                        +'</tr>';

            $('.file_table_all').append(html);
            $('.file_table_rater').append(html2);


            //클릭이벤트 unbind 
            $("#file-label-btn").unbind("click"); 

            //클릭이벤트 bind
            $("#file-label-btn").bind("click",function(){ 
                $('#upload0'+file_number).change(function(){
                    var fileValue = $(this).val().split("\\");
                    var fileName = fileValue[fileValue.length-1]; // 파일명
                    var fileSize = this.files[0].size;
                    var str ="";

                    //MB 단위 이상일때 MB 단위로 환산
                    if (fileSize >= 1024 * 1024) {
                        fileSize = fileSize / (1024 * 1024);
                        var convertlastpage = fileSize.toFixed(2);
                        str = convertlastpage + ' MB';
                    }

                    else {
                        fileSize = fileSize / 1024;
                        var convertlastpage = fileSize.toFixed(2);
                        str = convertlastpage + ' KB';
                    }

                    if($(this).val() != ""){
                    
                        $(this).prev().val(str);
                        $(this).parent().prev().prev().children().val(fileName);
                        $(this).after('<input type="hidden" name="file_type[]" value ="0" />');
                        $(this).attr('name' , 'bf_file[]');
                        $(this).parent().parent().addClass('file_list_check');
                        var html = '<tr class="input_form_info upload0'+file_number+'">'
                        +'    <th scope="col" class="view_table_header " colspan="1" style="width:10%; height: 58px;">첨부파일</th>'
                        +'    <td scope="col" class=" view_table_text view_table_padding " colspan="1" style="width:10%">'
                        +'       <img src="<?php echo G5_IMG_URL ?>/download_icon.png" alt="<?php echo $config['cf_title']; ?>">'
                        +'    </th>'
                        +'    <td scope="col" class=" view_table_text view_table_padding_name " colspan="7">'+ fileName+'</th>'
                        +'</tr>';


                        $('#view_table_upload').append(html);

                        file_number++;

                        // var html = '<div class="input-file"><input type="text" id="file_label'+file_number+'" ="" class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="파일명"/><input type="text" id="file-size-'+file_number+'" class="file-name file-size" value="용량" =""/><input type="file" name="bf_file[]" id="upload0'+file_number+'" class="file-upload" <?= $row44['report'] ==2? "disabled": ""; ?>/><button type="button" class="file-label file-del " id="file-del'+file_number+'" <?= $row44['report'] ==2? "disabled": ""; ?>style="background:<?= $row44['report'] ==2? '#ccc !important': 'crimson'; ?>">삭제</button></div>';
                        var html ='<tr class="input-file_list input-file_list_all">'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일명</th>'
                        +'<td scope="col" class=" view_table_text view_table_padding" colspan="1" style="width:40%">'
                        +'    <input type="text" id="file_label'+file_number+'" ="" class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="파일명"/>'
                        +'</td>'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 사이즈</th>'
                        +'<td scope="col" class=" view_table_text view_table_padding" colspan="2" style="width:20%">'
                        +'    <input type="text" id="file-size-'+file_number+'" class="file-name file-size" value="용량" =""/>'
                        +'    <input type="file" name="bf_file_null[]" id="upload0'+file_number+'" class="file-upload" <?= $row44['report'] ==2? "disabled": ""; ?>/>'
                        +'</td>'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 삭제</th>'
                        +'<td scope="col" class=" view_table_text view_table_padding" colspan="2" style="width:10%">'
                        +'<button type="button" class="file-label file-del " id="file-del'+file_number+'" <?= $row44['report'] ==2? "disabled": ""; ?>>삭제</button>'
                        +'</td>'
                        +'</tr>';

                        $('.file_table_all').append(html);

                        $("#file-label-btn").attr('for', 'upload0'+file_number);

                    }
                })

                
            })
            $("#file-label-btn1").bind("click",function(){ 
                $('#upload1_0'+file_number_rater).change(function(){
                    var fileValue = $(this).val().split("\\");
                    var fileName = fileValue[fileValue.length-1]; // 파일명
                    var fileSize = this.files[0].size;
                    var str ="";

                    //MB 단위 이상일때 MB 단위로 환산
                    if (fileSize >= 1024 * 1024) {
                        fileSize = fileSize / (1024 * 1024);
                        var convertlastpage = fileSize.toFixed(2);
                        str = convertlastpage + ' MB';
                    }

                    else {
                        fileSize = fileSize / 1024;
                        var convertlastpage = fileSize.toFixed(2);
                        str = convertlastpage + ' KB';
                    }

                    if($(this).val() != ""){
                    
                        $(this).prev().val(str);
                        $(this).parent().prev().prev().children().val(fileName);
                        $(this).after('<input type="hidden" name="file_type[]" value ="1" />');
                        $(this).attr('name' , 'bf_file[]');
                        $(this).parent().parent().addClass('file_list_check');

                        var html = '<tr class="input_form_info upload1_0'+file_number_rater+'">'
                        +'    <th scope="col" class="view_table_header " colspan="1" style="width:10%; height: 58px;">첨부파일</th>'
                        +'    <td scope="col" class=" view_table_text view_table_padding " colspan="1" style="width:10%">'
                        +'       <img src="<?php echo G5_IMG_URL ?>/download_icon.png" alt="<?php echo $config['cf_title']; ?>">'
                        +'    </th>'
                        +'    <td scope="col" class=" view_table_text view_table_padding_name " colspan="7">'+ fileName+'</th>'
                        +'</tr>';


                        $('#view_table_upload_rater').append(html);

                        file_number_rater++;

                        // var html = '<div class="input-file"><input type="text" id="file_label'+file_number+'" ="" class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="파일명"/><input type="text" id="file-size-'+file_number+'" class="file-name file-size" value="용량" =""/><input type="file" name="bf_file[]" id="upload0'+file_number+'" class="file-upload" <?= $row44['report'] ==2? "disabled": ""; ?>/><button type="button" class="file-label file-del " id="file-del'+file_number+'" <?= $row44['report'] ==2? "disabled": ""; ?>style="background:<?= $row44['report'] ==2? '#ccc !important': 'crimson'; ?>">삭제</button></div>';
                        var html ='<tr class="input-file_list">'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일명</th>'
                        +'<td scope="col" class=" view_table_text view_table_padding" colspan="1" style="width:40%">'
                        +'    <input type="text" id="file_label'+file_number_rater+'" ="" class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="파일명"/>'
                        +'</td>'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 사이즈</th>'
                        +'<td scope="col" class=" view_table_text view_table_padding" colspan="2" style="width:20%">'
                        +'    <input type="text" id="file-size-'+file_number_rater+'" class="file-name file-size" value="용량" =""/>'
                        +'    <input type="file" name="bf_file_null[]" id="upload1_0'+file_number_rater+'" class="file-upload" <?= $row44['report'] ==2? "disabled": ""; ?>/>'
                        +'</td>'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 삭제</th>'
                        +'<td scope="col" class=" view_table_text view_table_padding" colspan="2" style="width:10%">'
                        +'<button type="button" class="file-label file-del " id="file-del'+file_number_rater+'" <?= $row44['report'] ==2? "disabled": ""; ?>>삭제</button>'
                        +'</td>'
                        +'</tr>';
                        $('.file_table_rater').append(html);

                        $("#file-label-btn1").attr('for', 'upload1_0'+file_number_rater);

                    }
                })
            })


            $(document).off().on('click','.file-del',function(){
                var val = $(this).parent().find('.file-upload').prev().val();
                var file_id = $(this).parent().prev().prev().find('.file-upload').attr('id');
                // alert(val);
                var next = $(this).parent().parent().next('tr').val();
                var index_form = $(this).parent().parent().index('.input-file_list')+1;
                if(val != undefined){
                    $(this).parent().parent().remove();
                    $('.'+file_id+'').remove();
                    
                } else {
                    if(next == ""){
                        $(this).parent().parent().remove();
                        $('.'+file_id+'').remove();
                    } 
                }    
            })

            $(document).on("keydown", "input[type=file]", function(event) {
             event.key != "Enter";
        });

   
        $('.del-no-btn').click(function(){
                var check_val =  $(this).parent().prev().prev().find('input[type="checkbox"]').is(":checked");
                
                $(this).parent().parent().css({'display':'none'});
                $(this).parent().parent().removeClass('file_list_check');
        })
        })
    </script>
<?php } else if ($row['bo_title_idx'] == 2) { ?>
    <section id="bo_v" style="width:80%;">
        <h2 class="sound_only"><?php echo $g5['title'] ?></h2>
        <!-- 게시물 작성/수정 시작 { -->
        <form name="fwrite" id="fwrite" action="<?php echo $action_table_url; ?>" onsubmit=" fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" style="width:<?php echo $width; ?>">
        <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
        <input type="hidden" name="w" value="<?php echo $w ?>">
        <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
        <input type="hidden" name="wr_id" value="<?php echo $_GET['wr_id'] != "" ? $_GET['wr_id'] : $_POST['wr_id']; ?>">
        <input type="hidden" name="sca" value="<?php echo $sca ?>">
        <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
        <input type="hidden" name="stx" value="<?php echo $stx ?>">
        <input type="hidden" name="spt" value="<?php echo $spt ?>">
        <input type="hidden" name="sst" value="<?php echo $sst ?>">
        <input type="hidden" name="sod" value="<?php echo $sod ?>">
        <input type="hidden" name="page" value="<?php echo $page ?>">
        <input type="hidden" name="bo_idx" value="<?php echo $_GET['us_idx'] ?>">
        
            <div class="bo_w_tit write_div">
                <div id="bo_btn_top_app">
                    <h1 class="view_title"><?=  $category_title ?></h1>
                </div>
            </div>

            <table class="view_table_app">
                <thead>
                    <tr>
                        <th scope="col" class="view_table_header"colspan="1" style="width: 12%;">제목</th>
                        <td scope="col" class="view_table_title" colspan="8" style="width: 88%;">
                            <input type="text" name="title" id="title"  class="input_text  " placeholder="제목" value="<?= $row22['wr_subject']; ?>"  readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" style="width: 10%;">접수번호</th>
                        <td scope="col" class=" view_table_text " colspan="1" style="width: 40%;">
                        <input type="text" name="info_number" id="info_number"  class="input_text " placeholder="접수 완료시 자동부여됩니다."  value="<?= $row['info_number']; ?>" readonly >
                        </td>
                        <th scope="col" class="view_table_header" style="width: 10%;">과제번호</th>
                        <td scope="col" class=" view_table_text " colspan="6" style="width: 40%;">
                            <input type="text" name="quest_number" id="quest_number"  class="input_text " placeholder="선발 후 부여됩니다" value="<?= $row['quest_number']; ?>" readonly>
                        </td>
                    </tr>
                </thead>
                <tbody id="input_file_cont">
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">연구과제명</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1">과제명(국문)</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="8">
                        <input type="text" name="ko_title" id="ko_title"  class="input_text input_border_true" placeholder="과제명(국문)" value="<?= $row['ko_title']; ?>" >
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1">과제명(영문)</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="8">
                        <input type="text" name="en_title" id="en_title"  class="input_text input_border_true" placeholder="과제명(영문)" value="<?= $row['en_title']; ?>" >
                        </td>
                    </tr>
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">연구책임자</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1">성명</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="1">
                        <input type="text" name="name" id="name"  class="input_text input_border_true" placeholder="성명" value="<?= $row['name']; ?>" >
                        </td>
                        <th scope="col" class="view_table_header" colspan="1">전공(학위)</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="6">
                        <input type="text" name="degree" id="degree"  class="input_text input_border_true" placeholder="전공(학위)" value="<?= $row['degree']; ?>" >
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1">소속</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="1">
                        <input type="text" name="belong" id="belong"  class="input_text input_border_true" placeholder="소속" value="<?= $row['belong']; ?>" >
                        </td>
                        <th scope="col" class="view_table_header" colspan="1">직급</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="6">
                        <input type="text" name="rank" id="rank"  class="input_text input_border_true" placeholder="직급" value="<?= $row['rank']; ?>" >
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1">이메일</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="1">
                        <input type="text" name="email" id="email"  class="input_text input_border_true" placeholder="이메일" value="<?= $row['email']; ?>" >
                        </td>
                        <th scope="col" class="view_table_header" colspan="1">전화</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="6">
                        <input type="text" name="phone" id="phone"  class="input_text input_border_true" placeholder="전화" value="<?= $row['phone']; ?>" >
                        </td>
                    </tr>
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">연구참여자</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header">공동연구원<br>연구책임자 제외</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="1">
                        <input type="text" name="main_member" id="main_member"  class="input_text input_border_true" placeholder="명" value="<?= $row['main_member']; ?>" >
                        </td>
                        <th scope="col" class="view_table_header">연구원보조</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="6">
                        <input type="text" name="sub_member" id="sub_member"  class="input_text input_border_true" placeholder="명" value="<?= $row['sub_member']; ?>" >
                        </td>
                    </tr>
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">연구정보</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1">연구비신청액</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="8">
                        <input type="text" name="money" id="money"  class="input_text input_border_true" placeholder="연구비신청액" value="<?= $row['money']; ?>" >
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1">1차년 연구비</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="1" style=" width:40%">
                        <input type="text" name="one_year" id="one_year"  class="input_text input_border_true" placeholder="1차년 연구비" value="<?= $row['one_year']; ?>" >
                        </td>
                        <th scope="col" class="view_table_header" colspan="1">2차년 연구비</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="6">
                            <input type="text" name="two_year" id="two_year"  class="input_text input_border_true" placeholder="2차년 연구비" value="<?= $row['two_year']; ?>" >
                        </td>
                    </tr>
                    
                </tbody>
                <tbody class="file_table_all">
                    <tr class="view_table_header_table"></tr>
                    <tr class="all_user_file">
                        <th scope="col" class="view_table_header " colspan="9">자료 첨부</th>
                    </tr>
                    <?php 
                        $sql2 = " select * from g5_board_file where bo_table = 'g5_business_propos' and wr_id = '{$row['idx']}' and bf_user_type = 0";
                        $result2 = sql_query($sql2);    

                        // 가변 파일
                            for ($i=0; $row_list2 = sql_fetch_array($result2); $i++) {
                                if (isset($row_list2['bf_source'][$i])) {
                        ?>
                                <tr class="input-file_list file_list_check">
                                    <?php
                                        //MB 단위 이상일때 MB 단위로 환산
                                        if ($row_list2['bf_filesize'] >= 1024 * 1024) {
                                            $fileSize = $row_list2['bf_filesize'] / (1024 * 1024);
                                            $convertlastpage = sprintf('%0.2f', $fileSize); // 520 -> 520.00
                                            $str = $convertlastpage . ' MB';
                                        }
                            
                                        else {
                                            $fileSize = $row_list2['bf_filesize'] / 1024;
                                            $convertlastpage = sprintf('%0.2f', $fileSize); // 520 -> 520.00
                                            $str = $convertlastpage . ' KB';
                                        }
                                    ?>
                                    <th scope="col" class="view_table_header" colspan="1" style="width:10%">파일명</th>
                                    <td scope="col" class=" view_table_text view_table_padding" colspan="1" style="width:40%">
                                    <input type="text" id="file_label1"  class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="<?= $row_list2['bf_source']; ?>" style="margin: 0 -2px;" readonly/>
                                    </td>
                                    <th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 사이즈</th>
                                    <td scope="col" class=" view_table_text view_table_padding" colspan="2" style="width:20%">
                                        <input type="hidden" value="<?= $row_list2['bo_table']; ?>" class="sql_file_tabel">
                                        <input type="hidden" value="<?= $row_list2['wr_id']; ?>" class="sql_file_id">
                                        <input type="hidden" value="<?= $row_list2['bf_no']; ?>" class="sql_file_no">
                                        <input type="text" id="file-size-'+file_number+'" class="file-name file-size" style="margin: 0 -2px;" value="<?= $str ?>" readonly/>
                                        <input type="file" name="bf_file[]" id="upload00" value="<?= $row_list2['bf_no']; ?>" class="file-upload file_sql_upload" <?= $row44['report'] ==2? "disabled": ""; ?> />
                                        <input type="checkbox" class="del-no" id="del-no<?= $i ?>" name="del-no[]" value="<?= $row_list2['bf_no']; ?>" style="display:none;">
                                        <input type="hidden" name="file_type[]" value ="0" />
                                    </td>
                                    <th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 삭제</th>
                                    <td scope="col" class=" view_table_text view_table_padding" colspan="2" style="width:10%">
                                        <label for="del-no<?= $i ?>" class="file-label del-no-btn">삭제</label>
                                    </td>
                                </tr>
                                <?php
                                }
                            }
                        ?>
                </tbody>
                <tbody class="file_table_rater">
                    <tr class="view_table_header_table file_list_check"></tr>
                    <tr class="rater_user_file">
                        <th scope="col" class="view_table_header " colspan="9">심사자용 자료 첨부(인적사항 무기입)</th>
                        
                    </tr>
                    <?php 
                        $sql2 = " select * from g5_board_file where bo_table = 'g5_business_propos' and wr_id = '{$row['idx']}' and bf_user_type = 1";
                        $result2 = sql_query($sql2);    

                        // 가변 파일
                            for ($i=0; $row_list2 = sql_fetch_array($result2); $i++) {
                                if (isset($row_list2['bf_source'][$i])) {
                        ?>
                                <tr class="input-file_list file_list_check">
                                    <?php
                                        //MB 단위 이상일때 MB 단위로 환산
                                        if ($row_list2['bf_filesize'] >= 1024 * 1024) {
                                            $fileSize = $row_list2['bf_filesize'] / (1024 * 1024);
                                            $convertlastpage = sprintf('%0.2f', $fileSize); // 520 -> 520.00
                                            $str = $convertlastpage . ' MB';
                                        }
                            
                                        else {
                                            $fileSize = $row_list2['bf_filesize'] / 1024;
                                            $convertlastpage = sprintf('%0.2f', $fileSize); // 520 -> 520.00
                                            $str = $convertlastpage . ' KB';
                                        }
                                    ?>
                                    <th scope="col" class="view_table_header" colspan="1" style="width:10%">파일명</th>
                                    <td scope="col" class=" view_table_text view_table_padding" colspan="1" style="width:40%">
                                    <input type="text" id="file_label1"  class="file-name file-server-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="<?= $row_list2['bf_source']; ?>" style="margin: 0 -2px;" readonly/>
                                    </td>
                                    <th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 사이즈</th>
                                    <td scope="col" class=" view_table_text view_table_padding" colspan="2" style="width:20%">
                                        <input type="hidden" value="<?= $row_list2['bo_table']; ?>" class="sql_file_tabel">
                                        <input type="hidden" value="<?= $row_list2['wr_id']; ?>" class="sql_file_id">
                                        <input type="hidden" value="<?= $row_list2['bf_no']; ?>" class="sql_file_no">
                                        <input type="text" id="file-size-'+file_number+'" class="file-name file-size" style="margin: 0 -2px;" value="<?= $str ?>" readonly/>
                                        <input type="file" name="bf_file[]" id="upload00" value="<?= $row_list2['bf_no']; ?>" class="file-upload file_sql_upload" <?= $row44['report'] ==2? "disabled": ""; ?> />
                                        <input type="checkbox" class="del-no" id="del-no-<?= $i ?>" name="del-no[]" value="<?= $row_list2['bf_no']; ?>" style="display:none">
                                        <input type="hidden" name="file_type[]" value ="1" />
                                    </td>
                                    <th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 삭제</th>
                                    <td scope="col" class=" view_table_text view_table_padding" colspan="2" style="width:10%">
                                        <label for="del-no-<?= $i ?>" class="file-label del-no-btn">삭제</label>
                                    </td>
                                </tr>
                                <?php
                                }
                            }
                        ?>
                </tbody>
            </table>

            <div class="btn_confirm write_div btn-cont">
                <label for="upload01" id="file-label-btn" class="file-label file-label-btn"><img src="<?= G5_IMG_URL ?>/upload.png" alt=""> 파일 업로드</label>
                <label for="upload1_01" id="file-label-btn1" class="file-label file-label-btn"><img src="<?= G5_IMG_URL ?>/upload.png" alt=""> 심사자용 업로드</label>

                <a href="<?= G5_BBS_URL ?>/board.value.php?bo_table=business&bo_idx=<?= $_GET['bo_idx'] ?>" class=" btn_color_white">취소</a>
                <button type="submit" class="btn_next_prv btn_next_prv_link btn-update">수정</button>
                
            </div>
        </form>
    </section>

    <script>
        $(function(){
            $('.btn-update').click(function(){
                // validation
                if($('#ko_title').val() == "")  {alert("국문 과제명이 비어있습니다"); return false;}
                if($('#en_title').val() == "") { alert("영문 과제명이 비어있습니다"); return false;}
                if($('#name').val() == "")  {alert("성명이 비어있습니다"); return false;}
                if($('#degree').val() == "")  {alert("전공(학위)이 비어있습니다"); return false;}
                if($('#belong').val() == "") { alert("소속이 비어있습니다"); return false;}
                if($('#rank').val() == "")  {alert("직급이 비어있습니다"); return false;}
                if($('#email').val() == "")  {alert("이메일이 비어있습니다"); return false;}
                if($('#phone').val() == "") { alert("전화번호가 비어있습니다"); return false;}
                if($('#main_member').val() == "")  {alert("공동연구원이 비어있습니다"); return false;}
                if($('#sub_member').val() == "") { alert("연구원보조가 비어있습니다"); return false;}
                if($('#one_year').val() == "")  {alert("1차년 연구비가 비어있습니다"); return false;}
                if($('#two_year').val() == ""){  alert("2차년 연구비가 비어있습니다"); return false;}
                
                if($('.file_table_all .file_list_check').length == 0)  {alert('파일을 업로드 하세요.'); return false;}
                if($('.file_table_rater .file_list_check').length == 0) { alert('심사자용 파일을 업로드 하세요.'); return false;}

                //정규식 설정
                var fncTest = /^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]+(\.[a-zA-Z]{2,3}){1,4}$/i;
                //정규식 결과 저장
                var emailResult = fncTest.test( $("#email").val() );
                if(!emailResult)  {alert("E-mail 주소가 형식에 맞지 않습니다."); return false;}

                //정규식 설정
                var regex= /^[0-9]+$/;
                //정규식 결과 저장
                var phoneResult = regex.test( $("#phone").val() );
                if(!phoneResult) { alert("전화번호에 숫자만 입력해주세요"); return false;}
                var main_memberResult = regex.test( $("#main_member").val() );

                if(!main_memberResult) { alert("공동연구원에 숫자만 입력해주세요"); return false;}
                
                var sub_memberResult = regex.test($("#sub_member").val());
                if(!sub_memberResult) { alert("연구원보조에 숫자만 입력해주세요"); return false;}

                var moneyResult = regex.test( $("#money").val());
                if(!moneyResult){  alert("연구비신청액에 숫자만 입력해주세요"); return false;}

                var one_yearResult = regex.test( $("#one_year").val());
                if(!one_yearResult)  {alert("1차년 연구비에 숫자만 입력해주세요"); return false;}

                var two_yearResult = regex.test( $("#two_year").val());
                if(!two_yearResult) { alert("2차년 연구비에 숫자만 입력해주세요"); return false;}


                    
            })
                
            $('#one_year').change(function(){
                money_sum = Number($(this).val()) + Number($('#two_year').val());
                $('#money').val(money_sum);
            });
            $('#two_year').change(function(){
                money_sum = Number($(this).val()) + Number($('#one_year').val());
                $('#money').val(money_sum);
            });
            
            var file_number = 1;
            var file_number_rater = 1;

            var html = '<tr class="input-file_list ">'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일명</th>'
                        +'<td scope="col" class=" view_table_text view_table_padding" colspan="1" style="width:40%">'
                        +'    <input type="text" style="margin: 0 -2px;" id="file_label1" ="" class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="파일명" readonly/> '
                        +'</td>'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 사이즈</th>'
                        +'<td scope="col" class=" view_table_text view_table_padding" colspan="2" style="width:20%">'
                        +'    <input type="text" id="file-size-'+file_number+'" class="file-name file-size" style="margin: 0 -2px;" value="용량" ="" readonly/>'
                        +'    <input type="file" name="bf_file_null[]" id="upload01" class="file-upload" <?= $row44['report'] ==2? "disabled": ""; ?> />'
                        +'</td>'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 삭제</th>'
                        +'<td scope="col" class=" view_table_text view_table_padding" colspan="2" style="width:10%">'
                        +'<button type="button" class="file-label file-del " id="file-del<?= $i ?>" <?= $row44['report'] ==2? "disabled": ""; ?>>삭제</button>'
                        +'</td>'
                        +'</tr>';


            var html2 = '<tr class="input-file_list ">'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일명</th>'
                        +'<td scope="col" class=" view_table_text view_table_padding" colspan="1" style="width:40%">'
                        +'    <input type="text" style="margin: 0 -2px;" id="file_label1" ="" class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="파일명" readonly/> '
                        +'</td>'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 사이즈</th>'
                        +'<td scope="col" class=" view_table_text view_table_padding" colspan="2" style="width:20%">'
                        +'    <input type="text" id="file-size-'+file_number_rater+'" class="file-name file-size" style="margin: 0 -2px;" value="용량" ="" readonly/>'
                        +'    <input type="file" name="bf_file_null[]" id="upload1_01" class="file-upload" <?= $row44['report'] ==2? "disabled": ""; ?> />'
                        +'</td>'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 삭제</th>'
                        +'<td scope="col" class=" view_table_text view_table_padding" colspan="2" style="width:10%">'
                        +'<button type="button" class="file-label file-del " id="file-del<?= $i ?>" <?= $row44['report'] ==2? "disabled": ""; ?>>삭제</button>'
                        +'</td>'
                        +'</tr>';

            $('.file_table_all').append(html);
            $('.file_table_rater').append(html2);


            //클릭이벤트 unbind 
            $("#file-label-btn").unbind("click"); 

            //클릭이벤트 bind
            $("#file-label-btn").bind("click",function(){ 
                $('#upload0'+file_number).change(function(){
                    var fileValue = $(this).val().split("\\");
                    var fileName = fileValue[fileValue.length-1]; // 파일명
                    var fileSize = this.files[0].size;
                    var str ="";

                    //MB 단위 이상일때 MB 단위로 환산
                    if (fileSize >= 1024 * 1024) {
                        fileSize = fileSize / (1024 * 1024);
                        var convertlastpage = fileSize.toFixed(2);
                        str = convertlastpage + ' MB';
                    }

                    else {
                        fileSize = fileSize / 1024;
                        var convertlastpage = fileSize.toFixed(2);
                        str = convertlastpage + ' KB';
                    }

                    if($(this).val() != ""){
                    
                        $(this).prev().val(str);
                        $(this).parent().prev().prev().children().val(fileName);
                        $(this).after('<input type="hidden" name="file_type[]" value ="0" />');
                        $(this).attr('name' , 'bf_file[]');
                        $(this).parent().parent().addClass('file_list_check');

                        var html = '<tr class="input_form_info upload0'+file_number+'">'
                        +'    <th scope="col" class="view_table_header " colspan="1" style="width:10%; height: 58px;">첨부파일</th>'
                        +'    <td scope="col" class=" view_table_text view_table_padding " colspan="1" style="width:10%">'
                        +'       <img src="<?php echo G5_IMG_URL ?>/download_icon.png" alt="<?php echo $config['cf_title']; ?>">'
                        +'    </th>'
                        +'    <td scope="col" class=" view_table_text view_table_padding_name " colspan="7">'+ fileName+'</th>'
                        +'</tr>';


                        $('#view_table_upload').append(html);

                        file_number++;

                        // var html = '<div class="input-file"><input type="text" id="file_label'+file_number+'" ="" class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="파일명"/><input type="text" id="file-size-'+file_number+'" class="file-name file-size" value="용량" =""/><input type="file" name="bf_file[]" id="upload0'+file_number+'" class="file-upload" <?= $row44['report'] ==2? "disabled": ""; ?>/><button type="button" class="file-label file-del " id="file-del'+file_number+'" <?= $row44['report'] ==2? "disabled": ""; ?>style="background:<?= $row44['report'] ==2? '#ccc !important': 'crimson'; ?>">삭제</button></div>';
                        var html ='<tr class="input-file_list input-file_list_all">'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일명</th>'
                        +'<td scope="col" class=" view_table_text view_table_padding" colspan="1" style="width:40%">'
                        +'    <input type="text" id="file_label'+file_number+'" ="" class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="파일명"/>'
                        +'</td>'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 사이즈</th>'
                        +'<td scope="col" class=" view_table_text view_table_padding" colspan="2" style="width:20%">'
                        +'    <input type="text" id="file-size-'+file_number+'" class="file-name file-size" value="용량" =""/>'
                        +'    <input type="file" name="bf_file_null[]" id="upload0'+file_number+'" class="file-upload" <?= $row44['report'] ==2? "disabled": ""; ?>/>'
                        +'</td>'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 삭제</th>'
                        +'<td scope="col" class=" view_table_text view_table_padding" colspan="2" style="width:10%">'
                        +'<button type="button" class="file-label file-del " id="file-del'+file_number+'" <?= $row44['report'] ==2? "disabled": ""; ?>>삭제</button>'
                        +'</td>'
                        +'</tr>';

                        $('.file_table_all').append(html);

                        $("#file-label-btn").attr('for', 'upload0'+file_number);

                    }
                })

                
            })
            $("#file-label-btn1").bind("click",function(){ 
                $('#upload1_0'+file_number_rater).change(function(){
                    var fileValue = $(this).val().split("\\");
                    var fileName = fileValue[fileValue.length-1]; // 파일명
                    var fileSize = this.files[0].size;
                    var str ="";

                    //MB 단위 이상일때 MB 단위로 환산
                    if (fileSize >= 1024 * 1024) {
                        fileSize = fileSize / (1024 * 1024);
                        var convertlastpage = fileSize.toFixed(2);
                        str = convertlastpage + ' MB';
                    }

                    else {
                        fileSize = fileSize / 1024;
                        var convertlastpage = fileSize.toFixed(2);
                        str = convertlastpage + ' KB';
                    }

                    if($(this).val() != ""){
                    
                        $(this).prev().val(str);
                        $(this).parent().prev().prev().children().val(fileName);
                        $(this).after('<input type="hidden" name="file_type[]" value ="1" />');
                        $(this).attr('name' , 'bf_file[]');
                        $(this).parent().parent().addClass('file_list_check');

                        var html = '<tr class="input_form_info upload1_0'+file_number_rater+'">'
                        +'    <th scope="col" class="view_table_header " colspan="1" style="width:10%; height: 58px;">첨부파일</th>'
                        +'    <td scope="col" class=" view_table_text view_table_padding " colspan="1" style="width:10%">'
                        +'       <img src="<?php echo G5_IMG_URL ?>/download_icon.png" alt="<?php echo $config['cf_title']; ?>">'
                        +'    </th>'
                        +'    <td scope="col" class=" view_table_text view_table_padding_name " colspan="7">'+ fileName+'</th>'
                        +'</tr>';


                        $('#view_table_upload_rater').append(html);

                        file_number_rater++;

                        // var html = '<div class="input-file"><input type="text" id="file_label'+file_number+'" ="" class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="파일명"/><input type="text" id="file-size-'+file_number+'" class="file-name file-size" value="용량" =""/><input type="file" name="bf_file[]" id="upload0'+file_number+'" class="file-upload" <?= $row44['report'] ==2? "disabled": ""; ?>/><button type="button" class="file-label file-del " id="file-del'+file_number+'" <?= $row44['report'] ==2? "disabled": ""; ?>style="background:<?= $row44['report'] ==2? '#ccc !important': 'crimson'; ?>">삭제</button></div>';
                        var html ='<tr class="input-file_list">'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일명</th>'
                        +'<td scope="col" class=" view_table_text view_table_padding" colspan="1" style="width:40%">'
                        +'    <input type="text" id="file_label'+file_number_rater+'" ="" class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="파일명"/>'
                        +'</td>'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 사이즈</th>'
                        +'<td scope="col" class=" view_table_text view_table_padding" colspan="2" style="width:20%">'
                        +'    <input type="text" id="file-size-'+file_number_rater+'" class="file-name file-size" value="용량" =""/>'
                        +'    <input type="file" name="bf_file_null[]" id="upload1_0'+file_number_rater+'" class="file-upload" <?= $row44['report'] ==2? "disabled": ""; ?>/>'
                        +'</td>'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 삭제</th>'
                        +'<td scope="col" class=" view_table_text view_table_padding" colspan="2" style="width:10%">'
                        +'<button type="button" class="file-label file-del " id="file-del'+file_number_rater+'" <?= $row44['report'] ==2? "disabled": ""; ?>>삭제</button>'
                        +'</td>'
                        +'</tr>';
                        $('.file_table_rater').append(html);

                        $("#file-label-btn1").attr('for', 'upload1_0'+file_number_rater);

                    }
                })
            })


            $(document).off().on('click','.file-del',function(){
                var val = $(this).parent().find('.file-upload').prev().val();
                var file_id = $(this).parent().prev().prev().find('.file-upload').attr('id');
                // alert(val);
                var next = $(this).parent().parent().next('tr').val();
                var index_form = $(this).parent().parent().index('.input-file_list')+1;
                if(val != undefined){
                    $(this).parent().parent().remove();
                    $('.'+file_id+'').remove();
                    
                } else {
                    if(next == ""){
                        $(this).parent().parent().remove();
                        $('.'+file_id+'').remove();
                    } 
                }    
            })

            $(document).on("keydown", "input[type=file]", function(event) {
             event.key != "Enter";
        });

   
        $('.del-no-btn').click(function(){
                var check_val =  $(this).parent().prev().prev().find('input[type="checkbox"]').is(":checked");
                
                $(this).parent().parent().css({'display':'none'});
                $(this).parent().parent().removeClass('file_list_check');

        })
        })
    </script>
<?php } else if ($row['bo_title_idx'] == 3) { ?>
    <section id="bo_v" style="width:80%;">
        <h2 class="sound_only"><?php echo $g5['title'] ?></h2>
        <!-- 게시물 작성/수정 시작 { -->
        <form name="fwrite" id="fwrite" action="<?php echo $action_table_url; ?>" onsubmit=" fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" style="width:<?php echo $width; ?>">
        <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
        <input type="hidden" name="w" value="<?php echo $w ?>">
        <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
        <input type="hidden" name="wr_id" value="<?php echo $_GET['wr_id'] != "" ? $_GET['wr_id'] : $_POST['wr_id']; ?>">
        <input type="hidden" name="sca" value="<?php echo $sca ?>">
        <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
        <input type="hidden" name="stx" value="<?php echo $stx ?>">
        <input type="hidden" name="spt" value="<?php echo $spt ?>">
        <input type="hidden" name="sst" value="<?php echo $sst ?>">
        <input type="hidden" name="sod" value="<?php echo $sod ?>">
        <input type="hidden" name="page" value="<?php echo $page ?>">
        <input type="hidden" name="bo_idx" value="<?php echo $_GET['us_idx'] ?>">
        
            <div class="bo_w_tit write_div">
                <div id="bo_btn_top_app">
                    <h1 class="view_title"><?=  $category_title ?></h1>
                </div>
            </div>



            <table class="view_table_app">
                <thead>
                    <tr>
                        <th scope="col" class="view_table_header"colspan="1" style="width: 10%;">제목</th>
                        <td scope="col" class="view_table_title" colspan="8" style="width: 90%;">
                            <input type="text" name="title" id="title"  class="input_text  " placeholder="제목" value="<?= $row22['wr_subject']; ?>"  readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" style="width: 10%;">접수번호</th>
                        <td scope="col" class=" view_table_text " colspan="2" style="width: 40%;">
                        <input type="text" name="info_number" id="info_number"  class="input_text " placeholder="접수 완료시 자동부여됩니다." value="<?= $row['info_number']; ?>"  readonly>
                        </td>
                        <th scope="col" class="view_table_header" style="width: 10%;">과제번호</th>
                        <td scope="col" class=" view_table_text " colspan="5" style="width: 40%;">
                        <input type="text" name="quest_number" id="quest_number"  class="input_text " placeholder="선발 후 부여됩니다" value="<?= $row['quest_number']; ?>"readonly >
                        </td>
                    </tr>
                </thead>
                <tbody id="input_file_cont">
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">연구과제명</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1">과제명(국문)</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="8">
                        <input type="text" name="ko_title" id="ko_title"  class="input_text input_border_true" placeholder="과제명(국문)" value="<?= $row['ko_title']; ?>" >
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1">과제명(영문)</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="8">
                        <input type="text" name="en_title" id="en_title"  class="input_text input_border_true" placeholder="과제명(영문)" value="<?= $row['en_title']; ?>" >
                        </td>
                    </tr>
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">집단회 개최</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header">소속 기관</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="8">
                        <input type="text" name="meeting_agency" id="meeting_agency"  class="input_text input_border_true" placeholder="" value="<?= $row['meeting_agency']; ?>" >
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header">개최장소</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="2">
                        <input type="text" name="meeting_venue" id="meeting_venue"  class="input_text input_border_true" placeholder="" value="<?= $row['meeting_venue']; ?>" >
                        </td>
                        <th scope="col" class="view_table_header">집담회 규모(인원)</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="5">
                        <input type="text" name="meeting_scale" id="meeting_scale"  class="input_text input_border_true" placeholder="명" value="<?= $row['meeting_scale']; ?>" >
                        </td>
                    </tr>
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">책임자현황</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1">성명</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="2">
                        <input type="text" name="normal_manager_name" id="normal_manager_name"  class="input_text input_border_true" placeholder="성명" value="<?= $row['normal_manager_name']; ?>" >
                        </td>
                        <th scope="col" class="view_table_header" colspan="1">전공(학위)</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="5">
                        <input type="text" name="normal_manager_degree" id="normal_manager_degree"  class="input_text input_border_true" placeholder="전공(학위)" value="<?= $row['normal_manager_degree']; ?>" >
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1">소속</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="2">
                        <input type="text" name="normal_manager_belong" id="normal_manager_belong"  class="input_text input_border_true" placeholder="소속" value="<?= $row['normal_manager_belong']; ?>" >
                        </td>
                        <th scope="col" class="view_table_header" colspan="1">직급</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="5">
                        <input type="text" name="normal_manager_rank" id="normal_manager_rank"  class="input_text input_border_true" placeholder="직급" value="<?= $row['normal_manager_rank']; ?>" >
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1">이메일</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="2">
                        <input type="text" name="normal_manager_email" id="normal_manager_email"  class="input_text input_border_true" placeholder="이메일" value="<?= $row['normal_manager_email']; ?>" >
                        </td>
                        <th scope="col" class="view_table_header" colspan="1">전화</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="5">
                        <input type="text" name="normal_manager_phone" id="normal_manager_phone"  class="input_text input_border_true" placeholder="전화" value="<?= $row['normal_manager_phone']; ?>" >
                        </td>
                    </tr>
                
                    
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">소속기관 현황</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1"style="">소속기관</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="8">
                            <input type="text" name="belong_agency" id="belong_agency" placeholder=""  class="input_text input_border_true"  value="<?= $row['belong_agency']; ?>" >
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="col" class="view_table_header" rowspan="3"style="">소속기관</th>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%">성명</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="1">
                        <input type="text" name="agency_name" id="agency_name"  class="input_text input_border_true" placeholder="성명" value="<?= $row['agency_name']; ?>" >
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%">전공(학위)</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="6">
                        <input type="text" name="agency_degree" id="agency_degree"  class="input_text input_border_true" placeholder="전공(학위)" value="<?= $row['agency_degree']; ?>" >
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%">소속</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="1">
                        <input type="text" name="agency_belong" id="agency_belong"  class="input_text input_border_true" placeholder="소속" value="<?= $row['agency_belong']; ?>" >
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%">직급</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="6">
                        <input type="text" name="agency_rank" id="agency_rank"  class="input_text input_border_true" placeholder="직급" value="<?= $row['agency_rank']; ?>" >
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%">이메일</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="1">
                        <input type="text" name="agency_email" id="agency_email"  class="input_text input_border_true" placeholder="이메일" value="<?= $row['agency_email']; ?>" >
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%">전화</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="6">
                        <input type="text" name="agency_phone" id="agency_phone"  class="input_text input_border_true" placeholder="전화" value="<?= $row['agency_phone']; ?>" >
                        </td>
                    </tr>
                    
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">연구정보</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1">연구비신청액</th>
                        <td scope="col" class=" view_table_text view_table_padding " colspan="7">
                            <input type="text" name="money" id="money"  class="input_text input_border_true  money" placeholder="숫자만 기재 (원)" value="<?= $row['money']; ?>" >
                        </td>
                    </tr>

                   
                </tbody>
                <tbody class="file_table_all">
                    <tr class="view_table_header_table"></tr>
                    <tr class="all_user_file">
                        <th scope="col" class="view_table_header " colspan="9">자료 첨부</th>
                    </tr>
                    <?php 
                        $sql2 = " select * from g5_board_file where bo_table = 'g5_business_propos' and wr_id = '{$row['idx']}' and bf_user_type = 0";
                        $result2 = sql_query($sql2);    

                        // 가변 파일
                            for ($i=0; $row_list2 = sql_fetch_array($result2); $i++) {
                                if (isset($row_list2['bf_source'][$i])) {
                        ?>
                                <tr class="input-file_list file_list_check">
                                    <?php
                                        //MB 단위 이상일때 MB 단위로 환산
                                        if ($row_list2['bf_filesize'] >= 1024 * 1024) {
                                            $fileSize = $row_list2['bf_filesize'] / (1024 * 1024);
                                            $convertlastpage = sprintf('%0.2f', $fileSize); // 520 -> 520.00
                                            $str = $convertlastpage . ' MB';
                                        }
                            
                                        else {
                                            $fileSize = $row_list2['bf_filesize'] / 1024;
                                            $convertlastpage = sprintf('%0.2f', $fileSize); // 520 -> 520.00
                                            $str = $convertlastpage . ' KB';
                                        }
                                    ?>
                                    <th scope="col" class="view_table_header" colspan="1" style="width:10%">파일명</th>
                                    <td scope="col" class=" view_table_text view_table_padding" colspan="2" style="width:40%">
                                    <input type="text" id="file_label1"  class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="<?= $row_list2['bf_source']; ?>" style="margin: 0 -2px;" readonly/>
                                    </td>
                                    <th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 사이즈</th>
                                    <td scope="col" class=" view_table_text view_table_padding" colspan="2" style="width:20%">
                                        <input type="hidden" value="<?= $row_list2['bo_table']; ?>" class="sql_file_tabel">
                                        <input type="hidden" value="<?= $row_list2['wr_id']; ?>" class="sql_file_id">
                                        <input type="hidden" value="<?= $row_list2['bf_no']; ?>" class="sql_file_no">
                                        <input type="text" id="file-size-'+file_number+'" class="file-name file-size" style="margin: 0 -2px;" value="<?= $str ?>" readonly/>
                                        <input type="file" name="bf_file[]" id="upload00" value="<?= $row_list2['bf_no']; ?>" class="file-upload file_sql_upload" <?= $row44['report'] ==2? "disabled": ""; ?> />
                                        <input type="checkbox" class="del-no" id="del-no<?= $i ?>" name="del-no[]" value="<?= $row_list2['bf_no']; ?>" style="display:none;">
                                        <input type="hidden" name="file_type[]" value ="0" />
                                    </td>
                                    <th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 삭제</th>
                                    <td scope="col" class=" view_table_text view_table_padding" colspan="1" style="width:10%">
                                        <label for="del-no<?= $i ?>" class="file-label del-no-btn">삭제</label>
                                    </td>
                                </tr>
                                <?php
                                }
                            }
                        ?>
                </tbody>
            </table>

            <div class="btn_confirm write_div btn-cont">
                <label for="upload01" id="file-label-btn" class="file-label file-label-btn"><img src="<?= G5_IMG_URL ?>/upload.png" alt=""> 파일 업로드</label>

                <a href="<?= G5_BBS_URL ?>/board.value.php?bo_table=business&bo_idx=<?= $_GET['bo_idx'] ?>" class=" btn_color_white">취소</a>
                <button type="submit" class="btn_next_prv btn_next_prv_link btn-update">수정</button>
            </div>
        </form>
    </section>
    <script>
        $(function(){
            $('.btn-update').click(function(){
                // validation
                if($('#ko_title').val() == "") { alert("국문 과제명이 비어있습니다"); return false;}
                if($('#en_title').val() == "") { alert("영문 과제명이 비어있습니다"); return false;}

                if($('#meeting_agency').val() == "") { alert("소속기관이 비어있습니다"); return false;}
                if($('#meeting_venue').val() == "")  {alert("개최장소가 비어있습니다"); return false;}
                if($('#meeting_scale').val() == "")  {alert("집담회 규모(인원)가 비어있습니다"); return false;}

                if($('#normal_manager_name').val() == "") { alert("책임자 성명이 비어있습니다"); return false;}
                if($('#normal_manager_degree').val() == "") { alert("책임자 전공이 비어있습니다"); return false;}
                if($('#normal_manager_belong').val() == "") { alert("책임자 소속이 비어있습니다"); return false;}
                if($('#normal_manager_rank').val() == "")  {alert("책임자 직급이 비어있습니다"); return false;}
                if($('#normal_manager_email').val() == "")  {alert("책임자 이메일이 비어있습니다"); return false;}
                if($('#normal_manager_phone').val() == "")  {alert("책임자 전화번호가 비어있습니다"); return false;}
                
                if($('#belong_agency').val() == "")  {alert("소속기관이 비어있습니다"); return false;}
                if($('#agency_name').val() == "")  {alert("기관 책임자 성명이 비어있습니다"); return false;}
                if($('#agency_degree').val() == "")  {alert("기관 책임자 전공이 비어있습니다"); return false;}
                if($('#agency_belong').val() == "")  {alert("기관 책임자 소속이 비어있습니다"); return false;}
                if($('#agency_rank').val() == "")  {alert("기관 책임자 직급이 비어있습니다"); return false;}
                if($('#agency_email').val() == "")  {alert("기관 책임자 이메일이 비어있습니다"); return false;}
                if($('#agency_phone').val() == "")  {alert("기관 책임자 전화번호가 비어있습니다"); return false; } 
                if($('#money').val() == "")  {alert("연구비신청액이 비어있습니다"); return false;}
                if($('.file_table_all .file_list_check').length == 0) { alert('파일을 업로드 하세요.'); return false;}
                

                //정규식 설정
                var fncTest = /^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]+(\.[a-zA-Z]{2,3}){1,4}$/i;
                var regex= /^[0-9]+$/;

                //정규식 결과 저장
                var meeting_scale = regex.test( $("#meeting_scale").val());
                var normal_manager_email = fncTest.test( $("#normal_manager_email").val());
                var normal_manager_phone = regex.test( $("#normal_manager_phone").val() );

                if(!meeting_scale) { alert("집담회 규모(인원)에 숫자만 입력해주세요."); return false;}
                if(!normal_manager_email) { alert("E-mail 주소가 형식에 맞지 않습니다."); return false;}
                if(!normal_manager_phone) { alert("전화번호에 숫자만 입력해주세요"); return false;}

                //정규식 결과 저장
                var money = regex.test( $("#money").val());
                var agency_phone = regex.test( $("#agency_phone").val()); 
                var agency_email = fncTest.test( $("#agency_email").val() ); 

                if(!agency_email){  alert("E-mail 주소가 형식에 맞지 않습니다."); return false;}
                if(!agency_phone) { alert("소속기관 책임자 전화번호에 숫자만 입력해주세요"); return false;}
                if(!money) { alert("연구비신청액에 숫자만 입력해주세요"); return false;}
                    


                    
            })
                

            
            var file_number = 1;
            var file_number_rater = 1;

            var html = '<tr class="input-file_list ">'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일명</th>'
                        +'<td scope="col" class=" view_table_text view_table_padding" colspan="2" style="width:40%">'
                        +'    <input type="text" style="margin: 0 -2px;" id="file_label1" ="" class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="파일명" readonly/> '
                        +'</td>'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 사이즈</th>'
                        +'<td scope="col" class=" view_table_text view_table_padding" colspan="2" style="width:20%">'
                        +'    <input type="text" id="file-size-'+file_number+'" class="file-name file-size" style="margin: 0 -2px;" value="용량" ="" readonly/>'
                        +'    <input type="file" name="bf_file_null[]" id="upload01" class="file-upload" <?= $row44['report'] ==2? "disabled": ""; ?> />'
                        +'</td>'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 삭제</th>'
                        +'<td scope="col" class=" view_table_text view_table_padding" colspan="1" style="width:10%">'
                        +'<button type="button" class="file-label file-del " id="file-del<?= $i ?>" <?= $row44['report'] ==2? "disabled": ""; ?>>삭제</button>'
                        +'</td>'
                        +'</tr>';

            $('.file_table_all').append(html);


            //클릭이벤트 unbind 
            $("#file-label-btn").unbind("click"); 

            //클릭이벤트 bind
            $("#file-label-btn").bind("click",function(){ 
                $('#upload0'+file_number).change(function(){
                    var fileValue = $(this).val().split("\\");
                    var fileName = fileValue[fileValue.length-1]; // 파일명
                    var fileSize = this.files[0].size;
                    var str ="";

                    //MB 단위 이상일때 MB 단위로 환산
                    if (fileSize >= 1024 * 1024) {
                        fileSize = fileSize / (1024 * 1024);
                        var convertlastpage = fileSize.toFixed(2);
                        str = convertlastpage + ' MB';
                    }

                    else {
                        fileSize = fileSize / 1024;
                        var convertlastpage = fileSize.toFixed(2);
                        str = convertlastpage + ' KB';
                    }

                    if($(this).val() != ""){
                    
                        $(this).prev().val(str);
                        $(this).parent().prev().prev().children().val(fileName);
                        $(this).after('<input type="hidden" name="file_type[]" value ="0" />');
                        $(this).parent().parent().addClass('file_list_check');
                        $(this).attr('name' , 'bf_file[]');

                        var html = '<tr class="input_form_info upload0'+file_number+'">'
                        +'    <th scope="col" class="view_table_header " colspan="1" style="width:10%; height: 58px;">첨부파일</th>'
                        +'    <td scope="col" class=" view_table_text view_table_padding " colspan="1" style="width:10%">'
                        +'       <img src="<?php echo G5_IMG_URL ?>/download_icon.png" alt="<?php echo $config['cf_title']; ?>">'
                        +'    </th>'
                        +'    <td scope="col" class=" view_table_text view_table_padding_name " colspan="7">'+ fileName+'</th>'
                        +'</tr>';


                        $('#view_table_upload').append(html);

                        file_number++;

                        // var html = '<div class="input-file"><input type="text" id="file_label'+file_number+'" ="" class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="파일명"/><input type="text" id="file-size-'+file_number+'" class="file-name file-size" value="용량" =""/><input type="file" name="bf_file[]" id="upload0'+file_number+'" class="file-upload" <?= $row44['report'] ==2? "disabled": ""; ?>/><button type="button" class="file-label file-del " id="file-del'+file_number+'" <?= $row44['report'] ==2? "disabled": ""; ?>style="background:<?= $row44['report'] ==2? '#ccc !important': 'crimson'; ?>">삭제</button></div>';
                        var html ='<tr class="input-file_list input-file_list_all">'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일명</th>'
                        +'<td scope="col" class=" view_table_text view_table_padding" colspan="2" style="width:40%">'
                        +'    <input type="text" id="file_label'+file_number+'" ="" class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="파일명"/>'
                        +'</td>'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 사이즈</th>'
                        +'<td scope="col" class=" view_table_text view_table_padding" colspan="2" style="width:20%">'
                        +'    <input type="text" id="file-size-'+file_number+'" class="file-name file-size" value="용량" =""/>'
                        +'    <input type="file" name="bf_file_null[]" id="upload0'+file_number+'" class="file-upload" <?= $row44['report'] ==2? "disabled": ""; ?>/>'
                        +'</td>'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 삭제</th>'
                        +'<td scope="col" class=" view_table_text view_table_padding" colspan="1" style="width:10%">'
                        +'<button type="button" class="file-label file-del " id="file-del'+file_number+'" <?= $row44['report'] ==2? "disabled": ""; ?>>삭제</button>'
                        +'</td>'
                        +'</tr>';

                        $('.file_table_all').append(html);

                        $("#file-label-btn").attr('for', 'upload0'+file_number);

                    }
                })

                
            })


            $(document).off().on('click','.file-del',function(){
                var val = $(this).parent().find('.file-upload').prev().val();
                var file_id = $(this).parent().prev().prev().find('.file-upload').attr('id');
                // alert(val);
                var next = $(this).parent().parent().next('tr').val();
                var index_form = $(this).parent().parent().index('.input-file_list')+1;
                if(val != undefined){
                    $(this).parent().parent().remove();
                    $('.'+file_id+'').remove();
                    
                } else {
                    if(next == ""){
                        $(this).parent().parent().remove();
                        $('.'+file_id+'').remove();
                    } 
                }    
            })

            $(document).on("keydown", "input[type=file]", function(event) {
             event.key != "Enter";
        });

   
        $('.del-no-btn').click(function(){
                var check_val =  $(this).parent().prev().prev().find('input[type="checkbox"]').is(":checked");
                $(this).parent().parent().removeClass('file_list_check');
                
                $(this).parent().parent().css({'display':'none'});

        })
        })
    </script>
<?php } else if ($row['bo_title_idx'] == 4) { ?>
    <section id="bo_v" style="width:80%;">
        <h2 class="sound_only"><?php echo $g5['title'] ?></h2>
        <!-- 게시물 작성/수정 시작 { -->
        <form name="fwrite" id="fwrite" action="<?php echo $action_table_url; ?>" onsubmit=" fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" style="width:<?php echo $width; ?>">
        <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
        <input type="hidden" name="w" value="<?php echo $w ?>">
        <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
        <input type="hidden" name="wr_id" value="<?php echo $_GET['wr_id'] != "" ? $_GET['wr_id'] : $_POST['wr_id']; ?>">
        <input type="hidden" name="sca" value="<?php echo $sca ?>">
        <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
        <input type="hidden" name="stx" value="<?php echo $stx ?>">
        <input type="hidden" name="spt" value="<?php echo $spt ?>">
        <input type="hidden" name="sst" value="<?php echo $sst ?>">
        <input type="hidden" name="sod" value="<?php echo $sod ?>">
        <input type="hidden" name="page" value="<?php echo $page ?>">
        <input type="hidden" name="bo_idx" value="<?php echo $_GET['us_idx'] ?>">
        
            <div class="bo_w_tit write_div">
                <div id="bo_btn_top_app">
                    <h1 class="view_title"><?=  $category_title ?></h1>
                </div>
            </div>



            <table class="view_table_app">
                <thead>
                    <tr>
                        <th scope="col" class="view_table_header"colspan="1" style="width: 10%;">제목</th>
                        <td scope="col" class="view_table_title" colspan="8" style="width: 90%;">
                            <input type="text" name="title" id="title"  class="input_text  " placeholder="제목" value="<?= $row22['wr_subject']; ?>"  readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" style="width: 10%;">접수번호</th>
                        <td scope="col" class=" view_table_text " colspan="2" style="width: 40%;">
                        <input type="text" name="info_number" id="info_number"  class="input_text " placeholder="접수 완료시 자동부여됩니다." value="<?= $row['info_number']; ?>"  readonly>
                        </td>
                        <th scope="col" class="view_table_header" style="width: 10%;">과제번호</th>
                        <td scope="col" class=" view_table_text " colspan="5" style="width: 40%;">
                        <input type="text" name="quest_number" id="quest_number"  class="input_text " placeholder="선발 후 부여됩니다" value="<?= $row['quest_number']; ?>"readonly >
                        </td>
                    </tr>
                </thead>
                <tbody id="input_file_cont">
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">연구과제명</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1">과제명(국문)</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="8">
                        <input type="text" name="ko_title" id="ko_title"  class="input_text input_border_true" placeholder="과제명(국문)" value="<?= $row['ko_title']; ?>" >
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1">과제명(영문)</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="8">
                        <input type="text" name="en_title" id="en_title"  class="input_text input_border_true" placeholder="과제명(영문)" value="<?= $row['en_title']; ?>" >
                        </td>
                    </tr>
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">집단회 개최</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header">소속 기관</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="8">
                        <input type="text" name="meeting_agency" id="meeting_agency"  class="input_text input_border_true" placeholder="" value="<?= $row['meeting_agency']; ?>" >
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header">개최장소</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="2">
                        <input type="text" name="meeting_venue" id="meeting_venue"  class="input_text input_border_true" placeholder="" value="<?= $row['meeting_venue']; ?>" >
                        </td>
                        <th scope="col" class="view_table_header">집담회 규모(인원)</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="5">
                        <input type="text" name="meeting_scale" id="meeting_scale"  class="input_text input_border_true" placeholder="명" value="<?= $row['meeting_scale']; ?>" >
                        </td>
                    </tr>
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">책임자현황</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1">성명</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="2">
                        <input type="text" name="normal_manager_name" id="normal_manager_name"  class="input_text input_border_true" placeholder="성명" value="<?= $row['normal_manager_name']; ?>" >
                        </td>
                        <th scope="col" class="view_table_header" colspan="1">전공(학위)</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="5">
                        <input type="text" name="normal_manager_degree" id="normal_manager_degree"  class="input_text input_border_true" placeholder="전공(학위)" value="<?= $row['normal_manager_degree']; ?>" >
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1">소속</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="2">
                        <input type="text" name="normal_manager_belong" id="normal_manager_belong"  class="input_text input_border_true" placeholder="소속" value="<?= $row['normal_manager_belong']; ?>" >
                        </td>
                        <th scope="col" class="view_table_header" colspan="1">직급</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="5">
                        <input type="text" name="normal_manager_rank" id="normal_manager_rank"  class="input_text input_border_true" placeholder="직급" value="<?= $row['normal_manager_rank']; ?>" >
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1">이메일</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="2">
                        <input type="text" name="normal_manager_email" id="normal_manager_email"  class="input_text input_border_true" placeholder="이메일" value="<?= $row['normal_manager_email']; ?>" >
                        </td>
                        <th scope="col" class="view_table_header" colspan="1">전화</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="5">
                        <input type="text" name="normal_manager_phone" id="normal_manager_phone"  class="input_text input_border_true" placeholder="전화" value="<?= $row['normal_manager_phone']; ?>" >
                        </td>
                    </tr>
                
                    
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">소속기관 현황</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1"style="">소속기관</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="8">
                            <input type="text" name="belong_agency" id="belong_agency" placeholder=""  class="input_text input_border_true"  value="<?= $row['belong_agency']; ?>" >
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="col" class="view_table_header" rowspan="3"style="">소속기관</th>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%">성명</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="1">
                        <input type="text" name="agency_name" id="agency_name"  class="input_text input_border_true" placeholder="성명" value="<?= $row['agency_name']; ?>" >
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%">전공(학위)</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="6">
                        <input type="text" name="agency_degree" id="agency_degree"  class="input_text input_border_true" placeholder="전공(학위)" value="<?= $row['agency_degree']; ?>" >
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%">소속</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="1">
                        <input type="text" name="agency_belong" id="agency_belong"  class="input_text input_border_true" placeholder="소속" value="<?= $row['agency_belong']; ?>" >
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%">직급</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="6">
                        <input type="text" name="agency_rank" id="agency_rank"  class="input_text input_border_true" placeholder="직급" value="<?= $row['agency_rank']; ?>" >
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%">이메일</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="1">
                        <input type="text" name="agency_email" id="agency_email"  class="input_text input_border_true" placeholder="이메일" value="<?= $row['agency_email']; ?>" >
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%">전화</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="6">
                        <input type="text" name="agency_phone" id="agency_phone"  class="input_text input_border_true" placeholder="전화" value="<?= $row['agency_phone']; ?>" >
                        </td>
                    </tr>
                    
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">연구정보</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1">연구비신청액</th>
                        <td scope="col" class=" view_table_text view_table_padding " colspan="7">
                            <input type="text" name="money" id="money"  class="input_text input_border_true  money" placeholder="숫자만 기재 (원)" value="<?= $row['money']; ?>" >
                        </td>
                    </tr>

                   
                </tbody>
                <tbody class="file_table_all">
                    <tr class="view_table_header_table"></tr>
                    <tr class="all_user_file">
                        <th scope="col" class="view_table_header " colspan="9">자료 첨부</th>
                    </tr>
                    <?php 
                        $sql2 = " select * from g5_board_file where bo_table = 'g5_business_propos' and wr_id = '{$row['idx']}' and bf_user_type = 0";
                        $result2 = sql_query($sql2);    

                        // 가변 파일
                            for ($i=0; $row_list2 = sql_fetch_array($result2); $i++) {
                                if (isset($row_list2['bf_source'][$i])) {
                        ?>
                                <tr class="input-file_list file_list_check">
                                    <?php
                                        //MB 단위 이상일때 MB 단위로 환산
                                        if ($row_list2['bf_filesize'] >= 1024 * 1024) {
                                            $fileSize = $row_list2['bf_filesize'] / (1024 * 1024);
                                            $convertlastpage = sprintf('%0.2f', $fileSize); // 520 -> 520.00
                                            $str = $convertlastpage . ' MB';
                                        }
                            
                                        else {
                                            $fileSize = $row_list2['bf_filesize'] / 1024;
                                            $convertlastpage = sprintf('%0.2f', $fileSize); // 520 -> 520.00
                                            $str = $convertlastpage . ' KB';
                                        }
                                    ?>
                                    <th scope="col" class="view_table_header" colspan="1" style="width:10%">파일명</th>
                                    <td scope="col" class=" view_table_text view_table_padding" colspan="2" style="width:40%">
                                    <input type="text" id="file_label1"  class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="<?= $row_list2['bf_source']; ?>" style="margin: 0 -2px;" readonly/>
                                    </td>
                                    <th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 사이즈</th>
                                    <td scope="col" class=" view_table_text view_table_padding" colspan="2" style="width:20%">
                                        <input type="hidden" value="<?= $row_list2['bo_table']; ?>" class="sql_file_tabel">
                                        <input type="hidden" value="<?= $row_list2['wr_id']; ?>" class="sql_file_id">
                                        <input type="hidden" value="<?= $row_list2['bf_no']; ?>" class="sql_file_no">
                                        <input type="text" id="file-size-'+file_number+'" class="file-name file-size" style="margin: 0 -2px;" value="<?= $str ?>" readonly/>
                                        <input type="file" name="bf_file[]" id="upload00" value="<?= $row_list2['bf_no']; ?>" class="file-upload file_sql_upload" <?= $row44['report'] ==2? "disabled": ""; ?> />
                                        <input type="checkbox" class="del-no" id="del-no<?= $i ?>" name="del-no[]" value="<?= $row_list2['bf_no']; ?>" style="display:none;">
                                        <input type="hidden" name="file_type[]" value ="0" />
                                    </td>
                                    <th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 삭제</th>
                                    <td scope="col" class=" view_table_text view_table_padding" colspan="1" style="width:10%">
                                        <label for="del-no<?= $i ?>" class="file-label del-no-btn">삭제</label>
                                    </td>
                                </tr>
                                <?php
                                }
                            }
                        ?>
                </tbody>
            </table>

            <div class="btn_confirm write_div btn-cont">
                <label for="upload01" id="file-label-btn" class="file-label file-label-btn"><img src="<?= G5_IMG_URL ?>/upload.png" alt=""> 파일 업로드</label>

                <a href="<?= G5_BBS_URL ?>/board.value.php?bo_table=business&bo_idx=<?= $_GET['bo_idx'] ?>" class=" btn_color_white">취소</a>
                <button type="submit" class="btn_next_prv btn_next_prv_link btn-update">수정</button>
            </div>
        </form>
    </section>
    <script>
        $(function(){
            $('.btn-update').click(function(){
                // validation
                if($('#ko_title').val() == "")  {alert("국문 과제명이 비어있습니다"); return false;}
                if($('#en_title').val() == "")  {alert("영문 과제명이 비어있습니다"); return false;}

                if($('#meeting_agency').val() == "") { alert("소속기관이 비어있습니다"); return false;}
                if($('#meeting_venue').val() == "")  {alert("개최장소가 비어있습니다"); return false;}
                if($('#meeting_scale').val() == "")  {alert("집담회 규모(인원)가 비어있습니다"); return false;}

                if($('#normal_manager_name').val() == "")  {alert("책임자 성명이 비어있습니다"); return false;}
                if($('#normal_manager_degree').val() == ""){  alert("책임자 전공이 비어있습니다"); return false;}
                if($('#normal_manager_belong').val() == ""){  alert("책임자 소속이 비어있습니다"); return false;}
                if($('#normal_manager_rank').val() == "")  {alert("책임자 직급이 비어있습니다"); return false;}
                if($('#normal_manager_email').val() == "") { alert("책임자 이메일이 비어있습니다"); return false;}
                if($('#normal_manager_phone').val() == "") { alert("책임자 전화번호가 비어있습니다"); return false;}
                
                if($('#belong_agency').val() == ""){  alert("소속기관이 비어있습니다"); return false;}
                if($('#agency_name').val() == "")  {alert("기관 책임자 성명이 비어있습니다"); return false;}
                if($('#agency_degree').val() == ""){  alert("기관 책임자 전공이 비어있습니다"); return false;}
                if($('#agency_belong').val() == ""){  alert("기관 책임자 소속이 비어있습니다"); return false;}
                if($('#agency_rank').val() == "")  {alert("기관 책임자 직급이 비어있습니다"); return false;}
                if($('#agency_email').val() == "") { alert("기관 책임자 이메일이 비어있습니다"); return false;}
                if($('#agency_phone').val() == "") { alert("기관 책임자 전화번호가 비어있습니다"); return false;}
                if($('#money').val() == "") { alert("연구비신청액이 비어있습니다");  return false;}
                if($('.file_table_all .file_list_check').length == 0) { alert('파일을 업로드 하세요.'); return false;}
                

                //정규식 설정
                var fncTest = /^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]+(\.[a-zA-Z]{2,3}){1,4}$/i;
                var regex= /^[0-9]+$/;

                //정규식 결과 저장
                var meeting_scale = regex.test( $("#meeting_scale").val());
                var normal_manager_email = fncTest.test( $("#normal_manager_email").val());
                var normal_manager_phone = regex.test( $("#normal_manager_phone").val() );

                if(!meeting_scale)  {alert("집담회 규모(인원)에 숫자만 입력해주세요."); return false;}
                if(!normal_manager_email)  {alert("E-mail 주소가 형식에 맞지 않습니다."); return false;}
                if(!normal_manager_phone)  {alert("전화번호에 숫자만 입력해주세요"); return false;}

                //정규식 결과 저장
                var money = regex.test( $("#money").val());
                var agency_phone = regex.test( $("#agency_phone").val());
                var agency_email = fncTest.test( $("#agency_email").val() );

                if(!agency_email)  {alert("E-mail 주소가 형식에 맞지 않습니다."); return false;}
                if(!agency_phone)  {alert("소속기관 책임자 전화번호에 숫자만 입력해주세요"); return false;}
                if(!money)  {alert("연구비신청액에 숫자만 입력해주세요"); return false;}
                    


                  

                

            })
                

            
            var file_number = 1;
            var file_number_rater = 1;
           
            var html = '<tr class="input-file_list ">'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일명</th>'
                        +'<td scope="col" class=" view_table_text view_table_padding" colspan="2" style="width:40%">'
                        +'    <input type="text" style="margin: 0 -2px;" id="file_label1" ="" class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="파일명" readonly/> '
                        +'</td>'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 사이즈</th>'
                        +'<td scope="col" class=" view_table_text view_table_padding" colspan="2" style="width:20%">'
                        +'    <input type="text" id="file-size-'+file_number+'" class="file-name file-size" style="margin: 0 -2px;" value="용량" ="" readonly/>'
                        +'    <input type="file" name="bf_file_null[]" id="upload01" class="file-upload" <?= $row44['report'] ==2? "disabled": ""; ?> />'
                        +'</td>'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 삭제</th>'
                        +'<td scope="col" class=" view_table_text view_table_padding" colspan="1" style="width:10%">'
                        +'<button type="button" class="file-label file-del " id="file-del<?= $i ?>" <?= $row44['report'] ==2? "disabled": ""; ?>>삭제</button>'
                        +'</td>'
                        +'</tr>';

            $('.file_table_all').append(html);


            //클릭이벤트 unbind 
            $("#file-label-btn").unbind("click"); 

            //클릭이벤트 bind
            $("#file-label-btn").bind("click",function(){ 
                $('#upload0'+file_number).change(function(){
                    var fileValue = $(this).val().split("\\");
                    var fileName = fileValue[fileValue.length-1]; // 파일명
                    var fileSize = this.files[0].size;
                    var str ="";

                    //MB 단위 이상일때 MB 단위로 환산
                    if (fileSize >= 1024 * 1024) {
                        fileSize = fileSize / (1024 * 1024);
                        var convertlastpage = fileSize.toFixed(2);
                        str = convertlastpage + ' MB';
                    }

                    else {
                        fileSize = fileSize / 1024;
                        var convertlastpage = fileSize.toFixed(2);
                        str = convertlastpage + ' KB';
                    }

                    if($(this).val() != ""){
                    
                        $(this).prev().val(str);
                        $(this).parent().prev().prev().children().val(fileName);
                        $(this).after('<input type="hidden" name="file_type[]" value ="0" />');
                        $(this).attr('name' , 'bf_file[]');
                        $(this).parent().parent().addClass('file_list_check');

                        var html = '<tr class="input_form_info upload0'+file_number+'">'
                        +'    <th scope="col" class="view_table_header " colspan="1" style="width:10%; height: 58px;">첨부파일</th>'
                        +'    <td scope="col" class=" view_table_text view_table_padding " colspan="1" style="width:10%">'
                        +'       <img src="<?php echo G5_IMG_URL ?>/download_icon.png" alt="<?php echo $config['cf_title']; ?>">'
                        +'    </th>'
                        +'    <td scope="col" class=" view_table_text view_table_padding_name " colspan="7">'+ fileName+'</th>'
                        +'</tr>';


                        $('#view_table_upload').append(html);

                        file_number++;

                        // var html = '<div class="input-file"><input type="text" id="file_label'+file_number+'" ="" class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="파일명"/><input type="text" id="file-size-'+file_number+'" class="file-name file-size" value="용량" =""/><input type="file" name="bf_file[]" id="upload0'+file_number+'" class="file-upload" <?= $row44['report'] ==2? "disabled": ""; ?>/><button type="button" class="file-label file-del " id="file-del'+file_number+'" <?= $row44['report'] ==2? "disabled": ""; ?>style="background:<?= $row44['report'] ==2? '#ccc !important': 'crimson'; ?>">삭제</button></div>';
                        var html ='<tr class="input-file_list input-file_list_all">'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일명</th>'
                        +'<td scope="col" class=" view_table_text view_table_padding" colspan="2" style="width:40%">'
                        +'    <input type="text" id="file_label'+file_number+'" ="" class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="파일명"/>'
                        +'</td>'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 사이즈</th>'
                        +'<td scope="col" class=" view_table_text view_table_padding" colspan="2" style="width:20%">'
                        +'    <input type="text" id="file-size-'+file_number+'" class="file-name file-size" value="용량" =""/>'
                        +'    <input type="file" name="bf_file_null[]" id="upload0'+file_number+'" class="file-upload" <?= $row44['report'] ==2? "disabled": ""; ?>/>'
                        +'</td>'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 삭제</th>'
                        +'<td scope="col" class=" view_table_text view_table_padding" colspan="1" style="width:10%">'
                        +'<button type="button" class="file-label file-del " id="file-del'+file_number+'" <?= $row44['report'] ==2? "disabled": ""; ?>>삭제</button>'
                        +'</td>'
                        +'</tr>';

                        $('.file_table_all').append(html);

                        $("#file-label-btn").attr('for', 'upload0'+file_number);

                    }
                })

                
            })


            $(document).off().on('click','.file-del',function(){
                var val = $(this).parent().find('.file-upload').prev().val();
                var file_id = $(this).parent().prev().prev().find('.file-upload').attr('id');
                // alert(val);
                var next = $(this).parent().parent().next('tr').val();
                var index_form = $(this).parent().parent().index('.input-file_list')+1;
                if(val != undefined){
                    $(this).parent().parent().remove();
                    $('.'+file_id+'').remove();
                    
                } else {
                    if(next == ""){
                        $(this).parent().parent().remove();
                        $('.'+file_id+'').remove();
                    } 
                }    
            })

            $(document).on("keydown", "input[type=file]", function(event) {
             event.key != "Enter";
        });

   
        $('.del-no-btn').click(function(){
                var check_val =  $(this).parent().prev().prev().find('input[type="checkbox"]').is(":checked");
                
                $(this).parent().parent().css({'display':'none'});
                $(this).parent().parent().removeClass('file_list_check');

        })
        })
    </script>
<?php } else if ($row['bo_title_idx'] == 5) { ?>
    <section id="bo_v" style="width:80%;">
        <h2 class="sound_only"><?php echo $g5['title'] ?></h2>
        <!-- 게시물 작성/수정 시작 { -->
        <form name="fwrite" id="fwrite" action="<?php echo $action_table_url; ?>" onsubmit=" fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" style="width:<?php echo $width; ?>">
        <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
        <input type="hidden" name="w" value="<?php echo $w ?>">
        <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
        <input type="hidden" name="wr_id" value="<?php echo $_GET['wr_id'] != "" ? $_GET['wr_id'] : $_POST['wr_id']; ?>">
        <input type="hidden" name="sca" value="<?php echo $sca ?>">
        <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
        <input type="hidden" name="stx" value="<?php echo $stx ?>">
        <input type="hidden" name="spt" value="<?php echo $spt ?>">
        <input type="hidden" name="sst" value="<?php echo $sst ?>">
        <input type="hidden" name="sod" value="<?php echo $sod ?>">
        <input type="hidden" name="page" value="<?php echo $page ?>">
        <input type="hidden" name="bo_idx" value="<?php echo $_GET['us_idx'] ?>">

            <div class="bo_w_tit write_div">
                <div id="bo_btn_top_app">
                    <h1 class="view_title"><?=  $category_title ?></h1>
                </div>
            </div>



            <table class="view_table_app">
                <thead>
                    <tr>
                        <th scope="col" class="view_table_header"colspan="1" style="width: 10%;">제목</th>
                        <td scope="col" class="view_table_title" colspan="8" style="width: 90%;">
                            <input type="text" name="title" id="title"  class="input_text  " placeholder="제목" value="<?= $row22['wr_subject']; ?>" readonly >
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" style="width: 10%;">접수번호</th>
                        <td scope="col" class=" view_table_text " colspan="3" style="width: 40%;">
                        <input type="text" name="info_number" id="info_number"  class="input_text " placeholder="접수 완료시 자동부여됩니다." value="<?= $row['info_number']; ?>" readonly >
                        </td>
                        <th scope="col" class="view_table_header" style="width: 10%;">과제번호</th>
                        <td scope="col" class=" view_table_text " colspan="5" style="width: 40%;">
                        <input type="text" name="quest_number" id="quest_number"  class="input_text " placeholder="선발 후 부여됩니다" value="<?= $row['quest_number']; ?>" readonly>
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" style="width:10%;">과제구분</th>
                        <td scope="col" class="view_table_title " colspan="3" style="width:45%;">
                            <input type="radio" name="quest_division" id="quest_division1" class="quest_division" value="국내학술대회" style="margin-left:10px" <?= $row['quest_division'] == '국내학술대회' ? 'checked': ''; ?>  readonly>
                            <label for="quest_division1">국내학술대회</label>
                            
                        </td>
                        <td scope="col" class="view_table_title " colspan="5" style="width:45%;">
                            <input type="radio" name="quest_division" id="quest_division2" class="quest_division" value="국제학술대회" style="margin-left:10px" <?= $row['quest_division'] == '국제학술대회' ? 'checked': ''; ?>  readonly>
                            <label for="quest_division2">국제학술대회</label>
                        </td>
                    </tr>
                </thead>
                <tbody id="input_file_cont">
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">연구과제명</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1">과제명(국문)</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="8">
                        <input type="text" name="ko_title" id="ko_title"  class="input_text input_border_true" placeholder="과제명(국문)" value="<?= $row['ko_title']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1">과제명(영문)</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="8">
                        <input type="text" name="en_title" id="en_title"  class="input_text input_border_true" placeholder="과제명(영문)" value="<?= $row['en_title']; ?>" >
                        </td>
                    </tr>

                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">연구주최</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1"style="width:10%;">주최(주관)<br>기관</th>
                        <td scope="col" class=" view_table_text view_table_padding "  colspan="8" style="width:40%;">
                            <input type="text" name="host_name" id="host_name"  class="input_text input_border_true " placeholder="성명" value="<?= $row['host_name']; ?>" >
                        </td>
                    </tr>

                    <tr>
                        <th scope="col" class="view_table_header" colspan="1">개최일시</th>
                        <td scope="col" class="view_table_text view_table_padding" colspan="3">
                            <input type="text" name="host_date_start" id="host_date_start"  class="date_start input_text input_date input_border_true input_text_40" value="<?= $row['host_date_start']; ?>"   max="9999-12-31" readonly placeholder="연도-월-일" >
                            ~
                            <input type="text" name="host_date_end" id="host_date_end" class="date_end input_text input_date input_border_true input_text_40" max="9999-12-31" value=" <?= $row['host_date_end']; ?>"  readonly placeholder="연도-월-일">
                        </td>
                        <th scope="col" class="view_table_header" colspan="1">개최장소</th>
                        <td scope="col" class=" view_table_text view_table_padding " colspan="4" style="width:40%;">
                            <input type="text" name="host_venue" id="host_venue"  class="input_text input_border_true " placeholder="개최장소" value="<?= $row['host_venue']; ?>"  >
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" style="width:10%;">공동개최 Y/N</th>
                        <td scope="col" class="view_table_title " colspan="3" style="width:45%;">
                            <input type="radio" name="host_public_check" id="host_public_check1" style="margin-left:10px"  class="host_public_check"  placeholder="제목" value="단독" <?= $row['host_public_check'] == '단독'? 'checked' : ''; ?> readonly>
                            <label for="host_public_check1">단독</label>
                            <input type="radio" name="host_public_check" id="host_public_check2" style="margin-left:10px"  class="host_public_check"  placeholder="제목" value="공동" <?= $row['host_public_check'] == '공동'? 'checked' : ''; ?>  readonly>
                            <label for="host_public_check2">공동</label>
                            
                        </td>
                        <th scope="col" class="view_table_header" style="width:10%;">공동개최 기관명</th>
                        <td scope="col" class=" view_table_text view_table_padding " colspan="4" style="width:40%;">
                            <input type="text" name="host_public_name" id="host_public_name"  class="input_text input_border_true " placeholder="공동개최 기관명" value="<?= $row['host_public_name']; ?>"  >
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%;">후원기관 현황</th>
                        <td scope="col" class=" view_table_text view_table_padding " colspan="3" style="width:40%;">
                            <input type="text" name="host_support_count" id="host_support_count"  class="input_text input_border_true " placeholder="후원기관 현황" value="<?= $row['host_support_count']; ?>곳" readonly>
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%;">후원기관1</th>
                        <td scope="col" class=" view_table_text view_table_padding " colspan="4" style="width:40%;">
                            <input type="text" name="host_support_1" id="host_support_1"  class="input_text input_border_true host_support" placeholder="후원기관1" value="<?= $row['host_support_1']; ?>"  >
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%;">후원기관2</th>
                        <td scope="col" class=" view_table_text view_table_padding " colspan="3" style="width:40%;">
                            <input type="text" name="host_support_2" id="host_support_2"  class="input_text input_border_true host_support" placeholder="후원기관2" value="<?= $row['host_support_2']; ?>" >
                        </td>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%;">후원기관3</th>
                        <td scope="col" class=" view_table_text view_table_padding " colspan="4" style="width:40%;">
                        <input type="text" name="host_support_3" id="host_support_3"  class="input_text input_border_true host_support" placeholder="후원기관3" value="<?= $row['host_support_3']; ?>" > 
                        </td>
                    </tr>

                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">참가예정 인원</th>
                    </tr>

                    <tr>
                        <th scope="col" class="view_table_header" colspan="2" style="width:25%">발표자</th>
                        <td scope="col" class=" view_table_text view_table_padding " colspan="2" style="width:25%">
                            <input type="text" name="presenter_user" id="presenter_user"  class="input_text input_border_true " placeholder="발표자" value="<?= $row['presenter_user']; ?>" >
                        </td>
                        <th scope="col" class="view_table_header" colspan="2" style="width:25%">토론자</th>
                        <td scope="col" class=" view_table_text view_table_padding " colspan="3" style="width:25%">
                            <input type="text" name="debater_user" id="debater_user"  class="input_text input_border_true " placeholder="토론자" value="<?= $row['debater_user']; ?>" >
                        </td>
                    </tr>

                    <tr>
                        <th scope="col" class="view_table_header" colspan="2">사회자</th>
                        <td scope="col" class=" view_table_text view_table_padding " colspan="2">
                            <input type="text" name="mc_user" id="mc_user"  class="input_text input_border_true " placeholder="사회자" value="<?= $row['mc_user']; ?>" >
                        </td>
                        <th scope="col" class="view_table_header" colspan="2">일반참가자</th>
                        <td scope="col" class=" view_table_text view_table_padding " colspan="3">
                            <input type="text" name="normal_user" id="normal_user"  class="input_text input_border_true " placeholder="일반참가자" value="<?= $row['normal_user']; ?>" >
                        </td>
                    </tr>
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">소속기관 현황</th>
                    </tr>
                    
                    <tr>
                        <th scope="col" class="view_table_header" rowspan="3"style="">기관책임자</th>
                        <th scope="col" class="view_table_header" colspan="1" style=" width:10%">성명</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="2">
                        <input type="text" name="institute_manager_name" id="institute_manager_name"  class="input_text input_border_true" placeholder="성명" value="<?= $row['institute_manager_name']; ?>" >
                        </td>
                        <th scope="col" class="view_table_header" colspan="1">전공(학위)</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="4">
                        <input type="text" name="institute_manager_degree" id="institute_manager_degree"  class="input_text input_border_true" placeholder="전공(학위)" value="<?= $row['institute_manager_degree']; ?>" >
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1">소속</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="2">
                        <input type="text" name="institute_manager_belong" id="institute_manager_belong"  class="input_text input_border_true" placeholder="소속" value="<?= $row['institute_manager_belong']; ?>" >
                        </td>
                        <th scope="col" class="view_table_header" colspan="1">직급</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="4">
                        <input type="text" name="institute_manager_rank" id="institute_manager_rank"  class="input_text input_border_true" placeholder="직급" value="<?= $row['institute_manager_rank']; ?>" >
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1">이메일</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="2">
                        <input type="text" name="institute_manager_email" id="institute_manager_email"  class="input_text input_border_true" placeholder="이메일" value="<?= $row['institute_manager_email']; ?>" >
                        </td>
                        <th scope="col" class="view_table_header" colspan="1">전화</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="4">
                        <input type="text" name="institute_manager_phone" id="institute_manager_phone"  class="input_text input_border_true" placeholder="전화" value="<?= $row['institute_manager_phone']; ?>" >
                        </td>
                    </tr>

                   
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header" rowspan="11" colspan="1">소속기관</th>
                        <th scope="col" class="view_table_header" colspan="1" style="width:10%">연번</th>
                        <th scope="col" class="view_table_header" colspan="2">직위</th>
                        <th scope="col" class="view_table_header" colspan="2">성명</th>
                        <th scope="col" class="view_table_header" colspan="3">소속</th>
                    </tr>

                    <tr>
                        <th scope="col" class="view_table_header" colspan="1">1</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="2">
                            <input type="text" name="1_user_rank" id="1_user_rank"  class="input_text input_border_true" placeholder="직위" value="<?= $row['1_user_rank']; ?>" >
                        </td>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="2">
                            <input type="text" name="1_user_name" id="1_user_name"  class="input_text input_border_true" placeholder="성명" value="<?= $row['1_user_name']; ?>" >
                        </td>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="3">
                            <input type="text" name="1_user_belong" id="1_user_belong" class="input_text input_border_true" placeholder="소속" value="<?= $row['1_user_belong']; ?>" >
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1">2</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="2">
                            <input type="text" name="2_user_rank" id="2_user_rank"  class="input_text input_border_true" placeholder="직위" value="<?= $row['2_user_rank']; ?>" >
                        </td>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="2">
                            <input type="text" name="2_user_name" id="2_user_name"  class="input_text input_border_true" placeholder="성명" value="<?= $row['2_user_name']; ?>" >
                        </td>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="3">
                            <input type="text" name="2_user_belong" id="2_user_belong"  class="input_text input_border_true" placeholder="소속" value="<?= $row['2_user_belong']; ?>" >
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1">3</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="2">
                            <input type="text" name="3_user_rank" id="3_user_rank"  class="input_text input_border_true" placeholder="직위" value="<?= $row['3_user_rank']; ?>" >
                        </td>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="2">
                            <input type="text" name="3_user_name" id="3_user_name"  class="input_text input_border_true" placeholder="성명" value="<?= $row['3_user_name']; ?>" >
                        </td>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="3">
                            <input type="text" name="3_user_belong" id="3_user_belong"  class="input_text input_border_true" placeholder="소속" value="<?= $row['3_user_belong']; ?>" >
                        </td>
                    </tr>

                    <tr>
                        <th scope="col" class="view_table_header" colspan="1">4</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="2">
                            <input type="text" name="4_user_rank" id="4_user_rank"  class="input_text input_border_true" placeholder="직위" value="<?= $row['4_user_rank']; ?>" >
                        </td>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="2">
                            <input type="text" name="4_user_name" id="4e_user_name"  class="input_text input_border_true" placeholder="성명" value="<?= $row['4_user_name']; ?>" >
                        </td>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="3">
                            <input type="text" name="4_user_belong" id="4_user_belong"  class="input_text input_border_true" placeholder="소속" value="<?= $row['4_user_belong']; ?>" >
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1">5</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="2">
                            <input type="text" name="5_user_rank" id="5_user_rank"  class="input_text input_border_true" placeholder="직위" value="<?= $row['5_user_rank']; ?>" >
                        </td>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="2">
                            <input type="text" name="5_user_name" id="5_user_name"  class="input_text input_border_true" placeholder="성명" value="<?= $row['5_user_name']; ?>" >
                        </td>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="3">
                            <input type="text" name="5_user_belong" id="5_user_belong"  class="input_text input_border_true" placeholder="소속" value="<?= $row['5_user_belong']; ?>" >
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1">6</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="2">
                            <input type="text" name="6_user_rank" id="6_user_rank"  class="input_text input_border_true" placeholder="직위" value="<?= $row['6_user_rank']; ?>" >
                        </td>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="2">
                            <input type="text" name="6_user_name" id="6_user_name"  class="input_text input_border_true" placeholder="성명" value="<?= $row['6_user_name']; ?>" >
                        </td>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="3">
                            <input type="text" name="6_user_belong" id="6_user_belong"  class="input_text input_border_true" placeholder="소속" value="<?= $row['6_user_belong']; ?>" >
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1">7</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="2">
                            <input type="text" name="7_user_rank" id="7_user_rank"  class="input_text input_border_true" placeholder="직위" value="<?= $row['7_user_rank']; ?>" >
                        </td>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="2">
                            <input type="text" name="7_user_name" id="7_user_name"  class="input_text input_border_true" placeholder="성명" value="<?= $row['7_user_name']; ?>" >
                        </td>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="3">
                            <input type="text" name="7_user_belong" id="7_user_belong"  class="input_text input_border_true" placeholder="소속" value="<?= $row['7_user_belong']; ?>" >
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1">8</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="2">
                            <input type="text" name="8_user_rank" id="8_user_rank"  class="input_text input_border_true" placeholder="직위" value="<?= $row['8_user_rank']; ?>" >
                        </td>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="2">
                            <input type="text" name="8_user_name" id="8_user_name"  class="input_text input_border_true" placeholder="성명" value="<?= $row['8_user_name']; ?>" >
                        </td>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="3">
                            <input type="text" name="8_user_belong" id="8_user_belong"  class="input_text input_border_true" placeholder="소속" value="<?= $row['8_user_belong']; ?>" >
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1">9</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="2">
                            <input type="text" name="9_user_rank" id="9_user_rank"  class="input_text input_border_true" placeholder="직위" value="<?= $row['9_user_rank']; ?>" >
                        </td>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="2">
                            <input type="text" name="9_user_name" id="9_user_name"  class="input_text input_border_true" placeholder="성명" value="<?= $row['9_user_name']; ?>" >
                        </td>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="3">
                            <input type="text" name="9_user_belong" id="9_user_belong"  class="input_text input_border_true" placeholder="소속" value="<?= $row['9_user_belong']; ?>" >
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1">10</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="2">
                            <input type="text" name="10_user_rank" id="10_user_rank"  class="input_text input_border_true" placeholder="직위" value="<?= $row['10_user_rank']; ?>" >
                        </td>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="2">
                            <input type="text" name="10_user_name" id="10_user_name"  class="input_text input_border_true" placeholder="성명" value="<?= $row['10_user_name']; ?>" >
                        </td>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="3">
                            <input type="text" name="10_user_belong" id="10_user_belong"  class="input_text input_border_true" placeholder="소속" value="<?= $row['10_user_belong']; ?>" >
                        </td>
                    </tr>

                   
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">연구정보</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1">연구비신청액</th>
                        <td scope="col" class=" view_table_text view_table_padding " colspan="8">
                            <input type="text" name="money" id="money"  class="input_text input_border_true  money" placeholder="숫자만 기재 (원)" value="<?= $row['money']; ?>" >
                        </td>
                    </tr>
                    
                </tbody>
                <tbody class="file_table_all">
                    <tr class="view_table_header_table"></tr>
                    <tr class="all_user_file">
                        <th scope="col" class="view_table_header " colspan="9">자료 첨부</th>
                    </tr>
                    <?php 
                        $sql2 = " select * from g5_board_file where bo_table = 'g5_business_propos' and wr_id = '{$row['idx']}' and bf_user_type = 0";
                        $result2 = sql_query($sql2);    

                        // 가변 파일
                            for ($i=0; $row_list2 = sql_fetch_array($result2); $i++) {
                                if (isset($row_list2['bf_source'][$i])) {
                        ?>
                                <tr class="input-file_list file_list_check">
                                    <?php
                                        //MB 단위 이상일때 MB 단위로 환산
                                        if ($row_list2['bf_filesize'] >= 1024 * 1024) {
                                            $fileSize = $row_list2['bf_filesize'] / (1024 * 1024);
                                            $convertlastpage = sprintf('%0.2f', $fileSize); // 520 -> 520.00
                                            $str = $convertlastpage . ' MB';
                                        }
                            
                                        else {
                                            $fileSize = $row_list2['bf_filesize'] / 1024;
                                            $convertlastpage = sprintf('%0.2f', $fileSize); // 520 -> 520.00
                                            $str = $convertlastpage . ' KB';
                                        }
                                    ?>
                                    <th scope="col" class="view_table_header" colspan="1" style="width:10%">파일명</th>
                                    <td scope="col" class=" view_table_text view_table_padding" colspan="2" style="width:40%">
                                    <input type="text" id="file_label1"  class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="<?= $row_list2['bf_source']; ?>" style="margin: 0 -2px;" readonly/>
                                    </td>
                                    <th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 사이즈</th>
                                    <td scope="col" class=" view_table_text view_table_padding" colspan="2" style="width:20%">
                                        <input type="hidden" value="<?= $row_list2['bo_table']; ?>" class="sql_file_tabel">
                                        <input type="hidden" value="<?= $row_list2['wr_id']; ?>" class="sql_file_id">
                                        <input type="hidden" value="<?= $row_list2['bf_no']; ?>" class="sql_file_no">
                                        <input type="text" id="file-size-'+file_number+'" class="file-name file-size" style="margin: 0 -2px;" value="<?= $str ?>" readonly/>
                                        <input type="file" name="bf_file[]" id="upload00" value="<?= $row_list2['bf_no']; ?>" class="file-upload file_sql_upload" <?= $row44['report'] ==2? "disabled": ""; ?> />
                                        <input type="checkbox" class="del-no" id="del-no<?= $i ?>" name="del-no[]" value="<?= $row_list2['bf_no']; ?>" style="display:none;">
                                        <input type="hidden" name="file_type[]" value ="0" />
                                    </td>
                                    <th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 삭제</th>
                                    <td scope="col" class=" view_table_text view_table_padding" colspan="2" style="width:10%">
                                        <label for="del-no<?= $i ?>" class="file-label del-no-btn">삭제</label>
                                    </td>
                                </tr>
                                <?php
                                }
                            }
                        ?>
                </tbody>

            </table>

            <div class="btn_confirm write_div btn-cont">
                <label for="upload01" id="file-label-btn" class="file-label file-label-btn"><img src="<?= G5_IMG_URL ?>/upload.png" alt=""> 파일 업로드</label>

                <a href="<?= G5_BBS_URL ?>/board.value.php?bo_table=business&bo_idx=<?= $_GET['bo_idx'] ?>" class=" btn_color_white">취소</a>
                <button type="submit" class="btn_next_prv btn_next_prv_link btn-update">수정</button>
            </div>
        </form>
    </section>
    <script>
        $(function(){
            $('.btn-update').click(function(){
                // validation
                if($('#ko_title').val() == "") { alert("국문 과제명이 비어있습니다"); return false;}
                if($('#en_title').val() == "") { alert("영문 과제명이 비어있습니다"); return false;}

                if($('#host_name').val() == ""){  alert("연구주최 주최(주관)기관이 비어있습니다"); return false;}
                if($('#host_date_start').val() == ""){  alert("연구주최 개최일시 시작이 비어있습니다"); return false;}
                if($('#host_date_end').val() == "")  {alert("연구주최 개최일시 끝이 비어있습니다"); return false;}
                if($('#host_venue').val() == "") { alert("연구주최 장소가 비어있습니다"); return false;}
                if($('#host_public_name').val() == "") { alert("연구주최 공동개최 기관명이 비어있습니다"); return false;}

                if($('#presenter_user').val() == ""){  alert("발표자가 비어있습니다"); return false;}
                if($('#debater_user').val() == "")  {alert("토론자가 비어있습니다"); return false;}
                if($('#mc_user').val() == "")  {alert("사회자가 비어있습니다"); return false;}
                if($('#normal_user').val() == "") { alert("일반참가자가 비어있습니다"); return false;}

                if($('#institute_manager_name').val() == "")  {alert("소속기관 책임자 성명이 비어있습니다"); return false;}
                if($('#institute_manager_degree').val() == ""){  alert("소속기관 책임자 전공이 비어있습니다"); return false;}
                if($('#institute_manager_belong').val() == ""){  alert("소속기관 책임자 소속이 비어있습니다"); return false;}
                if($('#institute_manager_rank').val() == "")  {alert("소속기관 책임자 직급이 비어있습니다"); return false;}
                if($('#institute_manager_email').val() == "") { alert("소속기관 책임자 이메일이 비어있습니다"); return false;}
                if($('#institute_manager_phone').val() == "") { alert("소속기관 책임자 전화번호가 비어있습니다"); return false;}
                if($('#money').val() == "")  {alert("연구비 신청액이 비어있습니다"); return false;}
                if($('.file_table_all .file_list_check').length == 0) { alert('파일을 업로드 하세요.'); return false;}


               
                    //정규식 설정
                var fncTest = /^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]+(\.[a-zA-Z]{2,3}){1,4}$/i;
                //정규식 결과 저장
                var institute_manager_email = fncTest.test( $("#institute_manager_email").val() );
                if(!institute_manager_email) { alert("E-mail 주소가 형식에 맞지 않습니다."); return false;}

                //정규식 설정
                var regex= /^[0-9]+$/;
                //정규식 결과 저장
                var institute_manager_phone = regex.test( $("#institute_manager_phone").val() );
                if(!institute_manager_phone)  {alert("소속기관 책임자 전화번호에 숫자만 입력해주세요"); return false;}

                var moneyResult = regex.test( $("#money").val());
                if(!moneyResult) { alert("연구비신청액에 숫자만 입력해주세요"); return false;}

                var presenter_user = regex.test( $("#presenter_user").val());
                if(!presenter_user)  {alert("발표자에 숫자만 입력해주세요"); return false;}

                var debater_user = regex.test( $("#debater_user").val());
                if(!debater_user)  {alert("토론자에 숫자만 입력해주세요"); return false;}

                var mc_user = regex.test( $("#mc_user").val());
                if(!mc_user) { alert("사회자에 숫자만 입력해주세요"); return false;}

                var normal_user = regex.test( $("#normal_user").val());
                if(!normal_user) { alert("일반참가자에 숫자만 입력해주세요"); return false;}


                    
            })
                
            $('.host_support').change(function(){
                var host_count = $('.host_support').length;
                var host_list_count = 0;

                for(var i = 1; i <= host_count; i++){

                    if($('#host_support_'+i).val() != ''){
                        host_list_count = host_list_count +1;
                        // $("#host_support_"+i+"_view").val($('#host_support_'+i).val());
                        // alert("#host_support_"+i+"_view");
                    }

                }

                $('#host_support_count_view').val(host_list_count+'곳');
                $('#host_support_count').val(host_list_count+'곳');
                // host_support_2_view
                // host_support_2_view
                var value_host = "#"+$(this).attr('id')+"_view";
                var view_host = $(this).val();
                $(value_host).val(view_host);
            });
            
            var file_number = 1;
            var file_number_rater = 1;

            var html = '<tr class="input-file_list ">'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일명</th>'
                        +'<td scope="col" class=" view_table_text view_table_padding" colspan="2" style="width:40%">'
                        +'    <input type="text" style="margin: 0 -2px;" id="file_label1" ="" class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="파일명" readonly/> '
                        +'</td>'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 사이즈</th>'
                        +'<td scope="col" class=" view_table_text view_table_padding" colspan="2" style="width:20%">'
                        +'    <input type="text" id="file-size-'+file_number+'" class="file-name file-size" style="margin: 0 -2px;" value="용량" ="" readonly/>'
                        +'    <input type="file" name="bf_file_null[]" id="upload01" class="file-upload" <?= $row44['report'] ==2? "disabled": ""; ?> />'
                        +'</td>'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 삭제</th>'
                        +'<td scope="col" class=" view_table_text view_table_padding" colspan="2" style="width:10%">'
                        +'<button type="button" class="file-label file-del " id="file-del<?= $i ?>" <?= $row44['report'] ==2? "disabled": ""; ?>>삭제</button>'
                        +'</td>'
                        +'</tr>';
                    

            $('.file_table_all').append(html);


            //클릭이벤트 unbind 
            $("#file-label-btn").unbind("click"); 

             //클릭이벤트 bind
             $("#file-label-btn").bind("click",function(){ 
                $('#upload0'+file_number).change(function(){
                    var fileValue = $(this).val().split("\\");
                    var fileName = fileValue[fileValue.length-1]; // 파일명
                    var fileSize = this.files[0].size;
                    var str ="";

                    //MB 단위 이상일때 MB 단위로 환산
                    if (fileSize >= 1024 * 1024) {
                        fileSize = fileSize / (1024 * 1024);
                        var convertlastpage = fileSize.toFixed(2);
                        str = convertlastpage + ' MB';
                    }

                    else {
                        fileSize = fileSize / 1024;
                        var convertlastpage = fileSize.toFixed(2);
                        str = convertlastpage + ' KB';
                    }

                    if($(this).val() != ""){
                    
                        $(this).prev().val(str);
                        $(this).parent().prev().prev().children().val(fileName);
                        $(this).after('<input type="hidden" name="file_type[]" value ="0" />');
                        $(this).attr('name' , 'bf_file[]');
                        $(this).parent().parent().addClass('file_list_check');

                        var html = '<tr class="input_form_info upload0'+file_number+'">'
                        +'    <th scope="col" class="view_table_header " colspan="1" style="width:10%; height: 58px;">첨부파일</th>'
                        +'    <td scope="col" class=" view_table_text view_table_padding " colspan="1" style="width:10%">'
                        +'       <img src="<?php echo G5_IMG_URL ?>/download_icon.png" alt="<?php echo $config['cf_title']; ?>">'
                        +'    </th>'
                        +'    <td scope="col" class=" view_table_text view_table_padding_name " colspan="7">'+ fileName+'</th>'
                        +'</tr>';


                        $('#view_table_upload').append(html);

                        file_number++;

                        // var html = '<div class="input-file"><input type="text" id="file_label'+file_number+'" ="" class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="파일명"/><input type="text" id="file-size-'+file_number+'" class="file-name file-size" value="용량" =""/><input type="file" name="bf_file[]" id="upload0'+file_number+'" class="file-upload" <?= $row44['report'] ==2? "disabled": ""; ?>/><button type="button" class="file-label file-del " id="file-del'+file_number+'" <?= $row44['report'] ==2? "disabled": ""; ?>style="background:<?= $row44['report'] ==2? '#ccc !important': 'crimson'; ?>">삭제</button></div>';
                        var html ='<tr class="input-file_list input-file_list_all">'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일명</th>'
                        +'<td scope="col" class=" view_table_text view_table_padding" colspan="2" style="width:40%">'
                        +'    <input type="text" id="file_label'+file_number+'" ="" class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="파일명"/>'
                        +'</td>'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 사이즈</th>'
                        +'<td scope="col" class=" view_table_text view_table_padding" colspan="2" style="width:20%">'
                        +'    <input type="text" id="file-size-'+file_number+'" class="file-name file-size" value="용량" =""/>'
                        +'    <input type="file" name="bf_file_null[]" id="upload0'+file_number+'" class="file-upload" <?= $row44['report'] ==2? "disabled": ""; ?>/>'
                        +'</td>'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 삭제</th>'
                        +'<td scope="col" class=" view_table_text view_table_padding" colspan="2" style="width:10%">'
                        +'<button type="button" class="file-label file-del " id="file-del'+file_number+'" <?= $row44['report'] ==2? "disabled": ""; ?>>삭제</button>'
                        +'</td>'
                        +'</tr>';

                        $('.file_table_all').append(html);

                        $("#file-label-btn").attr('for', 'upload0'+file_number);

                    }
                })

                
            })


            $(document).off().on('click','.file-del',function(){
                var val = $(this).parent().find('.file-upload').prev().val();
                var file_id = $(this).parent().prev().prev().find('.file-upload').attr('id');
                // alert(val);
                var next = $(this).parent().parent().next('tr').val();
                var index_form = $(this).parent().parent().index('.input-file_list')+1;
                if(val != undefined){
                    $(this).parent().parent().remove();
                    $('.'+file_id+'').remove();
                    
                } else {
                    if(next == ""){
                        $(this).parent().parent().remove();
                        $('.'+file_id+'').remove();
                    } 
                }    
            })

            $(document).on("keydown", "input[type=file]", function(event) {
             event.key != "Enter";
        });

   
        $('.del-no-btn').click(function(){
                var check_val =  $(this).parent().prev().prev().find('input[type="checkbox"]').is(":checked");
                
                $(this).parent().parent().css({'display':'none'});
                $(this).parent().parent().removeClass('file_list_check');

        })
        $(".input_date").datepicker();
        })
    </script>
<?php } else if ($row['bo_title_idx'] == 6) { ?>
    <section id="bo_v" style="width:80%;">
        <h2 class="sound_only"><?php echo $g5['title'] ?></h2>
        <!-- 게시물 작성/수정 시작 { -->
        <form name="fwrite" id="fwrite" action="<?php echo $action_table_url; ?>" onsubmit=" fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" style="width:<?php echo $width; ?>">
        <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
        <input type="hidden" name="w" value="<?php echo $w ?>">
        <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
        <input type="hidden" name="wr_id" value="<?php echo $_GET['wr_id'] != "" ? $_GET['wr_id'] : $_POST['wr_id']; ?>">
        <input type="hidden" name="sca" value="<?php echo $sca ?>">
        <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
        <input type="hidden" name="stx" value="<?php echo $stx ?>">
        <input type="hidden" name="spt" value="<?php echo $spt ?>">
        <input type="hidden" name="sst" value="<?php echo $sst ?>">
        <input type="hidden" name="sod" value="<?php echo $sod ?>">
        <input type="hidden" name="page" value="<?php echo $page ?>">
        <input type="hidden" name="bo_idx" value="<?php echo $_GET['us_idx'] ?>">

            <div class="bo_w_tit write_div">
                <div id="bo_btn_top_app">
                    <h1 class="view_title"><?=  $category_title ?></h1>
                </div>
            </div>



            <table class="view_table_app">
                <thead>
                    <tr>
                        <th scope="col" class="view_table_header"colspan="1" style="width: 10%;">제목</th>
                        <td scope="col" class="view_table_title" colspan="8" style="width: 90%;">
                            <input type="text" name="title" id="title"  class="input_text  " placeholder="제목" value="<?= $row22['wr_subject']; ?>" readonly >
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" style="width: 10%;">접수번호</th>
                        <td scope="col" class=" view_table_text " colspan="3" style="width: 40%;">
                        <input type="text" name="info_number" id="info_number"  class="input_text " placeholder="접수 완료시 자동부여됩니다." value="<?= $row['info_number']; ?>" readonly>
                        </td>
                        <th scope="col" class="view_table_header" style="width: 10%;">과제번호</th>
                        <td scope="col" class=" view_table_text " colspan="4" style="width: 40%;">
                        <input type="text" name="quest_number" id="quest_number"  class="input_text " placeholder="선발 후 부여됩니다" value="<?= $row['quest_number']; ?>" readonly>
                        </td>
                    </tr>
                </thead>
                <tbody id="input_file_cont">
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">연구과제명</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1">과제명(국문)</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="8">
                        <input type="text" name="ko_title" id="ko_title"  class="input_text input_border_true" placeholder="과제명(국문)" value="<?= $row['ko_title']; ?>" >
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1">과제명(영문)</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="8">
                        <input type="text" name="en_title" id="en_title"  class="input_text input_border_true" placeholder="과제명(영문)" value="<?= $row['en_title']; ?>" >
                        </td>
                    </tr>
                    <tr class="view_table_header_table"></tr>
                    <tr>
                        <th scope="col" class="view_table_header " colspan="9">지원자</th>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1">성명</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="3">
                        <input type="text" name="name" id="name"  class="input_text input_border_true" placeholder="성명" value="<?= $row['name']; ?>" >
                        </td>
                        <th scope="col" class="view_table_header" colspan="1">전공(학위)</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="4">
                        <input type="text" name="degree" id="degree"  class="input_text input_border_true" placeholder="전공(학위)" value="<?= $row['degree']; ?>" >
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1">소속</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="3">
                        <input type="text" name="belong" id="belong"  class="input_text input_border_true" placeholder="소속" value="<?= $row['belong']; ?>" >
                        </td>
                        <th scope="col" class="view_table_header" colspan="1">직급</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="4">
                        <input type="text" name="rank" id="rank"  class="input_text input_border_true" placeholder="직급" value="<?= $row['rank']; ?>" >
                        </td>
                    </tr>
                    <tr>
                        <th scope="col" class="view_table_header" colspan="1">이메일</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="3">
                        <input type="text" name="email" id="email"  class="input_text input_border_true" placeholder="이메일" value="<?= $row['email']; ?>" >
                        </td>
                        <th scope="col" class="view_table_header" colspan="1">전화</th>
                        <td scope="col" class=" view_table_text view_table_padding" colspan="4">
                        <input type="text" name="phone" id="phone"  class="input_text input_border_true" placeholder="전화" value="<?= $row['phone']; ?>" >
                        </td>
                    </tr>
                </tbody>
                <tbody class="file_table_all">
                    <tr class="view_table_header_table"></tr>
                    <tr class="all_user_file">
                        <th scope="col" class="view_table_header " colspan="9">자료 첨부</th>
                    </tr>
                    <?php 
                        $sql2 = " select * from g5_board_file where bo_table = 'g5_business_propos' and wr_id = '{$row['idx']}' and bf_user_type = 0";
                        $result2 = sql_query($sql2);    

                        // 가변 파일
                            for ($i=0; $row_list2 = sql_fetch_array($result2); $i++) {
                                if (isset($row_list2['bf_source'][$i])) {
                        ?>
                                <tr class="input-file_list file_list_check">
                                    <?php
                                        //MB 단위 이상일때 MB 단위로 환산
                                        if ($row_list2['bf_filesize'] >= 1024 * 1024) {
                                            $fileSize = $row_list2['bf_filesize'] / (1024 * 1024);
                                            $convertlastpage = sprintf('%0.2f', $fileSize); // 520 -> 520.00
                                            $str = $convertlastpage . ' MB';
                                        }
                            
                                        else {
                                            $fileSize = $row_list2['bf_filesize'] / 1024;
                                            $convertlastpage = sprintf('%0.2f', $fileSize); // 520 -> 520.00
                                            $str = $convertlastpage . ' KB';
                                        }
                                    ?>
                                    <th scope="col" class="view_table_header" colspan="1" style="width:10%">파일명</th>
                                    <td scope="col" class=" view_table_text view_table_padding" colspan="1" style="width:40%">
                                    <input type="text" id="file_label1"  class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="<?= $row_list2['bf_source']; ?>" style="margin: 0 -2px;" readonly/>
                                    </td>
                                    <th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 사이즈</th>
                                    <td scope="col" class=" view_table_text view_table_padding" colspan="2" style="width:20%">
                                        <input type="hidden" value="<?= $row_list2['bo_table']; ?>" class="sql_file_tabel">
                                        <input type="hidden" value="<?= $row_list2['wr_id']; ?>" class="sql_file_id">
                                        <input type="hidden" value="<?= $row_list2['bf_no']; ?>" class="sql_file_no">
                                        <input type="text" id="file-size-'+file_number+'" class="file-name file-size" style="margin: 0 -2px;" value="<?= $str ?>" readonly/>
                                        <input type="file" name="bf_file[]" id="upload00" value="<?= $row_list2['bf_no']; ?>" class="file-upload file_sql_upload" <?= $row44['report'] ==2? "disabled": ""; ?> />
                                        <input type="checkbox" class="del-no" id="del-no<?= $i ?>" name="del-no[]" value="<?= $row_list2['bf_no']; ?>" style="display:none;">
                                        <input type="hidden" name="file_type[]" value ="0" />
                                    </td>
                                    <th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 삭제</th>
                                    <td scope="col" class=" view_table_text view_table_padding" colspan="1" style="width:10%">
                                        <label for="del-no<?= $i ?>" class="file-label del-no-btn">삭제</label>
                                    </td>
                                </tr>
                                <?php
                                }
                            }
                        ?>
                </tbody>
            </table>

           
            <div class="btn_confirm write_div btn-cont">
                <label for="upload01" id="file-label-btn" class="file-label file-label-btn"><img src="<?= G5_IMG_URL ?>/upload.png" alt=""> 파일 업로드</label>

                <a href="<?= G5_BBS_URL ?>/board.value.php?bo_table=business&bo_idx=<?= $_GET['bo_idx'] ?>" class=" btn_color_white">취소</a>
                <button type="submit" class="btn_next_prv btn_next_prv_link btn-update">수정</button>
            </div>
        </form>
    </section>
    <script>
        $(function(){
            $('.btn-update').click(function(){
                // validation
                if($('#ko_title').val() == "") { alert("국문 과제명이 비어있습니다"); return false;}
                if($('#en_title').val() == "") { alert("영문 과제명이 비어있습니다"); return false;}
                if($('#name').val() == "")  {alert("성명이 비어있습니다"); return false;}
                if($('#degree').val() == ""){  alert("전공(학위)이 비어있습니다"); return false;}
                if($('#belong').val() == ""){  alert("소속이 비어있습니다"); return false;}
                if($('#rank').val() == "")  {alert("직급이 비어있습니다"); return false;}
                if($('#email').val() == "") { alert("이메일이 비어있습니다"); return false;}
                if($('#phone').val() == "") { alert("전화번호가 비어있습니다"); return false;}
                if($('.file_table_all .file_list_check').length == 0) { alert('파일을 업로드 하세요.'); return false;}

                //정규식 설정
                var fncTest = /^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]+(\.[a-zA-Z]{2,3}){1,4}$/i;
                //정규식 결과 저장
                var emailResult = fncTest.test( $("#email").val() );
                if(!emailResult) { alert("E-mail 주소가 형식에 맞지 않습니다."); return false;}

                //정규식 설정
                var regex= /^[0-9]+$/;
                //정규식 결과 저장
                var phoneResult = regex.test( $("#phone").val() );
                if(!phoneResult) { alert("전화번호에 숫자만 입력해주세요"); return false;}


                    
            })
                
            $('.host_support').change(function(){
                var host_count = $('.host_support').length;
                var host_list_count = 0;

                for(var i = 1; i <= host_count; i++){

                    if($('#host_support_'+i).val() != ''){
                        host_list_count = host_list_count +1;
                        // $("#host_support_"+i+"_view").val($('#host_support_'+i).val());
                        // alert("#host_support_"+i+"_view");
                    }

                }

                $('#host_support_count_view').val(host_list_count+'곳');
                $('#host_support_count').val(host_list_count+'곳');
                // host_support_2_view
                // host_support_2_view
                var value_host = "#"+$(this).attr('id')+"_view";
                var view_host = $(this).val();
                $(value_host).val(view_host);
            });
            
            var file_number = 1;
            var file_number_rater = 1;
            var html = '<tr class="input-file_list ">'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일명</th>'
                        +'<td scope="col" class=" view_table_text view_table_padding" colspan="1" style="width:40%">'
                        +'    <input type="text" style="margin: 0 -2px;" id="file_label1" ="" class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="파일명" readonly/> '
                        +'</td>'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 사이즈</th>'
                        +'<td scope="col" class=" view_table_text view_table_padding" colspan="2" style="width:20%">'
                        +'    <input type="text" id="file-size-'+file_number+'" class="file-name file-size" style="margin: 0 -2px;" value="용량" ="" readonly/>'
                        +'    <input type="file" name="bf_file_null[]" id="upload01" class="file-upload" <?= $row44['report'] ==2? "disabled": ""; ?> />'
                        +'</td>'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 삭제</th>'
                        +'<td scope="col" class=" view_table_text view_table_padding" colspan="2" style="width:10%">'
                        +'<button type="button" class="file-label file-del " id="file-del<?= $i ?>" <?= $row44['report'] ==2? "disabled": ""; ?>>삭제</button>'
                        +'</td>'
                        +'</tr>';

            $('.file_table_all').append(html);


            //클릭이벤트 unbind 
            $("#file-label-btn").unbind("click"); 

            //클릭이벤트 bind
            $("#file-label-btn").bind("click",function(){ 
                $('#upload0'+file_number).change(function(){
                    var fileValue = $(this).val().split("\\");
                    var fileName = fileValue[fileValue.length-1]; // 파일명
                    var fileSize = this.files[0].size;
                    var str ="";

                    //MB 단위 이상일때 MB 단위로 환산
                    if (fileSize >= 1024 * 1024) {
                        fileSize = fileSize / (1024 * 1024);
                        var convertlastpage = fileSize.toFixed(2);
                        str = convertlastpage + ' MB';
                    }

                    else {
                        fileSize = fileSize / 1024;
                        var convertlastpage = fileSize.toFixed(2);
                        str = convertlastpage + ' KB';
                    }

                    if($(this).val() != ""){
                    
                        $(this).prev().val(str);
                        $(this).parent().prev().prev().children().val(fileName);
                        $(this).after('<input type="hidden" name="file_type[]" value ="0" />');
                        $(this).attr('name' , 'bf_file[]');
                        $(this).parent().parent().addClass('file_list_check');

                        var html = '<tr class="input_form_info upload0'+file_number+'">'
                        +'    <th scope="col" class="view_table_header " colspan="1" style="width:10%; height: 58px;">첨부파일</th>'
                        +'    <td scope="col" class=" view_table_text view_table_padding " colspan="1" style="width:10%">'
                        +'       <img src="<?php echo G5_IMG_URL ?>/download_icon.png" alt="<?php echo $config['cf_title']; ?>">'
                        +'    </th>'
                        +'    <td scope="col" class=" view_table_text view_table_padding_name " colspan="7">'+ fileName+'</th>'
                        +'</tr>';


                        $('#view_table_upload').append(html);

                        file_number++;

                        // var html = '<div class="input-file"><input type="text" id="file_label'+file_number+'" ="" class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="파일명"/><input type="text" id="file-size-'+file_number+'" class="file-name file-size" value="용량" =""/><input type="file" name="bf_file[]" id="upload0'+file_number+'" class="file-upload" <?= $row44['report'] ==2? "disabled": ""; ?>/><button type="button" class="file-label file-del " id="file-del'+file_number+'" <?= $row44['report'] ==2? "disabled": ""; ?>style="background:<?= $row44['report'] ==2? '#ccc !important': 'crimson'; ?>">삭제</button></div>';
                        var html ='<tr class="input-file_list input-file_list_all">'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일명</th>'
                        +'<td scope="col" class=" view_table_text view_table_padding" colspan="1" style="width:40%">'
                        +'    <input type="text" id="file_label'+file_number+'" ="" class="file-name" title="파일첨부 <?php echo $i+1 ?> : 용량 <?php echo $upload_max_filesize ?> 이하만 업로드 가능" value="파일명"/>'
                        +'</td>'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 사이즈</th>'
                        +'<td scope="col" class=" view_table_text view_table_padding" colspan="2" style="width:20%">'
                        +'    <input type="text" id="file-size-'+file_number+'" class="file-name file-size" value="용량" =""/>'
                        +'    <input type="file" name="bf_file_null[]" id="upload0'+file_number+'" class="file-upload" <?= $row44['report'] ==2? "disabled": ""; ?>/>'
                        +'</td>'
                        +'<th scope="col" class="view_table_header" colspan="1" style="width:10%">파일 삭제</th>'
                        +'<td scope="col" class=" view_table_text view_table_padding" colspan="2" style="width:10%">'
                        +'<button type="button" class="file-label file-del " id="file-del'+file_number+'" <?= $row44['report'] ==2? "disabled": ""; ?>>삭제</button>'
                        +'</td>'
                        +'</tr>';

                        $('.file_table_all').append(html);

                        $("#file-label-btn").attr('for', 'upload0'+file_number);

                    }
                })

                
            })

            $(document).off().on('click','.file-del',function(){
                var val = $(this).parent().find('.file-upload').prev().val();
                var file_id = $(this).parent().prev().prev().find('.file-upload').attr('id');
                // alert(val);
                var next = $(this).parent().parent().next('tr').val();
                var index_form = $(this).parent().parent().index('.input-file_list')+1;
                if(val != undefined){
                    $(this).parent().parent().remove();
                    $('.'+file_id+'').remove();
                    
                } else {
                    if(next == ""){
                        $(this).parent().parent().remove();
                        $('.'+file_id+'').remove();
                    } 
                }    
            })

            $(document).on("keydown", "input[type=file]", function(event) {
             event.key != "Enter";
        });

   
        $('.del-no-btn').click(function(){
                var check_val =  $(this).parent().prev().prev().find('input[type="checkbox"]').is(":checked");
                
                $(this).parent().parent().css({'display':'none'});
                $(this).parent().parent().removeClass('file_list_check');

        })
        $(".input_date").datepicker();
        })
    </script>
<?php }  ?>
</section>


<?php if($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>

<?php } ?>


<!-- } 게시물 작성/수정 끝 -->

