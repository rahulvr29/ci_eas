<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave History</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
    <style>
        /* Optional: Add custom CSS here */
    </style>
</head>

<body>
    <div class="container">
        <div class="d-flex align-items-center justify-content-between mt-5">
        <h1 class="mt-4 mb-3">My Leave History</h1>
        <!-- Back button -->
        <a href="<?php echo base_url('profile'); ?>" class="btn btn-primary">Back to Profile</a>
        </div>
        <table id="leaveList" class="table">
            <thead class="thead-dark">
                <tr>
                    <th>Leave Reason</th>
                    <th>Leave From</th>
                    <th>Leave To</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Applied On</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($leave_history as $leave): ?>
                    <tr>
                        <td>
                            <?php echo $leave['leave_reason']; ?>
                        </td>
                        <td>
                            <?php echo $leave['leave_from']; ?>
                        </td>
                        <td>
                            <?php echo $leave['leave_to']; ?>
                        </td>
                        <td>
                            <?php echo $leave['description']; ?>
                        </td>
                        <td>
                            <?php if ($leave['status'] == 'pending'): ?>
                                <span class="badge badge-info">
                                    <i class="fas fa-clock"></i> Pending
                                </span>
                            <?php elseif ($leave['status'] == 'approved'): ?>
                                <span class="badge badge-success">
                                    <i class="fas fa-check-circle"></i> Approved
                                </span>
                            <?php elseif ($leave['status'] == 'rejected'): ?>
                                <span class="badge badge-danger">
                                    <i class="fas fa-times-circle"></i> Rejected
                                </span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php echo $leave['applied_on']; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
    </div>
    <!-- Bootstrap JS (optional, if you need it) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script>
        $(document).ready(function () {
            $('#leaveList').DataTable({
                "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]]
            });
        });
    </script>
</body>

</html>