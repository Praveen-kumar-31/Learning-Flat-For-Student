<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>@yield('title')</title>
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
        <script src="{{ asset('js/scripts.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    </head>
    <body>
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">Amypo</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="/logout">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            
                            <div class="sb-sidenav-menu-heading">Student details</div>
                            <a class="nav-link" href="/students">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                 Student Dashboard
                            </a>
                            
                            <a class="nav-link" href="/viewcourse">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Course
                            </a>  
                            <!-- <a class="nav-link" href="/course1">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Test
                            </a>                            -->
                            <a class="nav-link" href="/logout">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                               Logout
                            </a>                        
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        Start Bootstrap
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                <div class="container">
        <div class="row">
            <div class="col-md-10 p-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Course: {{ $course->name }}</h4>

                        @if ($topics->count() > 0)
                            <ul>
                                @foreach ($topics as $topic)
                                    <li class="nav-item">
                                        <a class="nav-link btn-outline-light dropdown-toggle custom-dropdown" data-bs-toggle="collapse" href="#topic{{ $topic->id }}"
                                            aria-expanded="false" aria-controls="topic{{ $topic->id }}">
                                            <span class="menu-title">{{ $topic->name }}</span>
                                            <i class="menu-arrow"></i>
                                        </a>
                                        <div class="collapse" id="topic{{ $topic->id }}">
                                            <ul class="nav flex-column sub-menu">
                                                @foreach ($subtopics as $subtopic)
                                                    @if ($subtopic->topic_id === $topic->id)
                                                        <li class="nav-item">
                                                            <a class="nav-link subtopic-btn" href="#" data-subtopic="{{ $subtopic->id }}">
                                                                {{ $subtopic->name }}
                                                            </a>
                                                        </li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p>No topics found for this course.</p>
                        @endif
                    </div>
                </div>
            </div>
                                        
            <div class="col-md-10 p-4">
               
                        <!-- <h4 class="card-title">Questions</h4> -->
                        <div class="row">
                        
                            <div class="coding-content" id="codingQuestions">
                        
                                <!-- Coding questions will be displayed here -->
                            </div>
                            <div class="coding-buttons" style="display: none;">
                                <div class="card">
                                <div class="card-body">
                                <h6>Coding </h6>
                                <button class="btn btn-outline-primary workout-btn" data-subtopic="{{ $subtopic->id }}">Brainstorm</button>
                                <button class="btn btn-outline-success practice-btn" data-subtopic="{{$subtopic->id }}">Practice</button>
                                    <a class="btn btn-outline-secondary take-test-btn float-end" href="#">Take Coding Test</a>

                                </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="mcq-content" id="mcqQuestions">
                                <!-- MCQ questions will be displayed here -->
                            </div>
                            <br>
                            <div class="mcq-buttons" style="display: none;">
                                <div class="card">
                                    <div class="card-body">
                                        <h6>MCQ</h6>
                                        <button class="btn btn-outline-primary workout-btn" data-subtopic="{{ $subtopic->id }}">Brainstorm</button>
                                        <button class="btn btn-outline-success practice-btn" data-subtopic="{{ $subtopic->id }}">Practice</button>
                                        <button class="btn btn-outline-secondary load-mcq-questions float-end">Take Mcq Test</button>
                                    </div>
                                </div>
                            </div>
                        </div>                      
                    </div>
                </div>
            </div>
        </div>    
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
    <script>
      document.querySelector('.load-mcq-questions').addEventListener('click', function (e) {
        e.preventDefault();

        const subtopicId = '{{ $subtopic->id }}'; // Replace with the actual subtopic ID

        fetch(`/mcqtest/${subtopicId}`)
            .then(response => response.json())
            .then(data => {
                const mcqQuestionsContainer = document.querySelector('#mcqQuestions');

                mcqQuestionsContainer.innerHTML = ''; // Clear previous questions

                if (data.mcqQuestions.length > 0) {
                    data.mcqQuestions.forEach(question => {
                        const questionElement = document.createElement('div');
                        questionElement.classList.add('card', 'mb-3');
                        const cardBody = document.createElement('div');
                        cardBody.classList.add('card-body');
                        const cardTitle = document.createElement('h5');
                        cardTitle.classList.add('card-title');
                        cardTitle.textContent = question.question;
                        cardBody.appendChild(cardTitle);
                        questionElement.appendChild(cardBody);
                        mcqQuestionsContainer.appendChild(questionElement);
                    });
                } else {
                    mcqQuestionsContainer.innerHTML = '<p>No MCQ questions available.</p>';
                }
            })
            .catch(error => console.error('Error loading MCQ questions:', error));
    });

         document.querySelectorAll('.subtopic-btn').forEach((btn) => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const subtopic_Id = btn.dataset.subtopic;
            loadTestQuestions(subtopic_Id);
            // Hide all other content
            document.querySelectorAll('.coding-content, .mcq-content').forEach((content) => {
                content.style.display = 'none';
            });
            document.querySelectorAll('.coding-buttons, .mcq-buttons').forEach((buttons) => {
                buttons.style.display = 'block';
            });
        });
    });

    function loadTestQuestions(subtopicId) {
        // Fetch coding questions and update the content
        fetch(`/get-questions/${subtopicId}`)
    .then((response) => response.json())
    .then((data) => {
        const codingQuestions = document.querySelector('#codingQuestions');
        const mcqQuestions = document.querySelector('#mcqQuestions');
        const codingButtons = document.querySelector('.coding-buttons');
        const mcqButtons = document.querySelector('.mcq-buttons');

        // Update coding questions
        codingQuestions.innerHTML = '';
        if (data.coding.length > 0) {
            data.coding.forEach((question) => {
                const questionElement = document.createElement('p');
                questionElement.textContent = question.question;
                codingQuestions.appendChild(questionElement);
            });
            codingButtons.style.display = 'block';
        } else {
            codingQuestions.innerHTML = '<p>No coding questions found for this subtopic.</p>';
            codingButtons.style.display = 'none';
        }

        // Update MCQ questions
        mcqQuestions.innerHTML = '';
        if (data.mcq.length > 0) {
            data.mcq.forEach((question) => {
                const questionContainer = document.createElement('div');
                const questionElement = document.createElement('p');
                questionElement.textContent = question.question;
                questionContainer.appendChild(questionElement);
                mcqQuestions.appendChild(questionContainer);
            });
            mcqButtons.style.display = 'block';
        } else {
            mcqQuestions.innerHTML = '<p>No MCQ questions found for this subtopic.</p>';
            mcqButtons.style.display = 'none';
        }
    })
    .catch((error) => console.error('Error fetching questions:', error));}

    document.querySelectorAll('.workout-btn, .practice-btn').forEach((btn) => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                
                const subtopicId = btn.getAttribute('data-subtopic');

                // Hide all other content
                document.querySelectorAll('.take-test-btn').forEach((takeTestBtn) => {
                    takeTestBtn.style.display = 'none';
                });

                // Show the "Take Test" button and set the redirection link
                const takeTestBtn = e.currentTarget.parentElement.querySelector('.take-test-btn');
                takeTestBtn.style.display = 'block';

                // Determine which type of test to link to
                const testType = btn.classList.contains('workout-btn') ? 'coding' : 'mcq';
                takeTestBtn.href = `/testquestions/${subtopicId}`; // Change this to your actual coding test route
             // Change this to your actual MCQ test route
            });
        });


</script>
             
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>        
    </body>
</html>
