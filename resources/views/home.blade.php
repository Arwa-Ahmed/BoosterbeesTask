@extends('layouts.layout')

@section('title', __('Book Now'))
@section('head_title', __('Book Now'))

@section('content')
    <h2>BOOK AN APPOINTMENT</h2>
    <hr>
    <p>Please fill in your information and we will get back to you soon.</p>
    <form>
        <div class="col-sm-8 mx-auto">
            <div class="form-group ">
                <label for="name">{{ __('Name') }}</label>

                <input type="text" class="form-control" placeholder="{{ __('Name') }}" name="name" required>
            </div>
            <div class="form-group">
                <label for="mobile">{{ __('Mobile') }}</label>
                <div class="masked-input input-group">
                    <input type="text" class="form-control mobile-phone-number" id="mobile" name="mobile"
                        placeholder="Ex: 0 0000000000">
                </div>
                <div class="form-group ">
                    <label for="amount_of_codes">{{ __('Email') }}</label>

                    <input type="email" class="form-control" placeholder="{{ __('Email') }}" name="email">
                </div>
                <div class="form-group ">
                    <label for="city_id">{{ __('City') }}</label>
                    <input type="text" class="form-control" placeholder="{{ __('City') }}" name="city">

                </div>
                <div class="form-group ">
                    <label for="city_id">{{ __('Country') }}</label>
                    <input type="text" class="form-control" placeholder="{{ __('Country') }}" name="country">

                </div>
                <div class="form-group ">
                    <label for="specialty_id">{{ __('Specialty') }}</label>
                    <div class="form-group ">
                        <select class="form-control show-tick" name="specialty_id" id="specialty_id" required>
                            @forelse($specialties as $specialty)
                                <option value="{{ $specialty->id }}">{{ $specialty->name }}</option>
                            @empty
                            @endforelse
                        </select>
                    </div>
                </div>
                <div class="form-group ">
                    <label for="hospital_id">{{ __('Hospital') }}</label>
                    <div class="form-group ">
                        <select class="form-control show-tick" name="hospital_id" id="hospital_id" required>
                            <option disabled selected>-- Choose Hospital--</option>

                            @forelse($hospitals as $hospital)
                                <option value="{{ $hospital->id }}">{{ $hospital->name }}</option>
                            @empty
                            @endforelse
                        </select>

                    </div>
                </div>
                <div class="form-group ">
                    <label for="doctor_id">{{ __('Doctor') }}</label>
                    <div class="form-group ">
                        <select class="form-control show-tick" name="doctor_id" id="doctor_id" required
                            placeholder="Choose Doctor">
                            <option disabled selected>-- Choose Doctor--</option>
                        </select>

                    </div>
                </div>
            </div>
            <div class="form-group ">
                <label for="date">{{ __('Date Of Visit') }}</label>

                <input id="date" type="text" class="form-control" placeholder="{{ __('Date') }}" name="date"
                    required>
            </div>
            <br>
            <div class="form-group">
                <button class="btn btn-success" type="submit">Submit</button>
            </div>
    </form>
@endsection
@push('scripts')
    <script type="text/javascript">
        $(function() {
            $("select[name='hospital_id']").change(function() {
                var hospital_id = $(this).val();
                var token = $("input[name='_token']").val();
                $.ajax({
                    url: "<?php echo route('getdoctors'); ?>",
                    method: 'GET',
                    data: {
                        hospital_id: hospital_id,
                        _token: token
                    },
                    success: function(data) {
                        $("select[name='doctor_id'").html('');
                        $("select[name='doctor_id'").html(data.options);
                    }
                });
            });
            var enableddays = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];
            $("select[name='doctor_id']").change(function() {
                var doctor_id = $(this).val();
                var token = $("input[name='_token']").val();
                $.ajax({
                    url: "<?php echo route('getworkingdays'); ?>",
                    method: 'GET',
                    data: {
                        doctor_id: doctor_id,
                        _token: token
                    },
                    success: function(data) {
                        $("#date").val('');
                        enableddays = data.workingdays;
                        console.log(enableddays)
                        $("#date").datepicker("refresh");
                    }
                });
            });
            $("#date").datepicker({
                beforeShowDay: function(date) {
                    var day = date.getDay();
                    var dayname = $.datepicker.formatDate('DD', date).toLowerCase();
                    if ($.inArray(dayname, enableddays) !== -1) {
                        return [false, ""];
                    }
                    return [true, ""];
                }
            })
        })
    </script>
@endpush
