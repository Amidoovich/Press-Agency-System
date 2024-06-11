<?php
session_start();
include_once '../controller/include/DatabaseClass.php';
$db = new database();

// Initialize variables
$searchResults = null;
$searchError = '';

// Process the search form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
    // Get search criteria from the form
    $searchType = $_POST['search_type'];
    $searchTerm = $_POST['search_term'];

    // Check if search term is empty
    if (empty($searchTerm)) {
        $searchError = 'Please enter a search term.';
    } else {
        // Define the SQL query based on the search criteria
        if ($searchType === 'by_date') {
            $sql = "SELECT * FROM shownposts WHERE pdate LIKE '%$searchTerm%'";
        } elseif ($searchType === 'by_editor') {
            // Updated query for exact match on editor_name
            $sql = "SELECT * FROM shownposts WHERE username = '$searchTerm'";
        }

        // Execute the query
        $searchResults = $db->query($sql);

        // Store the search results in a session variable
        $_SESSION['search_results'] = $searchResults;
        $_SESSION['search_term'] = $searchTerm;
        $_SESSION['search_type'] = $searchType;

        // Redirect to the same page to prevent form resubmission on refresh
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }
}

// Check if search results are stored in the session
if (isset($_SESSION['search_results'])) {
    $searchResults = $_SESSION['search_results'];
    $searchTerm = $_SESSION['search_term'];
    $searchType = $_SESSION['search_type'];

    // Clear the session variables
    unset($_SESSION['search_results']);
    unset($_SESSION['search_term']);
    unset($_SESSION['search_type']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Search</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Optional custom styles */
        body {
            padding: 20px;
        }

        form {
            margin-bottom: 20px;
        }

        .result-item {
            border: 1px solid #ddd;
            padding: 10px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

    <!-- Search Form -->
    <div class="container">
        <form method="post" action="" class="mb-4">
            <div class="row g-3 align-items-center">
                <div class="col-auto">
                    <label for="search_type" class="col-form-label">Search By:</label>
                </div>
                <div class="col-auto">
                    <select name="search_type" id="search_type" class="form-select">
                        <option value="by_date">Date</option>
                        <option value="by_editor">Editor Name</option>
                    </select>
                </div>
                <div class="col-auto">
                    <input type="text" name="search_term" placeholder="Enter search term" class="form-control">
                </div>
                <div class="col-auto">
                    <button type="submit" name="search" class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>

        <!-- Display Search Results or Error Message -->
        <?php if (!empty($searchError)) : ?>
            <p class="alert alert-danger"><?= $searchError; ?></p>
        <?php elseif (isset($searchResults)) : ?>
            <h2>Search Results:</h2>
            <?php if (empty($searchResults)) : ?>
                <p>No results found.</p>
            <?php else : ?>
                <?php foreach ($searchResults as $result) : ?>
                    <div class="result-item">
                        <h3><?= $result['atitle']; ?></h3>
                        <p>Editor: <?= $result['username']; ?> | Date: <?= $result['pdate']; ?></p>
                        <p><?= $result['abody']; ?></p>
                        <p><?= $result['atype']; ?></p>
                        <p><?= $result['viewno']; ?></p>
                        <p><strong>IMG:</strong> <img src="assets/<?php echo $result['aimage']; ?>" width="90" height="90"></p>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
