{{-- components.table

Renders a data table
You can customize all the html and css classes but YOU MUST KEEP THE BLADE AND LIVEWIRE DIRECTIVES,

props:
  - headers
  - itmes
  - actionsByRow --}}

<x-tw-table>
  <x-slot name="head">
    @foreach ($headers as $header)
    @if (is_string($header))
    <x-tw-table-heading>{{$header}}</x-tw-table-heading>
    @else
    <x-tw-table-heading :sortable="$header->isSortable()" multi-column :direction="$sortOrder"
      wire:click="sortBy('{{ $header->sortBy }}')">
      {{$header->title}}
    </x-tw-table-heading>
    @endif
    @endforeach

    @if (count($actionsByRow) > 0)
    <x-tw-table-heading></x-tw-table-heading>
    @endif

  </x-slot>

  <x-slot name="body">
    @foreach ($items as $i => $item)
    <x-tw-table-row wire.loading.class.delay="opacity-50" wire:key="row-{{$i}}">
      @foreach ($view->row($item) as $column)
      <x-tw-table-cell>{!!$column !!}</x-tw-table-cell>
      @endforeach
      @if (count($actionsByRow) > 0)
      <x-tw-table-cell>
        <div class="flex justify-end">
          @foreach ($actionsByRow as $action)
          @component('laravel-views::components.action', ['action' => $action, 'item' => $item])
          <i data-feather="{{ $action->icon }}"
            class="mr-2 text-gray-400 hover:text-blue-600 transition-all duration-300 ease-in-out focus:text-blue-600 active:text-blue-600"></i>
          @endcomponent
          @endforeach
        </div>
      </x-tw-table-cell>
      @endif
    </x-tw-table-row>

    @endforeach
  </x-slot>

</x-tw-table>
