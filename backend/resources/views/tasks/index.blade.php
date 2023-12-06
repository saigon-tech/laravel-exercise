<!-- extend from layouts app.blade.php -->
@extends('layouts.app')
<!-- define the content section -->
@section('content')
    <!-- search form with the keyword -->
    <form action="{{ route('tasks.index') }}" method="GET">
        <div class="input-group mb-3">
            <input type="text" name="keyword" class="form-control" placeholder="Search for tasks"
                   value="{{request('keyword')}}">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </div>
    </form>
    <div class="card">
        <div class="card-header">{{ __('Tasks') }}</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    @if($tasks->count() > 0)
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Description</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tasks as $task)
                                <tr>
                                    <td>{{ $task->name }}</td>
                                    <td>{{ $task->description }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $tasks->links() }}
                    @else
                        <div class="alert alert-info">
                            No tasks found!
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
