

<?php $__env->startSection('title', 'Book Your Event - Amaanta'); ?>

<?php $__env->startSection('content'); ?>
<style>
.booking-form-container {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    min-height: 100vh;
    padding: 2rem 0;
}

.booking-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    overflow: hidden;
}

.form-header {
    background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
    color: white;
    padding: 2rem;
    text-align: center;
    position: relative;
}
.form-header p{color:#fff;}
.form-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="50" cy="10" r="0.5" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
    opacity: 0.3;
}

.form-header h1 {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.form-header p {
    font-size: 1.1rem;
    opacity: 0.9;
    margin: 0;
}

.form-section {
    padding: 2rem;
    border-bottom: 1px solid #f0f0f0;
}

.form-section:last-child {
    border-bottom: none;
}

.section-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: #1f2937;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.section-title::before {
    content: '';
    width: 4px;
    height: 24px;
    background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
    border-radius: 2px;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-label {
    display: block;
    font-weight: 500;
    color: #374151;
    margin-bottom: 0.5rem;
    font-size: 0.95rem;
}

.form-input, .form-select, .form-textarea {
    width: 100%;
    padding: 0.875rem 1rem;
    border: 2px solid #e5e7eb;
    border-radius: 12px;
    font-size: 1rem;
    transition: all 0.3s ease;
    background: white;
}

.form-input:focus, .form-select:focus, .form-textarea:focus {
    outline: none;
    border-color: #4f46e5;
    box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
    transform: translateY(-1px);
}

.form-textarea {
    resize: vertical;
    min-height: 100px;
}

.cost-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
}

.cost-summary {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    border-radius: 16px;
    padding: 1.5rem;
    margin-top: 1rem;
    border: 1px solid #e2e8f0;
}

.summary-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.5rem 0;
    font-size: 0.95rem;
}

.summary-row.total {
    border-top: 2px solid #cbd5e1;
    margin-top: 0.5rem;
    padding-top: 1rem;
    font-weight: 600;
    font-size: 1.1rem;
    color: #1f2937;
}

.submit-btn {
    background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
    color: white;
    border: none;
    padding: 1rem 2rem;
    border-radius: 12px;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    box-shadow: 0 4px 14px rgba(79, 70, 229, 0.3);
}

.submit-btn:hover:not(:disabled) {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(79, 70, 229, 0.4);
}

.submit-btn:disabled {
    opacity: 0.7;
    cursor: not-allowed;
    transform: none;
}

.message-container {
    margin-top: 1.5rem;
}

