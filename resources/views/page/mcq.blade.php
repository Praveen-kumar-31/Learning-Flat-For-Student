@extends('layout.app')
@section('content')
<div class="card mt-5 mx-5">
    <div class="card-header">
        <h2>MCQ Question</h2>
    </div>
    <form action="{{ route('mcqstore') }}" method="POST">
        @csrf
        <div class="row mt-3 mx-2">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="course">Course</label>
                    <select id="course" class="form-control" name="course">
                        <option value="">-- Select Course --</option>
                        @foreach($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="topic">Topic</label>
                    <select id="topic" class="form-control" name="topic">
                        <option value="">-- Select Topic --</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="subtopic">Subtopic</label>
                    <select id="subtopic" class="form-control" name="subtopic">
                        <option value="">-- Select Subtopic --</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="row mt-3 mx-2">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="question">Question</label>
                    <textarea id="question" class="form-control" name="question" rows="4"></textarea>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="answer">Answer</label>
                    <textarea id="answer" class="form-control" name="answer" rows="4"></textarea>
                </div>
            </div>
        </div>
        
        <div class="row mt-3 mx-2">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="type">Type</label>
                    <select id="type" class="form-control" name="type">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                </div>
            </div>
        </div>
        <br>
        <button type="submit" class="btn btn-primary mt-3 mx-5 mb-5">Submit</button>
    </form>
    <div class="card-body">
        <h2>MCQ Questions List</h2>
        <div class="table-responsive">
        <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Course</th>
                        <th>Topic</th>
                        <th>Subtopic</th>
                        <th>Question</th>
                        <th>Answer</th>
                        <th>Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mcqs as $mcq)
                        <tr>
                            <td>{{ $mcq->course->name ?? ''}}</td>
                            <td>{{ $mcq->topic->name ?? '' }}</td>
                            <td>{{ $mcq->subtopic->name ?? '' }}</td>
                            <td>{{ $mcq->question}}</td>
                            <td>{{ $mcq->answer }}</td>
                            <td>{{ $mcq->type }}</td>
                            <td>
                                <a href="{{ route('mcq.edit', $mcq->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                <form action="{{ route('mcq.destroy', $mcq->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger delete-button">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    

    <!-- JavaScript libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18"></script>

    <script>
        
        $(document).ready(function() {
            // Get the topic dropdown element
            var topicDropdown = $('#topic');
            // Get the subtopic dropdown element
            var subtopicDropdown = $('#subtopic');

            // When the course selection changes
            $('#course').on('change', function() {
                var selectedCourseId = $(this).val();

                // Clear the previous topics and subtopics
                topicDropdown.empty();
                subtopicDropdown.empty();

                // If a course is selected
                if (selectedCourseId) {
                    // Make an AJAX request to fetch the topics and subtopics based on the selected course
                    axios.get('/gettopicside', {
                        params: {
                            course_id: selectedCourseId
                        }
                    })
                    .then(function(response) {
                        // Populate the topic dropdown with the fetched topics
                        topicDropdown.append($('<option>').text('-- Select Topic --').val(''));
                        $.each(response.data.topics, function(index, topic) {
                            topicDropdown.append($('<option>').text(topic.name).val(topic.id));
                        });

                        // Populate the subtopic dropdown with the fetched subtopics
                        subtopicDropdown.append($('<option>').text('-- Select Subtopic --').val(''));
                        $.each(response.data.subtopics, function(index, subtopic) {
                            subtopicDropdown.append($('<option>').text(subtopic.name).val(subtopic.id));
                        });
                    })
                    .catch(function(error) {
                        console.error(error);
                    });
                }
            });
        });
        $('#example').DataTable();

            // Add a click event listener to the delete button
            $(document).on('click', '.delete-button', function(event) {
                event.preventDefault();
                var deleteUrl = $(this).attr('href');
                
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    // If the user confirms the deletion
                    if (result.isConfirmed) {
                        window.location.href = deleteUrl;
                    }
                });
            });
        
    </script>  
</div>
@endsection
