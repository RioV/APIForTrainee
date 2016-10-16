@extends('layouts.app')

@section('content')
    <div class="panel-body">
        <!-- Display Validation Errors -->
        @include('common.errors')
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <!-- New Task Form -->
        <form action="{{ url('pushnotification') }}" method="POST" class="form-horizontal">
            {{ csrf_field() }}

            <!-- Task Name -->
            <div class="form-group">
                <label for="task" class="col-sm-3 control-label">Account</label>
                <div class="col-sm-6">
                    <input type="text" name="name" id="name" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label for="task" class="col-sm-3 control-label">Alert.Title</label>
                <div class="col-sm-6">
                    <input type="text" name="alert-title" id="alert-title" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label for="task" class="col-sm-3 control-label">Alert.Body</label>
                <div class="col-sm-6">
                    <input type="text" name="alert-body" id="alert-body" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label for="task" class="col-sm-3 control-label">Badge</label>
                <div class="col-sm-6">
                    <input type="text" name="badge" id="badge" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label for="task" class="col-sm-3 control-label">Silent Push</label>
                <div class="col-sm-6">
                    <input class="field" name="silent-push" type="checkbox">
                </div>
            </div>

            <!-- Send Notification Button -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        Send Notification
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection