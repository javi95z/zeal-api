<?php

namespace App\Http\Controllers;

use App\TaskReport;
use Illuminate\Http\Request;
use App\Http\Resources\TaskReport as TaskReportResource;

/**
 * Class TaskReportController
 * @package App\Http\Controllers
 *
 * @group TaskReports
 */
class TaskReportController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
        $this->ruleNames = 'validation.reports';
    }

    /**
     * Create new TaskReport
     *
     * @param Request $request
     * @return TaskReportResource
     */
    public function store(Request $request)
    {
        try {
            $report = new TaskReport;
            if ($request->has('task_id')) $report->task_id = $request->task_id;
            if ($request->has('invested_hours')) $report->invested_hours = $request->invested_hours;
            if ($request->has('comment')) $report->comment = $request->comment;
            $report->user_id = auth()->user()->id;
            $report->save();
        } catch (\Exception $ex) {
            return response()->json(['error' => 'There was an error in your request'], 400);
        }
        return new TaskReportResource($report->fresh(['user'])->refresh());
    }

    /**
     * Delete one TaskReport
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $res = TaskReport::findOrFail($id);
        if (!$res->delete()) return response()->json(['error' => 'Couldn\'t delete task report']);
        return response()->json(true, 200);
    }
}
