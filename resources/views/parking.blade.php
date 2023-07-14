@extends('layouts.index')

@section('title-block')
    Парковка
@endsection

@section('content')
    <form method="post" action="{{route('auto')}}">
        @csrf
        <div style="width: 1000px; margin-left: 300px; margin-top: 100px">
            <h3>Выберите автомобиль</h3>
            <div class="form-group">
                <label>Владелец</label>
                <select class="form-control input-sm" name="category_id">
                    <option value="">--select--</option>
                    @foreach ($users as $row=>$value)
                        <option value="{{$value->id}}">{{$value->lastname}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group" style="position:relative">
                <label>Машины</label>
                <select class="form-control input-sm" name="subcategory_id"></select>
            </div>
            <button class="btn btn-secondary" type="submit" style="margin-top: 20px">Поставить авто на парковку</button>
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

        @csrf
        <script>
            $(function () {
                var loader = $('#loader'),
                    category = $('select[name="category_id"]'),
                    subcategory = $('select[name="subcategory_id"]');
                loader.hide();
                subcategory.attr('disabled', 'disabled')
                subcategory.change(function () {
                    var id = $(this).val();
                    if (!id) {
                        subcategory.attr('disabled', 'disabled')
                    }
                })

                category.change(function () {
                    var id = $(this).val();
                    if (id) {
                        loader.show();
                        subcategory.attr('disabled', 'disabled')
                        $.get('{{url('/dropdown-data?cat_id=')}}' + id)
                            .success(function (data) {
                                var s = '<option value="">---select--</option>';
                                data.forEach(function (row) {
                                    s += '<option value="' + row.id + '">' + row.mark + "   " + row.gos_number + '</option>'
                                })
                                subcategory.removeAttr('disabled')
                                subcategory.html(s);
                                loader.hide();
                            })
                    }
                })
            })
        </script>
    </form>
    <h1>  @foreach($auto as $aut=>$value)
            <ul class="list-group m-3 ">
                <li class="list-group-item">
                    {{$value->mark}} {{$value->model}} {{$value->color}} {{$value->gos_number}}
                    <a href="{{route('auto_out' , $value->id)}}" class="btn btn-secondary">Покинуть парковку</a>
                </li>
            </ul>
        @endforeach </h1>
@endsection

