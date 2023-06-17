@extends('layouts.index')


@section('title-block')
    Машины {{$user->family}}
    {{isset($message) ? $message : Null  }}
@endsection

@section('content')
    <h1>Машины {{$user->family}}</h1>

    <div>
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Марка</th>
                <th scope="col">Модель</th>
                <th scope="col">Цвет</th>
                <th scope="col">Номер</th>
                <th scope="col">Изменить</th>
                <th scope="col">Удалить</th>
            </tr>
            </thead>

            @foreach($autos as $auto => $value)
                <tr>
                    <td>
                        {{ $value -> mark }}
                    </td>
                    <td>
                        {{ $value -> model }}
                    </td>
                    <td>
                        {{ $value -> color }}
                    </td>
                    <td>
                        {{ $value -> gos_number }}
                    </td>
                    <td>
                        <a href="{{route('ss' , $value->id)}}" class="btn btn-secondary">Изменить данные</a>
                    </td>
                    <td>
                        <form method="POST" action="{{route('autos.destroy' ,  $value->id )  }}">
                            @csrf()
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>

    <a href="{{route('autos.create',$user) }}" class="btn btn-secondary">Добавить автомобиль</a>
@endsection
