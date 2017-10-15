@extends('layouts.admin')

@section('admin-content')
<div class="box-header">
    <h3 class="box-title">{{ $group->name }}</h3>
    <div class="pull-right">
        <button type="button" class="btn btn-primary" title="{{ trans('projects.create') }}" data-toggle="modal" data-target="#project"><span class="ion ion-plus-round"></span> {{ trans('projects.create') }}</button>
    </div>
</div>
<div class="box-body" id="no_projects">
    <p>{{ trans('projects.none') }}</p>
</div>

<div class="box-body table-responsive" id="project_list">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>{{ trans('projects.name') }}</th>
                <th>{{ trans('projects.repository') }}</th>
                <th>{{ trans('projects.branch') }}</th>
                <th>{{ trans('projects.deployed') }}</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>
    {!! $projects_raw->render() !!}
</div>
@include('admin._dialogs.project')
@stop

@push('javascript')
<script type="text/javascript">
    var projects = {!! $projects !!}

    new app.ProjectsTab();
    app.Projects.add(projects.data);
    app.group_id = {{ $group->id }};
    @if(isset($action) && $action == 'create')
    $('button.btn.btn-primary').trigger('click');
    @endif
</script>
@endpush

@push('templates')
<script type="text/template" id="project-template">
    <td><%- id %></td>
    <td><a href="/projects/<%- id %>"><%- name %></a></td>
    <td><%- repository %></td>
    <td><span class="label label-default"><%- branch %></span></td>
    <td>
        <% if (deploy) { %>
            <%- deploy %>
        <% } else { %>
            {{ trans('app.never') }}
        <% } %>
    </td>
    <td>
        <div class="btn-group pull-right">
            <button class="btn btn-default btn-edit" title="{{ trans('app.edit') }}" data-toggle="modal" data-target="#project"><i class="ion ion-compose"></i></button>
            <button class="btn btn-danger btn-trash" title="{{ trans('app.delete') }}" data-toggle="modal" data-target="#model-trash"><i class="ion ion-trash-a"></i></button>
        </div>
    </td>
</script>

<script type="text/template" id="project-sidebar-template">
    <li><a href="/projects/<%- id %>" id="sidebar_project_<%- id %>"><%- name %></a></li>
</script>
@endpush
