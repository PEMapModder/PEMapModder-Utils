<?php

namespace pemapmodder\utils;

use pocketmine\command\CommandExecutor as CmdExe;
use pocketmine\command\CommandSender as Issuer;
use pocketmine\command\CommandMap;
use pocketmine\utils\TextFormat as Font;

use pocketmine\command\PluginCommand as ParentClass;
use pocketmine\plugin\Plugin;

class PluginCmdExt extends ParentClass{
	protected $pexecutor;
	protected $doParent = false;
	public function __construct($name, Plugin $plugin, CmdExe $exe = null){
		parent::__construct($name, $plugin);
		$this->pexecutor = $exe === null ? $plugin:$exe;
	}
	public function execute(Issuer $issuer, $label, array $args){
		if(!$this->getPlugin()->isEnabled())
			return false;
		if(!$this->testPermission($issuer))
			return false;
		$result = $this->pexecutor->onCommand($issuer, $this, $label, $args);
		if(is_null($result))
			return true;
		if(is_bool($result)){
			if(!$result)
				$issuer->sendMessage(Font::RED."Usage: {$this->usageMessage}");
			return $result;
		}
		if(!is_string($result)){
			trigger_error("Unexpected return type from ".Font::YELLOW.get_class($this->executor)."::onCommand(CommandSender, Command, string, array)".Font::RED.", !(string|bool|null): ".print_r($result, true), E_USER_WARNING);
			return true;
		}
		$issuer->sendMessage("$result");
		return true;
	}
	public function register(CommandMap $map = null){ // I know somebody will shout at me on this.
		if($map === null)
			$map = Server::getInstance()->getCommandMap();
		if(!$this->doParent){
			$this->doParent = true;
			$map->register($this->getPlugin()->getName(), $this);
			$this->doParent = false;
			return;
		}
		parent::register($map);
	}
}
