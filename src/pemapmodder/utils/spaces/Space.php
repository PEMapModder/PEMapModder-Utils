<?php

namespace pemapmodder\utils\spaces;

abstract class Space{
	/**
	 * Checks whether a position is inside the space.
	 * 
	 * @param Position $pos the position to check
	 * @return bool <code>true</code> if inclusively inside, <code>false</code> otherwise.
	*/
	public abstract function isInside(Position $pos);
	/**
	 * Set all blocks in this Space into a specified block.
	 * 
	 * @param Block $block replace all blocks in this Space to this.
	 * @return int count of the number of blocks changed.
	*/
	protected abstract function getBlocksList($get = false);
	public abstract function setBlocks(Block $block);
	/**
	 * Clear all blocks.<br>Subsitution of <code>Space->setBlocks(new AirBlock());</code>
	 * @return int count of the number of blocks changed.
	*/
	public abstract function clearBlocks();
	/**
	 * Replace all blocks of a type to another type.
	 * 
	 * @param Block $original block type to be replaced.
	 * @param Block $new block type to be replaced with.
	 * @param bool $detectMeta if identical to <code>false</code>, replace all blocks with the ID of $original. Default <code>true</code>.
	 * @return int count of the number of blocks changed.
	*/
	public abstract function replaceBlocks(Block $original, Block $new, $detectMeta = true);
	/**
	 * Fill all air blocks (and optionally liquid blocks) with a specified block.
	 * 
	 * @param Block $new block type to fill with.
	 * @param bool $liquid if identical to <codee>true</code>, fill water and lava too. Default <code>false</code>.
	 * @return int count of the number of blocks changed.
	*/
	public abstract function fillBlocks(Block $new, $liquid = false);
	/**
	 * Checks whether two Vector3 objects are identical.
	 * 
	 * @param Vector3 $arg0
	 * @param Vector3 $arg1
	 * @param bool $strict Default <code>false</code>.
	 * @param bool $ignoreCoords Default <code>false</code>.
	 * @param bool $ignoreLevel Default <code>false</code>.
	 * @return bool
	*/
	protected function isIdentical(Vector3 $a, Vector3 $b, $strict = false, $ignoreCoords = false, $ignoreLevel = false){
		$result = true;
		if($ignoreCoords === false){
			$result = ($a->x === $b->x) and ($a->y === $a->y) and ($a->z === $a->z);
		}
		if(($a instanceof Position) and ($b instanceof Position)){
			if($ignoreLevel === false){
				$result = $result and ($a->level->getName() === $b->level->getName());
			}
			if(($a instanceof Block) and ($b instanceof Block)){
				$result = $result and ($a->getID() === $b->getID());
				if($strict === true){
					$result = $result and ($a->getMetadata() === $b->getMetadata());
				}
			}
		}
		return $result;
	}
}
