<div class="row">
    @foreach ($filteredUsers as $user)
        <div class="card col-2 m-3">
            <img src="<?= $user->resizedPicture ?>" class="card-img-top" alt="User picture <?= $user->id ?>">
            <div class="card-body">
                <p class="card-text"><?= ucfirst($user->name) ?></p>
                <p class="card-text"><?= ucfirst($user->surname) ?></p>
                <p class="card-text"><?= $user->last_login->format('Y-m-d H:i:s') ?></p>
            </div>
        </div>
    @endforeach
</div>1
