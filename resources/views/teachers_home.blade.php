@extends('layouts.app')
@section('page-title','Student List')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="students-table" class="table table-bordered dt-responsive nowrap"
                           data-url="{{route('teachers.home.list')}}"
                           style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th style="width:2%;">#</th>
                            <th>Reg No</th>
                            <th>Class</th>
                            <th>Student</th>
                            <th>Address</th>
                            <th>Activites</th>
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
    <script src="{{ asset('assets/app/js/teachers_home.js')}}"></script>
@endpush
