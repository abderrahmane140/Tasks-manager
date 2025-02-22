<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Task;

class TaskForm extends Component
{
    public $title, $description, $taskId;
    public $isEditMode = false;

    public function mount($taskId = null)
    {
        if ($taskId) {
            $this->isEditMode = true;
            $task = Task::findOrFail($taskId);

            // Ensure that only the creator or admin can edit the task
            if ($task->user_id !== auth()->id() && auth()->user()->role->name !== 'admin') {
                return redirect()->route('tasks')->with('error', 'You do not have permission to edit this task.');
            }

            $this->taskId = $task->id;
            $this->title = $task->title;
            $this->description = $task->description;
        }
    }

    public function create()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Task::create([
            'title' => $this->title,
            'description' => $this->description,
            'user_id' => auth()->id()
        ]);

        session()->flash('message', 'Task created successfully.');
        return redirect()->route('tasks');
    }

    public function update()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $task = Task::findOrFail($this->taskId);

        // Ensure that only the creator or admin can update the task
        if ($task->user_id !== auth()->id() && auth()->user()->role->name !== 'admin') {
            session()->flash('error', 'You do not have permission to update this task.');
            return redirect()->route('tasks');
        }

        $task->update([
            'title' => $this->title,
            'description' => $this->description,
        ]);

        session()->flash('message', 'Task updated successfully.');
        return redirect()->route('tasks');
    }

    public function render()
    {
        return view('livewire.task-form')->layout('layouts.app');
    }
}
