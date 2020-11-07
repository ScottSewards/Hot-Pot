<?php
$title = "Writers' Block";
require "php/top.php";
?>
<template id="thread">
  <div class="thread">
    <header>
      <h2 id="thread-title"></h2>
    </header>
    <div class="thread-meta">
      <p class="thread-timestamp"><time datetime="2020-04-27 17:49">customise time tag</time></p>
      <p class="thread-comment-count">1000</p>
      <p class="thread-source"></p>
      <p class="thread-like-ratio">1 like (20%) vs. 4 dislikes (80%)</p>
      <p class="thread-author">Signature</p>
    </div>
  </div>
</template>
<main>
  <section>
    <header>
      <h1>The Writers' Block</h1>
    </header>
  </section>
  <section class="search">
    <form action="writers-block.php">
      <div>
        <input type="search" placeholder="Search..."/>
      </div>
    </form>
  </section>
  <article>
    <div class="thread">
      <header>
        <h2>Scott Spills the Beans</h2>
      </header>
      <p>Title | </p>
    </div>
  </article>
</main>
<?php
require "php/bottom.php";
?>
