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
<!-- Column -->
@foreach($user as $u)
<div class="row">
    <div class="col-lg-4 col-xlg-3 col-md-5">
        <div class="card">
            <div class="card-body">
                <center class="m-t-30"> <img src="{{ asset('assets/images/users/5.jpg') }}" class="img-circle" width="150" />
                    <h4 class="card-title m-t-10">{{ $u->fname.' '.$u->name.' '.$u->sname }}</h4>
                    <h6 class="card-subtitle">{{ $u->role }}</h6>
                    <div class="row text-center justify-content-md-center">
                        <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-chart"></i> <font class="font-medium">{{ $u->task_count }}</font></a></div>
                        <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-chart"></i> <font class="font-medium">{{ $u->task_count }}</font></a></div>
                    </div>
                </center>
            </div>
            <div>
                <hr> </div>
            <div class="card-body"> 
                @if($u->role!='1') <a href="" class="btn btn-sm btn-info">Сделать администратором</a> @else <a href="" class="btn btn-sm btn-info">Снять с администратора</a> @endif
                <a href="" class="btn btn-sm btn-warning">Заблокировать</a>
                <a href="" class="btn btn-sm btn-danger">Удалить</a><br /><br />
                <small class="text-muted">Счёт </small>
                <h6>{{ $u->user_account }}</h6> 
                <small class="text-muted">Email address </small>
                <h6>{{ $u->uemail }}</h6> 
                <small class="text-muted p-t-30 db">Phone</small>
                <h6>{{ $u->phone }}</h6> 
                <small class="text-muted p-t-30 db">Address</small>
                <h6>{{ $u->address }}</h6>
                 <small class="text-muted p-t-30 db">Social Profile</small>
                <br/>
                @if(App\Profile::getUserParam('user_fb')!='')<a href="{{ App\Profile::getUserParam('user_fb') }}" class="btn btn-circle btn-secondary"><i class="fa fa-facebook"></i></a>@endif
                @if(App\Profile::getUserParam('user_vk')!='')<a href="{{ App\Profile::getUserParam('user_vk') }}" class="btn btn-circle btn-secondary"><i class="fa fa-twitter"></i></a>@endif
                @if(App\Profile::getUserParam('user_instagram')!='')<a href="{{ App\Profile::getUserParam('user_instagram') }}" class="btn btn-circle btn-secondary"><i class="fa fa-youtube"></i></a>@endif
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-lg-8 col-xlg-9 col-md-7">
        <div class="card">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs profile-tab" role="tablist">
                <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab">Задачи</a> </li>
                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#dop" role="tab">Доп. инфо</a> </li>
                <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#transactions" role="tab">Транзакции</a> </li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active" id="home" role="tabpanel">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table color-table inverse-table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Названия</th>
                                        <th>Статус</th>
                                        <th>Исполнитель</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=0; ?>
                                    @forelse($tasks as $t)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ $t->task }}</td>
                                        <td>@if($t->status=='0') <label class="badge badge-success">Открытый</label> @else <label class="badge badge-danger">Закрытый</label> @endif</td>
                                        <td>{{ $t->status }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Нет данных!</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $tasks->links() }}
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="dop" role="tabpanel">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table color-table inverse-table table-striped">
                                <thead>
                                    <tr>
                                        <th>Параметр</th>
                                        <th>Значения</th>
                                    </tr>
                                </thead >
                                <tbody>
                                    <?php $i=0; ?>
                                    @forelse($userparam as $u)
                                    <tr>
                                        <td>{{ $u->meta_param }}</td>
                                        <td>{{ $u->meta_value }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="2" class="text-center">Нет данных!</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $tasks->links() }}
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="transactions" role="tabpanel">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table color-table inverse-table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Дата</th>
                                        <th>Сумма</th>
                                        <th>Назначения</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=0; ?>
                                    @forelse($tasks as $t)
                                    <tr>
                                        <td>{{ ++   $i }}</td>
                                        <td>{{ $t->task }}</td>
                                        <td>@if($t->status=='0') <label class="badge badge-success">Открытый</label> @else <label class="badge badge-danger">Закрытый</label> @endif</td>
                                        <td>{{ $t->status }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="text-center">Нет данных!</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $tasks->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection