<?php

namespace App\DataTables;

use App\Models\Order;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ordersDataTable extends DataTable
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
            ->addColumn('show', 'admin.orders.btn.show')
            ->rawColumns([
                'show'
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\order $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Order $model)
    {
        return Order::with(['resturant', 'client'])->select('orders.*');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('orders-table')
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
                'name' => 'id',
                'data' => 'id',
                'title' => 'id'
            ], [
                'name' => 'client.name',
                'data' => 'client.name',
                'title' => 'client'
            ],  [
                'name' => 'resturant.name',
                'data' => 'resturant.name',
                'title' => 'resturant'
            ],
            [
                'name' => 'total',
                'data' => 'total',
                'title' => 'total'
            ],
            [
                'name' => 'state',
                'data' => 'state',
                'title' => 'state'
            ],

            [
                'name' => 'show',
                'data' => 'show',
                'title' => 'show',
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
        return 'orders_' . date('YmdHis');
    }
}
