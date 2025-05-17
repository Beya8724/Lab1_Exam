<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light py-5">

<div class="container">
    <h2 class="mb-4">Edit Student</h2>

    <form action="/students/{{ $student->id }}" method="POST" class="card p-4 shadow-sm">
        @csrf
        @method('PUT')
        <div class="row g-3">
            <div class="col-md-3">
                <input type="text" name="student_id" class="form-control" value="{{ $student->student_id }}" required>
            </div>
            <div class="col-md-3">
                <input type="text" name="name" class="form-control" value="{{ $student->name }}" required>
            </div>
            <div class="col-md-3">
                <input type="email" name="email" class="form-control" value="{{ $student->email }}" required>
            </div>
            <div class="col-md-3">
                <input type="text" name="course" class="form-control" value="{{ $student->course }}" required>
            </div>
        </div>
        <div class="mt-3 text-end">
            <button type="submit" class="btn btn-success">Update</button>
            <a href="/" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

</body>
</html>
