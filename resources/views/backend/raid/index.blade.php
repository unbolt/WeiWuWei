@extends('backend.layouts.master')

@section('page-header')
    <h1>
        {!! app_name() !!}
        <small>Raids</small>
    </h1>
@endsection

@section('content')
    <div class="box box-success">

        <div class="box-header with-border">
            <h3 class="box-title">Raids</h3>
        </div><!-- /.box-header -->

        <div class="box-body">
            <div>
                <a href="{{ route('admin.raid.create') }}" class="btn btn-primary">Add Raid</a>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Location</th>
                            <th>Tanks</th>
                            <th>Healers</th>
                            <th>DPS</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    @if($raids)
                        @foreach($raids as $raid)
                            <tr>
                                <td>{!! $raid->date !!}</td>
                                <td>{!! $raid->location !!}</td>
                                <td>{!! $raid->tankCount !!}</td>
                                <td>{!! $raid->healerCount !!}</td>
                                <td>{!! $raid->dpsCount !!}</td>
                                <td>
                                    <a href="{{ route('admin.raid.edit', $raid->id) }}" class="btn btn-xs btn-primary"><i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="Edit"></i></a>

                                    <a href="{{ route('admin.raid.destroy', $raid->id) }}"
                                         data-method="delete"
                                         data-trans-button-cancel="Cancel"
                                         data-trans-button-confirm="Delete Raid"
                                         data-trans-title="Are you sure?"
                                         class="btn btn-xs btn-danger"><i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="Delete"></i></a>

                                </td>
                            </tr>
                        @endforeach
                    @endif
                </table>
            </div>
        </div>
    </div>
@endsection
