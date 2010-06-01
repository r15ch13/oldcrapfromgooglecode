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
		if(!empty($content)) {
			if(preg_match('#^http://(www|de|kr|jp|cn|fr|ru|)[.]{0,1}aiondatabase.com/(item|skill|recipe|gathersource|npc)/(\d+)#', $content, $data)) {
				/**
				 * $data[0] = URL
				 * $data[1] = Language
				 * $data[2] = Type
				 * $data[3] = ID
				 */

				$size = "aion-". $data[2] ."-full-small";
				$name = $data[2] ." #". $data[3];

				if(!empty($openingTag['attributes'][0])) {
					switch (StringUtil::encodeHtml(trim($openingTag['attributes'][0]))) {
						case "text":
							$size = "aion-". $data[2] ."-text";
							break;
						case "small":
							$size = "aion-". $data[2] ."-full-small";
							break;
						case "medium":
							$size = "aion-". $data[2] ."-full-medium";
							break;
						case "large":
							$size = "aion-". $data[2] ."-full-large";
							break;
						default:
							$name = StringUtil::encodeHtml(trim($openingTag['attributes'][0]));
					}
				}

				if(empty($data[1])) {
					$data[1] = "www";
				}

				return '<a class="'.$size.'" href="http://'. $data[1] .'.aiondatabase.com/'. $data[2] .'/'. $data[3] .'">['. $name .']</a>';
			} else {
				return '<a href="'. StringUtil::encodeHtml($content) .'">'. StringUtil::encodeHtml($content) .'</a>';
			}

		}
	}
}
?>