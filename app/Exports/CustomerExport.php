<?php

namespace App\Exports;

use App\Customer;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use DB;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CustomerExport implements FromCollection ,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
      $customers=DB::table('customers')->select('id','name','mobile','email','company','address','start_balance','status')->get();
        return $customers;
    }
     public function headings(): array
    {
        return [
            '#',
            'Name',
            'Mobile',
            'Email',
            'company',
            'address',
            'start_balance',
            'status',  
        ];
    }
}
