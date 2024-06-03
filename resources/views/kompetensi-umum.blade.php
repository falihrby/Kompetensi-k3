<x-app-layout>
    @include('layouts.navigation')

    <input type="hidden" id="kategori" value="{{ $kategori }}">

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
                            <div class="p-6 mb-4 bg-white border border-gray-200 rounded-lg shadow-sm"
                                id="question-card">
                                <div class="flex flex-col items-center justify-between md:flex-row">
                                    <h3 class="mb-2 text-xl font-semibold md:mb-0" id="question-title">Soal No.
                                        {{ $questionNumber }}</h3>
                                    <div class="flex justify-center gap-0 text-sm text-white rounded-md">
                                        <div class="p-2.5 bg-green-700 rounded-l-md text-xs text-white shadow-md">SISA
                                            WAKTU</div>
                                        <div class="p-2.5 whitespace-nowrap font-medium bg-green-600 rounded-r-md text-xs text-white shadow-md"
                                            id="time-remaining">01 : 30 : 00</div>
                                    </div>
                                </div>
                                <hr class="h-px my-4 bg-gray-100 border-0 dark:bg-gray-200">
                                @if ($questions->isNotEmpty())
                                    @php $question = $questions[$questionNumber - 1]; @endphp
                                    <div class="mt-4 banner" id="question-image-container">
                                        @if ($question->gambar)
                                            <img src="{{ asset('storage/' . $question->gambar) }}"
                                                alt="Deskripsi Gambar" class="w-1/4 h-auto mx-auto">
                                        @endif
                                    </div>
                                    <p class="mt-2 whitespace-pre-line" id="question-text">{{ $question->pertanyaan }}
                                    </p>
                                    <div class="flex flex-col items-start h-full gap-2 mt-4" id="options-container">
                                        <div class="flex items-center p-2 bg-gray-100 border rounded-md cursor-pointer option hover:border-green-700 hover:bg-green-200"
                                            onclick="selectOption('A')">
                                            <input type="radio" name="jawaban" value="A" id="option-A"
                                                class="hidden">
                                            <label for="option-A" class="flex items-center w-full cursor-pointer">
                                                <div class="flex-shrink-0 text-sm font-semibold text-center sm:w-12">A.
                                                </div>
                                                <div class="flex-grow w-full text-sm break-words">
                                                    {{ $question->opsi_a }}</div>
                                            </label>
                                        </div>
                                        <div class="flex items-center p-2 bg-gray-100 border rounded-md cursor-pointer option hover:border-green-700 hover:bg-green-200"
                                            onclick="selectOption('B')">
                                            <input type="radio" name="jawaban" value="B" id="option-B"
                                                class="hidden">
                                            <label for="option-B" class="flex items-center w-full cursor-pointer">
                                                <div class="flex-shrink-0 text-sm font-semibold text-center sm:w-12">B.
                                                </div>
                                                <div class="flex-grow w-full text-sm break-words">
                                                    {{ $question->opsi_b }}</div>
                                            </label>
                                        </div>
                                        <div class="flex items-center p-2 bg-gray-100 border rounded-md cursor-pointer option hover:border-green-700 hover:bg-green-200"
                                            onclick="selectOption('C')">
                                            <input type="radio" name="jawaban" value="C" id="option-C"
                                                class="hidden">
                                            <label for="option-C" class="flex items-center w-full cursor-pointer">
                                                <div class="flex-shrink-0 text-sm font-semibold text-center sm:w-12">C.
                                                </div>
                                                <div class="flex-grow w-full text-sm break-words">
                                                    {{ $question->opsi_c }}</div>
                                            </label>
                                        </div>
                                        <div class="flex items-center p-2 bg-gray-100 border rounded-md cursor-pointer option hover:border-green-700 hover:bg-green-200"
                                            onclick="selectOption('D')">
                                            <input type="radio" name="jawaban" value="D" id="option-D"
                                                class="hidden">
                                            <label for="option-D" class="flex items-center w-full cursor-pointer">
                                                <div class="flex-shrink-0 text-sm font-semibold text-center sm:w-12">D.
                                                </div>
                                                <div class="flex-grow w-full text-sm break-words">
                                                    {{ $question->opsi_d }}</div>
                                            </label>
                                        </div>
                                    </div>
                                @else
                                    <p class="mt-2">No questions available for this category.</p>
                                @endif
                            </div>
                            <div class="flex justify-between mt-6 space-x-2">
                                <button type="button" id="previous-btn"
                                    class="px-4 py-2 text-white bg-gray-500 rounded shadow-sm hover:bg-gray-700"
                                    onclick="navigateQuestion('previous')"
                                    {{ $questionNumber == 1 ? 'disabled' : '' }}>Sebelumnya</button>
                                <button type="button" id="ragu-ragu-btn"
                                    class="px-4 py-2 text-gray-700 bg-white border border-gray-300 rounded shadow-sm hover:bg-yellow-500 hover:text-white"
                                    onclick="toggleRaguRagu()">Ragu-ragu</button>
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
                            <div class="mt-4 space-y-2">
                                <p class="flex items-center space-x-2 text-sm font-medium text-gray-700">
                                    <span class="inline-block w-4 h-4 bg-gray-200 rounded"></span>
                                    <span>:</span>
                                    <span>Belum dikerjakan</span>
                                </p>
                                <p class="flex items-center space-x-2 text-sm font-medium text-gray-700">
                                    <span class="inline-block w-4 h-4 bg-yellow-400 rounded"></span>
                                    <span>:</span>
                                    <span>Ragu-ragu</span>
                                </p>
                                <p class="flex items-center space-x-2 text-sm font-medium text-gray-700">
                                    <span class="inline-block w-4 h-4 bg-green-500 rounded"></span>
                                    <span>:</span>
                                    <span>Sudah dikerjakan</span>
                                </p>
                            </div>
                            <div class="mt-4">
                                <button id="complete-btn"
                                    class="w-full px-4 py-2 text-white bg-green-600 rounded hover:bg-green-800"
                                    disabled>Selesai Dikerjakan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const questions = @json($questions);
        const totalQuestions = questions.length;
        const answers = JSON.parse(sessionStorage.getItem('answers')) || new Array(totalQuestions).fill(null);
        const raguRagu = JSON.parse(sessionStorage.getItem('raguRagu')) || new Array(totalQuestions).fill(false);
        let questionNumber = sessionStorage.getItem('questionNumber') ? parseInt(sessionStorage.getItem('questionNumber')) :
            {{ $questionNumber - 1 }}; // Start with the first question
        let questionsGenerated = false;

        document.addEventListener('DOMContentLoaded', () => {
            if (questions.length > 0) {
                displayQuestion(questionNumber);
                if (!questionsGenerated) {
                    generateQuestionNumbers();
                    questionsGenerated = true;
                }
            } else {
                console.error('No questions available');
                alert('No questions available');
            }

            startTimer();

            document.getElementById('answer-form').addEventListener('submit', function(event) {
                event.preventDefault();
                saveAnswer();
                if (questionNumber < totalQuestions - 1) {
                    navigateQuestion('next');
                } else {
                    alert('Selesai Dikerjakan');
                }
            });
        });

        function displayQuestion(index) {
            if (questions.length === 0) {
                console.error('No questions available');
                return;
            }

            const question = questions[index];
            document.getElementById('question-title').textContent = `Soal No. ${index + 1}`;
            document.getElementById('question-text').textContent = question.pertanyaan;

            if (question.gambar) {
                document.getElementById('question-image-container').innerHTML =
                    `<img src="/storage/${question.gambar}" alt="Deskripsi Gambar" class="w-1/4 h-auto mx-auto">`;
            } else {
                document.getElementById('question-image-container').innerHTML = '';
            }

            const optionsContainer = document.getElementById('options-container');
            optionsContainer.innerHTML = '';
            const options = ['A', 'B', 'C', 'D'];
            options.forEach((option) => {
                const optionElement = document.createElement('div');
                optionElement.className =
                    'flex items-center p-2 bg-gray-100 border rounded-md cursor-pointer option hover:border-green-700 hover:bg-green-200';
                optionElement.innerHTML = `
                    <input type="radio" name="jawaban" value="${option}" id="option-${option}" class="hidden">
                    <label for="option-${option}" class="flex items-center w-full cursor-pointer">
                        <div class="flex-shrink-0 text-sm font-semibold text-center sm:w-12">${option}.</div>
                        <div class="flex-grow w-full text-sm break-words">${question['opsi_' + option.toLowerCase()]}</div>
                    </label>
                `;
                optionElement.onclick = () => selectOption(option);
                optionsContainer.appendChild(optionElement);
            });

            const selectedOption = answers[index];
            if (selectedOption) {
                document.getElementById(`option-${selectedOption}`).checked = true;
            }

            updateNavigationButtons();
        }

        function selectOption(option) {
            answers[questionNumber] = option;
            sessionStorage.setItem('answers', JSON.stringify(answers));
        }

        function toggleRaguRagu() {
            const button = document.getElementById('ragu-ragu-btn');
            const questionButton = document.getElementById(`question-number-${questionNumber + 1}`);

            if (button.classList.contains('bg-yellow-500')) {
                button.classList.remove('bg-yellow-500', 'text-white');
                button.classList.add('bg-white', 'text-gray-700');
                questionButton.classList.remove('bg-yellow-400');
                if (answers[questionNumber]) {
                    questionButton.classList.add('bg-green-500');
                } else {
                    questionButton.classList.add('bg-gray-200');
                }
                raguRagu[questionNumber] = false;
            } else {
                button.classList.remove('bg-white', 'text-gray-700');
                button.classList.add('bg-yellow-500', 'text-white');
                questionButton.classList.remove('bg-green-500', 'bg-gray-200');
                questionButton.classList.add('bg-yellow-400');
                raguRagu[questionNumber] = true;
            }
            sessionStorage.setItem('raguRagu', JSON.stringify(raguRagu));
        }

        function startTimer() {
            let timeRemaining = 3600;

            const timerInterval = setInterval(() => {
                if (timeRemaining > 0) {
                    timeRemaining--;
                    const hours = String(Math.floor(timeRemaining / 3600)).padStart(2, '0');
                    const minutes = String(Math.floor((timeRemaining % 3600) / 60)).padStart(2, '0');
                    const seconds = String(timeRemaining % 60).padStart(2, '0');
                    document.getElementById('time-remaining').textContent = `${hours} : ${minutes} : ${seconds}`;
                } else {
                    clearInterval(timerInterval);
                    alert("Waktu habis!");
                }
            }, 1000);
        }

        function navigateQuestion(direction) {
            saveAnswer();
            if (direction === 'next' && questionNumber < totalQuestions - 1) {
                questionNumber++;
            } else if (direction === 'previous' && questionNumber > 0) {
                questionNumber--;
            }

            sessionStorage.setItem('questionNumber', questionNumber);
            displayQuestion(questionNumber);
        }

        function saveAnswer() {
            const selectedOption = document.querySelector('input[name="jawaban"]:checked');
            if (selectedOption) {
                answers[questionNumber] = selectedOption.value;
                sessionStorage.setItem('answers', JSON.stringify(answers));
            }
        }

        function updateNavigationButtons() {
            const previousBtn = document.getElementById('previous-btn');
            const nextBtn = document.getElementById('next-btn');

            if (questionNumber === 0) {
                previousBtn.disabled = true;
                previousBtn.classList.add('opacity-50', 'cursor-not-allowed');
            } else {
                previousBtn.disabled = false;
                previousBtn.classList.remove('opacity-50', 'cursor-not-allowed');
            }

            if (questionNumber === totalQuestions - 1) {
                nextBtn.textContent = 'Selesai';
                nextBtn.onclick = () => alert('Selesai Dikerjakan');
            } else {
                nextBtn.textContent = 'Selanjutnya';
                nextBtn.onclick = () => navigateQuestion('next');
            }
        }

        function generateQuestionNumbers() {
            const questionNumbersContainer = document.getElementById('question-numbers');
            questionNumbersContainer.innerHTML = ''; // Clear existing question numbers
            for (let i = 0; i < totalQuestions; i++) {
                const questionNumberElement = document.createElement('a');
                questionNumberElement.href = '#';
                questionNumberElement.id = `question-number-${i + 1}`;
                questionNumberElement.className =
                    'p-1 text-center border-2 rounded hover:text-green-700 hover:border-green-700';
                questionNumberElement.textContent = i + 1;
                questionNumberElement.onclick = (e) => {
                    e.preventDefault();
                    questionNumber = i;
                    sessionStorage.setItem('questionNumber', questionNumber);
                    displayQuestion(questionNumber);
                };
                questionNumbersContainer.appendChild(questionNumberElement);
            }
        }
    </script>
</x-app-layout>
