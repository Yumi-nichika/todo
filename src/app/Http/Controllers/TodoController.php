<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Http\Requests\TodoRequest;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::all();
        return view('index', ['todos' => $todos]);
    }

    public function store(TodoRequest $request)
    {
        $form = $request->all();
        Todo::create($form);
        return redirect('/')->with('success', 'Todoを作成しました');;
    }

    public function update(TodoRequest $request)
    {
        //リクエストにidも含まれているので対象のみに絞る
        $todo = $request->only(['content']);

        //更新
        Todo::find($request->id)->update($todo);

        return redirect('/')->with('success', 'Todoを更新しました');
    }

    public function destroy(Request $request)
    {
        Todo::find($request->id)->delete();

        return redirect('/')->with('success', 'Todoを削除しました');
    }
}
