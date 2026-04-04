<?php

namespace App\Exports;

use App\Models\AdmissionData;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AdmissionDataExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return AdmissionData::latest()->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Student Name',
            'UID No',
            'College Name',
            'Contact Number',
            'Application Number',
            'Reward Amount',
            'GPay Number',
            'Status',
            'Submitted At',
        ];
    }

    public function map($admission): array
    {
        return [
            $admission->id,
            $admission->student_name,
            $admission->uid_no,
            $admission->college_name,
            $admission->contact_number,
            $admission->application_number,
            $admission->scratch_card_amount ? '₹' . $admission->scratch_card_amount : '0',
            $admission->gpay_number ?? 'N/A',
            $admission->is_scratched ? 'Scratched' : 'Pending',
            $admission->created_at->format('d M Y, h:i A'),
        ];
    }
}
