<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sp1</title>
</head>
<body>

    <?php

    if(isset($_POST['$files1'])){
        //print("<pre>Hello " . $_POST['$files1'] . "!</pre>");
        print("setina");
        print("<br>");
    } else print("nesetina"); print("<br>");

    $dir    = './';
    $files1 = scandir($dir);
    //$files2 = scandir($dir, 1);

    print_r($files1);
    print("<br>");
    //print_r($files2);
    //print("<br>");

    for ($i=0; $i<count($files1); $i++) {
        print($i . " " . $files1[$i]);
        print("<br>");
    }

    var_dump(is_dir('index.php'));
    print("<br>");
    var_dump(is_dir('a1')); 
    print("<br>");

    if (file_exists("a1")) {
        echo "The file a1 exists";
    } else {
        echo "The file a1 does not exist";
    }

    echo '<br/>' . '$_SERVER[\'REQUEST_URI\']  spausdina  : ' . $_SERVER['REQUEST_URI'];

    ?>
   
</body>
</html>