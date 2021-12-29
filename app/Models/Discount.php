<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;
	protected $fillable = [ 'title', 'code', 'description', 'start_at', 'end_at','main_image' ];
	protected $appends = ['status', 'type'];
	protected $cast = ['start_at' => 'dateTime', 'end_at' => 'date',];

	public function getStatusAttribute(){
		$now = Carbon::now();
		$status = 'active' ;
		if ($this->end_at < $now ) {
			$status = 'disabled' ;
		}else if( $this->start_at > $now ) {
			$status = 'schedule' ;
		}
		return $status;
	}
	public function getTypeAttribute(){
		return  empty($this->code)  ? 'discount' : 'coupon';
	}
}
