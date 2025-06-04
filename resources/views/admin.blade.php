<x-layouts.main>
    <main class="min-h-screen bg-gray-100 flex items-center justify-center px-4 py-8">
        <div class="w-full max-w-3xl bg-white rounded-2xl shadow-xl p-8 space-y-8">
            <a href="{{ route('home') }}"
                class="inline-flex items-center text-sm text-blue-600 hover:underline hover:text-blue-800 mb-4 transition duration-200">
                ← Voltar
            </a>
            <header class="text-center">
                <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Painel Administrativo</h1>
                <p class="text-gray-500 text-sm">Cadastro de Funcionários</p>
            </header>

            {{-- Formulário de cadastro --}}
            <section>
                <form action="{{ route('admin.users.create') }}" method="POST"
                    class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @csrf
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Nome</label>
                        <input type="text" id="name" name="name" required
                            class="mt-1 w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    </div>
                    <div>
                        <label for="surname" class="block text-sm font-medium text-gray-700">Sobrenome</label>
                        <input type="text" id="surname" name="surname" required
                            class="mt-1 w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    </div>
                    <div>
                        <label for="cpf" class="block text-sm font-medium text-gray-700">CPF</label>
                        <input type="text" id="cpf" name="cpf" required
                            class="mt-1 w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    </div>
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Senha</label>
                        <input type="password" id="password" name="password" required
                            class="mt-1 w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    </div>
                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-800 rounded">
                            <ul class="list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="md:col-span-2 text-right">
                        <button type="submit"
                            class="bg-blue-600 text-white px-6 py-2 rounded-md font-semibold hover:bg-blue-700 transition duration-200">
                            Cadastrar Funcionário
                        </button>
                    </div>
                </form>
            </section>

            {{-- Botão de relatório --}}
            <section class="text-right">
                <form action="" method="GET">
                    <button type="submit"
                        class="bg-gray-800 text-white px-6 py-2 rounded-md font-semibold hover:bg-gray-900 transition duration-200">
                        Download Relatório do Dia
                    </button>
                </form>
            </section>
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-800 text-sm px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-800 text-sm px-4 py-3 rounded">
                    {{ session('error') }}
                </div>
            @endif
            <div class="max-w-4xl mx-auto mt-8 space-y-4">
                @foreach ($users as $user)
                    <div class="flex items-center justify-between bg-white shadow-md rounded-lg p-4 border border-gray-200 hover:shadow-lg transition-shadow duration-300"
                        role="region" aria-label="Usuário {{ $user->cpf }}">

                        <div>
                            <p class="text-lg font-semibold text-gray-900">{{ $user->name }} {{ $user->surname }}</p>
                            <p class="text-sm text-gray-600">CPF: <span class="font-mono">{{ $user->cpf }}</span></p>
                            <p class="text-sm text-gray-500">Email: <span>{{ $user->email ?? 'Não informado' }}</span></p>
                        </div>

                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                            onsubmit="return confirm('Confirma exclusão do funcionario {{ $user->cpf }}? Isso nao apagara os registros de ponto');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-red-600 hover:bg-red-700 focus:ring-4 focus:ring-red-300 text-white font-semibold py-2 px-4 rounded-lg transition duration-200"
                                aria-label="Excluir usuário {{ $user->cpf }}">
                                Excluir
                            </button>
                        </form>
                    </div>
                @endforeach

                @if($users->isEmpty())
                    <p class="text-center text-gray-500 mt-8">Nenhum usuário cadastrado.</p>
                @endif
            </div>
        </div>
    </main>
</x-layouts.main>
