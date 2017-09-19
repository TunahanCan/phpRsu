<?php
session_start();
session_destroy();
echo "Sayin yönetici cikis yaptiniz. Ana sayfaya yonlendiriliyorsunuz";
header("Refresh: 2; url=index.php");
?>