<x-layout>
    <x-slot name="title">clxProject</x-slot>

    <div class="container">
        <div class="row my-2 text-center justify-content-center">
            <h1 id="welcomeHeader" class="my-5 text-my-green">Welcome to CLX Europe</h1>
            <h3 class="mb-4"><i class="fa-solid fa-filter" style="font-size: 20px;"></i> Filter users here:</h3>

            @include('components.filters')

            <div id="usersData" class="my-4"></div>
        </div>
    </div>
</x-layout>
