<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Wallet;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class WalletFactory extends Factory
{
    protected $model = Wallet::class;

    public function definition()
    {
        return [
            'coins' => 20,
            'company_id' => fn () => Company::factory()->create()->id,
        ];
    }
}
