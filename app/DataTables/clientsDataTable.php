<?php

namespace App\DataTables;

use App\Models\Client;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Services\DataTable;

class clientsDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('delete', 'admin.clients.btn.delete')
            ->addColumn('status', 'admin.clients.btn.status')
            ->rawColumns([
               'delete', 'status'
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param client $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Client $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('clients-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->parameters([
                'dom' => 'Blfrtip',
                'lengthMenu' => [[10, 25, 100, -1], [10, 25, 100, 'All record']],
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            [
                'name' => 'id',
                'data' => 'id',
                'title' => 'ID'
            ],
            [
                'name' => 'name',
                'data' => 'name',
                'title' => 'Name'
            ],

            [
                'name' => 'email',
                'data' => 'email',
                'title' => 'Email'
            ], [
                'name' => 'phone',
                'data' => 'phone',
                'title' => 'phone'
            ],
            [
                'name' => 'status',
                'data' => 'status',
                'title' => 'status',
                'searchable' => false,
                'orderable' => false,
                'exportable' => false
            ],
            [
                'name' => 'delete',
                'data' => 'delete',
                'title' => 'Delete',
                'searchable' => false,
                'orderable' => false,
                'exportable' => false
            ]
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'clients_' . date('YmdHis');
    }
}
