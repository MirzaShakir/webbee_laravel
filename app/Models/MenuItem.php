<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
	/**
	 * Generate the praent-child relationship of the menu items
	 * @param array $arrItems represents the menu items
	 * @param int $parentId represents the parent menu item
	 * @return array
	 */
	public function buildRelationship(array $arrItems, $parentId = 0) {
		$arrResponse = array();

		foreach ($arrItems as $arrItem) {
			if ($arrItem['parent_id'] == $parentId) {
				$arrChildrens = $this->buildRelationship($arrItems, $arrItem['id']);
				if ($arrChildrens) {
					$arrItem['children'] = $arrChildrens;
				}
				$arrResponse[] = $arrItem;
			}
		}

		return $arrResponse;
	}
}
