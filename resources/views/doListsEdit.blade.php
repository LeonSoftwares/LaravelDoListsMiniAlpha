@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ $name_page }}</div>

                <div class="card-body">
                    <form action="{{ route('do-lists-edit', $data->id) }}" method="POST">
                        @csrf
                      <div class="form-group">
                        <label for="DoName">Название</label>
                        <input name="name" type="text" value="{{ $data->name }}" class="form-control" id="DoName" aria-describedby="nameHelp">
                        <small id="nameHelp" class="form-text text-muted">Название нового задания (дела)</small>
                    </div>
                    <div class="form-group">
                        <label for="doDescription">Описание задачи</label>
                        <textarea name="do" class="form-control" id="doDescription" rows="3">{{$data->do}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="DoStatus">Статус задание</label>
                        <select name="status" class="form-control" id="DoStatus">
                          <option value="В работе" @if ($data->status == 'В работе') selected @endif >В работе</option>
                          <option value="Выполнено" @if ($data->status == 'Выполнено') selected @endif >Выполнено</option>
                          <option value="Ожидает" @if ($data->status == 'Ожидает') selected @endif >Ожидает</option>
                      </select>
                  </div>
                    <button type="submit" class="btn btn-success">Сохранить</button>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
