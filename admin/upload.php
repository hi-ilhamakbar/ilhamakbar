<?php session_start(); if(empty($_SESSION['admin'])){header('Location:/admin/login.php');exit;}
if(!empty($_FILES['file']['name'])){
  $name=basename($_FILES['file']['name']);
  $dest=__DIR__.'/../uploads/'.$name;
  if(move_uploaded_file($_FILES['file']['tmp_name'],$dest)){
    echo "<p>Uploaded: <a href='/uploads/".htmlspecialchars($name)."' target='_blank'>".htmlspecialchars($name)."</a></p>";
  } else { echo "<p>Upload failed.</p>"; }
} else { echo "<p>No file.</p>"; }
echo "<p><a href='/admin/dashboard.php'>Back</a></p>";
