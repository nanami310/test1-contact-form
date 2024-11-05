<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'gender' => $this->faker->randomElement(['男性', '女性', 'その他']), 
            'email' => $this->faker->unique()->safeEmail,
            'tel' => $this->faker->numerify('0##########'), 
            'address' => $this->faker->address,
            'building' => $this->faker->word, 
            'content_type' => $this->faker->randomElement([
                '商品のお届けについて', 
                '商品の交換について', 
                '商品トラブル', 
                'ショップへのお問い合わせ', 
                'その他'
            ]), 
            'content' => $this->faker->text(120), 
        ];
    }
}