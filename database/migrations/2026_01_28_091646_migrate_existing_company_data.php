<?php

use App\Enums\CompanyRole;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $companyUsers = DB::table('users')
            ->where('account_type', 'company')
            ->whereNotNull('company_name')
            ->whereNotNull('oib')
            ->get();

        foreach ($companyUsers as $user) {
            $companyId = DB::table('companies')->insertGetId([
                'name' => $user->company_name,
                'type' => $user->company_type,
                'oib' => $user->oib,
                'phone' => $user->phone,
                'description' => $user->description,
                'address' => $user->address,
                'web' => $user->web,
                'industry' => $user->industry,
                'slug' => $user->slug,
                'is_public' => $user->is_public,
                'avatar' => $user->avatar,
                'created_at' => $user->created_at,
                'updated_at' => now(),
            ]);

            DB::table('company_user')->insert([
                'company_id' => $companyId,
                'user_id' => $user->id,
                'role' => CompanyRole::Owner->value,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            DB::table('users')
                ->where('id', $user->id)
                ->update([
                    'current_company_id' => $companyId,
                    'slug' => null,
                ]);

            DB::table('ads')
                ->where('user_id', $user->id)
                ->update(['company_id' => $companyId]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $companyUsers = DB::table('company_user')
            ->where('role', CompanyRole::Owner->value)
            ->get();

        foreach ($companyUsers as $pivot) {
            $company = DB::table('companies')->where('id', $pivot->company_id)->first();

            if ($company) {
                DB::table('users')
                    ->where('id', $pivot->user_id)
                    ->update([
                        'slug' => $company->slug,
                        'current_company_id' => null,
                    ]);

                DB::table('ads')
                    ->where('company_id', $company->id)
                    ->update(['company_id' => null]);
            }
        }

        DB::table('company_user')->truncate();
        DB::table('companies')->truncate();
    }
};
