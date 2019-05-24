<?php
class NewsletterSC {
	// [Newsletter_CantDisplay id=""]
	public static function CantDisplay($params = array()) {
		if (isset ( $params ['id'] )) {
			$render = '<p align="center">';
			$render .= '<a href="http://' . $_SERVER ['HTTP_HOST'] . '/newsletter.php?id=' . $params ['id'] . '">';
			$render .= 'Si vous ne visualisez pas cet e-mail, rendez-vous sur cette page.';
			$render .= '</a></p>';
			return $render;
		}
		return '';
	}

	// [Newsletter_UserInfo id=""]
	public static function UserInfo($params = array()) {
		if (isset ( $params ['id'] )) {
			$sql = "SELECT * FROM annuaire_individu WHERE IndividuID='%s'";
			$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $params ['id'] ) );
			$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

			$render = '';
			while ( $line = mysqli_fetch_array  ( $result ) ) {
				$render .= 'Bonjour ' . $line ['Prenom'] . ' ' . $line ['Nom'] . ',<br>';
				$render .= '<p>Voici vos identifiants de connexion :</p>';
				$render .= '<p>Login : ' . $line ['Login'] . '</p>';
				$render .= '<p>Mot de passe : ' . $line ['Password'] . '</p>';
			}
			return $render;
		}
		return '';
	}

	// [Newsletter_UserInfo id=""]
	public static function NameUser($params = array()) {
		if (isset ( $params ['id'] )) {
			$sql = "SELECT * FROM annuaire_individu WHERE IndividuID='%s'";
			$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $params ['id'] ) );
			$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

			$render = '';
			while ( $line = mysqli_fetch_array  ( $result ) ) {
				$render .= $line ['Prenom'] . ' ' . $line ['Nom'];
			}
			return $render;
		}
		return '';
	}

	// [Newsletter_UserInfo id=""]
	public static function LoginUser($params = array()) {
		if (isset ( $params ['id'] )) {
			$sql = "SELECT * FROM annuaire_individu WHERE IndividuID='%s'";
			$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $params ['id'] ) );
			$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

			$render = '';
			while ( $line = mysqli_fetch_array  ( $result ) ) {
				$render .= 'Nom d\'utilisateur : ' . $line ['Login'] . '<br />';
				$render .= 'Mot de passe : ' . $line ['Password'];
			}
			return $render;
		}
		return '';
	}
}