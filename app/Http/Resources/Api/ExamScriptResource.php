<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class ExamScriptResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'title'     => $this->title,
            'duration'  => $this->duration,
            'result'    => $this->result,
            'questions' => $this->questions->map(function ($question) {
                return [
                    'ansRight'      => $question->getAnswer->is_correct,
                    'questions'     => $question->question,
                    'description'   => $question->description,
                    'question_type' => $question->question_type,
                    'options'       => $question->answers,
                    'student_ans'   => $question->getAnswer ? $question->getAnswer->answers : null,
                ];
            }),
        ];
    }
}
