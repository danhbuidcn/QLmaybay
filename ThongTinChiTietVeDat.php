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
            background-color:blue;
            color: white;
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
        }
        .btnControl:hover{
            background-color:blue;
        }
        #com{
            width: 100%;
            padding: 20px 50px;
        }
        #ListVe{
            width: 100%;
            padding: 20px 50px;
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
        .pending{
            background-color:orange !important;
        }
        .booked{
            background-color:red !important;
        }
        .vip{
            background-color: green !important;
        }
        .blank{
            background-color: white !important;
        }
        .tdtitle{
            background-color:lightseagreen !important;
            color:#777777 !important;
        }
    </style>
    <body>
    <div class="floatLeft">
        <div style="width:100%">
            <div class="floatLeft">
                <h3 style="text-align:center;color:blue">Quản lý vé máy bay</h3>
            </div>
            <div class="floatRight">
                <h3 id="clock"></h3>
            </div>
        </div>
        <form action="#" method="POST" >
            <table>
                <tr>
                    <td style="width:20%;"><span>Mã chuyến bay </span></td>
                    <td style="width:40%;"><input type="text" name="macb" id="macb"></td>
                    <td style="width:20%;"><input type="submit" name="find" value="Tìm" class="btnControl"></td>
                </tr>
            </table>
        </form>
        <hr width="90%">
        <div id="inforTable" style="width:100%">
            <table  id="com">
                <tbody><?php getThongTinVe(); ?></tbody>
            </table>
        </div>
    </div>
    <div class="floatRight">
        <div class="navPortal">
            <h3><a href="http://localhost/BigProject/PortalManager.php" id="head">Portal Manager</a></h3>
            <a href="http://localhost/BigProject/DuongBay.php">Quản lý đường Bay</a><br><br>
            <a href="http://localhost/BigProject/MayBay.php">Quản lý máy Bay</a><br><br>
            <a href="http://localhost/BigProject/ChuyenBay.php">Quản lý chuyến Bay</a><br><br>
            <a href="http://localhost/BigProject/QuanLyKhachHang.php">Quản lý khách Hàng</a><br><br>
            <a href="http://localhost/BigProject/ThongTinChiTietVeDat.php" id="idClick">Quản lý vé máy bay</a><br><br>
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
        function getThongTinVe(){
            $connect=Connect();
            $macb=isset($_POST['macb'])?$_POST['macb']:'';
            if(isset($_POST['macb'])){
                $sqlSelect="select * from thongtinchitietve where MaChuyenBay='$macb' ORDER BY SoVe ASC";
                $r=mysqli_query($connect,$sqlSelect);
                displayDSVe($macb,$r);
                mysqli_close($connect);
            }
        }
        
        function Connect(){
            $connect=new mysqli("localhost","root","12345678","qlmaybay");
            return $connect;
        }
        function displayDSVe($macb,$r){
            $i=1;
            $titleTb='<caption>Mã chuyến bay : '.$macb.' <br><i>(red:booked, orange:pending, green:Vip)</i></caption>';
            echo($titleTb);
            $str="";
            $str.='<tr><th>STT</th><th>A</th><th>B</th><th>C</th><th>D</th><th>E</th><th style="background-color:white;"></th><th>F</th><th>G</th><th>H</th><th>I</th><th>K</th></tr><tr>';
            while($row=mysqli_fetch_assoc($r)){
                $status=$row['TinhTrangVe'];
                $loaiVe=$row['LoaiVe'];
                if($i%10==0){
                    if($status=='pending'){$str.="<td class='pending'>";}
                    else if($status=='booked'){$str.="<td class='booked'>";}
                    else if($loaiVe=='TG'){$str.="<td class='vip'>";}
                    else {$str.="<td>";}
                    $str.=$row['MaVe']."</td></tr><tr>";

                }
                else{
                    $tt=($i-1)/10+1;
                    ($i-1)%10==0?$str.="<td class='tdtitle'>".$tt."</td>":"";
                    if($status=='pending'){$str.="<td class='pending'>";}
                    else if($status=='booked'){$str.="<td class='booked'>";}
                    else if($loaiVe=='TG'){$str.="<td class='vip'>";}
                    else {$str.="<td>";}
                    $str.=$row['MaVe']."</td>";
                    $i%5==0?$str.="<td class='blank'>".'&nbsp;'."</td>":"";
                }
                $i++;
            }
            echo($str);
        }
    ?>
</body>
</html>