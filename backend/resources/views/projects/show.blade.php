<!-- extends from layouts.app -->
@extends('layouts.app')

<!-- title -->
@section('title', 'Project detail')

<!-- define the content section -->
@section('content')
    <div class="card">
        <div class="card-header">{{ __('Project detail') }}</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('projects.index') }}"
                       class="btn btn-primary btn-sm mb-3">
                        <i class="bi bi-arrow-left-circle"></i> Back to projects
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-hover">
                        <tbody>
                        <tr>
                            <th scope="row">Name</th>
                            <td>{{ $project->name }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Description</th>
                            <td>{{ $project->description }}</td>
                        </tr>
                        <tr>
                            <th scope="row">Users</th>
                            <td>{!! $project->members?->pluck('name')->join('<br/>') !!}</td>
                        </tr>
                        <tr>
                            <th scope="row">&nbsp;</th>
                            <td>
                                <a href="{{ route('projects.edit', $project->id) }}"
                                   class="btn btn-primary">
                                    <i class="bi bi-pencil-square"></i>
                                    Edit
                                </a>

                                <!-- add a button to open the popup to confirm delete the project -->
                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                        data-target="#deleteModal{{$project->id}}">
                                    <i class="bi bi-trash"></i>
                                    Delete
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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
