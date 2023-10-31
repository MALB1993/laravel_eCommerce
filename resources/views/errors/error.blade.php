@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul class="list-group-flush">
            @foreach ($errors->all() as $error)
                <li class="list-group-item alert-text">{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
