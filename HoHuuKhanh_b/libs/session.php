<!-- // TODO: SESSION LƯU TRỮ TRẠNG THÁI ĐĂNG NHẬP TRONG HỆ THỐNG QUẢN LÝ -->
<!-- // BÀI: 4 -->
<?php   session_start();    ?>
<?php
    if (!defined('IN_SITE')) die ('The request not found');
    
/// Gán session (SET)
    function session_set($key,$value){
        $_SESSION[$key] = $value;
    }
/// Lấy session (GET)
    function session_get($key){
        return (isset($_SESSION[$key])) ? $_SESSION[$key] : false;
    }
/// Xóa session 
    function session_delete($key){
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

?>    