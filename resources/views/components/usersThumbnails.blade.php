@include('components.usersCount', compact('filteredUsers'))

<div class="row justify-content-center">
    @foreach ($filteredUsers as $user)
        <div class="card col-2 m-3 d-flex my_card">
            <div class="card-body d-flex flex-column">
                <a href="<?= $user->picture ?>" target="_blank"><img src="<?= $user->resizedPicture ?>" class="card-img-top mx-auto" style="width: 100px;"
                    alt="User picture <?= $user->id ?>"></a>
                <div class="mt-auto">
                    <p class="card-text text-start m-0"><?= ucfirst($user->name) ?></p>
                    <p class="card-text text-start m-0"><?= ucfirst($user->surname) ?></p>
                    <p class="card-text text-start m-0"><?= $user->last_login->format('Y-m-d H:i:s') ?></p>
                </div>
            </div>
        </div>
    @endforeach
</div>
