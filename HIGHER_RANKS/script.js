$(document).ready(function(){
    // Populate departments dropdown when the page loads
    $.ajax({
        url: 'script.php',
        method: 'GET',
        data: { action: 'getDepartments' },
        dataType: 'json',
        success: function(response) {
            var departments = response.departments;
            departments.forEach(function(department) {
                $('#department').append('<option value="' + department.id + '">' + department.name + '</option>');
            });
        }
    });

    // Handle department change event
    $('#department').change(function(){
        var selectedDepartment = $(this).val();
        $('#course').empty(); // Clear courses dropdown
        $('#course').append('<option value="">Select Course</option>'); // Add default option

        // Populate courses dropdown based on selected department
        $.ajax({
            url: 'script.php',
            method: 'GET',
            data: { department: selectedDepartment },
            dataType: 'json',
            success: function(response) {
                var courses = response.courses;
                courses.forEach(function(course) {
                    $('#course').append('<option value="' + course.id + '">' + course.name + '</option>');
                });
            }
        });
    });
});


querySele