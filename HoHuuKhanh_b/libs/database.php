<!-- // TODO: GIAO DIỆN XỬ LÝ NGƯỜI DÙNG  -->
<!-- // BÀI: 3 -->
<?php
if (!defined('IN_SITE')) die ('The request not found');
    /// Biến lưu trữ kết nối
    $conn = null;
   
    // Hàm kết nối
    function db_connect(){
        global $conn;
        if (!$conn){
            $conn = mysqli_connect('localhost', 'root', '', 'khanh') 
                    or die ('Không thể kết nối CSDL');
            mysqli_set_charset($conn, 'UTF-8');
            //var_dump($conn);
        }
    }
    
    // Hàm ngắt kết nối
    function db_close(){
        global $conn;
        if ($conn){
            mysqli_close($conn);
        }
    }
    
    /// Hàm lấy danh sách, kết quả trả về danh sách các record trong một mảng
    function db_get_list($sql){
        db_connect();
        global $conn;
        $data  = array();
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)){
            $data[] = $row;
        }
        return $data;
    }
    
    /// Hàm lấy chi tiết, dùng select theo ID vì nó trả về 1 record
    function db_get_row($sql){
        db_connect();
        global $conn;
        $result = mysqli_query($conn, $sql);
        $row = array();
        if (mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
        }    
        return $row;
    }
        
    /// Hàm thực thi câu truy  vấn insert, update, delete
    function db_execute($sql){
        db_connect();
        global $conn;
        return mysqli_query($conn, $sql);
        // Thực thi chỉ trả về true or false
    }
    // BÀI: 13 THÊM NGƯỜI DÙNG 
    /// Hàm insert dữ liệu vào table 
    function db_insert($table,$data = array()){
        // Khởi tạo 2 biến lưu $thuoctinh và $giastri 
        $fields = '';
        $values = '';

        // Lặp mảng dữ liệu để nối chuỗi 
        foreach ($data as $key => $value) {
            $fields .= $key .',';         // nhìu thuộc tính đc nối từ các thuộc tính con 
            $values .= "'" .addcslashes($value,"w") ."',";
        // Ví dụ cho mảng này :
        // $data = array(
        //     'mssv'      =>  $_POST['mssv'],
        //     'hovaten'   =>  $_POST['hovaten'],
        //     'namsinh'   =>  $_POST['namsinh'],
        //     'gioitinh'  =>  $_POST['gioitinh'],
        //     'malop'     =>  $_POST['malop']
        // );
        /**
         *  $field => mssv,hovaten,namsinh,gioitinh,malop,
         *  $values => 'mssv','hovaten','namsinh','gioitinh','malop',
         */
        }

        // Xóa kí tự dấu phẩy , ở đầu và cuối chuỗi.
        $fields = trim($fields,',');
        $values = trim($values,',');

        // Tạo câu SQL
        $sql = "INSERT INTO {$table}($fields) VALUES ({$values})";
        // Ví dụ:
        /**
         *  INSERT INTO sinhvien(mssv,hovaten,namsinh,gioitinh,malop) 
         *  VALUES(mssv','hovaten','namsinh','gioitinh','malop');
         */

        // Thực hiện insert 
        return db_execute($sql);
    }

    //NOTE:INSERT Nhiều records lại 
    function db_insert_multiple($table,$data = array()){
        db_connect();
        global $conn;
        // Khởi tạo 2 biến lưu $thuoctinh và $giastri 
        $fields = '';
        $values = '';
        
        // Lặp mảng dữ liệu để nối chuỗi 
        //TODO: thiết lập key là time() để khi insert vào sẽ không bị trùng key . 
        //$key = time();
        foreach ($data as $key => $value) {
            $fields .=$key.',';         // nhìu thuộc tính đc nối từ các thuộc tính con 
            //echo $key;
            $values .="'".addcslashes($value,"w")."',";
        // Ví dụ cho mảng này :
        // $data = array(
        //     'mssv'      =>  $_POST['mssv'],
        //     'hovaten'   =>  $_POST['hovaten'],
        //     'namsinh'   =>  $_POST['namsinh'],
        //     'gioitinh'  =>  $_POST['gioitinh'],
        //     'malop'     =>  $_POST['malop']
        // );
        /**  Kết quả ở trên sẽ là:
         *  $field => mssv,hovaten,namsinh,gioitinh,malop,
         *  $values => 'mssv','hovaten','namsinh','gioitinh','malop',
         */
        // var_dump($fields);
        // echo '<br>';
        // echo '<br>';
        // var_dump($values);
        // echo "<br>";
        }

        // Xóa kí tự dấu phẩy , ở đầu và cuối chuỗi.
        $fields = trim($fields,',');
        $values = trim($values,',');

        // Tạo câu SQL
        $sql = "INSERT INTO {$table}($fields) VALUES ({$values});";
        $sql .= "INSERT INTO {$table}($fields) VALUES ({$values});";
        var_dump($values);
        echo "<br>";
        if(mysqli_multi_query($conn,$sql)){
            echo "Insert nhieu record thanh cong";
        }else{
            echo " Error : " . $sql . "</br>" .mysqli_error($conn);
        }
        // Ví dụ:
        /**
         *  INSERT INTO sinhvien(mssv,hovaten,namsinh,gioitinh,malop) 
         *  VALUES(mssv','hovaten','namsinh','gioitinh','malop');
         */

        // Thực hiện insert 
        // return db_execute($sql);
    }
        


?>