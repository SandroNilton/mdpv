<x-admin-layout>
  <div class="py-[10px] px-2">
    <div class="w-full px-[7.5px] mx-auto">
      <div class="flex flex-wrap mb-2 -mx-[7.5px] justify-between">
        <div class="col-span-6 text-lg text-[#212529]">
          <h1 class="m-0"></h1><h1>Perfil</h1>
        </div>
      </div>
    </div>
  </div>
  <section class="px-2">
    <div class="grid gap-3.5 sm:grid-cols-1 md:grid-cols-2 mb-4">
      <livewire:pages.admin.profile.update-profile-information-form />
      <livewire:pages.admin.profile.update-password-form />
    </div>
  </section>
</x-admin-layout>
