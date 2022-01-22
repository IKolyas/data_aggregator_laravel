<?php

namespace Database\Factories;

use App\Models\ActualUser;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ActualUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ActualUser::class;


    /**
     * Define the model's default state.
     *
     * @return array
     * @throws \Exception
     */
    public function definition()
    {
        $phone = '';
        for($i = 0; $i < 10; $i++) {
            $phone .= rand(0, 9);
        }
        $referral_id = $this->getReferGenerate($phone);
        return [
            'firstname' => $this->faker->firstName,
            'lastname' => $this->faker->lastName,
            'email' => $this->faker->email,
            'phone' => $phone,
            'referral_id' => $referral_id,
            'inviting_id' => null,
        ];
    }

    public function getReferGenerate($phone): string
    {
        $ciphers = 'ABCDEFGHIJK';
        $phoneSplit = str_split(preg_replace('![^0-9]+!', '', $phone));
        $referral = '';
        foreach ($phoneSplit as $element) {
            $referral .= $ciphers[(int)$element];
        }
        return $referral;
    }
}
