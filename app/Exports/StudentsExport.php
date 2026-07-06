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
            ->get()
            ->map(function ($student) {
                return [
                    'Name'             => $student->name,
                    'UID'              => $student->uid,
                    'Class'            => $student->class,
                    'Stream'           => $student->stream,
                    'Father Name'      => $student->father_name ?? '—',
                    'Address'          => $student->address ?? '—',
                    'Contact Number'   => $student->contact_number ?? '—',
                    'WhatsApp Number'  => $student->whatsapp_number ?? '—',
                    'Country'          => $student->country ?? '—',
                    'State'            => $student->state ?? '—',
                    'District'         => $student->district ?? '—',
                    'Constituency'     => $student->constituency ?? '—',
                    'Place'            => $student->place ?? '—',
                    'Date of Birth'    => $student->date_of_birth ? \Carbon\Carbon::parse($student->date_of_birth)->format('Y-m-d') : '—',
                    'Interested Areas' => !empty($student->interested_areas) ? implode(', ', $student->interested_areas) : '—',
                    'Photo'            => $student->photo ? asset('storage/' . $student->photo) : '—',
                    'Status'           => ucfirst($student->status),
                ];
            });
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
            'WhatsApp Number',
            'Country',
            'State',
            'District',
            'Constituency',
            'Place',
            'Date of Birth',
            'Interested Areas',
            'Photo URL',
            'Status',
        ];
    }
}
