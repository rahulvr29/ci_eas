<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave List</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Leave List</h1>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th>Leave ID</th>
                    <th>Employee ID</th>
                    <th>Leave Reason</th>
                    <th>Leave From</th>
                    <th>Leave To</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($leave_list as $leave): ?>
                <tr>
                    <td><?php echo $leave['id']; ?></td>
                    <td><?php echo $leave['employee_id']; ?></td>
                    <td><?php echo $leave['leave_reason']; ?></td>
                    <td><?php echo $leave['leave_from']; ?></td>
                    <td><?php echo $leave['leave_to']; ?></td>
                    <td><?php echo $leave['description']; ?></td>
                    <td><?php echo $leave['status']; ?></td>
                    <td>
                        <?php if ($leave['status'] == 'pending'): ?>
                        <a href="<?php echo base_url('leave/approve_leave/' . $leave['id']); ?>" class="btn btn-success">Approve</a>
                        <a href="<?php echo base_url('leave/reject_leave/' . $leave['id']); ?>" class="btn btn-danger">Reject</a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
