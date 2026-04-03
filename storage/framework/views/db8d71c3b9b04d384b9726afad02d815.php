

<?php $__env->startSection('content'); ?>
<style>
    .login-container {
        min-height: calc(100vh - 200px);
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 2rem;
    }

    .login-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        padding: 3rem;
        max-width: 400px;
        width: 100%;
    }

    .login-card h1 {
        text-align: center;
        color: #333;
        margin-bottom: 0.5rem;
        font-size: 1.8rem;
        font-weight: 700;
    }

    .login-card .subtitle {
        text-align: center;
        color: #999;
        margin-bottom: 2rem;
        font-size: 0.9rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
        display: flex;
        flex-direction: column;
    }

    .form-group label {
        font-weight: 500;
        color: #555;
        margin-bottom: 0.5rem;
        font-size: 0.95rem;
    }

    .form-group input[type="email"],
    .form-group input[type="password"] {
        padding: 0.8rem 1rem;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 1rem;
        transition: all 0.3s ease;
        font-family: inherit;
    }

    .form-group input[type="email"]:focus,
    .form-group input[type="password"]:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .remember-me {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 2rem;
        font-size: 0.9rem;
        color: #555;
    }

    .remember-me input[type="checkbox"] {
        width: 18px;
        height: 18px;
        cursor: pointer;
        accent-color: #667eea;
    }

    .login-button {
        width: 100%;
        padding: 0.9rem;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        border-radius: 6px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .login-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
    }

    .login-button:active {
        transform: translateY(0);
    }

    .error-messages {
        background: #fee;
        border: 1px solid #fcc;
        border-radius: 6px;
        padding: 1rem;
        margin-bottom: 1.5rem;
        list-style: none;
    }

    .error-messages li {
        color: #c33;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }

    .error-messages li:last-child {
        margin-bottom: 0;
    }

    @media (max-width: 480px) {
        .login-card {
            padding: 2rem;
        }

        .login-card h1 {
            font-size: 1.5rem;
        }
    }
</style>

<div class="login-container">
    <div class="login-card">
        <h1>Welcome Back</h1>
        <p class="subtitle">Sign in to your admin account</p>

        <?php if($errors->any()): ?>
            <ul class="error-messages">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        <?php endif; ?>

        <form method="POST" action="<?php echo e(route('login.attempt')); ?>">
            <?php echo csrf_field(); ?>
            
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="you@example.com" required autofocus value="<?php echo e(old('email')); ?>">
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="••••••••" required>
            </div>

            <label class="remember-me">
                <input type="checkbox" name="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                <span>Remember me</span>
            </label>

            <button type="submit" class="login-button">Sign In</button>
        </form>

        <div class="text-center mt-6">
            <p class="text-gray-600 text-sm mb-2">Want to book an event?</p>
            <a href="<?php echo e(route('booking')); ?>" class="text-blue-600 hover:text-blue-800 font-medium">
                Book Your Event →
            </a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\amaanta\resources\views\auth\login.blade.php ENDPATH**/ ?>