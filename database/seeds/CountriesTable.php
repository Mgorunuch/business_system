<?php

use Illuminate\Database\Seeder;

class CountriesTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(!\Illuminate\Support\Facades\Schema::hasTable('countries')) {
            \Illuminate\Support\Facades\Schema::create('countries', function (\Illuminate\Database\Schema\Blueprint $table) {
                $table->string('code')->unique();
                $table->string('name');
            });
            echo "Table Created"."\n";
        } else {
            echo "Table Exist"."\n";
        };
        $path_to_xml = dirname(__FILE__).'/..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'tests'.DIRECTORY_SEPARATOR.'countries.xml';
        $path_to_txt = dirname(__FILE__).'/..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'tests'.DIRECTORY_SEPARATOR.'countries.txt';
        if(!file_exists($path_to_xml)) dd('File Not Found'."\n");
        $xml_string = file_get_contents($path_to_xml);
        $xml = simplexml_load_string($xml_string,'SimpleXMLElement');
        $json = json_encode($xml);
        $array = json_decode($json, true);


        foreach ($array['country'] as $country) {
            \Illuminate\Support\Facades\DB::table('countries')->insert(['code'=>$country['alpha3'],'name'=>$country['english']]);
            echo $country['english']."  added \n";
        }
    }
}
