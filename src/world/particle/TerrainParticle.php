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

namespace xpocketmc\world\particle;

use xpocketmc\block\Block;
use pocketmine\math\Vector3;
use pocketmine
etwork\mcpe\convert\TypeConverter;
use pocketmine
etwork\mcpe\protocol\LevelEventPacket;
use pocketmine
etwork\mcpe\protocol\types\ParticleIds;

class TerrainParticle implements Particle{
	public function __construct(private Block $b){}

	public function encode(Vector3 $pos) : array{
		return [LevelEventPacket::standardParticle(ParticleIds::TERRAIN, TypeConverter::getInstance()->getBlockTranslator()->internalIdToNetworkId($this->b->getStateId()), $pos)];
	}
}