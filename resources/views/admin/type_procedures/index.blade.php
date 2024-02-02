<x-admin-layout>
  <section class="px-2 py-4">
    <div class="flex flex-col bg-white border border-[#00000020] rounded shadow mb-4 card card-light">
      <div class="text-[#1f2d3d] bg-[#f8f9fa] border-b border-[rgba(0,0,0,0.13)] py-3 px-5 rounded-t relative justify-between flex">
        <h3 class="float-left m-0 text-base card-title">Tipo de trámites</h3>
        <div class="float-right -mr-[0.625rem]">
          <a href="{{ route('admin.type-procedures.create') }}" wire:navigate class="text-[#1f2d3d] text-[.875rem] bg-[#f8f9fa] hover:bg-[#e9ecef] border-[#ddd] border py-[0.25rem] px-[0.5rem] -my-[0.75rem] mx-0 cursor-pointer align-middle text-center inline-block rounded">Crear tipo de trámite</a>
        </div>
      </div>
      <div class="flex-auto p-5 card-body">
        <livewire:admin.table.typeprocedure.type-procedure-table />
      </div>
    </div>
  </section>
</x-admin-layout>
