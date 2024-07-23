
<?php require_once APPROOT . '/views/inc/admin/header.php'; ?>
<?php require_once APPROOT . '/views/inc/admin/sidebar.php'; ?>
<?php require_once APPROOT . '/views/inc/admin/navbar.php'; ?>
<?php require APPROOT . '/views/components/auth_message.php'; ?>
<style>
.table-header {
        background-color: #adb5bd;  /* Change to your preferred color */
        color: orangered; /* Text color */
    }
</style>
<!-- Button trigger modal -->
<button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal">
    Add Bus <i class="fas fa-plus"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Bus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addBusForm" action="<?php echo URLROOT; ?>/busController/store" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Bus Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>

                        <label for="bus_number" class="form-label">Bus Number</label>
                        <input type="text" class="form-control" id="bus_number" name="bus_number" required>

                        <label for="capacity" class="form-label">capacity</label>
                        <input type="number" class="form-control" id="capacity" name="capacity" required>


                       
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control" id="status" name="status" required>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>

<section id="buses">
    <div id="head">
    </div>
    <div id="bus-results">

        <table class="table table-hover table-bordered text-center">
            <thead class="table-header">
                <tr>
                    <th>#</th>
                    <th>Bus Name</th>
                    <th>Bus Number</th>
                    <th>capacity</th>
                  
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['buses'] as $bus) { ?>
                    <tr>
                        <td><?php echo $bus['id']; ?></td>
                        <td><?php echo $bus['name']; ?></td>
                        <td><?php echo $bus['bus_number']; ?></td>
                        <td><?php echo $bus['capacity']; ?></td>
                       
                        <td><?php echo $bus['status']; ?></td>
                        <td><?php echo $bus['date']; ?></td>
                        <td>
                            <!-- Edit Button -->
                            <button class="btn btn-primary" data-toggle="modal" data-target="#editModal<?php echo $bus['id']; ?>">Edit</button>

<!-- Delete Button -->
                            <button class="btn btn-danger" data-toggle="modal" data-target="#deleteBusModal<?php echo $bus['id']; ?>">delete</button>


                            <!-- Edit Bus Modal -->
                            <div class="modal fade" id="editModal<?php echo $bus['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?php echo $bus['id']; ?>" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel<?php echo $bus['id']; ?>">Edit Bus</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="<?php echo URLROOT; ?>/busController/update" method="POST">
                                                <input type="hidden" name="id" value="<?php echo $bus['id']; ?>">
                                                <div class="mb-3">
                                                    <label for="name" class="form-label">Bus Name</label>
                                                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $bus['name']; ?>" required>

                                                    <label for="bus_number" class="form-label">Bus Number</label>
                                                    <input type="text" class="form-control" id="bus_number" name="bus_number" value="<?php echo $bus['bus_number']; ?>" required>

                                                    <label for="capacity" class="form-label">capacity</label>
                                                    <input type="number" class="form-control" id="capacity" name="capacity" required>


                                                    
                                                    <label for="status" class="form-label">Status</label>
                                                    <select class="form-control" id="status" name="status" required>
                                                        <option value="1" <?php echo $bus['status'] == 'active' ? 'selected' : ''; ?>>Active</option>
                                                        <option value="0" <?php echo $bus['status'] == 'inactive' ? 'selected' : ''; ?>>Inactive</option>
                                                    </select>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>


<!-- Delete Bus Modal -->
                            <div class="modal fade" id="deleteBusModal<?php echo $bus['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteBusModalLabel<?php echo $bus['id']; ?>" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteBusModalLabel">Confirm Delete</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete this bus?
                                        </div>
                                        <form action="<?php echo URLROOT; ?>/busController/destroy/<?php echo base64_encode($bus['id']); ?>" method="POST" style="display:inline;">
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</section>


<?php require_once APPROOT . '/views/inc/admin/footer.php'; ?>