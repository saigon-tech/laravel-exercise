<!-- extend from layouts.app -->
@extends('layouts.app')

<!-- page title -->
@section('title', 'Edit Project')

@section('styles')
    <!-- load jquery date picker css -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
@endsection

<!-- page contents -->
@section('content')
    <!-- edit a project -->
    <div class="card">
        <div class="card-header">{{ __('Edit Project') }}</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('projects.index') }}"
                       class="btn btn-primary btn-sm mb-3">
                        <i class="bi bi-arrow-left-circle"></i> Back to projects
                    </a>
                </div>
            </div>
            <form method="post" action="{{route('projects.update', $project->id)}}">
                @csrf
                @method('PUT')
                <!-- input name -->
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                           id="name" name="name" value="{{old('name', $project->name)}}">
                    @error('name')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <!-- input description -->
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror"
                              id="description" name="description">{{old('description', $project->description)}}</textarea>
                    @error('description')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <!-- input start with date picker -->
                <div class="form-group">
                    <label for="start">Start</label>
                    <input type="text" class="form-control datepicker @error('start') is-invalid @enderror"
                           readonly
                           id="start" name="start" value="{{old('start', $project->start)}}">
                    @error('start')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <!-- input end with date picker -->
                <div class="form-group">
                    <label for="end">End</label>
                    <input type="text" class="form-control datepicker @error('end') is-invalid @enderror"
                           readonly
                           id="end" name="end" value="{{old('end', $project->end)}}">
                    @error('end')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <!-- input status -->
                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control @error('status') is-invalid @enderror"
                            id="status" name="status">
                        <option value="0" @if(old('status', $project->status) == 0) selected @endif>Open</option>
                        <option value="1" @if(old('status', $project->status) == 1) selected @endif>Locked</option>
                        <option value="2" @if(old('status', $project->status) == 2) selected @endif>Closed</option>
                    </select>
                    @error('status')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <!-- submit button -->
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-pencil-square"></i> Update
                </button>

                <!-- add a button to open the popup to confirm delete the project -->
                <button type="button" class="btn btn-danger" data-toggle="modal"
                        data-target="#deleteModal{{$project->id}}">
                    <i class="bi bi-trash"></i> Delete
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
            </form>
        </div>
    </div>

@endsection

<!-- scripts -->
@section('scripts')
    <!-- load jquery date picker js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <!-- jquery date picker -->
    <script>
        $('.datepicker').datepicker({
            format: 'yyyy-mm-dd',
            todayHighlight: true,
            autoclose: true,
            clearBtn: true,
            todayBtn: true,
        });
    </script>
@endsection
