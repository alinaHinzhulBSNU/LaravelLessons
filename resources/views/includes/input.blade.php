<label for="{{ $fieldId }}">{{ $labelText }}</label>
<input type="text" 
		class="form-control {{ $errors->has($fieldId) ? 'is-invalid':'' }}" 
		name="{{ $fieldId }}" 
		id="{{ $fieldId }}" 
		placeholder="{{ $placeholderText }}"

@isset($fieldValue)
	value="{{ old($fieldId) ? old($fieldId) : $fieldValue }}"
@else
	value="{{ old($fieldId) }}"
@endisset
>