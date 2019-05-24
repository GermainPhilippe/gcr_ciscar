<?php
class AnnuaireImportView {
	private $myDR;
	public function __construct($dr) {
		$this->myDR = $dr;
	}
	public function renderHTML() {
		$aff = '<div id="FilAriane"><a href="../../../../?menu=5">Convention</a>&nbsp;>&nbsp;<a href="../Convention/?">Conventions</a>&nbsp;>&nbsp;<a href="?id=' . $_GET ['id'] . '">Annuaire</a>&nbsp;>&nbsp;Import</div><br/><br/>';

		$aff .= '<form method="post" enctype="multipart/form-data">';
		$aff .= '<a href="/admin/modules/app-convention/Modele_Import.csv">Télécharger le modèle CSV</a><br><br><br>';
		$aff .= 'Fichier <input type="file" name="URLFile"><br><br>';
		$aff .= '<input type="submit" value="Importer">';
		$aff .= '</form>';
		$aff .= '<strong><u>Aide :</u></strong><br />';
		$aff .= ' <ul>
						<li>Civilité (Défaut 1)
							<ul>
								<li> 1 => M.</li>
								<li> 2 => Mme</li>
								<li> 3 => Mlle</li>
							</ul>
						</li>
						<li>Type  (Défaut 6)
							<ul>
								<li> 1 => Concessionnaire / Directeur Général</li>
								<li> 2 => Directeur de concession</li>
								<li> 3 => RRG</li>
								<li> 4 => Constructeur</li>
								<li> 5 => Partenaires</li>
								<li> 6 => Nos autres invités</li>
								<li> 7 => Invité par Concessionnaire</li>
								<li> 8 => GCRE</li>
								<li> 9 => GCR+</li>
							</ul>
						</li>
						<li>Direction Régionale (Défaut NULL)
							<ul>';
		foreach ( $this->myDR as $dr => $value ) {
			$aff .= '<li>' . $dr . ' => ' . $value . '</li>';
		}

		$aff .= '</ul></li></ul>';
		echo $aff;
	}
}