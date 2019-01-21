<?php if (!defined('IN_SITE')) die('The request not found'); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Quản lý admin</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <!-- //  Liên kết link css tới riêng file css dành cho danh sách sinh viên -->
        <link rel="stylesheet" href="widgets/style_dssv.css">
    </head>
    <body>
        <div id="container">
        
                              
            <div id="header">
                <div class="htql">
                    HỆ THỐNG QUẢN LÝ
                </div>
        <!-- // NOTE: Nếu là admin mới xuất hiện header ở trên  -->
        <?php  if (is_admin()) {          ?>
                <div class="chucnang">
                    <ul>
                        <li>
                            <a href="<?php echo base_url('admin/?m=user&a=list');  ?>">Danh sách sinh viên</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('admin/?m=user&a=ketqua');  ?>">Kết quả học tập </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('admin/?m=user&a=lop');  ?>">Lớp</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('admin/?m=user&a=khoa');  ?>">Khoa</a>
                        </li>
                    </ul>
                    <div class="admin">
                        Xin chào <?php echo get_current_username();  ?> | 
                        
                        <a href="<?php echo base_url('admin/?m=common&a=logout'); ?>">Thoát</a>
                    </div>
                </div>
        
            </div>
            <?php } // NOTE: ?>  
            <div id="content">
            