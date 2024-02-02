@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-[.875rem] mb-[0.5rem] text-[#495057]']) }}>
    {{ $value ?? $slot }}
</label>
