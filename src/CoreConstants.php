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

namespace xpocketmc;

use function define;
use function defined;
use function dirname;

// composer autoload doesn't use require_once and also pthreads can inherit things
if(defined('xpocketmc\_CORE_CONSTANTS_INCLUDED')){
	return;
}
define('xpocketmc\_CORE_CONSTANTS_INCLUDED', true);

define('xpocketmc\PATH', dirname(__DIR__) . '/');
define('xpocketmc\RESOURCE_PATH', dirname(__DIR__) . '/resources/');
define('xpocketmc\BEDROCK_DATA_PATH', dirname(__DIR__) . '/vendor/xpocketmc/bedrock-data/');
define('xpocketmc\LOCALE_DATA_PATH', dirname(__DIR__) . '/vendor/xpocketmc/locale-data/');
define('xpocketmc\BEDROCK_BLOCK_UPGRADE_SCHEMA_PATH', dirname(__DIR__) . '/vendor/xpocketmc/bedrock-block-upgrade-schema/');
define('xpocketmc\BEDROCK_ITEM_UPGRADE_SCHEMA_PATH', dirname(__DIR__) . '/vendor/xpocketmc/bedrock-item-upgrade-schema/');
define('xpocketmc\COMPOSER_AUTOLOADER_PATH', dirname(__DIR__) . '/vendor/autoload.php');