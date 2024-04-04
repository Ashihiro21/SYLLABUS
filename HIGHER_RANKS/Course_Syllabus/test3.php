<script>
$(document).ready(function() {
    $('form').submit(function(e) {
        e.preventDefault(); // Prevent form submission
        
        // Submit form via AJAX
        $.ajax({
            url: $(this).attr('action'),
            method: $(this).attr('method'),
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    // Show success message using FancyAlerts
                    FancyAlerts.show({msg: response.message, type: 'success'});
                    // Optional: Clear form fields or do other actions
                    $('form')[0].reset(); 
                } else {
                    // Show error message using FancyAlerts
                    FancyAlerts.show({msg: response.message, type: 'error'});
                }
            },
            error: function(xhr, status, error) {
                // Show error message if AJAX request fails
                FancyAlerts.show({msg: 'An error occurred while processing your request.', type: 'error'});
                $('form')[0].reset();
            }
        });
    });
});
</script>