<?php

namespace pemapmodder\utils\io;

use pocketmine\utils\Config;

class CfgGrp {# implements ArrayAccess{
	public function __construct($dir, array $defaults){
		@mkdir($dir);
		$this->dir = $dir;
		foreach($defaults as $file=>$data){
			$this->create($file, $data);
		}
	}
	protected function create($file, $data){
		if(@$data["create-independent-dir"] === true){
			
		}
}
