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
	            <div class="table-responsive">
	            	@foreach($catkey as $ck)
	                <form method="post" action="{{ route('eziocmscategorykeyupdated') }}">
                		@csrf		
                        <div class="form-group">
                            <label class="control-label">Ключ</label>
                            <input type="text" name="key" class="form-control" value="{{ $ck->key }}">
                        </div>
                        <div class="form-group">
                            <label class="control-label">Язык</label>
                            <select name="cat_id" class="form-control">
                            	@forelse($category as $l)
                            	@if($l->id==$ck->cat_id)
                            	<option value="{{ $l->id }}" selected="selected">{{ $l->name }}</option>
                            	@else
                            	<option value="{{ $l->id }}" selected="selected">{{ $l->name }}</option>
                            	@endif
                            	@empty
                            	<option value="">Язык не добавлен</option>	                                    	
                            	@endforelse
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Язык</label>
                            <select name="lang" class="form-control">
                            	@forelse($lang as $l)
                            	@if($l->lang==$ck->lang)
                            	<option value="{{ $l->param }}" selected="selected">{{ $l->lang }}</option>
                            	@else
                            	<option value="{{ $l->param }}">{{ $l->lang }}</option>
                            	@endif
                            	@empty
                            	<option value="">Язык не добавлен</option>	                                    	
                            	@endforelse
                            </select>
                        </div>
                    </form>
                    @endforeach
	            </div>
	        </div>
	    </div>
	</div>
</div>
@endsection