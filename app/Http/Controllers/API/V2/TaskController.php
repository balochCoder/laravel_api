<?php

namespace App\Http\Controllers\API\V2;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : JsonResource
    {
        $tasks = auth()->user()->tasks()->get();
        return TaskResource::collection($tasks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request):JsonResource
    {
        $task = $request->user()->tasks()->create($request->validated());

        return TaskResource::make($task);

    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task):JsonResource
    {
        return TaskResource::make($task);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task):JsonResource
    {
        $task->update($request->validated());
        return TaskResource::make($task);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return response()->noContent();
    }
}
