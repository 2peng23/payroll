<?php

use App\Employee;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
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
    			'first_name' => "Test",
    			'last_name' => "Test1",
    			'phone' => "9843-984-321",
    			'email' => "test@test.com",
    			'address' => "Address 1",
    			'gender' => "Male",
    			'position_id' => "3",
    			'schedule_id' => "2",
    			'rate_per_hour' => "100.00",
    			'salary' => "30000.00",
                'birthdate' => "April 10, 1990",
    			'is_active' => 1,
    		],
    		 
    	];

    	$count = 0;
    	foreach ($datas as $key => $data) {
    		Employee::create($data);
    		$count++;
    	}
    	$this->command->info('Inserted '.$count.' Employees.');
    }
}
