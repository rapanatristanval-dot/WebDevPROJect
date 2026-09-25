@extends('layouts.app')

@section('content')
    <div class="page-header">
        <h1>Add New Task</h1>
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Back to Tasks</a>
    </div>

    <div class="card">
        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf

            <div class="form-grid">
                <div class="field">
                    <label for="task_name">Task Name</label>
                    <input type="text" id="task_name" name="task_name" value="{{ old('task_name') }}" required>
                </div>

                <div class="field">
                    <label for="due_date">Due Date</label>
                    <input type="date" id="due_date" name="due_date" value="{{ old('due_date') }}" required>
                </div>

                <div class="field">
                    <label for="status">Status</label>
                    <select id="status" name="status" required>
                        <option value="Pending" {{ old('status') === 'Pending' ? 'selected' : '' }}>Pending</option>
                        <option value="Completed" {{ old('status') === 'Completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>
            </div>

            <div class="field" style="margin-top: 22px;">
                <label for="description">Description</label>
                <textarea id="description" name="description" placeholder="Add task details...">{{ old('description') }}</textarea>
            </div>

            <div class="actions">
                <button type="submit" class="btn btn-primary">Save Task</button>
                <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection
