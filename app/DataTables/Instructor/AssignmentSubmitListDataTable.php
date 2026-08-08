<?php

namespace App\DataTables\Instructor;

use App\Models\SubmitedAssignment;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class AssignmentSubmitListDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()->addColumn('action', function ($assignment) {
                return view('backend.admin.course.assignment.submitted_assignment.action', compact('assignment'));
            })->addIndexColumn()->addColumn('assignment', function ($assignment) {
                return view('backend.admin.course.assignment.submitted_assignment.file', compact('assignment'));
            })->addIndexColumn()->addColumn('status', function ($assignment) {
                return view('backend.admin.course.assignment.submitted_assignment.status', compact('assignment'));
            })->addColumn('name', function ($assignment) {
                return $assignment->user->first_name.' '.$assignment->user->last_name;
            })->addColumn('total_mark', function ($assignment) {
                return $assignment->assignment->total_marks;
            })
            ->setRowId('id');
    }

    public function query(): QueryBuilder
    {
        $model = new SubmitedAssignment();

        return $model
            ->with('user', 'assignment')
            ->when($this->assignment_id, function ($query) {
                $query->where('assignment_id', $this->assignment_id);
            })
            ->when($this->request->search['value'] ?? false, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('marks', 'like', "%$search%")
                        ->orwhere('status', 'like', "%$search%")
                        ->orWhereHas('user', function ($Query) use ($search) {
                            $Query->where('first_name', 'like', "%$search%")
                                ->orwhere('last_name', 'like', "%$search%");
                        })
                        ->orWhereHas('assignment', function ($Query) use ($search) {
                            $Query->where('total_marks', 'like', "%$search%");
                        });
                });
            })
            ->latest('id')
            ->newQuery();
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
                    [],
                ],
                'lengthMenu' => [[10, 25, 50, 100, 250], [10, 25, 50, 100, 250]],
                'language'   => [
                    'searchPlaceholder' => __('search'),
                    'lengthMenu'        => '_MENU_ '.__('list_per_page'),
                    'search'            => '',
                ],
            ]);
    }

    public function getColumns(): array
    {
        return [
            Column::computed('id')->data('DT_RowIndex')->title('#')->searchable(false)->width(10),
            Column::make('name')->title(__('name'))->searchable(false),
            Column::make('assignment')->title(__('assignment_file'))->searchable(false),
            Column::make('total_mark')->title(__('assignment_marks'))->searchable(false),
            Column::make('marks')->title(__('student_marks'))->searchable(false),
            Column::make('status')->title(__('status'))->searchable(false),
            Column::computed('action')->title(__('action'))
                ->exportable(false)
                ->printable(false)
                ->searchable(false),
        ];
    }

    protected function filename(): string
    {
        return 'assignment_'.date('YmdHis');
    }
}
