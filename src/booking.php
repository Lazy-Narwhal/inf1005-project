<!-- Floating Window Booking -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>
            Booking
        </title>
        <?php
            include "inc/head.inc.php"
        ?>
        <script src="js/calendar.js"></script>
    </head>
    <body>
        <main class="container">
            <h1 class="display-1">
                Book Your Experience
            </h1>
            <hr>
            <h2>The Pharaoh&apos;s Curse</h2>
            <p>Uncover ancient secrets in the tomb of a forgotten pharaoh. Solve hieroglyphic puzzles and avoid deadly traps&dot;</p>
            <div class="d-flex p-2 bd-highlight">
                <img src="images/calendar.png" class="logo me-2">
                <p>Select a date</p>
            </div>
            <?php
                include "inc/calendar.inc.php"
            ?>
        </main>
    </body>
</html>
