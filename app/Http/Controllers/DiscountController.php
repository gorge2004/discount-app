<?php

namespace App\Http\Controllers;

use App\Http\Controllers\helperController\DiscountHelper;
use App\Http\Controllers\Traits\ImageTrait;
use App\Http\Requests\DiscountCreateRequest;
use App\Http\Requests\DiscountUpdateRequest;
use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
	use ImageTrait;
	protected $discountHelper;
	public function __construct(){
		$this->discountHelper = new DiscountHelper();
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discounts = $this->discountHelper->getDiscountFilterByLimit(10) ;

		return view('discount.index', compact('discounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		return view('discount.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DiscountCreateRequest $request)
    {
		$nameImage = $this->saveImage($request, 'main_image', 'public/discount');
		$discount_array = $request->all();
		$discount_array['main_image'] = $nameImage;

		$this->discountHelper->createDiscount( $discount_array);

		return redirect()->route('discount.index')->with('success', 'Discount was created succesfully!.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function show(Discount $discount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function edit(Discount $discount)
    {
        return view('discount.edit', compact('discount'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function update(DiscountUpdateRequest $request, Discount $discount)
    {	$nameImage = null;
		if ($request->has('main_image') ) {
			if ($discount->main_image) {
				$nameImage = $this->removeImage(storage_path('app/public/discount/'), $discount->main_image);
			}
			$nameImage = $this->saveImage($request, 'main_image','public/discount');

		}
		$discount_array = $request->all();
		if ($nameImage) {

			$discount_array['main_image'] = $nameImage;
		}
		$this->discountHelper->udpateDiscount($discount, $discount_array);
		return redirect()->route('discount.index')->with('success', 'Discount was created succesfully!.');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function destroy(Discount $discount)
    {
        //
    }
}
