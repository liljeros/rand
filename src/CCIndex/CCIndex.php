<?php


class CCIndex implements IController {

	public function Index(){
		global $rd;
		$rd->data['title'] = "The Index Controller - Rickard Liljeros";
	}
}