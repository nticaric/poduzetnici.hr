<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->company();

        return [
            'name' => $name,
            'type' => fake()->randomElement(['company', 'craft']),
            'oib' => fake()->unique()->numerify('###########'),
            'phone' => fake()->phoneNumber(),
            'description' => fake()->optional()->paragraph(),
            'address' => fake()->address(),
            'web' => fake()->optional()->url(),
            'industry' => fake()->randomElement([
                'IT usluge',
                'Trgovina',
                'Proizvodnja',
                'Ugostiteljstvo',
                'Građevinarstvo',
                'Financije',
                'Marketing',
                'Konzalting',
            ]),
            'slug' => Str::slug($name).'-'.fake()->unique()->randomNumber(4),
            'is_public' => fake()->boolean(70),
            'avatar' => null,
        ];
    }

    /**
     * Indicate that the company is a d.o.o.
     */
    public function company(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'company',
        ]);
    }

    /**
     * Indicate that the company is a craft/obrt.
     */
    public function craft(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'craft',
        ]);
    }

    /**
     * Indicate that the company is public.
     */
    public function public(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_public' => true,
        ]);
    }

    /**
     * Indicate that the company is private.
     */
    public function private(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_public' => false,
        ]);
    }
}
