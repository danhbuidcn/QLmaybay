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
            text-align: left;
            width: 50%;
            color: blue;
            font-size: 16px;
        }
        input{
            padding: 10px;
            width: 100%;
        }
        h3{
            color: blue;
            font-size: 24px;
            padding: 10px 0 0 0;
            margin: 0;
        }
        #submit{
            font-weight: 700;
            padding: 10px;
            border-radius: 5px 5px;
            background-color:darkorange;
            color: white;
        }
        #submit:hover{
            background-color:blue;
        }
 
    </style>
    <body>
        <form action="#" method="POST">
            <h3>ĐĂNG NHẬP ADMIN</h3><br>
            <span>Tài khoản:</span><br><br>
            <input type="text" name="user" ><br><br>
            <span>Mật Khẩu:</span><br><br>
            <input type="password" name="passWord" ><br><br>
            <a href="#">Quên mật khẩu</a><br><br>
            <input type="submit" id="submit" value="ĐĂNG NHẬP">
        </form>
        <?php
        getData();
        function getData(){
            if(isset($_POST['user']) && isset($_POST['passWord'])){
                $user=$_POST['user'];
                $pass=$_POST['passWord'];
                $connect=new mysqli("localhost","root","12345678","qlmaybay");
                if($user!='' && $pass!=''){
                    $result=checkUser($user,$pass,$connect);
                    if($result){
                        nextPage();
                    }
                    else{
                        echo("<script>alert('Thông tin không chính xác !');</script>");
                    }
                }
                else {
                    echo("<script>alert('Bạn chưa nhập đầy đủ thông tin !');</script>");
                }
                mysqli_close($connect);  
            }
        }
        function checkUser($user,$pass,$connect){       
            $sql="select * from admin ";
            $r=mysqli_query($connect,$sql);
            while($row=mysqli_fetch_assoc($r)){
                if($row['TaiKhoan']==$user && $row['MatKhau']==$pass){
                    return true ;
                }
                else{
                    echo("<script>alert('Tên đăng nhập và mật khẩu không đúng !');</script>");
                }
            };
            return false;
        } 
        function nextPage(){
            echo("<script>location.replace('http://localhost/BigProject/PortalManager.php');</script>");
        }        
        ?>
    </body>
</html>