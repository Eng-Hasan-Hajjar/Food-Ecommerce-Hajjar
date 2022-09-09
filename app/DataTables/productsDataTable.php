<?php

namespace App\DataTables;

use App\Models\Product;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Services\DataTable;

class productsDataTable extends DataTable
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
            ->addColumn('delete', 'admin.products.btn.delete')
            ->rawColumns([
                'delete'
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param product $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(product $model)
    {
        return Product::with('resturant')->select('products.*');

    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('products-table')
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
                'name' => 'name',
                'data' => 'name',
                'title' => 'name'
            ], [
                'name' => 'description',
                'data' => 'description',
                'title' => 'description'
            ], [
                'name' => 'price',
                'data' => 'price',
                'title' => 'price'
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
        return 'products_' . date('YmdHis');
    }
}
