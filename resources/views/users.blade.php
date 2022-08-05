<!-- resources/views/tasks.blade.php -->

@extends('layouts.app')

@section('content')

  <div class="container">


    <!-- New Task Card -->
<div class="card">
  <div class="card-body">
    <h5 class="card-title">New Task</h5>

    <!-- Display Validation Errors -->
    @include('common.errors')

    <!-- New Task Form -->
    <form action="{{ url('user') }}" method="POST">
      {{ csrf_field() }}

      <!-- Task Name -->
      <div class="form-group">
        <input type="text" name="name" id="name" class="form-control"
               placeholder="Please Enter Name" />
      </div>
      <br/>
      <div class="form-group">
        <input type="email" name="email" id="email" class="form-control"
               placeholder="Please Enter Email" />
      </div>
      <br/>
      <div class="form-group">
        <input type="password" name="password" id="password" class="form-control"
               placeholder="Please Enter Password" />
      </div>
      <br/>
      <br/>

      <!-- Add Task Button -->
      <div class="form-group">
        <button type="submit" class="btn btn-default">
          <i class="fa fa-plus"></i> Add User
        </button>
      </div>
    </form>
  </div>
</div>

    <!-- Current Tasks -->
    @if (count($users) > 0)
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Current Users</h5>

          <table class="table table-striped">
            @foreach ($users as $user)
              <tr>
                <td class="table-text">
                  <div>{{ $user->name }}</div>
                </td>
                <td class="table-text">
                  <div>{{ $user->email }}</div>
                </td>

                <td>
                <form action="{{ url('delete/'.$user->id) }}" method="POST">
                  {{ csrf_field() }}
                  {{ method_field('DELETE') }}

                  <button type="submit" class="btn btn-danger">
                    <i class="fa fa-trash"></i> Delete
                  </button>
                </form>
                </td>
              </tr>
            @endforeach
          </table>
        </div>
      </div>
    @endif

    <?php
      $statsData = array_pop($stats);
    ?>

    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Stats</h5>
        <table class="table table-striped">
          <tr>
            <td>Set commands</td>
            <td>{{ $statsData['cmd_set'] }}</td>
          </tr>
          <tr>
            <td>Get hits</td>
            <td>{{ $statsData['get_hits'] }}</td>
          </tr>
          <tr>
            <td>Get misses</td>
            <td>{{ $statsData['get_misses'] }}</td>
          </tr>
        </table>
      </div>
    </div>

    


  </div>
@endsection