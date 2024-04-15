<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave List</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.css">
</head>

<body>
    <div class="container mt-5">
        <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success"><?php echo $this->session->flashdata('success'); ?></div>
        <?php endif; ?>
        <div class="d-flex align-items-center justify-content-between">
            <h1>Leave List</h1>
        <!-- Back button -->
            <a href="<?php echo base_url('admin'); ?>" class="btn btn-primary">Back </a></div>
        <table class="table" id="leaveList">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Employee ID</th>
                    <th>Employee Email</th>
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
                    <td><?php echo $leave['employeeName']; ?></td>
                    <td><?php echo $leave['leave_reason']; ?></td>
                    <td><?php echo $leave['leave_from']; ?></td>
                    <td><?php echo $leave['leave_to']; ?></td>
                    <td><?php echo $leave['description']; ?></td>
                    <td>
                        <?php if ($leave['status'] == 'pending'): ?>
                        <span class="badge badge-info"><i class="fas fa-clock"></i> Pending</span>
                        <?php elseif ($leave['status'] == 'approved'): ?>
                        <span class="badge badge-success"><i class="fas fa-check-circle"></i> Approved</span>
                        <?php elseif ($leave['status'] == 'rejected'): ?>
                        <span class="badge badge-danger"><i class="fas fa-times-circle"></i> Rejected</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($leave['status'] == 'pending'): ?>
                        <a href="<?php echo base_url('leave/approve_leave/' . $leave['id']); ?>">
                            <button type="button" class="btn btn-success btn-sm rounded-circle ml-2 mr-2"
                                data-toggle="modal" data-target="#approveModal<?php echo $leave['id']; ?>"
                                style="width: 35px; height: 35px; border: none; background-color: #28a745;">
                                <i class="fa fa-check" style="color: white; font-size: 15px;"></i>
                            </button>
                        </a>
                        <a href="<?php echo base_url('leave/reject_leave/' . $leave['id']); ?>">
                            <button type="button" class="btn btn-danger btn-sm rounded-circle" data-toggle="modal"
                                data-target="#rejectModal<?php echo $leave['id']; ?>"
                                style="width: 35px; height: 35px; border: none; background-color: #dc3545;">
                                <i class="fa fa-times" style="color: white; font-size: 15px;"></i>
                            </button>
                        </a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
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
