<?php
/**
 * @author Florent DESPIERRES
 * @package app-Enquete
 * @subpackage Formulaire
 * @version 1.0.4
 */
class FormulaireTabView {
	private $myFormulaire;
	public function __construct($aFormulaire) {
		$this->myFormulaire = $aFormulaire;
	}

	// ###
	public function renderHTML($mod) {
		$aff = '<div id="FilAriane">';
		$aff .= '	<a href="../../../../modules/EnqueteEnLigne/Formulaire/?">Enquete</a> > ';
		$aff .= '	<a href="../Enquete/?id=' . $this->myFormulaire->getEnqueteID () . '">Enquetes</a> > ';
		$aff .= '	<a href="?id=' . $this->myFormulaire->getEnqueteID () . '">Formulaires</a> > ';
		switch ($mod) {
			case 'new' :
				$aff .= 'Création';
				break;
			case 'edit' :
				$aff .= 'Edition';
				break;
		}
		$aff .= '</div><br/>';

		switch ($mod) {
			case 'new' :
				$aff .= '<form action="?action=new&id=' . $this->myFormulaire->getEnqueteID () . '" method="POST" onsubmit="return FormulaireValidation()">';
				break;
			case 'edit' :
				$aff .= '<form action="?action=edit&id=' . $this->myFormulaire->getID () . '" method="POST" onsubmit="return FormulaireValidation()">';
				break;
		}

		$aff .= '<table width="100%" border="1" cellspacing="0" cellpadding="5">';
		$aff .= '<tr>';
		$aff .= '<td rowspan="4" width="100" valign="top">';
		$aff .= '	<a href="javascript:displayTab(\'1\')" class="linkTabDocumentCurrent" id="linkTabGeneral">Général</a><br/>';
		$aff .= '	<a href="javascript:displayTab(\'3\')" class="linkTabDocument" id="linkTabLCA">LCA</a><br/>';
		$aff .= '	<a href="javascript:displayTab(\'4\')" class="linkTabDocument" id="linkTabPage">Page(s)</a><br/>';
		$aff .= '	<a href="javascript:displayTab(\'5\')" class="linkTabDocument" id="linkTabModule">Module(s)</a><br/>';
		$aff .= '</td>';

		$aff .= '<td class="tabDocument" valign="top" id="tabGeneral">';
		$aff .= $this->renderGeneral_HTML ( $mod );
		$aff .= '</td></tr>';
		$aff .= '<tr><td style="display:none;" class="tabDocument" valign="top" id="tabLCA">';
		$aff .= $this->renderLCA_HTML ( $mod );
		$aff .= '</td></tr>';
		$aff .= '<tr><td style="display:none;" class="tabDocument" valign="top" id="tabPage">';
		$aff .= $this->renderPageList_HTML ( $mod );
		$aff .= '</td></tr>';
		$aff .= '<tr><td style="display:none;" class="tabDocument" valign="top" id="tabModule">';
		$aff .= $this->renderModuleList_HTML ( $mod );
		$aff .= '</td></tr>';
		$aff .= '</table>';

		switch ($mod) {
			case 'new' :
				$aff .= '<p><input type="submit" value="Créer"/></p>';
				break;
			case 'edit' :
				$aff .= '<p><input type="submit" value="Mettre à jour"/></p>';
				break;
		}

		$aff .= '</form>';
		echo $aff;
	}
	private function renderGeneral_HTML($mod) {
		$aff = '		<table>';
		$aff .= '			<tr>';
		$aff .= '				<td>Nom</td>';
		$aff .= '				<td><input type="text" name="Nom" value="' . stripslashes ( $this->myFormulaire->getNom () ) . '" size="60"/></td>';
		$aff .= '			</tr>';
		$aff .= '			<tr>';
		$aff .= '				<td>Type</td>';
		$aff .= '				<td><input type="hidden" name="TypeFormulaire" id="TypeFormulaire" value="' . $this->myFormulaire->getTypeFormulaire () . '"/><select disabled>';
		$aff .= '					<option value="0"' . ($this->myFormulaire->getTypeFormulaire () == 0 ? ' SELECTED=SELECTED' : '') . '>Inscription</option>';
		$aff .= '					<option value="1"' . ($this->myFormulaire->getTypeFormulaire () == 1 ? ' SELECTED=SELECTED' : '') . '>Satisfaction</option>';
		$aff .= '				</select></td>';
		$aff .= '			</tr>';
		$aff .= '			<tr>';
		$aff .= '				<td>Bandeau Image</td>';
		$aff .= '				<td><input type="text" id="ImagesURL" name="ImagesURL" value="' . $this->myFormulaire->getBandeauURL () . '" size="80"/>';
		$aff .= '				<input type="button" value="..." onclick="OpenServerBrowser(\'../../../../include/js/fckeditor/editor/filemanager/browser/default/browser.html?Type=Image&Connector=/admin/include/js/fckeditor/editor/filemanager/connectors/php/connector.php\',800,600)"/>';
		$aff .= '				</td>';
		$aff .= '			</tr>';
		$aff .= '		</table><br/><br/>';

		include_once ("../../../../include/js/fckeditor/fckeditor.php");
		$aff .= 'Description<br/>';
		$oFCKeditor = new FCKeditor ( 'RichTextValue' );
		$oFCKeditor->BasePath = '../../../../include/js/fckeditor/';
		$oFCKeditor->Value = stripslashes ( $this->myFormulaire->getRichTextValue () );
		$oFCKeditor->Width = '100%';
		$oFCKeditor->Height = '200';
		$aff .= $oFCKeditor->CreateHtml ();

		$aff .= '<script type="text/javascript">
				var urlobj = \'ImagesURL\';

				function OpenServerBrowser( url, width, height )
				{
					urlobj = \'ImagesURL\';
					ServerBrowser( url, width, height );
				}

				function ServerBrowser( url, width, height )
				{
					var iLeft = (screen.width  - width) / 2 ;
					var iTop  = (screen.height - height) / 2 ;
				
					var sOptions = "toolbar=no,status=no,resizable=yes,dependent=yes" ;
					sOptions += ",width=" + width ;
					sOptions += ",height=" + height ;
					sOptions += ",left=" + iLeft ;
					sOptions += ",top=" + iTop ;
				
					var oWindow = window.open( url, "BrowseWindow", sOptions ) ;
				}
				
				function SetUrl( url, width, height, alt )
				{
					document.getElementById(urlobj).value = url ;
					oWindow = null;
				}
				</script>';

		return $aff;
	}
	private function renderLCA_HTML($mod) {
		$aFormulaireLCA = new FormulaireLCA ();
		$aTab = $aFormulaireLCA->SQL_SELECT_ALL ( $this->myFormulaire->getID () );
		$aTabALL = $aFormulaireLCA->SQL_SELECT_ALL_BY_CONVENTION_TYPE ( $this->myFormulaire->getEnqueteID (), $this->myFormulaire->getTypeFormulaire () );

		$aff = '<table>';
		$aff .= '<tr>';
		$aff .= '	<td>1. Concessionnaire / Directeur Général</td>';
		$aff .= '	<td><input type="checkbox" name="LCAGroupe1" value="1"' . ($aTab [1] == 1 ? ' CHECKED=CHECKED' : '') . (($mod == 'new' && $aTabALL [1] == 1) || ($mod != 'new' && $aTabALL [1] == 1 && $aTab [1] == 0) ? ' DISABLED' : '') . ' /></td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '	<td>2. Directeur de concession</td>';
		$aff .= '	<td><input type="checkbox" name="LCAGroupe2" value="1"' . ($aTab [2] == 1 ? ' CHECKED=CHECKED' : '') . (($mod == 'new' && $aTabALL [2] == 1) || ($mod != 'new' && $aTabALL [2] == 1 && $aTab [2] == 0) ? ' DISABLED' : '') . ' /></td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '	<td>3. RRG</td>';
		$aff .= '	<td><input type="checkbox" name="LCAGroupe3" value="1"' . ($aTab [3] == 1 ? ' CHECKED=CHECKED' : '') . (($mod == 'new' && $aTabALL [3] == 1) || ($mod != 'new' && $aTabALL [3] == 1 && $aTab [3] == 0) ? ' DISABLED' : '') . ' /></td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '	<td>4. Constructeur</td>';
		$aff .= '	<td><input type="checkbox" name="LCAGroupe4" value="1"' . ($aTab [4] == 1 ? ' CHECKED=CHECKED' : '') . (($mod == 'new' && $aTabALL [4] == 1) || ($mod != 'new' && $aTabALL [4] == 1 && $aTab [4] == 0) ? ' DISABLED' : '') . ' /></td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '	<td>5. Partenaires</td>';
		$aff .= '	<td><input type="checkbox" name="LCAGroupe5" value="1"' . ($aTab [5] == 1 ? ' CHECKED=CHECKED' : '') . (($mod == 'new' && $aTabALL [5] == 1) || ($mod != 'new' && $aTabALL [5] == 1 && $aTab [5] == 0) ? ' DISABLED' : '') . ' /></td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '	<td>6. Nos autres invités</td>';
		$aff .= '	<td><input type="checkbox" name="LCAGroupe6" value="1"' . ($aTab [6] == 1 ? ' CHECKED=CHECKED' : '') . (($mod == 'new' && $aTabALL [6] == 1) || ($mod != 'new' && $aTabALL [6] == 1 && $aTab [6] == 0) ? ' DISABLED' : '') . ' /></td>';
		$aff .= '</tr>';
		$aff .= '</table>';

		return $aff;
	}
	private function renderPageList_HTML($mod) {
		// $aList = new FormulairePageList();
		// $aList->SQL_SELECT_ALL($this->myFormulaire->getID());
		$aff = '';
		if ($mod != 'new') {
			$aff .= '<input type="button" value="Nouveau" onclick="location.href=\'?action=newPage&id=' . $this->myFormulaire->getID () . '\'"/><br/><br/>';
		}

		$aff .= '<table width="100%" id="TableList">';
		$aff .= '<tr class="title" bgcolor="#CCCCCC">';
		$aff .= '	<td align="center" width="50"><b>#</b></td>';
		$aff .= '	<td align="center"><b>Titre</b></td>';
		$aff .= '	<td align="center" width="50"><b>Type</b></td>';
		$aff .= '	<td align="center" colspan="3" width="150"><b>Action</b></td>';
		$aff .= '</tr>';
		$row = 1;
		/*
		 * foreach($aList->getList() as $FormulairePage)
		 * {
		 * $aff .= '<tr>';
		 * $aff .= ' <td align="center" width="50" class="'.($row==1?'row1':'row2').'">'.$FormulairePage->getID().'</td>';
		 * $aff .= ' <td align="center" class="'.($row==1?'row1':'row2').'">'.stripslashes($FormulairePage->getTitre()).'</td>';
		 * $aff .= ' <td align="center" width="50" class="'.($row==1?'row1':'row2').'">'.($FormulairePage->getTypePage()==1?'URL':'Page').'</td>';
		 * if($FormulairePage->getTypePage()==1)
		 * {
		 * $aff .= ' <td align="center" width="50" class="'.($row==1?'row1':'row2').'"><a href="'.$FormulairePage->getURL().'" target="_BLANK"><img src="../../../../include/images/apercu.jpg" border="0" /></a></td>';
		 * }
		 * else
		 * {
		 * $aff .= ' <td align="center" width="50" class="'.($row==1?'row1':'row2').'"><a href="?action=previewPage&id='.$FormulairePage->getID().'" target="_BLANK"><img src="../../../../include/images/apercu.jpg" border="0" /></a></td>';
		 * }
		 * $aff .= ' <td align="center" width="50" class="'.($row==1?'row1':'row2').'"><a href="?action=editPage&id='.$FormulairePage->getID().'"><img src="../../../../include/images/document_edit.png" border="0" /></a></td>';
		 * $aff .= ' <td align="center" width="50" class="'.($row==1?'row1':'row2').'"><a href="#" onclick="confirmDelete(\'?action=deletePage&id='.$FormulairePage->getID().'\')"><img src="../../../../include/images/garbage_empty.png" border="0" /></a></td>';
		 * $aff .= '</tr>';
		 * $row = ($row==1?2:1);
		 * }
		 *
		 * if(count($aList->getList())==0)
		 * {
		 * $aff .= '<tr><td colspan="6"><i>Aucune Page trouvï¿½e</i></td></tr>';
		 * }
		 */

		$aff .= '</table>';

		return $aff;
	}
	private function renderModuleList_HTML($mod) {
		$aFormulaireModuleList = new FormulaireModuleList ();
		if ($mod == 'edit') {
			$aFormulaireModuleList->SQL_SELECT_ALL ( $this->myFormulaire->getID () );
		}

		$aff = '';
		if ($mod != 'new') {
			$aff .= '<input type="button" value="Nouveau" onclick="location.href=\'?action=newModule&id=' . $this->myFormulaire->getID () . '\'"/><br/><br/>';
		}

		$aff .= '<table id="tree" style="width:100%;">';
		$aff .= '<tr id="root" style="height:30px;font-size:11px;font-weight:bold;text-align:center;background-color:#D4D4D4;background-image: url(\'../../../../include/images/bt/ligne.jpg\');">';
		$aff .= '	<td width="50">#</td>';
		$aff .= '	<td>Nom</td>';
		$aff .= '	<td width="50">Num Ordre</td>';
		$aff .= '	<td colspan="2" width="100">Actions</td>';
		$aff .= '</tr>';
		if (count ( $aFormulaireModuleList->getList () ) == 0) {
			$aff .= '<tr><td colspan="5"><i>Pas de module</i></td></tr>';
		} else {
			$row1 = ' style="background-color:#F4F4F4;height:30px;font-size:11px;"';
			$row2 = ' style="background-color:#E8E8E8;height:30px;font-size:11px;"';
			$i = 0;
			foreach ( $aFormulaireModuleList->getList () as $aFormulaireModule ) {
				$aff .= '<tr id="module' . $aFormulaireModule->getID () . '" class="child-of-root"' . ($i == 0 ? $row1 : $row2) . '>';
				$aff .= '	<td width="50">-</td>';
				$aff .= '	<td>' . $aFormulaireModule->getNom () . '</td>';
				$aff .= '	<td width="50" align="center">' . $aFormulaireModule->getNumOrdre () . '</td>';
				$aff .= '	<td align="center" width="50"><a href="?action=editModule&id=' . $aFormulaireModule->getID () . '"><img src="../../../include/images/document_edit.png" border="0" /></a></td>';
				$aff .= '	<td align="center" width="50"><a href="#" onclick="confirmDelete(\'?action=deleteModule&id=' . $aFormulaireModule->getID () . '\')"><img src="../../../include/images/garbage_empty.png" border="0" /></a></td>';
				$aff .= '</tr>';

				$i == 0 ? 1 : 0;

				$aFormulaireSectionList = new FormulaireSectionList ();
				$aFormulaireSectionList->SQL_SELECT_ALL ( $aFormulaireModule->getID () );
				foreach ( $aFormulaireSectionList->getList () as $aFormulaireSection ) {
					$aff .= '<tr class="child-of-module' . $aFormulaireModule->getID () . '" id="section' . $aFormulaireSection->getID () . '"' . ($i == 0 ? $row1 : $row2) . '>';
					$aff .= '	<td width="50">-</td>';
					$aff .= '	<td>' . htmlentities ( stripslashes ( $aFormulaireSection->getNom () ), ENT_QUOTES ) . '</td>';
					$aff .= '	<td width="50" align="center">' . $aFormulaireSection->getNumOrdre () . '</td>';
					$aff .= '	<td align="center" width="50"><a href="?action=editSection&id=' . $aFormulaireSection->getID () . '"><img src="../../../include/images/document_edit.png" border="0" /></a></td>';
					$aff .= '	<td align="center" width="50"><a href="#" onclick="confirmDelete(\'?action=deleteSection&id=' . $aFormulaireSection->getID () . '\')"><img src="../../../include/images/garbage_empty.png" border="0" /></a></td>';
					$aff .= '</tr>';

					$i == 0 ? 1 : 0;

					$aFormulaireChampList = new FormulaireChampList ();
					$aFormulaireChampList->SQL_SELECT_ALL ( $aFormulaireSection->getID () );
					foreach ( $aFormulaireChampList->getList () as $aFormulaireChamp ) {
						$aff .= '<tr class="child-of-section' . $aFormulaireSection->getID () . '" id="champ' . $aFormulaireChamp->getID () . '"' . ($i == 0 ? $row1 : $row2) . '>';
						$aff .= '	<td width="50">-</td>';
						$aff .= '	<td>' . htmlentities ( stripslashes ( $aFormulaireChamp->getNom () ), ENT_QUOTES ) . '</td>';
						$aff .= '	<td width="50" align="center">' . $aFormulaireChamp->getNumOrdre () . '</td>';
						$aff .= '	<td align="center" width="50"><a href="?action=editChamp&id=' . $aFormulaireChamp->getID () . '"><img src="../../../include/images/document_edit.png" border="0" /></a></td>';
						$aff .= '	<td align="center" width="50"><a href="#" onclick="confirmDelete(\'?action=deleteChamp&id=' . $aFormulaireChamp->getID () . '\')"><img src="../../../include/images/garbage_empty.png" border="0" /></a></td>';
						$aff .= '</tr>';

						$i == 0 ? 1 : 0;
					}
				}
			}
		}
		$aff .= '</table>';
		return $aff;
	}
}
?>