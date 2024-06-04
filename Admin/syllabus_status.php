<?php include_once 'index.php'; ?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

<style>
    .hide-id {
        display: none;
    }
</style>

<div class="container-fluid">
    <h1>Status</h1>

    <?php
    // Database connection
    $connection = mysqli_connect("localhost", "root", "", "syllabus");
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        die();
    }

    $query = "SELECT course.id, course.cname, course.commitee_signature, category.name as category_name
              FROM course
              INNER JOIN category ON course.catid = category.id
              ORDER BY category.name, course.cname";
    $query_run = mysqli_query($connection, $query);

    // Group courses by category
    $courses_by_category = [];
    while ($row = mysqli_fetch_assoc($query_run)) {
        $courses_by_category[$row['category_name']][] = $row;
    }
    ?>

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
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>


