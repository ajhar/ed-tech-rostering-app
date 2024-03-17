@extends('layouts.app')
@section('page-title','Profile')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="PUT" action="{{route('profile.update')}}" id="user-form" novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="input-name">Name</label>
                                <input type="text" name="name" class="form-control" id="input-employee-id"
                                       value="{{$user->name}}" required="">
                                <div class="invalid-feedback" id="name-error"></div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="input-email">Email</label>
                                <input type="text" name="email" class="form-control" id="input-email"
                                       value="{{$user->email}}"
                                       required>
                                <div class="invalid-feedback" id="email-error"></div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="input-password">Password</label>
                                <input type="password" name="password" class="form-control" id="input-password"
                                       placeholder="******">
                                <div class="invalid-feedback" id="password-error"></div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="input-country-id">Country</label>
                                <select class="selectize" name="country_id" id="input-country-id">
                                    @foreach($countries as $country)
                                        <option value="{{$country->id}}" {{ optional($user->userAttribute)->country_id == $country->id ? 'selected' : '' }}>
                                            {{$country->name}}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback" id="country-id-error"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="input-street1">Street1</label>
                                <input type="text" name="street1" class="form-control" id="input-street1"
                                       value="{{optional($user->userAttribute)->street1}}" required>
                                <div class="invalid-feedback" id="street1-error"></div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="input-street2">Street2</label>
                                <input type="text" name="street2" class="form-control" id="input-street2"
                                       value="{{optional($user->userAttribute)->street2}}" required="">
                                <div class="invalid-feedback" id="street2-error"></div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="input-city">City</label>
                                <input type="text" name="city" class="form-control" id="input-city"
                                       value="{{optional($user->userAttribute)->city}}" required>
                                <div class="invalid-feedback" id="city-error"></div>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label for="input-postal-code">Postal Code</label>
                                <input type="text" name="postal_code" class="form-control" id="input-postal-code"
                                       value="{{optional($user->userAttribute)->postal_code}}" required=>
                                <div class="invalid-feedback" id="postal-code-error"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="input-phone-number">Phone Number</label>
                                <input type="text" name="phone_number" class="form-control" id="input-phone-number"
                                       value="{{optional($user->userAttribute)->phone_number}}" required>
                                <div class="invalid-feedback" id="phone-number-error"></div>
                            </div>
                        </div>
                        <div class="mt-2">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('assets/app/js/profile.js')}}"></script>
@endpush
