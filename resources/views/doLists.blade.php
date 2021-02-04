@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ $name_page }}</div>

                <div class="card-body">
                    <div class="row my-3">
                        <div class="col-md-6">
                            <a class="btn btn-info" href="{{ route('do-lists-create') }}">Создать задание</a>
                            <a class="btn btn-info buttonSubmitImport" href="#">Импорт заданий</a>
                            <a class="btn btn-info" href="{{ route('export-file-do') }}">Экспорт заданий</a>
                            <form style="display: none;" id="doImportForm" action="{{ route('import-file-do') }}" method="POST" enctype="multipart/form-data">
                              @csrf
                              <input name="importFile" class="importFileImport" type="file">
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive"> 
    <table class="table sortable-t">
        <thead>
            <tr>
                <th>Создано</th>
                <th>Название</th>
                <th>Дело</th>
                <th>Статус</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($do_lists as $do)
                <tr data-id="{{$do->id}}">
                    <td> <i class="bi-arrows-move move-handler"></i> {{ date('d.m.Y', strtotime($do->created_at) ) }}</td>
                    <td>{{ $do->name }}</td>
                    <td>{{ $do->do }}</td>
                    <td>{{ $do->status }}</td>
                    <td class="action-edit">
                        <a href="{{ route('do-lists-edit', $do->id) }}"><i class="bi-pen"></i></a>
                        <a href="#" data-toggle="modal" data-target="#deleteItemModal{{$do->id}}"><i class="bi-file-earmark-x"></i></a>
                        <div class="modal fade" id="deleteItemModal{{$do->id}}" tabindex="-1" role="dialog">
                          <div class="modal-dialog" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title">Удалить задачу</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                          <div class="modal-body">
                            <p>Удалить задачу?</p>
                        </div>
                        <div class="modal-footer">
                            <a class="btn btn-primary" href="{{ route('do-lists-delete', $do->id) }}">Удалить</a>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                        </div>
                    </div>
                </div>
            </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

<script>
        $(document).ready(function(){

          $('.importFileImport').on('change', function(){
            $('#doImportForm').submit();
          });

          $('.buttonSubmitImport').on('click', function(){
            $('#doImportForm').find('.importFileImport').click();
          });

        function updateToDatabase(idString){
           $.ajaxSetup({ headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'}});
            
           $.ajax({
              url:'{{url('/do-lists/order')}}',
              method:'POST',
              data:{ids:idString},
              //success:function(){
                 //alert('Successfully updated')
                 //do whatever after success
              //}
           })
        }

        var helper = function(e, ui) {
            ui.children().each(function() {
            $(this).width($(this).width());
            });
            return ui;
        }

        var target = $('.sortable-t tbody');
        target.sortable({
            handle: '.move-handler',
            revert: 100,
            placeholder: 'highlight',
            axis: "y",
            update: function (e, ui){
               var sortData = target.sortable('toArray',{ attribute: 'data-id'});
               console.log(sortData);
               updateToDatabase(sortData.join(','));
            }
        })
        
    });
    </script>

@endsection