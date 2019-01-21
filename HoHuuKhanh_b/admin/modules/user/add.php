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
        if (is_submit('add_user')) {
            // Lấy danh sách dữ liệu từ form 
            $data = array(
                'mssv'      =>  $_POST['mssv'],
                'hovaten'   =>  $_POST['hovaten'],
                'namsinh'   =>  $_POST['namsinh'],
                'gioitinh'  =>  $_POST['gioitinh'],
                'malop'     =>  $_POST['malop']
            );

            // require file xử lý cho user 
            require_once('database/user.php');

            // Thực hiện validate
            $error = db_user_validate($data);
            // Nếu validate không có lỗi 
            if (!$error) {
                // Nếu insert thành công thì thông báo 
                // Và chuyển hướng về trang list.php

                if (db_insert('sinh_vien',$data)) {
                    ?>
                    <script language="javascript">
                        alert('Thêm người dùng thành công');
                        window.location = '<?php echo create_link(base_url('admin') , array('m' => 'user' , 'a' => 'list'));    ?>'
                    </script>
                    <?php   
                        die();
                }
            }

        }
?>
 
<?php include_once('widgets/header.php'); ?>
 
<h1>Thêm thành viên</h1>
 
<div class="controls" style="text-align: center;">
    <a class="button" onclick="$('#main-form').submit()" href="#">Lưu</a>
    <a class="button" href="<?php echo create_link(base_url('admin'), array('m' => 'user', 'a' => 'list')); ?>">Trở về</a>
</div>
 
<form id="main-form" method="post" action="<?php echo create_link(base_url('admin/index.php'), array('m' => 'user', 'a' => 'add')); ?>">
    <input type="hidden" name="request_name" value="add_user"/>
    <table cellspacing="0" cellpadding="0" class="form" style="width: 0%;">
        <tr>
            <td width="200px">MSSV</td>
            <td>
                <input type="text" name="mssv" value="<?php echo input_post('mssv'); ?>" />
                <?php show_error($error, 'mssv'); ?>
            </td>
        </tr>
        <tr>
            <td>Họ và tên</td>
            <td>
                <input type="text" name="hovaten" value="<?php echo input_post('hovaten'); ?>" />
                <?php show_error($error, 'hovaten'); ?>
            </td>
        </tr>
        <tr>    
            <td>Năm sinh</td>
            <td>
                <input type="text" name="namsinh" value="<?php echo  input_post('namsinh'); ?>" />
                <?php show_error($error, 'namsinh'); ?>
            </td>
        </tr>
        <tr>
            <td>Gioi tính</td>
            <td>
                <input type="text" name="gioitinh" value="<?php echo input_post('gioitinh'); ?>" class="long" />
                <?php show_error($error, 'gioitinh'); ?>
            </td>
        </tr>
        <tr>
            <td>Mã lớp</td>
            <td>
                <input type="text" name="malop" value="<?php echo input_post('malop'); ?>" class="long" />
                <?php show_error($error, 'malop'); ?>
            </td>
        </tr>
    </table>
</form>
 
<?php include_once('widgets/footer.php'); ?>
