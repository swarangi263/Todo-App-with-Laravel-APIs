@extends('layouts.app')
@section('title','Dashboard')

@section('content')
<div class="container">
    @if (Session::has('1'))
    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
        <strong>{{$message = Session::get(1)}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <h3 class="text-center fw-bold text-uppercase">
                        {{ __('Hello '. $user->name.' !') }}
                    </h3>
                </div>
            </div>
            <div class="text-center">
                <button class="btn btn-primary mt-4 mb-4 place-content-center" type="button" data-toggle="modal" data-target="#exampleModalCenter">Add Task</button>
            </div>
        </div>
        <div class="col-md-8">
            <table class="table">
                <thead>
                    <tr class="text-uppercase">
                        <th>Sr. No</th>
                        <th>Task</th>
                        <th>Status</th>
                        <th>Update Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; $id = $user->id; ?>
                    @forelse ($user->task as $task)
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{$task->task}}</td>
                        <td class="text-uppercase">{{$task->status}}</td>
                        <form action="todo/status" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{$task->id}}">
                            @if($task->status == 'pending')
                            <td><button class="btn btn-success" type="submit">{{__('Done')}}</button></td>
                            <input type="hidden" name="status" value="done">
                            @else
                            <td><button class="btn btn-outline-dark" type="submit">{{__('Pending')}}</button></td>
                            <input type="hidden" name="status" value="pending">
                            @endif
                        </form>
                        <?php $i++; ?>
                    </tr>
                    @empty
                    <p class="fw-bold">{{__('No Records Found!')}}</p>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Todo Task</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="/todo/add" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <textarea class="form-control" rows="5" id="task" name="task" placeholder="Add your task..."></textarea>
                            <div class="text-center">
                                <input type="submit" class="btn btn-primary mt-2" value="Save Task"></input>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
