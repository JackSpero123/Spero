<?php



namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        return Task::all();
    }

    public function show($id)
    {
        return Task::findOrFail($id);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        return Task::create($validatedData);
    }

    public function update(Request $request, $title)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $todo = Task::findOrFail($title);
        $todo->update($validatedData);

        return $todo;
    }

    public function delete($id)
    {
        $todo = Task::findOrFail($id);
        $todo->delete();

        return response()->json(null, 204);
    }

  
    
        public function viewTaskPage()
        {
            return view('tasks.view');
        }
        
}