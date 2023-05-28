<!DOCTYPE html>
<html>
<head>
    <title>Group Selection</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous"></head>
</head>
<body>
    <?php include 'navigation.php'; ?>
    <div class="container">
        <h1 class="mt-5">Group Selection</h1>
        <div class="mb-3">
            <a href="<?= BASE_URL . "group/create" ?>" class="btn btn-primary">Create a Group</a>
        </div>
        <?php if (isset($errorMessage)): ?>
            <div class="alert alert-danger"><?= $errorMessage ?></div>
        <?php endif; ?>
        <div class="mb-3">
            <input type="text" id="search" class="form-control" placeholder="Search Groups">
        </div>
        <div id="groupList">
            <?php foreach ($groups as $group): ?>
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><?= $group['name'] ?></h5>
                        <p class="card-text"><?= $group['description'] ?></p>
                        <a href="<?= BASE_URL . "group?id=" . $group['id'] ?>" class="btn btn-primary">View Group</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script>
        // Search functionality
        const searchInput = document.querySelector('#search');
        const groupList = document.querySelector('#groupList');

        searchInput.addEventListener('input', function (event) {
            const searchTerm = event.target.value.toLowerCase();
            const groups = groupList.getElementsByClassName('card');

            Array.from(groups).forEach(function (group) {
                const groupName = group.querySelector('.card-title').textContent.toLowerCase();
                const groupDescription = group.querySelector('.card-text').textContent.toLowerCase();

                if (groupName.includes(searchTerm) || groupDescription.includes(searchTerm)) {
                    group.style.display = 'block';
                } else {
                    group.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>
