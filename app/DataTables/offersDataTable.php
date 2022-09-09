<?php

namespace App\DataTables;

use App\Models\Offer;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class offersDataTable extends DataTable
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
     * @param offer $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Offer $model)
    {
        return Offer::with('resturant')->select('offers.*');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('offers-table')
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
                'name' => 'description',
                'data' => 'description',
                'title' => 'description'
            ], [
                'name' => 'from',
                'data' => 'from',
                'title' => 'from'
            ], [
                'name' => 'to',
                'data' => 'to',
                'title' => 'to'
            ], [
                'name' => 'resturant.name',
                'data' => 'resturant.name',
                'title' => 'resturant'
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
        return 'offers_' . date('YmdHis');
    }
}
