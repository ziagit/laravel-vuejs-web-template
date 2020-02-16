<?php

use Illuminate\Database\Seeder;
use App\Year;
class YearsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $years = [
            "2009-01-1",
            "2010-01-1",
            "2011-01-1",
            "2012-01-1",
            "2013-01-1",
            "2014-01-1",
            "2015-01-1",
            "2016-01-1",
            "2017-01-1",
            "2018-01-1",
            "2019-01-1",
            "2020-01-1",
        ];
        foreach($years as $year){
            $year_tech = new Year();
            $year_tech->date = $year;
            $year_tech->save();
        }
    }
}
