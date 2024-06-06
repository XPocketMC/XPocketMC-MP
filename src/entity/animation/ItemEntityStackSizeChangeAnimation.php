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

namespace xpocketmc\entity\animation;

use xpocketmc\entity\object\ItemEntity;
use pocketmine
etwork\mcpe\protocol\ActorEventPacket;
use pocketmine
etwork\mcpe\protocol\types\ActorEvent;

final class ItemEntityStackSizeChangeAnimation implements Animation{

	public function __construct(
		private ItemEntity $itemEntity,
		private int $newStackSize
	){}

	public function encode() : array{
		return [ActorEventPacket::create($this->itemEntity->getId(), ActorEvent::ITEM_ENTITY_MERGE, $this->newStackSize)];
	}
}