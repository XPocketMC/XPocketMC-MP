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

namespace xpocketmc\event\player;

use xpocketmc\event\Cancellable;
use xpocketmc\event\CancellableTrait;
use xpocketmc\item\Item;
use pocketmine\math\Vector3;
use xpocketmc\player\Player;

/**
 * Called when a player uses its held item, for example when throwing a projectile.
 */
class PlayerItemUseEvent extends PlayerEvent implements Cancellable{
	use CancellableTrait;

	public function __construct(
		Player $player,
		private Item $item,
		private Vector3 $directionVector
	){
		$this->player = $player;
	}

	/**
	 * Returns the item used.
	 */
	public function getItem() : Item{
		return clone $this->item;
	}

	/**
	 * Returns the direction the player is aiming when activating this item. Used for projectile direction.
	 */
	public function getDirectionVector() : Vector3{
		return $this->directionVector;
	}
}