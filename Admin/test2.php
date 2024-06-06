<?php
// Database connection
$connection = mysqli_connect("localhost", "root", "", "syllabus");
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    die();
}

// Retrieve search and pagination parameters
$search = isset($_GET['search']) ? $_GET['search'] : '';
$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Modify the query to support search and pagination
$query = "SELECT course.id, course.cname, course.commitee_signature, category.name as category_name
          FROM course
          INNER JOIN category ON course.catid = category.id
          WHERE course.cname LIKE '%$search%'
          ORDER BY category.name, course.cname
          LIMIT $limit OFFSET $offset";
$query_run = mysqli_query($connection, $query);

// Count total records for pagination
$count_query = "SELECT COUNT(*) as total
                FROM course
                INNER JOIN category ON course.catid = category.id
                WHERE course.cname LIKE '%$search%'";
$count_result = mysqli_query($connection, $count_query);
$total_records = mysqli_fetch_assoc($count_result)['total'];
$total_pages = ceil($total_records / $limit);

// Group courses by category
$courses_by_category = [];
while ($row = mysqli_fetch_assoc($query_run)) {
    $courses_by_category[$row['category_name']][] = $row;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Status</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
    <style>
        .hide-id {
            display: none;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <h1>Status</h1>

    <form method="get" action="">
        <div class="form-row">
            <div class="form-group col-md-6">
                <input type="text" class="form-control" name="search" placeholder="Search..." value="<?= htmlspecialchars($search) ?>">
            </div>
            <div class="form-group col-md-2">
                <input type="number" class="form-control" name="limit" placeholder="Records per page" value="<?= $limit ?>">
            </div>
            <div class="form-group col-md-2">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>

    <table id="myTable" class="table table-striped">
        <thead>
        <tr>
            <th>Course Name</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($courses_by_category as $category => $courses) { ?>
            <tr>
                <td colspan="2"><h3><?= $category ?></h3></td>
            </tr>
            <?php foreach ($courses as $course) { ?>
                <tr>
                    <td class="hide-id"><?= $course['id']; ?></td>
                    <td><?= $course['cname']; ?></td>
                    <td><?= $course['commitee_signature'] === 'No Signature' ? 'Pending' : 'Approve'; ?></td>
                </tr>
            <?php } ?>
        <?php } ?>
        </tbody>
    </table>

    <nav>
        <ul class="pagination">
            <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                    <a class="page-link" href="?search=<?= htmlspecialchars($search) ?>&limit=<?= $limit ?>&page=<?= $i ?>"><?= $i ?></a>
                </li>
            <?php } ?>
        </ul>
    </nav>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>

<script>
$(document).ready(function() {
    $('#myTable').DataTable({
        "paging": false, // Disable built-in paging
        "info": false,   // Disable built-in info
        "searching": false, // Disable built-in search
    });
});
</script>
</body>
</html>
