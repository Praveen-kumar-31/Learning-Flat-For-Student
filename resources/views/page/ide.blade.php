@extends('layout.app')
@section('content')
<div class="card mt-5 mx-5">
    <div class="card-header">
        <h2>Coding Question</h2>
    </div>
    <form action="{{route('idestore')}}" method="POST">
        @csrf
        <div class="row mt-3 mx-2">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="course">Course</label>
                    <select id="course" class="form-control" name="course_id">
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
                    <select id="topic" class="form-control" name="topic_id">
                        <option value="">-- Select Topic --</option>
                    </select>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="subtopic">Subtopic</label>
                    <select id="subtopic" class="form-control" name="subtopic_id">
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
        </div>
        <div class="row mt-3 mx-2">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="sample_input1">Sample Input 1</label>
                    <textarea id="sample_input1" class="form-control" name="sample_input1" rows="4"></textarea>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="sample_input2">Sample Input 2</label>
                    <textarea id="sample_input2" class="form-control" name="sample_input2" rows="4"></textarea>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="sample_input3">Sample Input 3</label>
                    <textarea id="sample_input3" class="form-control" name="sample_input3" rows="4"></textarea>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="sample_input4">Sample Input 4</label>
                    <textarea id="sample_input4" class="form-control" name="sample_input4" rows="4"></textarea>
                </div>
            </div>
        </div>
        <div class="row mt-3 mx-2">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="sample_output1">Sample Output 1</label>
                    <textarea id="sample_output1" class="form-control" name="sample_output1" rows="4"></textarea>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="sample_output2">Sample Output 2</label>
                    <textarea id="sample_output2" class="form-control" name="sample_output2" rows="4"></textarea>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="sample_output3">Sample Output 3</label>
                    <textarea id="sample_output3" class="form-control" name="sample_output3" rows="4"></textarea>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="sample_output4">Sample Output 4</label>
                    <textarea id="sample_output4" class="form-control" name="sample_output4" rows="4"></textarea>
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
        <button type="submit" class="btn btn-primary mt-3 mx-5 mb-3">Submit</button>
    </form>
    <div class="container">
        <h2>Coding Data</h2>
        <table class="table table-bordered" id="example">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Course</th>
                    <th>Topic</th>
                    <th>Subtopic</th>
                    <th>Question</th>
                    <th>Sample Input 1</th>
                    <th>Sample Input 2</th>
                    <th>Sample Input 3</th>
                    <th>Sample Input 4</th>
                    <th>Sample Output 1</th>
                    <th>Sample Output 2</th>
                    <th>Sample Output 3</th>
                    <th>Sample Output 4</th>
                    <th>Type</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($codings as $coding)
                <tr>
                    <td>{{$coding->id}}</td>
                    <td>{{ $coding->course->name ?? ''}}</td>
                    <td>{{ $coding->topic->name ?? '' }}</td>
                    <td>{{ $coding->subtopic->name ??''}}</td>
                    <td>{{ $coding->question }}</td>
                    <td>{{ $coding->sample_input1 }}</td>
                    <td>{{ $coding->sample_input2 }}</td>
                    <td>{{ $coding->sample_input3 }}</td>
                    <td>{{ $coding->sample_input4 }}</td>
                    <td>{{ $coding->sample_output1 }}</td>
                    <td>{{ $coding->sample_output2 }}</td>
                    <td>{{ $coding->sample_output3 }}</td>
                    <td>{{ $coding->sample_output4 }}</td>
                    <td>{{ $coding->type }}</td>
                    <td>
                        <a href="{{ route('coding.edit', $coding->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('coding.destroy', $coding->id) }}" method="POST" class="d-inline">
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
