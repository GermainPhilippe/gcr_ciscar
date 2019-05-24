<?php
/**
 * @author Florent DESPIERRES
 * @package site-administration
 * @subpackage export
 * @version 1.0.4
 */
class ExportFafView implements DefaultListView {
	private $myListIndividu;
	private $myListEtablissement;
	public function __construct($aListIndividu, $aListEtablissement) {
		$this->myListIndividu = $aListIndividu;
		$this->myListEtablissement = $aListEtablissement;
	}

	// ###
	public function renderHTML() {
		header ( "Content-Type: text/plain" );
		echo 'Nom;Prénom;Login;Rattachement;Profil;LoginFaF;Email' . "\n";
		foreach ( $this->myListIndividu as $line ) {
			echo $line [0] . ';' . $line [1] . ';' . $line [2] . ';' . $line [3] . ';;' . $line [3] . ';' . $line [4] . "\n";
		}

		echo 'Libellé secteur;Secteur de livraison défaut;Secteur de facturation défaut;Rattachement;Code client Ciscar;Région;Email;Addresse1;Code postal;Ville;Destinataire1;Nature;Type;Marque1;Marque2;Marque3;Marque4;Marque5;EnSommeil' . "\n";
		foreach ( $this->myListEtablissement as $line ) {
			echo $line [0] . ';;;;' . $line [6] . ';' . $line [7] . ';' . $line [5] . ';' . $line [1] . ' ' . $line [2] . ';' . $line [4] . ';' . $line [3] . ';;' . $line [9] . ';' . $line [10] . ';' . $line [11] . ';' . $line [12] . ';' . $line [13] . ';' . $line [14] . ';' . $line [15] . ';' . $line [16] . "\n";
		}
	}
}
?>