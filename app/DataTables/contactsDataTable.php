<?php

namespace App\DataTables;

use App\Models\Contact;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Services\DataTable;

class contactsDataTable extends DataTable
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
            ->addColumn('delete', 'admin.contacts.btn.delete')
            ->rawColumns([
                 'delete'
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param contact $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Contact $model)
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
            ->setTableId('contacts-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
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
                'name' => 'full_name',
                'data' => 'full_name',
                'title' => 'Full Name'
            ], [
                'name' => 'email',
                'data' => 'email',
                'title' => 'Email'
            ], [
                'name' => 'phone',
                'data' => 'phone',
                'title' => 'phone'
            ], [
                'name' => 'message',
                'data' => 'message',
                'title' => 'message'
            ], [
                'name' => 'type',
                'data' => 'type',
                'title' => 'type'
            ],

            [
                'name' => 'created_at',
                'data' => 'created_at',
                'title' => 'created_at'
            ],

            [
                'name' => 'delete',
                'data' => 'delete',
                'title' => 'Delete',
                'class' => 'text-center',
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
        return 'contacts_' . date('YmdHis');
    }
}
