<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/nav.php'); ?>
<?php require base_path('views/partials/banner.php'); ?>

<main>
  <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
    <form method="POST" action="/note">
      <input type="hidden" name="_method" value="PATCH">
      <input type="hidden" name="id" value="<?= $note['id']  ?>">
      <div>
        <label for="title">Title</label>
        <div class="mt-2">
          <input class="focus:outline-none focus:border-gray-400 bg-gray-200 border border-gray-400 p-2" type="text" id="title" name="title" value="<?= $note['title'] ?>" placeholder="Add header..">
        </div>
        <?php if (isset($errors['title'])) : ?>
          <p class="text-sm text-red-500 mt-2">
            <?= $errors['title'] ?>
          </p>
        <?php endif; ?>
      </div>
      <div class="mt-4">
        <label for="body">Description</label>
        <div class="mt-2 mb-11 relative">
          <textarea class="focus:outline-none focus:border-gray-400 p-2 bg-gray-200 border border-gray-400" placeholder="Add your idea.." name="body" id="body" cols="80" rows="5"><?= $note['body'] ?></textarea>
          <div class="absolute top-[100%] left-0">
            <span class="text-gray-500" id="countUponTyping"></span>
            <span class="text-gray-500">/1000</span>
          </div>
        </div>
        <?php if (isset($errors['body'])) : ?>
          <p class="text-sm text-red-500 mt-2">
            <?= $errors['body'] ?>
          </p>
        <?php endif; ?>
      </div>
      <div class="mt-4">
        <button class="bg-blue-500 px-5 py-3 text-white mr-2">Update</button>
        <a href="/note?id=<?= $note['id'] ?>" class="border border-gray-500 px-5 py-3 text-black">Cancel</a>
      </div>
    </form>
  </div>
</main>
<script>
  let wordCount = document.getElementById('countUponTyping');
  const textArea = document.querySelector('#body');

  resetWordCount();
  textArea.onkeyup = increaseWordCount;

  function resetWordCount() {
    wordCount.innerText = textArea.value.length;
    if (textArea.value.length === 0) {
      wordCount.innerText = 0;
    }
  }

  function increaseWordCount(e) {
    wordCount.innerText = textArea.value.length;
    if (wordCount.innerText >= 1000) wordCount.innerText = 1000;
  }
</script>
<?php require base_path('views/partials/foot.php'); ?>