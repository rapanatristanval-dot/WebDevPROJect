@extends('layouts.app')

@section('content')
    <div class="page-header">
        <div>
            <h1>📍 Personal Task Manager</h1>
        </div>
        <a href="{{ route('tasks.create') }}" class="btn btn-primary">+ Add Task</a>
    </div>

    <div class="summary-grid">
        <div class="summary-box total">
            <h3>Total Tasks</h3>
            <strong>{{ $tasks->count() }}</strong>
        </div>
        <div class="summary-box pending">
            <h3>Pending</h3>
            <strong>{{ $tasks->where('status', 'Pending')->count() }}</strong>
        </div>
        <div class="summary-box completed">
            <h3>Completed</h3>
            <strong>{{ $tasks->where('status', 'Completed')->count() }}</strong>
        </div>
    </div>

    <div class="card">
        <h2 class="section-title">All Tasks</h2>

        @if ($tasks->isEmpty())
            <div class="empty-state">No tasks yet. Add your first task to get started.</div>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Task Name</th>
                        <th>Description</th>
                        <th>Due Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                        <tr>
                            <td class="task-name">{{ $task->task_name }}</td>
                            <td class="task-desc">{{ $task->description ?: 'No description provided.' }}</td>
                            <td>{{ $task->due_date->format('M d, Y') }}</td>
                            <td>
                                <span class="badge {{ $task->status === 'Completed' ? 'badge-completed' : 'badge-pending' }}">
                                    {{ $task->status }}
                                </span>
                            </td>
                            <td>
                                <div class="table-actions">
                                    <form action="{{ route('tasks.update', $task) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" class="status-select" onchange="this.form.submit()">
                                            <option value="Pending" {{ $task->status === 'Pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="Completed" {{ $task->status === 'Completed' ? 'selected' : '' }}>Completed</option>
                                        </select>
                                        <input type="hidden" name="task_name" value="{{ $task->task_name }}">
                                        <input type="hidden" name="description" value="{{ $task->description ?? '' }}">
                                        <input type="hidden" name="due_date" value="{{ $task->due_date }}">
                                    </form>

                                    <a href="{{ route('tasks.edit', $task) }}" class="btn btn-secondary">Edit</a>

                                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Delete this task?')">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
