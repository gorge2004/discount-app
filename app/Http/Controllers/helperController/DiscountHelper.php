<?php
namespace App\Http\Controllers\helperController;

use App\Models\Discount;

class DiscountHelper
{

	public function getAllDiscount(){

		return Discount::all();
	}

	public function getDiscountFilterByLimit($limit = 10){

		return Discount::orderBy('created_at')->limit($limit)->get();
	}

	public function getDiscountFilter($title= null, $code = null, $description=null, $start_at = null , $end_at = null, $limit = 10){
		$discount = Discount::when($title, function($query)use($title){
					return $query->where('title', 'LIKE ' ,'%' .$title.'%');
					})
				->when($code, function($query)use($code){
					return $query->orWhere('code', 'LIKE ' ,'%' .$code.'%');
				})
				->when($description, function($query)use($description){
					return $query->orWhere('description', 'LIKE ' ,'%' .$description.'%');
				})
				->when($description, function($query)use($description){
					return $query->orWhere('description', 'LIKE ' ,'%' .$description.'%');
				})
				->when($start_at, function($query)use($start_at){
					return $query->orWhere('start_at', '>= ' ,$start_at);
				})
				->when($end_at, function($query)use($end_at){
					return $query->orWhere('end_at', $end_at);
				})
				->limit($limit)
				->orderBy('created_at')
				->get();
		return $discount;
	}

	public function createDiscount($discount_array){

		return Discount::create($discount_array);
	}
	public function udpateDiscount(Discount $discount, $discount_array){

		return $discount->update($discount_array);
	}

}
