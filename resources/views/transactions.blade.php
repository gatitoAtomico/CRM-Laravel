@extends('layouts.master')

@section('title', 'Transactions Page')

@section('sidebar')
    @parent
@stop

@section('content')
    <div id="content">
        <div class="row">
            <div class="col-md-5">
                <form method="post" action="{{url('transactions')}}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="title">Add Transaction</label>
                        <input type="text" placeholder="Add a number between 1 and 5000" class="form-control"
                               id="amount" name="amount" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="col-md-7">

                    <table id="transactionsTable" class="table table-striped">
                        <thead>
                        <tr>
                            <td>Amount</td>
                            <td>Transaction Date</td>
                            <td>Delete</td>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($transactions as $transaction)
                            <tr id="{{$transaction->id}}">
                                <td>{{ $transaction->amount }}</td>
                                <td>{{ $transaction->created_at }}</td>
                                <td>
                                    <a class="btn-sm btn-danger" href="javascript:checkDelete({{$transaction->id}});">Remove</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>

    @if ($errors->any())
        <script>$('#errorModal').modal('toggle');</script>
    @endif

    @if(Session::has('error') or $errors->any())
        <script>$('#errorModal').modal('toggle');</script>
    @endif

    <!-- will be used to show messages -->
    @if(!empty($message))
        <script>$('#infoModal').modal('toggle');</script>
    @endif
@stop


<script>

    function checkDelete(id) {
        if (confirm('Really delete?')) {
            $.ajax({
                type: "DELETE",
                url: '{{ route('transactions.destroy', '') }}/' + id,
                data: {_token: '{{ csrf_token() }}'},
                success: function (result) {
                    $('#' + result).remove();
                    $('#message').addClass("alert alert-info").text("Successfully removed");
                    $('#infoModal').modal('show');
                }
            });
        }
    }

</script>

