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

use xpocketmc\inventory\Inventory;
use pocketmine
etwork\mcpe\protocol\types\inventory\ItemStack;

final class InventoryManagerEntry{
	/**
	 * @var ItemStack[]
	 * @phpstan-var array<int, ItemStack>
	 */
	public array $predictions = [];

	/**
	 * @var ItemStackInfo[]
	 * @phpstan-var array<int, ItemStackInfo>
	 */
	public array $itemStackInfos = [];

	/**
	 * @var ItemStack[]
	 * @phpstan-var array<int, ItemStack>
	 */
	public array $pendingSyncs = [];

	public function __construct(
		public Inventory $inventory,
		public ?ComplexInventoryMapEntry $complexSlotMap = null
	){}
}