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

namespace xpocketmc\event\server;

use xpocketmc\event\Cancellable;
use xpocketmc\event\CancellableTrait;
use xpocketmc\network\mcpe\NetworkSession;
use xpocketmc\network\mcpe\protocol\ServerboundPacket;

class DataPacketReceiveEvent extends ServerEvent implements Cancellable{
	use CancellableTrait;

	public function __construct(
		private NetworkSession $origin,
		private ServerboundPacket $packet
	){}

	public function getPacket() : ServerboundPacket{
		return $this->packet;
	}

	public function getOrigin() : NetworkSession{
		return $this->origin;
	}
}