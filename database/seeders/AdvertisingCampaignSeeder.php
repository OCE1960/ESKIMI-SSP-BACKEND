<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AdvertisingCampaign;

class AdvertisingCampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $advert = new AdvertisingCampaign;
        $advert->name = 'TECHNO Advert';
        $advert->from = '2021-11-10';
        $advert->to = '2021-11-11';
        $advert->total_budget = 2000;
        $advert->daily_budget = 200.50;
        $advert->save();

        $advert = new AdvertisingCampaign;
        $advert->name = 'IPhone 13 Campaign';
        $advert->from = '2021-11-12';
        $advert->to = '2021-11-14';
        $advert->total_budget = 2500;
        $advert->daily_budget = 500.50;
        $advert->save();

        $advert = new AdvertisingCampaign;
        $advert->name = 'SAMSUNG Campaign';
        $advert->from = '2021-11-14';
        $advert->to = '2021-11-20';
        $advert->total_budget = 25000;
        $advert->daily_budget = 1500.50;
        $advert->save();

        $advert = new AdvertisingCampaign;
        $advert->name = 'Election Campaign';
        $advert->from = '2021-11-02';
        $advert->to = '2021-11-20';
        $advert->total_budget = 30000;
        $advert->daily_budget = 3000.50;
        $advert->save();


    }
}
