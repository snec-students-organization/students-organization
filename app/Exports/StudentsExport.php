<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentsExport implements FromCollection, WithHeadings
{
    protected $institutionId;

    public function __construct($institutionId)
    {
        $this->institutionId = $institutionId;
    }

    public function collection()
    {
        return Student::where('institution_id', $this->institutionId)
            ->select('name', 'uid', 'class', 'stream', 'father_name', 'address', 'contact_number', 'status')
            ->get();
    }

    public function headings(): array
    {
        return [
            'Name',
            'UID',
            'Class',
            'Stream',
            'Father Name',
            'Address',
            'Contact Number',
            'Status',
        ];
    }
}
