<?php 

//logout
session_start(); 
if(isset($_GET['action']) and $_GET['action'] == 'logout'){
  session_start();
  unset($_SESSION['username']);
  unset($_SESSION['password']);
  unset($_SESSION['logged_in']);
  $_SESSION['logout_msg'] = 'Pavyko atsijungti!';
  // $msg = 'Pavyko atsijungti!';
  header('Location: index.php');
  exit;
}

//login
if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])) {	
  if ($_POST['username'] == 'asdf' && $_POST['password'] == '4567') {
    $_SESSION['logged_in'] = true;
    $_SESSION['timeout'] = time();
    $_SESSION['username'] = 'asdf';
    header('Location: index.php');
  // } else {
  //   $msg = " Blogas username arba/ir password";
  // }
  } else {
  $msg = " Blogas username arba/ir password";
  }
}

  $dir    = "./".$_GET['path'];
  $files1 = scandir($dir);
  $files1 = array_diff($files1, array('.','..','.git'));
  $files1 = array_values($files1);

  if(isset($_FILES['image'])){
    $errors= array();
    $file_name = $_FILES['image']['name'];
    $file_size = $_FILES['image']['size'];
    $file_tmp = $_FILES['image']['tmp_name'];
    $file_type = $_FILES['image']['type'];

    //upload
    $file_ext = strtolower(end(explode('.',$_FILES['image']['name'])));
    $extensions = array("jpeg","jpg","png", "docx");
    if(in_array($file_ext, $extensions)=== false){
        $errors[] = "Pasirinkite JPEG, JPG, PNG  ar DOCX failą.";
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

  // download
  if(isset($_POST['download'])){
  $file= $_GET["path"] . $_POST['download'];
  $fileToDownloadEscaped = str_replace("&nbsp;", " ", htmlentities($file, null, 'utf-8'));
  ob_clean();
  ob_start();
  header('Content-Description: File Transfer');
  header('Content-Type: application/pdf'); // mime type → ši forma turėtų veikti daugumai failų, su šiuo mime type. Jei neveiktų reiktų daryti sudėtingesnę logiką
  header('Content-Disposition: attachment; filename=' . basename($fileToDownloadEscaped));
  header('Content-Transfer-Encoding: binary');
  header('Expires: 0');
  header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
  header('Pragma: public');
  header('Content-Length: ' . filesize($fileToDownloadEscaped)); // kiek baitų browseriui laukti, jei 0 - failas neveiks nors bus sukurtas
  ob_end_flush();
  readfile($fileToDownloadEscaped);
  exit;
}

//delete
if (isset($_POST['delete'])) {
  unlink($_GET['path'] . $_POST['delete']);
  header('Location: ' .  $_SERVER['REQUEST_URI']);
}

//back
$previous = "javascript:history.go(-1)";
  if(isset($_SERVER['HTTP_REFERER'])) {
    $previous = $_SERVER['HTTP_REFERER'];
}

//make directory
if (isset($_POST['ndir'])) {
  if (is_dir($_POST['ndir'])) {
      print('<div style="color: red;">The directory with name <i><b>' . $_POST['ndir'] . '</b></i> already exists</div>');
  } else {
      mkdir($_GET['path'] . $_POST['ndir']);
      header('Location: ' .  $_SERVER['REQUEST_URI']);
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>sp1</title>
</head>
<body>
   
<?php

  //back
  if($_SESSION['logged_in'] == true){
      print('<h3>Jūs sėkmingai prisijungėte!</h3>');        
?>
      <a href="<?= $previous ?>">Atgal</a>
<?
      print("<br>");
?>
  
  <table >

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
          <td><form action='' method='POST'> 
          <button type='submit' name='delete' value='" . $files . "'>delete</button>
          <td><form action='download' method='POST'> 
          <button type='submit' name='download' value='" . $files . "'>download</button>
          </form>          
          ");    
    }
    print('</tr>'); 
    }
    ?>
    </table>
    <br>
    
  <form action="" method="POST">
      <input type="text" name="ndir" placeholder="Nauja direktorija">
      <input type="submit" value="Sukurti">
  </form>
  <br>

    <?

    //upload formos kvietimas
    print('<form action="" method="POST" enctype="multipart/form-data">
    <input type="file" name="image" />
    <input type="submit"/>
    </form>
    <br>
    <a href = "index.php?action=logout"> Atsijungti
    ');

    } else {
  
    print ('<form action="./index.php" method="post">
    <input type="text" name="username" placeholder="įveskite asdf" required autofocus></br>
    <input type="password" name="password" placeholder="įveskite 4567" required>
    <button type="submit" name="login">Prisijungti</button>
    </form> ');
    }
?> 

</body>
</html>