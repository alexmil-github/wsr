@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Панель администратора</div>

                    <div class="card-body">
                        <nav class="nav">
                            <a class="nav-link disabled" href="/admin">Категории форума</a>
                            <a class="nav-link active" href="/admin/events">Мероприятия</a>
                        </nav>
                        <br>
                        <h3>Указать категорию для форума</h3>
                        <hr>
                        <form action="category/" method="POST" class="form-horizontal">
                            @csrf
                            @method('PATCH')
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Наименование категории</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name='name' value="{{ old('name') }}" autocomplete="name" autofocus>
                                    <button type="reset" title="Click me to clear the input field">&times;</button>

                                </div>
                                <button class="btn btn-primary">Сохранить</button>

                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
