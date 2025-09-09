<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Request System - Dashboard</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <style>
        /* Include your custom CSS */
        body{
            font-size: 0.8rem;
        }
        .section-card {
            border-radius: 8px;
        }
        .section-header {
            padding: 10px;
            border-bottom: 1px solid #dee2e6;
            cursor: pointer;
        }
        .section-content {
            padding: 8px;
            padding-top: 5px;
            padding-bottom: 0px;
            overflow: auto;
        }
        .card-body{
            padding: 0.9rem;
        }
        .key-value-row {
            background-color: #ffffff;
            border-radius: 5px;
            padding: 5px;
            margin-bottom: 0px;
            transition: all 0.2s ease;
        }
        .form-control{
            font-size: 0.8rem;
        }
        
        /* Searchable dropdown styles */
        .searchable-dropdown {
            position: relative;
            width: 100%;
        }
        .searchable-dropdown-toggle {
            width: 100%;
            text-align: left;
            background-color: white;
            border: 1px solid #ced4da;
            padding: 0.375rem 0.75rem;
            font-size: 0.8rem;
            border-radius: 0.25rem;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            padding-right: 2rem;
        }
        .searchable-dropdown-toggle:hover {
            border-color: #86b7fe;
        }
        .searchable-dropdown-toggle:focus {
            border-color: #86b7fe;
            outline: 0;
            box-shadow: 0 0 0 0.25rem rgb(13 110 253 / 25%);
        }
        .searchable-dropdown-toggle::after {
            content: "▼";
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 0.8em;
        }
        .searchable-dropdown-menu {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            z-index: 1050;
            display: none;
            background-color: white;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            max-height: 300px;
            overflow: hidden;
            margin-top: 2px;
        }
        .searchable-dropdown-menu.show {
            display: block;
        }
        .searchable-dropdown-search {
            padding: 8px;
            border-bottom: 1px solid #dee2e6;
            position: sticky;
            top: 0;
            background-color: white;
            z-index: 1;
        }
        .searchable-dropdown-search input {
            width: 100%;
            padding: 0.375rem 0.75rem;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            font-size: 0.875rem;
        }
        .searchable-dropdown-search input:focus {
            outline: none;
            border-color: #86b7fe;
            box-shadow: 0 0 0 0.2rem rgb(13 110 253 / 25%);
        }
        .searchable-dropdown-items {
            max-height: 250px;
            overflow-y: auto;
        }
        .searchable-dropdown-item {
            padding: 0.5rem 1rem;
            cursor: pointer;
            transition: background-color 0.15s;
        }
        .searchable-dropdown-item:hover {
            background-color: #f8f9fa;
        }
        .searchable-dropdown-item.selected {
            background-color: #e9ecef;
            font-weight: 500;
        }
        .searchable-dropdown-item.hidden {
            display: none;
        }
        
        /* PR Modal specific styles */
        .pr-modal .modal-content {
            font-size: 0.8rem;
        }
        .pr-modal .modal-header {
            background-color: #212529;
            color: white;
        }
        .pr-modal .modal-header .btn-close {
            filter: invert(1);
        }
        .pr-items-table {
            font-size: 0.8rem;
        }
        .pr-items-table th {
            background-color: #f8f9fa;
            font-weight: 600;
            border-bottom: 2px solid #dee2e6;
        }
        .pr-items-table td {
            vertical-align: middle;
        }
        .item-input {
            min-width: 100px;
        }
        .vendor-select {
            min-width: 150px;
        }
        .total-row {
            background-color: #f8f9fa;
            font-weight: 600;
        }
        .btn-sm {
            font-size: 0.8rem;
        }
        .section-divider {
            margin: 1.5rem 0;
            border-bottom: 2px solid #dee2e6;
        }
    </style>
</head>

<body>
<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <span class="navbar-brand mb-0 h1">
            <a href="index.php" style="text-decoration: none; color: inherit;">
                <i class="fas fa-file-alt me-2"></i>
                Purchase Request System
            </a>
        </span>
        <button type="button" class="btn btn-light btn-sm" onclick="openNewRequestModal()">New Request</button>
    </div>
