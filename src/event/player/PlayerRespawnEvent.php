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

use xpocketmc\player\Player;
use xpocketmc\utils\Utils;
use xpocketmc\world\Position;

/**
 * Called when a player is respawned
 */
class PlayerRespawnEvent extends PlayerEvent{
	public function __construct(
		Player $player,
		protected Position $position
	){
		$this->player = $player;
	}

	public function getRespawnPosition() : Position{
		return $this->position;
	}

	public function setRespawnPosition(Position $position) : void{
		if(!$position->isValid()){
			throw new \InvalidArgumentException("Spawn position must reference a valid and loaded World");
		}
		Utils::checkVector3NotInfOrNaN($position);
		$this->position = $position;
	}
}