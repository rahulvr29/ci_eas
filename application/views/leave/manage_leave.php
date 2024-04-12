<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Leave Requests</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="mt-3 mb-4">Manage Leave Requests</h2>
        <?php if (!empty($leave_requests)): ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Employee Name</th>
                        <th>Leave From</th>
                        <th>Leave To</th>
                        <th>Reason</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($leave_requests as $index => $request): ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td><?php echo $request['employee_name']; ?></td>
                            <td><?php echo $request['leave_from']; ?></td>
                            <td><?php echo $request['leave_to']; ?></td>
                            <td><?php echo $request['leave_reason']; ?></td>
                            <td><?php echo $request['description']; ?></td>
                            <td><?php echo $request['status']; ?></td>
                            <td>
                                <a href="<?php echo base_url('leave/insert_approve/' . $request['id']); ?>" class="btn btn-success">Approve</a>
                                <a href="<?php echo base_url('leave/insert_reject/' . $request['id']); ?>" class="btn btn-danger">Reject</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="alert alert-info">No leave requests found.</div>
        <?php endif; ?>
    </div>
</body>
</html>
