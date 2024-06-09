<!-- resources/views/kompetensi-umum.blade.php -->

<x-app-layout>
    @include('layouts.navigation')

    <input type="hidden" id="kategori" value="{{ $kategori }}">
    <input type="hidden" id="start_time" value="{{ now() }}">

    <div class="p-6">
        <div class="py-2 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="container mx-auto mt-10">
                <h1 class="mb-4 text-2xl font-semibold">Kompetensi Umum</h1>
                <div class="flex flex-col mb-4 space-y-4 md:flex-row md:space-y-0 md:space-x-4">
                    <div class="w-full md:flex-grow">
                        <form id="answer-form" method="POST" action="{{ route('kompetensi-umum.storeJawaban') }}">
                            @csrf
                            <input type="hidden" name="question_number" id="hidden-question-number"
                                value="{{ $questionNumber }}">
                            <input type="hidden" name="kategori" value="{{ $kategori }}">
                            <input type="hidden" name="start_time" id="hidden-start-time" value="{{ now() }}">
                            <input type="hidden" name="answers" id="answers">
                            <input type="hidden" name="jawaban" id="hidden-answer">

                            <div class="p-6 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm"
                                id="question-card">
                                <div class="flex flex-col items-center justify-between md:flex-row">
                                    <h3 class="mb-2 text-xl font-semibold md:mb-0" id="question-title">Soal No.
                                        {{ $questionNumber }}</h3>
                                </div>
                                <hr class="h-px my-4 bg-gray-100 border-0 dark:bg-gray-200">
                                @if ($questions->isEmpty())
                                    <p class="text-red-500">Tidak ada pertanyaan yang tersedia.</p>
                                @else
                                    @php
                                        $index = intval($questionNumber) - 1;
                                        $question =
                                            $index >= 0 && $index < count($questions) ? $questions[$index] : null;
                                    @endphp
                                    @if ($question)
                                        <div class="mt-4 banner" id="question-image-container">
                                            @if ($question->gambar)
                                                <img src="{{ asset('storage/' . $question->gambar) }}"
                                                    alt="Deskripsi Gambar" class="w-1/4 h-auto mx-auto">
                                            @endif
                                        </div>
                                        <p class="mt-2 whitespace-pre-line" id="question-text">
                                            {{ $question->pertanyaan }}</p>
                                        <div class="flex flex-col items-start h-full gap-2 mt-4" id="options-container">
                                            @foreach (['A', 'B', 'C', 'D'] as $option)
                                                <div class="flex items-center p-2 bg-gray-100 border rounded-md cursor-pointer option hover:border-green-700 hover:bg-green-200"
                                                    onclick="selectOption('{{ $option }}')">
                                                    <input type="radio" name="jawaban" value="{{ $option }}"
                                                        id="option-{{ $option }}" class="hidden">
                                                    <label for="option-{{ $option }}"
                                                        class="flex items-center w-full cursor-pointer">
                                                        <div
                                                            class="flex-shrink-0 text-sm font-semibold text-center sm:w-12">
                                                            {{ $option }}.</div>
                                                        <div class="flex-grow w-full text-sm break-words">
                                                            {{ $question['opsi_' . strtolower($option)] }}</div>
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-red-500">Nomor pertanyaan tidak valid.</p>
                                    @endif
                                @endif
                            </div>
                            <div class="flex justify-between mt-6 space-x-2">
                                <button type="button" id="previous-btn"
                                    class="px-4 py-2 text-white bg-green-500 rounded shadow-sm hover:bg-green-700"
                                    onclick="navigateQuestion('previous')"
                                    {{ $questionNumber == 1 ? 'disabled' : '' }}>Sebelumnya</button>
                                <button type="button" id="next-btn"
                                    class="px-4 py-2 text-white bg-green-600 rounded shadow-sm hover:bg-green-800"
                                    onclick="navigateQuestion('next')">{{ $questionNumber == $totalQuestions ? 'Selesai' : 'Selanjutnya' }}</button>
                            </div>
                        </form>
                    </div>
                    <div class="w-full md:w-1/4">
                        <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-sm">
                            <h2 class="mb-2 font-semibold">Nomor Soal</h2>
                            <div class="grid grid-cols-5 gap-2" id="question-numbers"></div>
                            <div class="mt-4">
                                <button id="complete-btn"
                                    class="w-full px-4 py-2 text-white bg-red-600 rounded hover:bg-red-800"
                                    onclick="showModal()">Selesai Dikerjakan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="confirmation-modal"
        class="fixed inset-0 z-50 items-center justify-center hidden bg-gray-800 bg-opacity-75">
        <div class="flex flex-col justify-center items-center px-5 py-6 bg-white rounded-2xl shadow-sm max-w-[342px]">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-12 h-12 text-green-500">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0z"></path>
            </svg>
            <h3 class="mt-2 text-xl font-bold text-center text-slate-800">Apakah kamu yakin ingin menyelesaikan ujian?
            </h3>
            <div class="flex justify-center gap-2 mt-4">
                <button id="cancel-btn" class="px-4 py-2 text-sm text-gray-700 bg-gray-200 rounded-md hover:bg-gray-300"
                    onclick="hideModal()">Batal</button>
                <button id="confirm-btn" class="px-4 py-2 text-sm text-white bg-green-600 rounded-md hover:bg-green-800"
                    onclick="submitForm()">Yakin</button>
            </div>
        </div>
    </div>

    <div id="success-message" class="fixed inset-0 z-50 items-center justify-center hidden bg-gray-800 bg-opacity-75">
        <div class="px-5 py-6 bg-white rounded-2xl shadow-sm max-w-[342px] text-center">
            <h3 class="text-xl font-bold text-slate-800">Jawaban berhasil disimpan!</h3>
            <button class="px-4 py-2 mt-4 text-sm text-white bg-green-600 rounded-md hover:bg-green-800"
                onclick="redirectToResults()">OK</button>
        </div>
    </div>

    <script>
        let questionNumber = parseInt(sessionStorage.getItem('questionNumber') || '{{ $questionNumber }}');
        const totalQuestions = {{ $totalQuestions }};
        let answers = JSON.parse(sessionStorage.getItem('answers') || '[]');

        document.addEventListener('DOMContentLoaded', function() {
            if (totalQuestions > 0) {
                displayQuestion(questionNumber - 1);
                generateQuestionNumbers();
                updateButtonStates();
            }
        });

        function displayQuestion(index) {
            const questions = @json($questions->toArray());
            if (questions.length === 0) return;

            if (index < 0 || index >= questions.length) {
                document.getElementById('question-card').innerHTML =
                    '<p class="text-red-500">Nomor pertanyaan tidak valid.</p>';
                return;
            }

            const question = questions[index];
            document.getElementById('question-title').textContent = `Soal No. ${index + 1}`;
            document.getElementById('question-text').textContent = question.pertanyaan;

            if (question.gambar) {
                document.getElementById('question-image-container').innerHTML =
                    `<img src="{{ asset('storage/') }}/${question.gambar}" alt="Deskripsi Gambar" class="w-1/4 h-auto mx-auto">`;
            } else {
                document.getElementById('question-image-container').innerHTML = '';
            }

            const optionsContainer = document.getElementById('options-container');
            optionsContainer.innerHTML = '';

            ['A', 'B', 'C', 'D'].forEach(option => {
                const optionElement = document.createElement('div');
                optionElement.classList.add('flex', 'items-center', 'p-2', 'bg-gray-100', 'border', 'rounded-md',
                    'cursor-pointer', 'option', 'hover:border-green-700', 'hover:bg-green-200');
                optionElement.setAttribute('onclick', `selectOption('${option}')`);

                optionElement.innerHTML = `
                    <input type="radio" name="jawaban" value="${option}" id="option-${option}" class="hidden">
                    <label for="option-${option}" class="flex items-center w-full cursor-pointer">
                        <div class="flex-shrink-0 text-sm font-semibold text-center sm:w-12">${option}.</div>
                        <div class="flex-grow w-full text-sm break-words">${question['opsi_' + option.toLowerCase()]}</div>
                    </label>
                `;

                optionsContainer.appendChild(optionElement);

                if (answers[index] === option) {
                    optionElement.querySelector('input[type="radio"]').checked = true;
                    optionElement.classList.add('border-green-700', 'bg-green-200');
                }
            });
        }

        function selectOption(option) {
            answers[questionNumber - 1] = option;
            sessionStorage.setItem('answers', JSON.stringify(answers));
            displayQuestion(questionNumber - 1);
            generateQuestionNumbers();
        }

        function navigateQuestion(direction) {
            saveAnswer();

            questionNumber = parseInt(questionNumber);

            if (direction === 'next' && questionNumber < totalQuestions) {
                questionNumber++;
            } else if (direction === 'previous' && questionNumber > 1) {
                questionNumber--;
            }

            sessionStorage.setItem('questionNumber', questionNumber);
            displayQuestion(questionNumber - 1);
            generateQuestionNumbers();
            updateButtonStates();
        }

        function generateQuestionNumbers() {
            const questionNumbersContainer = document.getElementById('question-numbers');
            questionNumbersContainer.innerHTML = '';

            for (let i = 0; i < totalQuestions; i++) {
                const questionNumberElement = document.createElement('div');
                questionNumberElement.classList.add('p-2', 'text-center', 'border', 'rounded-md', 'cursor-pointer');
                questionNumberElement.textContent = i + 1;
                questionNumberElement.addEventListener('click', () => {
                    saveAnswer();
                    questionNumber = i + 1;
                    sessionStorage.setItem('questionNumber', questionNumber);
                    displayQuestion(questionNumber - 1);
                    generateQuestionNumbers();
                    updateButtonStates();
                });

                if (i + 1 === questionNumber) {
                    questionNumberElement.classList.add('bg-green-600', 'text-white');
                } else if (answers[i]) {
                    questionNumberElement.classList.add('bg-green-200');
                } else {
                    questionNumberElement.classList.add('bg-gray-200');
                }

                questionNumbersContainer.appendChild(questionNumberElement);
            }
        }

        function showModal() {
            const modal = document.getElementById('confirmation-modal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function hideModal() {
            const modal = document.getElementById('confirmation-modal');
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }

        function showSuccessMessage() {
            const successMessage = document.getElementById('success-message');
            successMessage.classList.remove('hidden');
            successMessage.classList.add('flex');
        }

        function redirectToResults() {
            window.location.href = "{{ route('kompetensi-umum.hasil') }}";
        }

        function submitForm() {
            saveAnswer();

            const form = document.getElementById('answer-form');
            const answersInput = document.getElementById('answers');
            answersInput.value = JSON.stringify(answers);

            const formData = new FormData(form);

            fetch("{{ route('kompetensi-umum.storeJawaban') }}", {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        return response.text().then(text => {
                            console.error('Server error response:', text); // Log the full error response
                            throw new Error(text);
                        });
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        showSuccessMessage();
                        hideModal();
                    } else {
                        console.error(data.message);
                        alert('Error: ' + data.message);
                        hideModal();
                    }
                })
                .catch((error) => {
                    console.error('Error:', error.message);
                    alert('Error: ' + error.message);
                    hideModal();
                });
        }

        function saveAnswer() {
            const selectedOption = document.querySelector('input[name="jawaban"]:checked');
            if (selectedOption) {
                answers[questionNumber - 1] = selectedOption.value;
            } else {
                answers[questionNumber - 1] = null;
            }
            sessionStorage.setItem('answers', JSON.stringify(answers));
        }

        function updateButtonStates() {
            document.getElementById('previous-btn').disabled = questionNumber === 1;
            document.getElementById('next-btn').textContent = questionNumber === totalQuestions ? 'Selesai' : 'Selanjutnya';
        }
    </script>
</x-app-layout>
