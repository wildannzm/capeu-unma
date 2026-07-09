<?php

namespace App\Exports;

use App\Models\Registration;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

class RegistrationsExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected $search;
    protected $statusFilter;

    public function __construct($search = '', $statusFilter = '')
    {
        $this->search = $search;
        $this->statusFilter = $statusFilter;
    }

    public function collection()
    {
        return Registration::with(['user', 'payments'])
            ->when($this->search, function ($query) {
                $query->whereHas('user', function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                        ->orWhere('email', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->statusFilter, function ($query) {
                $query->where('status', $this->statusFilter);
            })
            ->latest()
            ->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Registration No',
            'Participant Type',
            'Name',
            'Email',
            'Status',
            'Payment Status',
            'Date Created',
            
            // Personal Info
            'Gender',
            'Phone',
            'Nationality',
            'DOB',
            'Passport ID',
            
            // Academic Info
            'University',
            'Major',
            'Year of Study',
            'GPA',
            'Country',
            'Student ID',
            
            // Participation
            'Motivation',
            'Relevant Experience',
            'Expectations',
            'Cultural Talent',
            'Video URL',
            
            // Health
            'Medical Conditions',
            'Allergies',
            'Dietary Preferences',
            'Emergency Contact Name',
            'Emergency Relationship',
            'Emergency Phone',
            
            // Transportation
            'Transportation Type',
        ];
    }

    public function map($reg): array
    {
        $personal = $reg->personal_info ?? [];
        $academic = $reg->academic_info ?? [];
        $participation = $reg->participation_details ?? [];
        $advanced = $reg->advanced_info ?? [];
        $health = $reg->health_emergency ?? [];
        $transport = $reg->transportation ?? [];

        // Parse relevant experience array into string
        $relevantExperience = isset($participation['relevant_experience']) && is_array($participation['relevant_experience']) 
            ? implode(', ', $participation['relevant_experience']) 
            : ($participation['relevant_experience'] ?? '');

        return [
            $reg->id,
            $reg->registration_number,
            $reg->participant_type,
            $reg->user->name ?? '',
            $reg->user->email ?? '',
            strtoupper($reg->status),
            strtoupper($reg->payments->first()->status ?? 'Unpaid'),
            $reg->created_at ? $reg->created_at->format('Y-m-d H:i:s') : '',
            
            // Personal Info
            $personal['gender'] ?? '',
            $personal['whatsapp'] ?? '',
            $personal['nationality'] ?? '',
            $personal['dob'] ?? '',
            $personal['passport_id'] ?? '',
            
            // Academic Info
            $academic['university_name'] ?? '',
            $academic['major'] ?? '',
            $academic['year_semester'] ?? '',
            $academic['gpa'] ?? '',
            $academic['country'] ?? '',
            $academic['student_id'] ?? '',
            
            // Participation
            $participation['motivation'] ?? '',
            $relevantExperience,
            $advanced['expectations'] ?? '',
            $advanced['cultural_talent'] ?? '',
            $advanced['video_url'] ?? '',
            
            // Health
            $health['medical_conditions'] ?? '',
            $health['allergies'] ?? '',
            $health['dietary_preference'] ?? '',
            $health['emergency_contact'] ?? '',
            $health['emergency_relationship'] ?? '',
            $health['emergency_phone'] ?? '',
            
            // Transportation
            $transport['type'] ?? '',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $lastColumn = $sheet->getHighestColumn();
        $lastRow = $sheet->getHighestRow();

        return [
            // Style the header row
            1 => [
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID, 
                    'startColor' => ['rgb' => '4F46E5'] // Indigo color
                ],
            ],
            // Add borders to all cells
            "A1:{$lastColumn}{$lastRow}" => [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['argb' => 'FFCCCCCC'],
                    ],
                ],
            ]
        ];
    }
}
