<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (Country::getCount()) return;
        $countries = file_get_contents(database_path() . '/seeders/src/countries.json');
        $countries = json_decode($countries, true);

        try {
            DB::beginTransaction();
            foreach ($countries as $c) {
                $country = new Country();
                foreach ($c as $key => $value) {
                    $country->$key = $value;
                }
                $country->save();
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }
}
