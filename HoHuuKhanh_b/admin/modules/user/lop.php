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
    $sql = " SELECT * FROM lopHP";
    $query = mysqli_query($conn,$sql);
    db_close($conn);
?>

<h1>Quản lý lớp</h1>
<div class="controls">
    <a href=" <?php echo create_link(base_url('admin'), array( 'm' => 'user' , 'a' => 'add_class')); ?>" class="button"> Thêm lớp</a>
</div>
<table class="form" cellspacing = "0" cellpadding ="0">
    <thead>
        <tr>
            <td>Mã lớp</td>
            <td>Tên lớp</td>
            <td>Action</td>
        </tr>
    </thead>
    <tbody>
        <?php
            while ($data = mysqli_fetch_array($query)) {     
                $i = 1;
                $malop = $data['malop'];


            ?>

            <tr>
                <td><?php echo $malop; ?></td>
                <td><?php echo $data['tenlop']; ?></td>
                <td>
                    <form action="" method="POST" class="form-action">
                        <a href="<?php echo create_link(base_url('admin'), array('m' => 'user', 'a' => 'edit_class', 'malop' => $data['malop'])); ?>">&#9998 Edit</a>
                        <input type="hidden" name="user_id" value="<?php echo $data['malop']; ?>"/>
                        <input type="hidden" name="request_name" value="delete_user"/>
                        <a href="<?php echo create_link(base_url('admin'), array('m' => 'user', 'a' => 'delete_class', 'malop' => $data['malop'])); ?>" class="btn-submit">Delete &#10060 </a>
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

