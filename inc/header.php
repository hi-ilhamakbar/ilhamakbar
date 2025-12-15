<?php
// inc/header.php — responsive header with mobile menu
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Ilham Akbar - Senior QA Automation Engineer</title>
<meta name="description" content="Senior/Lead QA Automation Engineer. Appium, Selenium, CI/CD.">
<link rel="canonical" href="https://ilhamakbar.com/">

<!-- Tailwind CDN -->
<script src="https://cdn.tailwindcss.com"></script>
<!-- Inter font -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
  body{font-family:'Inter',sans-serif;}
  .nav-link{transition:.2s}
  .nav-link:hover{color:#0EA5E9}
</style>
</head>
<body class="bg-white text-gray-800">
<header class="sticky top-0 z-30 shadow-sm bg-white/95 backdrop-blur">
  <nav class="max-w-7xl mx-auto py-4 px-4">
    <div class="flex items-center justify-between">
      <a href="/index.php" class="text-xl font-semibold text-gray-900">Ilham Akbar</a>

      <!-- Desktop nav -->
      <div class="hidden md:flex items-center space-x-8 text-gray-700 font-medium">
        <a href="/index.php" class="nav-link">Home</a>
        <a href="/about.php" class="nav-link">About</a>
        <a href="/blog.php" class="nav-link">Blog</a>
        <a href="/portfolio.php" class="nav-link">Portfolio</a>
        <a href="/collab.php" class="nav-link">Collab</a>
        <a href="/contact.php" class="nav-link">Contact</a>
      </div>

      <!-- Mobile menu button -->
      <button id="navToggle" aria-expanded="false" aria-controls="mobileNav" class="md:hidden inline-flex items-center justify-center w-10 h-10 rounded-lg border border-gray-200 text-gray-700 focus:outline-none focus:ring-2 focus:ring-cyan-500" type="button">
        <svg id="iconOpen" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
        <svg id="iconClose" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
        </svg>
        <span class="sr-only">Open menu</span>
      </button>
    </div>

    <!-- Mobile dropdown -->
    <div id="mobileNav" class="md:hidden hidden mt-3 border-t border-gray-200">
      <div class="py-2 space-y-1">
        <a href="/index.php" class="block px-2 py-2 text-gray-700 hover:text-cyan-700">Home</a>
        <a href="/about.php" class="block px-2 py-2 text-gray-700 hover:text-cyan-700">About</a>
        <a href="/blog.php" class="block px-2 py-2 text-gray-700 hover:text-cyan-700">Blog</a>
        <a href="/portfolio.php" class="block px-2 py-2 text-gray-700 hover:text-cyan-700">Portfolio</a>
        <a href="/collab.php" class="block px-2 py-2 text-gray-700 hover:text-cyan-700">Collab</a>
        <a href="/contact.php" class="block px-2 py-2 text-gray-700 hover:text-cyan-700">Contact</a>
      </div>
    </div>
  </nav>
</header>

<script>
  // Mobile nav toggle
  (function(){
    const btn = document.getElementById('navToggle');
    const menu = document.getElementById('mobileNav');
    const openI = document.getElementById('iconOpen');
    const closeI = document.getElementById('iconClose');
    if(btn && menu){
      btn.addEventListener('click', () => {
        const isOpen = !menu.classList.contains('hidden');
        menu.classList.toggle('hidden');
        btn.setAttribute('aria-expanded', String(!isOpen));
        openI.classList.toggle('hidden');
        closeI.classList.toggle('hidden');
      });
      // Close on ESC
      document.addEventListener('keydown', (e)=>{
        if(e.key === 'Escape' && !menu.classList.contains('hidden')){
          menu.classList.add('hidden');
          btn.setAttribute('aria-expanded','false');
          openI.classList.remove('hidden');
          closeI.classList.add('hidden');
        }
      });
    }
  })();
</script>
