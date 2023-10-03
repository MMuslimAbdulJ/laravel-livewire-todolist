<?php

namespace App\Livewire;

use App\Models\Todo;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class TodoList extends Component
{

    use WithPagination;

    #[Rule('required|min:3|max:50')]
    public $name;

    public $search;


    public $editingTodoId;

    #[Rule('required|min:3|max:50')]
    public $editingNewName;

    public bool $clicked = false;

    public function create()
    {
        $validated = $this->validateOnly('name');

        Todo::create($validated);

        $this->reset('name');

        request()->session()->flash('success', 'Todo created');
    }

    public function delete(Todo $todo)
    {
        $todo->delete();
        request()->session()->flash('deleted', "Todo deleted");
    }

    public function edit(Todo $todo)
    {
        $this->validateOnly('editingNewName');
        $todo->name = $this->editingNewName;
        $todo->update();
        $this->clicked = false;
    }

    public function isClicked(Todo $todo)
    {
        $this->editingTodoId = $todo->id;
        $this->editingNewName = $todo->name;
        $this->clicked ? $this->clicked = false : $this->clicked = true;
    }

    public function toggle(Todo $todo)
    {
        $todo->completed ? $todo->completed = false : $todo->completed = true;
        $todo->update();
    }

    public function render()
    {
        return view('livewire.todo-list', [
            'todos' => Todo::where('name', 'like', "%{$this->search}%")->latest('created_at')->Paginate(5)
        ]);
    }
}
