<textarea v-validate="'{{$validations}}'" class="control" id="{{ $name }}" name="{{ $name }}" data-vv-as="&quot;{{ $errorName }}&quot;">{{ old($name) ?: $value }}</textarea>
