<x-layouts.main>
    <main class="bg-gray-100 min-h-screen flex flex-col items-center px-4 py-10">
        {{-- Header --}}
        <section class="bg-white shadow-xl rounded-2xl p-6 w-full max-w-2xl text-center" role="banner"
            aria-label="Sistema de Registro de Ponto">
            <h1 class="text-3xl sm:text-4xl font-bold text-gray-800 mb-2">
                Sistema de Registro de Ponto
            </h1>
            <p class="text-base sm:text-lg text-gray-600 mb-1">
                Bem-vindo, <span class="font-semibold text-gray-900">{{ $name }}</span>
            </p>
            <p class="text-lg font-mono text-blue-600 mt-1" id="currentTime" aria-live="polite" aria-atomic="true"></p>
        </section>

        {{-- Formulário de registro --}}
        <section id="formContainer" class="mt-6 w-full max-w-lg bg-white shadow-md rounded-xl p-6"
            aria-label="Registrar ponto">
            <form method="POST" action="{{ route('point') }}" class="space-y-4" novalidate>
                @csrf

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

                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 text-white font-semibold py-2 rounded-lg transition duration-200"
                    aria-label="Registrar ponto">
                    Registrar Ponto
                </button>
            </form>
        </section>

        {{-- Registros de pontos --}}
        @if (!empty($records['points']))
            <section class="mt-10 w-full max-w-6xl grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6"
                aria-label="Registros de pontos">
                @foreach ($records['points'] as $key => $point)
                    <article
                        class="bg-white shadow-md rounded-2xl p-5 border border-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-300"
                        tabindex="0" aria-labelledby="date-{{ $key }}">
                        <h2 id="date-{{ $key }}" class="text-sm text-gray-500 mb-3 font-semibold">
                            {{ $key }}
                        </h2>
                        @foreach ($point as $key => $time)
                            <div class="flex items-center justify-between text-gray-800 font-medium mb-1">
                                @if ($key == 0)
                                    <span>Entrada:</span>
                                @elseif ($key == 1)
                                    <span>Saída:</span>
                                @elseif ($key == 2)
                                    <span>Retorno:</span>
                                @elseif ($key == 3)
                                    <span>Saída:</span>
                                @endif
                                <span class="pl-2">{{ $time }}</span>
                            </div>
                        @endforeach
                    </article>
                @endforeach
            </section>
        @else
            <p class="mt-8 text-gray-500 text-center">Nenhum registro de ponto encontrado.</p>
        @endif
    </main>

    <script>
        const currentTimeElement = document.getElementById('currentTime');

        async function atualizarHorario() {
            try {
                const response = await fetch('getTime');
                const data = await response.json();
                currentTimeElement.textContent = data.datetime;
            } catch (error) {
                console.error('Erro ao obter o horário do servidor:', error);
            }
        }

        setInterval(atualizarHorario, 1000);
        atualizarHorario();
    </script>
</x-layouts.main>
