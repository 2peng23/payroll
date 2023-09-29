<?php

use App\Deduction;
use Illuminate\Database\Seeder;

class DeductionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
    		[
    			'name' => "SSS",
    			'amount' => 300.00,
    			'description' => "lorem 1",
    		],
    		[
    			'name' => "Pag-ibig",
    			'amount' => 100.00,
    			'description' => "lorem 2 ",
    		],
			[
    			'name' => "Philhealth",
    			'amount' => 100.00,
    			'description' => "lorem 2 ",
    		],
    	];

    	$count = 0;
    	foreach ($datas as $key => $data) {
    		Deduction::create($data);
    		$count++;
    	}
    	$this->command->info('Inserted '.$count.' Deductions.');
    }
}
