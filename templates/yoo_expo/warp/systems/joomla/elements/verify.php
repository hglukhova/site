<?php
/**
* @package   Warp Theme Framework
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   YOOtheme Proprietary Use License (http://www.yootheme.com/license)
*/

jimport('joomla.html.html');
jimport('joomla.form.formfield');

class JFormFieldVerify extends JFormField {

	protected $type = 'Verify';

	protected function getInput() {
		
		// load config
		require_once(dirname(dirname(dirname(dirname(dirname(__FILE__))))).'/config.php');
		
		// get warp and helpers
		$warp  =& Warp::getInstance();
		$path  =& $warp->getHelper('path');
        $check =& $warp->getHelper('checksum');

		// verify theme files
		$content = array('<div style="margin: 5px 0px;float: left;">');

		if (($checksums = $path->path('template:checksums')) && filesize($checksums)) {
			$check->verify($path->path('template:'), $log);

			if (count($log)) {
			
				$content[] = 'Some template files have been modified. <a href="#" class="verify-link">Click to show files.</a>';
				$content[] = '<ul class="verify">';
				foreach (array('modified', 'missing') as $type) {
					if (isset($log[$type])) {
						foreach ($log[$type] as $file) {
							$content[] = '<li class="'.$type.'">'.$file.($type == 'missing' ? ' (missing)' : null).'</li>';
						}
					}
				}
				$content[] = '</ul>';

			} else {
				$content[] = 'Verification successful, no file modifications detected.';
			}
		} else {
			$content[] = 'Checksum file is missing! Your template is maybe compromised.';
		}

		$content[] = '</div>';

		ob_start();		
		?>

		<style type="text/css">

			ul.verify {
				margin: 5px 0px 0px 0px;
				padding: 5px;
				background: #EEE;
				-moz-border-radius: 5px;
				-webkit-border-radius: 5px;
				border-radius: 5px;
			}

			ul.verify li {
				margin: 5px;
				padding: 0px;
			}

			ul.verify li.missing {
				color: red;
			}

		</style>
			
		<script type="text/javascript">
		
			window.addEvent('domready', function(){
				var ul = document.getElement("ul.verify");

				if (ul) {
					ul.setStyle('display', 'none');
				   	document.getElement("a.verify-link").addEvent("click", function(event){
						var event = new Event(event).stop();
						ul.setStyle('display', ul.getStyle('display') == 'none' ? 'block' : 'none');
					});
				}
			});
      
		</script>
		
		<?php
		return implode("\n", $content).ob_get_clean();
	}

}