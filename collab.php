<?php include __DIR__.'/inc/header.php'; ?>
<section class="max-w-7xl mx-auto px-4 py-12">
  <h1 class="text-3xl font-bold mb-6">Collab With Me</h1>
  <?php
    $tab = $_GET['tab'] ?? 'website';
    $page = max(1, intval($_GET['page'] ?? 1));
    $per = 16;
    $file = __DIR__ . '/../data/services/services_' . ($tab==='app'?'app':'website') . '.json';
    $list = is_file($file) ? json_decode(file_get_contents($file), true) : [];
    $total = count($list); $pages=max(1, ceil($total/$per)); $start=($page-1)*$per; $slice=array_slice($list,$start,$per);
  ?>
  <div class="flex gap-3 mb-6">
    <a class="px-4 py-2 rounded-full border <?= $tab==='website'?'bg-cyan-600 text-white border-cyan-600':'border-gray-300' ?>" href="?tab=website">Website</a>
    <a class="px-4 py-2 rounded-full border <?= $tab==='app'?'bg-cyan-600 text-white border-cyan-600':'border-gray-300' ?>" href="?tab=app">Application</a>
  </div>
  <?php if(!$slice): ?>
    <p class="text-gray-500">No services yet.</p>
  <?php else: ?>
    <div class="grid md:grid-cols-4 gap-6">
      <?php foreach($slice as $it): ?>
        <div class="border border-gray-200 rounded-xl p-5">
          <?php if(!empty($it['image'])): ?><img class="rounded-lg mb-3" src="/uploads/<?= htmlspecialchars($it['image']) ?>" alt=""><?php endif; ?>
          <h3 class="font-semibold mb-1"><?= htmlspecialchars($it['title']) ?></h3>
          <p class="text-gray-600 mb-2"><?= htmlspecialchars($it['description']) ?></p>
          <?php if(!empty($it['url'])): ?><a class="text-cyan-700" href="<?= htmlspecialchars($it['url']) ?>" target="_blank">Details</a><?php endif; ?>
          <?php if(!empty($it['content'])): ?><div class="mt-3"><?= $it['content'] ?></div><?php endif; ?>
        </div>
      <?php endforeach; ?>
    </div>
    <?php if($pages>1): ?>
      <div class="flex justify-center gap-2 mt-6">
        <?php for($i=1;$i<=$pages;$i++): ?>
          <a class="px-3 py-2 rounded border <?= $i==$page?'bg-cyan-600 text-white border-cyan-600':'border-gray-300' ?>" href="?tab=<?= $tab ?>&page=<?= $i ?>"><?= $i ?></a>
        <?php endfor; ?>
      </div>
    <?php endif; ?>
  <?php endif; ?>
</section>
<?php include __DIR__.'/inc/footer.php'; ?>
