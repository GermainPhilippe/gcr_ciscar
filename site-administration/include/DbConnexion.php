<?php
$link = mysqli_connect ( $CONFIG_MYSQL_HOSTNAME, $CONFIG_MYSQL_USERNAME, $CONFIG_MYSQL_PASSWORD,$CONFIG_MYSQL_BASENAME );
mysqli_set_charset($link, "ISO-8859-1");
$_SESSION['LINK'] = $link;
?>