<?php

namespace App\Http\Resources;

use App\TaskReport;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TaskCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }

    /**
     * Get additional data that should be returned with the resource array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function with($request)
    {
        if (!$request->input('with')) return [];
        $response = [];
        if (in_array("stats", $request->input('with'))) $response["stats"] = $this->stats();
        if (in_array("times", $request->input('with'))) $response["times"] = $this->times();
        return [
            "meta" => $response
        ];
    }

    /**
     * Get statistics for the tasks of the collection.
     */
    private function stats()
    {
        $stats = [];
        $stats["total"] = $this->collection->count();
        $status = [];
        $priority = [];
        foreach ($this->collection->groupBy("status") as $key => $value) {
            array_push($status, [
                "name" => $key,
                "value" => $value->count(),
                "percent" => number_format($value->count() * 100 / $stats["total"], 2) . "%"
            ]);
        }
        foreach ($this->collection->groupBy("priority") as $key => $value) {
            array_push($priority, [
                "name" => $key,
                "value" => $value->count(),
                "percent" => number_format($value->count() * 100 / $stats["total"], 2) . "%"
            ]);
        }

        $stats["status"] = $status;
        $stats["priority"] = $priority;
        return $stats;
    }

    private function times()
    {
        $invested = TaskReport::whereIn('task_id', $this->pluck('id'))->pluck('invested_hours')->sum();
        $estimated = $this->collection->pluck('estimated_hours')->sum();
        return [
            'invested_hours' => $invested,
            'estimated_hours' => $estimated
        ];
    }
}
