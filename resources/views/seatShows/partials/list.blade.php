@if ($seatShows->count())
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Stage</th>
                <th scope="col">Section</th>
                <th scope="col">Row#</th>
                <th scope="col">Seat#</th>
                <th scope="col">Show</th>
                <th scope="col">Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($seatShows as $index => $seatShow)
                <tr>
                    <th scope="row">{{ $index + 1 }}</th>
                    <td>{{ $seatShow->seat->section->stage->name }}</td>
                    <td>{{ $seatShow->seat->section->name }}</td>
                    <td>{{ $seatShow->seat->row_number }}</td>
                    <td>{{ $seatShow->seat->seat_number }}</td>
                    <td>{{ $seatShow->show->name }}</td>
                    <td>@price($seatShow->price)</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3">
                    {{ __('Sum: ') }} @price($seatShows->sum('price'))
                </td>
            </tr>
        </tfoot>
    </table>
@else
    <div>{{ __('There is no reservations here!') }}</div>
@endif