<?php if (!defined('IN_SITE')) die('The request not found');

// TODO: danhsachsinhvien.php thì mình dùng biến mssv để lấy id . Còn lop.php và khoa.php thì dùng id_ 

/// Kiểm tra quyền, nếu không có quyền thì chuyển nó về trang logout
if (!is_admin()) {
    redirect(base_url('admin/?m=common&a=logout'));
}
?>
 
<?php include_once('widgets/header.php'); ?>
<?php
    /// Kết nối

db_connect();
$sql = "SELECT * FROM sinh_vien";
$query = mysqli_query($conn, $sql);
db_close($conn);
?>

<script>
    $(document).ready(function () {
        // Nếu ng dùng click vào nút delete_user
        // Thì submit form 
        $('.btn-submit').click(function(){
            $(this).parent().submit();
            return false;
        });

        /// Nếu sự kiện submit form xảy ra thì hỏi người dùng có chắc muốn xóa không?
        $('.form-action').submit(function(){
            if (!confirm('Bạn có chắc muốn xóa sinh viên này không?')) {
                return false;
            }
            /// Nếu người dùng chắc chắn muốn xóa thì ta thêm vào trong form-action
            /// một input hidden có giá trị là URL hiện tại, mục đích là giúp ở 
            /// trang delete sẽ lấy url này để chuyển hướng trở lại sau khi xóa xong
            $(this).append('<input type="hidden" name="redirect" value="'+window.location.href+'"/>');
             
            // Thực hiện xóa
            return true;
        });
    });
</script>


<h1>Danh sách sinh viên</h1>
<!-- ///  Chọn lớp và khoa -->
<div class="select">

    <h2>Khoa : </h2>
        <select name="select_khoa" id="select_khoa" method="POST">
            <option value="select_khoa_1">CNTT-TT</option>
            <option value="select_khoa_2">Kinh Tế</option>
            <option value="select_khoa_3">Sư Phạm</option>
        </select>


    <h2>Lớp : </h2>
        <select name="select_lop" id="select_lop" method="POST">
            <option value="select_lop_1">DI001</option>
            <option value="select_lop_2">DI002</option>
            
            <option value="select_lop_3">KT001</option>
            <option value="select_lop_4">KT002</option>
            
            <option value="select_lop_5">SP002</option>
            <option value="select_lop_6">SP003</option>
           
        </select>
    <input type="submit" id="btn-select" name="btn-select" value="Lọc">
</div>

<div class="controls">
    <a class="button" href="<?php echo create_link(base_url('admin'), array('m' => 'user', 'a' => 'add')); ?>">Thêm sinh viên</a>
</div>
<table cellspacing="0" cellpadding="0" class="form">
    <thead>
        <tr>        
            <td>MSSV</td>
            <td>HỌ VÀ TÊN</td>
            <td>NĂM SINH</td>
            <td>GIỚI TÍNH</td>
            <td>MÃ LỚP</td>
            <td>ACTION</td>
            <td>NHẬP ĐIỂM</td>
        </tr>
    </thead>
    <tbody>
        <?php /// VỊ TRÍ 02: CODE HIỂN THỊ NGƯỜI DÙNG ?>
        <?php 
        var_dump($query);
        while ($data = mysqli_fetch_array($query)) {
            $i = 1;
            $mssv = $data['mssv'];
            ?>
        <tr>
            <td><?php echo $mssv; ?></td>
            <td><?php echo $data['hovaten']; ?></td>
            <td><?php echo $data['namsinh']; ?></td>
            <td><?php echo $data['gioitinh']; ?></td>
            <td><?php echo $data['malop']; ?></td>
            <td>
                <form method="POST" class="form-action" action="<?php echo create_link(base_url('admin/index.php'), array('m' => 'user', 'a' => 'delete')); ?>">
                    <a href="<?php echo create_link(base_url('admin'), array('m' => 'user', 'a' => 'edit', 'mssv' => $data['mssv'])); ?>">&#9998 Edit</a>
                    <!-- // NOTE: 2 thẻ input hidden dưới đây dùng cho phương thức Xóa -->
                    <input type="hidden" name="user_id" value="<?php echo $data['mssv']; ?>"/>
                    <input type="hidden" name="request_name" value="delete_user"/>
                    <a href="<?php echo create_link(base_url('admin'), array('m' => 'user', 'a' => 'list', 'mssv' => $data['mssv'])); ?>" class="btn-submit">Delete &#10060 </a>                                       
                </form>    
            </td>
            <td>
                <a href="<?php echo create_link(base_url('admin'), array('m' => 'user', 'a' => 'nhapdiem', 'mssv' => $data['mssv'])); ?>" class="btn-nhapdiem">Nhập điểm từng SV &#10060 </a>
            </td>
            
        </tr>
        <?php 
            $i++;// loop while
         }
        ?>
    </tbody>
</table>
 
<?php include_once('widgets/footer.php'); ?>