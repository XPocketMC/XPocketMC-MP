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

namespace xpocketmc\block\inventory;

use xpocketmc\inventory\SimpleInventory;
use pocketmine
etwork\mcpe\protocol\BlockEventPacket;
use pocketmine
etwork\mcpe\protocol\types\BlockPosition;
use xpocketmc\world\Position;
use xpocketmc\world\sound\ChestCloseSound;
use xpocketmc\world\sound\ChestOpenSound;
use xpocketmc\world\sound\Sound;

class ChestInventory extends SimpleInventory implements BlockInventory{
	use AnimatedBlockInventoryTrait;

	public function __construct(Position $holder){
		$this->holder = $holder;
		parent::__construct(27);
	}

	protected function getOpenSound() : Sound{
		return new ChestOpenSound();
	}

	protected function getCloseSound() : Sound{
		return new ChestCloseSound();
	}

	public function animateBlock(bool $isOpen) : void{
		$holder = $this->getHolder();

		//event ID is always 1 for a chest
		$holder->getWorld()->broadcastPacketToViewers($holder, BlockEventPacket::create(BlockPosition::fromVector3($holder), 1, $isOpen ? 1 : 0));
	}
}