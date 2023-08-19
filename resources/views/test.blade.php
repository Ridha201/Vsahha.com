<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
</head>
<body>
    @extends('theme')
    @section('content')

    <table id="table_id" class="display">
        <thead>
            <tr>
                <th>Name</th>
                <th>Age</th>
                <th>Location</th> <!-- Add Location and Contact columns -->
                <th>Contact</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>James</td>
                <td>24</td>
                <td>USA</td>
                <td>+123456789</td>
            </tr>
            <tr>
                <td>Raj</td>
                <td>25</td>
                <td>India</td>
                <td>+987654321</td>
            </tr>
        </tbody>
    </table>

    @endsection

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    
    <script>
$(document).ready(function () {
            var data = [{
    "Name": "Paul",
    "Age": 22,
    "Location": "Canada",
    "Contact": "+1290418345"
			},
  {
    "Name": "Erica",
    "Age": 32,
    "Location": "Miami",
    "Contact": "+1992418345"
			},
  {
    "Name": "Pritam",
    "Age": 29,
    "Location": "India",
    "Contact": "+91977418345"
			},
  {
    "Name": "Williams",
    "Age": 20,
    "Location": "England",
    "Contact": "+324290418345"
			}
			];

    $('#table_id').DataTable({
                "destroy": true,
                "paging": true,
                "ordering": true,
                "data": data,
                "pageLength": 1,
                "columns": [
                    { "data": "Name" },
                    { "data": "Age" },
                    { "data": "Location" },
                    { "data": "Contact" }
                ]
            });
});
    </script>
</body>
</html>