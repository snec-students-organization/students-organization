<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AllStudentsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Student::with('institution')
            ->get()
            ->map(function ($student) {
                return [
                    'Institution'   => $student->institution->name ?? '—',
                    'Name'          => $student->name,
                    'UID'           => $student->uid,
                    'Class'         => $student->class,
                    'Stream'        => $student->stream,
                    'Father Name'   => $student->father_name,
                    'Address'       => $student->address,
                    'Contact Number'=> $student->contact_number,
                    'Status'        => $student->status,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Institution',
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
