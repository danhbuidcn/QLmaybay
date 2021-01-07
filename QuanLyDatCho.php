<html>
<header></header>
<body>
<style>
form{
    margin: 0 auto;
    width: 100%;
    color:blue;
    font-size: 18px;
}
.fl{
    float:left;
    width: 50%;
    margin: 0 auto;
}
input{
    padding: 10px;
    border: 1px gray solid;
    border-radius:5px 5px ;
    width: 50%;
}
input[type='submit']{
    width: 100%;
    padding: 10px;
    color:white;
    background-color:darkorange;
    font-size: 20px;
    font-weight:700;
    margin: 20px 0;
}
</style>
<form action="#" method="post">
    <div class="fl">
        <span>Mã đơn hàng</span>
        <input type="text" name="MaHoaDon" style="padding:10px" placeholder="Nhập mã hóa đơn">
    </div>
    <div class="fl">
        <span>Số điện thoại</span>
        <input type="number" name="SoDienThoai" placeholder="Nhập số điện thoại">
    </div>
    <input type="submit" Value="Kiểm tra" >
</form>
</body>
</html>