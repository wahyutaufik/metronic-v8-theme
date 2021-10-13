
<select class="form-control form-control-solid multi_reference" data-control="select2" name="{{ isset($name) ? $name : $self['name'] }}[]" multiple>
    @foreach ($self->optionData() as $key => $entry)
        <option value="{{ $self->optionValue($key,$entry) }}" {{ (!empty($value[$self->optionValue($key,$entry)]) ? 'selected' : '') }}>
            {{ $self->optionLabel($key,$entry) }}
        </option>
    @endforeach
</select>