var msv, name, date, hometown, time, ind; // create variable global
var stdList = []; // create array 
var nodeUI = $('#outputList'); // lấy bảng output
var regInteger = /^\d+$/; // variable to check interger
var specialChars = "<>@!#$%^&*()_+[]{}?:;|'\"\\,./~`-="; // var to check special character 
var local_data = JSON.parse(localStorage.getItem('msv')); // lấy dữ liệu từ localstorage
if (local_data != null) {
    stdList = local_data; // nếu localdata khác rỗng thì gán stdList = localdata
}
oclock();
clearStd();
common();
// add new student
function addNew() {
    getVal();
    if (checkVal(msv, name, date, hometown) == true) {
        stdList.push(getData()); // thêm object mới vào mảng đã khai báo
        localStorage.setItem('msv', JSON.stringify(stdList)); // thêm mảng StdList vào localstorage, setItem(key,value)
        // JSON.stringify: chuyển 1 object sang json
        alert("Create new is successful!");
        common();
    }
}
// update giá trị
function update() {
    getVal(); // lấy data tại thời điểm click
    if (checkMSV(msv)) { // check msv đã tồn tại chưa, nếu chưa thì ko update
        stdList[ind] = getData(); // gán giá trị chuỗi tại ind bằng data mới
        localStorage.setItem('msv', JSON.stringify(stdList)); //thêm data mới vào localstorage
        alert("update is successful !"); // thông báo thánh công
        common(); // hiển thị lại bảng
        return; // thoát
    }
    alert("bạn chưa nhập MSV hoặc MSV không tồn tại !");
}
//delete giá trị
function deleteItem() {
    getVal(); // lấy data
    if (checkMSV(msv)) { //chỉ có thể xóa mã sinh viên đã tồn tại 
        stdList.splice(ind, 1); // xóa 1 phần tử ở vị trí ind
        localStorage.setItem('msv', JSON.stringify(stdList));
        alert("Delete is successful !");
        common();
        return;
    }
    alert("bạn chưa nhập MSV hoặc MSV không tồn tại !");
}
// display list student
function common() {
    var itemStd = "";
    stdlength = stdList.length;
    for (let i = 0; i < stdlength; i++) {
        itemStd += "<tr><td onclick='getItem( " + i + " )'>" + stdList[i].msv + "</td>" +
            "<td onclick='getItem( " + i + " )'>" + stdList[i].name + "</td>" +
            "<td onclick='getItem( " + i + " )'>" + stdList[i].date + "</td>" +
            "<td onclick='getItem( " + i + " )'>" + stdList[i].hometown + "</td>" +
            "<td onclick='getItem( " + i + " )'>" + stdList[i].time + "</td></tr>";
    }
    nodeUI.html(itemStd); // hiển thị danh sách sinh viên ra màn hình
}
// get data now: lấy data tại thời điểm click
function getData() {
    getVal();
    var data = { msv, name, date, hometown, time };
    return data;
}
// get val input
function getVal() {
    msv = $('#msv').val();
    name = $('#tenSv').val();
    date = $('#ngaySinh').val();
    hometown = $('#que').val();
    time = $('#clock').text();
}
// get index 
function getItem(index) {
    $('#msv').val(stdList[index].msv);
    $('#tenSv').val(stdList[index].name);
    $('#ngaySinh').val(stdList[index].date);
    $('#que').val(stdList[index].hometown);
    ind = index;
}
// create oclock
function oclock() {
    //setTimeout sau khoảng thời gian thực hiện nhiệm vụ, thực hiện đúng 1 lần
    //setInterval thực hiện nhiệm vụ sau 1 khoảng thời gian, thực hiện nhiều lần lặp lại 
    setInterval(function() {
        $('#clock').text(getTime());
        clearStd(); // gọi hàm tự động xóa để hàm thực thi sau mỗi 1s
    }, 1000);
}
// get time now
function getTime() {
    var date = new Date(); // lấy ra thời gian 
    var hour = date.getHours(); // lấy giờ
    var minutes = date.getMinutes(); // lấy phút
    var second = date.getSeconds(); // lấy giây
    return (hour <= 12 ? hour : hour - 12) + ':' + // lấy giờ theo 12 h
        (minutes < 10 ? '0' + minutes : minutes) + ':' +
        (second < 10 ? '0' + second : second) + // nếu nhỏ hơn 10 thì thêm số 0 vào trước
        (hour <= 12 ? 'AM' : 'PM'); // hour nhỏ hơn 12 thì là Am còn không thì là Pm
}
// check input value
function checkVal(msv, name, date, hometown) {
    if (!isInteger(msv) || checkMSV(msv)) { // check msv 
        alert("bạn chưa nhập msv hoặc msv không hợp lệ");
        return false;
    } else if (isInteger(name) || checkSpecialCharacter(name)) // check name 
    {
        alert("bạn chưa nhập tên hoặc tên không hợp lệ");
        return false;
    } else if (date == "") // check date not empty
    {
        alert("mời bạn chọn ngày sinh");
        return false;
    } else if (isInteger(hometown) || checkSpecialCharacter(hometown)) {
        alert("bạn chưa nhập quê quán hoặc quê quán không hợp lệ");
        return false;
    } else return true;
}
// check interger, nếu đúng thì trả về true 
function isInteger(int) {
    return regInteger.test(int); // test(): kiểm tra chuỗi int có khớp với mô hình nào của biểu thức reg hay không nếu có thì bằng true
}
// kiểm tra giá trị trùng lặp của msv
function checkMSV(int) {
    for (let i = 0; i < stdList.length; i++) {
        if (stdList[i].msv == int)
            return true; //nếu mã sinh viên đã tồn tại thì trả về true
    }
    return false;
}
// check special character
function checkSpecialCharacter(str) {
    if (!isNaN(str))
        return true;
    for (i = 0; i < specialChars.length; i++) {
        if (str.indexOf(specialChars[i]) > -1) { // indexOf: trả về vị trí xuất hiện đầu tiên của giá trị trong chuỗi
            return true; // nếu vị trí lớn hơn -1 thì trong chuỗi có kí tự đặc biệt
        }
    }
    return false; // nếu trong chuỗi không có kí tự đặc biệt
}
// clear List student
function clearStd() {
    getTime();
    var arrtimenow = getTime().split(':'), // phân tách thời gian hiện tại thành từng chuỗi
        secNow = parseInt(arrtimenow[1]), // lấy phút ở index 1
        minutesNow = parseInt(arrtimenow[2]); // lấy giây ở index 2
    for (let i = 0; i < stdList.length; i++) {
        var checkTime = stdList[i].time,
            arr = checkTime.split(':'), // phân tách chuỗi thành mảng dữ liệu dựa vào kí tự phân tách
            checkSec = parseInt(arr[2]),
            checkMinutes = parseInt(arr[1]);
        if (checkMinutes > minutesNow) { // nếu phút hiện tại lớn hơn phút ở thời gian tạo thì phút hiện tại +60
            secNow += 60;
            if (secNow - checkSec > 5)
                stdList.splice(stdList[i], 1);
        }
        if (secNow - checkSec > 5) // nếu thời gian tạo lớn hơn 5s thì xóa item
            stdList.splice(stdList[i], 1);
    }
    common(); // hiển thị lại bảng sau đó xóa
    localStorage.setItem('msv', JSON.stringify(stdList)); // xóa item quá 5s
}