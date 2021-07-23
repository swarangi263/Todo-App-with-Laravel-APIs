@extends('layouts.app')

@section('title','Dashboard')

@section('content')
<div class="container">
    @if (Session::has(1))
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
                        {{session('email')}}
                        {{ __('Hello '. $user->name.' !') }}
                    </h3>
                </div>
            </div>

            <!-------------------------------- Add Task Button ---------------------------------------------------->
            <div class="text-center">
                <button class="btn btn-primary mt-4 mb-4 place-content-center" type="button" data-toggle="modal" data-target="#exampleModalCenter">Add Task</button>
            </div>
        </div>

        <!--------------------------------------------- Task List ---------------------------------------------------->
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
                <tbody id="tbody">

                    <?php $i = 1;
                    $id = $user->id; ?>

                    @if(!empty($user->tasks))

                    @foreach ($user->tasks as $task)
                    <tr>
                        <td id="id{{$task->id}}" value="{{$task->id}}">{{$i}}</td>
                        <td>{{$task->task}}</td>
                        <td class="text-uppercase" id="{{$task->id}}status">{{$task->status}}</td>

                        @if($task->status == 'pending')

                        <td><button type="button" onclick="status_click(this.id)" class="btn btn-success" name="status" value="done" id="status{{$task->id}}">{{__('Done')}}</button></td>

                        @else
                        <td><button type="button" onclick="status_click(this.id)" class="btn btn-dark" name="status" value="pending" id="status{{$task->id}}">{{__('Pending')}}</button></td>

                        @endif

                        <?php $i++; ?>
                    </tr>
                    @endforeach

                    @else

                    <p id="no_records" class="fw-bold">{{__('No Records Found!')}}</p>

                    @endif

                </tbody>
            </table>
        </div>

        <!------------------------------------------------------------- Modal ------------------------------------------------>
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
                        <form id="form_task">
                            @csrf
                            <input type="hidden" name="id" id="user_id" value="<?php echo $id; ?>">
                            <textarea class="form-control" rows="5" id="task" name="task" placeholder="Add your task..."></textarea>
                            <div class="text-center">
                                <input type="button" id="save_task" onclick="add()" class="btn btn-primary mt-2" value="Save Task"></input>
                            </div>
                        </form>
                    </div>
                    <!-- <div class="modal-footer">

                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>

