<?php

namespace App\Http\Controllers;

use App\TaskReport;
use Illuminate\Http\Request;

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
        // $this->ruleNames = 'validation.tasks';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TaskReport  $taskReport
     * @return \Illuminate\Http\Response
     */
    public function show(TaskReport $taskReport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TaskReport  $taskReport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TaskReport $taskReport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TaskReport  $taskReport
     * @return \Illuminate\Http\Response
     */
    public function destroy(TaskReport $taskReport)
    {
        //
    }
}
