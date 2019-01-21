<?php if (!defined('IN_SITE')) die ('The request not found');
    // TODO: LẤY CHI TIẾT NGƯỜI DÙNG 
    function db_user_get_by_username($username){
        $username = addslashes($username);
        $sql = "SELECT * FROM user where username = '{$username}'";
        return db_get_row($sql);
    }
    /**********************************************************************************************
     *          HÀM KIỂM TRA LỖI CHO TABLE USER
     *      
     * ********************************************************************************************
     */
    /// Hàm validate dữ liệu bảng User
    function db_user_validate($data)
    {
        // Biến chứa lỗi
        $error = array();
        
        ///* VALIDATE CĂN BẢN */
        // MSSV
        if (isset($data['mssv']) && $data['mssv'] == ''){
            $error['mssv'] = 'Bạn chưa nhập mssv';
        }
        
        // HOVATEN
        if (isset($data['hovaten']) && $data['hovaten'] == ''){
            $error['hovaten'] = 'Bạn chưa nhập hovaten';
        }

        
        // NAMSINH
        if (isset($data['namsinh']) && $data['namsinh'] == ''){
            $error['namsinh'] = 'Bạn chưa nhập namsinh';
        }
        
        // GIOITINH
        if (isset($data['gioitinh']) && $data['gioitinh'] == ''){
            $error['gioitinh'] = 'Bạn chưa nhập gioitinh';
        }
        
        // MALOP
        if (isset($data['malop']) && $data['malop'] == ''){
            $error['malop'] = 'Bạn chưa nhập malop';
        }
        
        ///* VALIDATE LIÊN QUAN CSDL */
        /// Chúng ta nên kiểm tra các thao tác trước có bị lỗi không, nếu không bị lỗi thì mới
        /// tiếp tục kiểm tra bằng truy vấn CSDL
        /// MSSV
        if (!($error) && isset($data['mssv']) && $data['mssv']){
            $sql = "SELECT count(mssv) as counter FROM sinh_vien WHERE mssv = '".addslashes($data['mssv'])."'";
            $row = db_get_row($sql);
            if ($row['counter'] > 0){
                $error['mssv'] = 'MSSV này đã tồn tại';
            }
        }
        
        /// HOVATEN
        if (!($error) && isset($data['hovaten']) && $data['hovaten']){
            $sql = "SELECT count(mssv) as counter FROM sinh_vien WHERE hovaten = '".addslashes($data['hovaten'])."'";
            $row = db_get_row($sql);
            if ($row['counter'] > 0){
                $error['hovaten'] = 'Họ và tên này đã tồn tại';
            }
        }
        
        return $error;
    }

    /**********************************************************************************************
     *              HÀM KIỂM TRA LỖI CHO TABLE LỚP HỌC PHẦN 
     *      
     * ********************************************************************************************
     */
    /// Hàm validate dữ liệu bảng Lớp học phần
    function db_class_validate($data)
    {
        // Biến chứa lỗi
        $error = array();
        
        ///* VALIDATE CĂN BẢN */
        
        // MALOP
        if (isset($data['malop']) && $data['malop'] == ''){
            $error['malop'] = 'Bạn chưa nhập malop';
        }
        // TENLOP
        if (isset($data['tenlop']) && $data['tenlop'] == ''){
            $error['tenlop'] = 'Bạn chưa nhập tenlop';
        }
        
        ///* VALIDATE LIÊN QUAN CSDL */
        /// Chúng ta nên kiểm tra các thao tác trước có bị lỗi không, nếu không bị lỗi thì mới
        /// tiếp tục kiểm tra bằng truy vấn CSDL
        /// MALOP
        if (!($error) && isset($data['malop']) && $data['malop']){
            $sql = "SELECT count(malop) as counter FROM lophp WHERE malop = '".addslashes($data['malop'])."'";
            $row = db_get_row($sql);
            if ($row['counter'] > 0){
                $error['malop'] = 'MALOP này đã tồn tại';
            }
        }
        
        /// TENLOP
        if (!($error) && isset($data['tenlop']) && $data['tenlop']){
            $sql = "SELECT count(tenlop) as counter FROM lophp WHERE tenlop = '".addslashes($data['tenlop'])."'";
            $row = db_get_row($sql);
            if ($row['counter'] > 0){
                $error['tenlop'] = 'Tên lớp này đã tồn tại';
            }
        }
        
        return $error;
    }
    // BÀI: Nhập điểm cho từng sinh viên
    /// Hàm validate dữ liệu bảng Nhập điểm
    function db_diem_validate($data)
    {
        // Biến chứa lỗi
        $error = array();
        
        ///* VALIDATE CĂN BẢN */
        // MSSV
        if (isset($data['mssv']) && $data['mssv'] == ''){
            $error['mssv'] = 'Bạn chưa nhập mssv';
        }
        
        // HOVATEN
        if (isset($data['hovaten']) && $data['hovaten'] == ''){
            $error['hovaten'] = 'Bạn chưa nhập hovaten';
        }

        //NOTE: Phần này cho Nhập điểm 
        // MAMONHOC
        if (isset($data['mamonhoc']) && $data['mamonhoc'] == ''){
            $error['mamonhoc'] = 'Bạn chưa nhập mamonhoc';
        }

        // DIEMTUNGMON
        if (isset($data['diemtungmon']) && $data['diemtungmon'] == ''){
            $error['diemtungmon'] = 'Bạn chưa nhập diemtungmon';
        }

         // DIEMTRUNGBINH HOC KY
         if (isset($data['diemtbhk']) && $data['diemtbhk'] == ''){
            $error['diemtbhk'] = 'Bạn chưa nhập diemtbhk';
        }
        
        return $error;
    }


?>