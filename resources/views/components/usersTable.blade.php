@include('components.usersCount', compact('filteredUsers'))

<table class="table table-striped table-bordered table-hover border-success" id="usersTable">
    <thead>
        <tr>
            <th class="ths sortNumber defaultSort" data-targetTd="idTd"><span>Id </span> <i class="fa-solid fa-arrow-down-wide-short asc"></i></th>
            <th class="ths sortString" data-targetTd="nameTd"><span>Name </span></th>
            <th class="ths sortString" data-targetTd="surnameTd"><span>Surname </span></th>
            <th class="ths sortBool" data-targetTd="activeTd"><span>Active </span></th>
            <th class="ths sortDate" data-targetTd="lastLoginTd"><span>Last login </span></th>
            <th>Picture</th>
            <th class="ths sortNumber" data-targetTd="ratingTd"><span>Rating </span></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($filteredUsers as $user)
            <tr class="userTr" data-userId="<?= $user->id ?>">
                <td class="idTd"><?= $user->id ?></td>
                <td class="nameTd"><?= ucfirst($user->name) ?></td>
                <td class="surnameTd"><?= ucfirst($user->surname) ?></td>
                <td class="activeTd"><?= $user->active == 1 ? 'Yes' : 'No' ?></td>
                <td class="lastLoginTd"><?= $user->last_login->format('d/m/Y H:i:s') ?></td>
                <td><a href="<?= $user->picture ?>" target="_blank"><img src="<?= $user->resizedPicture ?>"
                            alt="User picture <?= $user->id ?>"></a></td>
                <td class="ratingTd"><?= $user->rating ?></td>
            </tr>
        @endforeach
    </tbody>
</table>
