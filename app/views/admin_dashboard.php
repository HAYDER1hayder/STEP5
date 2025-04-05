<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!--font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"
        integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .container {
            margin: 50px;
        }
        
        .body {
            background-color: #f8f9fa;
        }

        .form-group label {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <?php include '../../public/header.php'; ?>
    <div class="container">
        <?php
        if (isset($_SESSION['message'])) {
            echo "<div class='alert alert-success'>" . $_SESSION['message'] . "</div>";
            unset($_SESSION['message']);
        }
        ?>
        <table class="table  text-center table-striped">
            <thead class="table-dark bg-primary">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Weight</th>
                    <th scope="col">Height</th>
                    <th scope="col">BMI</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody style="font-size: 20px">
                <?php foreach ($records as $record): ?>
                    <tr>
                        <td><?= $record['id'] ?></td>
                        <td><?= $record['name'] ?></td>
                        <td><?= $record['weight'] ?></td>
                        <td><?= $record['height'] ?></td>
                        <td><?= round($record['bmi'], 2) ?></td>
                        <td><?= $record['status'] ?></td>
                        <td>
                            <a href="delete_bmi.php?id=<?= $record['id'] ?>" onclick="return confirm('Are you sure?')" class="link-dark"><i class="fa fa-trash-o fs-5 me-3" style="font-size:24px"></i></a>
                            <a href="#"
                                class="link-dark"
                                data-toggle="modal"
                                data-target="#editModal"
                                data-id="<?= $record['id'] ?>"
                                data-name="<?= $record['name'] ?>"
                                data-weight="<?= $record['weight'] ?>"
                                data-height="<?= $record['height'] ?>"
                                data-bmi="<?= $record['bmi'] ?>"
                                data-status="<?= $record['status'] ?>">
                                <i class="fa fa-edit fs-5" style="font-size:24px"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>





    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form method="POST" action="edit_bmi.php">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit BMI Record</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="edit-id">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" id="edit-name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Weight</label>
                            <input type="number" step="0.1" name="weight" id="edit-weight" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Height</label>
                            <input type="number" step="0.01" name="height" id="edit-height" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $('#editModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var name = button.data('name');
            var weight = button.data('weight');
            var height = button.data('height');

            var modal = $(this);
            modal.find('#edit-id').val(id);
            modal.find('#edit-name').val(name);
            modal.find('#edit-weight').val(weight);
            modal.find('#edit-height').val(height);
        });
    </script>




</body>

</html>