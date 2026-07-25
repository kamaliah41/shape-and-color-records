<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Portal - Shape and Color Records</title> <!--title-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <!-- popup -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body { background-color: #f0f7f4; }
        .navbar-custom { background-color: #a8d5ba; }
        .card { border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border-radius: 10px; }
        .btn-success-custom { background-color: #88c0a0; border: none; color: white; }
        .btn-success-custom:hover { background-color: #72a98a; color: white; }
        .table thead { background-color: #a8d5ba; color: white; }

    /* css for shape*/
    .preview-shape{
        margin:auto;
    }

    .circle{
        width:30px;
        height:30px;
        border-radius:50%;
    }

    .square{
        width:30px;
        height:30px;
    }

    .rectangle{
        width:45px;
        height:25px;
    }

    .triangle{
        width:0;
        height:0;
        border-left:15px solid transparent;
        border-right:15px solid transparent;
        border-bottom:30px solid;
    }

    .action-btn{
    width:36px;
    height:36px;
    border:none;
    border-radius:8px;
    display:inline-flex;
    justify-content:center;
    align-items:center;
    transition:0.2s;
    }

    .edit-btn{
    background:#ffc107;
    color:white;
    }

    .edit-btn:hover{
    background:#e0a800;
    }

    .delete-btn{
    background:#dc3545;
    color:white;
    }

    .delete-btn:hover{
    background:#bb2d3b;
    }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-light navbar-custom mb-4 px-4 shadow-sm">
        <div>
            <span class="navbar-brand text-white fw-bold mb-0 h1">Shape and Color Records</span>
            <small class="text-white-50 d-block" style="font-size: 0.8rem;">Internship Assignment - Kamaliah</small>
        </div>
        <div class="d-flex align-items-center text-white">

            <span class="fw-semibold">
                {{ ucfirst(session('role')) }}
            </span>

            <span class="mx-2">|</span>

            <a href="/logout" class="text-white text-decoration-none fw-semibold">
                Logout
            </a>

        </div>
        <!--<a href="/logout" class="btn btn-danger btn-sm">Logout</a>-->
    </nav>

    <div class="container-fluid px-4">
        <div class="row">
            
            <!-- Left side: data entry -->
            <div class="col-md-4 mb-4">
                <div class="card p-4">
                    <h4 class="text-success mb-3" id="formTitle">Add New Entry</h4>
                    <form id="adminForm">
                        <input type="hidden" id="itemId">
                        
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" id="name" class="form-control" placeholder="Enter name" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Shape</label>
                            <select id="shape" class="form-select" required>
                                <option value="" disabled selected>Select shape</option>
                                <option value="Square">Square</option>
                                <option value="Circle">Circle</option>
                                <option value="Triangle">Triangle</option>
                                <option value="Rectangle">Rectangle</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Color</label>
                            <select id="color" class="form-select" required>
                                <option value="" disabled selected>Select color</option>
                                <option value="Red">Red</option>
                                <option value="Blue">Blue</option>
                                <option value="Green">Green</option>
                                <option value="Yellow">Yellow</option>
                                <option value="White">White</option>
                                <option value="Black">Black</option>
                                <option value="Purple">Purple</option>
                            </select>
                        </div>
                        
                        <button type="submit" class="btn btn-success-custom w-100" id="submitBtn">Submit Entry</button>
                        <button type="button" class="btn btn-secondary w-100 mt-2 d-none" id="cancelBtn" onclick="resetForm()">Cancel Edit</button>
                    </form>
                </div>
            </div>

            <!-- Right side: grid table for entries -->
            <div class="col-md-8">
                <div class="card p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-success mb-0">Entries Data Grid</h4>
                        <span class="badge bg-success p-2" id="totalEntriesBadge">Total entries: 0</span>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle">
                            <thead>
                                <tr>
                                    <th>Timestamp</th>
                                    <th>Name</th>
                                    <th>Shape</th>
                                    <th>Color</th>
                                    <th class="text-center">Preview</th>
                                    <th class="text-center" style="width: 120px;">Action</th>
                                </tr>
                            </thead>
                            <tbody id="tableBody">
                                <tr>
                                    <td colspan="6" class="text-center">Loading data...</td>
                                </tr>
                            </tbody>
                        </table> 
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script> 

        //shape n color
        function generateShape(shape, color) {

        let className = shape.toLowerCase();

        if (shape === "Triangle") {
        return `<div class="preview-shape triangle" style="border-bottom-color:${color.toLowerCase()};"></div>`;
        }

        return `<div class="preview-shape ${className}" style="background-color:${color.toLowerCase()};"></div>`;
        }
        // fetch admin data
        async function fetchAdminData() {
            try {
                const res = await fetch('/api/items');
                console.log(res);
                const data = await res.json();
                console.log("Data:", data);
                const tbody = document.getElementById('tableBody');
                
                // update entries (total)
                document.getElementById('totalEntriesBadge').innerText = `Total entries: ${data.length}`;

                if (data.length === 0) {
                    tbody.innerHTML = `<tr><td colspan="5" class="text-center">No entries found.</td></tr>`;
                    return;
                }

                tbody.innerHTML = data.map(item => `
                    <tr>
                        <td>${item.created_at}</td>
                        <td>${item.name}</td>
                        <td>${item.shape}</td>
                        <td>${item.color}</td>

                        <td class="text-center">
                        ${generateShape(item.shape, item.color)}
                        </td>

                        <td class="text-center">
                            
                            <button class="btn btn-sm btn-warning text-white me-1" 
                            onclick="editItem(${item.id}, '${item.name}', '${item.shape}', '${item.color}')" title="Edit">
                            <i class="bi bi-pencil-fill"></i>
                            </button>

                            <button class="btn btn-sm btn-danger" 
                            onclick="deleteItem(${item.id})" title="Delete">
                            <i class="bi bi-trash-fill"></i></button>
                        </td>
                    </tr>
                `).join('');
            } catch (error) {
                console.error('Error:', error);
            }
        }

        // add or update getElement
        document.getElementById('adminForm').addEventListener('submit', async (e) => {
            e.preventDefault();

            const submitBtn = document.getElementById('submitBtn');

            
            submitBtn.disabled = true;

            
            submitBtn.innerText = document.getElementById('itemId').value
                ? 'Updating...'
                : 'Saving...';


            const id = document.getElementById('itemId').value;
            const name = document.getElementById('name').value;
            const shape = document.getElementById('shape').value;
            const color = document.getElementById('color').value;

            const url = id ? `/api/items/${id}` : '/api/items';
            const method = id ? 'PUT' : 'POST';

            const response = await fetch(url, {
                method: method,
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: JSON.stringify({ name, shape, color })
            });

            if (response.ok) {
                Swal.fire({
                    icon: 'success',
                    title: id ? 'Updated successfully!' : 'New entry successful!',
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    submitBtn.disabled = false;
                    submitBtn.innerText = 'Submit Data';
                    resetForm();
                    fetchAdminData();
                });
            }
        });

        // edit feature
        function editItem(id, name, shape, color) {
            document.getElementById('itemId').value = id;
            document.getElementById('name').value = name;
            document.getElementById('shape').value = shape;
            document.getElementById('color').value = color;
            document.getElementById('formTitle').innerText = 'Edit Item';
            document.getElementById('submitBtn').innerText = 'Update Data';
            document.getElementById('cancelBtn').classList.remove('d-none');
        }

        // reset button clicked
        function resetForm() {
            document.getElementById('adminForm').reset();
            document.getElementById('itemId').value = '';
            document.getElementById('formTitle').innerText = 'Add New Entry';
            document.getElementById('submitBtn').innerText = 'Submit Entry';
            document.getElementById('cancelBtn').classList.add('d-none');
        }

        // delete entry
        async function deleteItem(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then(async (result) => {
                if (result.isConfirmed) {
                    const res = await fetch(`/api/items/${id}`, {
                        method: 'DELETE',
                        headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
                    });
                    if (res.ok) {
                        Swal.fire('Deleted!', 'Entry has been deleted.', 'success');
                        fetchAdminData();
                    }
                }
            });
        }

        fetchAdminData();
    </script>
</body>
</html>