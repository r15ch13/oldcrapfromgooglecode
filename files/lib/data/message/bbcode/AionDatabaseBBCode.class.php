<?php
require_once(WCF_DIR.'lib/data/message/bbcode/BBCodeParser.class.php');
require_once(WCF_DIR.'lib/data/message/bbcode/BBCode.class.php');

class AionDatabaseBBCode implements BBCode {
	protected $url = '';
	protected $defaultlang = 'en';

	/**
	 * @see BBCode::getParsedTag()
	 */
	public function getParsedTag($openingTag, $content, $closingTag, BBCodeParser $parser) {
		if (!empty($content)) {
			if(preg_match('/http\:\/\/([a-zA-Z]{0,3})[.]{0,1}aiondatabase.com\/(item|skill|recipe|npc)\/(\d{0,10})/', StringUtil::encodeHtml($content), $data)) {

				$url = $data[0];
				$lang = $data[1];
				$type = $data[2];
				$item = $data[3];

				$size = "aion-".$type."-full-small";
				$name = $type ." #". $item;

				if(!empty($openingTag['attributes'][0])) {
					switch (StringUtil::encodeHtml(trim($openingTag['attributes'][0]))) {
						case "text":
							$size = "aion-".$type."-text";
							break;
						case "small":
							$size = "aion-".$type."-full-small";
							break;
						case "medium":
							$size = "aion-".$type."-full-medium";
							break;
						case "large":
							$size = "aion-".$type."-full-large";
							break;
						default:
							$name = StringUtil::encodeHtml(trim($openingTag['attributes'][0]));
					}
				}

				if(empty($lang)) {
					$lang = "www";
				}

				return '<a class="'.$size.'" href="http://'. $lang .'.aiondatabase.com/'. $type .'/'. $item .'">['. $name .']</a>';
			} else {
				return '<a href="'. StringUtil::encodeHtml($content) .'">'. StringUtil::encodeHtml($content) .'</a>';
			}

		}
	}
}
?>