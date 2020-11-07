<?php
$title = "PomPay";
require "php/top.php";
?>
<main>
  <section>
    <h1>PomPay</h1>
    <div class="grid-2">
      <div>
        <h3>Bitcoin</h3>
        <div>
          <p>Address: <span id='bitcoinAddress'></span></p>
        </div>
      </div>
      <div>
        <h3>Bitcoin Cash</h3>
        <p>Address: <span id='bitcoinCashAddress'></span></p>
      </div>
      <div>
        <h3>Litecoin</h3>
        <p>Address: <span id='litecoinAddress'></span></p>
      </div>
      <div>
        <h3>Ethereum</h3>
        <p>Address: <span id='ethereumAddress'></span></p>
        <?php
        $ethereumWallet = "0xA14Ae9BC94005A93934a027024EB7421215853Af";
        //if(isset($ethereumWallet)) echo "<img id='ethereumQR' src='https://chart.googleapis.com/chart?cht=qr&chs=300x300&chl=$ethereumWallet&choe=UTF-8&chld=L|0' alt='Ethereum Wallet Address QR Code'/>";
        ?>
      </div>
    </div>
    <form class="" action="index.html" method="post">

    </form>
  </section>
</main>
<?php
require "php/bottom.php";
?>
