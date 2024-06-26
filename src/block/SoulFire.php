<?php

/*
 *
 * __  ______            _        _   __  __  ____      __  __ ____  
 * \ \/ /  _ \ ___   ___| | _____| |_|  \/  |/ ___|    |  \/  |  _ \ 
 *  \  /| |_) / _ \ / __| |/ / _ \ __| |\/| | |   _____| |\/| | |_) |
 *  /  \|  __/ (_) | (__|   <  __/ |_| |  | | |__|_____| |  | |  __/ 
 * /_/\_\_|   \___/ \___|_|\_\___|\__|_|  |_|\____|    |_|  |_|_|    
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author xpocketmc Team
 * @link http://www.xpocketmc.net/
 *
 *
 */

declare(strict_types=1);

namespace xpocketmc\block;

use pocketmine\math\Facing;

final class SoulFire extends BaseFire{

	public function getLightLevel() : int{
		return 10;
	}

	protected function getFireDamage() : int{
		return 2;
	}

	public static function canBeSupportedBy(Block $block) : bool{
		//TODO: this really ought to use some kind of tag system
		$id = $block->getTypeId();
		return $id === BlockTypeIds::SOUL_SAND || $id === BlockTypeIds::SOUL_SOIL;
	}

	public function onNearbyBlockChange() : void{
		if(!self::canBeSupportedBy($this->getSide(Facing::DOWN))){
			$this->position->getWorld()->setBlock($this->position, VanillaBlocks::AIR());
		}
	}
}