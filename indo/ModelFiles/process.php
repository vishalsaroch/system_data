<?php

CLASS Process extends Functions{

	private function filter_data($var){
		$var = strip_tags($var);
		$var = preg_replace('|[^a-zA-Z0-9-_@.#, ]|i', '', $var);
		return $var;
	}
}