@extends('eziocms.base')
@section('content_head')
<div class="row page-titles">
    <div class="col-md-5 align-self-center">
        <h3 class="text-themecolor">Логы: СМС</h3>
    </div>
    <div class="col-md-7 align-self-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Главная</a></li>
            <li class="breadcrumb-item">Логы</li>
            <li class="breadcrumb-item active">Логы: СМС</li>
        </ol>
    </div>
</div>
@endsection
@section('content')
<div class="row">
	<div class="col-lg-12">
	    <div class="card">
	        <div class="card-body">
	            <h4 class="card-title">Логы: СМС</h4>
	            <a href="{{ route('eziocmsclearsmslog') }}" class="brn brn-warning">Отчистить логи</a>
	            <div class="table-responsive">
	                <table class="table color-table inverse-table table-striped">
	                    <thead>
	                        <tr>
	                            <th>#</th>
	                            <th>Дата</th>	
	                            <th>Тел.</th>
	                            <th>Сообщения</th>
	                            <th>Ответ</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                    	@forelse($log as $l)
	                        <tr>
	                            <td>{{ $l->id }}</td>
	                            <td>{{ $l->created_at }}</td>
	                            <td>{{ $l->phone }}</td>
	                            <td>{{ $l->message }}</td>
	                            <td>{{ $l->respons }}</td>
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
	                {{ $log->links() }}
	            </div>
	        </div>
	    </div>
	</div>
</div>
@endsection