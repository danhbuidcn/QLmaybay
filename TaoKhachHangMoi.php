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
            
            width: 60%;
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
            font-size: 20px;
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
    </style>
    <body>
        <form action="http://localhost/wordpress/dang-ki/" method="POST" name="DangNhap">
            <table>
                <tr>
                    <td colspan="2"><h3>1. Thông tin cá nhân</h3></td>
                </tr>
                <tr>
                    <td style="width:30%">Tên Khách Hàng: </td>
                    <td><input type="text" name="TenKH" style="padding: 10px;" ></td>
                </tr>
                <tr>
                    <td> Điện Thoại:</td>
                    <td><input type="number" name="dienThoai" style="padding: 10px;" ></td>
                </tr>
                <tr>
                    <td> Địa chỉ:</td>
                    <td><input type="text" name="diaChi" style="padding: 10px;" ></td>
                </tr>
                <tr>
                    <td> E-Mail:</td>
                    <td><input type="email" name="email" style="padding: 10px;" ></td>
                </tr>
                <tr>
                    <td>Mật Khẩu:</td>
                    <td><input type="password" style="padding: 10px;"  name="passWord"></td>
                </tr>
                <tr>
                    <td>Nhập lại Mật Khẩu:</td>
                    <td><input type="password" style="padding: 10px;"  name="passWord2"></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:center;"><input type="submit" value="Tiếp tục" id="submit"></td>
                </tr>
            </table>
        </form>
        <?php    
        DataProcessing();
        function DataProcessing(){
            $TenKH=isset($_POST['TenKH'])?$_POST['TenKH']:'';
            $email=isset($_POST['email'])?$_POST['email']:'';
            $dienThoai=isset($_POST['dienThoai'])?$_POST['dienThoai']:'';
            $diaChi=isset($_POST['diaChi'])?$_POST['diaChi']:'';
            $TongSoTien=0;
            $passWord=isset($_POST['passWord'])?$_POST['passWord']:'';
            $passWord2=isset($_POST['passWord2'])?$_POST['passWord2']:'';

            GetData($TenKH,$email,$dienThoai,$diaChi,$TongSoTien,$passWord,$passWord2);
        }  
        function GetData($TenKH,$email,$dienThoai,$diaChi,$TongSoTien,$passWord,$passWord2){
            if(isset($_POST['TenKH'])){
                if($TenKH==''||$email==''||$dienThoai==''||$diaChi==''||$passWord==''||$passWord2==''){
                    echo("<script>alert('Mời bạn nhập đầy đủ thông tin !');</script>");
                }
                else if($passWord!=$passWord2){
                    echo("<script>alert('Mật khẩu không trùng khớp !');</script>");
                }
                else{
                    $MaKH=SetMaKH(); 
                    ConnectSQL($MaKH,$TenKH,$email,$dienThoai,$diaChi,$TongSoTien,$passWord);
                    echo("<script>alert('Thêm mới thành công !');</script>");
                    echo("<script>location.replace('http://localhost/wordpress/dang-nhap/');</script>");
                }
            }
        }    
        function SetMaKH(){
            $connect=new mysqli("localhost","root","12345678","qlmaybay");
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
            }    
            return $MaKH;
        }    
        function ConnectSQL($MaKH,$TenKH,$email,$dienThoai,$diaChi,$TongSoTien,$passWord){
            $connect=new mysqli("localhost","root","12345678","qlmaybay");
            $sqlInsert="insert into khachhang values('$MaKH','$TenKH','$dienThoai','$diaChi','$email','$passWord','$TongSoTien');";
            mysqli_query($connect,$sqlInsert);
            mysqli_close($connect);
        }
        ?>
    </body>
</html>