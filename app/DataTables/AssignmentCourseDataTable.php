<?php

namespace App\DataTables;

use App\Models\Course;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class AssignmentCourseDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('category', function ($course) {
                return @$course->category->language->title;

            })
            ->addColumn('action', function ($course) {
                return view('backend.admin.course.assignment.course_list_action', compact('course'));
            })
            ->addColumn('enrolled_student', function ($course) {
                return $course->enrolls_count;
            })->setRowId('id');
    }

    public function query(): QueryBuilder
    {
        $id = $this->org_id;

        return Course::withCount(['enrolls'])
            ->with('category.language')
            ->where('course_type', '!=', 'bundle')
            ->when($id, function ($query) use ($id) {
                $query->where('organization_id', $id);
            })
            ->when($this->instructor_ids, function ($query) {
                $query->whereHas('instructors');
            })
            ->when($this->category_ids, function ($query) {
                $query->whereIn('category_id', $this->category_ids);
            })
            ->when($this->status, function ($query, $status) {
                $query->where('status', $status);
            })
            ->when($this->request->search['value'] ?? false, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->whereRaw('CAST(price AS CHAR) LIKE ?', ["%$search%"])
                        ->orWhere('title', 'like', "%$search%")
                        ->orWhereHas('category.language', function ($categoryQuery) use ($search) {
                            $categoryQuery->where('title', 'like', "%$search%");
                        });
                });
            })
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
                    ['csv'],
                ],
                'lengthMenu' => [[10, 25, 50, 100, 250], [10, 25, 50, 100, 250]],
                'language'   => [
                    'searchPlaceholder' => __('search'),
                    'lengthMenu'        => '_MENU_ '.__('course_per_page'),
                    'search'            => '',
                ],
            ]);
    }

    public function getColumns(): array
    {
        return [
            Column::computed('id')->data('DT_RowIndex')->title('#')->searchable(false)->width(10),
            Column::make('title')->title(__('title'))->searchable(false),
            Column::computed('category')->title(__('category'))->searchable(false),
            Column::computed('enrolled_student')->title(__('enrolled_student')),
            Column::computed('action')->addClass('action-card')->title(__('action'))->searchable(false)->exportable(false)->printable(false),
        ];
    }

    protected function filename(): string
    {
        return 'Currency_'.date('YmdHis');
    }
}
