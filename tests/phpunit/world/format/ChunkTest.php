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

namespace xpocketmc\world\format;

use PHPUnit\Framework\TestCase;

class ChunkTest extends TestCase{

	public function testClone() : void{
		$chunk = new Chunk([], false);
		$chunk->setBlockStateId(0, 0, 0, 1);
		$chunk->setBiomeId(0, 0, 0, 1);
		$chunk->setHeightMap(0, 0, 1);

		$chunk2 = clone $chunk;
		$chunk2->setBlockStateId(0, 0, 0, 2);
		$chunk2->setBiomeId(0, 0, 0, 2);
		$chunk2->setHeightMap(0, 0, 2);

		self::assertNotSame($chunk->getBlockStateId(0, 0, 0), $chunk2->getBlockStateId(0, 0, 0));
		self::assertNotSame($chunk->getBiomeId(0, 0, 0), $chunk2->getBiomeId(0, 0, 0));
		self::assertNotSame($chunk->getHeightMap(0, 0), $chunk2->getHeightMap(0, 0));
	}
}