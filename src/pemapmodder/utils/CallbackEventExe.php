<?php

namespace pemapmodder\utils;

use pocketmine\event\Event;
use pocketmine\event\Listener;
use pocketmine\plugin\EventExecutor;

class CallbackEventExe implements EventExecutor{
	public function __construct(callable $callback){
		$this->cb = $cb;
	}
	public function execute(Listener $l, Event $evt){
		call_user_func($this->cb, $evt);
	}
}
