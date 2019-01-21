<?php if (!defined('IN_SITE')) die('The request not found'); 

    // Xóa session login
    set_loggout();

    // Chuyển hướng trang sang trang login.php
    redirect(base_url('admin/?m=common&a=login'));


?>