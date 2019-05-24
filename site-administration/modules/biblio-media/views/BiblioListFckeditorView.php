<?php
class BiblioListFckeditorView {
	private $list;
	private $searchFile;
	public function __construct($list, $searchFile) {
		$this->list = $list;
		$this->searchFile = $searchFile;
	}
	public function renderHTML() {
		$aff = '
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

		$aff .= '<script>
		function ok(id,titre) 
		{
			var oEditor = window.opener.FCKeditorAPI.GetInstance(\'FCKeditor1\') ;
			oEditor.InsertHtml(\'<a href="/modules/Biblio-media/index.php?id=\'+id+\'">\'+titre+\'</a>\');
			window.close();
		}
		
		</script>';

		$aff .= '<div id="FilAriane">Web Content&nbsp;>&nbsp;<a href="index_simple.php?action=fckeditor">Médiathèque</a></div><br>';

		// Button Bar
		$aff .= '<table width="100%">';
		$aff .= '<tr><td width="50%" align="left">';
		$aff .= '<input type="button" value="Nouveau" onclick="javascript:location.href=\'?action=fckeditornew\'"/>';
		$aff .= '</td><td width="50%" align="right">';
		$aff .= '<form method="post"><input type="text" name="searchFile" size="30" value="' . $this->searchFile . '"> <input type="submit" value="ok"></form>';
		$aff .= '</td></tr></table>';

		$aff .= '<table id="TableList" width="100%">';
		$aff .= '<tr class="title">';
		$aff .= '<td>Titre</td>';
		$aff .= '<td>Date Création</td>';
		$aff .= '<td>Mime</td>';
		$aff .= '<td>Taille</td>';
		$aff .= '<td>Actions</td>';
		$aff .= '</tr>';

		if (count ( $this->list ) > 0) {
			$row = 0;
			foreach ( $this->list as $biblio ) {

				$aff .= '<tr>';
				$aff .= '<td class="' . ($row == 0 ? 'row1' : 'row2') . '">' . $biblio->getTitre () . '</td>';
				$aff .= '<td class="' . ($row == 0 ? 'row1' : 'row2') . '" align="center" width="100">' . $this->getDateFR ( $biblio->getCreateOn () ) . '</td>';
				$aff .= '<td class="' . ($row == 0 ? 'row1' : 'row2') . '" align="center" width="250">' . $biblio->getFileMime () . '</td>';
				$aff .= '<td class="' . ($row == 0 ? 'row1' : 'row2') . '" align="center" width="100">' . $this->display_filesize ( $biblio->getFileSize () ) . '</td>';
				$aff .= '<td class="' . ($row == 0 ? 'row1' : 'row2') . '" width="50" align="center"><a href="#"  onclick="ok(\'' . $biblio->getId () . '\',\'' . addslashes ( stripslashes ( $biblio->getTitre () ) ) . '\')"><b>Ajouter</b></a></td>';
				$aff .= '</tr>';

				$row = $row == 0 ? 1 : 0;
			}
		}

		$aff .= '</table>';

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