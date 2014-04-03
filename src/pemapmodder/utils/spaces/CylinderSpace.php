<?php

namespace pemapmodder\utils\spaces;

class CylinderSpace extends Space{
	/**
	 * Constructs a new CylinderSpace object
	 * 
	 * @param Position $baseCentre centre block of the base of the cylinder. Coordinates read as intergral.
	 * @param double $radius radius of the cylinder.
	 * @param int $height height of the cylinder (inclusive)
	*/
	public function __construct(Position $baseCentre, $radius, $height){
		$this->baseCentre = clone $baseCentre;
		$this->radius = $radius;
		if($this->radius < 0)
			$this->radius *= (0 - 1);
		$this->topY = $baseCentre->y + $height - 1;
	}
	protected function getBlocksList($get = false){
		$list = array();
		for($y = $this->baseCentre->y; $y <= $this->topY; $y++){
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
