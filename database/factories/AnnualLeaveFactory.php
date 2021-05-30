<?php

namespace Database\Factories;

use App\Models\AnnualLeave;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnnualLeaveFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AnnualLeave::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        static $number = 2021;

        return [
            //
            'annual_leave_year' => $number++
        ];
    }
}
