<?php
/**
 *  @author Florent DESPIERRES
 * @package site-administration
 * @subpackage commun
 * @version 1.0.4
 */
class HelperHead {
	public static function beginHeadTag() {
		return '<head>';
	}
	public static function endHeadTag() {
		return '</head>';
	}
	public static function includeCSS($URLCssScript) {
		return '<link href="' . $URLCssScript . '" rel="stylesheet" type="text/css"/>';
	}
	public static function includeJS($URLJsScript) {
		return '<script type="text/javascript" src="' . $URLJsScript . '"></script>';
	}
	public static function includeTitle($Title) {
		return '<title>' . $Title . '</title>';
	}
}
?>