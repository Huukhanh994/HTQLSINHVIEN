<?php if (!defined('IN_SITE')) die ('The request not found'); ?>
 
<?php
// Kiểm tra quyền, nếu không có quyền thì chuyển nó về trang logout
if (!is_admin()){
    redirect(base_url('admin'), array('m' => 'common', 'a' => 'logout'));
}
?>
 
<?php 
        // Biến chứa lỗi
        $error = array();
    /// VI TRI 1: CODE SUBMIT FORM
        if (is_submit('add_class')) {
            // Lấy danh sách dữ liệu từ form 
            $data = array(
                'malop'      =>  $_POST['malop'],
                'tenlop'   =>  $_POST['tenlop'],
            );

            // require file xử lý cho user 
            require_once('database/user.php');

            // Thực hiện validate
            $error = db_class_validate($data);
            // Nếu validate không có lỗi 
            if (!$error) {
                // Nếu insert thành công thì thông báo 
                // Và chuyển hướng về trang list.php

                if (db_insert('lophp',$data)) {
                    ?>
                    <script language="javascript">
                        alert('Thêm lớp mới thành công');
                        window.location = '<?php echo create_link(base_url('admin') , array('m' => 'user' , 'a' => 'lop'));    ?>'
                    </script>
                    <?php   
                        die();
                }
            }

        }
?>
 
<?php include_once('widgets/header.php'); ?>
 
<h1>Thêm Lớp Mới</h1>
 
<div class="controls" style="text-align: center;">
    <a class="button" onclick="$('#main-form').submit()" href="#">Lưu</a>
    <a class="button" href="<?php echo create_link(base_url('admin'), array('m' => 'user', 'a' => 'lop')); ?>">Trở về</a>
</div>
 
<form id="main-form" method="post" action="<?php echo create_link(base_url('admin/index.php'), array('m' => 'user', 'a' => 'add_class')); ?>">
    <input type="hidden" name="request_name" value="add_class"/>
    <table cellspacing="0" cellpadding="0" class="form" style="width: 0%;">
        <tr>
            <td width="200px">Mã Lớp</td>
            <td>
                <input type="text" name="malop" value="<?php echo input_post('malop'); ?>" />
                <?php show_error($error, 'malop'); ?>
            </td>
        </tr>
        <tr>
            <td>Tên Lớp</td>
            <td>
                <input type="text" name="tenlop" value="<?php echo input_post('tenlop'); ?>" />
                <?php show_error($error, 'tenlop'); ?>
            </td>
        </tr>
    </table>
</form>
 
<?php include_once('widgets/footer.php'); ?>
