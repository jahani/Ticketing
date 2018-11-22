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

<h1 style="text-align:center;">Scene</h1>
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
            if ($seat->hasReserveData()) {
                $seatClass = 'secondary';
                if ($seat->reserve->isBooked()) $seatClass = 'danger';
                if ($seat->reserve->isReserved()) $seatClass = 'warning';
                if ($seat->reserve->isReservedForClient()) $seatClass = 'primary';
            }
        @endphp
        <button style="grid-row: {{$seat->row_number+1}}; grid-column: {{$seat->seat_number+1}};"
            class="seat btn btn-{{ $seatClass ?? 'secondary' }}" id="seat-{{ $seat->id }}"
            data-toggle="tooltip" data-placement="top" data-html="true"
            title="Row: {{ $seat->row_number }}<br>Seat: {{ $seat->seat_number }}">
            {{ $seat->seat_number }}
        </button>
    @endforeach
</div>