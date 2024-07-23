<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Event listener for delete buttons
    document.querySelectorAll('.delete-schedule-btn').forEach(button => {
      button.addEventListener('click', function() {
        const scheduleId = this.getAttribute('data-id');
        if (confirm('Are you sure you want to delete this schedule?')) {
          deleteSchedule(scheduleId);
        }
      });
    })
  });

  function deleteSchedule(id) {
    fetch(`<?php echo URLROOT; ?>/scheduleController/destroy/${id}`, {
      method: 'DELETE',
      headers: {
        'Content-Type': 'application/json',
      },
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        alert('Schedule deleted successfully!');
        location.reload(); // Refresh the page or remove the deleted item from the DOM
      } else {
        alert('Failed to delete schedule.');
      }
    })
    .catch(error => {
      console.error('Error:', error);
      alert('An error occurred while deleting the schedule.');
    })
  }
</script>
