<?php include __DIR__.'/inc/header.php'; ?>
<section class="max-w-7xl mx-auto px-4 py-12">
<h1 class="text-3xl font-bold mb-6">Blog</h1>
<?php
$dir=__DIR__.'/data/posts';
$files=glob($dir.'/*.json');
usort($files, function($a,$b){return strcmp($b,$a);});
if(!$files){ echo "<p class='text-gray-500'>No posts yet.</p>";}
else{
  echo "<div class='grid md:grid-cols-2 gap-6'>";
  foreach($files as $f){
    $j=json_decode(file_get_contents($f), true);
    if(!$j) continue;
    $slug=htmlspecialchars($j['slug']);
    $title=htmlspecialchars($j['title']);
    $summary=htmlspecialchars($j['summary']);
    $date=date('M d, Y', strtotime($j['date']));
    echo "<a href='/pages/post.php?slug=$slug' class='block border border-gray-200 rounded-xl p-5 hover:border-cyan-500'>";
    echo "<h3 class='text-xl font-semibold mb-2'>$title</h3><div class='text-sm text-gray-500 mb-2'>$date — ".$j['author']."</div><p class='text-gray-600'>$summary</p></a>";
  }
  echo "</div>";
}
?>
</section>
<?php include __DIR__.'/inc/footer.php'; ?>