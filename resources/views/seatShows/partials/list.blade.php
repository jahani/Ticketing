@if ($seatShows->count())
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">@lang('Stage')</th>
                <th scope="col">@lang('Section')</th>
                <th scope="col">@lang('Row')</th>
                <th scope="col">@lang('Seat')</th>
                <th scope="col">@lang('Show')</th>
                <th scope="col">@lang('Price')</th>
                @if($showActions ?? false)
                <th scope="col">@lang('Actions')</th>
                @endif
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
                    @if($showActions ?? false)
                    <td>
                        <a class="btn btn-sm btn-danger"
                            href="{{ route('reserves.destroy', [$seatShow->show, $seatShow->seat]) }}"
                            role="button">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3">
                    @lang('Sum: ') @price($seatShows->sum('price'))
                </td>
            </tr>
        </tfoot>
    </table>
@else
    <div>@lang('There is no reservations here!')</div>
@endif