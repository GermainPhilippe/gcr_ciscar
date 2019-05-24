<?php
class BiblioListView {
	private $list;
	private $searchFile;
	public function __construct($list, $searchFile) {
		$this->list = $list;
		$this->searchFile = $searchFile;
	}
	public function renderHTML() {
		$aff = '<div id="FilAriane"><a href="../../?menu=1">Général</a>&nbsp;>&nbsp;Médiathèque</div><br/>';

		// Button Bar
		$aff .= '<table width="100%">';
		$aff .= '<tr><td width="50%" align="left">';
		$aff .= '<input type="button" value="Nouveau" onclick="javascript:location.href=\'?action=new\'"/>';
		$aff .= '</td><td width="50%" align="right">';
		$aff .= '<form method="post"><input type="text" name="searchFile" size="30" value="' . $this->searchFile . '"> <input type="submit" value="ok"></form>';
		$aff .= '</td></tr></table>';

		// $aff .= '<br/><br/>';

		$aff .= '<table id="TableList" width="100%">';
		$aff .= '<tr class="title">';
		$aff .= '<td>Titre</td>';
		$aff .= '<td>Date Création</td>';
		$aff .= '<td>Mime</td>';
		$aff .= '<td>Taille</td>';
		$aff .= '<td colspan="3">Actions</td>';
		$aff .= '</tr>';

		if (count ( $this->list ) > 0) {
			$row = 0;
			foreach ( $this->list as $biblio ) {

				$aff .= '<tr>';
				$aff .= '<td class="' . ($row == 0 ? 'row1' : 'row2') . '">' . stripslashes ( $biblio->getTitre () ) . '</td>';
				$aff .= '<td class="' . ($row == 0 ? 'row1' : 'row2') . '" align="center" width="100">' . $this->getDateFR ( $biblio->getCreateOn () ) . '</td>';
				$aff .= '<td class="' . ($row == 0 ? 'row1' : 'row2') . '" align="center" width="250">' . $biblio->getFileMime () . '</td>';
				$aff .= '<td class="' . ($row == 0 ? 'row1' : 'row2') . '" align="center" width="100">' . $this->display_filesize ( $biblio->getFileSize () ) . '</td>';
				$aff .= '<td class="' . ($row == 0 ? 'row1' : 'row2') . '" width="50" align="center"><a href="index_simple.php?action=download&id=' . $biblio->getId () . '"><img src="../../include/images/Download.png" border="0"></a></td>';
				$aff .= '<td class="' . ($row == 0 ? 'row1' : 'row2') . '" width="50" align="center"><a href="?action=update&id=' . $biblio->getId () . '"><img src="../../include/images/document_edit.png" border="0"></a></td>';
				$aff .= '<td class="' . ($row == 0 ? 'row1' : 'row2') . '" width="50" align="center"><a href="?action=delete&id=' . $biblio->getId () . '"><img src="../../include/images/garbage_empty.png" border="0"></a></td>';
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