@if ($getState())
    <img src="{{ $getState() }}" alt="Tanda Tangan" style="max-width: 100%; height: auto;" />
@else
    <p>Tanda tangan belum tersedia</p>
@endif
