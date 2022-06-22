<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::select('user_id', 'pwd_store', 'company_name', 'furi_company_name', 'department_name', 'job_title', 'name', 'furi_name', 'email', 'phone', 'zipcode', 'address1', 'address2', 'address3', 'address4', 'sectors', 'break')->get();
    }

    public function headings(): array
    {
        return [
            '会員ID',
            'パスワード',
            '会員企業/団体名',
            '会員企業/団体名（フリガナ）',
            '部署名',
            '役職',
            '氏名',
            '氏名フリガナ',
            'メールアドレス', 
            '電話番号',
            '郵便番号',
            '住所1',
            '住所2/市町村',
            '住所3',
            '住所4/建物名や階数',
            '業種',
            '稼働'
        ];
    }
}