</nav>

<div class="container mt-4">
    <h4>Purchase Request Dashboard</h4>
    <p class="text-muted">Click "New Request" to create a new purchase request.</p>
</div>

<!-- Purchase Request Modal -->
<div class="modal fade pr-modal" id="newRequestModal" tabindex="-1" aria-labelledby="newRequestModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newRequestModalLabel">
                    <i class="fas fa-file-alt me-2"></i>New Purchase Request
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="purchaseRequestForm">
                    <!-- Basic Information Section -->
                    <div class="card section-card mb-3">
                        <div class="card-header section-header">
                            <i class="fas fa-info-circle me-2"></i>Basic Information
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">PR Number</label>
                                        <input type="text" class="form-control form-control-sm" id="prNumber" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Team <span class="text-danger">*</span></label>
                                        <select class="form-select form-select-sm" id="team" required>
                                            <option value="">Select Team</option>
                                            <option value="IT">IT Department</option>
                                            <option value="HR">Human Resources</option>
                                            <option value="FIN">Finance</option>
                                            <option value="OPS">Operations</option>
                                            <option value="MKT">Marketing</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Currency <span class="text-danger">*</span></label>
                                        <select class="form-select form-select-sm" id="currency" required>
                                            <option value="USD">USD</option>
                                            <option value="CAD">CAD</option>
                                            <option value="EUR">EUR</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Request Date</label>
                                        <input type="date" class="form-control form-control-sm" id="requestDate" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Requester Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control form-control-sm" id="requesterEmail" required placeholder="your.email@company.com">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Request Reason <span class="text-danger">*</span></label>
                                        <textarea class="form-control form-control-sm" id="requestReason" rows="2" required placeholder="Please provide a reason for this purchase request"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Items Section -->
                    <div class="card section-card">
                        <div class="card-header section-header">
                            <i class="fas fa-shopping-cart me-2"></i>Items
                            <span class="float-end">
                                <button type="button" class="btn btn-success btn-sm" onclick="addItemRow()">
                                    <i class="fas fa-plus me-1"></i>Add Item
                                </button>
                            </span>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered pr-items-table" id="itemsTable">
                                    <thead>
                                        <tr>
                                            <th style="width: 40px">#</th>
                                            <th style="width: 200px">Item Name</th>
                                            <th style="width: 200px">Vendor</th>
                                            <th style="width: 150px">Catalog #</th>
                                            <th style="width: 80px">Qty</th>
                                            <th style="width: 100px">Unit Price</th>
                                            <th style="width: 100px">Total</th>
                                            <th>Comments/URL</th>
                                            <th style="width: 50px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="itemsTableBody">
                                        <!-- Items will be added here dynamically -->
                                    </tbody>
                                    <tfoot>
                                        <tr class="total-row">
                                            <td colspan="6" class="text-end">Total Amount:</td>
                                            <td colspan="3" class="text-start">
                                                <span id="totalCurrency">USD</span> 
                                                <span id="totalAmount">0.00</span>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                <!-- <button type="button" class="btn btn-warning btn-sm" onclick="saveDraft()">
                    <i class="fas fa-save me-1"></i>Save as Draft
                </button> -->
                <button type="button" class="btn btn-primary btn-sm" onclick="submitRequest()">
                    <i class="fas fa-paper-plane me-1"></i>Submit Request
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap 5 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
// Mock data for vendors
const mockVendors = [
    { id: 1, code: 'AMZN', name: 'Amazon', address: '410 Terry Ave N, Seattle, WA' },
    { id: 2, code: 'STPL', name: 'Staples', address: '500 Staples Dr, Framingham, MA' },
    { id: 3, code: 'CDWG', name: 'CDW Corporation', address: '200 N Milwaukee Ave, Vernon Hills, IL' },
    { id: 4, code: 'DELL', name: 'Dell Technologies', address: '1 Dell Way, Round Rock, TX' },
    { id: 5, code: 'OFFD', name: 'Office Depot', address: '6600 N Military Trail, Boca Raton, FL' },
    { id: 6, code: 'GRNG', name: 'Grainger', address: '100 Grainger Pkwy, Lake Forest, IL' },
    { id: 7, code: 'FISH', name: 'Fisher Scientific', address: '300 Industry Dr, Pittsburgh, PA' },
    { id: 8, code: 'SIGM', name: 'Sigma-Aldrich', address: '3050 Spruce St, St. Louis, MO' }
];

