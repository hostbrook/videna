<?php
// Static pages controller (Default)
// File: /App/Controllers/Home.php
// Desc: Home page

namespace App\Controllers\Pages;

use \Videna\Core\Log;
use \App\Models\Users;
use \App\Models\Products;

class ProductOne extends \App\Controllers\Pages {

	
	public function actionTest() {
		
		$users = Users::getAll();
		$arr=array();
		foreach ($users as $user){
			$arr[$user['id']] = $user['name'];
		}
		Log::add($arr);


		$products = Products::getAll();
		$arr2=array();
		foreach ($products as $product){
			$arr2[$product['id']] = $product['title'];
		}
		Log::add($arr2);


		$this->actionIndex();

	}


} // END class Pages 