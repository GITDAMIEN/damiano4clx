@if (isset($filteredUsers) && is_array($filteredUsers))
    <div id="usersCount" class="my-3">
        <i class="fa-solid fa-users"></i> Users found:
        <span id="usersCountSpan"><?= count($filteredUsers) ?></span>
    </div>
@endif
