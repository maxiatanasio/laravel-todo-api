<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersTodoController extends Controller
{
    public function list() {
        $user = Auth::user();
        $todos = $user->todos;

        return response()->json([
            'todos' => $todos,
        ]);
    }

    public function add(Request $request) {
        $newTodo = new Todo;
        $newTodo->todo = $request->input('todo');
        Auth::user()->todos()->save($newTodo);

        return response()->json([
            'successful' => true,
        ]);
    }

    public function update(string $todoId, Request $request) {
        $todo = Auth::user()->todos()->find($todoId);
        if (!$todo) {
            return response()->json([
                'successful' => false,
                'reason' => 'todo not found for the user',
            ]);    
        }

        $todo->todo = $request->input('todo');

        $todo->save();

        return response()->json([
            'successful' => true,
        ]);
    }

    public function delete(string $todoId) {
        $todo = Auth::user()->todos()->find($todoId);
        $todo->delete();

        return response()->json([
            'successful' => true,
        ]);
    }
}
