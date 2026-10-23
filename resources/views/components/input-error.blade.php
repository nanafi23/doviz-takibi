@props(['for' => null, 'messages' => []])

@php
    $validationMessages = $for ? $errors->get($for) : (array) $messages;
@endphp

@if ($validationMessages)
    <ul {{ $attributes->merge(['class' => 'text-sm text-red-600']) }}>
        @foreach ($validationMessages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
