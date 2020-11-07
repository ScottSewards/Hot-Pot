<?php
$title = "Signature";
require "php/top.php";
?>
<main>
  <section>
    <header>
      <h1>Signature <?php if(isset($_GET['sign'])) echo " for " . $_GET['sign'];?></h1>
    </header>
    <?php
    if(isset($_GET['sign'])) echo "<p>This webpage does not render Signatures yet.</p>";
    ?>
  </section>
  <section class="full-width">
    <img class="banner" src="https://user-images.githubusercontent.com/194400/49531010-48dad180-f8b1-11e8-8d89-1e61320e1d82.png" alt="">
    <img class='profile-pic' src="images/george.jpeg" alt="">
    <h1>@scottsewards</h1>
  </section>
  <section>
    <h2>Social Media</h2>
    <div class="carousel">
      <div>
        <p>Facebook</p>
        <img src="https://images-na.ssl-images-amazon.com/images/I/51lAc6kLN4L._AC_SX466_.jpg" alt="">
        <a href="https://www.facebook.com/scott.sewards.97/">scott.sewards.97</a>
      </div>
      <div>
        <p>Instagram</p>
        <img src="https://consequenceofsound.net/wp-content/uploads/2019/01/cage-elephant-social-cues-album-announce-artwork.jpg?quality=80" alt=""/>
        <a href="https://www.instagram.com/scottsewards/">scottsewards</a>
      </div>
      <div>
        <p>Snapchat</p>
        <img src="images/placeholder.png" alt=""/>
        <a href="https://www.snapchat.com/add/scottsewards">scottsewards</a>
      </div>
    </div>
  </section>
  <div class="tiles">
    <div>
      <h2>Current Listening</h2>
      <div class="track">
        <h3 class="track-artist"><span>Premonition - Intro</span> by <span>Eminem</span></h3>
        <picture class="track-cover">
          <img src="https://images.genius.com/109e5e1425790e8f1b776fea8a074a4d.1000x1000x1.jpg" alt=""/>
        </picture>
      </div>
    </div>
    <div>
      <h3>Ethereum Wallet Address</h3>
      <img id='ethereum-wallet-address-qr-code' class='qr-code' src='https://chart.googleapis.com/chart?cht=qr&chs=300x300&chl=0xA14Ae9BC94005A93934a027024EB7421215853Af&choe=UTF-8&chld=L|0' alt='Ethereum Wallet Address QR Code'/>
    </div>
  </div>
</main>
<?php
require "php/bottom.php";
?>
