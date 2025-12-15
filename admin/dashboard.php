<?php session_start(); if(empty($_SESSION['admin'])){ header('Location: /admin/login.php'); exit; } ?>
<!doctype html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1">
<title>Admin — Ilham</title>
<script src="https://cdn.tailwindcss.com"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
tinymce.init({ selector:'textarea.editor', plugins:'image media link code lists table', toolbar:'undo redo | styles | bold italic | alignleft aligncenter alignright | bullist numlist | image media link | table | code', height:420 });
</script>
<style>body{font-family:Inter,system-ui}</style>
</head><body class="bg-gray-50 text-gray-900">
<div class="max-w-6xl mx-auto p-4">

<div class="flex items-center justify-between mb-4">
  <h1 class="text-2xl font-bold">Dashboard</h1>
  <div class="space-x-2">
    <a class="px-4 py-2 bg-cyan-600 text-white rounded" href="/admin/new_post.php">New Post</a>
    <a class="px-4 py-2 bg-cyan-600 text-white rounded" href="/admin/new_portfolio.php">New Portfolio</a>
    <a class="px-4 py-2 bg-cyan-600 text-white rounded" href="/admin/new_service.php">New Service</a>
    <a class="px-4 py-2 border rounded" href="/admin/logout.php">Logout</a>
  </div>
</div>

<div class="grid md:grid-cols-2 gap-4">
  <div class="bg-white border rounded-xl p-4">
    <h2 class="font-semibold mb-2">Recent Posts</h2>
    <ul class="list-disc pl-6">
    <?php foreach(glob(__DIR__.'/../data/posts/*.json') as $f){ $j=json_decode(file_get_contents($f),true); echo '<li><a class="text-cyan-700" target="_blank" href="/pages/post.php?slug='.htmlspecialchars($j['slug']).'">'.htmlspecialchars($j['title']).'</a></li>'; } ?>
    </ul>
  </div>
  <div class="bg-white border rounded-xl p-4">
    <h2 class="font-semibold mb-2">Upload Center</h2>
    <form method="post" enctype="multipart/form-data" action="/admin/upload.php" class="flex gap-2">
      <input type="file" name="file" class="border rounded p-2" required>
      <button class="px-4 py-2 bg-cyan-600 text-white rounded">Upload</button>
    </form>
    <p class="text-gray-500 text-sm mt-2">Files will be stored in /uploads.</p>
  </div>
</div>
</div></body></html>