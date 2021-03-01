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
      color: green;
      text-align: left;
    }
    table {
      width: 40%;
      background-color: palegreen;
      color: grey;
      border: 1px solid black;
    }
    /* tr {
      border: 1px solid black;
    } */
    td {
      border: 1px solid black;
    } 
</style>
</head>
<body>
  <h2></h2>
  <button onclick="goBack()">Back</button>
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

  print("<h1>SP1</h1>");
 ?>

 <table> 

 <?  
  foreach ($files1 as $files) {
    print('<tr>');
    if (is_dir($dir.$files)) {
        print("<td>DIR </td>");
        print('<td><a href=?path=' . urlencode($files) . '/>' . $files . '</a></td>');
        print("<td></td>");
    } elseif (is_file($dir.$files)) {
        print("<td>Failas </td>
          <td>{$files}</td>
          <td><form action='deletes.php' method='POST'> 
          <input type='hidden' name='file_name' value='" . $files . "'>
          <input type='submit' name='delete_file' value= 'delete'>
          </form>
          ");
    }
    print('</tr>'); 
  }

  ?>
   </table>

   <h2></h2>
   <!-- <button onclick=' " . mkdir('/sp1/' );  . " >Make directory</button> -->
   <button onclick= "<?php mkdir("test3"); ?>" >Make directory</button>  
   
</body>
</html>