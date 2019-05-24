<?php
include __DIR__ . '/../ShortcodeManager.php';
include __DIR__ . '/HelloSC.php';
include __DIR__ . '/../IndividuSC.php';

$content = 'Lorem [Individu_Nom id="1"] ipsum dolor sit amet, [Hello name="Florent" id="1"] consectetur adipiscing elit.' . PHP_EOL;

ShortcodeManager::add_shortcode ( HelloSC::$tagname, 'HelloSC::Say' );
ShortcodeManager::add_shortcode ( 'Individu_Nom', 'IndividuSC::getNom' );
ShortcodeManager::add_shortcode ( 'Individu_Prenom', 'IndividuSC::getPrenom' );
ShortcodeManager::add_shortcode ( 'Individu_Email', 'IndividuSC::getEmail' );
ShortcodeManager::add_shortcode ( 'Individu_Login', 'IndividuSC::getLogin' );
ShortcodeManager::add_shortcode ( 'Individu_Password', 'IndividuSC::getPassword' );

$content = ShortcodeManager::do_shortcode ( $content );
echo $content;
