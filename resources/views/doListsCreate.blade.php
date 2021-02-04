@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ $name_page }}</div>

                <div class="card-body">
                    <form action="{{ route('do-lists-create') }}" method="POST">
                        @csrf
                      <div class="form-group">
                        <label for="DoName">Название</label>
                        <input name="name" type="text" class="form-control" id="DoName" aria-describedby="nameHelp">
                        <small id="nameHelp" class="form-text text-muted">Название нового задания (дела)</small>
                    </div>
                    <div class="form-group">
                        <label for="doDescription">Описание задачи</label>
                        <textarea name="do" class="form-control" id="doDescription" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="DoStatus">Статус задание</label>
                        <select name="status" class="form-control" id="DoStatus">
                          <option value="В работе">В работе</option>
                          <option value="Выполнено">Выполнено</option>
                          <option value="Ожидает">Ожидает</option>
                      </select>
                  </div>
                    <button type="submit" class="btn btn-success">Создать</button>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
