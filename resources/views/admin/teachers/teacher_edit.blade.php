<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title mt-0">EditTeacher</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form method="PUT" action="{{route('teachers.update',$teacher->id)}}" id="teacher-form" novalidate>
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="input-name">Employee Id</label>
                        <input type="text" name="employee_id" class="form-control" id="input-employee-id"
                               value="{{$teacher->employee_id}}" required>
                        <div class="invalid-feedback" id="employee-id-error"></div>
                    </div>
                    <div class="col-md-8 mb-3">
                        <label for="input-name">Name</label>
                        <input type="text" name="name" class="form-control" id="input-name"
                               value="{{$teacher->user->name}}" required>
                        <div class="invalid-feedback" id="name-error"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="input-name">Email</label>
                        <input type="email" name="email" class="form-control" id="input-email"
                               value="{{$teacher->user->email}}" required>
                        <div class="invalid-feedback" id="email-error"></div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="input-name">Password</label>
                        <input type="password" name="password" class="form-control" id="input-password" required>
                        <div class="invalid-feedback" id="password-error"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="input-subject-id">Classes</label>
                        <select class="selectize" name="class_ids[]" id="input-class-ids" multiple>
                            @foreach($classes as $class)
                                <option
                                    value="{{$class->id}}" {{$teacher->classRooms->contains('id',$class->id)?'selected':''}}>
                                    {{$class->name}}
                                </option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback" id="class-ids-error"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="input-name">Street1</label>
                        <input type="text" name="street1" class="form-control" id="input-street1"
                               value="{{$teacher->userAttribute->street1}}" required>
                        <div class="invalid-feedback" id="street1-error"></div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="input-name">Street2</label>
                        <input type="text" name="street2" class="form-control" id="input-street1"
                               value="{{$teacher->userAttribute->street2}}" required>
                        <div class="invalid-feedback" id="street1-error"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="input-name">City</label>
                        <input type="text" name="city" class="form-control" id="input-city"
                               value="{{$teacher->userAttribute->city}}" required>
                        <div class="invalid-feedback" id="city-error"></div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="input-name">Postal Code</label>
                        <input type="text" name="postal_code" class="form-control" id="input-postal-code"
                               value="{{$teacher->userAttribute->postal_code}}" required>
                        <div class="invalid-feedback" id="postal-code-error"></div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="input-subject-id">Country</label>
                        <select class="selectize" name="country_id" id="input-country-id">
                            @foreach($countries as $country)
                                <option
                                    value="{{$country->id}}" {{$country->id == $teacher->userAttribute->country_id ?'selected':''}}>
                                    {{$country->name}}
                                </option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback" id="country-id-error"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="input-phone-number">Phone Number</label>
                        <input type="text" name="phone_number" class="form-control" id="input-phone-number"
                               value="{{$teacher->userAttribute->phone_number}}">
                        <div class="invalid-feedback" id="phone-number-error"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer d-flex justify-content-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" data-loading-text="Updating...">Update</button>
            </div>
        </form>
    </div><!-- /.modal-content -->
</div>
