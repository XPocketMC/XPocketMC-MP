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

namespace xpocketmc\world\sound;

use pocketmine\math\Vector3;
use pocketmine
etwork\mcpe\protocol\LevelSoundEventPacket;
use pocketmine
etwork\mcpe\protocol\types\LevelSoundEvent;
use function intdiv;
use function min;

class XpLevelUpSound implements Sound{
	public function __construct(private int $xpLevel){}

	public function getXpLevel() : int{
		return $this->xpLevel;
	}

	public function encode(Vector3 $pos) : array{
		//No idea why such odd numbers, but this works...
		//TODO: check arbitrary volume
		return [LevelSoundEventPacket::nonActorSound(LevelSoundEvent::LEVELUP, $pos, false, 0x10000000 * intdiv(min(30, $this->xpLevel), 5))];
	}
}