<div class="p-6 mx-auto">
    <div class="flex justify-between mb-4">
        <!-- Create Task Button -->
        <a href="{{ route('tasks.create') }}" class="bg-sky-500 text-white rounded-lg px-4 py-2 inline-block">Create New Task</a>

        <!-- Filter Section -->
        @if (auth()->user()->role->name === "admin")
            <div class="flex space-x-4">
                <!-- Filter by Employee -->
                <select class="rounded-md border-gray-300 p-2" wire:change="filterByEmployee($event.target.value)">
                    <option value="">Employees</option>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                    @endforeach
                </select>
                <!-- Filter by Date -->
                <input type="date" wire:change="filterByDate($event.target.value)" class="rounded-md border-gray-300 p-2">
            </div>
        @endif
    </div>

    {{-- Table --}}
    <div class="relative overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-white uppercase bg-sky-500 ">
                <tr>
                    <th scope="col" class="px-6 py-3 text-center">
                        Task name
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Description
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        the Creater
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Status
                    </th>
                    <th>
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tasks as $task)
                    <tr class="text-black border-b bg-gray-300 border-gray-200">
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap text-center">
                            {{ $task->title }}
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap text-center">
                            {{ Str::limit($task->description, 20)}}
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap text-center">
                            {{ $task->user->name}}
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap text-center">
                            @if ($task->status === "Done")
                                <p wire:click="switchStatus({{ $task->id }})" class="inline-flex item-center text-green-600 text-xs rounded-md px-2 py-1 capitalize bg-green-100 cursor-pointer">Done</p>
                            @else
                                <p wire:click="switchStatus({{ $task->id }})" class="cursor-pointer">To Do</p>
                            @endif
                        </td>
                        <td>
                            @if($task->user_id === auth()->id() || auth()->user()->role->name === 'admin')
                                <button wire:click="delete({{ $task->id }})" class="text-red-500">
                                    <x-heroicon-o-trash class="w-4 h-4"/>
                                </button>
                            @endif
                            <button wire:click="edit({{ $task->id }})">
                                <x-heroicon-o-pencil-square class="w-4 h-4 text-blue-500 ml-2"/>
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr class="text-black">
                        <td colspan="4" class="text-center py-4">No tasks available.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @livewireStyles
</div>
