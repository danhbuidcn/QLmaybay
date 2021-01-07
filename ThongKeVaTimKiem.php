<html>
    <header></header>
    <style>
        form{
            margin: 0 auto;
            width: 90%;
        }
        table{
            margin: 0 auto;
            width: 100%;
            font-size: 18px;
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
        }
        #com tr td{
            background-color:lightblue;
            color: #777777;
        }
        #com tr th{
            background-color:lightseagreen;
            color:#777777;
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
        #idClick{
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
            width: 40%;
        }
        .btnControl:hover{
            background-color:blue;
        }
        #com{
            width: 100%;
            padding: 20px 50px;
        }
    </style>
    <body>
    <div class="floatLeft">
        <div style="width:100%">
            <div class="floatLeft">
                <h3 style="text-align:center;color:blue">Thống kê</h3>
            </div>
            <div class="floatRight">
                <h3 id="clock"></h3>
            </div>
        </div>
        <form action="#" method="POST" >
            <table>
                <tr>
                    <td style="width:20%;"><span>Tháng/Năm </span></td>
                    <td style="width:40%;">
                        <input type="number" name="thang" style="width:50%"><input type="number" name="nam" style="width:50%" >
                    </td>
                    <td style="width:20%;"><input type="submit" name="find" value="Tìm" class="btnControl"></td>
                </tr>
            </table>
        </form>
        <hr width="90%">
        <table id="com">
            <tr>
                <th>Tháng</th>
                <th>Tổng số chuyến bay</th>
                <th>Tổng số vé bán</th>
                <th>Doanh thu</th>
            </tr>
            <?php 
                if (isset($_POST['find'])) {
                    TimKiem();
                } else {
                    Common();
                }
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
            <a href="http://localhost/BigProject/ThongKeVaTimKiem.php"  id="idClick" >Thống kê và tìm kiếm </a><br><br>
            <a href="#">Thoát</a>
        </div>
    </div>
    <script>
        oclock();
        function oclock() {
            setInterval(function() {
                document.getElementById('clock').textContent=getTime();
            
            }, 1000);
        }
        function getTime() {
            var date = new Date(); 
            var hour = date.getHours(); 
            var minutes = date.getMinutes(); 
            var second = date.getSeconds(); 
            return (hour <= 12 ? hour : hour - 12) + ':' + 
                (minutes < 10 ? '0' + minutes : minutes) + ':' +
                (second < 10 ? '0' + second : second) +" "+
                (hour <= 12 ? 'AM' : 'PM'); 
        }
    </script>
    <?php 
        setData();
        function setData(){
            $connect=Connect();
            $date = getdate();
            $YearNow=$date['year'];
            $MonthNow=$date['mon'];
            for($i=1;$i<=12;$i++) {
                $i=$i<10?"0".(string)$i:$i;
                $Date=$YearNow."-".$i."-%";
                $dThu=0;
                $slVe=0;
                $slCB=0;
                $sqlSelect="Select * from chuyenbay Where NgayDi like '$Date' ";
                $r=mysqli_query($connect,$sqlSelect);
                while($row=mysqli_fetch_assoc($r)){
                    $dThu+=setDoanhThu($row['MaChuyenBay']);
                    $slVe+=setSLVe($row['MaChuyenBay']);
                    $slCB++;
                }
                if($i==$MonthNow){
                    getData($i,$slCB,$slVe,$dThu);
                }
            }
        }
        function setDoanhThu($MaCB){
            $connect=Connect();
            $sqlSelect="Select * FROM hoadon where MaChuyenBay='$MaCB'";
            $r=mysqli_query($connect,$sqlSelect);
            $doanhthu=0;
            while($row=mysqli_fetch_assoc($r)){
                $doanhthu+=$row['TongTien'];
            }
            return $doanhthu;
        }
        function setSLVe($MaCB){
            $connect=Connect();
            $sqlSelect="Select Sum(SoVeL1+SoVeL2) as SL FROM hoadon where MaChuyenBay='$MaCB'";
            $r=mysqli_query($connect,$sqlSelect);
            $slVe=0;
            while($row=mysqli_fetch_assoc($r)){
                $slVe+=$row['SL'];
            }
            return $slVe;
        }
        function getData($i,$slCB,$slVe,$dThu){
            $Connect=Connect();
            $time=$i."/".date('Y');
            $sqlSelect="Select * from thongke where ThangNam='$time'";
            $sqlInsert="Insert into thongke values('$time','$slCB','$slVe','$dThu')";
            $sqlUpdate="Update thongke set ('$time','$slCB','$slVe','$dThu')";
            $select=mysqli_query($Connect,$sqlSelect);
            $row=mysqli_fetch_assoc($select);
            if($row!="NULL"){
                mysqli_query($Connect,$sqlInsert);
            }
            else{
                mysqli_query($Connect,$sqlUpdate);
            }
            mysqli_close($Connect);
        }
        function Connect(){
            $connect=new mysqli("localhost","root","12345678","qlmaybay");
            return $connect;
        }
        function Common(){
            $Connect=Connect();
            $sqlSelect="select * from thongke";
            $r=mysqli_query($Connect,$sqlSelect);
            $str="";
            while($row=mysqli_fetch_assoc($r)){
                $str.="<tr><td>".$row['ThangNam']."</td>"
                ."<td>".$row['SLChuyenBay']."</td>"
                ."<td>".$row['SLVeBan']."</td>"
                ."<td>".$row['DoanhThu']."</td></tr>";
            }
            echo($str);
        }
        function TimKiem(){
            $thang=$_POST['thang'];
            $nam=$_POST['nam'];
            $Connect=Connect();
            $time='%'.$thang.'/'.$nam;
            $sqlSelect="Select * from thongke where ThangNam like '$time'";
            $r=mysqli_query($Connect,$sqlSelect);
            $str="";
            while($row=mysqli_fetch_assoc($r)){
                $str.="<tr><td>".$row['ThangNam']."</td>"
                ."<td>".$row['SLChuyenBay']."</td>"
                ."<td>".$row['SLVeBan']."</td>"
                ."<td>".$row['DoanhThu']."</td></tr>";
            }
            echo($str);
        }
    ?>
</body>
</html>