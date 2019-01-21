<?php if (!defined('IN_SITE')) die ('The request not found'); ?>
<!-- /// Kiểm tra quyền, nếu không có quyền thì chuyển nó về trang logout -->
<?php
if (!is_admin()){
    redirect(base_url('admin/?m=common&a=logout'));
}
?>

<?php include_once('widgets/header.php'); ?>
<?php
    // Kết nối 
    db_connect();
    $sql = " SELECT * FROM khoa";
    $query = mysqli_query($conn,$sql);
?>

<h1>Quản lý lớp</h1>
<div class="controls">
    <a href=" <?php echo create_link(base_url('admin'), array( 'm' => 'user' , 'a' => 'add')); ?>" class="button"> Thêm môn học</a>
</div>
<table class="form" cellspacing = "0" cellpadding ="0">
    <thead>
        <tr>
            <td>Mã khoa</td>
            <td>Tên khoa</td>
            <td>Môn học</td>
            <td>Action</td>
        </tr>
    </thead>
    <tbody>
        <?php
            while ($data = mysqli_fetch_array($query)) {     
                $i = 1;
                $makhoa = $data['makhoa'];


            ?>

            <tr>
                <td><?php echo $makhoa; ?></td>
                <td><?php echo $data['tenkhoa']; ?></td>
                <td><?php echo $data['monhoc']; ?></td>
                <td>
                    <form action="" method="POST" class="form-action">
                        <a href="<?php echo create_link(base_url('admin'), array('m' => 'user', 'a' => 'edit', 'makhoa' => $data['makhoa'])); ?>">&#9998 Edit</a>
                        <input type="hidden" name="user_id" value="<?php echo $data['makhoa']; ?>"/>
                        <input type="hidden" name="request_name" value="delete_user"/>
                        <a href="<?php echo create_link(base_url('admin'), array('m' => 'user', 'a' => 'delete', 'makhoa' => $data['makhoa'])); ?>" class="btn-submit">Delete &#10060 </a>
                    </form>
                
                </td>
            
            </tr>
            <?php 
                    $i++;
                    }
                ?>
        
       
    </tbody>
</table>
<?php include_once('widgets/footer.php'); ?>

