<?php

namespace pemapmodder\utils\oldapi;

use pocketmine\Server;

class Level{
	public static function get($name){
		return Server::getInstance()->getLevel($name);
	}
}
