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

namespace xpocketmc\crafting\json;

final class ShapelessRecipeData{

	/**
	 * @required
	 * @var RecipeIngredientData[]
	 * @phpstan-var list<RecipeIngredientData>
	 */
	public array $input;

	/**
	 * @required
	 * @var ItemStackData[]
	 * @phpstan-var list<ItemStackData>
	 */
	public array $output;

	/** @required */
	public string $block;

	/** @required */
	public int $priority;

	/**
	 * @param RecipeIngredientData[] $input
	 * @param ItemStackData[]        $output
	 *
	 * @phpstan-param list<RecipeIngredientData> $input
	 * @phpstan-param list<ItemStackData> $output
	 */
	public function __construct(array $input, array $output, string $block, int $priority){
		$this->block = $block;
		$this->priority = $priority;
		$this->input = $input;
		$this->output = $output;
	}
}