let itemCounter = 0;

// Initialize modal
function openNewRequestModal() {
    // Reset form
    document.getElementById('purchaseRequestForm').reset();
    document.getElementById('itemsTableBody').innerHTML = '';
    itemCounter = 0;
    
    // Generate PR Number
    const today = new Date();
    const prNumber = 'R' + today.getFullYear().toString().substr(-2) + 
                     ('0' + (today.getMonth() + 1)).slice(-2) + 
                     ('0' + today.getDate()).slice(-2) + 
                     ('0' + Math.floor(Math.random() * 99 + 1)).slice(-2);
    document.getElementById('prNumber').value = prNumber;
    
    // Set today's date
    document.getElementById('requestDate').valueAsDate = today;
    
    // Add first item row
    addItemRow();
    
    // Show modal
    const modal = new bootstrap.Modal(document.getElementById('newRequestModal'));
    modal.show();
}

// Add new item row
function addItemRow() {
    if (itemCounter >= 99) {
        alert('Maximum 99 items allowed per purchase request');
        return;
    }
    
    itemCounter++;
    const tbody = document.getElementById('itemsTableBody');
    const newRow = document.createElement('tr');
    newRow.innerHTML = `
        <td class="text-center">${itemCounter}</td>
        <td><input type="text" class="form-control form-control-sm item-input" placeholder="Item name" required></td>
        <td>
            <div class="searchable-dropdown" id="vendor-dropdown-${itemCounter}">
                <div class="searchable-dropdown-toggle" onclick="toggleDropdown('vendor-dropdown-${itemCounter}')">
                    Select Vendor
                </div>
                <div class="searchable-dropdown-menu">
                    <div class="searchable-dropdown-search">
                        <input type="text" placeholder="Search vendors..." onkeyup="filterVendors(this, 'vendor-dropdown-${itemCounter}')">
                    </div>
                    <div class="searchable-dropdown-items">
                        ${mockVendors.map(vendor => `
                            <div class="searchable-dropdown-item" onclick="selectVendor('vendor-dropdown-${itemCounter}', '${vendor.name}', '${vendor.id}')">
                                <strong>${vendor.name}</strong> (${vendor.code})
                                <br><small class="text-muted">${vendor.address}</small>
                            </div>
                        `).join('')}
                    </div>
                </div>
                <input type="hidden" class="vendor-id">
            </div>
        </td>
        <td><input type="text" class="form-control form-control-sm" placeholder="Catalog #"></td>
        <td><input type="number" class="form-control form-control-sm qty-input" min="1" value="1" onchange="calculateRowTotal(this)" required></td>
        <td><input type="number" class="form-control form-control-sm price-input" step="0.01" min="0" value="0.00" onchange="calculateRowTotal(this)" required></td>
        <td class="text-end item-total">0.00</td>
        <td><input type="text" class="form-control form-control-sm" placeholder="Comments or URL"></td>
        <td class="text-center">
            <button type="button" class="btn btn-danger btn-sm" onclick="removeItemRow(this)">
                <i class="fas fa-trash"></i>
            </button>
        </td>
    `;
    tbody.appendChild(newRow);
}

// Remove item row
function removeItemRow(button) {
    const tbody = document.getElementById('itemsTableBody');
    if (tbody.children.length > 1) {
        button.closest('tr').remove();
        updateRowNumbers();
        calculateTotal();
    } else {
        alert('At least one item is required');
    }
}

