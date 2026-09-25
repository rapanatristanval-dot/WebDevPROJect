@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h1>Edit Task</h1>
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Back to Tasks</a>
    </div>

    <div class="card">
        <form action="{{ route('tasks.update', $task) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-grid">
                <div class="field">
                    <label for="task_name">Task Name</label>
                    <input type="text" id="task_name" name="task_name" value="{{ old('task_name', $task->task_name) }}" required>
                </div>

                <div class="field">
                    <label for="due_date">Due Date</label>
                    <input type="date" id="due_date" name="due_date" value="{{ old('due_date', $task->due_date) }}" required>
                </div>

                <div class="field">
                    <label for="status">Status</label>
                    <select id="status" name="status" required>
                        <option value="Pending" {{ old('status', $task->status) === 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Completed" {{ old('status', $task->status) === 'Completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>
            </div>

            <div class="field" style="margin-top: 22px;">
                <label for="description">Description</label>
                <textarea id="description" name="description" placeholder="Update task details...">{{ old('description', $task->description) }}</textarea>
            </div>

            <div class="actions">
                <button type="submit" class="btn btn-primary">Update Task</button>
                <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection
