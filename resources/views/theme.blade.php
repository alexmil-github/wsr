@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center mb-3">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-9 text-white"><h5><i class="fa fa-arrow-circle-right fa-fw"
                                                                    aria-hidden="true"></i>&nbsp;{{ $theme->name }}
                                </h5></div>
                            <div class="col-md-3 float-right text-light">Дата
                                проведения: <strong
                                    class="text-warning"></strong>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(count($messages)>0)
                            @foreach($messages as $message)
                                <div class="row justify-content-center ">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <ul class="list-group">
                                                <li class="list-group-item list-group-item-secondary ">
                                                    {{ $message->message }}

                                                </li>
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        @endif
                        <div id="messagesBlock" ></div>
                        <hr>
                        <form class="form-horizontal" id="addMessage">
                            @csrf
                            <textarea rows="1" class="form-control mb-3" type="text" id="message" name="message"
                                      required></textarea>
                            <input type="hidden" id="theme_id" name="theme_id" value={{ $theme->id }} >
                            <button type="submit" id="btnAddMessage" class="btn btn-md btn-my mb-3 float-right"
                                    role="button"><i class="fa fa-paper-plane fa-fw"
                                                     aria-hidden="true"></i> Ответить
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
