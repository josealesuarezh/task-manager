<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Task Manager</title>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

<div>
    <ul class="tasks-list">
        <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#addTask">
            New Task
        </button>
        @foreach($tasks as $task)
            <li class="item d-flex justify-content-between mb-2 px-3 py-1" draggable="true" data-priority="{{$task->priority}}" data-id="{{$task->id}}">
                <div class="details">
                    <span>{{ $task->priority }}. &nbsp;</span> {{ $task->name }}
                </div>
                <div class="action-buttons">
                    <button
                        type="button"
                        class="text-button edit"
                        data-bs-toggle="modal"
                        data-bs-target="#editTask"
                        data-bs-id="{{$task->id}}"
                        data-bs-name="{{$task->name}}"
                        data-bs-priority="{{$task->priority}}"
                        data-bs-date="{{$task->date}}"
                    >
                       edit
                    </button>
                    <form action="{{ url('tasks/'.$task->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="text-button delete">delete</button>
                    </form>
                </div>

            </li>
        @endforeach
    </ul>
</div>

<div class="modal fade" id="addTask" tabindex="-1" aria-labelledby="addTask" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Create Task</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ url('tasks') }}" method="post">
                @csrf
                @include('components.modal.task-modal')
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editTask" tabindex="-1" aria-labelledby="editTask" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Task</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editForm" action="{{ url('tasks/24') }}" method="POST">
                @csrf
                @method('PATCH')
                @include('components.modal.task-modal')
            </form>
        </div>
    </div>
</div>

</body>
</html>
