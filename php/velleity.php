<?php
function SendEmail($recipient, $subject, $message, $name, $sender, $reply) {
  if($reply) $header = "From: $name <$sender> \r\n Reply-To: $sender \r\n X-Mailer: PHP/" . phpversion();
  else $header = "From: $name <$sender> \r\n X-Mailer: PHP/" . phpversion();
  mail($recipient, $subject, $message, $header);
  $message = "Email sent.";
}

function GetOrdinal($number) {
  if($number == 1 || $number == 21 || $number == 31) return "st";
  else if ($number == 2 || $number == 22) return "nd";
  else if ($number == 3 || $number == 23) return "rd";
  else return "th";
}
?>
