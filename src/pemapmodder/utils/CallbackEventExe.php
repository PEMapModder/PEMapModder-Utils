<?php

namespace pemapmodder\utils;

use pocketmine\event\Event;
use pocketmine\event\Listener;
use pocketmine\plugin\EventExecutor;

class CallbackEventExe implements EventExecutor{
	private $cb;
	public function __construct(callable $callback){
		$this->cb = $callback;
	}
	public function execute(Listener $l, Event $evt){
		call_user_func($this->cb, $evt);
	}
}
