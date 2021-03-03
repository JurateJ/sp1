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
    td {
      border: 1px solid black;
    } 
</style>
</head>
<body>

<?php 
  
    if(isset($_FILES['image'])){
      $errors= array();
      $file_name = $_FILES['image']['name'];
      $file_size = $_FILES['image']['size'];
      $file_tmp = $_FILES['image']['tmp_name'];
      $file_type = $_FILES['image']['type'];

      $file_ext = strtolower(end(explode('.',$_FILES['image']['name'])));
      $extensions = array("jpeg","jpg","png", "docx");
      if(in_array($file_ext, $extensions)=== false){
          $errors[] = "Pasirinkite JPEG, PNG  ar DOCX failą.";
      }
      if($file_size > 2097152) {
        $errors[]='Failas turi būti ne didesnis nei 2 MB';
      }
      if(empty($errors)==true) {
        move_uploaded_file($file_tmp, './'. './' . $file_name);
        echo "Pavyko įkelti failą!";
      } else {
        print_r($errors);
      }    
    }

   // Download
   if(isset($_POST['download'])){
    print('Path to download: ' . './' . $_GET["path"] . $_POST['download']);
    // $file='./' . $_GET["path"] . $_POST['download'];
    // a&nbsp;b.txt
    // a b.txt
    // $fileToDownloadEscaped = str_replace("&nbsp;", " ", htmlentities($file, null, 'utf-8'));
    // ob_clean();
    // ob_start();
    // header('Content-Description: File Transfer');
    // header('Content-Type: application/pdf'); // mime type → ši forma turėtų veikti daugumai failų, su šiuo mime type. Jei neveiktų reiktų daryti sudėtingesnę logiką
    // header('Content-Disposition: attachment; filename=' . basename($fileToDownloadEscaped));
    // header('Content-Transfer-Encoding: binary');
    // header('Expires: 0');
    // header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    // header('Pragma: public');
    // header('Content-Length: ' . filesize($fileToDownloadEscaped)); // kiek baitų browseriui laukti, jei 0 - failas neveiks nors bus sukurtas
    // ob_end_flush();
    // readfile($fileToDownloadEscaped);
    // exit;
}

?>

<form action="" method="POST" enctype="multipart/form-data">
         <input type="file" name="image" />
         <input type="submit"/>
      </form>

<?php
  session_start(); 
  if(isset($_GET['action']) and $_GET['action'] == 'logout'){
    session_start();
    unset($_SESSION['username']);
    unset($_SESSION['password']);
    unset($_SESSION['logged_in']);
    // $_SESSION['logout_msg'] = 'Pavyko atsijungti!';
    $msg = 'Pavyko atsijungti!';
    // header('Location: http://localhost/sp1/');
    // exit;
}

  if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])) {	
    if ($_POST['username'] == 'Mindaugas' && $_POST['password'] == '1234') {
      $_SESSION['logged_in'] = true;
      $_SESSION['timeout'] = time();
      $_SESSION['username'] = 'Mindaugas';
      $msg = 'Geras username arba/ir passwordas';
    } else {
      $msg = " Blogas username arba/ir password";
    }
  }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      $nameErr = "Only letters and white space allowed";
    }
  }
}

  $dir    = "./".$_GET['path'];
  $files1 = scandir($dir);
  $files1 = array_diff($files1, array('.','..'));
  $files1 = array_values($files1);

  print("<h1>SP1</h1>");
 ?>

 <table> 

 <?php 
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
  <button onclick="goBack()">Back</button>
  <script>
  function goBack() {
    window.history.back();
  }
  </script>

   <h2></h2>
   <input type="text" name="name" value="<?php $name;?>">
   <button onclick= "<?php mkdir("name"); ?>" >Make directory</button>  
   
<?php
   if($_SESSION['logged_in'] == true){
      print('<h1>Prisijungimas pavyko!</h1>');
    }
?>

   <form action="./index.php" method="post">
      <h4><?php echo $msg; ?></h4>
      <input type="text" name="username" placeholder="username = Mindaugas" required autofocus></br>
      <input type="password" name="password" placeholder="password = 1234" required>
      <button class = "btn btn-lg btn-primary btn-block" type="submit" name="login">Login</button>
    </form>
<BR>
    Click here to <a href = "index.php?action=logout"> logout

</body>
</html>