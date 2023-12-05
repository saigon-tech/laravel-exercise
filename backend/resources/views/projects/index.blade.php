<!-- extend from layouts app.blade.php -->
@extends('layouts.app')
<!-- define the content section -->
@section('content')
    <!-- search form with the keyword -->
    <form action="{{ route('projects.index') }}" method="GET">
        <div class="input-group mb-3">
            <input type="text" name="keyword" class="form-control" placeholder="Search for projects"
                   value="{{request('keyword')}}">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </div>
    </form>
    <div class="card">
        <div class="card-header">{{ __('Projects') }}</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('projects.create') }}"
                       class="btn btn-primary btn-sm float-right mb-3">
                        <i class="bi bi-plus-circle"></i> Create Project
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @if($projects->count() > 0)
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Users</th>
                                <th scope="col" style="width: 150px;">&nbsp;</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($projects as $project)
                                <tr>
                                    <td>{{ $project->name }}</td>
                                    <td>{{ $project->description }}</td>
                                    <td>{!! $project->members?->pluck('name')->join('<br/>') !!}</td>
                                    <td>
                                        <a href="{{ route('projects.edit', $project->id) }}"
                                           class="btn btn-primary btn-sm">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <a href="{{ route('projects.show', $project->id) }}"
                                           class="btn btn-info btn-sm">
                                            <i class="bi bi-eye"></i>
                                        </a>

                                        <!-- add a button to open the popup to confirm delete the project -->
                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                data-target="#deleteModal{{$project->id}}">
                                            <i class="bi bi-trash"></i>
                                        </button>

                                        <!-- popup delete project -->
                                        <div id="deleteModal{{$project->id}}" class="modal fade" tabindex="-1"
                                             aria-labelledby="deleteModal{{$project->id}}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5">Delete
                                                            the project</h1>
                                                        <button type="button" class="btn-close"
                                                                data-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Delete project {{$project->name}}?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close
                                                        </button>
                                                        <form action="{{ route('projects.destroy', $project->id) }}"
                                                              method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $projects->links() }}
                    @else
                        <div class="alert alert-info">
                            No projects found!
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
