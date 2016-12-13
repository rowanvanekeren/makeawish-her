<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WishTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $wishes = array(
            array(
                'name'=>'rowan van ekeren',
                'wish' => 'ik wil vrede op aarde',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                ),
            array(
                'name'=>'Lander Verschueren',
                'wish' => 'ik wil zieke nieuwe nike schoenen weetje',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                ),
            array(
                'name'=>'Pietje Puk',
                'wish' => 'ik wil dat mijn oma weer zin in het leven heeft',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                ),
            array(
                'name'=>'Hans Anders',
                'wish' => 'ik wil een nieuwe bril',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                ),
            array(
                'name'=>'Eden Hazaad',
                'wish' => 'mijn grootste droom is om profvoetballer te worden',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                ),
            array(
                'name'=>'Uvuvuvavuvu Oesassusa Hoesas',
                'wish' => 'derp ferp merp serp lerp king rapper im master sjakko asdfsdf adsfasd sadf asdf  sadf sdfsadf sadf asdf asdf',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                ),
            array(
                'name'=>'Pranker',
                'wish' => 'blaaa blaa blbalabdlfkasbdfljasbdfas bla bal im master sjakko asdfsdf adsfasd sadf asdf  sadf sdfsadf sadf asdf asdf',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                ),
            array(
                'name'=>'hoi',
                'wish' => 'doei',
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
                ),

        );


        foreach ($wishes as $wish) {

            DB::table('wish')->insert($wish);
        }
    }
}
