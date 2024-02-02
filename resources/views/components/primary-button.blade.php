<button {{ $attributes->merge(['type' => 'submit', 'class' => 'text-[.875rem] cursor-pointer text-white bg-[#337ab7] border-[#337ab7] inline-block font-normal text-center align-middle py-[0.375rem] px-[0.75rem] leading-6 rounded']) }}>
    {{ $slot }}
</button>
