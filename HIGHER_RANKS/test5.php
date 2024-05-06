<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Rotate Text CSS</title>
<style>
 .rotate-text-right {
    transform: rotate(-90deg); /* Rotate 90 degrees clockwise */
    transform-origin: top right; /* Set rotation origin to top right corner */
    writing-mode: vertical-rl; /* Set writing mode to vertical, writing direction from right to left */
    text-align: right; /* Align text to the right */
    white-space: nowrap; /* Prevent text from wrapping */
    width: auto; /* Reset width to auto */
    display: inline-block; /* Ensure proper display */
}

</style>
</head>
<body>

<div class="form-group">
    <label>Technology Enabler</label>
    <input type="text" name="technology" id="technology1" class="form-control" placeholder="Enter Technology Enabler">
</div>

<div class="form-group">
    <label>
        <input type="checkbox" name="asy5" value="1" id="asynchronous5">
        <span class="rotate-text-right">Asynchronous</span>
    </label>
</div>

<div class="form-group">
    <label class="rotate-text-right">Alloted Hours</label>
    <input type="text" name="hours" id="alloted_hours5" class="form-control" placeholder="Enter Alloted Hours">
</div>

<div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" name="insertdata" class="btn btn-primary">Save Data</button>
</div>



</body>
</html>
