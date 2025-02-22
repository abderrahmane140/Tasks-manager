<?php
namespace App\Livewire;

use Livewire\Component;
use App\Models\Task;
use App\Models\User;

class TaskList extends Component
{
    public $tasks;
    public $selectedDate = null;
    public $selectedUser = null;
    public $employees;

    public function mount()
    {
        $this->employees = User::whereHas('tasks')->get();
        $this->refreshTasks();
    }

    public function filterByEmployee($employeeId)
    {
        $this->selectedUser = $employeeId;
        $this->refreshTasks();
    }

    public function filterByDate($date)
    {
        $this->selectedDate = $date;
        $this->refreshTasks();
    }

    public function refreshTasks()
    {
        $query = Task::query();

        if ($this->selectedUser) {
            $query->where('user_id', $this->selectedUser);
        }

        if ($this->selectedDate) {
            $query->whereDate('created_at', $this->selectedDate);
        }

        // Allow admins to see all tasks
        if (auth()->user()->role->name !== 'admin') {
            $query->where('user_id', auth()->id());
        }

        $this->tasks = $query->get();
    }

    public function delete($id)
    {
        $task = Task::findOrFail($id);

        // Admin can delete any task, employees can only delete their own tasks
        if ($task->user_id === auth()->id() || auth()->user()->role->name === 'admin') {
            $task->delete();
            $this->refreshTasks();
        } else {
            session()->flash('error', 'You do not have permission to delete this task.');
        }
    }

    public function edit($id)
    {
        return redirect()->route('task.edit', ['taskId' => $id]);
    }

    public function switchStatus($id)
    {
        $task = Task::findOrFail($id);
        $task->status = ($task->status === 'Done') ? 'To Do' : 'Done';
        $task->save();
        $this->refreshTasks();
    }

    public function render()
    {
        return view('livewire.task_list')->layout('layouts.app');
    }
}
