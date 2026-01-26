<?php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SpecificEntrepreneursSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // TNT Studio
        User::updateOrCreate(
            ['email' => 'info@tntstudio.hr'],
            [
                'firstname'         => 'Nenad', // Guessing contact person from footer
                'lastname'          => 'Tičarić',
                'password'          => Hash::make('password'),
                'role'              => 'user',
                'account_type'      => 'company',
                'company_name'      => 'TNT Studio d.o.o.',
                'industry'          => 'IT / Programiranje',
                'oib'               => '32314900695', // Real OIB from footer
                'phone'             => '+385 1 7776 915',
                'web'               => 'https://tnt.studio/',
                'address'           => 'Sv. Mateja 19, 10010 Zagreb',
                'slug'              => 'tnt-studio',
                'is_public'         => true,
                'email_verified_at' => now(),
                'description'       => "We develop custom web and mobile applications which help our clients automate their businesses and focus on their core competences. Tailor-made web applications based on Laravel, PHP, VueJs, React and other modern technologies.",
            ]
        );

        // BeDev
        User::updateOrCreate(
            ['email' => 'info@bedev.hr'],
            [
                'firstname'         => 'BeDev',
                'lastname'          => 'Info',
                'password'          => Hash::make('password'),
                'role'              => 'user',
                'account_type'      => 'company',
                'company_name'      => 'BeDev',
                'industry'          => 'IT / Programiranje',
                'oib'               => '12345678901', // Fake OIB as it wasn't strictly found
                'phone'             => '+385 98 557 105',
                'web'               => 'https://bedev.hr/',
                'address'           => 'Avenija Dubrovnik 15/12, Zagreb',
                'slug'              => 'bedev',
                'is_public'         => true,
                'email_verified_at' => now(),
                'description'       => "Web apps development and cutting-edge software solutions. We offer a whole set of custom web applications, business web sites programs, web pages and software solutions created according to your requirements, needs and desires.",
            ]
        );

        // QED Code
        User::updateOrCreate(
            ['email' => 'info@qedcode.io'],
            [
                'firstname'         => 'QED',
                'lastname'          => 'Code',
                'password'          => Hash::make('password'),
                'role'              => 'user',
                'account_type'      => 'company',
                'company_name'      => 'QED Ltd.',
                'industry'          => 'IT / Programiranje',
                'oib'               => '98765432109',     // Placeholder
                'phone'             => '+385 1 2345 678', // Placeholder, not found on homepage
                'web'               => 'https://www.qedcode.io/',
                'address'           => 'Zagreb, Hrvatska',
                'slug'              => 'qed-code',
                'is_public'         => true,
                'email_verified_at' => now(),
                'description'       => "Our goal is help you create your own digital world. This means pristine and elegant solutions, flawless code and client-centered processes. From web development and mobile apps to data science and project planning.",
            ]
        );
    }
}
