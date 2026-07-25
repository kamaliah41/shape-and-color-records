<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f0f7f4; }
        .navbar { background-color: #a8d5ba; }
        .table thead { background-color: #a8d5ba; color: white; }
        .navbar-custom{
        background-color:#a8d5ba;}

        .card{
            border:none;
            box-shadow:0 4px 6px rgba(0,0,0,.05);
            border-radius:10px;
        }

        .table thead{
            background:#a8d5ba;
            color:white;
        }

        .preview-shape{
            margin:auto;
            display:block;
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



    </style>
</head>
<body>
    <nav class="navbar navbar-light navbar-custom mb-4 px-4 shadow-sm">
        <div>
            <span class="navbar-brand text-white fw-bold mb-0 h1">
                Shape and Color Records
            </span>

            <small class="text-white-50 d-block"
                style="font-size:.8rem;">
                Internship Assignment - Kamaliah
            </small>
</div>
        <div class="d-flex align-items-center text-white">

        <span class="fw-semibold">
            <i class="bi bi-person-circle"></i>
            User ({{ session('name') }})
        </span>

        <span class="mx-2">|</span>

        <a href="/logout"
           class="text-white text-decoration-none fw-semibold">Logout
        </a>
        </div>

    </nav>

    <div class="container">
        <div class="card p-4 shadow-sm border-0">
            <div class="d-flex justify-content-between align-items-center mb-3">

                <div>
                    <h4 class="text-success mb-1">
                        Shape and Color Records
                    </h4>

                    <small class="text-muted">
                        Live updates • Automatically updated with the latest records from the admin portal.
                    </small>
                </div>

                
                <span class="badge bg-success px-3 py-2" id="totalEntriesBadge">
                    Total Records: 
                </span>

            </div>
            


            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Timestamp</th>
                            <th>Name</th>
                            <th>Shape</th>
                            <th>Color</th>
                            <th class="text-center">Preview</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        <tr>
                            <td colspan="5" class="text-center">Loading data...</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        function generateShape(shape, color){

            let className = shape.toLowerCase();

            if(shape === "Triangle"){
                return `<div class="preview-shape triangle"
                            style="border-bottom-color:${color.toLowerCase()};"></div>`;
            }

            return `<div class="preview-shape ${className}"
                        style="background-color:${color.toLowerCase()};"></div>`;
        }
        async function fetchItems() {
            try {
                const response = await fetch('/api/items');
                const data = await response.json();

                document.getElementById('totalEntriesBadge').innerText =
                `Total Records: ${data.length}`;
                
                const tbody = document.getElementById('tableBody');
                
                
                if (data.length === 0) {
                    tbody.innerHTML = `<tr><td colspan="5" class="text-center">No entry</td></tr>`;
                    return;
                }

                tbody.innerHTML = data.map(item => `
                    <tr>
                        <td>${item.created_at}</td>
                        <td>${item.name}</td>
                        <td>${item.shape}</td>
                        <td>${item.color}</td>
                        <td class="text-center"> ${generateShape(item.shape,item.color)}
                        </td>
                    </tr>
                `).join('');
            } catch (error) {
                console.error('Error fetching data:', error);
            }
        }

        // Panggil fungsi masa page mula-mula buka
        fetchItems();

        // Auto-refresh setiap 5 saat (Real-time polling)
        setInterval(fetchItems, 5000);
    </script>
</body>
</html>