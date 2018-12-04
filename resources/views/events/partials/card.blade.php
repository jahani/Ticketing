<div class="col-md-4 py-2">
    <div class="card">
        <img class="card-img-top" src="{{ $event->getImageURL() }}" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title">{{ $event->name }}</h5>
            <p class="card-text">
                {{ str_limit($event->description) }}
            </p>
            <a href="{{ route('events.show', [$event]) }}" class="btn btn-primary">More Info</a>
        </div>
    </div>
</div>