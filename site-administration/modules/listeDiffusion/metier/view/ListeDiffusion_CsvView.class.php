<?php
class ListeDiffusion_CsvView {
	public $value;
	public function __construct() {
		$this->value = "";
	}
	public function renderHTML() {
		$aff = '';

		$aff .= '<form method="post" action="?action=import" id="formImportIndividu" enctype="multipart/form-data">';

		$aff .= '<p><label style="width:225px;" for="URLFile">Fichier </label><input style="width:225px;" type="file" id="URLFile" name="URLFile">';
		$aff .= '<div style="position: relative;"><b>Ou saisissez :</b><table cellspacing="0" cellpadding="5">';
		$aff .= '<tr><td align="left" valign="middle"">&nbsp;</td><td align="left" valign="middle"">Email</td><td align="left" valign="middle"><input type="texte" size="50" id="newMail" name="newMail"></td></tr>';
		$aff .= '<tr><td align="left" valign="middle"">&nbsp;</td><td align="left" valign="middle"">Civilite</td><td align="left" valign="middle" style="padding-top:0px;"><label>Mr.&nbsp;</label><input type="radio" id="newMr" name="newCivilite" value="1"><label>&nbsp;Mme.&nbsp;</label><input type="radio" id="newMme" name="newCivilite" value="2"></td></tr>';
		$aff .= '<tr><td align="left" valign="middle"">&nbsp;</td><td align="left" valign="middle"">Nom</td><td align="left" valign="middle"><input type="texte" size="50" id="newNom" name="newNom"></td></tr>';
		$aff .= '<tr><td align="left" valign="middle"">&nbsp;</td><td align="left" valign="middle"">Prénom</td><td align="left" valign="middle"><input type="texte" size="50" id="newPrenom" name="newPrenom"></td></tr>';
		$aff .= '</table></div></p>';
		$aff .= '<p><label id="cpt">' . $this->value . '</p>';
		$aff .= '<p><input type="submit" value="Importer"></p>';
		$aff .= '</form>';

		echo $aff;
	}
	public function renderListeCsv($ID_Liste_Csv, $myList, $NameFile) {

		// Tableau
		echo '<div style="border:solid 1px #000000;"><table cellspacing="1" cellpadding="0" id="TableList">';
		echo '<tr><td align="center" valign="middle" height="50px" colspan="7"><a style="cursor:pointer;" onclick="javascript:addRule(' . $ID_Liste_Csv . ',\'' . $NameFile . '\')">Confirmez l\'import des mails&nbsp;<img src="../../include/images/add.png" border="0"/></a></td></tr>';
		echo '<tr class="title">';
		echo '<td align="center"><b>Mail</b></td>';
		echo '<td align="center"><b>Civilité</b></td>';
		echo '<td align="center"><b>Nom</b></td>';
		echo '<td align="center"><b>Prénom</b></td>';
		echo '<td align="center"><b>Individu ID</b></td>';
		echo '<td align="center"><b>Annuaire ID</b></td>';
		echo '<td align="center"><b>Etablissement ID</b></td>';
		echo '</tr>';

		$row = 1;
		for($i = 0; $i < ( int ) count ( $myList ); $i ++) {
			$aff = '<tr>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $myList [$i] [0] . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $myList [$i] [6] . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $myList [$i] [3] . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $myList [$i] [4] . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $myList [$i] [1] . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $myList [$i] [2] . '</td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $myList [$i] [5] . '</td>';
			$aff .= '</tr>';
			echo $aff;
			$row = ($row == 1 ? 2 : 1);
		}

		echo '<tr><td align="center" valign="middle" height="50px" colspan="7"><a style="cursor:pointer;" onclick="javascript:addRule(' . $ID_Liste_Csv . ',\'' . $NameFile . '\')">Confirmez l\'import des mails&nbsp;<img src="../../include/images/add.png" border="0"/></a></td></tr>';
		echo '</table></div>';
	}
}
?>