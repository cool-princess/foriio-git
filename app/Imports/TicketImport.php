<?php

namespace App\Imports;

use App\Models\Ticket;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithValidation;


class TicketImport implements
    ToCollection,
    WithStartRow,
    ShouldQueue,
    WithChunkReading,
    WithValidation
{

    use Queueable;

    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            Ticket::updateOrCreate([
                'order_number' => $row[0]
            ], [
                'order_number' => $row[0],
                'sex' => $row[26],
                'birthday' => date('Y-m-d H:i:s', strtotime($row[27])),
                'adult_ticket' => $row[51],
                'young_ticket' => $row[54],
                'location' => $row[29],
                'area' => $row[14],
                'ticketing_date' => date('Y-m-d H:i:s', strtotime($row[12])),
            ]);
        }
    }

    public function rules(): array
    {
        return [
            0  => 'required|numeric',
            26 => 'string',
            27 => 'string|date',
            51 => 'int',
            54 => 'int',
            29 => 'string',
            14 => 'string',
            12  => 'numeric|date'
        ];
    }
    
    public function customValidationAttributes()
    {
        return [
            0 => '予約番号',
            26 => '性別',
            27 => '生年月日',
            51 => '券種枚数１_3',
            54 => '券種枚数１_6',
            29 => '住所１',
            14 => '基本会場名',
            12  => '公演日'
        ];
    }

    public function chunkSize(): int
    {
        return 1000;
    }

    public function startRow(): int
    {
        return 2;
    }
}
