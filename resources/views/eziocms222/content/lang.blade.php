@extends('eziocms.base')
@section('content_head')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Языки</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Главная</a></li>
            <li class="breadcrumb-item">Настройка контента</li>
            <li class="breadcrumb-item active">Языки</li>
        </ol>
    </div>
</div>
@endsection
@section('content')
<div class="row">
	<div class="col-lg-6">
	    <div class="card">
	        <div class="card-body">
	            <h4 class="card-title">Языки</h4>
	            <button data-toggle="modal" data-target=".bs-example-modal-lg" class="btn btn-info pull-right">Добавить</button>
	            <br />
	            <br />
	            <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myLargeModalLabel">Добавить язык</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                            	<form method="post" id="lang" action="{{ route('eziocmsnewlangs') }}">
                            		@csrf
	                                <div class="form-group">
	                                    <label class="control-label">Язык</label>
	                                    <input type="text" name="lang" class="form-control">
	                                </div>
	                                <div class="form-group">
	                                    <label class="control-label">Парам</label>
	                                    <input type="text" name="param" class="form-control">
	                                </div>
	                            </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Закрыть</button>
                                <button type="button" class="btn btn-info waves-effect text-left" data-dismiss="modal" onclick="document.getElementById('lang').submit();">Добавить</button>
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
	                            <th>Язык</th>
	                            <th>Парам</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                    	@forelse($langs as $l)
	                        <tr>
	                            <td>{{ $l->id }}</td>
	                            <td>{{ $l->lang }}</td>
	                            <td>{{ $l->param }}</td>
	                        </tr>
	                        @empty
	                        Нет данных!
	                        @endforelse
	                    </tbody>
	                </table>
	            </div>
	        </div>
	    </div>
	</div>
</div>
@endsection