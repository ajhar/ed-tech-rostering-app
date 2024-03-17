@extends('layouts.app')
@section('page-title')
    Name: {!! $student->name !!}<br>
    Class: {!! $student->student->classRoom->name !!}
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table id="activities-table" class="table table-bordered dt-responsive nowrap"
                           data-url="{{route('students.home.list')}}"
                           style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th style="width:2%;">#</th>
                            <th>Subject</th>
                            <th>Activity</th>
                            <th>Score</th>
                            <th>Grade</th>
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
    <script src="{{ asset('assets/app/js/students_home.js')}}"></script>
@endpush
