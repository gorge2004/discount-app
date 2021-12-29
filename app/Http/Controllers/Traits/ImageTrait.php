<?php

namespace App\Http\Controllers\Traits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait ImageTrait {


	public function saveImage(Request $request, $nameParameter, $path = '/', $name = null){
		$finalName = $name ?: $nameParameter.'_'.date('Y_m_d_H_i_s');
		if ($request->hasFile($nameParameter) && $request->file($nameParameter)->isValid()) {
			$request->file($nameParameter)->storeAs($path,	$finalName );
		}

		return 	$finalName ;
	}


	public function removeImage($path = '/', $name){
		return unlink($path .$name);

	}
}
