@extends('layouts.app')

@section('content')
<div class="container">
    <br>
    <div align="right"><a href="{{url('/crypto/create')}}" class="btn btn-success">Create News</a>
    <a href="{{url('/crypto/api')}}" class="btn btn-success" target="_blank">News APIs</a>
    </div>
    <br>
    @if(\Session::has('success'))
        <div class="alert alert-success">
        <p>{{ \Session::get('success') }}</p>
        </div>
    @endif
    <table class="table table-striped">
        <thead>
        <tr>
            <th>No</th>
            <th>Manage</th>
            <th>HeadLine</th>
            <th>Content</th>
            <td align="right">Image</td>
        </tr>
        </thead>
        <tbody>
        <?php $index=($page*5)-4 ?>
        @foreach($cryptos as $key=>$row)
        <tr>
            <td>{{$index}}</td>
            <td>
                <a href="{{action('CryptoController@edit', $row['id'])}}" class="btn btn-primary">
                    Edit
                </a>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalDel{{$index}}">Delete</button>
                <div class="modal fade" id="modalDel{{$index}}" role="dialog">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h4 class="modal-title">Confirm Delete</h4>
                        </div>
                        <div class="modal-body">
                        </div>
                        <div class="modal-footer">
                            <form method="post" class="delete_form" action="{{action('CryptoController@destroy', $row['id'])}}">
                                {{csrf_field()}}
                                <input type="hidden" name="_method" value="DELETE" />
                                <button type="submit" class="btn btn-danger">DELETE</button>
                            </form> 
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                    </div>
                </div>
            </td>
            <td>{{substr($row['headline'],0,50)}}</td>
            <td>{{substr($row['contents'],0,50)}}</td>
            <td align="right"><img src="/images/{{$row['imgpath']}}" width="50%"></td>
        </tr>
        <?php $index++; ?>
        @endforeach
        </tbody>
    </table> 
    {{ $cryptos->links() }}

</div>
@endsection