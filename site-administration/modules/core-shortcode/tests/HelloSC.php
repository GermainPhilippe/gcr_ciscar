<?php
class HelloSC {
	public static $tagname = 'Hello';
	public static function Say($params = array()) {
		return 'Hello ' . (isset ( $params ['name'] ) ? $params ['name'] : 'Anonymous');
	}
}