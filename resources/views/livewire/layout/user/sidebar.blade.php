<?php

use App\Livewire\Auth\Actions\Logout;
use Livewire\Volt\Component;
use App\Models\Area;
use App\Models\Requirement;
use App\Models\Category;
use App\Models\TypeProcedure;

new class extends Component
{   
    public int $procedure_count = 0;
    public int $user_count = 0;
    public int $category_count = 0;
    public int $area_count = 0;
    public int $requirement_count = 0;
    public int $type_proc_count = 0;

    public function mount(){
        $this->area_count = Area::count();
        $this->category_count = Category::count();
        $this->requirement_count = Requirement::count();
        $this->type_proc_count = TypeProcedure::count();
    }

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

@php
    $links = [
        ['title' => 'Inicio', 'icon' => 'fa-solid fa-home', 'url' => route('user.dashboard'), 'active' => request()->routeIs('user.dashboard'), 'can' => 'admin.procedures.index', 'count' => $this->procedure_count],
        ['title' => 'Trámites', 'icon' => 'fa-solid fa-folder-closed', 'url' => route('user.procedures.index'), 'active' => request()->routeIs('user.procedures.index'), 'can' => 'admin.procedures.index', 'count' => $this->procedure_count],
    ];
@endphp

<aside class="inset-y-0 transition-all transform flex-col -translate-x-full lg:translate-x-0 lg:z-auto lg:static max-h-screen bg-[#343A40] flex-shrink-0 w-[250px] left-0 top-0 bottom-0 float-none overflow-y-auto overflow-hidden scroll z-20 fixed" x-transition:enter="transition transform duration-300" x-transition:enter-start="-translate-x-full opacity-30  ease-in" x-transition:enter-end="translate-x-0 opacity-100 ease-out" x-transition:leave="transition transform duration-300" x-transition:leave-start="translate-x-0 opacity-100 ease-out" x-transition:leave-end="-translate-x-full opacity-0 ease-in" :class="{'-translate-x-full lg:translate-x-0 lg:w-[4.6rem]': !isSidebarOpen}">
  <a href="{{ route('user.dashboard') }}" wire:navigate class="self-center justify-center content-center top-0 overflow-hidden w-full bg-[#F7F7F7] flex py-[0.8125rem] px-[0.5rem] whitespace-nowrap" :class="isSidebarOpen ? 'block' : 'hidden'">
    <x-application-logo class="h-[29px] -mb-1 -mt-1 float-none ml-0 max-h-8" />
  </a>
  <a href="{{ route('user.dashboard') }}" wire:navigate class="self-center justify-center content-center top-0 overflow-hidden w-full bg-[#F7F7F7] flex py-[0.8125rem] px-[0.5rem] whitespace-nowrap" :class="isSidebarOpen ? 'hidden' : 'block'">
    <x-application-icon class="h-[29px] -mb-1 -mt-1 float-none ml-0 max-h-8" />
  </a>
  <div class="px-2 space-y-[0.2rem]">
    <div href="#" class="pb-4 mt-4 mb-4 border-b overflow-hidden whitespace-nowrap relative flex border-[#4f5962]">
      <div class="inline-block pl-[0.8rem]">
        <img src="https://secure.gravatar.com/avatar/00000000000000000000000000000000?s=80&r=g&d=identicon&f=y" alt="User Image" class="rounded-full shadow-md w-[30px] h-[30px]">
      </div>
      <div class="inline-block py-[5px] pl-[10px] pr-[5px]" :class="isSidebarOpen ? '' : 'hidden'">
        <a href="" class="block text-[#c2c7d0] text-sm">
          <div x-data="{ name: '{{ auth()->user()->name }}' }" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
        </a>
      </div>
    </div>
    <nav class="relative mt-2">
      <ul class="flex flex-col flex-wrap pb-0 pl-0 list-none nav-header lg:whitespace-nowrap lg:overflow-hidden">
        @foreach ($links as $index=>$link)
          <li class="mb-0">
            <a href="{{ $link['url'] }}" wire:key='"{{ $index }}' wire:navigate class="mb-[0.2rem] py-[0.3rem] px-[0.8rem] rounded block relative cursor-pointer {{ $link['active'] ? 'bg-[#3C8DBC] text-white' : 'text-[#c2c7d0] hover:text-white hover:bg-[#494E53]' }}">
              <p class="inline-block m-0">
                <i class="{{ $link['icon'] }} ml-[0.05rem] mr-[0.2rem] text-[1.1rem] w-[1.6rem] text-center"></i>
              </p>
              <p class="m-0 inline-block text-[.875rem]" :class="isSidebarOpen ? '' : 'hidden'">{{ $link['title'] }}</p>
              <small class="text-[62%] bg-[#28a745] text-white leading-[1] py-[0.20em] px-[0.4em] rounded text-center whitespace-nowrap align-baseline inline-block absolute right-4 top-[0.7rem] font-medium">{{ $link['count'] }}</small>
            </a>
          </li>
        @endforeach
      </ul>
    </nav>
  </div>
</aside>