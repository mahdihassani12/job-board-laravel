<?php

namespace App\Imports;

use DB;
use App\User;
use App\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;

class UsersImport implements ToCollection, WithHeadingRow
{
	public function  __construct($faculty_id, $department_id, $season)
    {
       $this->faculty_id= $faculty_id;
       $this->department_id= $department_id;
       $this->season= $season;
    }

	public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            $user = User::create([
                'name'      => $row['firstname'],
                'email'     => $row['email'],
                'role'      => "user",
                'status'     => "publish",
                $pass        = 'hu-'.Str::random(10),
                'primary_password' => $pass,
                'password'  => bcrypt($pass)
            ]);

            Student::create([
            	'user_id'   => $user->id,
                'firstName' => $row['firstname'],
                'lastName'  => $row['lastname'],
                'email'     => $row['email'],
                'phone'     => "+93".$row['phone'],
                'uni_enrolled_year' => 
                    \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['uni_enrolled_year'])
                                                                                ->format('Y-m-d'),
                'uni_graduation_year' => 
                        \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['uni_graduation_year'])
                                                                                ->format('Y-m-d'),
                'faculty_id' => $this->faculty_id,
                'department_id' => $this->department_id,
                'season'    => $this->season,
            ]);

            $details  = [
                'email' => $row['email'],
                'password' => $pass
            ];
            
            \Mail::to($row['email'])->send(new \App\Mail\mailStudents($details ));
        }

    }

}
