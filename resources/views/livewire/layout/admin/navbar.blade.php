<?php

use App\Livewire\Auth\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{   
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();
        $this->redirect('/', navigate: true);
    }
};

?>

<nav class="sticky top-0 left-0 bg-[#3C8DBC] right-0 z-10 flex flex-wrap items-center justify-between py-2 px-2 flex-row">
  <ul class="flex flex-row pl-0 mb-0 list-none">
    <li class="m-0">
      <a class="py-[0.5rem] px-4 text-[#ffffffbf] h-[1.93725rem] hover:text-white" data-widget="pushmenu" @click="isSidebarOpen = !isSidebarOpen" role="button"><i class="fas fa-bars text-[.875rem]"></i></a>
    </li>
  </ul>
  <ul class="flex flex-row items-center pl-0 mb-0 ml-auto space-x-4 list-none">
    <li class="m-0 sm:inline-block">
      <a class="text-sm h-[1.93725rem] py-[0.35rem] px-4 text-[#ffffffbf] relative hover:text-white" href="">
        <i class="fa-solid fa-rotate"></i>
        <span class="inline-block text-center whitespace-nowrap align-baseline rounded leading-[1] bg-[#ffc107] text-black text-[.6rem] py-[2px] px-1 absolute right-[5px] top-[9px]" id="count">10</span>
      </a>
      <a class="text-sm h-[1.93725rem] py-[0.35rem] px-4 text-[#ffffffbf] relative hover:text-white" href="">
        <i class="fa-solid fa-bell"></i>
        <span class="inline-block text-center whitespace-nowrap align-baseline rounded leading-[1] bg-[#ffc107] text-black text-[.6rem] py-[2px] px-1 absolute right-[5px] top-[9px]" id="count">5</span>
      </a>
    </li>
    <li class="m-0 sm:inline-block">
      <div x-data="{ isOpen: false }" class="text-sm h-[1.93725rem] py-[0.35rem] px-2 text-[#ffffffbf] relative hover:text-white block" @click="isOpen = !isOpen">
        <img src="https://secure.gravatar.com/avatar/00000000000000000000000000000000?s=80&r=g&d=identicon&f=y" class="-mt-1 leading-[10px] float-none rounded-full h-[1.7rem] cursor-pointer" alt="">
        <div x-show="isOpen" @click.away="isOpen = false" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90" 
            class="absolute right-0 z-20 w-48 mt-2 origin-top-right bg-white border shadow border-[#00000026]">
            <a href="{{ route('admin.profile') }}" wire:navigate class="block px-4 py-2 text-sm text-[#212529] capitalize transition-colors duration-300 transform hover:bg-gray-100">Perfil</a>
            <button wire:click="logout" class="w-full block px-4 py-2 text-left text-sm text-white capitalize bg-[#DC3545]">
              {{ __('Log Out') }}
            </button>
        </div>
      </div>
    </li>
  </ul>
</nav>
