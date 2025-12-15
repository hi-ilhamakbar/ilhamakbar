<?php session_start(); $err=''; if($_POST){ if(($_POST['u']??'')==='gdx' && ($_POST['p']??'')==='Kontol100%'){ $_SESSION['admin']=true; header('Location:/admin/dashboard.php'); exit; } else $err='Invalid credentials'; } ?>
<!doctype html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><script src="https://cdn.tailwindcss.com"></script><link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet"></head>
<body class="bg-gray-50" style="font-family:Inter,system-ui">
<div class="max-w-md mx-auto mt-24 bg-white p-6 rounded-xl shadow">
<h1 class="text-xl font-bold mb-4">Admin Login</h1>
<?php if($err) echo "<div class='p-3 mb-3 border border-red-200 text-red-700 rounded'>$err</div>"; ?>
<form method="post" class="space-y-3">
<input class="w-full border rounded p-3" name="u" placeholder="Username" required>
<input class="w-full border rounded p-3" type="password" name="p" placeholder="Password" required>
<button class="w-full bg-cyan-600 hover:bg-cyan-700 text-white rounded p-3">Sign in</button>
</form>
</div></body></html>
