@extends('layout.app')
@section('content')
<div class="container">
    <div class="row my-5">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Subtopic Form</h4>
                    <form action="{{ route('ststore') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="course">Course</label>
                            <select id="course-dropdown" class="form-control" name="course_id">
                                <option value="">-- Select Course --</option>
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}">{{ $course->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="topic">Topic</label>
                            <select id="topic-dropdown" class="form-control" name="topic_id">
                                <option value="">-- Select Topic --</option>
                                <!-- Topics will be dynamically loaded based on the selected course using JavaScript -->
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="subtopicname">Subtopic Name</label>
                            <input type="text" class="form-control" id="subtopicname" name="name" placeholder="Enter Subtopic...">
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="card p-4">
        <table class="table table-hover mt-3 " id="example">
            <thead>
                <tr>
                    <th colspan="4">
                        List Of Subtopic
                    </th>
                </tr>
                <tr>
                    <th>ID</th>
                    <th>Course</th>
                    <th>Topic</th>
                    <th>Subtopic</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($subtopics as $subtopic)
                    <tr>
                        <td>{{ $subtopic->id }}</td>
                        <td>{{ $subtopic->topic->course->name }}</td>
                        <td>{{ $subtopic->topic->name }}</td>
                        <td>{{ $subtopic->name }}</td>
                        <td>
                            <a class="btn btn-outline-primary" href="{{url('stedit',$subtopic->id)}}">Edit</a>
                            <a class="btn btn-outline-danger" href="{{url('stdelete',$subtopic->id)}}">Delete</a> 
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
               
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        // Get the course dropdown element
        var courseDropdown = $('#course-dropdown');

        // When the course selection changes
        courseDropdown.on('change', function() {
            var selectedCourseId = $(this).val();

            // Clear the previous topics and disable the dropdown
            var topicDropdown = $('#topic-dropdown');
            topicDropdown.empty().prop('disabled', true);
            topicDropdown.append($('<option>').text('-- Select Topic --').val(''));

            // If a course is selected
            if (selectedCourseId) {
                // Make an AJAX request to fetch the topics based on the selected course
                $.ajax({
                    url: '/topics/' + selectedCourseId + '/get-topics',
                    type: 'GET',
                    success: function(response) {
                        // Enable the topic dropdown
                        topicDropdown.prop('disabled', false);

                        // Populate the topic dropdown with the fetched topics
                        $.each(response.topics, function(index, topic) {
                            topicDropdown.append($('<option>').text(topic.name).val(topic.id));
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }
        });
    });

    $(document).ready(function() {
            $('#example').DataTable();
        } );
</script>
</div>
@endsection