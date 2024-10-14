<table class="table table-striped table-bordered table-hover border-success" id="usersTable">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Surname</th>
            <th>Active</th>
            <th>Last login</th>
            <th>Picture</th>
            <th>Rating</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($filteredUsers as $user)
            <tr class="userTr" data-userId="<?= $user->id ?>">
                <td><?= $user->id ?></td>
                <td><?= ucfirst($user->name) ?></td>
                <td><?= ucfirst($user->surname) ?></td>
                <td><?= $user->active == 1 ? 'Yes' : 'No' ?></td>
                <td><?= $user->last_login->format('d/m/Y H:i:s') ?></td>
                <td><a href="<?= $user->picture ?>" target="_blank"><img src="<?= $user->resizedPicture ?>"
                            alt="User picture <?= $user->id ?>"></a></td>
                <td><?= $user->rating ?></td>
            </tr>
        @endforeach
    </tbody>
</table>
