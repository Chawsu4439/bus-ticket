<?php require_once APPROOT . '/views/inc/admin/header.php' ?>
<?php require_once APPROOT . '/views/inc/admin/sidebar.php' ?>
<?php require_once APPROOT . '/views/inc/admin/navbar.php' ?>
<?php require APPROOT . '/views/components/auth_message.php'; ?>
<style>
.table-header {
        background-color: #adb5bd;  /* Change to your preferred color */
        color: orangered; /* Text color */
    }
</style>

<!-- Button trigger modal -->
<button type="button" class="btn btn-info" data-toggle="modal" data-target="#exampleModal">
Add Bus location <i class="fas fa-plus"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add location</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <div class="modal-body">
        <form id="addBusForm" action="<?php echo URLROOT; ?>/routesController/store" method="POST">
            <div class="mb-3">
                <label for="source" class="form-label">Source</label><br>
                </span>
                <input type="text" class="form-control" id="source" name="source" required>

                <label for="destination" class="form-label">Destination</label><br>
                </span>
                <input type="text" class="form-control" id="destination" name="destination" required>

                
                
            </div>
            <!-- <button type="submit" class="btn btn-success" name="submit">Submit</button> -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
      </form>

    </div>
  </div>
</div>


<section id="bus">
        <div id="head">
        </div>
        <div id="bus-results">
  
            <table class="table table-hover table-bordered text-center">
                <thead class="table-header">
                    <th>Id</th>
                    <th>Source</th>
                    <th>Destination</th>
                    <th>date</th>
                    <th>Actions</th>
                </thead>
                <?php
                $number=1;
                 foreach ($data['routes'] as $route) { ?>
                    <tr>
                      <td><?php echo $number++;?></td>
                      <td><?php echo $route['source']; ?></td>
                      <td><?php echo $route['destination']; ?></td>
                      <td><?php echo $route['date']; ?></td>
                    
                      <td>
                       <!-- Edit Button -->
                      
                        <!-- Edit Button -->
              <button class="btn btn-primary" data-toggle="modal" data-target="#editRouteModal<?php echo $route['id']; ?>">Edit</button>

<!-- Delete Button -->
              <button class="btn btn-danger" data-toggle="modal" data-target="#deleteRouteModal<?php echo $route['id']; ?>">Delete</button>

<!-- Edit Route Modal -->
<div class="modal fade" id="editRouteModal<?php echo $route['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editRouteModalLabel<?php echo $route['id']; ?>" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editRouteModalLabel<?php echo $route['id']; ?>">Edit Route</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php echo URLROOT; ?>/routesController/update" method="POST">
          <input type="hidden" name="id" value="<?php echo $route['id']; ?>">
          <div class="mb-3">
            <label for="source" class="form-label">Source</label>
            <input type="text" class="form-control" id="source" name="source" value="<?php echo $route['source']; ?>" required>

            <label for="destination" class="form-label">Destination</label>
            <input type="text" class="form-control" id="destination" name="destination" value="<?php echo $route['destination']; ?>" required>
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

<!-- Delete Route Modal -->
<div class="modal fade" id="deleteRouteModal<?php echo $route['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteRouteModalLabel<?php echo $route['id']; ?>" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteRouteModalLabel">Confirm Delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this route?
      </div>
      <form action="<?php echo URLROOT; ?>/routesController/destroy/<?php echo base64_encode($route['id']); ?>" method="POST" style="display:inline;">
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