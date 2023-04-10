<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>
<?php require base_path('views/partials/banner.php'); ?>

<main>
  <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
    <ul class="list-disc">
      <?php if (empty($notes)) : ?>
        <div class="text-gray-500 text-3xl font-bold mt-4">
          No Notes...
        </div>
      <?php endif; ?>
      <?php foreach ($notes as $note) : ?>
        <li>
          <a href="/note?id=<?= $note['id'] ?>" class="text-blue-500 hover:underline text-lg"><?= $note['title'] ?></a>
        </li>
      <?php endforeach; ?>
    </ul>
    <div class="mt-9">
      <a href="/notes/create" class="bg-blue-500 px-5 py-3 text-white">Create Note</a>
    </div>
  </div>
</main>

<?php require base_path('views/partials/foot.php'); ?>