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
                <h3 style="text-align:center;color:blue">Tạo đường bay</h3>
            </div>
            <div class="floatRight">
                <h3 id="clock"></h3>
            </div>
        </div>
        <form action="#" method="post">
            <table>
                <tr>
                    <td>
                        <span>Điểm đi:</span>
                    </td>
                    <td>
                        <input type="text" name="DiemDi">
                    </td>
                    <td>
                        <span>Điểm đến</span> 
                    </td>
                    <td>
                        <input type="text" name="DiemDen">
                    </td>
                </tr>
                <tr>
                    <td>
                        <span>Chiều dài đường bay:</span>
                    </td>
                    <td>
                        <input type="text" name="ChieuDai">
                    </td>
                    <td>
                        <span>Chiều rộng đường bay:</span>
                    </td>
                    <td>
                        <input type="text" name="ChieuRong">
                    </td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td colspan="2" style="text-align:right;">
                        <input type="reset" value="Hủy" class="btnControl">
                        <input type="submit" value="Tạo" class="btnControl">
                    </td>
                </tr>
            </table>
        </form>
        <hr width="90%">
        <table id="com">
            <tr>
                <th>STT</th>
                <th>Mã đường bay</th>
                <th>Điểm đi</th>
                <th>Điểm đến</th>
                <th>Chiều dài đường bay</th>
                <th>Chiều rộng đường bay</th>
            </tr>
            <?php 
                getData();
            ?>
        </table>
    </div>
    <div class="floatRight">
        <div class="navPortal">
        <h3><a href="http://localhost/BigProject/PortalManager.php" id="head">Portal Manager</a></h3>
            <a href="http://localhost/BigProject/DuongBay.php" id="idClick">Quản lý đường Bay</a><br><br>
            <a href="http://localhost/BigProject/MayBay.php">Quản lý máy Bay</a><br><br>
            <a href="http://localhost/BigProject/ChuyenBay.php">Quản lý chuyến Bay</a><br><br>
            <a href="http://localhost/BigProject/QuanLyKhachHang.php">Quản lý Khách Hàng</a><br><br>
            <a href="http://localhost/BigProject/ThongTinChiTietVeDat.php">Quản lý vé máy bay</a><br><br>
            <a href="http://localhost/BigProject/ThongKeVaTimKiem.php">Thống kê và tìm kiếm</a><br><br>
            <a href="#">Thoát</a>
        </div>
    </div>
    <?php 
        setData();
        function getData(){
            $connect=new mysqli("localhost","root","12345678","qlmaybay");
            $sqlSelect="select * from duongbay";
            $r=mysqli_query($connect,$sqlSelect);
            $i=1;
            while($row=mysqli_fetch_assoc($r)){
                echo("<tr><td>".$i."</td><td>".$row["MaDuongBay"]."</td>".
                    "<td>".$row["DiemDi"]."</td>".
                    "<td>".$row["DiemDen"]."</td>".
                    "<td>".$row["ChieuDai"]."</td>".
                    "<td>".$row["ChieuRong"]."</td></tr>");
                    $i++;
            }
            mysqli_close($connect);
        }
        function setData(){
            $connect=new mysqli("localhost","root","12345678","qlmaybay");
            $DiemDi=isset($_POST['DiemDi'])?$_POST['DiemDi']:'';
            $DiemDen=isset($_POST['DiemDen'])?$_POST['DiemDen']:'';
            $ChieuDai=isset($_POST['ChieuDai'])?$_POST['ChieuDai']:'';
            $ChieuRong=isset($_POST['ChieuRong'])?$_POST['ChieuRong']:'';
            if(isset($_POST['DiemDi'])){
                if($DiemDi==''||$DiemDen==''||$ChieuDai==''||$ChieuRong==''){
                    echo("<script>alert('Mời bạn nhập đầy đủ thông tin!');</script>");
                }
                else{
                    $MaDuongBay=setMaDuongBay($connect);
                    $sqlInsert="insert into duongbay values('$MaDuongBay','$ChieuDai','$ChieuRong','$DiemDi','$DiemDen');";
                    
                    mysqli_query($connect,$sqlInsert);
                    
                    echo("<script>alert('Thêm mới thành công !');</script>");
                    mysqli_close($connect);
                }
            }
        }
        function setMaDuongBay($connect){
            $sqlSelect="select MaDuongBay from DUONGBAY";
            $r=mysqli_query($connect,$sqlSelect);
            $row=mysqli_fetch_assoc($r);
            if(empty($row["MaDuongBay"])){
                $MaDuongBay="DB01";
            }
            else{
                $count=mysqli_num_rows($r); 
                $count++;
                $STT=$count<10?'0'.(string)$count:(string)$count;
                $MaDuongBay="DB".$STT;
            }
            return $MaDuongBay;
        }
    ?>
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
</body>
</html>