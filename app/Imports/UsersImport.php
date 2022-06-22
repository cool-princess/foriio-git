<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithStartRow;

class UsersImport implements ToModel, WithValidation, WithStartRow
{
    use Importable;
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $user_id = DB::table('users')->select('user_id')->get();
        $custom_id = "GD9".str_pad(rand(0, pow(10, 4)-1), 4, '0', STR_PAD_LEFT);
        loop:
        foreach ($user_id as $value) {
            if($value->user_id == $custom_id) {
                $custom_id = "GD9".str_pad(rand(0, pow(10, 4)-1), 4, '0', STR_PAD_LEFT);
                goto loop;
            }
        }
        $password = substr(md5(mt_rand()), 0, 8);
        return new User([
            'user_id'     => $custom_id,
            'password'     => bcrypt($password),
            'company_name'     => $row[0],
            'furi_company_name'     => $row[1],
            'department_name'     => $row[2],
            'job_title'     => $row[3],
            'name'     => $row[4],
            'furi_name'     => $row[5],
            'email'    => $row[6], 
            'phone'     => $row[7],
            'zipcode'     => $row[8],
            'address1'     => $row[9],
            'address2'     => $row[10],
            'address3'     => $row[11],
            'address4'     => $row[12],
            'sectors'     => $row[13],
            'break' => $row[14],
            'pwd_store' => $password
        ]);
    }

    public function rules(): array
    {
        return [
            'email' => 'email',
            'company_name'     => 'string',
            'furi_company_name'     => 'string',
            'department_name'     => 'string',
            'job_title'     => 'string',
            'name'     => 'string',
            'furi_name'     => 'string',
            'address1'     => 'string',
            'address2'     => 'string',
            'address3'     => 'string',
            'address4'     => 'string',
            'sectors'     => 'string',
            'break'     => 'string',
        ];
    }

    public function customValidationAttributes()
    {
        return [
            'email'         => 'メール',
        ];
    } 

    public function customValidationMessages()
    {
        return [
            'email.email' => 'メール形式にエラーがあります。',
        ];
    }
  
    public function startRow(): int
    {
        return 2;
    }
    
    public function getErrors()
    {
        return $this->errors;
    }
}
