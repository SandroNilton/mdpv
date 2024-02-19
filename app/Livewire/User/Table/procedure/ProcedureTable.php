<?php

namespace App\Livewire\User\Table\procedure;

use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Columns\DateColumn;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Procedure;

class ProcedureTable extends DataTableComponent
{
    protected $model = Procedure::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Expediente", "id")
                ->sortable(),
            Column::make("Tipo de trámite", "type_procedure.name")
                ->sortable(),
            DateColumn::make('Última actividad', 'updated_at')
                ->outputFormat('d/m/Y H:i a')
                ->emptyValue('Not Found'),
        ];
    }

    public function builder(): Builder
    {
        return Procedure::query()->where('user_id', '=', auth()->id());
    }
}
