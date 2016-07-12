<div class="row">
    @foreach ($groups as $role => $users)

        <div class="col-sm-3">

            <h5 class="title-{{ $role }}"></h5>

            @foreach ($users as $user)
                @include('frontend.user.partials.username', ['author' => $user])
            @endforeach
        </div>

    @endforeach
</div>
