<div wire:ignore>
        <select type="text" style="width: 75%; height: 100%" id="{{ $name }}" wire:model.live='value'
            placeholder="Sumatera Barat" class="block w-full rounded-md border-0 py-1.5  shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-lightYellow sm:max-w-xs sm:text-sm sm:leading-6">
            <option value="">Pilih {{ $name }}</option>
            @foreach ($options as $option)
                <option value="{{ $option["id"] }}">{{ $option["name"] }}</option>
            @endforeach
        </select>
</div>

@script
<script>
    $(document).ready(function() {
        $('#{{ $name }}').select2();
        $('#{{ $name }}').on('change', function(event){
            $wire.$set('value', event.target.value);
        })
    });
</script>
@endscript
