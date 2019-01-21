
<select name="txthk"> 
<?php
    $sql = mysql_query("SELECT hocky_id, tenhocky FROM hocky");
    $hkhientai = isset($_POST['txthk']) ? $_POST['txthk'] : FALSE;
    while($row = mysql_fetch_array($sql)){
        echo "<option value =    '". $row['hocky_id']."'     ", $hkhientai == $row['hocky_id'] ? "selected='selected'" : '',">", $row['tenhocky']."</option>";
    }?>
</select>

<tr>
    <td>Toán</td>   
<?php if($_SESSION['quyen']=='Học sinh'){?>
<?php $query="SELECT diem FROM diemmon,hocky WHERE hocsinh_id = '".$_SESSION['nguoidung']."'  diemmon.hocky_id=hocky.hocky_id and monhoc_id='MH01'" ; 
    if(isset($_POST['txthk']))
    {
    //if($_POST['txthk']==$hkhientai)
        $query .= " AND hocky.hocky_id = '".$_POST['txthk']."'";	
    }
    $sql=mysql_query($query);
    $tong_toan = array();
    while($row=mysql_fetch_array($sql))     {   ?>
        <td><?php $tong_toan[] = $row['diem'];	
                  echo $row['diem'];	?></td>
        <?php
    }
    ?>
    <td><?php 
    $tb_toan = round(($tong_toan[0] + $tong_toan[1] + $tong_toan[2]*2 + $tong_toan[3]*3) / 7, 1);
    echo $tb_toan; ?></td>
</tr>
