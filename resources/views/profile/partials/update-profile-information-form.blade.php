<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Informacion del Perfil') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Si detectas algun problema por favor contactar al administrador") }}
        </p>
    </header>


    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Nombre')" />
            <x-input-label class="mt-1 block w-full" :value="old('name', $user->name)"  />
        </div>

    </form>
</section>
