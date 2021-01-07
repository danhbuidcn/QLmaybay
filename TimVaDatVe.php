<html>
<header></header>
<body>
    <style>
        body {
            width: 100%;
            margin: 0 auto;
            padding: 0;
        }
        form{
            width: 100%;
            margin:0 auto;
        }
        #container {
            background-color: #1288c1;
            padding: 10px;
            margin: 0 auto;
        }
        #listMayBay{
            padding: 20px;
            margin: 0 auto;
        }
        h2 {
            text-align: center;
            color: white;
        }
        caption{
            text-align: center;
            color: blue;
            font-size: 24px;
            font-weight: 700;
        }
        table {
            background-color: #FFFFFF;
            color: #1288c1;
            margin: 0 auto;
            width: 100%;
        }
        th{
            padding: 10px;
        }
        td{
            padding: 10px;
        }
        #listMayBay th {
            background-color:lightseagreen;
            color:#777777;
            padding: 10px;
        }
        #listMayBay td {
			padding: 10px;
            background-color:lightblue;
            color: #777777;
        }
        #subtb {
            font-size: 20px;
        }
        #subtb span {
            color: blue;
        }
        #subtb button {
            font-weight: 700;
            font-size: 20px;
            padding: 5px;
            background-color: yellow;
            border: 1px solid yellow;
        }
        .enText {
            border: none;
            width: 90%;
            padding: 10px;
        }
        #submit {
            text-align: center;
            background-color: orange;
            margin: 0 auto;
            font-size: 20px;
            font-weight: 700;
            padding: 10px;
            color: #fff;
            width: 90%;
            background-color: f36f21;
            border: 1px solid gray;
            border-radius: 10px 10px;
        }
        #close{
            text-align: right;
            font-weight: 700;
        }
        #close button{
            background-color: gray;
            color: white;
            font-weight: 700;
            border-radius: 5px 5px;
            border: 1px solid gray ;
            text-align: center;
            padding: 10px;
        }
        #close button:hover{
            background-color: blueviolet;
        }
        input{
            padding: 10px;
            border: 1px solid gray;
            border-radius: 5px 5px;
        }
        #listVeMB tr td{
            background-color:blue;
            color: white;
        }
        #listVeMB tr th{
            background-color:lightseagreen;
            color:#777777;
            padding: 10px;
        }
        .blank{
            background-color: white !important;
        }
        .tdtitle{
            background-color:lightseagreen !important;
            color:#777777 !important;
        }
        #acceptBook{
            background-color: orangered;
            color: white;
            font-weight: 700;
            font-size: 20px;
            padding: 10px 20px;
            border-radius: 5px 5px;
            border:1px solid orangered ;
            text-decoration: none;
        }
        #acceptBook:hover{
            background-color: blue;
        }
        #login{
            margin:0 auto;
            width: 50%;
            padding: 50px 0;
        }
        input[name='clickLogin']{
            background-color: orange;
            color: white;
            font-weight: 700;
        }
    </style>
    <?php session_start(); ?>
        <form action="http://localhost/BigProject/TimVaDatVe.php" method="POST">
        <div id="container">
        <h2>TÌM & ĐẶT VÉ MÁY BAY​</h2>
            <table cellpadding="10">
                <tr>
                    <th>1.CHỌN HÀNH TRÌNH</th>
                    <th>2.CHỌN NGÀY BAY</th>
                    <th>3.CHỌN HÀNH KHÁCH</th>
                </tr>
                <tr>
                    <td>
                        <span style="font-size:20px;color:blue;">Điểm đi</span><br>
                        <select class="enText" name="diemDi"><?php setDiemDi();?></select><br>
                        <span style="font-size:20px;color:blue;">Điểm đến</span><br>
                        <select class="enText" name="diemDen"><?php setDiemDen();?></select><br>
                    </td>
                    <td>
                        <span style="font-size:20px;color:blue;">Ngày đi</span><br>
                        <input type="date" class="enText" name="ngayDi"><br>
                        <span style="font-size:20px;color:blue;margin-right:10px">Ngày về</span>
                        <input type="date" class="enText" name="ngayVe"><br>
                    </td>
                    <td>
                        <span style="font-size:20px;color:blue">Số lượng hành khách</span><br>
                        <table id="subtb" cellpadding="10">
                            <tr>
                                <td id="one">
                                    <p>Người lớn</p>
                                    <input type="button" value="-" onclick="btn0()">
                                    <span id="lon">1</span><input type="hidden" id="ngLon" value="1" name="ngLon">
                                    <input type="button" value="+" onclick="btn1()">
                                </td>
                                <td id="two">
                                    <p>Trẻ em</p>
                                    <input type="button" value="-" onclick="btn2()">
                                    <span id="em">1</span><input type="hidden" id="treEm" value="1" name="treEm">
                                    <input type="button" value="+" onclick="btn3()">
                                </td>
                                <td id="three">
                                    <p>Em bé</p>
                                    <input type="button" value="-" onclick="btn4()">
                                    <span id="be">1</span><input type="hidden" id="emBe" value="1" name="emBe">
                                    <input type="button" value="+" onclick="btn5()">
                                </td>
                            </tr>
                        </table>
                        <input id="submit" type="submit" name='TimCB' value="Tìm chuyến bay">
                    </td>
                </tr>
            </table>
    </div>
    <?php
        Action();
        function Action(){
            if($_POST){
                if (isset($_POST['TimCB'])) {
                    TimChuyenBay();
                } else if (isset($_POST['DatVe'])) {
                    getDSCB();
                }
                else if(isset($_POST['acceptBook'])){
                    acceptBook();
                } 
                else if(isset($_POST['clickLogin'])){
                    getThongTinDatVe();
                }
            }
        }
        function TimChuyenBay(){
            $arr=getInputForm();
            if(isset($_POST['diemDi'])){
                if($arr[0]=='--:--'||$arr[1]=='--:--'||$arr[2]==''||$arr[3]==''){
                    echo("<script>alert('Mời bạn nhập đầy đủ thông tin !');</script>");
                }
                else if(!checkDay($arr[2],$arr[3])){
                    echo("<script>alert('Mời bạn nhập lại ngày đi và về !');</script>");
                }
                else{
                    $connect=Connect();
                    $sqlSelect="select MaChuyenBay,DiemDi,DiemDen,NgayDi,NgayVe,GioCatCanh,GioHaCanh from chuyenbay cb inner join duongbay db on db.MaDuongBay=cb.MaDuongBay where DiemDi='$arr[0]' and DiemDen='$arr[1]' and TinhTrang='Chờ Bay'";
                    $r=mysqli_query($connect,$sqlSelect);
                    hiddenBackGround();
                    getDSChuyenBay($r);
                    mysqli_close($connect);
                }
            }
        }
        function getDSChuyenBay($r){
            $str="<div id='listMayBay'><p id='close'><button onclick='Close()'>Thoát</button></p>";
            $str.="<table><caption><span style='text-align:left;'>Chọn chuyến bay</span><div style='text-align:right;'><input type='text' name='MaCB' id='getMaCB'><input type='submit' name='DatVe' value='Đặt Vé'onclick='TimVe()'></div></caption><tbody>";
            $str.="<tr><th>Mã chuyến bay</th><th>Điểm đi</th><th>Điểm đến</th><th>Ngày đi</th><th>Ngày về</th><th>Giờ cất cánh</th><th>Giờ hạ cánh</th></tr>";
            while($row=mysqli_fetch_assoc($r)){
                $ma=$row['MaChuyenBay'];
                $str.="<tr onclick=\"getMaCB('$ma')\"><td>".$row['MaChuyenBay']."</td>".
                "<td>".$row['DiemDi']."</td>".
                "<td>".$row['DiemDen']."</td>".
                "<td>".$row['NgayDi']."</td>".
                "<td>".$row['NgayVe']."</td>".
                "<td>".$row['GioCatCanh']."</td>".
                "<td>".$row['GioHaCanh']."</td>".
                "</tr>";
            }
            $str.="</tbody></table></div><input type='hidden' name='DSCB' id='DSCB'>";
            echo($str);
        }
        function hiddenBackGround(){
            echo("<script>document.getElementById('container').style.display='none';</script>");
        }
        function getInputForm(){
            $diemDi=isset($_POST['diemDi'])?$_POST['diemDi']:'';
            $diemDen=isset($_POST['diemDen'])?$_POST['diemDen']:'';
            $ngayDi=isset($_POST['ngayDi'])?$_POST['ngayDi']:'';
            $ngayVe=isset($_POST['ngayVe'])?$_POST['ngayVe']:'';
            $ngLon=isset($_POST['ngLon'])?$_POST['ngLon']:'';
            $treEm=isset($_POST['treEm'])?$_POST['treEm']:'';
            $emBe=isset($_POST['emBe'])?$_POST['emBe']:'';
            $arr=[$diemDi,$diemDen,$ngayDi,$ngayVe,$ngLon,$treEm,$emBe];
            return $arr;
        }
        function Connect(){
            $connect=new mysqli("localhost","root","12345678","qlmaybay");
            return $connect;
        }
        function setDiemDi(){
            $connect=Connect();
            $sqlSelect="select distinct DiemDi from duongbay";
            $r=mysqli_query($connect,$sqlSelect);
            echo("<option>--:--</option>");
            while($row=mysqli_fetch_assoc($r)){
                echo("<option>".$row['DiemDi']."</option>");
            }
        }
        function setDiemDen(){
            $connect=Connect();
            $sqlSelect="select distinct DiemDen from duongbay";
            $r=mysqli_query($connect,$sqlSelect);
            echo("<option>--:--</option>");
            while($row=mysqli_fetch_assoc($r)){
                echo("<option>".$row['DiemDen']."</option>");
            }
        }
        function checkDay($NgayDi,$NgayVe){
            $day=getdate();
            $dayNow=$day['year']."-".$day['mon']."-".$day['mday'];
            if($NgayDi==$dayNow || $NgayDi==$NgayVe){ 
                return false;
            }
            return true;
        }

        function getDSCB(){
            $connect=Connect();
            $macb=isset($_POST['MaCB'])?$_POST['MaCB']:'';
            if(isset($_POST['MaCB'])){
                $sqlSelect="select * from thongtinchitietve where MaChuyenBay='$macb' ORDER BY SoVe ASC";
                $r=mysqli_query($connect,$sqlSelect);
                if($macb==''){
                    echo("<script>alert('bạn chưa chọn chuyến bay !');</script>");
                }
                else{ 
                    $_SESSION['maCB']=$macb;
                    displayDSVe($macb,$r);
                    hiddenBackGround();
                    mysqli_close($connect);
                }
            }
        }
        function displayDSVe($macb,$r){
            $i=1;
            $titleTb="<div id='listVeMB'><p id='close'><button onclick='Close()'>Thoát</button></p>";
            $titleTb.='<table style="width:90%"><caption>Mã chuyến bay : '.$macb.' <br><i>(red:booked, orange:pending, green:Vip, gray: cancel)</i></caption>';
            echo($titleTb);
            $str="";
            $str.='<tr><th>STT</th><th>A</th><th>B</th><th>C</th><th>D</th><th>E</th><th style="background-color:white;"></th><th>F</th><th>G</th><th>H</th><th>I</th><th>K</th></tr><tr>';
            while($row=mysqli_fetch_assoc($r)){
                $status=$row['TinhTrangVe'];
                $loaiVe=$row['LoaiVe'];
                $mv=$row['MaVe'];
                if($i%10==0){
                    if($status=='pending'){$str.="<td style='background-color:red'>";}
                    else if($status=='booked'){$str.="<td style='background-color:red'>";}
                    else if($loaiVe=='TG'){$str.="<td style='background-color:green' id='$mv' onclick=\"Chose('$mv')\">";}
                    else {$str.="<td id='$mv' onclick=\"Chose('$mv')\">";}
                    $str.=$mv."</td></tr><tr>";
                }
                else{
                    $tt=($i-1)/10+1;
                    ($i-1)%10==0?$str.="<td class='tdtitle'>".$tt."</td>":"";
                    if($status=='pending'){$str.="<td style='background-color:red'>";}
                    else if($status=='booked'){$str.="<td style='background-color:red'>";}
                    else if($loaiVe=='TG'){$str.="<td style='background-color:green' id='$mv' onclick=\"Chose('$mv')\">";}
                    else {$str.="<td id='$mv' onclick=\"Chose('$mv')\">";}
                    $str.=$row['MaVe']."</td>";
                    $i%5==0?$str.="<td class='blank'>".'&nbsp;'."</td>":"";
                }
                $i++;
            }
            $str.="<tr><td colspan='11'  class='blank'><span id='spanBooking'></span><input type='hidden' id='booking' name='booking'></td></tr></table>";
            $str.="<p  style='text-align:center;'><input type='submit' onclick='acceptBookJS()' name='acceptBook' value='Xác nhận đặt Vé' id='acceptBook'></p></div>";
            echo($str);
        }
        function acceptBook(){
            $dsVe=isset($_POST['booking'])?$_POST['booking']:'';
            if($dsVe==''){
                echo("<script>alert('Bạn chưa chọn vé đặt');</script>");
                return;
            }
            else{
                loginUser($dsVe);
            }
        }
        function getThongTinDatVe(){
            $connect=Connect();
            $dsVe=isset($_POST['DSVeDat'])?$_POST['DSVeDat']:'';
            $dsVe=explode(';',$dsVe);
            $count=count($dsVe);
            $MaKH=getMaKH();
            $_SESSION['maKH']=$MaKH;
            $_SESSION['TG']=0;
            $_SESSION['VT']=0;
            if($MaKH!=false){
                    for($i=0;$i<$count;$i++){
                        $maVe=$dsVe[$i];
                        setLoaiVe($dsVe[$i]);
                    }
                    $MaHD=createHoaDon();
                    for($i=0;$i<$count;$i++){
                        $maVe=$dsVe[$i];
                        $sqlUpdate="update thongtinchitietve set MaKhachHang='$MaKH',MaHoaDon='$MaHD',TinhTrangVe='pending' where MaVe='$maVe'";
                        mysqli_query($connect,$sqlUpdate);
                    }
                    echo("<script>alert('Đặt vé thành công!');</script>");
                    if(isset($_SESSION['maCB'])){
                        session_destroy();
                    }
                    mysqli_close($connect);
                echo("<script>location.replace('http://localhost/BigProject/TimVaDatVe.php');</script>");
            }
            else{
                $dsVe=implode(';',$dsVe);
                loginUser($dsVe);
            }
        }
        function setLoaiVe($index){
            $connect=Connect();
            $sql="select LoaiVe from thongtinchitietve where MaVe='$index'";
            $r=mysqli_query($connect,$sql);
            $row=mysqli_fetch_assoc($r);
            if($row['LoaiVe']=='TG'){ $_SESSION['TG']+=1;}
            if($row['LoaiVe']=='VT'){ $_SESSION['VT']+=1;}
        }
        function loginUser($dsVe){
            $str="<div id='login'><h3>ĐĂNG NHẬP </h3><br>
            <span>Tài khoản:</span><br><br>
            <input type='text' name='user' ><br><br>
            <span>Mật Khẩu:</span><br><br>
            <input type='password' name='passWord' ><br><br>
            <a href='#'>Tạo tài khoản</a><br><br>
            <input type='hidden' name='DSVeDat' id='DSVeDat'>
            <span id='saveDSVeDat' style='display:none'></span>
            <input type='submit' name='clickLogin'  value='ĐĂNG NHẬP'></div>";
            echo($str);
            if($dsVe!=''){
                echo("<script>document.getElementById('saveDSVeDat').textContent=\"$dsVe\";</script>");
            }echo("<script>var val=document.getElementById('saveDSVeDat').innerText;
            document.getElementById('DSVeDat').value=val;</script>");
            hiddenBackGround();
        }
        function getMaKH(){
            $user=isset($_POST['user'])?$_POST['user']:'';
            $pass=isset($_POST['passWord'])?$_POST['passWord']:'';
            if(isset($_POST['user'])){ 
                if($user==''||$pass==''){
                    echo("<script>alert('Thông tin đăng nhập không chính xác !');</script>"); 
                    $result=false;
                }
                else{
                    $connect=Connect();
                    $sqlSelect="select * from khachhang where Email='$user' && MatKhau='$pass'";
                    $r=mysqli_query($connect,$sqlSelect);
                    $row=mysqli_fetch_assoc($r);
                    if($row!=''){
                        $result=$row['MaKhachHang'];
                    }
                    else{
                        echo("<script>alert('Tài khoản hoặc mật khẩu không chính xác !');</script>");
                        $result=false;
                    }
                    mysqli_close($connect);
                }
                return $result;
            }
        }
        function goHomePage(){
            $str="document.getElementById('container').style.display='block';";
            echo("<script>".$str."</script>");
        }
        function createHoaDon(){
            $connect=Connect();
            $MaKH=$_SESSION['maKH'];
            $VL1=$_SESSION['TG'];
            $VL2=$_SESSION['VT'];
            $MaCB=$_SESSION['maCB'];
            $MaHD=setMaHoaDon();
            $DuongBay=setTotal();
            $Tong=($VL1*$DuongBay*1000)+($VL2*$DuongBay*2000);
            $TrangThai=TrangThaiHD($MaKH,$Tong);
            $sqlInsert="insert into hoadon values('$MaHD','$MaKH','$MaCB','$VL1','$VL2','$Tong','$TrangThai')";
            mysqli_query($connect,$sqlInsert);
            return $MaHD;
        }
        function setTotal(){
            $connect=Connect();
            $MaCB=$_SESSION['maCB'];
            $sqlSelect="select d.ChieuDai+d.ChieuRong as db
            FROM chuyenbay c INNER JOIN duongbay d ON c.MaDuongBay=d.MaDuongBay
            WHERE c.MaChuyenBay='$MaCB'";
            $r=mysqli_query($connect,$sqlSelect);
            $row=mysqli_fetch_assoc($r);
            return $row['db'];
        }
        function setMaHoaDon(){
            $connect=Connect();
            $sqlSelect="select MaHoaDon from hoadon";
            $result=mysqli_query($connect,$sqlSelect);
            $rowCount=mysqli_num_rows($result);
            if(empty($rowCount)){
                $MaHD="HD01";
            }
            else{
                $rowCount++;
                $STT=$rowCount<10?'0'.(string)$rowCount:(string)$rowCount;
                $MaHD="HD".$STT;
            }    
            return $MaHD;
        } 
        function TrangThaiHD($MaKH,$Tong){
            $connect=Connect();
            $sqlSelect="select TongSoTien from khachhang where MaKhachHang='$MaKH'";
            $r=mysqli_query($connect,$sqlSelect);
            $row=mysqli_fetch_assoc($r);
            $TongSoTien=$row['TongSoTien'];
            if($Tong>$TongSoTien){
                return "unpaid";
            }
            if($TongSoTien>=$Tong){
                $TotalRest=$TongSoTien-$Tong;
                UpdateKH($MaKH,$TotalRest);
                UpdateVe($MaKH);
                return "booked";
            }
        }
        function UpdateKH($MaKH,$TotalRest)
        {
            $connect=Connect();
            $sqlUpdate="update khachhang set TongSoTien='$TotalRest' where MaKhachHang='$MaKH'";
            mysqli_query($connect,$sqlUpdate);
        }
        function UpdateVe($MaKH){
            $connect=Connect();
            $sqlUpdate="update thongtinchitietve set TinhTrangVe='booked' where MaKhachHang='$MaKH'";
            mysqli_query($connect,$sqlUpdate);
        }
    ?>
    </form>
    <script>
            var lon = parseInt(document.getElementById("lon").textContent);
            var em = parseInt(document.getElementById("em").textContent);
            var be = parseInt(document.getElementById("be").textContent);
            function btn0() {
                lon--;
                lon < 0 ? lon = 0 : lon;
                document.getElementById("lon").innerHTML = lon;
                document.getElementById("ngLon").value = lon;
            };
            function btn1() {
                lon++;
                document.getElementById("lon").innerHTML = lon;
                document.getElementById("ngLon").value = lon;
            };
            function btn2() {
                em--;
                em < 0 ? em = 0 : em;
                document.getElementById("em").innerHTML = em;
                document.getElementById("treEm").value = em;
            };
            function btn3() {
                em++;
                document.getElementById("em").innerHTML = em;
                document.getElementById("treEm").value = em;
            };
            function btn4() {
                be--;
                be < 0 ? be = 0 : be;
                document.getElementById("be").innerHTML = be;
                document.getElementById("emBe").value = be;
            };
            function btn5() {
                be++;
                document.getElementById("be").innerHTML = be;
                document.getElementById("emBe").value = be;
            };
            function Close(){
                document.getElementById("container").style.display="block";
                document.getElementById("listMayBay").style.display="none";
                document.getElementById("listVeMB").style.display="none"; 
                document.getElementById("login").style.display="none";
            }
            function getMaCB(index){
                document.getElementById("getMaCB").value=index;
            }
            function TimVe(){
               
                document.getElementById("container").style.display="none";
                document.getElementById("listMayBay").style.display="none";
                document.getElementById("login").style.display="none";
            }   
            function Chose(index){
                var id=document.getElementById(index);
                var str=document.getElementById('booking').value;
                if(id.style.background!='orange'){
                    id.style.background='orange';
                    document.getElementById('booking').value+=index+";";
                }else if(id.style.background=='orange'){
                    id.style.background='gray';
                    document.getElementById('booking').value=str.replace(index+';','');
                }
            }      
            function acceptBookJS(){
                document.getElementById("container").style.display="none";
                document.getElementById("listMayBay").style.display="none";
                document.getElementById("listVeMB").style.display="none"; 
            }
            
            
        </script>
</body>

</html>