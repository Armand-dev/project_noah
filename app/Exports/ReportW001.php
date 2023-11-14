<?php

namespace App\Exports;

use App\Models\Timesheet;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ReportW001 implements FromQuery, ShouldQueue, WithHeadings, ShouldAutoSize, WithStyles
{
    use Exportable;

    public array $params;

    public function __construct(array $params)
    {
        $this->params = $params;
    }

    public function query()
    {
        return Timesheet::query()
            ->join('projects', 'projects.id', '=', 'timesheets.project_id')
            ->join('clients', 'clients.id', '=', 'projects.client_id')
            ->join('users', 'users.id', '=', 'timesheets.user_id')
            ->whereHas('user', function (Builder $query){
                $query->whereIn('id', $this->params['users']);
            })
            ->whereHas('project', function (Builder $query){
                $query->whereIn('id', $this->params['projects']);
            })
            ->whereBetween('timesheets.day', [Carbon::parse($this->params['startDate'])->startOfDay(),Carbon::parse($this->params['endDate'])->endOfDay() ])
            ->select([
                'clients.name AS client_name',
                'projects.name AS project_name',
                'users.name AS user_name',
                'day',
                'hours',
            ])
            ->orderBy('client_name', 'ASC')
            ->orderBy('project_name', 'ASC');
    }

    public function headings(): array
    {
        return [
            'Client',
            'Project',
            'Human resource',
            'Day',
            'Hours',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row
            1 => [
                'font' => ['bold' => true],
                'fill' => [
                    'fillType'   => Fill::FILL_SOLID,
                    'startColor' => ['argb' => '#eeeeee'],
                ],
            ],
        ];
    }
}
