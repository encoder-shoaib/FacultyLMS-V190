<?php

namespace App\DataTables\Instructor;

use App\Models\Quiz;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class QuizDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('total_student', function ($quiz) {
                return $quiz->section->course->enrolls->count() ?? 0;
            })
            ->addColumn('exam_attend', function ($quiz) {
                return $quiz->quizAnswer->groupby('exam_attend')->count() ?? 0;
            })
            ->addColumn('action', function ($quiz) {
                return view('backend.instructor.course.quiz.action', compact('quiz'));
            })
            ->setRowId('id');
    }

    public function query(): QueryBuilder
    {
        return Quiz::whereHas('section', function ($query) {
            $query->whereHas('course', function ($query) {
                $query->where('slug', $this->slug);
            });
        })
            ->with('section.course.enrolls')
            ->whereHas('quizAnswer')
            ->when($this->request->search['value'] ?? false, function ($query, $search) {
                $query->where('title', 'like', "%$search%");
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
            Column::computed('id')->data('DT_RowIndex')->title('#')->searchable(false),
            Column::make('title')->title(__('title'))->searchable(false),
            Column::make('total_student')->title(__('total_student'))->searchable(false),
            Column::make('exam_attend')->title(__('exam_attend'))->searchable(false),
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
