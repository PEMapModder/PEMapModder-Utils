<?php

namespace pemapmodder\utils\spaces;

/**
 * Cylinder space object with vertical axis as given in constructor
*/
class CylinderSpace extends Space{
	public static $axs = array("x", "y", "z");
	/**
	 * Constructs a new CylinderSpace object
	 * 
	 * @param Position $baseCentre centre block of the base of the cylinder. Coordinates read as intergral.
	 * @param double $radius radius of the cylinder.
	 * @param int $height height of the cylinder (inclusive)
	 * @param string $axis "x", "y" or "z"
	*/
	public function __construct(Position $baseCentre, $radius, $height, $axis){
		$this->baseCentre = clone $baseCentre;
		$this->radius = $radius;
		if($this->radius < 0)
			$this->radius *= (0 - 1);
		$this->top = $baseCentre->$axis + $height - 1;
		$this->ax = array_search($axis, self::$axs);
	}
	protected function getBlocksList($get = false){
		$axis = self::$axs[$this->ax];
		$sec = self::$axs[$this->ax + 1];
		$list = array();
		for($y = $this->baseCentre->$axis; $y <= $this->top; $y++){
			for($x = $this->baseCentre->x - $this->radius; $x <= $this->baseCentre->x + $this->radius; $x++){
				for($z = $this->baseCentre->z - $this->radius; $z <= $this->baseCentre->z + $this->radius; $z++){
					$v = new Vector3($x, $y, $z);
					if($v->distance(new Vector3($this->baseCentre->x, $y, $this->baseCentre->z)) <= $this->radius){
						if($get) $list[] = $this->baseCentre->level->getBlock($v);
						else $list[] = $v;
					}
				}
			}
		}
		return $list;
	}
}
