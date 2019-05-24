<?php
$link_prestashop = mysqli_connect ( $CONFIG_MYSQL_HOSTNAME_PRESTASHOP, $CONFIG_MYSQL_USERNAME_PRESTASHOP, $CONFIG_MYSQL_PASSWORD_PRESTASHOP,$CONFIG_MYSQL_BASENAME_PRESTASHOP );
mysqli_set_charset($link_prestashop, "ISO-8859-1");
$_SESSION['LINK_PRESTASHOP'] = $link_prestashop;

?>