@extends('layouts.app')
@section('page-title','Activities')
@section('top-buttons')
    <div class="col-md-4">
        <div class="float-right d-none d-md-block">
            <div class="dropdown">
                <button class="btn btn-light btn-rounded load-modal" data-url="{{route('activities.create')}}"
                        type="button">Add Activity
                </button>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="activities-table" class="table table-bordered dt-responsive nowrap"
                           data-url="{{route('activities.list')}}"
                           style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th style="width:2%;">#</th>
                            <th>Subject</th>
                            <th>Name</th>
                            <th>Max Score</th>
                            <th style="width:4%;"></th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('assets/app/js/activities.js')}}"></script>
@endpush
