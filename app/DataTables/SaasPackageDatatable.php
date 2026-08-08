<?php

namespace App\DataTables;

use App\Models\Currency;
use App\Models\SaasPackage;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class SaasPackageDatatable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('status', function ($package) {
                return view('backend.admin.saas_package.status', compact('package'));
            })->addColumn('action', function ($package) {
                return view('backend.admin.saas_package.action', compact('package'));
            })->addColumn('title', function ($saas_package) {
                return $saas_package->lang_title;
            })->addColumn('price', function ($saas_package) {
                return $saas_package->is_free ? __('free') : get_price($saas_package->price, userCurrency());
            })->setRowId('id');
    }

    public function query(): QueryBuilder
    {
        $model = new SaasPackage();

        return $model->newQuery();
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->selectStyleSingle()
            ->setTableAttribute('style', 'width:99.8%')
            ->footerCallback('function ( row, data, start, end, display ) {

                $(".dataTables_length select").addClass("form-select form-select-lg without_search mb-3");
                selectionFields();
            }')
            ->parameters([
                'dom'        => 'Blfrtip',
                'buttons'    => [
                    ['csv'],
                ],
                'lengthMenu' => [[10, 25, 50, 100, 250], [10, 25, 50, 100, 250]],
                'language'   => [
                    'searchPlaceholder' => __('search'),
                    'lengthMenu'        => '_MENU_ '.__('package_per_page'),
                    'search'            => '',
                ],
            ]);
    }

    public function getColumns(): array
    {
        return [
            Column::computed('id')->data('DT_RowIndex')->title('#')->searchable(false)->width(10),
            Column::make('title')->title(__('title'))->searchable(false),
            Column::computed('price')->title(__('price'))->searchable(false),
            Column::computed('status')->title(__('status'))->searchable(false)->exportable(false)->printable(false),
            Column::computed('action')->addClass('action-card')->title(__('action'))->searchable(false)->exportable(false)->printable(false),
        ];
    }

    protected function filename(): string
    {
        return 'Package_'.date('YmdHis');
    }
}
