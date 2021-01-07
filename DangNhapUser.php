<html>
    <header></header>
    <style>
        body{
            margin: 0 auto;
            padding: 0;
            width: 100%;
        }
        form{
            margin: 0 auto;
            width: 100%;
        }
        table{
            width: 100%;
            padding: 10px ;
            font-size: 18px;
        }
        h3{
            color: blue;
            font-size: 24px;
            padding: 10px 0 0 0;
            margin: 0;
        }
        td{
            padding: 10px;
        }
        #submit{
            font-weight: 700;
            color: white;
            background-color: orange;
            padding: 10px;
            width: 50%;
            border-radius: 5px 5px;
        }
        #submit:hover{
            background-color:turquoise;
        }     
        input{
            width: 100%;
            border: 1px solid black;
            border-radius: 5px 5px ; 
            padding: 10px;
        }
        #subTable{ 
            width: 100%;
            padding: 0;
        }
        #subTable td{
            background-color:lightblue;
        }
        th{
            background-color: lightseagreen;
        }
        #logOut{
            display: none;
            width: 100%;
        }
        #btnOut{
            color: black !important;
            border: none;
            border-radius: 20px 20px;
            color:white;
            font-weight: 700;
            padding: 10px;
        }
        #btnOut:hover{
            background-color: blue;
            color: white !important;
        }
        .cd td {
            background-color:yellowgreen !important;
        }

    </style>
    <body>
        <?php

use FFI\CData;

