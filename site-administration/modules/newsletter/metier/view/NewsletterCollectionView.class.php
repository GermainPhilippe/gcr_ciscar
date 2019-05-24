<?php
class NewsletterCollectionView {
	private $myList;
	public function __construct($aList) {
		$this->myList = $aList;
	}
	public function renderHTML($archive) {
		if ($archive) {
			$archive_lib = 'Masquer les archives';
			$archive_act = '\'?action=masq\'';
		} else {
			$archive_lib = 'Afficher les archives';
			$archive_act = '\'?action=arch\'';
		}

		// Navigation Bar
		$aff = '<div id="FilAriane">' . "\n";
		$aff .= '<a href="../../?menu=2">Site</a>&nbsp;>&nbsp;Newsletter' . "\n";
		$aff .= '</div><br/><br/>' . "\n";

		// Liste de boutons
		$aff .= '<input type="button" value="Nouveau" onclick="location.href=\'?action=new\';"/>' . "\n";
		$aff .= '<input type="button" value="' . $archive_lib . '" onclick="location.href=' . $archive_act . ';"/><br/><br/>' . "\n";

		$aff .= '<table id="TableList" class="sortable">' . "\n";
		$aff .= '<thead>';
		$aff .= '<tr class="title">';
		$aff .= '<th><a style="cursor:pointer;">Nom</a></th>';
		$aff .= '<th width="100">Historique</th>';
		$aff .= '<th width="200" colspan="5">Actions</th>';
		$aff .= '</tr>' . "\n";
		$aff .= '</thead>';
		$aff .= '<tbody>';
		foreach ( $this->myList as $aNewsletter ) {
			$NewsID = $aNewsletter->getID ();
			$aff .= '<tr>';
			$aff .= '<td onclick="showdiv(' . $NewsID . ')">' . stripslashes ( $aNewsletter->getName () );
			$aff .= '<div class="newsdiv" name="div-' . $NewsID . '" id="div-' . $NewsID . '" style=" display:none;background-color: #D4D4D4;">';
			// L'iframe est cree en javascript dans la page index.php
			$aff .= '</div>';
			$aff .= '</td>';
			$aff .= '<td width="100" align="center"><a href="?action=viewHistorique&id=' . $NewsID . '"><img src="../../include/images/1299360620_clock_16.png" border=0/></a></td>';
			if($aNewsletter->getNewsBloquee() == 1)
				$aff .= '<td width="50" align="center">&nbsp;</td>';
			else
				$aff .= '<td width="50" align="center"><a href="javascript:confirmeSend(' . $NewsID . ')"><img src="../../include/images/mail-send.png" border=0/></a></td>';
			$aff .= '<td width="50" align="center"><a href="?action=view&id=' . $NewsID . '"><img src="../../include/images/apercu.jpg" border=0/></a></td>';
			$aff .= '<td width="50" align="center"><a href="?action=update&id=' . $NewsID . '"><img src="../../include/images/document_edit.png" border=0/></a></td>';
			$aff .= '<td width="50" align="center"><a href="?action=duplicate&id=' . $NewsID . '"><img src="../../include/images/action_dupliquer.png" border=0/></a></td>';
			$aff .= '<td width="50" align="center"><a href="#" onclick="confirmDelete(' . $NewsID . ')"><img src="../../include/images/garbage_empty.png" border=0/></a></td>';
			$aff .= '</tr>' . "\n";
			echo $aff;
			$aff = '';
		}
		$aff .= '</tbody>';
		$aff .= '</table>';

		echo $aff;
	}
}
?>