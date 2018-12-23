@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">@lang('Show Details')</div>

                <div class="card-body">
                    @can('update', $show)
                        <a class="btn btn-sm btn-secondary" href="{{ route('shows.edit', $show) }}" role="button">
                            <i class="fa fa-edit"></i>
                        </a>
                    @endcan
                    @can('delete', $show)
                        {!!Form::open()->delete()->route('shows.destroy', [$show])->attrs(['class'=>'inline-form'])!!}
                        <button type="submit" class="btn btn-sm btn-danger">
                            <i class="fa fa-trash"></i>
                        </button>
                        {!!Form::close()!!}
                    @endcan

                    <h1>{{ $show->name }}</h1>
                    <div>@lang('Back to event') <a href="{{ route('events.show', $show->event) }}">{{ $show->event->name }}</a></div>

                    <br>
                    <h2>@lang('Sections')</h2>
                    @if ($show->sections->count())
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">@lang('Name')</th>
                                    <th scope="col">@lang('Stage')</th>
                                    <th scope="col">@lang('Venue')</th>
                                    <th scope="col">@lang('Price')</th>
                                    <th scope="col">@lang('Actions')</th>
                                </tr>
                            </thead>
                            <tbody>
                        @foreach ($show->sections as $index => $section)
                            <tr>
                                <th scope="row">{{ $index + 1 }}</th>
                                <td>{{ $section->name }}</td>
                                <td>{{ $section->stage->name }}</td>
                                <td>{{ $section->stage->venue->name }}</td>
                                <td>@price($section->pivot->price)</td>
                                <td>
                                    <a class="btn btn-primary btn-sm" role="button"
                                        href="{{ route('reserves.show', [$show, $section]) }}">
                                        <i class="fa fa-calendar-plus-o"></i>&nbsp;
                                        @lang('Reserve')
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                            </tbody>
                        </table>
                    @else
                        <div>@lang('There is no section here!')</div>
                    @endif
                    @can('update', $show)
                        @include('shows.addSectionForm')
                    @endcan
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
