<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\FromQuery;

class UsersExport implements FromQuery, WithMapping, FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {	
    	 return User::orderBy('id', 'desc')->where('role','user')->take(20)->get();
    }

    public function map($users): array
    {
        return [
            $users->name,
            $users->email,
            $users->faculty->name
        ];
    }
}
