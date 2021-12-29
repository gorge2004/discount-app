<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;

class DiscountFactory extends Factory
{
	/**
	 * Define the model's default state.
	 *
	 * @return array
	 */
	public function definition()
	{
		$code = rand(0, 1) ? $this->faker->Uuid() :'';
		$start_at =  $this->faker->dateTimeBetween('0days', '2 years');
		$end_at =  (new Carbon($start_at))->addMonths(12);
		$filePath = storage_path('app/public/discount');

        if(! File::exists($filePath)){
            File::makeDirectory($filePath);
        }
		return [
			'title' => $this->faker->sentence(),
			'code' => $code,
			'description' => $this->faker->sentence(),
			'start_at' => $start_at,
			'end_at' => $end_at,
			'main_image' => $this->faker->image($filePath, 640,480, null, false)
		];
	}
}
