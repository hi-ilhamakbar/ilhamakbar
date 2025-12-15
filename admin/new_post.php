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

<h2 class="text-xl font-semibold mb-4">New Post</h2>
<form method="post" action="/admin/save_post.php" class="space-y-3">
  <input class="w-full border rounded p-3" name="slug" placeholder="slug-url" required>
  <input class="w-full border rounded p-3" name="title" placeholder="Title" required>
  <input class="w-full border rounded p-3" name="date" value="<?php echo date('Y-m-d');?>" required>
  <input class="w-full border rounded p-3" name="author" value="Ilham Akbar" required>
  <input class="w-full border rounded p-3" name="summary" placeholder="Short summary" required>
  <input class="w-full border rounded p-3" name="cover_image" placeholder="cover file in /uploads (optional)">
  <input class="w-full border rounded p-3" name="attachments" placeholder="attach1.pdf, image.png (optional)">
  <textarea class="editor" name="content" placeholder="<p>Write here with images/embeds…</p>"></textarea>
  <button class="px-5 py-3 bg-cyan-600 text-white rounded">Save</button>
  <a href="/admin/dashboard.php" class="px-5 py-3 border rounded">Back</a>
</form>
</div></body></html>