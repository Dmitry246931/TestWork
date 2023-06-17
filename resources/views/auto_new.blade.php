@extends('layouts.index')

@section('title-block')
    Добавление нового авто
@endsection

@section('title')
    Добавить новый автомобиль
@endsection

@section('content')
    <form method="POST"
          @if(isset($auto))
              action="{{route('autos.update',$auto , $auto)}}">
        @csrf
        @else
            action="{{route('autos.store', $user) }}" >
            @csrf
        @endif

        @isset($auto)
            @method('put')
        @endisset

        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <div class="form-group ">
                        <label for="formGroupExampleInput">Марка Авто</label>
                        <input type="text" name="mark"
                               value="{{old('mark',isset($auto) ? $auto->mark : null)}}"
                               class="form-control " id="formGroupExampleInput" placeholder="Введите Марку Авто">
                        @if($errors->has('mark'))
                            <div class="small text-danger pt-1">
                                {{$errors->first('mark')}}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Модель</label>
                        <input type="text" name="model"
                               value="{{old('model',isset($auto) ? $auto->model : null)}}"
                               class="form-control" id="formGroupExampleInput2" placeholder="Введите Модель авто">
                        @if($errors->has('model'))
                            <div class="small text-danger pt-1">
                                {{$errors->first('model')}}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Цвет автомобиля</label>
                        <input type="text" name="color"
                               value="{{old('color',isset($auto) ? $auto->color : null)}}"
                               class="form-control" id="formGroupExampleInput2" placeholder="Введите Цвет автомобиля">
                        @if($errors->has('color'))
                            <div class="small text-danger pt-1">
                                {{$errors->first('color')}}
                            </div>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Гос. номер машины</label>
                        <input type="text" name="gos_number"
                               value="{{old('gos_number',isset($auto) ? $auto->gos_number : null)}}"
                               class="form-control" id="formGroupExampleInput2" placeholder="Введите Гос. номер машины">
                        @if($errors->has('gos_number'))
                            <div class="small text-danger pt-1">
                                {{$errors->first('gos_number')}}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group m-2">
            <button class="btn btn-secondary" type="submit"
                    style="margin-top: 20px">{{isset($auto) ? 'Сохранить'  : 'Добавить' }}</button>

            <a href="{{ url()->previous() }}" class="btn btn-secondary" style="margin-top: 20px">назад</a>
            </p>
        </div>
    </form>
@endsection
