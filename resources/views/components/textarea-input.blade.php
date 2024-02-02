@props(['disabled' => false])

<textarea {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'py-[0.375rem] px-[0.75rem] text-sm font-normal bg-white bg-clip-padding border border-[#ced4da] rounded focus:border-[#80bdff] focus:text-[#495057] focus:outline-none focus:bg-white focus:ring-2 focus:ring-[#007bff40]']) !!}>
 {{ $slot }}
</textarea>