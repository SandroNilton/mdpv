<x-user-layout>
  <div class="py-[10px] px-2">
    <div class="w-full px-[7.5px] mx-auto">
      <div class="flex flex-wrap mb-2 -mx-[7.5px] justify-between">
        <div class="col-span-6 text-lg text-[#212529]">
          <h1 class="m-0"></h1><h1>Bienvenido <strong class="text-[#3C8DBC]">{{ auth()->user()->name }}</strong> </h1>
        </div>
      </div>
    </div>
  </div>
  <section class="px-2">
    <div class="grid grid-cols-1 gap-4 mb-4 sm:grid-cols-2 lg:grid-cols-4">
      
      <div class="p-4 bg-white border border-[#00000020] rounded shadow">
        <div class="flex items-start justify-between text-sm">
          
        </div>
      </div>

      <div class="p-4 bg-white border border-[#00000020] rounded shadow">
        <div class="flex items-start justify-between text-sm">
          
        </div>
      </div>

      <div class="p-4 bg-white border border-[#00000020] rounded shadow">
        <div class="flex items-start justify-between text-sm">
         
        </div>
      </div>

      <div class="p-4 bg-white border border-[#00000020] rounded shadow">
        <div class="flex items-start justify-between text-sm">
          
        </div>
      </div>
      
    </div>
    <div class="flex flex-col bg-white border border-[#00000020] rounded shadow mb-4 card card-light">
      <div class="card-header text-[#1f2d3d] bg-[#f8f9fa] border-b border-[#00000020] py-3 px-5 rounded-t relative">
        <h3 class="float-left m-0 text-base card-title">Reporte</h3>
      </div>
      <div class="flex-auto p-5 card-body">
      </div>
    </div>
  </section>
</div>
</x-user-layout>
