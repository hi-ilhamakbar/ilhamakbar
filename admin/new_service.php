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

<h2 class="text-xl font-semibold mb-4">New Service</h2>
<form method="post" action="/admin/save_service.php" class="space-y-3">
  <select class="w-full border rounded p-3" name="type">
    <option value="website">Website</option>
    <option value="app">Application</option>
  </select>
  <input class="w-full border rounded p-3" name="title" placeholder="Title" required>
  <input class="w-full border rounded p-3" name="description" placeholder="Short description" required>
  <input class="w-full border rounded p-3" name="url" placeholder="https:// (optional)">
  <input class="w-full border rounded p-3" name="image" placeholder="image filename in /uploads (optional)">
  <textarea class="editor" name="content" placeholder="<p>HTML content / video embed…</p>"></textarea>
  <input class="w-full border rounded p-3" name="attachments" placeholder="attach1.pdf, image.png (optional)">
  <button class="px-5 py-3 bg-cyan-600 text-white rounded">Save</button>
  <a href="/admin/dashboard.php" class="px-5 py-3 border rounded">Back</a>
</form>
</div></body></html>