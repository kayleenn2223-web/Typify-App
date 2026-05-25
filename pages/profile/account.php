<?php 
session_start();
include '../../auth/session_check.php'; 
include '../../includes/header.php'; 

$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
$email    = isset($_SESSION['email'])    ? $_SESSION['email']    : 'User';
?>

<div class="container fade-in">
    <div class="card" style="max-width: 400px; margin: 50px auto; padding: 25px;">
        <h1 style="text-align: center; margin-bottom: 25px;">Account</h1>
        
        <div class="account-details" style="margin-bottom: 25px;">
            <div class="input-group">
                <label>Username</label>
                <input type="text" value="<?php echo $username; ?>" disabled style="background: #f0f0f0;;">
            </div>
            <div class="input-group">
                <label>Email</label>
                <input type="email" value="<?php echo $email; ?>" disabled style="background: #f0f0f0;">
            </div>
            <div class="input-group">
                <label>Password</label>
                <input type="password" value="********" disabled style="background: #f0f0f0;">
            </div>
        </div>

        <a href="../auth/register.php" class="primary-btn" style="display: block; text-align: center; text-decoration: none; margin-bottom: 15px;">Add Account</a>
        
        <div style="border-top: 1px solid #eee; padding-top: 15px;">
            <a href="../auth/logout.php" style="color: #ff4d4d; text-decoration: none; display: block; margin-bottom: 10px;">DELETE ACCOUNT</a>
            <a href="../settings/privacy.php" style="color: #6a5acd; text-decoration: none; display: block;">PRIVACY</a>
        </div>

        <div style="margin-top: 20px; text-align: center;">
            <a href="../settings/settings.php" style="color: #6a5acd; text-decoration: none;">Back to Setting</a>
        </div>
    </div>
</div>

<?php include '../../includes/footer.php'; ?>