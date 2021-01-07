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
            width: 25%;
        }
        .btnControl:hover{
            background-color:blue;
        }
        #com{
            width: 100%;
            padding: 20px 50px;
        }
        #inforTable{
            width: 100%;
            overflow: auto;
            max-height: 500px;
        }
    </style>
    <body>
    <div class="floatLeft">
        <div style="width:100%">
            <div class="floatLeft">
                <h3 style="text-align:center;color:blue">Quản lý khách hàng</h3>
            </div>
            <div class="floatRight">
                <h3 id="clock"></h3>
            </div>
        </div>
        <form action="#" method="POST" >
            <table>
                <tr>
                    <td><span>Tên Khách hàng</span></td>
                    <td><input type="text" name="TenKhachHang" id="tenkh"></td>
                    <td><span>Số điện thoại</span></td>
                    <td><input type="number" name="SDT" id="sdt"></td>
                </tr>
                <tr>
                    <td><span>Địa chỉ</span></td>
                    <td><input type="text" name="DiaChi" id="diachi"></td>
                    <td><span>Email</span></td>
                    <td><input type="email" name="Email" id="email"></td>
                </tr>
                <tr>
                    <td><span>Mật khẩu</span></td>
                    <td><input type="password" name="MatKhau" id="mk1"></td>
                    <td><span>Nhập lại mật khẩu</span></td>
                    <td><input type="password" name="MatKhau2" id="mk2"></td>
                </tr>
                <tr>
                    <td></td>
                    <td colspan="3" style="text-align:right">
                        <input type="hidden" name="makh" id="ma">
                        <input type="hidden" name="actionDele" id="confirmDele">
                        <input type="submit" name="delete" value="Xóa" class="btnControl">
                        <input type="submit" name="update" value="Cập nhật" class="btnControl">
                        <input type="submit" name="create" value="Tạo mới" class="btnControl">
                    </td>
                </tr>
            </table>
        </form>
        <hr width="90%">
        <div id="inforTable" style="width:100%">
            <table id="com">
                <tr>
                    <th>STT</th>
                    <th>Mã khách hàng</th>
                    <th>Tên khách hàng</th>
                    <th>Số điện thoại</th>
                    <th>Địa chỉ</th>
                    <th>Email</th>
                    <th>Mật khẩu</th>
                    <th>Số tiền</th>
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
            <a href="http://localhost/BigProject/DuongBay.php">Quản lý đường Bay</a><br><br>
            <a href="http://localhost/BigProject/MayBay.php">Quản lý máy Bay</a><br><br>
            <a href="http://localhost/BigProject/ChuyenBay.php">Quản lý chuyến Bay</a><br><br>
            <a href="http://localhost/BigProject/QuanLyKhachHang.php" id="idClick">Quản lý Khách Hàng</a><br><br>
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
        Action();
        function getData(){
            $connect=Connect();
            $sqlSelect="select * from khachhang";
            $r=mysqli_query($connect,$sqlSelect);
            $i=1;
            while($row=mysqli_fetch_assoc($r)){
                $ma=$row['MaKhachHang'];
                $ten=$row['TenKhachHang'];
                $dt=$row['SoDienThoai'];
                $dc=$row['DiaChi'];
                $email=$row['Email'];
                $mk=$row['MatKhau'];
                $tien=$row['TongSoTien'];
                echo("<tr onclick=\"clickGetData('$ma','$ten','$dt','$dc','$email','$mk');\"><td>".$i."</td>".
                "<td>".$ma."</td>".
                "<td>".$ten."</td>".
                "<td>".$dt."</td>".
                "<td>".$dc."</td>".
                "<td>".$email."</td>".
                "<td>".$mk."</td>".
                "<td>".$tien."</td>".
                "</tr>");
                $i++;
            }
            mysqli_close($connect);
        }

        function setData(){
            $connect=Connect();
            $arr=inputForm();
            if(isset($_POST['TenKhachHang'])){
                $MaKhachHang=setMaKhachHang();
                $TongSoTien=0;
                if($arr[0]==''||$arr[1]==''||$arr[2]==''||$arr[3]==''||$arr[4]==''){
                    echo("<script>alert('Mời bạn nhập đầy đủ thông tin!');</script>");
                }
                else if($arr[5]!=$arr[4]){
                    echo("<script>alert('Mật khẩu không trùng khớp!');</script>");
                }
                else{
                    $sqlInsert="insert into khachhang values('$MaKhachHang',\"$arr[0]\",\"$arr[1]\",\"$arr[2]\",\"$arr[3]\",\"$arr[4]\",'$TongSoTien')";
                    mysqli_query($connect,$sqlInsert);
                    echo("<script>alert('Tạo mới thành công!');</script>");
                    mysqli_close($connect);
                }
            }
        }
        function inputForm(){
            $arr=[];
            $TenKhachHang=isset($_POST['TenKhachHang'])?$_POST['TenKhachHang']:'';
            $SDT=isset($_POST['SDT'])?$_POST['SDT']:'';
            $DiaChi=isset($_POST['DiaChi'])?$_POST['DiaChi']:'';
            $Email=isset($_POST['Email'])?$_POST['Email']:'';
            $MatKhau=isset($_POST['MatKhau'])?$_POST['MatKhau']:'';
            $MatKhau2=isset($_POST['MatKhau2'])?$_POST['MatKhau2']:'';
            $maKH=isset($_POST['makh'])?$_POST['makh']:'';
            $arr=[$TenKhachHang,$SDT,$DiaChi,$Email,$MatKhau,$MatKhau2,$maKH];
            return $arr;
        }
        function setMaKhachHang(){
            $connect=Connect();
            $sqlSelect="select MaKhachHang from khachhang";
            $result=mysqli_query($connect,$sqlSelect);
            $rowCount=mysqli_num_rows($result);
            if(empty($rowCount)){
                $MaKH="KH01";
            }
            else{
                $rowCount++;
                $STT=$rowCount<10?'0'.(string)$rowCount:(string)$rowCount;
                $MaKH="KH".$STT;
                while($row=mysqli_fetch_assoc($result)){
                    if($MaKH==$row['MaKhachHang']){
                        $STT++;
                    }
                }
                $MaKH="KH".$STT;
            }    
            return $MaKH;
        }
        function Connect(){
            $connect=new mysqli("localhost","root","12345678","qlmaybay");
            return $connect;
        }
        function Update(){
            $connect=Connect();
            $arr=inputForm();  
            if(isset($_POST['TenKhachHang'])){
                if($arr[0]==''||$arr[1]==''||$arr[2]==''||$arr[3]==''||$arr[4]==''){
                    echo("<script>alert('Mời bạn nhập đầy đủ thông tin!');</script>");
                }
                else if($arr[5]!=$arr[4]){
                    echo("<script>alert('Mật khẩu không trùng khớp!');</script>");
                }
                else{
                    $sqlUpdate="update khachhang set TenKhachHang=\"$arr[0]\",SoDienThoai=\"$arr[1]\",DiaChi=\"$arr[2]\",Email=\"$arr[3]\",MatKhau=\"$arr[5]\"Where MaKhachHang=\"$arr[6]\"";
                    echo("<script>alert('$sqlUpdate!');</script>");
                    mysqli_query($connect,$sqlUpdate);
                    mysqli_close($connect);
                    echo("<script>alert('Update thành công!');</script>");
                }
            };
        }
        function Delete(){         
            $connect=Connect();
            $arr=inputForm(); 
            if($arr[6]==''){
                echo("<script>alert('Mời bạn chọn khách hàng cần xóa!');</script>");  
            }
            else{
                $sqlDelete="delete from khachhang Where MaKhachHang=\"$arr[6]\"";
                mysqli_query($connect,$sqlDelete);
                mysqli_close($connect);
                echo("<script>alert('Xóa thành công!');</script>"); 
            } 
        }       
        function Action() {
            if ($_POST) {
                if (isset($_POST['update'])) {
                    Update();
                } else if (isset($_POST['create'])) {
                    setData();
                }
                else if(isset($_POST['delete'])){
                    Delete();
                }
            }
        }
    ?>

    <script>
        function clickGetData(ma,ten,sdt,dc,email,mk) {
            document.getElementById('ma').value=ma;
            document.getElementById('tenkh').value=ten;
            document.getElementById('sdt').value=sdt;
            document.getElementById('diachi').value=dc;
            document.getElementById('email').value=email;
            document.getElementById('mk1').value=mk;
            document.getElementById('mk2').value=mk;
        }          
    </script>
</body>
</html>