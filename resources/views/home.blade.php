@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        @if (count($events) > 0)
            @foreach($events as $event)
                <div class="row justify-content-center mb-3">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class=" col-md-9">{{ $event->name }}</div>
                                    <div class="col-md-3 float-right text-primary">Дата
                                        проведения: {{ date("d.m.Y",strtotime($event->date)) }}</div>
                                </div>
                            </div>
                            <div class="card-body">
                                <hr>
                                <a href="" class="btn btn-md btn-success mb-3 float-right" role="button"
                                   data-toggle="modal" data-target="#modal_01">Добавить тему</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    {{--Модальное окно добавления новой темы --}}
    <div class="modal" tabindex="-1" role="dialog" id="modal_01">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Новая тема</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{  route ('create_event') }}" method="POST" class="form-horizontal">
                        @csrf
                        <div class="form-group row">
                            <label for="name"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Наименование темы') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name='name'
                                       value="{{ isset($events->name) }}" placeholder="Введите наименование"
                                       autofocus required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="date"
                                   class="col-md-4 col-form-label text-md-right">{{ __('Статус темы') }}</label>
                            <div class="col-md-6">
                                <select id="status" class="form-control" name="status">
                                    @foreach($statuses as $status)
                                        <option value="{{ $status->id }}"
                                                @if ($status->id == old('manager', "<div id='selected'></div>" ))
                                                selected='selected'
                                            @endif>{{ $status->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div id="access_table">
                            <hr>
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">id</th>
                                    <th scope="col">Фамилия</th>
                                    <th scope="col">Имя</th>
                                    <th scope="col">Доступ к теме</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>@fat</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>Larry</td>
                                    <td>the Bird</td>
                                    <td>@twitter</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-primary">Добавить</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>




@endsection
