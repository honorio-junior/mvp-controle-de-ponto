<x-layouts.main>
    <main class="bg-gray-100 flex items-center justify-center h-screen">
        <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-lg">
            <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Acesso ao Sistema</h2>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- cpf -->
                <div class="mb-4">
                    <label for="cpf" class="block text-gray-700 text-sm font-semibold mb-1">CPF</label>
                    <input id="cpf" type="cpf" name="cpf" required autofocus maxlength="14"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                    @error('cpf')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-gray-700 text-sm font-semibold mb-1">Senha</label>
                    <input id="password" type="password" name="password" required
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                    @error('password')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit -->
                <div class="mb-4">
                    <button type="submit"
                        class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition duration-200">
                        Entrar
                    </button>
                </div>
            </form>
        </div>
    </main>
</x-layouts.main>
