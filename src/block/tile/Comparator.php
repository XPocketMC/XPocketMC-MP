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

namespace xpocketmc\block\tile;

use xpocketmc\block\RedstoneComparator;
use pocketmine
bt\tag\CompoundTag;

/**
 * @deprecated
 * @see RedstoneComparator
 */
class Comparator extends Tile{
	private const TAG_OUTPUT_SIGNAL = "OutputSignal"; //int

	protected int $signalStrength = 0;

	public function getSignalStrength() : int{
		return $this->signalStrength;
	}

	public function setSignalStrength(int $signalStrength) : void{
		$this->signalStrength = $signalStrength;
	}

	public function readSaveData(CompoundTag $nbt) : void{
		$this->signalStrength = $nbt->getInt(self::TAG_OUTPUT_SIGNAL, 0);
	}

	protected function writeSaveData(CompoundTag $nbt) : void{
		$nbt->setInt(self::TAG_OUTPUT_SIGNAL, $this->signalStrength);
	}
}