<?php 
    if (!defined('IN_SITE')) die ('The request not found'); ?>
<?php    include_once("widgets/header.php"); ?>
<?php db_connect();  ?>
<?php
    /// Kiểm tra người dùng nhấn vào nút submit chưa
    if (isset($_POST["btn-submit"])) {
        // lấy thông tin từ các form bằng phương thức POST
        $hovaten  = $_POST["hovaten"];
        $namsinh  = $_POST["namsinh"];
        $gioitinh = $_POST["gioitinh"];
        $malop    = $_POST['malop'];
        
        // Lấy giá trị của biến mssv từ FORM thông qua POST
        $mssv = $_POST["mssv"];
        // Viết câu lệnh cập nhật thông tin người dùng
        $sql = "UPDATE sinh_vien SET hovaten = '$hovaten', namsinh = '$namsinh', gioitinh = '$gioitinh', malop = '$malop' WHERE mssv = '$mssv'";
        // thực thi câu $sql với biến conn lấy từ file connection.php
        mysqli_query($conn,$sql);
        // Sau khi cập nhật dữ liệu thì chuyển sang trang list.php
        redirect(base_url('admin/?m=user&a=list'));
    }
    // Ban đầu khởi tạo biến mssv = '' . 
    // Nếu k có trên thanh URL thì k có dữ liệu và trang đó trống 
    $mssv = '';
	if (isset($_GET['mssv'])) {
		$mssv = $_GET['mssv'];
    }
    // Chọn trong CSDL xem có biến mssv nào khác -1 thì thực hiện truy vấn 
    $sql = "SELECT * FROM sinh_vien WHERE mssv = '$mssv'";
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
        $mssv = $data['mssv'];         // NOTE: Ở đây dựa vào $key là mssv
    }

?>
<h1>Chỉnh sửa thông tin sinh viên</h1>
    <form action="<?php create_link(base_url('admin'), array('m' => 'user', 'a' => 'edit', 'mssv' => $data['mssv'])); ?>" method="POST">
        <table>
            <tr>
                <td colspan="2">
                    
                    <input type="hidden" name="mssv" value="<?php echo $mssv; ?>">
                </td>
            </tr>
            <tr>
                <td>Họ và tên : </td>
                <td><input type="text" name="hovaten" id="hovaten" value="<?php echo $data['hovaten']; ?>"></td>
            </tr>
            <tr>
                <td>Năm sinh : </td>
                <td><input type="text" name="namsinh" id="namsinh" value="<?php echo $data['namsinh']; ?>"></td>
            </tr>
            <tr>
                <td>Giới tính : </td>
                <td><input type="text" name="gioitinh" id="gioitinh" value="<?php echo $data['gioitinh']; ?>"></td>
            </tr>
            <tr>
                <td>Mã lớp : </td>
                <td><input type="text" name="malop" id="malop"  value="<?php echo $data['malop']; ?>"></td>
            </tr>
            
            <tr>
                <td colspan="2" align="center"><input type="submit" name="btn-submit" value="Lưu thông tin"></td>
            </tr>
        </table>
    </form>    

<?php    include_once("widgets/footer.php"); ?>
