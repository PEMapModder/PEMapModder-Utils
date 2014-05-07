<?php

namespace pemapmodder\utils;

use pocketmine\command\Command;
use pocketmine\command\CommandMap;

class CorrPluginCmd extends PluginCmdExt{
	public function register(CommandMap $map){
		$this->doParent = true;
		parent::register($map);
	}
}
