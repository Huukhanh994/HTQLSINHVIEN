<?php 
    if (!defined('IN_SITE')) die ('The request not found'); ?>
<?php    include_once("widgets/header.php"); ?>
<?php db_connect();  ?>
<?php
    /// Kiểm tra người dùng nhấn vào nút submit chưa
    if (isset($_POST["btn-submit"])) {
        // lấy thông tin từ các form bằng phương thức POST
        $malop  = $_POST["malop"];
        $tenlop  = $_POST["tenlop"];
        
        // Lấy giá trị của biến "malop" từ FORM thông qua POST
        $malop = $_POST["malop"];
        // Viết câu lệnh cập nhật thông tin người dùng
        $sql = "UPDATE lophp SET malop = '$malop', tenlop = '$tenlop' WHERE malop = '$malop'";
        // thực thi câu $sql với biến conn lấy từ file connection.php
        mysqli_query($conn,$sql);
        // Sau khi cập nhật dữ liệu thì chuyển sang trang list.php
        redirect(base_url('admin/?m=user&a=lop'));
    }
    // Ban đầu khởi tạo biến mssv = '' . 
    // Nếu k có trên thanh URL thì k có dữ liệu và trang đó trống 
    $malop = '';
	if (isset($_GET['malop'])) {
		$malop = $_GET['malop'];
    }
    // Chọn trong CSDL xem có biến mssv nào khác -1 thì thực hiện truy vấn 
    $sql = "SELECT * FROM lophp WHERE malop = '$malop'";
    //echo $sql;
    $query = mysqli_query($conn,$sql);
    if (!$query) {
        echo('Lỗi :') . mysqli_error($conn);
        exit();
    }

?>

<?php
    /// Thực hiện lấy dữ liệu từ câu $query và gán vào giá trị của form hiện tại     
    while ($data = mysqli_fetch_array($query)) {
        $i = 1;
        $malop = $data['malop'];         // NOTE: Ở đây dựa vào $key là malop
    }

?>
<h1>Chỉnh sửa thông tin lớp HP</h1>
    <form action="<?php create_link(base_url('admin'), array('m' => 'user', 'a' => 'edit_class', 'malop' => $data['malop'])); ?>" method="POST">
        <table>
            <tr>
                <td colspan="2">
                    
                    <input type="hidden" name="malop" value="<?php echo $malop; ?>">
                </td>
            </tr>
            <tr>
                <td>Mã lớp : </td>
                <td><input type="text" name="malop" id="malop" value="<?php echo $data['malop']; ?>"></td>
            </tr>
            <tr>
                <td>Tên lớp : </td>
                <td><input type="text" name="tenlop" id="tenlop" value="<?php echo $data['tenlop']; ?>"></td>
            </tr>
            
            <tr>
                <td colspan="2" align="center"><input type="submit" name="btn-submit" value="Lưu thông tin"></td>
            </tr>
        </table>
    </form>    

<?php    include_once("widgets/footer.php"); ?>
