<input type="text" v-validate="'{{$validations}}'" class="control" id="{{ $name }}" name="{{ $fieldName }}[{{ $method }}][{{ $field['name'] }}]" value="{{ old($name) ?: $value }}" data-vv-as="&quot;{{ $errorName }}&quot;">