.message {
    padding: 1rem 1.5rem;
    border-radius: 12px;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.message.success {
    background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
    color: #065f46;
    border: 1px solid #34d399;
}

.message.error {
    background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
    color: #991b1b;
    border: 1px solid #f87171;
}

.error-message {
    color: #dc2626;
    font-size: 0.875rem;
    margin-top: 0.25rem;
    display: block;
}

.spinner {
    width: 20px;
    height: 20px;
    border: 2px solid rgba(255, 255, 255, 0.3);
    border-top: 2px solid white;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Responsive Design */
@media (max-width: 768px) {
    .booking-form-container {
        padding: 1rem 0;
    }

    .form-header {
        padding: 1.5rem;
    }

    .form-header h1 {
        font-size: 2rem;
    }

    .form-section {
        padding: 1.5rem;
    }

    .cost-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }

    .section-title {
        font-size: 1.25rem;
    }
}

@media (max-width: 480px) {
    .form-header h1 {
        font-size: 1.75rem;
    }

    .form-header p {
        font-size: 1rem;
    }

    .form-section {
        padding: 1rem;
    }

    .form-input, .form-select, .form-textarea {
        padding: 0.75rem;
    }
}
</style>

<div class="booking-form-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-7">
                <div class="booking-card">
                    <!-- Header -->
                    <div class="form-header">
                        <h1>🎉 Book Your Event</h1>
                        <p>Fill out the form below to book your special event with us. We'll get back to you soon!</p>
                    </div>

                    <form id="bookingForm" method="POST" action="<?php echo e(route('booking.store')); ?>">
                        <?php echo csrf_field(); ?>

                        <!-- Personal Information -->
                        <div class="form-section">
                            <h2 class="section-title">
                                <i class="fas fa-user"></i>
                                Personal Information
                            </h2>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="customer_name" class="form-label">Customer Name *</label>
                                        <input type="text" id="customer_name" name="customer_name" required
                                               class="form-input" placeholder="Enter your full name">
                                        <span class="error-message" data-field="customer_name"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone" class="form-label">Phone Number *</label>
                                        <input type="tel" id="phone" name="phone" required
                                               class="form-input" placeholder="Enter your phone number">
                                        <span class="error-message" data-field="phone"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="event_date" class="form-label">Event Date *</label>
                                        <input type="date" id="event_date" name="event_date" required
                                               class="form-input" min="<?php echo e(date('Y-m-d', strtotime('+1 day'))); ?>">
                                        <span class="error-message" data-field="event_date"></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Cost Breakdown -->
                        <div class="form-section">
                            <h2 class="section-title">
                                <i class="fas fa-calculator"></i>
                                Cost Breakdown
                            </h2>
                            <div class="cost-grid">
                                <div class="form-group">
                                    <label for="lawn_cost" class="form-label">Lawn Cost (₹)</label>
                                    <input type="number" id="lawn_cost" name="lawn_cost" step="0.01" min="0"
                                           class="form-input" placeholder="0.00">
                                    <span class="error-message" data-field="lawn_cost"></span>
                                </div>
                                <div class="form-group">
                                    <label for="decoration_cost" class="form-label">Decoration Cost (₹)</label>
                                    <input type="number" id="decoration_cost" name="decoration_cost" step="0.01" min="0"
                                           class="form-input" placeholder="0.00">
                                    <span class="error-message" data-field="decoration_cost"></span>
                                </div>
                                <div class="form-group">
                                    <label for="catering_cost" class="form-label">Catering Cost (₹)</label>
                                    <input type="number" id="catering_cost" name="catering_cost" step="0.01" min="0"
                                           class="form-input" placeholder="0.00">
                                    <span class="error-message" data-field="catering_cost"></span>
                                </div>
                                <div class="form-group">
                                    <label for="other_charges" class="form-label">Other Charges (₹)</label>
                                    <input type="number" id="other_charges" name="other_charges" step="0.01" min="0"
                                           class="form-input" placeholder="0.00">
                                    <span class="error-message" data-field="other_charges"></span>
                                </div>
                            </div>

                            <!-- Cost Summary -->
                            <div class="cost-summary">
                                <div class="summary-row">
                                    <span>Total Cost (₹) *</span>
                                    <input type="number" id="total_cost" name="total_cost" step="0.01" min="0" required
                                           class="form-input" style="width: 120px; display: inline-block; margin-left: 1rem;" placeholder="0.00">
                                </div>
                                <div class="summary-row">
                                    <span>Advance Payment (₹) *</span>
                                    <input type="number" id="advance_payment" name="advance_payment" step="0.01" min="0" required
                                           class="form-input" style="width: 120px; display: inline-block; margin-left: 1rem;" placeholder="0.00">
                                </div>
                                <div class="summary-row total">
                                    <span>Balance Amount</span>
                                    <span id="balance_amount">₹0.00</span>
                                </div>
                            </div>
                            <div class="error-message" data-field="total_cost"></div>
                            <div class="error-message" data-field="advance_payment"></div>
                        </div>

                        <!-- Payment & Notes -->
                        <div class="form-section">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="payment_mode" class="form-label">Payment Mode *</label>
                                        <select id="payment_mode" name="payment_mode" required class="form-select">
                                            <option value="">Select Payment Mode</option>
                                            <option value="Cash">💵 Cash</option>
                                            <option value="UPI">📱 UPI</option>
                                            <option value="Bank Transfer">🏦 Bank Transfer</option>
                                        </select>
                                        <span class="error-message" data-field="payment_mode"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="notes" class="form-label">Additional Notes</label>
                                <textarea id="notes" name="notes" rows="4" class="form-textarea"
                                          placeholder="Any special requirements or notes..."></textarea>
                                <span class="error-message" data-field="notes"></span>
                            </div>
                        </div>

                        <!-- Submit Section -->
                        <div class="form-section">
                            <button type="submit" id="submitBtn" class="submit-btn">
                                <span id="submitText">
                                    <i class="fas fa-paper-plane"></i>
                                    Submit Booking
                                </span>
                                <div id="loadingSpinner" class="spinner" style="display: none;"></div>
                            </button>
                        </div>

                        <!-- Messages -->
                        <div id="messageContainer" class="message-container" style="display: none;">
                            <div id="successMessage" class="message success" style="display: none;">
                                <i class="fas fa-check-circle"></i>
                                <span></span>
                            </div>
                            <div id="errorMessage" class="message error" style="display: none;">
                                <i class="fas fa-exclamation-circle"></i>
                                <span></span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('bookingForm');
    const submitBtn = document.getElementById('submitBtn');
    const submitText = document.getElementById('submitText');
    const loadingSpinner = document.getElementById('loadingSpinner');
    const messageContainer = document.getElementById('messageContainer');
    const successMessage = document.getElementById('successMessage');
    const errorMessage = document.getElementById('errorMessage');
    const balanceAmount = document.getElementById('balance_amount');

    // Auto-calculate total cost and balance
    function calculateCosts() {
        const lawnCost = parseFloat(document.getElementById('lawn_cost').value) || 0;
        const decorationCost = parseFloat(document.getElementById('decoration_cost').value) || 0;
        const cateringCost = parseFloat(document.getElementById('catering_cost').value) || 0;
        const otherCharges = parseFloat(document.getElementById('other_charges').value) || 0;

        const total = lawnCost + decorationCost + cateringCost + otherCharges;
        document.getElementById('total_cost').value = total.toFixed(2);

        const advancePayment = parseFloat(document.getElementById('advance_payment').value) || 0;
        const balance = total - advancePayment;

        balanceAmount.textContent = '₹' + (balance > 0 ? balance.toFixed(2) : '0.00');
        balanceAmount.style.color = balance > 0 ? '#1f2937' : '#6b7280';
    }

    // Add event listeners for cost calculation
    ['lawn_cost', 'decoration_cost', 'catering_cost', 'other_charges', 'advance_payment'].forEach(id => {
        document.getElementById(id).addEventListener('input', calculateCosts);
    });

    form.addEventListener('submit', function(e) {
        e.preventDefault();

        // Clear previous messages
        messageContainer.style.display = 'none';
        successMessage.style.display = 'none';
        errorMessage.style.display = 'none';

        // Clear previous errors
        document.querySelectorAll('.error-message').forEach(el => {
            el.textContent = '';
        });

        // Show loading state
        submitBtn.disabled = true;
        submitText.style.display = 'none';
        loadingSpinner.style.display = 'block';

        const formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                successMessage.querySelector('span').textContent = data.message;
                successMessage.style.display = 'flex';
                messageContainer.style.display = 'block';
                form.reset();
                calculateCosts(); // Reset calculations
                // Scroll to top to show success message
                window.scrollTo({ top: 0, behavior: 'smooth' });
            } else {
                errorMessage.querySelector('span').textContent = data.message || 'An error occurred. Please try again.';
                errorMessage.style.display = 'flex';
                messageContainer.style.display = 'block';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            errorMessage.querySelector('span').textContent = 'An error occurred. Please try again.';
            errorMessage.style.display = 'flex';
            messageContainer.style.display = 'block';
        })
        .finally(() => {
            // Reset loading state
            submitBtn.disabled = false;
            submitText.style.display = 'flex';
            loadingSpinner.style.display = 'none';
        });
    });

    // Initialize calculations on page load
    calculateCosts();
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\amaanta\resources\views\pages\booking.blade.php ENDPATH**/ ?>