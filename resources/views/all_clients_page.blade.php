@extends('layouts.index')

@section('title-block')
    Наши клиенты
@endsection

@section('content')

    <h1>Список клиентов</h1>
    <div style="margin-top: 100px">
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Фамилия</th>
                <th scope="col">Имя</th>
                <th scope="col">Email</th>
                <th scope="col">Номер</th>
                <th scope="col">Автомобили клиента</th>
                <th scope="col">Изменить данные</th>
                <th scope="col"></th>
            </tr>
            </thead>

            @foreach($users as $user => $value)
                <tr>
                    <td>
                        {{ $value -> lastname }}
                    </td>
                    <td>
                        {{ $value -> name }}
                    </td>
                    <td>
                        {{ $value -> email }}
                    </td>
                    <td>
                        {{ $value -> phone }}
                    </td>
                    <td>
                        <a href="{{route('users.show' , $value->id)}}" class="btn btn-secondary">Просмотр
                            атомобиля(ей)</a>
                    </td>
                    <td>
                        <a href="{{route('users.edit' , $value->id )}}" class="btn btn-secondary">Изменить данные</a>
                    </td>
                    <td>
                        <form method="POST" action="{{route('users.destroy' , $value->id )  }}">
                            @csrf()
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
    <div>
        {{ $users->links() }}
    </div>
@endsection
