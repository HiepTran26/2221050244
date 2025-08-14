<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    function dislay_list_image($imageList, $image_width, $image_height)
{
    echo "<h1>function</h1>";
    foreach ($imageList as $item)
    {
        echo "<img src='img/$item' width = $image_width, height = $image_height alt='$item'>";
    }
} 
$item = array 
</body>
</html>