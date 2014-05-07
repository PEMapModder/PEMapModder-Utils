<?php

namespace pemapmodder\utils;

/**
 * A Config class, alternative to the PocketMine-MP default Config class.
 * Supports multiple versions of them, thus encodes
 */
class Config{
	public $type, $path;
	public function __construct($path, $isJSON = true, $default = array(), $version = 0){
		if(!isset($default["pemapmodder-utils-config-version"])){
			$default["pemapmodder-utils-config-version"] = $version;
		}
		$this->path = $path;
		$this->type = $isJSON;
		$this->config  = $default;
		if(!is_file($path)){
			$this->write();
		}
		else{
			$this->read();
			if($this->config["pemapmodder-utils-config-version"] < $version){
				$this->config["pemapmodder-utils-config-version"] = $version;
				foreach($default as $key=>$value){
					if(!isset($this->config[$key]))
						$this->config[$key] = $value;
				}
			}
		}
	}
	public function save(){
		$this->write();
	}
	public function write(){
		$this->config["pemapmodder-utils-config-timestamp-lastedit"] = time();
		if($this->type)
			file_put_contents($this->path, json_encode($this->config));
		else
			file_put_contents($this->path, yaml_emit($this->config));
	}
	public function reload(){
		return $this->read();
	}
	public function getAll(){
		return $this->read();
	}
	public function read(){
		if($this->type)
			$this->config = @json_decode(@file_get_contents($this->path));
		else
			$this->config = @yaml_parse(@file_get_contents($this->path));
		return $this->config;
	}
	public function offsetExists($k){
		return isset($this->config[$k]);
	}
	public function offsetGet($k){
		return $this->config[$k];
	}
	public function offsetSet($k, $v){
		$this->config[$k] = $v;
		$this->write();
	}
	public function offsetUnset($k){
		unset($this->config[$k]);
	}
}
