<x-layout>
    <x-slot name="title">clxProject</x-slot>

    <div class="container">
        <div class="row my-5 text-center">
            <h1 class="my-5 text-my-green">Welcome to CLX Europe</h1>
            <h3 class="mb-4"><i class="fa-solid fa-filter"></i> Filter users here</h3>
            <form id="filtersForm" method="POST" action="{{ route('showUserAction') }}">
                @csrf
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" value="">
                        </div>

                        <div class="col">
                            <label for="surname">Surname</label>
                            <input type="text" name="surname" id="surname" value="">
                        </div>

                        <div class="col">
                            <label for="from">Logged in min date</label>
                            <input type="datetime-local" step="1" name="from" id="from"
                                value="">
                        </div>

                        <div class="col">
                            <label for="to">Logged in max date</label>
                            <input type="datetime-local" step="1" name="to" id="to"
                                value="">
                        </div>

                        <div class="col">
                            <label for="active">Status</label>
                            <select name="active" id="active">
                                <option value="NULL" selected>All</option>
                                <option value="1">Active</option>
                                <option value="0">Not active</option>
                            </select>
                        </div>

                        <div class="col">
                            <label for="view">View</label>
                            <select name="view" id="view">
                                <option value="table" selected>Table</option>
                                <option value="thumb">Thumbnail</option>
                            </select>
                        </div>

                        <div class="col">
                            <button class="btn btn-secondary reset_fields" type="button">Reset fields</button>
                            <button class="btn bg-my-green text-white" type="submit">Submit</button>
                        </div>
                    </div>
                </div>
            </form>

            <div id="usersData"></div>
        </div>
    </div>
</x-layout>
