<?php

namespace App\Livewire\Admin\Table\area;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Columns\DateColumn;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Area;

class AreaTable extends DataTableComponent
{
    protected $model = Area::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Nombre", "name")
                ->sortable()
                ->searchable(),
            Column::make("Status", "state")
                ->sortable(),
            DateColumn::make('Última actividad', 'updated_at')
                ->outputFormat('d/m/Y H:i a')
                ->emptyValue('Not Found'),
            Column::make("Acción", "id")
                ->format(fn($value, $row, Column $column) => view('admin.areas.actions')->withRow($row)->withValue($value)),
        ];
    }
}
