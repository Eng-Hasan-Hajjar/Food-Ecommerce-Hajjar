<?php

namespace App\DataTables;

use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTableAbstract;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Services\DataTable;

class employeesDataTable extends DataTable
{


    private static function language()
    {
        return [
            "sProcessing" => "جارٍ التحميل...",
            "sLengthMenu" => "أظهر _MENU_ مدخلات",
            "sZeroRecords" => "لم يعثر على أية سجلات",
            "sInfo" => "إظهار _START_ إلى _END_ من أصل _TOTAL_ مدخل",
            "sInfoEmpty" => "يعرض 0 إلى 0 من أصل 0 سجل",
            "sInfoFiltered" => "(منتقاة من مجموع _MAX_ مُدخل)",
            "sInfoPostFix" => "",
            "sSearch" => "ابحث ",
            "sUrl" => "",
            "oPaginate" => [
                "sFirst" => "الأول",
                "sPrevious" => "السابق",
                "sNext" => "التالي",
                "sLast" => "الأخير"
            ]
        ];
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
            ->addColumn('action','front.resturants.employees.btn.action' )
            ->rawColumns([
                'action'
            ]);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\employee $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Employee $model)
    {
        return Employee::where('resturant_id','=',Auth::id());
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('employees-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->parameters([
                'dom' => 'Blftrip',
                'lengthMenu' => [[10, 25, 100, -1], [10, 25, 100, 'All record']],
                'language'=>self::language()
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
                'title' => 'الاسم'
            ],
            [
                'name' => 'phone',
                'data' => 'phone',
                'title' => 'الجوال'
            ],
            [
                'name' => 'age',
                'data' => 'age',
                'title' => 'العمر'
            ],
            [
                'name' => 'resume',
                'data' => 'resume',
                'title' => 'ملاحظات'
            ],
            [
                'name' => 'action',
                'data' => 'action',
                'title' => 'اعدادات',
                'searchable' => false,
                'orderable' => false,
                'exportable' => false
            ],

        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'employees_' . date('YmdHis');
    }
}
