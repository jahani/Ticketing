@if(session()->has('message'))
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="alert {{ session()->get('alert-class', 'alert-info') }}" role="alert">
                    {!! session()->get('message') !!}
                </div>
            </div>
        </div>
    </div>
@endif