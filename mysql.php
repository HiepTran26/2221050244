<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    //connect to the database
    require 'connect.php';
    mysqli_set_charset($conn, 'UTF8'); // sua loi Tieng Viet
    //Created sql to delete data
    $sql = "UPDATE flights SET duration=355 WHERE id=1";
    //run the query
    if($conn->query($sql) === TRUE)
    {
        echo "The selected flight has been updated";
    }
    else
    {
        echo "Error: " .$sql. "<br>" .$conn->error;
    }
    //close the connection
    $conn->close();
    ?>
    
</body>
</html>