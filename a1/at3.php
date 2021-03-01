<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sp1</title>
    <style>
    body {
       background-color: lightgoldenrodyellow;
    }
    h1 {
      color: blueviolet;
      text-align: center;
    }
</style>
</head>
<body>

  <h2></h2>
  <button onclick="goBack()">ATGAL</button>
  <script>
  function goBack() {
    window.history.back();
  }
  </script>

<?php

  $dir    = "./".$_GET['path'];
  $files1 = scandir($dir);
  $files1 = array_diff($files1, array('.','..'));
  $files1 = array_values($files1);

  print("<h1 style>SP1</h1>");
  
  foreach ($files1 as $files) {
    print("<br>");
    if (is_dir($dir.$files)) {
        print("<td>DIR </td>");
        print('<td><a href=?path=' . urlencode($files) . '/>' . $files . '</a></td>');
        print("<td></td>");
    } elseif (is_file($dir.$files)) {
        print("<td>Failas </td>");
        print("<td>" . $files . "</td>");
        print("</td>");
    }
    print('</td>');
  }

?>

   
</body>
</html>