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
