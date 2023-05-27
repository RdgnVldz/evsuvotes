<?php 
    session_start();
    $parse = parse_ini_file('../admin/config.ini', FALSE, INI_SCANNER_RAW);
    $parse['login_id'] = $_SESSION;
    echo json_encode($parse);
?>