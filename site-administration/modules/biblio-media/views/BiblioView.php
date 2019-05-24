<?php
class BiblioView {
	private $instance;
	public function __construct(BiblioMedia $biblio) {
		$this->instance = $biblio;
	}
	public function renderHTML() {
		$aff = '';

		if (isset ( $_GET ['action'] ) && $_GET ['action'] == 'fckeditornew') {
			$aff .= '
			<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15" />';

			$aff .= HelperHead::includeCSS ( '../../include/css/Commun.css' );
			$aff .= HelperHead::includeCSS ( '../../include/css/CommunLayout.css' );
			$aff .= HelperHead::includeJS ( '../../include/js/CommunScript.js' );
			$aff .= HelperHead::includeJS ( '../../include/js/jquery/jquery-1.4.2.js' );

			$aff .= '<title>' . $_SESSION ['SITE'] ['NAME'] . ' : Admin</title>
				
			<!-- Plugin JQUERY Tools Tab -->
			<script type="text/javascript" src="/admin/include/js/jquery/Tools_Tabs/tools.tabs-1.0.4.js"></script>
			<link href="/admin/include/js/jquery/Tools_Tabs/css/tabs.css" rel="stylesheet" type="text/css"/>
			<style>
			a:active {
			outline:none;
			}
			
			:focus {
			-moz-outline-style:none;
			}
			
			/* tab pane styling */
			div.panes div {
				
			padding:15px 10px;
			border:1px solid #999;
			border-top:0;
			font-size:14px;
			background-color:#fff;
			}
			</style>
			<script>
			function displayFichier() {
			$("#fichier").show();
			$("#btRemplacer").hide();
			}
			</script>
			</head>
			<body>';
		}

		$aff .= '<form method="post" enctype="multipart/form-data">';

		if (isset ( $_GET ['action'] ) && $_GET ['action'] == 'fckeditornew') {
			$aff .= '<div style="background:#FFFFFF;">';
			$aff .= '<div id="FilAriane">Web Content&nbsp;>&nbsp;<a href="index_simple.php?action=fckeditor">Médiathèque</a>&nbsp;>&nbsp;Création</div><br>';
		} else {
			$aff .= '<div id="FilAriane"><a href="../../?menu=1">Général</a>&nbsp;>&nbsp;<a href="?">Médiathèque</a>';
			if ($this->instance->getFileName () != '') {
				$aff .= '&nbsp;>&nbsp;Edition';
			} else {
				$aff .= '&nbsp;>&nbsp;Création';
			}

			$aff .= '</div><br/>';
		}

		if ($this->instance->getFileName () != '') {
			$aff .= '<table>';
			$aff .= '<tr>';
			$aff .= '<td><img src="../../include/images/icon/1340374771_library.png"></td>';
			$aff .= '<td>';
			$aff .= '<b>Nom du fichier</b> : ' . $this->instance->getFileName () . '<br>';
			$aff .= '<b>Type du fichier</b> : ' . $this->instance->getFileMime () . '<br>';
			$aff .= '<b>Taille</b> : ' . $this->display_filesize ( $this->instance->getFileSize () ) . '<br>';
			$aff .= '<b>Date de mise en ligne</b> : ' . $this->getDateFR ( $this->instance->getCreateOn () ) . '<br>';
			$aff .= '</td>';
			$aff .= '</tr>';
			$aff .= '</table><br><br>';
		}

		$aff .= '<table>';

		$aff .= '<tr>';
		$aff .= '<td>Titre</td>';
		$aff .= '<td><input type="text" name="titre" value="' . stripslashes ( $this->instance->getTitre () ) . '" size="50"></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td>Description</td>';
		$aff .= '<td><textarea name="description" rows="3" cols="50">' . stripslashes ( $this->instance->getDescription () ) . '</textarea></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td>Fichier</td><td>';
		// if($this->instance->getFileName() != '') {
		// $aff .= '<input type="button" id="btRemplacer" value="Remplacer" onclick="displayFichier()">';
		// $aff .= '<input type="file" id="fichier" name="fichier" size="50" style="display:none;">';
		// } else {
		$aff .= '<input type="file" id="fichier" name="fichier" size="11534336">';
		// }
		$aff .= '</td></tr>';

		$aff .= '</table>';

		$aff .= '<br><br>';

		if ($this->instance->getFileName () != '') {
			$aff .= '<input type="submit" value="Modifier le fichier">';
		} else {
			$aff .= '<input type="submit" value="Créer le fichier">';
		}

		if (isset ( $_GET ['action'] ) && $_GET ['action'] == 'fckeditornew') {
			$aff .= '</div>';
		}
		$aff .= '</form>';
		echo $aff;
	}
	private function getDateFR($DateEN) {
		$tab = preg_split ( "/-+/", $DateEN, 3 );
		return $tab [2] . '/' . $tab [1] . '/' . $tab [0];
	}
	private function display_filesize($filesize) {
		if (is_numeric ( $filesize )) {
			$decr = 1024;
			$step = 0;
			$prefix = array (
					'Byte',
					'KB',
					'MB',
					'GB',
					'TB',
					'PB'
			);

			while ( ($filesize / $decr) > 0.9 ) {
				$filesize = $filesize / $decr;
				$step ++;
			}
			return round ( $filesize, 2 ) . ' ' . $prefix [$step];
		} else {
			return 'NaN';
		}
	}
}