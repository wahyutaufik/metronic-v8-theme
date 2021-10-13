<select class="form-control form-control-solid"  name="{{ isset($name) ? $name : $self['name'] }}" data-control="select2" data-value="{{ @$value }}">
    <option value>Select {{ $self['label'] }}</option>
    @foreach ($self->optionData() as $key => $entry)
        <option value="{{ $self->optionValue($key,$entry) }}" {{ ($self->optionValue($key,$entry) == $value ? 'selected' : '') }}>
            {{ $self->optionLabel($key,$entry) }}
        </option>
    @endforeach
</select>