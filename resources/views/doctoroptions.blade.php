  <option disabled selected>-- Choose Doctor--</option>
  @if (!empty($doctors))
      @foreach ($doctors as $doctor)
          <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
      @endforeach
  @endif
