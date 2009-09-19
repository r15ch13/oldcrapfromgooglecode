<?php
require_once(WCF_DIR.'lib/data/message/bbcode/BBCodeParser.class.php');
require_once(WCF_DIR.'lib/data/message/bbcode/BBCode.class.php');

class AionarmoryBBCode implements BBCode {
	protected $url = '';
	protected $defaultlang = 'en';

	/**
	 * @see http://de3.php.net/manual/de/function.split.php#57113
	 */
	protected function string2array ($string, $template){
		preg_match_all ("|%(.+)%|U", $template, $template_matches);
		$template = preg_replace ("|%(.+)%|U", "(.+)", $template);
		preg_match ("|" . $template . "|", $string, $string_matches);
		foreach ($template_matches[1] as $key => $value){
			$output[$value] = $string_matches[($key + 1)];
		}
		return $output;
	}

	/**
	 * @see BBCode::getParsedTag()
	 */
	public function getParsedTag($openingTag, $content, $closingTag, BBCodeParser $parser) {
		if (!empty($content)) {
			$data = @$this->string2array(str_replace("?", "#", htmlentities($content)), "%crap%/%typ%.aspx#id=%id%");

			if(in_array($data['typ'], array("item", "npc", "spell")) && is_numeric($data['id'])) {

				$itemid = htmlentities($data['id']);
				$typ = htmlentities($data['typ']);
				$size = "aiondb-item-full-small";
				$name = $typ ." #". $itemid;

				if(!empty($openingTag['attributes'][0])) {
					switch (htmlentities(trim($openingTag['attributes'][0]))) {
						case "text":
							$size = "aiondb-item-text";
							break;
						case "small":
							$size = "aiondb-item-full-small";
							break;
						case "medium":
							$size = "aiondb-item-full-medium";
							break;
						case "large":
							$size = "aiondb-item-full-large";
							break;
						default:
							$name = htmlentities(trim($openingTag['attributes'][0]));
					}
				}

				return '<a class="'.$size.'" href="http://www.aionarmory.com/'. $typ .'.aspx?id='. $itemid .'">['. $name .']</a>';
			} else {
				return '<a href="'. htmlentities($content) .'">'. htmlentities($content) .'</a>';;
			}

		}

	}
}
?>
