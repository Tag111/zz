<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Model\Country;

class UpdateCountryFlags extends Command
{
    protected $signature = 'countries:update-flags';
    protected $description = 'Update African country flags URLs';

    private $africanCountries = [
        'Benin' => 'bj',
        'Burkina Faso' => 'bf',
        'Cameroon' => 'cm',
        'Congo' => 'cg',
        'Ivory Coast' => 'ci',
        'Ghana' => 'gh',
        'Guinea' => 'gn',
        'Mali' => 'ml',
        'Niger' => 'ne',
        'Nigeria' => 'ng',
        'Senegal' => 'sn',
        'Togo' => 'tg'
    ];

    public function handle()
    {
        foreach ($this->africanCountries as $countryName => $isoCode) {
            Country::updateOrCreate(
                ['name' => $countryName],
                ['flag' => "https://raw.githubusercontent.com/hampusborgos/country-flags/main/png250px/{$isoCode}.png"]
            );
        }
        $this->info('African countries and flags updated successfully');
    }
}