<div>
    @include('livewire.includes.create-todo-box')
    @include('livewire.includes.search-box')
    <div id="todos-list">
        @forelse ($todos as $todo)
            @include('livewire.includes.todo-card')
        @empty
            <p>No todos</p>
        @endforelse

        <div class="my-2">
            {{ $todos->links() }}
        </div>
    </div>
</div>
