<?php if (!defined('IN_SITE')) die ('The request not found'); ?>
<?php
    require_once('../libs/database.php');
    /// Nếu ngdung submit delete user
    if (is_submit('delete_user')) {
        // Lấy mssv 
        // if(!$conn){
        //     echo("Faile: " . mysqli_error($conn));
        // }
        //$user = "SELECT * FROM sinhvien WHERE mssv = $mssv";
        if (isset($_POST['user_id'])) { 
            $mssv = $_POST['user_id'];
            db_connect();
            $sql = 'DELETE FROM sinh_vien where mssv="' . $mssv . '"';
            $result = mysqli_query($conn,$sql);
            echo $sql;
            // var_dump(db_execute());
            var_dump($result);
            if ($result) {
                ?>
                <script>
                    alert('Xóa thành công');
                    window.location = '<?php echo create_link(base_url('admin') , array('m' => 'user' , 'a' => 'list'));    ?>'
                </script>
                <?php
            }else {
                ?>
                <script>
                    alert('Xóa thất bại');   
                    window.location = '<?php echo create_link(base_url('admin') , array('m' => 'user' , 'a' => 'list'));    ?>'
                </script>
                <?php
            }
        }
        
    }else {
        redirect(base_url('admin'));
    }

?>