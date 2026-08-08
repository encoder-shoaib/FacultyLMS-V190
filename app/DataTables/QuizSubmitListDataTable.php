<?php

namespace App\DataTables;

use App\Models\Result;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class QuizSubmitListDataTable extends DataTable
{
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addIndexColumn()
            ->addColumn('name', function ($student) {
                return optional($student->user)->first_name.' '.optional($student->user)->last_name;
            })
            ->addColumn('position', function ($student) {
                return $student->position;
            })
            ->addColumn('your_marks', function ($student) {
                return round($student->your_marks);
            })
            ->setRowId('id');
    }

    public function query(): QueryBuilder
    {
        $quizId      = $this->id;

        $query       = Result::select(
            'results.*',
            DB::raw('(
                    SELECT COUNT(*) + 1
                    FROM results AS r2
                    WHERE r2.quiz_id = results.quiz_id
                      AND r2.your_marks > results.your_marks
                ) AS position')
        )
            ->leftJoin('users', 'results.user_id', '=', 'users.id')
            ->where('results.quiz_id', $quizId)
            ->orderBy('results.your_marks', 'desc');

        $searchValue = $this->request->get('search')['value'] ?? null;

        if ($searchValue) {
            $query->where(function ($query) use ($searchValue) {
                $query->where('results.your_marks', 'like', "%$searchValue%")
                    ->orWhere(function ($subQuery) use ($searchValue) {
                        $subQuery->where('users.first_name', 'like', "%{$searchValue}%")
                            ->orWhere('users.last_name', 'like', "%{$searchValue}%");
                    });
            });
        }

        return $query;
    }

    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->selectStyleSingle()
            ->setTableAttribute('style', 'width:99.8%')
            ->footerCallback('function (row, data, start, end, display) {
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
                    'lengthMenu'        => '_MENU_ '.__('merit_list_per_page'),
                    'search'            => '',
                ],
            ]);
    }

    public function getColumns(): array
    {
        return [
            Column::computed('id')->data('DT_RowIndex')->title('#')->searchable(false)->width(10),
            Column::make('name')->title(__('name'))->searchable(false),
            Column::make('total_marks')->title(__('total_marks'))->searchable(false),
            Column::make('your_marks')->title(__('your_marks'))->searchable(false),
            Column::computed('position')->data('position')->title(__('position'))->searchable(false)->className('text-center'),
        ];
    }

    protected function filename(): string
    {
        return 'leaderboard_'.date('YmdHis');
    }
}
