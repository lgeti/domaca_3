<!-- view/group-selection.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Group Selection</title>
    <link rel="stylesheet" href="styles.css">
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="mt-5">Group Selection</h1>
        <div class="mb-3">
            <input type="text" id="search" class="form-control" placeholder="Search Groups">
        </div>
        <div id="groupList">
            <?php foreach ($groups as $group): ?>
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title"><?= $group['name'] ?></h5>
                        <p class="card-text">Description: <?= $group['description'] ?></p>
                        <a href="<?= BASE_URL . "group?id=" . $group['id'] ?>" class="btn btn-primary">View Group</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Include Bootstrap JS (at the end of the body) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/js/bootstrap.bundle.min.js"></script>
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
