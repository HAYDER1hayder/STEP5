<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BMI Calculator with Bootstrap</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- style -->
    <link rel="stylesheet" href="../public/css/bmi_form.css">
    <!--font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"
        integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <?php include '../public/header.php'; ?>
    <div class="container">
        <h1 class="text-center">BMI Calculator</h1>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>
        <?php if (isset($errorMessage)): ?>
            <div class="alert alert-danger mt-3">
                <?= $errorMessage ?>
            </div>
        <?php endif; ?>
        <form id="bmiForm" action="../public/index.php" method="post">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="weight">Weight (kg):</label>
                <input type="number" id="weight" name="weight" class="form-control" required min="1">
            </div>
            <div class="form-group">
                <label for="height">Height (m):</label>
                <input type="number" id="height" name="height" class="form-control" required min="0.01" step="0.01">
            </div>
            <button type="submit" class="btn btn-primary btn-block">Calculate</button>
        </form>
        <?php if (isset($bmiResult)): ?>
            <div class="alert alert-success mt-4">
                <h4>BMI Result:</h4>
                <p><strong>Name:</strong> <?= htmlspecialchars($bmiResult['name']) ?></p>
                <p><strong>Weight:</strong> <?= htmlspecialchars($bmiResult['weight']) ?> kg</p>
                <p><strong>Height:</strong> <?= htmlspecialchars($bmiResult['height']) ?> m</p>
                <p><strong>BMI:</strong> <?= $bmiResult['bmi'] ?></p>
                <p><strong>Status:</strong> <?= $bmiResult['status'] ?></p>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>