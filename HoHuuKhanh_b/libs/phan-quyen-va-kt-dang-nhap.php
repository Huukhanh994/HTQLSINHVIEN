<!-- // TODO: PHÂN QUYỀN ADMIN VÀ KIỂM TRA TRẠNG THÁI ĐĂNG NHẬP -->

<?php
    if (!defined('IN_SITE')) die ('The request not found');
    
    /// Hàm thiết lập trạng thái đăng nhập 
    function set_logged($username,$level){
        session_set('ss_user_token',array(
            'username' => $username,
            'level' => $level
        ));
    }

    /// Hàm thiết lập đăng xuất 
    function set_loggout(){
        session_delete('ss_user_token');
    }

    /// Hàm kiểm tra người dùng đã đăng nhập hay chưa 
    function is_logged(){
        $user = session_get('ss_user_token');
        return $user;
    }

    /// Hàm kiểm tra có phải admin hay ko?
    // Hàm kiểm tra có phải là admin hay không
    function is_admin(){
        $user  = is_logged();
        if (!empty($user['level']) && $user['level'] == '1'){
            return true;
        }
        return false;
    }
// BÀI: 9 CHỨC NĂNG ĐĂNG XUẤT 

    /// Lấy tên người dùng hiện tại
    function get_current_username(){
        $user = is_logged();
        return isset($user['username']) ? $user['username'] : '';
    }
    /// Lấy level người dùng hiện tại 
    function get_current_level(){
        $user = is_logged();
        return isset($user['level']) ? $user['level'] : '';
    }
?>