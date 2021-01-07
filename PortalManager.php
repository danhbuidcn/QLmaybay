<html>
    <header></header>
    <style>
        table{
            margin: 0 auto;
            width: 100%;
            font-size: 16px;
        }
        #logOut{
            color:lavenderblush;
            font-weight: 700;
        }
        h3{
            font-size: 24px;
            color: blue;
        }
        td{
            padding: 10px;
        }
        a{
            color: blue;
            font-size: 20px;
            text-decoration: none;
        }
        #head{
            font-size: 24px;
            color: orangered;
            font-weight: 700;

        }
        #com tr td{
            background-color:lightblue;
            color: #777777;
        }
        #com tr th{
            background-color:lightseagreen;
            color:#777777;
            font-size: 16px;
            padding: 10px;
        }
        .floatLeft{
            float:left;
            width:80%;
        }
        .floatRight{
            width:20%;
            float:left;
            text-align:center;
        }
        .navPortal{
            background-color: blue; 
            padding-top: 10px ;
            padding-bottom: 30px;
            border-radius: 20px 20px;
            width: 100%;
            margin-top: 10px;
            color: white;
        }
        .navPortal a{
            color:white;
        }
        .navPortal a:hover{
            color: orangered;
            font-weight: 700;
        }
        input{
            padding: 10px;
            border: 1px solid gray;
            border-radius: 5px 5px;
            width: 100%;
        }
        .btnControl{
            background-color:green;
            color: white;
            font-weight: 700;
            font-size: 15px;
        }
        .btnControl:hover{
            background-color:blue;
        }
        #com{
            width: 100%;
            padding: 20px;
        }
    </style>
    <body>
        <?php session_start(); ?>
    <div class="floatLeft">
        <div style="width:100%">
            <div class="floatLeft">
                <h3 style="text-align:center;color:blue">Danh sách chuyến bay sắp khởi hành:</h3>
            </div>
            <div class="floatRight">
                <h3 id="clock"></h3>
            </div>
        </div>
        <table id="com">
            <tr>
                <th>STT</th>
                <th>Mã chuyến bay</th>
                <th>Điểm đi</th>
                <th>Điểm đến</th>
                <th>Ngày đi</th>
                <th>Ngày về</th>
                <th>Giờ cất cánh</th>
                <th>Giờ hạ cánh</th>
                <th>Tình trạng</th>
            </tr>
            <?php 
                listItemChuyenBay();
            ?>
        </table>
    </div>
    <div class="floatRight">
        <div class="navPortal">
            <h3><a href="http://localhost/BigProject/PortalManager.php" id="head">Portal Manager</a></h3>
            <a href="http://localhost/BigProject/DuongBay.php">Quản lý đường Bay</a><br><br>
            <a href="http://localhost/BigProject/MayBay.php">Quản lý máy Bay</a><br><br>
            <a href="http://localhost/BigProject/ChuyenBay.php">Quản lý chuyến Bay</a><br><br>
            <a href="http://localhost/BigProject/QuanLyKhachHang.php">Quản lý Khách Hàng</a><br><br>
            <a href="http://localhost/BigProject/ThongTinChiTietVeDat.php">Quản lý vé máy bay</a><br><br>
            <a href="http://localhost/BigProject/ThongKeVaTimKiem.php">Thống kê và tìm kiếm</a><br><br>
            <a href="http://localhost/BigProject/DangNhapAdmin.php">Thoát</a>
        </div>
    </div>
    <script>
        oclock();
        function oclock() {
            setInterval(function() {
                document.getElementById('clock').textContent=getTime();
                document.getElementById('time').textContent=getTime();
            }, 1000);
        }
        function getTime() {
            var date = new Date(); 
            var hour = date.getHours(); 
            var minutes = date.getMinutes(); 
            var second = date.getSeconds(); 
            return hour  + ':' + 
                (minutes < 10 ? '0' + minutes : minutes) + ':' +
                (second < 10 ? '0' + second : second); 
        }
    </script>
    <?php
        autoChangeStatus();
        function Connect(){
            $connect=new mysqli("localhost","root","12345678","qlmaybay");
            return $connect;
        }
        function listItemChuyenBay(){
            $connect=Connect();
            $Date=getdate();
            $_SESSION['MaCB']='';
            $_SESSION['GioCatCanh']='';
            $sqlSelect="select MaChuyenBay,DiemDi,DiemDen,NgayDi,NgayVe,GioCatCanh,GioHaCanh,TinhTrang from chuyenbay c inner join duongbay d on c.MaDuongBay=d.MaDuongBay where  TinhTrang!='Đã bay'";
            $r=mysqli_query($connect,$sqlSelect);
            $i=1;
            while($row=mysqli_fetch_assoc($r)){
                $Time=explode("-",$row['NgayDi']);
                $mon=$Time[1];
                $day=$Time[2];
                if($Date['mon']>$mon||$Date['mon']==$mon &&$Date['mday']>$day){
                    setStatus('Đã bay',$row['MaChuyenBay']);
                }
                else if($Date['mon']==$mon && $Date['mday']==$day){
                    if($_SESSION['MaCB']=='')
                    {
                        $_SESSION['MaCB']=$row['MaChuyenBay'];
                    }
                    else 
                    {
                        $_SESSION['MaCB'].=";".$row['MaChuyenBay'];
                    }
                }
                $str="<tr><td>".$i."</td>".
                    "<td>".$row['MaChuyenBay']."</td>".
                    "<td>".$row['DiemDi']."</td>".
                    "<td>".$row['DiemDen']."</td>".
                    "<td>".$row['NgayDi']."</td>".
                    "<td>".$row['NgayVe']."</td>".
                    "<td>".$row['GioCatCanh']."</td>".
                    "<td>".$row['GioHaCanh']."</td>".
                    "<td>".$row['TinhTrang']."</td>".
                "</tr>";
                $i++;
                echo($str);
            }
            mysqli_close($connect);
        }
        function autoChangeStatus(){
            $timeNow="<span id='time'></span>";

            $MaCB=$_SESSION['MaCB'];
            $GioCatCanh=getThoiGian($MaCB,'GioCatCanh');

            $GioHaCanh=getThoiGian($MaCB,'GioHaCanh');

            $strMaCB=explode(";",$MaCB);
            $l=count($strMaCB);
            
            for($i=0;$i<$l;$i++){
                
                if(strtotime($timeNow)<strtotime($GioHaCanh) && strtotime($timeNow)>strtotime($GioCatCanh)){
                    setStatus('Đang bay',$strMaCB[$i]);
                }
                else if(strtotime($timeNow)>strtotime($GioHaCanh)){
                    setStatus('Đã bay',$strMaCB[$i]);
                }
            }
        }
        function setStatus($status,$MaCB){
            $connect=Connect();
            $sqlUpdate="update chuyenbay set TinhTrang='$status' where MaChuyenBay='$MaCB'";
            mysqli_query($connect,$sqlUpdate);
            mysqli_close($connect);
        }
        function getThoiGian($MaCB,$Time){
            $connect=Connect();
            $sqlSelect="Select * from chuyenbay where MaChuyenBay='$MaCB'";
            $r=mysqli_query($connect,$sqlSelect);
            $row=mysqli_fetch_assoc($r);
            $time=$row[$Time];
            mysqli_close($connect);
            return $time;
        }
    ?>
    </body>
</html>