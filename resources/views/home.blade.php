@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Последние действия</div>

                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                            <th>Пользователь</th>
                            <th>Действие</th>
                            <th>Дата</th>
                        </thead>

                        <tbody>
                            @foreach ($logs as $log)
                            <tr>
                                
                                <td>{{ $log->user->name }}</td>
                                <td>{{ $log->description }}</td>
                                <td>{{ $log->created_at->format('d/m/Y') }}</td>
                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $logs->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
