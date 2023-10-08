<?php
session_unset();
session_destroy();
echo "<script>window.location.href='../form.php#login';</script>";
exit;

?>