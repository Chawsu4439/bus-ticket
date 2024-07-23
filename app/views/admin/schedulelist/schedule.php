
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
  Add Bus Schedule <i class="fas fa-plus"></i>
</button>

<!-- Add Schedule Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Schedule</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="addBusForm" action="<?php echo URLROOT; ?>/scheduleController/store" method="POST">
          <div class="mb-3">
            <label for="bus_id" class="form-label">Bus Name</label><br>
            <select name="bus_id" class="form-control" required>
              <?php if (isset($data['buses']) && is_array($data['buses']) && !empty($data['buses'])) {
                foreach ($data['buses'] as $bus) { ?>
                  <option value="<?php echo ($bus['id']); ?>">
                    <?php echo ($bus['name']); ?>
                  </option>
                <?php }
              } else { ?>
                <option value="">No buses available</option>
              <?php } ?>
            </select>
            <br>

            <label for="route_id" class="form-label">Route-Cities</label><br>
            <select name="route_id" class="form-control" required>
              <?php if (isset($data['routes']) && is_array($data['routes']) && !empty($data['routes'])) {
                foreach ($data['routes'] as $route) { ?>
                  <option value="<?php echo ($route['id']); ?>">
                    <?php echo ($route['source'] . "-" . $route['destination']); ?>
                  </option>
                <?php }
              } else { ?>
                <option value="">No route available</option>
              <?php } ?>
            </select><br>

           

            <label for="departure_time" class="form-label">Departure Time</label><br>
            <input type="datetime-local" class="form-control" id="departure_time" name="departure_time" required>

            <label for="arrival_time" class="form-label">Arrival Time</label><br>
            <input type="datetime-local" class="form-control" id="arrival_time" name="arrival_time" required>

            <label for="price_per_seat" class="form-label">Price Per Seat</label><br>
            <input type="number" class="form-control" id="price_per_seat" name="price_per_seat" required>
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

<section id="bus">
  <div id="head"></div>
  <div id="bus-results">
    <table class="table table-hover table-bordered text-center">
      <thead class="table-header">
        <tr>
          <th>#</th>
          <th>Bus Name</th>
          <th>Source</th>
          <th>Destination</th>
         
          <th>Departure Time</th>
          <th>Arrival Time</th>
          <th>Price Per Seat</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($data['schedules'] as $schedule) { ?>
          <tr>
            <td><?php echo $schedule['schedule_id']; ?></td>
            <td><?php echo $schedule['bus_name']; ?></td>
            <td><?php echo $schedule['source']; ?></td>
            <td><?php echo $schedule['destination']; ?></td>
           
            <td><?php echo $schedule['departure_time']; ?></td>
            <td><?php echo $schedule['arrival_time']; ?></td>
            <td><?php echo $schedule['price_per_seat']; ?></td>
            <td>
              <!-- Edit Button -->
              <button class="btn btn-primary" data-toggle="modal" data-target="#editModal<?php echo $schedule['schedule_id']; ?>">
                Edit
              </button>

              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteScheduleModal<?php echo $schedule['schedule_id']; ?>">
                Delete
              </button>

            </td>
          </tr>

          <!-- Edit Modal -->
          <div class="modal fade" id="editModal<?php echo $schedule['schedule_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel<?php echo $schedule['schedule_id']; ?>" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="editModalLabel<?php echo $schedule['schedule_id']; ?>">Edit Schedule</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form id="editBusForm<?php echo $schedule['schedule_id']; ?>" action="<?php echo URLROOT; ?>/scheduleController/update" method="POST">
                    <input type="hidden" name="schedule_id" value="<?php echo $schedule['schedule_id']; ?>">
                    <div class="mb-3">
                      <label for="bus_id" class="form-label">Bus Name</label><br>
                      <select name="bus_id" class="form-control" required>
                        <?php if (isset($data['buses']) && is_array($data['buses']) && !empty($data['buses'])) {
                          foreach ($data['buses'] as $bus) { ?>
                            <option value="<?php echo ($bus['id']); ?>" <?php echo ($bus['id'] == $schedule['bus_id']) ? 'selected' : ''; ?>>
                              <?php echo ($bus['name']); ?>
                            </option>
                        <?php }
                        } ?>
                      </select>
                      <br>

                      <label for="route_id" class="form-label">Route-Cities</label><br>
                      <select name="route_id" class="form-control" required>
                        <?php if (isset($data['routes']) && is_array($data['routes']) && !empty($data['routes'])) {
                          foreach ($data['routes'] as $route) { ?>
                            <option value="<?php echo ($route['id']); ?>" <?php echo ($route['id'] == $schedule['route_id']) ? 'selected' : ''; ?>>
                              <?php echo ($route['source'] . "-" . $route['destination']); ?>
                            </option>
                        <?php }
                        } ?>
                      </select><br>

                      <label for="departure_time" class="form-label">Departure Time</label><br>
                      <input type="datetime-local" class="form-control" id="departure_time" name="departure_time" value="<?php echo date('Y-m-d\TH:i', strtotime($schedule['departure_time'])); ?>" required>

                      <label for="arrival_time" class="form-label">Arrival Time</label><br>
                      <input type="datetime-local" class="form-control" id="arrival_time" name="arrival_time" value="<?php echo date('Y-m-d\TH:i', strtotime($schedule['arrival_time'])); ?>" required>

                      <label for="price_per_seat" class="form-label">Price Per Seat</label><br>
                      <input type="number" class="form-control" id="price_per_seat" name="price_per_seat" value="<?php echo $schedule['price_per_seat']; ?>" required>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <!-- Delete Schedule Modal -->
          <div class="modal fade" id="deleteScheduleModal<?php echo $schedule['schedule_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="deleteScheduleModalLabel<?php echo $schedule['schedule_id']; ?>" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="deleteScheduleModalLabel<?php echo $schedule['schedule_id']; ?>">Confirm Delete</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  Are you sure you want to delete this schedule?
                </div>
                <form action="<?php echo URLROOT; ?>/scheduleController/destroy/<?php echo base64_encode($schedule['schedule_id']); ?>" method="POST">
                  <button type="submit" class="btn btn-danger">Delete</button>
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