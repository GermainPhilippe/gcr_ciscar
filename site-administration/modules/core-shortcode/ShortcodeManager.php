<?php
class ShortcodeManager {
	public static $shortcode_tags = array ();

	// Methods //
	public static function add_shortcode($tag, $func) {
		if (is_callable ( $func ))
			self::$shortcode_tags [$tag] = $func;
	}
	public static function remove_shortcode($tag) {
		unset ( self::$shortcode_tags [$tag] );
	}
	public static function remove_all_shortcodes() {
		self::$shortcode_tags = array ();
	}

	// Methods Content //
	public static function do_shortcode($content) {
		if (empty ( self::$shortcode_tags ) || ! is_array ( self::$shortcode_tags ))
			return $content;

		$pattern = self::get_shortcode_regex ();
		return preg_replace_callback ( "/$pattern/s", 'ShortcodeManager::do_shortcode_tag', $content );
	}
	public static function strip_shortcodes($content) {
		if (empty ( self::$shortcode_tags ) || ! is_array ( self::$shortcode_tags ))
			return $content;

		$pattern = self::get_shortcode_regex ();

		return preg_replace_callback ( "/$pattern/s", 'ShortcodeManager::strip_shortcode_tag', $content );
	}

	// Private methods //
	public static function get_shortcode_regex() {
		$tagnames = array_keys ( self::$shortcode_tags );
		$tagregexp = join ( '|', array_map ( 'preg_quote', $tagnames ) );

		// WARNING! Do not change this regex without changing do_shortcode_tag() and strip_shortcode_tag()
		return '\\[' . // Opening bracket
		'(\\[?)' . // 1: Optional second opening bracket for escaping shortcodes: [[tag]]
		"($tagregexp)" . // 2: Shortcode name
		'\\b' . // Word boundary
		'(' . // 3: Unroll the loop: Inside the opening shortcode tag
		'[^\\]\\/]*' . // Not a closing bracket or forward slash
		'(?:' . '\\/(?!\\])' . // A forward slash not followed by a closing bracket
		'[^\\]\\/]*' . // Not a closing bracket or forward slash
		')*?' . ')' . '(?:' . '(\\/)' . // 4: Self closing tag ...
		'\\]' . // ... and closing bracket
		'|' . '\\]' . // Closing bracket
		'(?:' . '(' . // 5: Unroll the loop: Optionally, anything between the opening and closing shortcode tags
		'[^\\[]*+' . // Not an opening bracket
		'(?:' . '\\[(?!\\/\\2\\])' . // An opening bracket not followed by the closing shortcode tag
		'[^\\[]*+' . // Not an opening bracket
		')*+' . ')' . '\\[\\/\\2\\]' . // Closing shortcode tag
		')?' . ')' . '(\\]?)'; // 6: Optional second closing brocket for escaping shortcodes: [[tag]]
	}
	public static function do_shortcode_tag($m) {
		// allow [[foo]] syntax for escaping a tag
		if ($m [1] == '[' && $m [6] == ']') {
			return substr ( $m [0], 1, - 1 );
		}

		$tag = $m [2];
		$attr = self::shortcode_parse_atts ( $m [3] );

		if (isset ( $m [5] )) {
			// enclosing tag - extra parameter
			return $m [1] . call_user_func ( self::$shortcode_tags [$tag], $attr, $m [5], $tag ) . $m [6];
		} else {
			// self-closing tag
			return $m [1] . call_user_func ( self::$shortcode_tags [$tag], $attr, null, $tag ) . $m [6];
		}
	}
	public static function shortcode_parse_atts($text) {
		$atts = array ();
		$pattern = '/(\w+)\s*=\s*"([^"]*)"(?:\s|$)|(\w+)\s*=\s*\'([^\']*)\'(?:\s|$)|(\w+)\s*=\s*([^\s\'"]+)(?:\s|$)|"([^"]*)"(?:\s|$)|(\S+)(?:\s|$)/';
		$text = preg_replace ( "/[\x{00a0}\x{200b}]+/u", " ", $text );
		if (preg_match_all ( $pattern, $text, $match, PREG_SET_ORDER )) {
			foreach ( $match as $m ) {
				if (! empty ( $m [1] ))
					$atts [strtolower ( $m [1] )] = stripcslashes ( $m [2] );
				elseif (! empty ( $m [3] ))
					$atts [strtolower ( $m [3] )] = stripcslashes ( $m [4] );
				elseif (! empty ( $m [5] ))
					$atts [strtolower ( $m [5] )] = stripcslashes ( $m [6] );
				elseif (isset ( $m [7] ) and strlen ( $m [7] ))
					$atts [] = stripcslashes ( $m [7] );
				elseif (isset ( $m [8] ))
					$atts [] = stripcslashes ( $m [8] );
			}
		} else {
			$atts = ltrim ( $text );
		}
		return $atts;
	}
	public static function shortcode_atts($pairs, $atts) {
		$atts = ( array ) $atts;
		$out = array ();
		foreach ( $pairs as $name => $default ) {
			if (array_key_exists ( $name, $atts ))
				$out [$name] = $atts [$name];
			else
				$out [$name] = $default;
		}
		return $out;
	}
	public static function strip_shortcode_tag($m) {
		// allow [[foo]] syntax for escaping a tag
		if ($m [1] == '[' && $m [6] == ']') {
			return substr ( $m [0], 1, - 1 );
		}

		return $m [1] . $m [6];
	}
}