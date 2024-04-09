@props(['messages'])

@if ($messages)
    <ul style="font-size:12px;color:red;margin-top:3px">
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif