<?php

namespace pemapmodder\utils;

use pocketmine\level\Position;
use pocketmine\tile\Tile;
use pocketmine\plugin\PluginBase;

foreach(array("CallbackPluginTask", "CallbackEventExe", "FileUtils", "PluginCmdExt") as $fn)
	require_once(dirname(__FILE__)."/$fn.php");

class DummyPlugin extends PluginBase{
	public static function getTile($poss, $forceArray = false){
		if($poss instanceof Position)
			$poss = array($poss);
		foreach(Tile::getAll() as $t){
			foreach($poss as $pos){
				if($t->x === $pos->x and $t->y === $pos->y and $t->z === $pos->z and $t->level->getName() === $pos->level->getName())
					$ret[$pos->x.":".$pos->y.":".$pos->z."@".$pos->level->getName()] = $t;
				if(count($poss) === count($ret))
					break;
			}
		}
		if(count($poss) === 1 and !$forceArray)
			return array_rand($poss);
		return $ret;
	}
	public function onLoad(){
		console("PEMapModder-Utils has been loaded!");
	}
}
