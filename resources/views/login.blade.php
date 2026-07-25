<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #d1e7dd; } /* Green pastel background */
        .card { border-color: #a3cfbb; }
        .btn-primary { background-color: #198754; border-color: #198754; }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4 shadow-sm" style="width: 350px;">
        <h3 class="text-center text-success fw-bold">Shape and Color Records</h3>
        <h3 class="text-center text-success fw-bold">Login Page</h3>
        
        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="/login" method="POST">
            @csrf
            <div class="mb-3 text-center">
                <label>Login As</label><br>
                <input type="radio" name="role" value="admin" checked> Admin
                <input type="radio" name="role" value="user" class="ms-2"> User
            </div>
            <div class="mb-3">
                <input type="text" name="username" class="form-control" placeholder="Username" required>
            </div>
            <div class="mb-3 position-relative">
                <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
                <button type="button" class="btn btn-sm btn-outline-secondary mt-2" onclick="togglePassword()">Show/Hide Password</button>
            </div>
            <script> function togglePassword() {
                var x = document.getElementById("password");
                if (x.type === "password") {
                     x.type = "text"; } 
                else {
                     x.type = "password"; }
                     }
                </script>


            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
    </div>
</body>
</html>