@section('script')
<script>
    var added_no = <?php echo $i; ?>;
    var token = {!!json_encode($token) !!};
    // var token ='eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNzk1ZDIxMzA4MmE5OTZhNzQ5ZTI1YjYxMWE2NWEyMzQxNGQ4N2E0NDZlYjJkMjY4OTVmMDg3OWNmYTY5MDZhYmEzNDYzNTI3MjAyNzQ0MTMiLCJpYXQiOjE2MjY5OTQ0MzkuNjcwOTQ5LCJuYmYiOjE2MjY5OTQ0MzkuNjcwOTU1LCJleHAiOjE2NTg1MzA0MzkuNjY1MDUyLCJzdWIiOiI0Iiwic2NvcGVzIjpbXX0.FL8CPYE5NY4_gEQaiqfCl0FPUz5gKnHVyect7owvSfqpPfGxImGVceoxvH3r6KXvMW8dkKb-TtZLcnp1udBzNeFfUQ3SIGcUYUN3gVDwI0bhwepRqc17qNCAskEHqqI8jbir-POuKg36TiFWo2SDovwRBAEQ1mmjKl0caj-qqWbYQZkh7KwrvPscHeINztgb3226SNcwTWSwcIN-op0PUyE2kEM32ralgLcE9qY83S9IjVWG2lLqLE8MsV-4mdsycu0juyLs6pKGws2Xpi4-mFKugSstFauCUr_lNlBUGooG4tWdAIY72pdJa0LtOssmQxNIaUxAZQRUITjvr5mMG4lCeAoqFBtng260cN-dmuOstNKGETx2oedZ4wx2kV3vpRKypiAtGyrt7gsojH7jcnXaOFjXonmbWwy7FFLdaSFGWrWAe0tuM02rOpi4YqVKrh0iYc3dQA7Gy5gDyKIte0eharev-A08suPTqYYUkEskcOdhARGTr1bkZqnuPAu3k8tVdD9xqk328J26XDQ7Yob0jbMjit01cmeeEZeUOyLJLF3GRN2QpSkN-qJS-Y-9HTchmxkzsys5g_EJCP4LYCqYNYXtfGv3E5MhFyrqHFWJnACKceY5flBZFQ7z7Dhqyw1G17-_NTMIWy2qaXN-6JwElMghcyBCy_Tged77Yos'

    //Function to add task using ajax which is called on clicking
    function add() {

        var id = document.getElementById('user_id').value;
        var task = document.getElementById('task').value;

        var data = {
            "task": task
        };

        var add_task = $.ajax({
            type: 'POST',
            url: 'https://swarangi-app.herokuapp.com/api/todo/add',
            dataType: "json",
            data: JSON.stringify(data),
            cache: false,
            processData: false,
            contentType: "application/json", //Important else data will pass as null
            headers: {
                "Authorization": 'Bearer ' + token,
                // "Accept": 'application/json'
            },
            success: function(data) {

                console.log('success');

                var added_array = data['data'];

                var added_id = added_array['id'];
                var added_task = added_array['task'];
                var added_status = added_array['status'];

                console.log(added_id);
                console.log(added_task);
                console.log(added_status);

                var row = '<tr><td id="id'+id+'"  value="'+id+'">'+added_no+'</td><td>'+added_task+'</td><td class="text-uppercase" id="'+added_id+'status">' + added_status + '</td><td><button type="button"  onclick="status_click(this.id)" class="btn btn-success" name="status" value="Done" id="status'+added_id+'">Done</button></td></tr>';

                $('#tbody').append(row);

                added_no = added_no + 1;

                $('#no_records').hide();

            },

            error: function(xhr, status, error) {
                var err = eval("(" + xhr.responseText + ")");
                alert(err.Message);
            }

        });
        $('#exampleModalCenter').modal('hide');
    }

    function status_click(status) {

        console.log('clicked');
        console.log(status);

        var task_id = status.slice(6);
        var status = document.getElementById(status).value;

        console.log(task_id);
        console.log(status);

        var data = {
            "id": task_id,
            "status": status,
        };

        var update = $.ajax({

            type: 'POST',
            url: 'https://swarangi-app.herokuapp.com/api/todo/status',
            dataType: "json",
            data: JSON.stringify(data),
            cache: false,
            processData: false,
            contentType: "application/json", //Important else data will pass as null
            headers: {
                "Authorization": 'Bearer ' + token,
            },
            success: function(data) {

                console.log('success');

                var updated_array = data['data'];
                var updated_status = updated_array['status'];
                var updated_id = updated_array['id'];

                console.log(updated_array);
                console.log(updated_status);
                console.log(updated_id);

                if (updated_status == 'Done') {

                    document.getElementById(updated_id + 'status').innerHTML = 'Done';

                    document.getElementById('status' + updated_id).value = 'Pending';

                    document.getElementById('status' + updated_id).innerHTML = 'Pending';

                    document.getElementById('status' + updated_id).className = 'btn btn-dark';

                    console.log("Im if");


                } else {
                    document.getElementById(updated_id + 'status').innerHTML = 'Pending';

                    document.getElementById('status' + updated_id).value = 'Done';

                    document.getElementById('status' + updated_id).innerHTML = 'Done';

                    document.getElementById('status' + updated_id).className = 'btn btn-success';

                    console.log("Im else");

                }
            },

            error: function(xhr, status, error) {
                var err = eval("(" + xhr.responseText + ")");
                alert(err.Message);
            }
        });
    }
</script>
@stop
@endsection
