<?php session_start(); if(empty($_SESSION['admin'])){header('Location:/admin/login.php');exit;}
$type = ($_POST['type']??'website')==='app'?'app':'website';
$title=trim($_POST['title']??''); $description=trim($_POST['description']??''); $url=trim($_POST['url']??'');
$image=trim($_POST['image']??''); $content=$_POST['content']??''; $attachments=array_filter(array_map('trim', explode(',', $_POST['attachments']??'')));
if(!$title||!$description){ die('Missing fields'); }
$path=__DIR__.'/../data/services/services_' . $type . '.json';
$list=is_file($path)?json_decode(file_get_contents($path),true):[]; if(!is_array($list))$list=[];
$list[]=['type'=>$type,'title'=>$title,'description'=>$description,'url'=>$url,'image'=>$image,'content'=>$content,'attachments'=>$attachments];
file_put_contents($path, json_encode($list, JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES));
header('Location:/admin/dashboard.php');