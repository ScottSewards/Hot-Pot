<?php
$title = "Signature";
require_once("head.php");
?>
<main>
  <section>
    <img class="banner" src='images/banner.png' alt='Banner'/>
    <img class='profile-pic' src='images/placeholder.png' alt='Image'/>
    <!--h1>Signature <?php if(isset($_GET['sign'])) echo " for " . $_GET['sign'];?></h1-->
    <h1>@<?php if(isset($_GET['sign'])) echo $_GET['sign']; ?></h1>
  </section>

  <section>
    <h2>Signature is listening to</h2>
    <div id='track'>
      <div id='track-art'>
        <img id='track-cover' title='Rammstein Album Cover' src='images/rammstein.jpg' alt='Rammstein Album Cover'/>
      </div>
      <div id='track-information'>
        <h3 id='track-artist'>Rammstein by Rammstein</h3>
      </div>
    </div>
  </section>

  <section class='hide'>
    <h2>Social Media</h2>
    <?php
    echo "There are no links.";
    ?>
    <!--div class="carousel">
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
    </div-->
  </section>

  <section class='hide'>
    <div>
      <h3>Ethereum Wallet Address</h3>
      <img id='ethereum-wallet-address-qr-code' class='qr-code' src='https://chart.googleapis.com/chart?cht=qr&chs=300x300&chl=0xA14Ae9BC94005A93934a027024EB7421215853Af&choe=UTF-8&chld=L|0' alt='Ethereum Wallet Address QR Code'/>
    </div>
  </section>
</main>
<?php
require_once("foot.php");
?>
