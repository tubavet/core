@extends('adm.layout')

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header">
                <h3 class="box-title ">
                    Create New Member Role
                </h3>
            </div><!-- /.box-header -->
            <div class="box-body">

                @if(isset($role))
                    {{ Form::model($role, ['route' => ['adm.mship.role.update', $role->role_id]]) }}
                @else
                    {{ Form::open(["route" => "adm.mship.role.create"]) }}
                @endif

                <div class="form-group">
                    {{ Form::label("name", "Name") }}
                    {{ Form::text("name", null, ["class" => "form-control"]) }}
                </div>



                <div class="form-group">
                    {{ Form::label("default", "Default?") }}

                    <div class="radio">
                        <label>
                            {{ Form::radio("default", 1) }}
                            YES - <span class="help-inline warning">Choosing this will disable the current default group.</span>
                        </label>
                    </div>

                    <div class="radio">
                        <label>
                            {{ Form::radio("default", 0) }}
                            NO
                        </label>
                    </div>
                </div>

                @if(Auth::admin()->get()->hasPermission("adm/mship/permission/assign"))
                    <div class="form-group">
                        {{ Form::label("permissions[]", "Permissions") }}
                        <div class="row">
                            @foreach($permissions as $p)
                                <div class="col-sm-4">
                                    <div class='checkbox'>
                                        @if(isset($role))
                                            {{ Form::checkbox("permissions[".$p->permission_id."]", $p->permission_id, ($role->hasPermission($p) OR Input::old("permissions.".$p->permission_id) ? "checked='checked'" : "")) }}
                                        @else
                                            {{ Form::checkbox("permissions[".$p->permission_id."]", $p->permission_id, (Input::old("permissions.".$p->permission_id) ? "checked='checked'" : "")) }}
                                        @endif
                                        {{ $p->display_name }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="btn-toolbar">
                    <div class="btn-group pull-right">
                        {{ Form::submit((isset($role) ? "Update" : "Create")." Role", ["class" => "btn btn-primary"]) }}
                    </div>
                </div>

                {{ Form::close() }}
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div>
</div>
@stop

@section('scripts')
@parent
{{ HTML::script('/assets/js/plugins/datatables/dataTables.bootstrap.js') }}
@stop