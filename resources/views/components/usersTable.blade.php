<table class="table table-striped" id="usersTable">
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
                <td><?= $user->name ?></td>
                <td><?= $user->surname ?></td>
                <td><?= $user->active == 1 ? 'Yes' : 'No' ?></td>
                <td><?= $user->last_login->format('d/m/Y H:i:s') ?></td>
                <td><img src="<?= $user->picture ?>" alt="User picture"></td>
                <td><?= $user->rating ?></td>
            </tr>
        @endforeach
    </tbody>
</table>
