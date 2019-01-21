<?php if (!defined('IN_SITE')) die ('The request not found'); ?>
<!-- // TODO: CÁC THƯ VIỆN BỔ TRỢ  -->
<?php
/// Hàm tạo URL 
    function base_url($uri = ''){
        return 'http://localhost:8080/PHP/HoHuuKhanh_b/'.$uri;
    }
/// Hàm chuyển trang sang 
    function redirect($url){
        header("Location:{$url}");
        exit();
    }
/// Hàm kiểm tra có submit form hay chưa?  
    function is_submit($key){
        return (isset($_POST['request_name']) && $_POST['request_name'] == $key);

        // Tương tự như câu lệnh :isset($_POST['request_name]);
    }
    /// Hàm lấy value từ $_POST
    function input_post($key){
        return isset($_POST[$key]) ? trim($_POST[$key]) : false;
    }
    
    /// Hàm lấy value từ $_GET
    function input_get($key){
        return isset($_GET[$key]) ? trim($_GET[$key]) : false;
    }
    /// Hàm show_error()
    function show_error($error,$key){
        echo '<span style="color: red;">'. (empty($error[$key]) ? "" : $error[$key]) .'</span>';
    }
    // BÀI:10 VIẾT HÀM PHÂN TRANG : TẠO CHUỖI QUERY STRING 
    // Tạo chuỗi query string
    function create_link($uri, $filter = array()){  // $uri : đường dẫn của base_url ,$filter : mảng của các common và action và các key và value của key 
        $string = '';
        foreach ($filter as $key => $val){
            if ($val != ''){
                $string .= "&{$key}={$val}";    // nỗi thêm chuỗi
            }
        }
        return $uri . ($string ? '?'.ltrim($string, '&') : '');     // ltrim() : xóa đi kí tự & 
    }

?>