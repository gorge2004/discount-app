<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\helperController\DiscountHelper;
use Illuminate\Http\Request;

class DiscountApiController extends Controller
{
	protected $discountHelper;

	public function __construct(){
		$this->discountHelper = new DiscountHelper();
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $discounts = $this->discountHelper->getDiscountFilter($request->title, $request->code, $request->description, $request->start_at, $request->end_at, $request->length?: 10) ;

		return response()->json($discounts);
    }


}
