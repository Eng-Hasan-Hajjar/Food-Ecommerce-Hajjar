<?php

namespace App\DataTables;

use App\Models\Order;
use App\models\Resturant;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Services\DataTable;

class resturantsDataTable extends DataTable
{

    private function commision($id){
        $sales = Order::where('resturant_id',$id)->where('state','delivered')
            ->sum('total');
        return $sales / settings()->getAttribute('commission') /100;
    }
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
            ->addColumn('residual', function (Resturant $resturant){
                return $this->commision($resturant->id) . '     $';
            })
            ->addColumn('delete', 'admin.resturants.btn.delete')
            ->addColumn('status', 'admin.resturants.btn.status')
            ->rawColumns([
                'Residual','delete', 'status'
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\resturant $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Resturant $model)
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
            ->setTableId('resturants-table')
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
            ],[
                'name' => 'residual',
                'data' => 'residual',
                'title' => 'residual'
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
        return 'resturants_' . date('YmdHis');
    }
}
