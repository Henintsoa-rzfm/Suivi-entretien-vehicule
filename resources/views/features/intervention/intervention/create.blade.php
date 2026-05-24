@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-indigo-50 py-10 px-4">

    <div class="max-w-3xl mx-auto">

        <!-- Header -->
        <div class="mb-8">
            <h3 class="text-xl font-bold tracking-tight text-slate-800">
                Nouvelle intervention
            </h3>

            <p class="mt-2 text-slate-500">
                Planifiez une intervention en quelques étapes.
            </p>
        </div>

        <!-- Card -->
        <div class="bg-white/80 backdrop-blur-xl border border-slate-200 rounded-3xl shadow-xl overflow-hidden">

            <!-- Progress -->
            <div class="px-8 pt-8">
                <div class="flex items-center justify-between mb-6">

                    <div class="flex items-center gap-3">
                        <div id="stepIndicator1"
                             class="w-9 h-9 rounded-full bg-indigo-600 text-white flex items-center justify-center font-semibold shadow-lg shadow-indigo-200">
                            1
                        </div>

                        <div>
                            <p class="font-semibold text-slate-800 text-sm">Informations</p>
                            <p class="text-xs text-slate-500">Détails de l’intervention</p>
                        </div>
                    </div>

                    <div class="flex-1 h-1 bg-slate-200 mx-6 rounded-full overflow-hidden">
                        <div id="progressBar"
                             class="h-full w-1/2 bg-indigo-600 transition-all duration-300"></div>
                    </div>

                    <div class="flex items-center gap-3">
                        <div id="stepIndicator2"
                             class="w-9 h-9 rounded-full bg-slate-200 text-slate-500 flex items-center justify-center font-semibold">
                            2
                        </div>

                        <div>
                            <p class="font-semibold text-slate-500 text-sm">Assignation</p>
                            <p class="text-xs text-slate-400">Ressources & validation</p>
                        </div>
                    </div>

                </div>
            </div>

            @if($errors->any())
                <div class="px-8 pb-4 space-y-2">
                    @foreach ($errors->all() as $error)
                        <div class="bg-red-50 border border-red-200 text-red-600 px-4 py-2 rounded-xl text-sm">
                            {{ $error }}
                        </div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('interventions.store') }}" id="multiStepForm">
                @csrf

                <!-- STEP 1 -->
                <div id="step1" class="p-8 space-y-5">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        <!-- Nature -->
                        <input type="text" name="nature" placeholder="Nature"
                               class="w-full rounded-xl border border-slate-200 px-3 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 outline-none transition">

                        <!-- Lieu -->
                        <input type="text" name="lieuIntervention" placeholder="Lieu"
                               class="w-full rounded-xl border border-slate-200 px-3 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 outline-none transition">

                        <!-- Date -->
                        <input type="date" name="DateIntervention"
                               class="w-full rounded-xl border border-slate-200 px-3 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 outline-none transition">

                        <!-- Limite -->
                        <input type="date" name="DateLimite"
                               class="w-full rounded-xl border border-slate-200 px-3 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 outline-none transition">

                    </div>

                    <!-- Panne -->
                    <textarea name="Panne" rows="4" placeholder="Description de la panne"
                              class="w-full rounded-xl border border-slate-200 px-3 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 outline-none transition"></textarea>

                    <!-- Actions -->
                    <div class="flex flex-col sm:flex-row justify-between gap-3 pt-4">

                        <a href="{{ route('pieces.create') }}"
                           class="px-5 py-2.5 rounded-xl bg-slate-100 text-slate-700 hover:bg-slate-200 text-sm text-center">
                            Gérer les pièces
                        </a>

                        <button type="button" id="nextBtn"
                                class="px-5 py-2.5 rounded-xl bg-indigo-600 text-white text-sm font-semibold hover:bg-indigo-700">
                            Suivant
                        </button>

                    </div>

                </div>

                <!-- STEP 2 -->
                <div id="step2" class="hidden p-8 space-y-5">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                        <!-- Intervenant -->
                        <select name="user_id"
                                class="w-full rounded-xl border border-slate-200 px-3 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 outline-none transition">
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>

                        <!-- Véhicule -->
                        <select name="vehicule_id"
                                class="w-full rounded-xl border border-slate-200 px-3 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 outline-none transition">
                            @foreach ($vehicules as $vehicule)
                                <option value="{{ $vehicule->id }}">
                                    {{ $vehicule->PlaqueImmatric }}
                                </option>
                            @endforeach
                        </select>

                        <!-- Pièce -->
                        <select name="piece_id"
                                class="w-full rounded-xl border border-slate-200 px-3 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 outline-none transition">
                            @foreach ($pieces as $piece)
                                <option value="{{ $piece->id }}">{{ $piece->Piece }}</option>
                            @endforeach
                        </select>

                        <!-- Quantité -->
                        <input type="number" name="Nombre" placeholder="Quantité"
                               class="w-full rounded-xl border border-slate-200 px-3 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 outline-none transition">

                        <!-- Validation -->
                        <select name="Validation"
                                class="w-full rounded-xl border border-slate-200 px-3 py-2.5 text-sm shadow-sm focus:border-indigo-500 focus:ring-4 focus:ring-indigo-100 outline-none transition">

                            @if (Auth::user()->admin)
                                <option value="En attente">En attente</option>
                                <option value="Validée">Validée</option>
                            @else
                                <option value="En attente">En attente</option>
                            @endif

                        </select>

                    </div>

                    <input type="hidden" name="intervention_id" value="{{ $max + 1 }}">

                    <!-- Actions -->
                    <div class="flex justify-between gap-3 pt-4">

                        <button type="button" id="backBtn"
                                class="px-5 py-2.5 rounded-xl border border-slate-200 text-slate-700 hover:bg-slate-50 text-sm">
                            Retour
                        </button>

                        <button type="submit"
                                class="px-5 py-2.5 rounded-xl bg-indigo-600 text-white text-sm font-semibold hover:bg-indigo-700">
                            Enregistrer
                        </button>

                    </div>

                </div>

            </form>

        </div>

    </div>
</div>

<script>
    const step1 = document.getElementById('step1');
    const step2 = document.getElementById('step2');

    const nextBtn = document.getElementById('nextBtn');
    const backBtn = document.getElementById('backBtn');

    const progressBar = document.getElementById('progressBar');

    const stepIndicator2 = document.getElementById('stepIndicator2');

    nextBtn.addEventListener('click', () => {
        step1.classList.add('hidden');
        step2.classList.remove('hidden');

        progressBar.classList.remove('w-1/2');
        progressBar.classList.add('w-full');

        stepIndicator2.classList.remove('bg-slate-200', 'text-slate-500');
        stepIndicator2.classList.add('bg-indigo-600', 'text-white');
    });

    backBtn.addEventListener('click', () => {
        step2.classList.add('hidden');
        step1.classList.remove('hidden');

        progressBar.classList.remove('w-full');
        progressBar.classList.add('w-1/2');

        stepIndicator2.classList.add('bg-slate-200', 'text-slate-500');
        stepIndicator2.classList.remove('bg-indigo-600', 'text-white');
    });
</script>

@endsection
