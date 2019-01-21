<?php if (!defined('IN_SITE')) die ('The request not found');

// TODO: danhsachsinhvien.php thì mình dùng biến mssv để lấy id . Còn lop.php và khoa.php thì dùng id_ 

/// Kiểm tra quyền, nếu không có quyền thì chuyển nó về trang logout
if (!is_admin()){
    redirect(base_url('admin/?m=common&a=logout'));
}
?>
 
<?php include_once('widgets/header.php'); ?>
<?php
    /// Kết nối
    db_connect();
    $sql = "SELECT * FROM diemtm";
    $query = mysqli_query($conn,$sql);

?>



<h1>KẾT QUẢ HỌC TẬP</h1>
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
<table cellspacing="0" cellpadding="0" class="form">
    <thead>
        <tr>        
            <td>STT</td>
            <td>Mã môn học</td>
            <td>Tên HP</td>
            <td>Điểm từng môn</td>
        </tr>
    </thead>
    <tbody>
        <?php /// VỊ TRÍ 02: CODE HIỂN THỊ NGƯỜI DÙNG ?>
        <?php 
            while ($data = mysqli_fetch_array($query)) {
                $i = 1;
                $stt = $data['stt'];
        ?>
        <tr>
            <td><?php echo $stt ; ?></td>
            <td><?php echo $data['mamonhoc']; ?></td>
            <td><?php echo $data['tenmonhoc']; ?></td>
            <td><?php echo $data['diem']; ?></td>
            <!-- <td>
                <form method="POST" class="form-action" action="<?php echo create_link(base_url('admin/index.php'), array('m' => 'user', 'a' => 'ketqua')); ?>">
                    <a href="<?php echo create_link(base_url('admin'), array('m' => 'user', 'a' => 'tinhdiemTB', 'mssv' => $data['mssv'])); ?>">&#9998 Tính điểm TB HK </a>
                    <a href="<?php echo create_link(base_url('admin'), array('m' => 'user', 'a' => 'ketqua', 'mssv' => $data['mssv'])); ?>" class="btn-submit">Xem kết quả &#9989 </a>
                    
                </form>
                
                
            </td> -->
        </tr>
        <?php 
                $i++;       // loop while
            }
        ?>
    </tbody>
</table>
 
<?php include_once('widgets/footer.php'); ?>