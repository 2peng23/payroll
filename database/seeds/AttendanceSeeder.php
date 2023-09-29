<?php

use App\{Attendance,Employee};
use Illuminate\Database\Seeder;

class AttendanceSeeder extends Seeder
{
    public function run()
    {
        $datas = [
            // employee 1 
            [
                'date' => "2023-01-01",
                'time_in' => "08:00:00",
                'time_out' => "17:00:00",
                'num_hour' => '8',
                'employee_id' => Employee::first()->id,
            ],
            [
                'date' => "2023-01-02",
                'time_in' => "08:00:00",
                'time_out' => "17:00:00",
                'num_hour' => '8',
                'employee_id' => Employee::first()->id,
            ],
            [
                'date' => "2023-01-03",
                'time_in' => "08:00:00",
                'time_out' => "17:00:00",
                'num_hour' => '8',
                'employee_id' => Employee::first()->id,
            ],
            [
                'date' => "2023-01-04",
                'time_in' => "08:00:00",
                'time_out' => "17:00:00",
                'num_hour' => '8',
                'employee_id' => Employee::first()->id,
            ],
            [
                'date' => "2023-01-05",
                'time_in' => "08:00:00",
                'time_out' => "17:00:00",
                'num_hour' => '8',
                'employee_id' => Employee::first()->id,
            ],
            [
                'date' => "2023-01-06",
                'time_in' => "08:00:00",
                'time_out' => "17:00:00",
                'num_hour' => '8',
                'employee_id' => Employee::first()->id,
            ],
            [
                'date' => "2023-01-07",
                'time_in' => "08:00:00",
                'time_out' => "17:00:00",
                'num_hour' => '8',
                'employee_id' => Employee::first()->id,
            ],
            [
                'date' => "2023-01-08",
                'time_in' => "08:00:00",
                'time_out' => "17:00:00",
                'num_hour' => '8',
                'employee_id' => Employee::first()->id,
            ],
            [
                'date' => "2023-01-09",
                'time_in' => "08:00:00",
                'time_out' => "17:00:00",
                'num_hour' => '8',
                'employee_id' => Employee::first()->id,
            ],
            [
                'date' => "2023-01-10",
                'time_in' => "08:00:00",
                'time_out' => "17:00:00",
                'num_hour' => '8',
                'employee_id' => Employee::first()->id,
            ],
            [
                'date' => "2023-01-11",
                'time_in' => "08:00:00",
                'time_out' => "17:00:00",
                'num_hour' => '8',
                'employee_id' => Employee::first()->id,
            ],
            [
                'date' => "2023-01-12",
                'time_in' => "08:00:00",
                'time_out' => "17:00:00",
                'num_hour' => '8',
                'employee_id' => Employee::first()->id,
            ],
            [
                'date' => "2023-01-13",
                'time_in' => "08:00:00",
                'time_out' => "17:00:00",
                'num_hour' => '8',
                'employee_id' => Employee::first()->id,
            ],
            [
                'date' => "2023-01-14",
                'time_in' => "08:00:00",
                'time_out' => "17:00:00",
                'num_hour' => '8',
                'employee_id' => Employee::first()->id,
            ],
            [
                'date' => "2023-01-15",
                'time_in' => "08:00:00",
                'time_out' => "17:00:00",
                'num_hour' => '8',
                'employee_id' => Employee::first()->id,
            ],
            [
                'date' => "2023-01-16",
                'time_in' => "08:00:00",
                'time_out' => "17:00:00",
                'num_hour' => '8',
                'employee_id' => Employee::first()->id,
            ],
            [
                'date' => "2023-01-17",
                'time_in' => "08:00:00",
                'time_out' => "17:00:00",
                'num_hour' => '8',
                'employee_id' => Employee::first()->id,
            ],
            [
                'date' => "2023-01-18",
                'time_in' => "08:00:00",
                'time_out' => "17:00:00",
                'num_hour' => '8',
                'employee_id' => Employee::first()->id,
            ],
            [
                'date' => "2023-01-19",
                'time_in' => "08:00:00",
                'time_out' => "17:00:00",
                'num_hour' => '8',
                'employee_id' => Employee::first()->id,
            ],
            [
                'date' => "2023-01-20",
                'time_in' => "08:00:00",
                'time_out' => "17:00:00",
                'num_hour' => '8',
                'employee_id' => Employee::first()->id,
            ],
            // end employee 1

            

        ];

        $count = 0;
        foreach ($datas as $key => $data) {
            // Attendance::create($data);
            $count++;
        }
        $this->command->info('Inserted '.$count.' Attendances.');
    }
}
