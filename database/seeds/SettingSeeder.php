<?php

use Illuminate\Database\Seeder;
use \App\Setting;
class SettingSeeder extends Seeder
{ 
    public function run()
    {
        
     
        Setting::create(['name'=>'time_in', 'value'=>'8:15:00']);
        Setting::create(['name'=>'time_out','value'=>'15:01:00']);
      
    }
}
