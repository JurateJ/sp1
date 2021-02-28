<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sp1</title>
    <style>
body {
  background-color: lightgoldenrodyellow;
}

h1 {
  color: red;
  text-align: center;
}
td {
  color: blue;
  /* min-width: 80px; */
  text-align: center;  
}
</style>
</head>
<body>
    
    <?php

    $dir    = "./".$_GET['path'];
    $files1 = scandir($dir);
    $files1 = array_diff($files1, array('.','..'));
    $files1 = array_values($files1);

    print("<br>");
    print("<h1 style>SP1</h1>");
    print("<br>");

    ?>

    <table>
     <tr>
       <td>title</td>
       <td>price</td>
       <td>number</td>
     </tr>
     <!-- <? foreach ($files1 as $files) : ?>
     <tr>
        <td><? if (is_dir($dir.$files)) {
                print("DIR");
               } elseif (is_file($dir.$files)) {
                print("Failas"); ?>
        </td>
       <!-- <td><? echo $row[1]; ?>
       </td>
       <td><? echo $row[2]; ?></td> -->
     </tr>
     
   </table> -->

    foreach ($files1 as $files) {
        print('<t>');
        print("<br>");
        if (is_dir($dir.$files)) {
            print("<td>DIR</td>");
            print('<td><a href=?path=' . urlencode($files) . '/>' . $files . '</a></td>');
            print("<td></td>");
        } elseif (is_file($dir.$files)) {
            print("<td>Failas</td>");
            print("<td>" . $files . "</td>");
            print("</td>");
        }
        print('</td>');
    }

    <?php
    function fard($files) {
    if (is_dir($dir.$files)) {
            print("<td>DIR</td>");
            print('<td><a href=?path=' . urlencode($files) . '/>' . $files . '</a></td>');
            print("<td></td>");
        } elseif (is_file($dir.$files)) {
            print("<td>Failas</td>");
            print("<td>" . $files . "</td>");
            print("</td>");
    }
    ?> 
     
    <!-- // for ($i=0; $i<count($files1); $i++) {
    //     print($i . " " . $files1[$i]);
    //     print("<br>");
    // }
       
    // echo '<br/>' . '$_SERVER[\'REQUEST_URI\']  spausdina  : ' . $_SERVER['REQUEST_URI']; -->

    <!-- ?> -->

    if (file_exists("a1")) {
        echo "The file a1 exists";
    } else {
        echo "The file a1 does not exist";
    }

    var_dump(is_dir('index.php'));
    print("<br>");
    var_dump(is_dir('a1')); 
    print("<br>");

   
</body>
</html>