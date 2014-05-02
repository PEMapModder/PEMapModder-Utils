<?php

namespace pemapmodder\utils;

use pocketmine\command\CommandExecutor as CmdExe;
use pocketmine\command\CommandSender as Issuer;
use pocketmine\utils\TextFormat as Font;
use pocketmine\command\PluginCommand as ParentClass;
use pocketmine\plugin\Plugin;

class PluginCmdExt extends ParentClass{
	public function __construct($name, Plugin $plugin, CmdExe $exe = null){
		parent::__construct($name, $plugin);
		$this->executor = $exe === null ? $plugin:$exe;
	}
	public function execute(Issuer $issuer, $label, array $args){
		if(!$this->owningPlugin->isEnabled())
			return false;
		if(!$this->testPermission($issuer))
			return false;
		$result = $this->executor->onCommand($issuer, $this, $label, $args);
		if(is_null($result))
			return true;
		if(is_bool($result)){
			if(!$result)
				$issuer->sendMessage(Font::RED."Usage: {$this->usageMessage}");
			return $result;
		}
		if(!is_string($result)){
			trigger_error("Unexpected return type from ".Font::YELLOW.get_class($this->executor)."::onCommand(CommandSender, Command, string, array)".Font::RED.", !(string|bool|null): ".print_r($result, true), E_USER_ERROR);
			return true;
		}
		$issuer->sendMessage("$result");
		return true;
	}
}