// Update row numbers after deletion
function updateRowNumbers() {
    const rows = document.getElementById('itemsTableBody').getElementsByTagName('tr');
    itemCounter = 0;
    for (let row of rows) {
        itemCounter++;
        row.cells[0].textContent = itemCounter;
    }
}

// Calculate row total
function calculateRowTotal(input) {
    const row = input.closest('tr');
    const qty = parseFloat(row.querySelector('.qty-input').value) || 0;
    const price = parseFloat(row.querySelector('.price-input').value) || 0;
    const total = qty * price;
    row.querySelector('.item-total').textContent = total.toFixed(2);
    calculateTotal();
}

// Calculate grand total
function calculateTotal() {
    let total = 0;
    const totals = document.querySelectorAll('.item-total');
    totals.forEach(cell => {
        total += parseFloat(cell.textContent) || 0;
    });
    document.getElementById('totalAmount').textContent = total.toFixed(2);
    document.getElementById('totalCurrency').textContent = document.getElementById('currency').value;
}

// Toggle dropdown
function toggleDropdown(dropdownId) {
    const dropdown = document.getElementById(dropdownId);
    const menu = dropdown.querySelector('.searchable-dropdown-menu');
    const isShown = menu.classList.contains('show');
    
    // Close all other dropdowns
    document.querySelectorAll('.searchable-dropdown-menu').forEach(m => m.classList.remove('show'));
    
    if (!isShown) {
        menu.classList.add('show');
        menu.querySelector('input').focus();
    }
}

// Filter vendors
function filterVendors(input, dropdownId) {
    const filter = input.value.toLowerCase();
    const dropdown = document.getElementById(dropdownId);
    const items = dropdown.querySelectorAll('.searchable-dropdown-item');
    
    items.forEach(item => {
        const text = item.textContent.toLowerCase();
        if (text.includes(filter)) {
            item.classList.remove('hidden');
        } else {
            item.classList.add('hidden');
        }
    });
}

// Select vendor
function selectVendor(dropdownId, vendorName, vendorId) {
    const dropdown = document.getElementById(dropdownId);
    dropdown.querySelector('.searchable-dropdown-toggle').textContent = vendorName;
    dropdown.querySelector('.vendor-id').value = vendorId;
    dropdown.querySelector('.searchable-dropdown-menu').classList.remove('show');
}

// Close dropdowns when clicking outside
document.addEventListener('click', function(e) {
    if (!e.target.closest('.searchable-dropdown')) {
        document.querySelectorAll('.searchable-dropdown-menu').forEach(menu => {
            menu.classList.remove('show');
        });
    }
});

// Update currency in total when changed
document.getElementById('currency').addEventListener('change', function() {
    document.getElementById('totalCurrency').textContent = this.value;
});

// Save as draft
function saveDraft() {
    if (validateForm()) {
        alert('Purchase request saved as draft!');
        // In real implementation, save to backend
    }
}

// Submit request
function submitRequest() {
    if (validateForm()) {
        if (confirm('Are you sure you want to submit this purchase request?')) {
            alert('Purchase request submitted successfully!');
            // In real implementation, submit to backend
            bootstrap.Modal.getInstance(document.getElementById('newRequestModal')).hide();
        }
    }
}

// Basic form validation
function validateForm() {
    const form = document.getElementById('purchaseRequestForm');
    const requiredFields = form.querySelectorAll('[required]');
    let isValid = true;
    
    requiredFields.forEach(field => {
        if (!field.value.trim()) {
            field.classList.add('is-invalid');
            isValid = false;
        } else {
            field.classList.remove('is-invalid');
        }
    });
    
    // Check if at least one item has vendor selected
    const vendorDropdowns = document.querySelectorAll('.vendor-id');
    let hasVendor = false;
    vendorDropdowns.forEach(input => {
        if (input.value) {
            hasVendor = true;
        }
    });
    
    if (!hasVendor) {
        alert('Please select vendor for at least one item');
        isValid = false;
    }
    
    if (!isValid) {
        alert('Please fill in all required fields');
    }
    
    return isValid;
}
</script>

</body>
</html>