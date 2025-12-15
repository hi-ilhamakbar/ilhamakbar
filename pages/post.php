<?php include __DIR__.'/inc/header.php'; ?>
<section class="max-w-3xl mx-auto px-4 py-12">
<?php
$slug = $_GET['slug'] ?? '';
$file = __DIR__ . '/../data/posts/' . basename($slug) . '.json';
if(!is_file($file)){ echo "<p class='text-red-600'>Post not found.</p>"; }
else {
  $p = json_decode(file_get_contents($file), true);
  echo '<h1 class="text-3xl font-bold mb-2">'.htmlspecialchars($p['title']).'</h1>';
  echo '<div class="text-gray-500 mb-6">'.date('M d, Y', strtotime($p['date'])).' — '.htmlspecialchars($p['author']).'</div>';
  if(!empty($p['cover_image'])) echo '<img class="rounded-xl mb-6" src="/uploads/'.htmlspecialchars($p['cover_image']).'" alt="">';
  echo '<article class="prose max-w-none">'.($p['content']).'</article>';
  if(!empty($p['attachments'])){
    echo '<h3 class="mt-6 font-semibold">Attachments</h3><ul class="list-disc pl-6">';
    foreach($p['attachments'] as $a){
      $a = htmlspecialchars($a);
      echo "<li><a class='text-cyan-700' href='/uploads/$a' target='_blank'>$a</a></li>";
    }
    echo '</ul>';
  }
}
?>
</section>
<?php include __DIR__.'/inc/footer.php'; ?>
