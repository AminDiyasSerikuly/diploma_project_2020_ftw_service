@extends('eziocms.base')
@section('content_head')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Категория: ключи</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Главная</a></li>
            <li class="breadcrumb-item">Настройка контента</li>
            <li class="breadcrumb-item active">Категория: ключи</li>
        </ol>
    </div>
</div>
@endsection
@section('content')
<div class="row">
	<div class="col-lg-12">
	    <div class="card">
	        <div class="card-body">
	            <h4 class="card-title">Категория: ключи</h4>
	            <button data-toggle="modal" data-target=".filtr" class="btn btn-success pull-right">Фильтр</button>
	            <button data-toggle="modal" data-target=".add" class="btn btn-info pull-right" style="margin-right: 5px;">Добавить</button>	            
	            <br />
	            <br />
	            <div class="modal fade add" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myLargeModalLabel">Добавить язык</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                            	<form method="post" id="add" action="{{ route('eziocmscategorykeyadd') }}">
                            		@csrf
	                                <div class="form-group">
	                                    <label class="control-label">Ключ</label>
	                                    <input type="text" name="key" class="form-control">
	                                </div>
	                                <div class="form-group">
	                                    <label class="control-label">Язык</label>
	                                    <select name="cat_id" class="form-control">
	                                    	@forelse($category as $l)
	                                    	<option value="{{ $l->id }}">{{ $l->name }}</option>
	                                    	@empty
	                                    	<option value="">Язык не добавлен</option>	                                    	
	                                    	@endforelse
	                                    </select>
	                                </div>
	                                <div class="form-group">
	                                    <label class="control-label">Язык</label>
	                                    <select name="lang" class="form-control">
	                                    	@forelse($lang as $l)
	                                    	<option value="{{ $l->param }}">{{ $l->lang }}</option>
	                                    	@empty
	                                    	<option value="">Язык не добавлен</option>	                                    	
	                                    	@endforelse
	                                    </select>
	                                </div>
	                            </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Закрыть</button>
                                <button type="button" class="btn btn-info waves-effect text-left" data-dismiss="modal" onclick="document.getElementById('add').submit();">Добавить</button>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                </div>
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
	                            <th>Ключ</th>	
	                            <th>Категория</th>
	                            <th>Язык</th>
	                            <th></th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                    	@forelse($categories as $cat)
	                        <tr>
	                            <td>{{ $cat->id }}</td>
	                            <td>{{ $cat->key }}</td>
	                            <td>{{ $cat->cat_name }}</td>
	                            <td>{{ $cat->lang }}</td>
	                            <td><a href="{{ route('eziocmscategorykeyupdate', $cat->id) }}" class="label label-info">Изменить</a> <a href="{{ route('eziocmscategorykeyadelete',$cat->id) }}" class="label label-danger">Удалить</a></td>
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
	                {{ $categories->links() }}
	            </div>
	        </div>
	    </div>
	</div>
</div>
@endsection