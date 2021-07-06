<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $taks = Todo::latest()->Paginate(3);
       
        return response()->json($taks , 200);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request,[
            
            'task' => 'required|string|min:3|max:25',
       
        ],[
            'task.required' => 'Task is required. Max allowed 25 char and min 3 char'
        ]);
        
        Todo::create($request->all());
        
        return response()->json([
            'create' => 'stored successfully',
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todo $todo)
    {
       $id = $request['params']['id'];
       $newTask = $request['params']['newTask'];

        $updateTask = Todo::find($id);
        $updateTask->task = $newTask;
        $updateTask->save();
       
       return response()->json([
        'create' => 'update successfully',
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy( Request $request, Todo $todo)
    {
        $task =  Todo::find($request->id);
        $task->completed = 1;
        $task->save();
        Todo::destroy($request->id);

        return response()->json([
            'delete' => 'delete successfully',
        ], 200);
    }
}