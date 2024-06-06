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

namespace xpocketmc\block\utils;

use xpocketmc\utils\LegacyEnumShimTrait;

/**
 * TODO: These tags need to be removed once we get rid of LegacyEnumShimTrait (PM6)
 *  These are retained for backwards compatibility only.
 *
 * @method static DripleafState FULL_TILT()
 * @method static DripleafState PARTIAL_TILT()
 * @method static DripleafState STABLE()
 * @method static DripleafState UNSTABLE()
 */
enum DripleafState{
	use LegacyEnumShimTrait;

	case STABLE;
	case UNSTABLE;
	case PARTIAL_TILT;
	case FULL_TILT;

	public function getScheduledUpdateDelayTicks() : ?int{
		return match($this){
			self::STABLE => null,
			self::UNSTABLE, self::PARTIAL_TILT => 10,
			self::FULL_TILT => 100,
		};
	}
}