session_start(); ?>
        <form action="http://localhost/BigProject/DangNhapUser.php" method="POST" name="mainForm">
            <table id="Login_Table">
                <tr>
                    <td style="width:60%"><h3>TẠO MỚI THÀNH VIÊN</h3></td>
                    <td><h3>THÀNH VIÊN ĐĂNG NHẬP</h3></td>
                </tr>
                <tr>
                    <td>
                        <p>Chưa là thành viên.</p>
                        <p>Bấm "ĐĂNG KÝ" bên dưới để tạo mới tài khoản thành viên để nhận được những ưu đãi lớn nhất từ chúng tôi.</p>
                        <a href="http://localhost/wordpress/dang-ki/">Đăng ký</a>
                        <p>Ưu đãi cực lớn dành cho thành viên!</p>
                        <table id="subTable">
                            <tr>
                                <th>Số lượng vé</th>
                                <th>Ưu đãi</th>
                                <th>Áp dụng</th>
                            </tr>
                            <tr>
                                <td>10 vé</td>
                                <td>100.000 VND</td>
                                <td>Voucher</td>
                            </tr>
                            <tr>
                                <td>30 vé</td>
                                <td>500.000 VND</td>
                                <td>Voucher</td>
                            </tr>
                        </table>
                        <p>Lưu ý: * Áp dụng cho vé mua từ: 01/10/2020 - 31/12/2020 * Voucher có hiệu lực 180 ngày kể từ ngày xuất voucher.</p>
                    </td>
                    <td>
                        <span>E-Mail thành viên:</span><br><br>
                        <input type="email" name="email" class="ipTag"><br><br>
                        <span>Mật Khẩu:</span><br><br>
                        <input type="password" name="passWord" class="ipTag"><br><br>
                        <a href="#">Quên mật khẩu</a><br><br>
                        <input type="submit" id="submit" name="logIn" value="ĐĂNG NHẬP">
                    </td>
                </tr>
            </table>        
            <input type='hidden' name="NameSession" id="sessionLogIn">        
        <table id="logOut">
            <tr>
                <td id="NameSession">Tên đăng nhập:</td>
                <td><input type="submit" onclick="DeleteSession()" id='btnOut'name="logOut" value="LogOut" ></td>
            </tr>
            <tr>
                <td colspan="2"><h3 style="text-align: center;">Thông tin vé mua</h3></td>
            </tr>
            <tr>
                <td colspan="2">
                <table id="subTable">
                    <tr>
                        <th>STT</th>
                        <th>Mã Hóa Đơn</th>
                        <th>Mã chuyến bay</th>
                        <th>Điểm đi</th>
                        <th>Điểm đến</th>
                        <th>Ngày đi</th>
                        <th>Số vé L1</th>
                        <th>Số vé L2</th>
                        <th>Tổng số tiền</th>
                    </tr>
                    <?php Main(); ?>
                </table>
                </td>
            </tr>
        </table>

        </form>
        <?php 
            function Main(){
                if($_POST){
                    if($_POST['logIn']){
                        DangNhap();
                    }
                    else if($_POST['logOut']){
                        LogOut();
                    }
                    else if($_POST['NapTien']){
                        NapTien();
                    }
                }
            }
            function DangNhap(){
                $connect=Connect();
                $sql="select * from khachhang ";
                if(isset($_POST['email']) && isset($_POST['passWord'])){
                    $email=$_POST['email'];
                    $pass=$_POST['passWord'];
                    if($email!='' && $pass!=''){
                        $r=mysqli_query($connect,$sql);
                        if(CheckUser($email,$pass,$r)){
                            $_SESSION['User']=$email;
                            dsHoaDon();
                            echo("<script>
                                var login=document.getElementById('Login_Table');
                                login.style.display = 'none';
                                var sessionLogIn=document.getElementById('sessionLogIn');
                                sessionLogIn.value ='$email';
                            </script>");
                        }
                        return;
                    }
                    echo("<script>alert('Bạn chưa nhập đầy đủ thông tin !');</script>");
                }
            }
            function CheckUser($email,$pass,$r){
                $count=false;
                while($row=mysqli_fetch_assoc($r)){
                    if($row['Email']==$email && $row['MatKhau']==$pass){
                        $count= true;
                        break;
                    }
                };
                if($count){
                    return true;
                }
                else{
                    echo("<script>alert('Sai tên đăng nhập hoặc mật khẩu !');</script>");
                    return false;
                }
            }
        function Connect(){
            $connect=new mysqli("localhost","root","12345678","qlmaybay");
            return $connect;
        }
        function logOut(){
            session_destroy();
            echo("<script>location.replace('http://localhost/BigProject/DangNhapUser.php');</script>");
        }
        function dsHoaDon(){
            $connect=Connect();
            $MaKH=getMaKH();
            $sqlSelect="select h.MaHoaDon,h.MaChuyenBay,d.DiemDi,d.DiemDen,c.NgayDi,h.SoVeL1,h.SoVeL2,h.TongTien,TongSoTien,TrangThai
            from hoadon h INNER JOIN chuyenbay c ON h.MaChuyenBay=c.MaChuyenBay
            inner JOIN duongbay d ON d.MaDuongBay=c.MaDuongBay
            inner join khachhang k on h.MaKhachHang=k.MaKhachHang
            WHERE h.MaKhachHang='$MaKH'";
            $r=mysqli_query($connect,$sqlSelect);
            $total=$Money=0;
            $stt=1;
            while($row=mysqli_fetch_assoc($r)){
                $TrangThaiHD=$row['TrangThai'];
                if($TrangThaiHD=='booked'){
                    $total+=0;
                    $str="<tr class='cd'>";
                }
                else{
                    $total+=$row['TongTien'];
                    $str="<tr>";
                }
                $str.="<td>".$stt."</td>
                    <td>".$row['MaHoaDon']."</td>
                    <td>".$row['MaChuyenBay']."</td>
                    <td>".$row['DiemDi']."</td>
                    <td>".$row['DiemDen']."</td>
                    <td>".$row['NgayDi']."</td>
                    <td>".$row['SoVeL1']."</td>
                    <td>".$row['SoVeL2']."</td>
                    <td>".$row['TongTien']."</td>
                </tr>";
                $stt++;
                $Money=$row['TongSoTien'];
                echo($str);
            }
            $strEndRow="<tr><td colspan='6'>Tổng số tiền hiện có :$Money</td><td colspan='2'>Total</td><td>$total</td></tr>";
            $strEndRow.="<tr><td colspan='7'><input name='soTien' type='number' placeholder='Số tiền nạp'></td><td colspan='2'><input type='submit' value='Nạp tiền' name='NapTien'></td></tr>";
            echo($strEndRow);
            mysqli_close($connect);
        }
        function NapTien()
        {
            $soTien=isset($_POST['soTien'])?$_POST['soTien']:'';
            $MaKH=getMaKH();
            $connect=Connect();
            $MoneyNow=MoneyNow($MaKH,$connect);
            $soTien+=$MoneyNow;
            $enterMoney=autoPay($soTien,$MaKH);
            $sqlUpdate="update khachhang set TongSoTien='$enterMoney' where MaKhachHang='$MaKH'";
            mysqli_query($connect,$sqlUpdate);
            echo("<script>alert('Nạp tiền thành công ! Mời bạn đăng nhập lại !');</script>");
            mysqli_close($connect);
            logOut();
        }
        function MoneyNow($MaKH)
        {
            $connect=Connect();
            $sqlSelect="select TongSoTien from khachhang where MaKhachHang='$MaKH'";
            $row=mysqli_query($connect,$sqlSelect);
            $r=mysqli_fetch_assoc($row);
            $MoneyNow=$r['TongSoTien'];
            mysqli_close($connect);
            return $MoneyNow;
        }
        function getMaKH(){
            $connect=Connect();
            $user=$_SESSION['User'];
            $sqlSelect="select MaKhachHang from khachhang where Email='$user'";
            $r=mysqli_query($connect,$sqlSelect);
            $row=mysqli_fetch_assoc($r);
            return $row['MaKhachHang'];
        }
        function autoPay($soTien,$MaKH){
            $connect=Connect();
            $sqlSelect="select * from hoadon where MaKhachHang='$MaKH'";
            $r=mysqli_query($connect,$sqlSelect);
            while($row=mysqli_fetch_assoc($r)){
                $soTienHD=$row['TongTien'];
                $MaHD=$row['MaHoaDon'];
                if($soTien<$soTienHD){
                    return $soTien;
                }
                if($soTien>=$soTienHD){
                    $soTien-=$soTienHD;
                    UpdateHD($MaHD);
                    UpdateVe($MaHD);
                }
            }
        }
        function UpdateHD($MaHD){
            $connect=Connect();
            $sqlUpdate="update hoadon set TrangThai='booked' where MaHoaDon='$MaHD'";
            mysqli_query($connect,$sqlUpdate);
            mysqli_close($connect);
        }
        function UpdateVe($MaHD){
            $connect=Connect();
            $sqlUpdate="update thongtinchitietve set TinhTrangVe='booked' where MaHoaDon='$MaHD' ";
            mysqli_query($connect,$sqlUpdate);
            mysqli_close($connect);
        }
        ?>
        <script>
            var NameSession=document.getElementById('sessionLogIn').value;
            var login=document.getElementById('Login_Table');
            var sessionLogout=document.getElementById('logOut');
            if(NameSession!=''){
                var text="Tên đăng nhập : "+NameSession;
                document.getElementById('NameSession').textContent=text;
                var login=document.getElementById('Login_Table');
                login.style.display = 'none';
                var sessionLogout=document.getElementById('logOut');
                sessionLogout.style.display='table';
            }
            function DeleteSession(){
                login.style.display = 'block';
                sessionLogout.style.display='none';
                document.getElementById('sessionLogIn').value="";
            }
        </script>
    </body>
</html>