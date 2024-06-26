<?php

/*
 *
 *  ____            _        _   __  __ _                  __  __ ____
 * |  _ \ ___   ___| | _____| |_|  \/  (_)_ __   ___      |  \/  |  _ \
 * | |_) / _ \ / __| |/ / _ \ __| |\/| | | '_ \ / _ \_____| |\/| | |_) |
 * |  __/ (_) | (__|   <  __/ |_| |  | | | | | |  __/_____| |  | |  __/
 * |_|   \___/ \___|_|\_\___|\__|_|  |_|_|_| |_|\___|     |_|  |_|_|
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

namespace xpocketmc\data\bedrock;

use PHPUnit\Framework\TestCase;
use xpocketmc\item\enchantment\VanillaEnchantments;

class EnchantmentIdMapTest extends TestCase{

	public function testAllEnchantsMapped() : void{
		foreach(VanillaEnchantments::getAll() as $enchantment){
			$id = EnchantmentIdMap::getInstance()->toId($enchantment);
			$enchantment2 = EnchantmentIdMap::getInstance()->fromId($id);
			self::assertTrue($enchantment === $enchantment2);
		}
	}
}