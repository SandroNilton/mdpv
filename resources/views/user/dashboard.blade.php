<x-user-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}

                    <button type="button"
                    class="relative inline-flex flex-shrink-0 h-6 transition-colors duration-200 ease-in-out bg-gray-200 border-2 border-transparent rounded-full cursor-pointer w-11 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300"
                    @click="isSidebarOpen = !isSidebarOpen" 
                    :class="isSidebarOpen ? 'bg-green-400' : 'bg-gray-200'">
              <span class="inline-block w-5 h-5 transition duration-200 ease-in-out transform translate-x-0 bg-white rounded-full shadow pointer-events-none ring-0"
                    :class="isSidebarOpen ? 'translate-x-5' : 'translate-x-0'"></span>
            </button>
                </div>
            </div>
        </div>
    </div>
</x-user-layout>
