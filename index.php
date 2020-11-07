<?php
require "php/top.php";
?>
<main>
  <section>
    <header>
      <h1>Index</h1>
      <h2>Apps</h2>
    </header>
    <div class="grid-2">
      <div class=''>
        <h2>Attic</h2>
        <p>Attic is a web-based video player.</p>
        <p><a href="attic.php">Preview Attic here</a>.</p>
      </div>
      <div class=''>
        <h2>Codechart</h2>
        <p>Create code-based flowcharts in Pseudocode, JavaScript or Python.</p>
        <p><a href="codechart.php">Preview Codechart here</a>.</p>
      </div>
      <div class=''>
        <h2>Fingertip</h2>
        <p>Fingertip is a text editor.</p>
        <p><a href="text-editor.php">Preview Fingertip here</a>.</p>
      </div>
      <div>
        <h2>Leaves</h2>
        <p>Leaves is a family tree web app.</p>
        <p><a href="leaves.php">Preview Leaves here</a>.</p>
      </div>
      <div class=''>
        <h2>MyTA</h2>
        <p>MyTA is a virtual teaching assistant for teachers.</p>
        <p><a href="myta.php">Preview MyTA here</a>.</p>
      </div>
      <div class=''>
        <h2>PomPay</h2>
        <p>No description.</p>
        <p><a href="pompay.php">Preview PomPay here</a>.</p>
      </div>
      <div class=''>
        <h2>PuzzleBundle</h2>
        <p>PuzzleBundle is a collection of puzzle games in a mobile application.</p>
        <p><a href="hexadoku.php">Preview Hexadoku here</a>.</p>
      </div>
      <div class=''>
        <h2>Rome: Built in a Day</h2>
        <p>A mobile video game. Players have 24 hours to build Rome. After 24 hours, their progress is scored, uploaded to the leaderboard, then deleted.</p>
      </div>
      <div>
        <h2>Scenes</h2>
        <p>Scenes is an anthological video game containing various small games.</p>
        <p><a href="scenes.php">Preview Scenes here</a>.</p>
      </div>
      <div>
        <h2>Signature</h2>
        <p>Signature.</p>
        <p>Signpost is a anchor .</p>
        <p><a href="signature.php">Preview Signature here</a>.</p>
      </div>
      <div class=''>
        <h2>Velleity</h2>
        <p>Velleity is a front-end framework.</p>
        <p><a href="velleity.php">Preview Velleity here</a>.</p>
      </div>
      <div>
        <h2>Weight Manager</h2>
        <p>This is a weight management PWA.</p>
        <p><a href="weight-manager.php">Preview Weight Manager here</a>.</p>
      </div>
      <div class="">
        <h2>Writers' Block</h2>
        <p>No description.</p>
      </div>
    </div>
  </section>
</main>

<main>
  <section class="full-width">
    <img class="banner" src="https://user-images.githubusercontent.com/194400/49531010-48dad180-f8b1-11e8-8d89-1e61320e1d82.png" alt="">
    <img class='profile-pic' src="img/george.jpeg" alt="">
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
        <img src="https://scottsewards.github.io/img/placeholder.png" alt=""/>
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



<main>
  <section>
    <header>
      <h1>Signature</h1>
      <h2>About</h2>
    </header>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
  </section>
  <section>
    <form action='index.php' method='post'>
      <fieldset>
        <legend>Sign-in</legend>
        <div>
          <label for='sign-in-email-address'>Email*</label>
          <input id='sign-in-email-address' type='email' name='email-address' placeholder='orsonwells@hotmail.com' required>
        </div>
        <div>
          <label for='sign-in-password'>Password*</label>
          <input id='sign-in-password' type='password' name='password' placeholder='CitizenKane1941' autocomplete='' required>
          <input type='button' value='Show' name='show-password'>
        </div>
        <div>
          <label for='stay-signed-in'>Stay Signed In?</label>
          <input id='stay-signed-in' class='yes-no' type='checkbox' name='stay-signed-in'>
        </div>
        <input type='submit' name='sign-in' value='Sign-in'>
      </fieldset>
    </form>
    <form action='index.php' method='post'>
      <fieldset>
        <legend>Sign-up</legend>
        <div>
          <label for='sign-up-signature'>Signature*</label>
          <input id=sign-up-signature type='text' name='signature' placeholder='CharlieChaplin' required>
        </div>
        <div>
          <label for='sign-up-email-address'>Email*</label>
          <input id=sign-up-email-address type='email' name='email-address' placeholder='charleschaplin123@outlook.co.uk' require>
        </div>
        <div>
          <label for='sign-up-password'>Password*</label>
          <input id='sign-up-password' type='password' name='password' placeholder='TheGreatDictator1940' required>
          <input type='button' value='Show' name='show-password'>
        </div>
        <input type='submit' name='sign-up' value='Sign-up'>
      </fieldset>
    </form>
  </section>
</main>


<?php
require "php/bottom.php";
?>
