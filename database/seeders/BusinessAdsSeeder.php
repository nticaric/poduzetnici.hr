<?php

namespace Database\Seeders;

use App\Enums\AdStatus;
use App\Models\Ad;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BusinessAdsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define some realistic company types/titles
        $companies = [
            'Etar' => ['IT tvrtka sa stabilnim prihodima', 'Agencija za digitalni marketing', 'SaaS platforma za B2B'],
            'Proizvodnja' => ['Uhoda stolarska radiona', 'Tvornica metalnih konstrukcija', 'Proizvodnja craft piva'],
            'Turizam' => ['Pansion na moru s restoranom', 'Boutique hotel u centru', 'Putnička agencija specijalizirana za aziju'],
            'Usluge' => ['Frizerski salon na frekventnoj lokaciji', 'Automehaničarska radiona sa stalnim klijentima', 'Privatni dječji vrtić'],
            'Trgovina' => ['Webshop s dječjom opremom', 'Lokalna trgovina mješovitom robom', 'Veleprodaja uredskog materijala'],
        ];

        // Ensure we have some users to attach to, or let factory create them.
        // Let's create a few specific users for these ads to make them look real.
        $users = User::factory(5)->create();

        $count = 0;
        foreach ($companies as $sector => $titles) {
            foreach ($titles as $title) {
                if ($count >= 10) {
                    break;
                }

                $revenue = rand(50000, 2000000);
                $profit = (int) ($revenue * rand(10, 30) / 100);

                Ad::factory()->create([
                    'user_id' => $users->random()->id,
                    'title' => $title,
                    'category' => 'Prodaja poslovanja',
                    'type' => 'offer',
                    'description' => 'Prodaje se '.strtolower($title).". Poslovanje je stabilno s dugogodišnjom tradicijom. Svi papiri uredni. U cijenu uključena kompletna oprema i baza klijenata.\n\n".fake()->paragraphs(2, true),
                    'price' => $profit * rand(3, 7), // 3-7x yearly profit valuation
                    'location' => fake()->city(),
                    'images' => [
                        'https://placehold.co/800x600/e2e8f0/1e293b.png?text='.urlencode($title),
                        'https://placehold.co/800x600/e2e8f0/1e293b.png?text=Interijer',
                        'https://placehold.co/800x600/e2e8f0/1e293b.png?text=Oprema',
                    ],
                    'annual_revenue' => $revenue,
                    'net_profit' => $profit,
                    'established_year' => rand(1995, 2020),
                    'employee_count' => rand(1, 20),
                    'includes_real_estate' => rand(0, 1),
                    'website' => rand(0, 1) ? 'https://www.'.Str::slug($title).'.com' : null,
                    'status' => AdStatus::Approved,
                    'created_at' => now()->subDays(rand(1, 15)),
                ]);

                $count++;
            }
        }
    }
}
