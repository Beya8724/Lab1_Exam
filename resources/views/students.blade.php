<!DOCTYPE html>
<html>
<head>
    <title>Student Record</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light py-5">

<div class="container">
    <h2 class="mb-4">Student Record</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Search Box -->
    <div class="mb-3">
        <input type="text" id="searchInput" class="form-control" placeholder="Search students...">
    </div>

    <!-- Add Student Button -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addStudentModal">Add Student</button>

    <!-- Students Table -->
    <table class="table table-bordered bg-white shadow-sm" id="studentsTable">
        <thead class="table-dark">
            <tr>
                <th>ID Number</th>
                <th>Name</th>
                <th>Email</th>
                <th>Course</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @forelse($students as $student)
            <tr data-id="{{ $student->id }}"
                data-student_id="{{ $student->student_id }}"
                data-name="{{ $student->name }}"
                data-email="{{ $student->email }}"
                data-course="{{ $student->course }}">
                <td>{{ $student->student_id }}</td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->email }}</td>
                <td>{{ $student->course }}</td>
                <td>
                    <button class="btn btn-sm btn-warning btn-edit" data-bs-toggle="modal" data-bs-target="#editStudentModal">Edit</button>

                    <form action="/students/{{ $student->id }}" method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="5" class="text-center">No students found.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>

<!-- Add Student Modal -->
<div class="modal fade" id="addStudentModal" tabindex="-1" aria-labelledby="addStudentLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form action="/students" method="POST" class="modal-content">
      @csrf
      <div class="modal-header">
        <h5 class="modal-title" id="addStudentLabel">Add Student</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div class="mb-3">
              <input type="text" name="student_id" class="form-control" placeholder="ID Number" required>
          </div>
          <div class="mb-3">
              <input type="text" name="name" class="form-control" placeholder="Full Name" required>
          </div>
          <div class="mb-3">
              <input type="email" name="email" class="form-control" placeholder="Email" required>
          </div>
          <div class="mb-3">
              <input type="text" name="course" class="form-control" placeholder="Course" required>
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Add Student</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
      </div>
    </form>
  </div>
</div>

<!-- Edit Student Modal -->
<div class="modal fade" id="editStudentModal" tabindex="-1" aria-labelledby="editStudentLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="editStudentForm" method="POST" class="modal-content">
      @csrf
      @method('PUT')
      <div class="modal-header">
        <h5 class="modal-title" id="editStudentLabel">Edit Student</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <input type="hidden" name="id" id="edit-id">
          <div class="mb-3">
              <input type="text" name="student_id" id="edit-student_id" class="form-control" placeholder="ID Number" required>
          </div>
          <div class="mb-3">
              <input type="text" name="name" id="edit-name" class="form-control" placeholder="Full Name" required>
          </div>
          <div class="mb-3">
              <input type="email" name="email" id="edit-email" class="form-control" placeholder="Email" required>
          </div>
          <div class="mb-3">
              <input type="text" name="course" id="edit-course" class="form-control" placeholder="Course" required>
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success">Update Student</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
      </div>
    </form>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Edit button functionality
    const editButtons = document.querySelectorAll('.btn-edit');
    const editForm = document.getElementById('editStudentForm');

    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            const tr = this.closest('tr');
            const id = tr.getAttribute('data-id');
            const student_id = tr.getAttribute('data-student_id');
            const name = tr.getAttribute('data-name');
            const email = tr.getAttribute('data-email');
            const course = tr.getAttribute('data-course');

            document.getElementById('edit-id').value = id;
            document.getElementById('edit-student_id').value = student_id;
            document.getElementById('edit-name').value = name;
            document.getElementById('edit-email').value = email;
            document.getElementById('edit-course').value = course;

            editForm.action = '/students/' + id;
        });
    });

    // Search/filter functionality
    const searchInput = document.getElementById('searchInput');
    const tableBody = document.querySelector('#studentsTable tbody');

    searchInput.addEventListener('keyup', function() {
        const filter = searchInput.value.toLowerCase();
        const rows = tableBody.getElementsByTagName('tr');

        for(let i = 0; i < rows.length; i++) {
            const cells = rows[i].getElementsByTagName('td');
            let match = false;

            for(let j = 0; j < cells.length - 1; j++) { // exclude last column (Actions)
                if(cells[j].textContent.toLowerCase().includes(filter)) {
                    match = true;
                    break;
                }
            }

            rows[i].style.display = match ? '' : 'none';
        }
    });
});
</script>

</body>
</html>
