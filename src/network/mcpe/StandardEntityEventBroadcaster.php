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
etwork\mcpe;

use xpocketmc\data\bedrock\EffectIdMap;
use xpocketmc\entity\Attribute;
use xpocketmc\entity\effect\EffectInstance;
use xpocketmc\entity\Entity;
use xpocketmc\entity\Human;
use xpocketmc\entity\Living;
use pocketmine
etwork\mcpe\convert\TypeConverter;
use pocketmine
etwork\mcpe\protocol\ClientboundPacket;
use pocketmine
etwork\mcpe\protocol\EmotePacket;
use pocketmine
etwork\mcpe\protocol\MobArmorEquipmentPacket;
use pocketmine
etwork\mcpe\protocol\MobEffectPacket;
use pocketmine
etwork\mcpe\protocol\MobEquipmentPacket;
use pocketmine
etwork\mcpe\protocol\RemoveActorPacket;
use pocketmine
etwork\mcpe\protocol\SetActorDataPacket;
use pocketmine
etwork\mcpe\protocol\TakeItemActorPacket;
use pocketmine
etwork\mcpe\protocol\types\entity\Attribute as NetworkAttribute;
use pocketmine
etwork\mcpe\protocol\types\entity\PropertySyncData;
use pocketmine
etwork\mcpe\protocol\types\inventory\ContainerIds;
use pocketmine
etwork\mcpe\protocol\types\inventory\ItemStackWrapper;
use pocketmine
etwork\mcpe\protocol\UpdateAttributesPacket;
use function array_map;
use function count;
use function ksort;
use const SORT_NUMERIC;

final class StandardEntityEventBroadcaster implements EntityEventBroadcaster{

	public function __construct(
		private PacketBroadcaster $broadcaster,
		private TypeConverter $typeConverter
	){}

	/**
	 * @param NetworkSession[] $recipients
	 */
	private function sendDataPacket(array $recipients, ClientboundPacket $packet) : void{
		$this->broadcaster->broadcastPackets($recipients, [$packet]);
	}

	public function syncAttributes(array $recipients, Living $entity, array $attributes) : void{
		if(count($attributes) > 0){
			$this->sendDataPacket($recipients, UpdateAttributesPacket::create(
				$entity->getId(),
				array_map(fn(Attribute $attr) => new NetworkAttribute($attr->getId(), $attr->getMinValue(), $attr->getMaxValue(), $attr->getValue(), $attr->getDefaultValue(), []), $attributes),
				0
			));
		}
	}

	public function syncActorData(array $recipients, Entity $entity, array $properties) : void{
		//TODO: HACK! as of 1.18.10, the client responds differently to the same data ordered in different orders - for
		//example, sending HEIGHT in the list before FLAGS when unsetting the SWIMMING flag results in a hitbox glitch
		ksort($properties, SORT_NUMERIC);
		$this->sendDataPacket($recipients, SetActorDataPacket::create($entity->getId(), $properties, new PropertySyncData([], []), 0));
	}

	public function onEntityEffectAdded(array $recipients, Living $entity, EffectInstance $effect, bool $replacesOldEffect) : void{
		//TODO: we may need yet another effect <=> ID map in the future depending on protocol changes
		$this->sendDataPacket($recipients, MobEffectPacket::add(
			$entity->getId(),
			$replacesOldEffect,
			EffectIdMap::getInstance()->toId($effect->getType()),
			$effect->getAmplifier(),
			$effect->isVisible(),
			$effect->getDuration(),
			tick: 0
		));
	}

	public function onEntityEffectRemoved(array $recipients, Living $entity, EffectInstance $effect) : void{
		$this->sendDataPacket($recipients, MobEffectPacket::remove($entity->getId(), EffectIdMap::getInstance()->toId($effect->getType()), tick: 0));
	}

	public function onEntityRemoved(array $recipients, Entity $entity) : void{
		$this->sendDataPacket($recipients, RemoveActorPacket::create($entity->getId()));
	}

	public function onMobMainHandItemChange(array $recipients, Human $mob) : void{
		//TODO: we could send zero for slot here because remote players don't need to know which slot was selected
		$inv = $mob->getInventory();
		$this->sendDataPacket($recipients, MobEquipmentPacket::create(
			$mob->getId(),
			ItemStackWrapper::legacy($this->typeConverter->coreItemStackToNet($inv->getItemInHand())),
			$inv->getHeldItemIndex(),
			$inv->getHeldItemIndex(),
			ContainerIds::INVENTORY
		));
	}

	public function onMobOffHandItemChange(array $recipients, Human $mob) : void{
		$inv = $mob->getOffHandInventory();
		$this->sendDataPacket($recipients, MobEquipmentPacket::create(
			$mob->getId(),
			ItemStackWrapper::legacy($this->typeConverter->coreItemStackToNet($inv->getItem(0))),
			0,
			0,
			ContainerIds::OFFHAND
		));
	}

	public function onMobArmorChange(array $recipients, Living $mob) : void{
		$inv = $mob->getArmorInventory();
		$converter = $this->typeConverter;
		$this->sendDataPacket($recipients, MobArmorEquipmentPacket::create(
			$mob->getId(),
			ItemStackWrapper::legacy($converter->coreItemStackToNet($inv->getHelmet())),
			ItemStackWrapper::legacy($converter->coreItemStackToNet($inv->getChestplate())),
			ItemStackWrapper::legacy($converter->coreItemStackToNet($inv->getLeggings())),
			ItemStackWrapper::legacy($converter->coreItemStackToNet($inv->getBoots()))
		));
	}

	public function onPickUpItem(array $recipients, Entity $collector, Entity $pickedUp) : void{
		$this->sendDataPacket($recipients, TakeItemActorPacket::create($collector->getId(), $pickedUp->getId()));
	}

	public function onEmote(array $recipients, Human $from, string $emoteId) : void{
		$this->sendDataPacket($recipients, EmotePacket::create($from->getId(), $emoteId, "", "", EmotePacket::FLAG_SERVER | EmotePacket::FLAG_MUTE_ANNOUNCEMENT));
	}
}