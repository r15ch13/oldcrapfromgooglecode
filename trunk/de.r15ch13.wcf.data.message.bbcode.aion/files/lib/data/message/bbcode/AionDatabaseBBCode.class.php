<?php
require_once(WCF_DIR.'lib/data/message/bbcode/BBCodeParser.class.php');
require_once(WCF_DIR.'lib/data/message/bbcode/BBCode.class.php');

class AionDatabaseBBCode implements BBCode {
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
			/*
				http://de.aiondatabase.com/item/100900189
					aion-item-full-small
					aion-item-full-medium
					aion-item-full-large
				http://de.aiondatabase.com/skill/572
					aion-skill-full-small					
					aion-skill-full-medium
					aion-skill-full-large
				http://de.aiondatabase.com/recipe/155006350
					aion-recipe-full-small
					aion-recipe-full-medium
					aion-recipe-full-large
				http://de.aiondatabase.com/npc/204147
					aion-npc-full-small
					aion-npc-full-medium
					aion-npc-full-large
			*/

			$data = @$this->string2array(htmlentities($content), "%url%/%type%/%id%");

			if(in_array($data['type'], array('item', 'skill', 'recipe', 'npc')) && is_numeric($data['id'])) {

				$url = htmlentities($data['url']);
				$id = $data['id'];
				$type = $data['type'];
				$size = "aion-".$type."-full-small";
				$name = $type ." #". $id;

				if(!empty($openingTag['attributes'][0])) {
					switch (htmlentities(trim($openingTag['attributes'][0]))) {
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
							$name = htmlentities(trim($openingTag['attributes'][0]));
					}
				}

				return '<a class="'.$size.'" href="'. $url .'/'. $type .'/'. $id .'">['. $name .']</a>';
			} else {
				return '<a href="'. htmlentities($content) .'">'. htmlentities($content) .'</a>';;
			}

		}

	}
}
?>
