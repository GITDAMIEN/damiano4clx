<x-layout>
    <div class="d-flex flex-column align-items-center">
        <div>
            <img style="width: 600px;" src="{{ asset('images/404 Error.gif') }}" alt="404 Page Not Found">
        </div>
        <div>
            <a href="{{ route('welcome') }}"><button class="btn bg-my-green text-white">Go back home</button></a>
        </div>
    </div>
</x-layout>
