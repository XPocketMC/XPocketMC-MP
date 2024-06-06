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

namespace pocketmine
etwork\mcpe\cache;

use xpocketmc\data\bedrock\BedrockDataFiles;
use pocketmine
etwork\mcpe\protocol\AvailableActorIdentifiersPacket;
use pocketmine
etwork\mcpe\protocol\BiomeDefinitionListPacket;
use pocketmine
etwork\mcpe\protocol\serializer\NetworkNbtSerializer;
use pocketmine
etwork\mcpe\protocol\types\CacheableNbt;
use xpocketmc\utils\Filesystem;
use xpocketmc\utils\SingletonTrait;

class StaticPacketCache{
	use SingletonTrait;

	/**
	 * @phpstan-return CacheableNbt<\pocketmine
bt\tag\CompoundTag>
	 */
	private static function loadCompoundFromFile(string $filePath) : CacheableNbt{
		return new CacheableNbt((new NetworkNbtSerializer())->read(Filesystem::fileGetContents($filePath))->mustGetCompoundTag());
	}

	private static function make() : self{
		return new self(
			BiomeDefinitionListPacket::create(self::loadCompoundFromFile(BedrockDataFiles::BIOME_DEFINITIONS_NBT)),
			AvailableActorIdentifiersPacket::create(self::loadCompoundFromFile(BedrockDataFiles::ENTITY_IDENTIFIERS_NBT))
		);
	}

	public function __construct(
		private BiomeDefinitionListPacket $biomeDefs,
		private AvailableActorIdentifiersPacket $availableActorIdentifiers
	){}

	public function getBiomeDefs() : BiomeDefinitionListPacket{
		return $this->biomeDefs;
	}

	public function getAvailableActorIdentifiers() : AvailableActorIdentifiersPacket{
		return $this->availableActorIdentifiers;
	}
}