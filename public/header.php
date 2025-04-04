<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="index.php">BMI Calculator</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Calculate BMI</a>
            </li>
            <?php if (isset($_SESSION['username'])): ?>
                <li class="nav-item">
                    <a class="nav-link" href="bmi_history.php">BMI History</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white font-weight-bold" href="#">👤 <?= $_SESSION['username']; ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn text-white fa-fw" href="logout.php"><i class="fa fa-sign-out"></i></a>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link btn  text-white px-3 fa-fw" href="login.php"><i class="fa fa-user-circle-o"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn  text-white px-3 fa-fw" href="signup.php"><i class="fa fa-user-plus" aria-hidden="true"></i></a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>