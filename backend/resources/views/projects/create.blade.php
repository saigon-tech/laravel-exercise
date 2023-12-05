<!-- extend from layouts.app -->
@extends('layouts.app')

<!-- page title -->
@section('title', 'Create Project')

@section('styles')
    <!-- load jquery date picker css -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
@endsection

<!-- page contents -->
@section('content')
    <!-- create a new project -->
    <div class="card">
        <div class="card-header">{{ __('Create Project') }}</div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('projects.index') }}"
                       class="btn btn-primary btn-sm mb-3">
                        <i class="bi bi-arrow-left-circle"></i> Back to projects
                    </a>
                </div>
            </div>
            <form method="post" action="{{route('projects.store')}}">
                @csrf
                <!-- input name -->
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                           id="name" name="name" value="{{old('name')}}">
                    @error('name')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <!-- input description -->
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror"
                              id="description" name="description">{{old('description')}}</textarea>
                    @error('description')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <!-- input start with date picker -->
                <div class="form-group">
                    <label for="start">Start</label>
                    <input type="text" class="form-control datepicker @error('start') is-invalid @enderror"
                           readonly
                           id="start" name="start" value="{{old('start')}}">
                    @error('start')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <!-- input end with date picker -->
                <div class="form-group">
                    <label for="end">End</label>
                    <input type="text" class="form-control datepicker @error('end') is-invalid @enderror"
                           readonly
                           id="end" name="end" value="{{old('end')}}">
                    @error('end')
                    <small class="text-danger">{{$message}}</small>
                    @enderror
                </div>
                <!-- submit button -->
                <button type="submit" class="btn btn-primary">Create</button>
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
