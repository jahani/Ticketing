@php
// $seats = $section->seats;
$seats = $show->sectionSeats($section);
// dd($seats);

[$seat_rows, $seat_cols] = $section->getDimmentions();
@endphp

{{-- <div class="seats">
    @foreach ($seats as $rowKey => $seatsRow)
        <div class="seats-row">
            {{ $rowKey+1 }}
            @foreach ($seatsRow as $colKey => $seat)
                <div class="seat" id="seat-{{ $seat->id }}">
                    {{ $colKey+1 }}
                    {{ $seat->row_number }}:{{ $seat->seat_number }}
                </div>
            @endforeach
        </div>
    @endforeach
</div> --}}

<h1 style="text-align:center;">{{__('Scene')}}</h1>
<div class="seats">
    @for ($i = 1; $i <= $seat_cols; $i++)
        <div class="cols" style="grid-row: 1; grid-column: {{$i+1}};">-</div>
    @endfor
    @for ($i = 1; $i <= $seat_rows; $i++)
        <div class="rows" style="grid-row: {{$i+1}}; grid-column: 1;">{{$i}}</div>
    @endfor
    @foreach ($seats as $seat)
        @php
            unset($seatClass);
            unset($href);
            if ($seat->hasReserveData()) {
                $seatClass = 'secondary';
                if ($seat->reserves->isBooked()) $seatClass = 'danger';
                if ($seat->reserves->isReserved()) $seatClass = 'warning';
                if ($seat->reserves->isReservedForClient()) {
                    $seatClass = 'primary';
                    $href = route('reserves.destroy', compact('show', 'seat'));
                }
            } else {
                $href = route('reserves.store', compact('show', 'seat'));
            }
        @endphp
        <a style="grid-row: {{$seat->row_number+1}}; grid-column: {{$seat->seat_number+1}};"
            role="button" class="seat btn btn-{{ $seatClass ?? 'secondary' }}"
            id="seat-{{ $seat->id }}"
            @if (!empty($href)) href="{{ $href }}" @endif
            data-toggle="tooltip" data-placement="top" data-html="true"
            title="{{__('Row')}}: {{ $seat->row_number }}<br>{{__('Seat')}}: {{ $seat->seat_number }}">
            {{ $seat->seat_number }}
        </a>
    @endforeach
</div>