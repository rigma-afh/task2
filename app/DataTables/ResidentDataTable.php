<?php

namespace App\DataTables;

use App\Models\Resident;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ResidentDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder<Resident> $query Results from query() method.
     */
public function dataTable(QueryBuilder $query): EloquentDataTable
{
    return (new EloquentDataTable($query))
        ->addColumn('action', function($row) {
            $id = $row->id;
            $status = $row->status ?? '';

            $viewSvg = <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#0d6efd" viewBox="0 0 16 16">
    <path d="M8 1a7 7 0 1 1 0 14A7 7 0 0 1 8 1zm0 1.5a5.5 5.5 0 1 0 0 11A5.5 5.5 0 0 0 8 2.5z" />
    <path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 .933-.252 1.105-.598l.088-.416c-.2.176-.488.252-.686.252-.294 0-.396-.176-.33-.48l.738-3.468c.194-.897-.105-1.319-.808-1.319zm-.93-2.588a.9.9 0 1 0 0 1.8.9.9 0 0 0 0-1.8z" />
</svg>
SVG;

            $editSvg = <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="blue" stroke-width="2"
    stroke-linecap="round" stroke-linejoin="round" class="me-1" viewBox="0 0 24 24">
    <path d="M12 20h9" />
    <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z" />
</svg>
SVG;

            $deleteSvg = <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="red" stroke-width="2"
    stroke-linecap="round" stroke-linejoin="round" class="me-1" viewBox="0 0 24 24">
    <polyline points="3 6 5 6 21 6" />
    <path d="M19 6l-.867 12.142A2 2 0 0 1 16.138 20H7.862a2 2 0 0 1-1.995-1.858L5 6m5 0V4
              a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2" />
    <line x1="10" y1="11" x2="10" y2="17" />
    <line x1="14" y1="11" x2="14" y2="17" />
</svg>
SVG;

            $toggleStatusChecked = ($status === 'Active') ? 'checked' : '';

            $buttons = '<div class="btn-group" role="group" aria-label="Resident Actions">';

            $buttons .= '<a href="' . route('residents.show', $id) . '" class="btn btn-sm" title="View Info">' . $viewSvg . '</a>';

            $buttons .= '<a href="' . route('residents.edit', $id) . '" class="btn btn-sm" title="Edit Resident">' . $editSvg . '</a>';

$buttons .= '
    <form action="' . route('residents.destroy', $id) . '" method="POST" name="dlt-form" style="display:inline;">
        ' . csrf_field() . method_field('DELETE') . '
        <button type="submit" class="btn btn-sm btn-danger btn-delete" title="Delete Resident">
            <i class="fas fa-trash-alt"></i>
        </button>
    </form>
';


//             // Use your exact provided toggle status form here:
//           $buttons .= '
//     <form action="' . route('residents.toggleStatus', $id) . '" method="POST" style="display:inline;">
//         ' . csrf_field() . '
//         <button type="submit" class="btn btn-sm btn-primary" title="Toggle Status">
//             <i class="fas fa-toggle-on me-1"></i>
//         </button>
//     </form>
// ';


$statusChecked = $row->status === 'active' ? 'checked' : '';

$buttons .= '
    <form action="' . route('residents.toggleStatus', $row->id) . '" method="POST" class="m-0" title="Toggle Status">
        ' . csrf_field() . '
        <div class="form-check form-switch d-flex align-items-center m-0">
            <input
                class="form-check-input"
                type="checkbox"
                name="status_toggle"
                onchange="this.form.submit()"
                ' . $statusChecked . '
                title="Toggle Status">
        </div>
    </form>
';


            $buttons .= '</div>';

            return $buttons;
        })
        ->rawColumns(['action'])
        ->setRowId('id');
}




    /**
     * Get the query source of dataTable.
     *
     * @return QueryBuilder<Resident>
     */
    public function query(Resident $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    // public function html(): HtmlBuilder
    // {
    //     return $this->builder()
    //                 ->setTableId('residents-table')
    //                 ->columns($this->getColumns())
    //                 ->minifiedAjax()
    //                 ->orderBy(1)
    //                 ->selectStyleSingle()
    //                 ->buttons([
    //                     Button::make('excel'),
    //                     Button::make('csv'),
    //                     Button::make('pdf'),
    //                     Button::make('print'),
    //                     Button::make('reset'),
    //                     Button::make('reload'), Button::raw([
    //             'text' => '<i class="fa fa-plus"></i> Add Resident',
    //             'className' => 'btn btn-success',
    //             'action' => 'function() {
    //                 window.location.href = "' . route('residents.index') . '";
    //             }',]),





    //                 ]);
    // }


public function html()
{
    return $this->builder()
        ->setTableId('residents-table')
        ->columns($this->getColumns())
        ->minifiedAjax()
        ->parameters([
            'dom' => 'lBfrtip', // layout options
            'language' => [
                'search' => '🔍 Search Residents:',
                // 'lengthMenu' => 'Show _MENU_ residents per page',
                'info' => 'Showing _START_ to _END_ of _TOTAL_ residents',
                'paginate' => [
                    'first' => 'First',
                    'last' => 'Last',
                    'next' => '→',
                    'previous' => '←',
                ],
                'emptyTable' => 'No residents found.',
            ],
            'lengthMenu' => [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        ]);
}






    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [

            Column::make('id'),
            Column::make('name'),
            Column::make('email'),
            Column::make('address'),
            Column::make('phone'),
            Column::make('gender'),
   //         Column::make('created_at'),
    //        Column::make('updated_at'),
                        Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Resident_' . date('YmdHis');
    }
}
