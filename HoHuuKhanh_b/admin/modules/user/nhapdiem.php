<?php if (!defined('IN_SITE')) die ('The request not found'); ?>
 
<?php
// Kiểm tra quyền, nếu không có quyền thì chuyển nó về trang logout
if (!is_admin()){
    redirect(base_url('admin'), array('m' => 'common', 'a' => 'logout'));
}
?>
 
<?php   
    //TODO: Select dữ liệu ra từ db_monhoc
        db_connect();
        $sql = "SELECT * FROM monhoc";
        var_dump($sql);
        $result = mysqli_query($conn,$sql);
        echo "<pre>";
        print_r($result);
        echo "</pre>";
    //TODO: 
    /************************************************************************************************************************************************
     * 
     * //NOTE: Nếu mà bỏ PRIMARY KEY của table "diemtm" thì insert vào được mà nó bị trùng khóa
     * 
     * **********************************************************************************************************************************************
     */
    // Bị gì
    /**
     * t chỉ lấy dducc cái mảng cuối thôi . không lấy đc cái mảng đầu
     */
    
    //REVIEW: tới đoạn xử lý code nhập  
        // Biến chứa lỗi
        $error = array();
    /// VI TRI 1: CODE SUBMIT FORM
        if (is_submit('add_diem')) {
            // Lấy danh sách dữ liệu từ form 
            echo "POST: ";
            echo ("<pre>");
            var_dump($_POST);
            echo ("</pre>");
            $data = array(
                'stt'           =>  $_POST['stt'],
                'mamonhoc'      =>  $_POST['mamonhoc'],
                'tenmonhoc'     =>  $_POST['tenmonhoc'],
                'diem'          =>  $_POST['diem']
            );
            // $key = time();  // cmt n
            // foreach ($data as $key => $value) {
            //     echo $key . '=>' . $value;
            //     echo "<br>";
            // }
            echo "<b>Tại sao mảng data chỉ lấy được thằng cuối !</b>";
            echo "Mang data : "; 
            var_dump($data);
            echo "<br>";
            // require file xử lý cho user 
            require_once('database/user.php');

            // Thực hiện validate
            $error = db_diem_validate($data);
            // Nếu validate không có lỗi 
            if (!$error) {
                // Nếu insert thành công thì thông báo 
                // Và chuyển hướng về trang list.php

                if (db_insert_multiple('diemtm',$data)) {
                    ?>
                    <script language="javascript">
                        alert('Nhập điểm thành công');
                        window.location = '<?php echo create_link(base_url('admin') , array('m' => 'user' , 'a' => 'list'));    ?>'
                    </script>
                    <?php   
                        echo ("Khong nhap diem dc ");
                }
            }

        }
?>
 
<?php include_once('widgets/header.php'); ?>
 
<h1>Nhập điểm từng môn cho sinh viên</h1>
 
<div class="controls" style="text-align: right;">
    <a class="button" onclick="$('#main-form-diem').submit()" href="#">Lưu</a>
    <a class="button" href="<?php echo create_link(base_url('admin'), array('m' => 'user', 'a' => 'list')); ?>">Trở về</a>
</div>
 
<form id="main-form-diem" method="post" action="<?php echo create_link(base_url('admin/index.php'), array('m' => 'user', 'a' => 'nhapdiem')); ?>">
    <input type="hidden" name="request_name" value="add_diem"/>
    <table class="form" style="table: width: 100%; table,th,td:border:1px solid black;">
        <thead>
            <tr>
                <th>STT</th>
                <th>Mã HP</th>
                <th>Tên HP</th>
                <th>Điểm từng môn</th>
            </tr>
        </thead>

        <tbody>
            <?php   /// VI TRI 02: CODE HIỂN THỊ NGƯỜI DÙNG ?>
            <?php
                // var_dump($result);
                $i = 1;
                while ($data = mysqli_fetch_array($result)) {
                    echo "<pre>";
                    var_dump($data);
                    //print_r($result);
                    echo "<br>";
                    
            ?>
            <tr>
                <td>
                    <input type="text" name="stt<?php echo $i ?>" value="<?php echo $data['stt']; ?>">
                </td>
                <td>
                    <input type="text" name="mamonhoc<?php echo $i ?>" value="<?php echo $data['mamonhoc']; ?>">
                </td>
                <td>
                    <input type="text" name="tenmonhoc<?php echo $i ?>" value="<?php echo $data['tenmonhoc']; ?>">
                </td>
                <td>
                    <input type="text" name="diem<?php echo $i ?>" value="<?php echo input_post('diem'); ?>">
                </td>
                <!-- mấy thuộc tính name là tên biến, mỗi vòng for m dặt tên biến giống nhau nó ghi đè lên nhau r
                    là sao? có ffor nào đâu? while đó, vậy sửa sao?
                    nhập mỗi môn lưu 1 lần chứ ko lưu tất cả đc.
                    đù , 1 thg sv học all các môn là phải lưu hết ln chứ cu
                    thấy nó giống nhau k, giống gì đâu ta ?
                    wtf, 2 cái name của 2 ô y chang nhau sao no biết ô nào ?
                    sr , m làm lại cái t coi lại vs m :
                    hồi trưa t kêu nhập cùng 1 môn cho nhiều sv khác nhau mà
                    đề là : 1 sv học all các môn trong khoa , là phải nhập hết các môn trong khoa cho 1 sv chứ , nó nhập theo sv chứ đâu phải nhập theo môn 
                    giống như thg sv 1 , rồi bấm vào xem nó học môn gì xong r nhập điểm cho nó ln , rồi save lên hệ thống , 
                    hiểu r mà làm v khó vl
                    mà nó phải in ra 2 lần chứ
                    nó vẫn in ra 2 lần mà m?
                    bây giờ nó còn đè lại thg trước nữa k m?
                    thấy gì chưa
                    i see :v
                    giờ lấy đc 2 cái r đó mà nó nằm v sao set data
                    nằm vậy là nằm sao?

                    2 điểm nò nằm lien tục chứ ko nằm ra 2 mảng rời
                    ok thấy r , 
                    m sửa đi t về nhà cái, quán đóng cửa :))
                    ok về đi tí tiếp hả gì?
                    vè nhà ko biết mạng xài đc ko  nữa
                    vkl . ok v về đi r có gì ib t 
                    OKe, veveef đây
                 -->
            </tr>
            <?php
                 $i++;
                }
            ?>
        </tbody>
        
       
    </table>
</form>
 
<?php include_once('widgets/footer.php'); ?>
