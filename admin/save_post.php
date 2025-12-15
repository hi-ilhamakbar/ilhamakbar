<?php session_start(); if(empty($_SESSION['admin'])){header('Location:/admin/login.php');exit;}
$slug=preg_replace('/[^a-z0-9-]+/','-', strtolower(trim($_POST['slug']??'')));
$title=trim($_POST['title']??''); $date=trim($_POST['date']??''); $author=trim($_POST['author']??''); $summary=trim($_POST['summary']??'');
$cover=trim($_POST['cover_image']??''); $attachments=array_filter(array_map('trim', explode(',', $_POST['attachments']??'')));
$content=$_POST['content']??'';
if(!$slug||!$title||!$date||!$author||!$summary||!$content){ die('Missing fields'); }
$post=['slug'=>$slug,'title'=>$title,'date'=>$date,'author'=>$author,'summary'=>$summary,'cover_image'=>$cover,'attachments'=>$attachments,'content'=>$content];
file_put_contents(__DIR__.'/../data/posts/'.$slug.'.json', json_encode($post, JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES));
header('Location:/admin/dashboard.php');