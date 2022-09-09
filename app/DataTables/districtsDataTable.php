<?php

namespace App\DataTables;

use App\Models\District;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Services\DataTable;

class districtsDataTable extends DataTable
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
            ->addColumn('edit', 'admin.districts.btn.edit')
            ->addColumn('delete', 'admin.districts.btn.delete')
            ->addColumn('city', function (District $district) {
                return $district->city->name;
            })
            ->editColumn('created_at', function (District $district) {
                return $district->created_at->diffForHumans();
            })->rawColumns([
                'edit','delete'
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\District $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(District $model)
    {
        return District::with('city')->select('districts.*');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('districts-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->parameters([
                'dom' => 'Blfrtip',
                'lengthMenu' => [[10, 25, 100, -1], [10, 25, 100, 'All record']],
            ])->language(['ar','en']);
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
                'name' => 'city.name',
                'data' => 'city',
                'title' => 'City Name'
            ],
            [
                'name' => 'created_at',
                'data' => 'created_at',
                'title' => 'created_at'
            ],

            [
                'name' => 'edit',
                'data' => 'edit',
                'title' => 'Edit',
                'class'=>'text-center',
                'searchable' => false,
                'orderable' => false,
                'exportable' => false
            ],
            [
                'name' => 'delete',
                'data' => 'delete',
                'title' => 'Delete',
                'class'=>'text-center',
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
        return 'districts_' . date('YmdHis');
    }
}
