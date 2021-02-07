<?php
// Videna Framework
// File: /Videna/Core/View.php
// Desc: Base view class

namespace Videna\Core;


class View {


	public static function render($view, $viewArgs = []) {

		extract($viewArgs, EXTR_SKIP);

		require_once PATH_VIEWS . $view  .'.php';

	}


	public static function jsonRender( $view = false , $viewArgs = [] ) {

		if ( empty($viewArgs) ) {
			$viewArgs['ajax']['response'] = -1;
			$viewArgs['ajax']['status'] = 'No data to show';
		}

		if ( $view ) {

			extract($viewArgs, EXTR_SKIP);
	
			ob_start();
			
			include_once PATH_VIEWS . $view  .'.php';
			
			$viewArgs['ajax']['html'] = ob_get_clean();

		}

		die( json_encode($viewArgs['ajax']) );

	}


} // END class View