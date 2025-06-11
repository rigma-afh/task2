<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Resident Details</title>

    <!-- Bootstrap and Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Optional JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <style>
        body {
            color: #566787;
            background: #f5f5f5;
            font-family: 'Varela Round', sans-serif;
        }
        .modal-content {
            border-radius: 6px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.2);
        }
        .modal-header {
            background-color: #435d7d;
            color: white;
        }
        .form-control[readonly] {
            background-color: #f9f9f9;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>

<div class="modal-dialog">
    <div class="modal-content">

        <div class="modal-header">
            <h4 class="modal-title">Resident Details</h4>
        </div>

        <div class="modal-body">

            <div class="form-group">

                   <p>{{ $resident->name }}"</p>

            </div>

            <div class="form-group">

                <p>{{ $resident->email }}"</p>
            </div>

            <div class="form-group">

                <p>{{ $resident->address }}</p>
                </div>

            <div class="form-group">

                <p>{{ $resident->phone }}"</p>
            </div>

            <div class="form-group">
             
                <p>{{ $resident->gender }}</p>
            </div>

        </div>

        <div class="modal-footer">
            <a href="/residents" class="btn btn-secondary">Back</a>
        </div>

    </div>
</div>

</body>
</html>
