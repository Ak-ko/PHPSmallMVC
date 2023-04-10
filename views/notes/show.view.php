<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>
<?php require base_path('views/partials/banner.php'); ?>

<main>
  <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
    <a href="/notes" class="text-blue-500 hover:underline">
      < Go Back</a>
        <div class="bg-gray-300 p-4 px-11 hover:bg-blue-200 cursor-pointer transition-background duration-500 mt-11 rounded-xl" id="aNote" data-id="<?= $note['id'] ?>">
          <h1 class="text-2xl mt-5 border-b-2 font-bold"><?= $note['title'] ?></h1>
          <p class="mt-3 leading-relaxed">
            <?= $note['body'] ?>
          </p>
          <form class="mt-6" method="POST">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="id" value="<?= $note['id'] ?>">
            <button class="text-sm bg-red-500 text-white px-3 py-2 mt-5 hover:opacity-[0.95]">Delete</button>
          </form>
        </div>
  </div>
</main>

<script>
  const noteId = document.getElementById('aNote').getAttribute("data-id");
  document.getElementById('aNote').ondblclick = () => {
    window.location.href = "/note/edit?id=" + noteId;
  }
</script>

<?php require base_path('views/partials/foot.php'); ?>