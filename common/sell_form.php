<?php
function draw_sell_form(){
?>
<!doctype html>
<html lang="en">
<body>
    <main>
        <section>
            <h2>Submit an item for selling</h2>
            <form method="post" action="sell_page.php" enctype="multipart/form-data">
                <label for="title">Title:</label><br>
                <input type="text" id="title" name="title" required><br>
                <label for="description">Description:</label><br>
                <textarea id="description" name="description" required></textarea><br>
                <label for="price">Price:</label><br>
                <input type="number" id="price" name="price" step="10" required><br>
                <label for="condition">Condition:</label><br>
                <input type="text" id="condition" name="condition"><br>
                <label for="category">Category:</label><br>
                <input type="text" id="category" name="category" required><br><br>
                <label for="image">Image:</label><br>
                <input type="file" id="image" name="image" accept="image/*" required><br><br>
                <input type="submit" value="Submit">
            </form>
        </section>
    </main>
</body>

</html>
<?php
}
?>