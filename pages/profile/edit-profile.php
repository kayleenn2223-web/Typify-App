<?php 
session_start();
include '../../auth/session_check.php'; 
include '../../includes/header.php'; 

$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest';
$email    = isset($_SESSION['email'])    ? $_SESSION['email']    : 'User';
?>

<div class="container fade-in">
    <div class="card" style="max-width: 400px; margin: 50px auto; padding: 25px;">
        <h1 style="text-align: center; margin-bottom: 25px;">Edit Account</h1>
        
        <form action="process_edit.php" method="POST">
            <div class="input-group">
                <label>Username</label>
                <input type="text" name="username" value="<?php echo $username; ?>" required>
            </div>
            
            <div class="input-group">
                <label>Email</label>
                <input type="email" name="email" value="<?php echo $email; ?>" required>
            </div>

            <div class="input-group">
                <label>New Password (kosongkan jika tidak ganti)</label>
                <input type="password" name="password" placeholder="********">
            </div>

            <button type="submit" class="primary-btn" style="width: 100%; margin-top: 10px;">Save Changes</button>
            <a href="account.php" style="display: block; text-align: center; margin-top: 15px; color: #6a5acd; text-decoration: none;">Cancel</a>
        </form>
    </div>
</div>

<?php include '../../includes/footer.php'; ?>