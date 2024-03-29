<?php
/**
* @package   Warp Theme Framework
* @author    YOOtheme http://www.yootheme.com
* @copyright Copyright (C) YOOtheme GmbH
* @license   YOOtheme Proprietary Use License (http://www.yootheme.com/license)
*/

/*
	Class: WarpHelperModules
		Module helper class, count/render modules
*/
class WarpHelperModules extends WarpHelper {

    /*
		Variable: _document
			Document.
    */
	var $_document;
	
    /*
		Variable: _renderer
			Module renderer.
    */
	var $_renderer;

	/*
		Function: Constructor
			Class Constructor.
	*/
	function __construct() {
		parent::__construct();

		// init vars
		$this->_document =& JFactory::getDocument();
		$this->_renderer =& $this->_document->loadRenderer('module');
	}
	
	
	/*
		Function: count
			Retrieve the active module count at a position

		Returns:
			Int
	*/
	function count($position) {

		// init vars
		$document =& JFactory::getDocument();
		
		return $document->countModules($position);
	}

	/*
		Function: render
			Shortcut to render a position

		Returns:
			String
	*/
	function render($position, $args = array()) {

		// set position in arguments
		$args['position'] = $position;

		return $this->warp->template->render('modules', $args);
	}

	/*
		Function: load
			Retrieve a module objects of a position

		Returns:
			Array
	*/
	function load($position) {

		// init vars
		$modules  =& JModuleHelper::getModules($position);

		// set params, force no style
		$params['style'] = 'none';
		
		// get modules content
		foreach ($modules as $index => $module)  {
			
			// set module params
			$module->parameter = new JRegistry($module->params);
			
			// set parameter show all children for accordion menu
			if ($module->module == 'mod_menu') {
				if (strpos($module->parameter->get('class_sfx', ''), 'accordion') !== false) {
					
					if ($module->parameter->get('showAllChildren') == 0) {
						$module->parameter->set('showAllChildren', 1);					
						$module->showAllChildren = 0;
					} else {
						$module->showAllChildren = 1;
					}

					$module->params = $module->parameter->toString();
				}
			}
			
			$modules[$index]->content = $this->_renderer->render($module, $params);
		}

		return $modules;
	}

}