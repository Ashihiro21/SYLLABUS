</table>
</div>

<!-- Edit Modal HTML -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit TLO</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    <div class="mb-3">
                        <label for="editTloNumber" class="form-label">TLO Number</label>
                        <input type="text" class="form-control" id="editTloNumber" name="tloNumber">
                    </div>
                    <button type="button" class="btn btn-primary" onclick="saveEdit()">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Add Modal HTML -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Add New TLO</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addForm">
                    <div class="mb-3">
                        <label for="addTloNumber" class="form-label">TLO Number</label>
                        <input type="text" class="form-control" id="addTloNumber" name="tloNumber">
                    </div>
                    <button type="button" class="btn btn-primary" onclick="saveAdd()">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
let currentNestedTableId = '';

function openEditModal(button, nestedTableId) {
    currentNestedTableId = nestedTableId;
    var row = button.closest('tr');  // Get the closest row to the button
    var tloNumber = row.cells[0].innerText;  // Get the TLO number from the first cell

    // Populate the modal fields
    document.getElementById('editTloNumber').value = tloNumber;

    // Show the modal
    var editModal = new bootstrap.Modal(document.getElementById('editModal'));
    editModal.show();

    // Store the row for later use
    document.getElementById('editForm').setAttribute('data-row', row.rowIndex);
}

function saveEdit() {
    var rowIndex = document.getElementById('editForm').getAttribute('data-row');
    var nestedTable = document.getElementById(currentNestedTableId);
    var row = nestedTable.rows[rowIndex];

    var tloNumber = document.getElementById('editTloNumber').value;

    // Update the table row with the new data
    row.cells[0].innerText = tloNumber;

    // Hide the modal
    var editModal = bootstrap.Modal.getInstance(document.getElementById('editModal'));
    editModal.hide();
}

function openAddModal(nestedTableId) {
    currentNestedTableId = nestedTableId;

    // Show the add modal
    var addModal = new bootstrap.Modal(document.getElementById('addModal'));
    addModal.show();
}

function saveAdd() {
    var tloNumber = document.getElementById('addTloNumber').value;

    // Add a new row to the nested table
    var nestedTable = document.getElementById(currentNestedTableId);
    var newRow = nestedTable.insertRow();
    var newCell1 = newRow.insertCell(0);
    var newCell2 = newRow.insertCell(1);

    newCell1.innerText = tloNumber;
    newCell2.innerHTML = '<button type="button" class="btn btn-success editbtn_learning_out_table" onclick="openEditModal(this, \'' + currentNestedTableId + '\')"><i class="lni lni-pencil"></i></button>';

    // Hide the modal
    var addModal = bootstrap.Modal.getInstance(document.getElementById('addModal'));
    addModal.hide();
}
</script>