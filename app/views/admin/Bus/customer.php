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
<button type="button" class="btn btn-info" data-toggle="modal" data-target="#addCustomerModal">
    Add Customer <i class="fas fa-plus"></i>
</button>

<!-- Add Customer Modal -->
<div class="modal fade" id="addCustomerModal" tabindex="-1" role="dialog" aria-labelledby="addCustomerModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addCustomerModalLabel">Add Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="addCustomerForm" action="<?php echo URLROOT; ?>/customerController/store" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>

                        <!-- <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required> -->

                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<section id="customers">
    <div id="head"></div>
    <div id="customer-results">
        <table class="table table-hover table-bordered text-center">
            <thead class="table-header">
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <!-- <th>Email</th> -->
                    <th>Phone</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $number=1;
                 foreach ($data['customers'] as $customer){ ?>
                <tr>
                    <td><?php echo $number++; ?></td>
                    <td><?php echo $customer['name']; ?></td>
                    <!-- <td><?php echo $customer['email']; ?></td> -->
                    <td><?php echo $customer['phone']; ?></td>
                    <td><?php echo $customer['date']; ?></td>
                    <td>
                        <!-- Edit Button -->
                        <button class="btn btn-primary" data-toggle="modal" data-target="#editCustomerModal<?php echo $customer['id']; ?>">Edit</button>

                        <!-- Delete Button -->
                        <button class="btn btn-danger" data-toggle="modal" data-target="#deleteCustomerModal<?php echo $customer['id']; ?>">Delete</button>
                    </td>
                </tr>

                <!-- Edit Modal -->
                <div class="modal fade" id="editCustomerModal<?php echo $customer['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editCustomerModalLabel<?php echo $customer['id']; ?>" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editCustomerModalLabel<?php echo $customer['id']; ?>">Edit Customer</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="<?php echo URLROOT; ?>/customerController/update" method="POST">
                                    <input type="hidden" name="id" value="<?php echo $customer['id']; ?>">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $customer['name']; ?>" required>

                                        <!-- <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $customer['email']; ?>" required> -->

                                        <label for="phone" class="form-label">Phone</label>
                                        <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $customer['phone']; ?>" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                                </form>
                        </div>
                    </div>
                </div>

                <!-- Delete Modal -->
                <div class="modal fade" id="deleteCustomerModal<?php echo $customer['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteCustomerModalLabel<?php echo $customer['id']; ?>" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteCustomerModalLabel<?php echo $customer['id']; ?>">Confirm Delete</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete this customer?
                            </div>
                            <form action="<?php echo URLROOT; ?>/customerController/destroy/<?php echo base64_encode($customer['id']); ?>" method="POST">
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </tbody>
        </table>
    </div>
</section>

<?php require_once APPROOT . '/views/inc/admin/footer.php'; ?>
