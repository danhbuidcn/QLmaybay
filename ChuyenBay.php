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
            padding: 10px;
        }
        #inforTable{
            width: 100%;
            overflow: auto;
            max-height: 500px;
        }
        select{
            padding: 10px;
            border:1px solid gray;
            border-radius: 5px 5px;
        }

    </style>
    <body>
    <div class="floatLeft">
        <div style="width:100%">
            <div class="floatLeft">
                <h3 style="text-align:center;color:blue">Tạo chuyến bay</h3>
            </div>
            <div class="floatRight">
                <h3 id="clock"></h3>
            </div>
        </div>
        <form action="#" method="POST" >
            <table>
                <tr>
                    <td><span>Mã đường bay </span></td>
                    <td>
                        <select name="MaDuongBay">
                            <option>-- : --</option>
                            <?php setDuongBay();?>
                        </select>
                    </td>
                    <td><span>Mã máy bay</span></td>
                    <td>
                        <select name="MaMayBay">
                            <option>-- : --</option>
                            <?php setMayBay();?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><span>Ngày đi</span></td>
                    <td><input type="date" name="NgayDi"></td>
                    <td><span>Ngày về</span></td>
                    <td><input type="date" name="NgayVe"></td>
                </tr>
                <tr>
                    <td><span>Giờ cất cánh</span></td>
                    <td><input type="time" name="GioCatCanh"></td>
                    <td><span>Giờ hạ cánh</span></td>
                    <td><input type="time" name="GioHaCanh"></td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td colspan="2" style="text-align:right">
                        <input type="reset" value="Hủy" class="btnControl">
                        <input type="submit" value="Tạo" class="btnControl">
                    </td>
                </tr>
            </table>
        </form>
        <hr width="90%">
        <div id="inforTable" style="width:100%">
            <table id="com">
                <tr>
                    <th>STT</th>
                    <th>Mã chuyến bay</th>
                    <th>Mã đường bay</th>
                    <th>Mã máy bay</th>
                    <th>Ngày đi</th>
                    <th>Ngày về</th>
                    <th>Giờ cất cánh </th>
                    <th>Giờ hạ cánh </th>
                    <th>Tình trạng</th>
                </tr>
                <?php 
                    getData();
                ?>
            </table>
        </div>
    </div>
    <div class="floatRight">
        <div class="navPortal">
            <h3><a href="http://localhost/BigProject/PortalManager.php" id="head">Portal Manager</a></h3>
            <a href="http://localhost/BigProject/DuongBay.php">Quản lý  đường Bay</a><br><br>
            <a href="http://localhost/BigProject/MayBay.php">Quản lý  máy Bay</a><br><br>
            <a href="http://localhost/BigProject/ChuyenBay.php" id="idClick">Quản lý  chuyến Bay</a><br><br>
            <a href="http://localhost/BigProject/QuanLyKhachHang.php">Quản lý Khách Hàng</a><br><br>
            <a href="http://localhost/BigProject/ThongTinChiTietVeDat.php">Quản lý vé máy bay</a><br><br>
            <a href="http://localhost/BigProject/ThongKeVaTimKiem.php">Thống kê và tìm kiếm</a><br><br>
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
            $MaDuongBay=isset($_POST['MaDuongBay'])?$_POST['MaDuongBay']:'';
            $MaMayBay=isset($_POST['MaMayBay'])?$_POST['MaMayBay']:'';
            $NgayDi=isset($_POST['NgayDi'])?$_POST['NgayDi']:'';
            $NgayVe=isset($_POST['NgayVe'])?$_POST['NgayVe']:'';
            $GioCatCanh=isset($_POST['GioCatCanh'])?$_POST['GioCatCanh']:'';
            $GioHaCanh=isset($_POST['GioHaCanh'])?$_POST['GioHaCanh']:'';
            if(isset($_POST['NgayDi'])){
                $day=getdate();
                $dayNow=$day['year']."-".$day['mon']."-".$day['mday'];

                if($MaDuongBay==''||$MaMayBay==''||$NgayDi==''||$NgayVe==''||$GioCatCanh==''||$GioHaCanh==''){
                    echo("<script>alert('Mời bạn nhập đầy đủ thông tin!');</script>");
                }
                else if($NgayDi==$NgayVe){
                    echo("<script>alert('Mời bạn nhập lại ngày đi và về .".
                    " Ngày đi và về phải lớn hơn ngày hiện tại');</script>");
                }
                else if(!checkMayBay($MaMayBay,$NgayDi)){
                    echo("<script>alert('Mời bạn nhập lại thời gian đi, máy bay chưa hoàn thành chuyến bay tại thời gian bạn nhập!');</script>");
                }
                else{
                    $TinhTrang="Chờ bay";
                    $MaChuyenBay=setMaChuyenBay($connect);
                    $sqlInsert="insert into chuyenbay values('$MaChuyenBay','$MaDuongBay','$MaMayBay','$NgayDi','$NgayVe','$GioCatCanh','$GioHaCanh','$TinhTrang');";
                    mysqli_query($connect,$sqlInsert);
                    createVeMayBay($MaChuyenBay);
                    echo("<script>alert('Thêm mới chuyến bay thành công !');</script>");
                    mysqli_close($connect);
                }
            }
        }
        function setMayBay(){
            $connect=Connect();
            $sqlSelect="select MaMayBay from maybay";
            $r=mysqli_query($connect,$sqlSelect);
            while($row=mysqli_fetch_assoc($r)){
                echo("<option>".$row['MaMayBay']."</option>");
            }
            mysqli_close($connect);
        }
        function checkMayBay($MaMayBay,$NgayDi){
            $connect=Connect();
            $sqlSelect="select NgayVe from chuyenbay where MaMayBay='$MaMayBay'";
            $r=mysqli_query($connect,$sqlSelect);
            $TgNhap=explode("-",$NgayDi);
            while($row=mysqli_fetch_assoc($r)){
                $NgayVe=explode("-",$row['NgayVe']);
                if($NgayVe[1]<$TgNhap[2] ||$NgayVe[1]==$TgNhap[2] && $NgayVe[2]>=$TgNhap[2]){
                    return false;
                }
            }
            return true;
        }
        function setDuongBay(){
            $connect=Connect();
            $sqlSelect="select MaDuongBay from duongbay";
            $r=mysqli_query($connect,$sqlSelect);
            while($row=mysqli_fetch_assoc($r)){
                echo("<option>".$row['MaDuongBay']."</option>");
            }
            mysqli_close($connect);
        }
        function Connect(){
            $connect=new mysqli("localhost","root","12345678","qlmaybay");
            return $connect;
        }
        function setMaChuyenBay($connect){
            $sqlSelect="select MaChuyenBay from chuyenbay";
            $r=mysqli_query($connect,$sqlSelect);
            $rowCount=mysqli_num_rows($r);
            if(empty($rowCount)){
                $MaChuyenBay="CB01";
            }
            else{
                $rowCount++;
                $STT=$rowCount<10?"0".(string)$rowCount:(string)$rowCount;
                $MaChuyenBay="CB".$STT;
            }
            return $MaChuyenBay;
        }
        function getData(){
            $connect=Connect(); 
            $sqlSelect="select * from chuyenbay";
            $r=mysqli_query($connect,$sqlSelect);
            $i=1;
            while($row=mysqli_fetch_assoc($r)){
                echo("<tr><td>".$i."</td><td>".$row['MaChuyenBay']."</td>".
                "<td>".$row['MaDuongBay']."</td>".
                "<td>".$row['MaMayBay']."</td>".
                "<td>".$row['NgayDi']."</td>".
                "<td>".$row['NgayVe']."</td>".
                "<td>".$row['GioCatCanh']."</td>".
                "<td>".$row['GioHaCanh']."</td>".
                "<td>".$row['TinhTrang']."</td>".
                "</tr>");
                $i++;
            }
        }
        function createVeMayBay($MaChuyenBay){;
            $LoaiVe=getSoLuongVe($MaChuyenBay);
            $slL1=$LoaiVe[0];
            $slL2=$LoaiVe[1];
            createVe($MaChuyenBay,$slL1,1);
            createVe($MaChuyenBay,$slL2,2);
        }
        function getSoLuongVe($MaChuyenBay){
            $connect=Connect();
            $sqlSelect="select SoGheL1,SoGheL2 from maybay mb inner join chuyenbay cb on mb.MaMayBay=cb.MaMayBay where MaChuyenBay='$MaChuyenBay' ";
            $r=mysqli_query($connect,$sqlSelect);
            $row=mysqli_fetch_array($r);

            $VeL1=$row['SoGheL1'];
            $VeL2=$row['SoGheL2'];
            $arr=[$VeL1,$VeL2];

            mysqli_close($connect);
            return $arr;
        }
        function createVe($MaChuyenBay,$sl,$index){
            $connect=Connect();
            $stt=setSTT();
            $LoaiVe=$index==1?'TG':'VT';
            $tinhTrang="chưa đặt";
            for($i=1;$i<=$sl;$i++){
                $msv=$stt+$i;
                $msv=$msv<10?'0'.(string)$msv:(string)$msv;
                $maVe='MV'.$msv;
                $a="null";
                $sqlInsert="insert into thongtinchitietve values('$maVe','$MaChuyenBay','$LoaiVe','$tinhTrang','$msv','$a','$a')";
                mysqli_query($connect,$sqlInsert);
            }
            $connect=Connect();
        }
        function setSTT(){
            $connect=Connect();
            $sqlSelect="select * from thongtinchitietve";
            $r=mysqli_query($connect,$sqlSelect);
            $rowCount=mysqli_num_rows($r);
            return $rowCount;
        }
    ?>
</body>
</html>