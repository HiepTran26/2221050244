<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buổi 1 php</title>
</head>
<body>
    <?php
    // In ra màn hình
    echo "hi world! <br>";
    echo "Hi";
    // Biến 
    $ten ="Hiep";
    $tuoi ="21";
    
    echo $ten . " " . $tuoi . "tuổi";
    // Hằng
    define("soPi","3,14");
    echo soPi . "<br>";
    // Phân biệt '' và ""
    echo "$ten" . "<br>";
    //Chuỗi
    echo strlen($ten) . "<br>";
    //Đếm số từ
    echo str_word_count($ten) . "<br>";
    //Tìm kiếm ký tự trong chuỗi
    echo str_replace("anh","an", $ten);

    //toán tử
    $soThuNhat = 10;
    $soThuHai = 5;
    # + - * /
    # += -= *= /= %=
    # so sánh == != > < >= <= ===
    echo $soThuNhat < $soThuHai;
    // Câu điều kiện
    // if("Điều kiện){}
    //Kiểm tra tổng số thứ nhất và số thứ 2
    //nếu < 15 thì in ra nhỏ hơn 15
    //nếu = 15 thì in ra =15
    // còn lại in ra lớn hơn 15
    $soThuNhat = 8;
    $soThuHai = 6;
    $tong = $soThuNhat + $soThuHai;
     if ($tong < 15) {
    echo "Tổng nhỏ hơn 15";
    } elseif ($tong == 15) {
    echo "Tổng bằng 15";
    }  else {
    echo "Tổng lớn hơn 15";
    }
    // switch case
    $color = "red";
    switch ($color){
        case "red":
            echo "is red";
            break;
        case "blue":
            echo "is blue";
            break;
        default:
            echo "no color";
            break;
    }

    //for
    for ($i=0; $i < 100; $i++){
        echo $i . "<br>";
    }

    // Mảng
    $mang = ["An", "Nhat Anh", "Vu Anh"];

    //Đếm phần tử
    echo count($mang);
    echo $mang[1];
    print_r($mang);
    $mang[0] = "Hai Anh";
    print_r($mang);
    $mang[] = "Tam";
    print_r($mang);
    #xóa
    unset($mang[3]);
    print_r($mang);
 
    


    ?>
</body>
</html>