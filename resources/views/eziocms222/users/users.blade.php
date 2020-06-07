@extends('eziocms.base')
@section('content_head')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Пользователи</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Главная</a></li>
            <li class="breadcrumb-item active">Пользователи</li>
        </ol>
    </div>
</div>
@endsection
@section('content')
<div class="row">
	<div class="col-lg-12">
	    <div class="card">
	        <div class="card-body">
	            <h4 class="card-title">Пользователи</h4>
	            <button data-toggle="modal" data-target=".filtr" class="btn btn-success pull-right">Фильтр</button>           
	            <br />
	            <br />
                <div class="modal fade filtr" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myLargeModalLabel">Добавить язык</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                            	<form method="" id="filtr">
	                                <div class="form-group">
	                                    <label class="control-label">Найти</label>
	                                    <input type="text" name="find" class="form-control">
	                                </div>
	                            </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Закрыть</button>
                                <button type="button" class="btn btn-info waves-effect text-left" data-dismiss="modal" onclick="document.getElementById('filtr').submit();">Искать</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
	            <div class="table-responsive">
	                <table class="table color-table inverse-table table-striped">
	                    <thead>
	                        <tr>
	                            <th>#</th>
	                            <th>Ф.И.О</th>
	                            <th>Номер телефон</th>
	                            <th>Email</th>
	                            <th>Роль</th>
	                            <th>Дата регистрации</th>
	                            <th>Дата последный авторизации</th>
	                            <th>Номер подтверждён</th>
	                            <th>Количество созданных задач</th>
	                            <th>Количество выполненых из созданных задач</th>
	                            <th>Счёт</th>
	                            <th>Сумма активных заказов</th>
	                            <th>Сумма всех заказов</th>
	                            <th>Остаток на счёте</th>
	                            <th></th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                    	@forelse($users as $u)
	                        <tr>
	                            <td>{{ $u->id }}</td>
	                            <td><a href="{{ route('eziocmsprofile', $u->id) }}">{{ $u->fio }}</a></td>
	                            <td>{{ $u->phone }}</td>
	                            <td>{{ $u->uemail }}</td>
	                            <td>{{ $u->role }}</td>
	                            <td>{{ $u->cdate }}</td>
	                            <td>{{ $u->udate }}</td>
	                            <td>{{ $u->phone_access }}</td>
	                            <td>{{ $u->task_count }}</td>
	                            <td>{{ $u->done_task_count }}</td>
	                            <td>{{ $u->user_account }}</td>
	                            <td>{{ number_format($u->active_task__amount,2,',',' ') }}</td>
	                            <td>{{ number_format($u->all_task__amount,2,',',' ') }}</td>
	                            <td>{{ number_format($u->user_account_money,2,',',' ') }}</td>
	                            <td><a href="" class="badge badge-warning">Заблакировать</a></td>
	                        </tr>
	                        @empty
	                        <tr>
	                            <td></td>
	                            <td>Нет данных!</td>
	                            <td></td>
	                        </tr>
	                        @endforelse
	                    </tbody>
	                </table>
	                {{ $users->links() }}
	            </div>
	        </div>
	    </div>
	</div>
</div>
@endsection