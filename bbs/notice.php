<?php 
session_start();
 
$_POST['tbl'];

$session_start_notice =  'header_esc_end';
if ($_SESSION['notice'] == 'header_esc_start') {
     $_SESSION['notice'] = $session_start_notice;
}

echo $_SESSION['notice'];