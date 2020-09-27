<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id'=>auth()->check()?auth()->id():null,
            'name'=> $name = $this->faker->company,
            'fantasy'=>$this->faker->name,
            'slug' => Str::slug($name),
            'email' => $this->faker->companyEmail,
            'document' => $this->faker->creditCardNumber(),
            'ie' => $this->faker->creditCardNumber(),
            'phone'=>$this->faker->phoneNumber,
            'site'=>$this->faker->url,
            'cover'=>$this->faker->imageUrl(),
            'status'=>['draft','published'][rand(0,1)],
            'description'=>$this->faker->paragraph
        ];
    }
}
