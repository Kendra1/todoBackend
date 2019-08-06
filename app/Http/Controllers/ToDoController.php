<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\TodoValidator;

class ToDoController extends Controller
{

    protected function validator(array $request)
    {
        info("tu sam tugomir");
        info(config('enums.priorities'));
        return Validator::make($request, [
            'title' => ['required', 'string', 'max:6'],
            'description' => ['string'],
            'priority' => ['required', Rule::in(config('enums.priorities'))],
            'completed' => ['required', 'boolean'],
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();

        return $user->todos;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TodoValidator $request)
    {
        $validated = $request->validated();
        $user = $request->user();
        info($user);
        return Todo::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'priority' => $validated['priority'],
            'completed' => $validated['completed'],
            'user_id' => $user->id, 

        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        $user = $request->user();
        $todo = Todo::find($id)->get()->first();
        
        info($todo);

        $todo->fill($request->all())->save();   

        return $todo;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $todo = Todo::find($id)->get()->first();
        $todo -> delete();
        return $todo;
    }
}
