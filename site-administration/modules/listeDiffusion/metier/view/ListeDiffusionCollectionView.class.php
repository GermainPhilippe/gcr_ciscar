<?php
class ListeDiffusionCollectionView {
	private $myList;
	public function __construct($aList) {
		$this->myList = $aList;
	}
	public function renderHTML($categorie) {
		// Navigation Bar
		$aff = '<div id="FilAriane">' . "\n";
		if ($categorie == 'News') {
			$aff .= '<a href="../../?menu=2">Site</a>&nbsp;>&nbsp;Liste Diffusion' . "\n";
			$aff .= '</div><br/><br/>' . "\n";
			// Liste de boutons
			$aff .= '<input type="button" value="Nouveau" onclick="location.href=\'?action=new\';"/><br/><br/>' . "\n";
		}
		if ($categorie == 'Outlook') {
			$aff .= '<a href="../../?menu=1">Général</a>&nbsp;>&nbsp;Liste Outlook' . "\n";
			$aff .= '</div><br/><br/>' . "\n";
			// Liste de boutons
			if ($_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'])
				$aff .= '<input type="button" value="Nouveau" onclick="location.href=\'?action=newOutlook\';"/><br/><br/>' . "\n";
		}

		$aff .= '<table id="TableList">' . "\n";
		$aff .= '<tr class="title">';
		$aff .= '<td>Nom</td>';
		if ($categorie == 'News') {
			$aff .= '<td>Type</td>';
			$aff .= '<td width="150" colspan="3">Actions</td>';
		}
		if ($categorie == 'Outlook') {
			if ($_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS'])
				$aff .= '<td width="250" colspan="5">Actions</td>';
			else
				$aff .= '<td width="150" colspan="3">Actions</td>';
		}
		$aff .= '</tr>' . "\n";

		foreach ( $this->myList as $aListeDiffusion ) {
			// liste des emails
			if ($categorie == 'Outlook') {
				$aSimple_IndividuList = new Simple_IndividuList ();
				$rqt = ListeDiffusionCritere::generateSQL_For_Mails ( $aListeDiffusion->getID () );

				if (! empty ( $rqt )) {
					$aSimple_IndividuList->SQL_SELECT_MAILS_WITH_RQT ( $rqt );
					${'aListeDiffusionOutlook' . $aListeDiffusion->getID ()} = $aSimple_IndividuList->getListMails ();
				} else {
					${'aListeDiffusionOutlook' . $aListeDiffusion->getID ()} = '';
				}
			}

			$aff .= '<tr>';
			if ($categorie == 'News')
				$aff .= '<td>' . $aListeDiffusion->getNom ();

			if ($categorie == 'Outlook') {
				$aff .= '<td>' . $aListeDiffusion->getNom ();
				$aff .= '<div class="listdiv" name="div-' . $aListeDiffusion->getID () . '" id="div-' . $aListeDiffusion->getID () . '" style="display:none;">';
				$aff .= '<textarea onclick="this.select();"cols="150" rows="10">' . ${'aListeDiffusionOutlook' . $aListeDiffusion->getID ()} . '</textarea>';
				$aff .= '</div>' . "\n";
			}

			$aff .= '</td>';

			if ($categorie == 'News') {
				$aff .= '<td width="150" align="center">';
				switch ($aListeDiffusion->getType ()) {
					case ListeDiffusion::TYPE_SIMPLE_OU :
						$aff .= ListeDiffusion::TYPE_SYMPLE;
						break;
					case ListeDiffusion::TYPE_SIMPLE_ET :
						$aff .= ListeDiffusion::TYPE_SYMPLE;
						break;
					case ListeDiffusion::TYPE_SPECIFIQUE_OU :
						$aff .= ListeDiffusion::TYPE_SPECIFIQUE;
						break;
					case ListeDiffusion::TYPE_SPECIFIQUE_ET :
						$aff .= ListeDiffusion::TYPE_SPECIFIQUE;
						break;
					case ListeDiffusion::TYPE_CSV_ET :
						$aff .= ListeDiffusion::TYPE_CSV;
						break;
					case ListeDiffusion::TYPE_CSV_OU :
						$aff .= ListeDiffusion::TYPE_CSV;
						break;
				}
				$aff .= '</td>';
			}
			if ($categorie == 'News') {
				$aff .= '<td width="50" align="center"><a href="?action=view&id=' . $aListeDiffusion->getID () . '"><img src="../../include/images/apercu.jpg" border=0/></a></td>';
				$aff .= '<td width="50" align="center"><a href="?action=update&id=' . $aListeDiffusion->getID () . '"><img src="../../include/images/document_edit.png" border=0/></a></td>';
				$aff .= '<td width="50" align="center"><a href="#" onclick="confirmDelete(' . $aListeDiffusion->getID () . ')"><img src="../../include/images/garbage_empty.png" border=0/></a></td>';
			}
			if ($categorie == 'Outlook') {
				$aff .= '<td width="50" align="center"><a href="#" onclick="OpenCloseDiv(' . $aListeDiffusion->getID () . ')"><img src="../../include/images/email.png" border=0/></a></td>';
				if (strlen ( ${'aListeDiffusionOutlook' . $aListeDiffusion->getID ()} ) > 2000)
					$aff .= '<td width="50" align="center"><a href="mailto:"><img src="../../include/images/Icon_Outlook_40x40_black.png" border=0/ height="25px" onclick="showdiv(' . $aListeDiffusion->getID () . ')"></a></td>';
				else
					$aff .= '<td width="50" align="center"><a href="mailto:?bcc=' . ${'aListeDiffusionOutlook' . $aListeDiffusion->getID ()} . '"><img src="../../include/images/Icon_Outlook_40x40.png" border=0/ height="25px"></a></td>';
				$aff .= '<td width="50" align="center"><a href="?action=viewOutlook&id=' . $aListeDiffusion->getID () . '"><img src="../../include/images/apercu.jpg" border=0/></a></td>';
				if ($_SESSION ['ADMIN'] ['USER'] ['ISADMINISTRATEURS']) {
					$aff .= '<td width="50" align="center"><a href="?action=updateOutlook&id=' . $aListeDiffusion->getID () . '"><img src="../../include/images/document_edit.png" border=0/></a></td>';
					$aff .= '<td width="50" align="center"><a href="#" onclick="confirmDelete(' . $aListeDiffusion->getID () . ')"><img src="../../include/images/garbage_empty.png" border=0/></a></td>';
				}
			}
			$aff .= '</tr>' . "\n";
		}

		$aff .= '</table>' . "\n";
		echo $aff;
	}
}
?>