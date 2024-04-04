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
            }
        });
    });

    $('.show-alert__error').click(function() {
        // Show error message using FancyAlerts
        FancyAlerts.show({msg: 'Uh oh something went wrong!', type: 'error'});
    });

    $('.show-alert__success').click(function() {
        // Show success message using FancyAlerts
        FancyAlerts.show({msg: 'Nailed it! This totally worked.', type: 'success'});
    });

    $('.show-alert__info').click(function() {
        // Show info message using FancyAlerts
        FancyAlerts.show({msg: 'So long and thanks for all the shoes.', type: 'info'});
    });
});
</script>