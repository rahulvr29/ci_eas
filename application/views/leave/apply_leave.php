<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apply for Leave</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Apply Leave</div>
                    <div class="card-body">
                        <?php echo form_open('leave/insert'); ?>
                        <?php
                        // Check if success flashdata exists
                        if ($this->session->flashdata('success')) {
                            echo '<div class="alert alert-success">' . $this->session->flashdata('success') . '</div>';
                        }
                        ?>
                        <div class="form-group">
                            <label for="txtreason">Reason</label>
                            <input type="text" name="txtreason" class="form-control" placeholder="Reason" required>
                        </div>
                        <div class="form-group">
                            <label for="txtleavefrom">Leave From</label>
                            <input type="date" name="txtleavefrom" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="txtleaveto">Leave To</label>
                            <input type="date" name="txtleaveto" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="txtdescription">Description</label>
                            <textarea name="txtdescription" class="form-control" placeholder="Description"></textarea>
                        </div>
                        <div class='d-flex gap-3'>
                            <button type="submit" class="btn btn-primary mr-3">Submit</button>
                            <?php echo form_close(); ?>
                            <!-- Back button -->
                            <a href="<?php echo base_url('profile'); ?>" class="btn btn-primary">Back </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
