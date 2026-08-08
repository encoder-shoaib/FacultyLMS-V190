<?php

namespace App\DataTables\Instructor;

use App\Models\Assignment;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class AssignmentListDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('action', function ($assignment) {
                return view('backend.instructor.course.assignment.assignment_list_action', compact('assignment'));
            })

            ->addColumn('instructor', function ($assignment) {

                return $assignment->instructor->name;
            })
            ->addColumn('total_students', function ($assignment) {

                return $assignment->course->enrolls->count();
            })
            ->addColumn('submitted_student', function ($assignment) {

                return $assignment->submittedAssignment->count();
            })
            ->addColumn('deadline', function ($assignment) {
                return Carbon::parse($assignment->deadline)->format('d F Y H:i A');
            })

            ->setRowId('id');
    }

    public function query(): QueryBuilder
    {
        $model = new Assignment();

        return $model
            ->with('instructor', 'course', 'submittedAssignment')
            ->when($this->course_id, function ($query) {
                $query->where('course_id', $this->course_id);
            })
            ->when($this->request->search['value'] ?? false, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('title', 'like', "%$search%")
                        ->orWhere('deadline', 'like', "%$search%");
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
            Column::make('title')->title(__('title'))->width('10px')->searchable(false),
            Column::computed('instructor')->title(__('instructor'))->searchable(false),
            Column::computed('deadline')->title(__('deadline'))->searchable(false),
            Column::computed('total_students')->title(__('total_students'))->searchable(false),
            Column::computed('submitted_student')->title(__('submitted'))->searchable(false),
            Column::computed('action')->title(__('action'))->addClass('text-end')
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
