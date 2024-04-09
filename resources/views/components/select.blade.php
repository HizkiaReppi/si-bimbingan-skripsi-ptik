{{-- 
    This component is used to create a select input field. 
    It accepts the following parameters:
    - placeholders: The placeholder text for the select input field.
    - key: The key of the select input field.
    - name: The name of the select input field.
    - options: The options for the select input field.
    - value: The value of the select input field.
    
    Example usage:
    <x-select placeholders="Choose a Lecturer" key="lecturer" name="lecturer_id" :options="$lecturers" :value="$student->lecturer_id" />
    
    The above code will create a select input field with the placeholder text "Choose a Lecturer", the key "lecturer", the name "lecturer_id", the options from the $lecturers variable, and the value from the $student->lecturer_id variable.
    
--}}
@props(['placeholders', 'key', 'name', 'options', 'value' => ''])

<select {{ $attributes->merge(['class' => 'form-select ' . ($errors->has($name) ? 'border-danger' : ''), 'name' => $name]) }}>
    <option value="choose" selected>{{ $placeholders }}</option>
    @foreach ($options as $option)
        @if (old($name, $value) == $option->id)
            <option value="{{ $option->id }}" selected>{{ $option->$key }}</option>
        @else
            <option value="{{ $option->id }}">{{ $option->$key }}</option>
        @endif
    @endforeach
</select>
