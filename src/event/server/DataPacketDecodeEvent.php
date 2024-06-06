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
use pocketmine
etwork\mcpe\NetworkSession;

/**
 * Called before a packet is decoded and handled by the network session.
 * Cancelling this event will drop the packet without decoding it, minimizing wasted CPU time.
 */
class DataPacketDecodeEvent extends ServerEvent implements Cancellable{
	use CancellableTrait;

	public function __construct(
		private NetworkSession $origin,
		private int $packetId,
		private string $packetBuffer
	){}

	public function getOrigin() : NetworkSession{
		return $this->origin;
	}

	public function getPacketId() : int{
		return $this->packetId;
	}

	public function getPacketBuffer() : string{
		return $this->packetBuffer;
	}
}