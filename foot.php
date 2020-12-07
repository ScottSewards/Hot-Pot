    <footer>
      <p>© 2020 Scott Sewards</p>
      <form class='less' method='POST'>
        <input type='submit' name='sign-out' value='Sign-out' <?php if(!$signed_in) echo "disabled"; ?>>
      </form>
    </footer>
  </body>
</html>
<?php
mysqli_close($connection);
?>
