<?php
require_once(WCF_DIR.'lib/data/message/bbcode/BBCodeParser.class.php');
require_once(WCF_DIR.'lib/data/message/bbcode/BBCode.class.php');

class WowheadBBCode implements BBCode {
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

			$data = @$this->string2array(str_replace("?", "#", $content), "%url%#%typ%=%iid%");
			if (!empty($data['typ'])) {

				if (!empty($openingTag['attributes'][0])) {

                        		if (is_numeric($openingTag['attributes'][0])) {

						$quali = ' class="q'.$openingTag['attributes'][0].'"';
						if (!empty($openingTag['attributes'][1])) {

							$name = $openingTag['attributes'][1];
						} else {

							$name = $data['typ']." #".$data['iid'];
						}
					} else {

                        			$name = $openingTag['attributes'][0];
						if (!empty($openingTag['attributes'][1])) {

							if (is_numeric($openingTag['attributes'][1])) {

								$quali = ' class="q'.$openingTag['attributes'][1].'"';
							} else {

								$quali = false;
							}
						} else {

							$quali = false;
						}
					}
				} else {

                			$name = $data['typ']." #".$data['iid'];
                			$quali = false;
				}
				return '<a href="'.$content.'"'.$quali.'>['.$name.']</a>';
			}
		}

	}
}
?>
