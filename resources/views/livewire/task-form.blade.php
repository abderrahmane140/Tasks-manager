<div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
      <h2 class="mt-10 text-center text-2xl/9 font-bold tracking-tight text-gray-900">{{ $isEditMode ? 'Update Task' : 'Create New Task' }}</h2>
    </div>
  
    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <div>
          <label for="title" class="block text-sm/6 font-medium text-gray-900">Title</label>
          <div class="mt-2">
            <input type="text" wire:model="title" placeholder="Task Title" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-sky-600 sm:text-sm/6">
            @error('title') <span class="text-red-500">{{ $message }}</span> @enderror
          </div>
        </div>
  
        <div>
          <div class="flex items-center justify-between mt-4">
            <label for="Description" class="block text-sm/6 font-medium text-gray-900">Description</label>
          </div>
          <div class="mt-2">
            <textarea wire:model="description" placeholder="Description" required class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-sky-600 sm:text-sm/6"></textarea>
            @error('description') <span class="text-red-500">{{ $message }}</span> @enderror
          </div>
        </div>
  
        <div class="mt-5">
          <button type="submit" wire:click="{{ $isEditMode ? 'update' : 'create' }}" class="flex w-full justify-center rounded-md bg-sky-500 hover:bg-sky-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs">
            {{ $isEditMode ? 'Update Task' : 'Create Task' }}
          </button>

        </div>
  
    </div>
  </div>