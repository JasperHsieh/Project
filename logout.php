<?php
echo "logout.php <br>";
setcookie("c_user", "", time()-3600);
setcookie("c_salt", "", time()-3600);

header("Location: index.html");
?>
