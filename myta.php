<?php
$title = "MyTA";
require "php/top.php";
?>
<main>
  <article>
    <h1>MyTA</h1>
    <div id='chatroom'>
      <p class="left">Hi, my name is Kadd. I am your teaching assistant. How can I help you today?</p>
      <?php if(isset($_POST["message"])) echo "<p class='box-right'>" . $_POST["message"] . "</p>"; ?>
      <?php if(isset($_POST["message"])) echo "<p class='left'>Unfortunately, I'm unavailable at the moment. But you can <a href='contact.php'>contact the administrator here</a>.</p>"; ?>
    </div>
    <hr>
    <form action="myta.php" method="post">
      <fieldset>
        <div>
          <label for='message'>Message*</label>
          <textarea id='message' name="message" cols="30" rows="10" placeholder="Write your message..." required></textarea>
        </div>
      </fieldset>
      <input type="submit" name="send-message" value="Send Message">
    </form>
    <!--p><a href="https://web-chat.global.assistant.watson.cloud.ibm.com/preview.html?region=eu-gb&integrationID=cda83afe-ae09-4b14-886c-9fe75f424373&serviceInstanceID=88e1415a-dae9-4197-8d88-c9ac712f6dc8">Ask Kadd anything</a></p-->
  </section>
</main>
<?php
require "php/bottom.php";
?>
