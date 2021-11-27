<?php include PATH_VIEWS . 'inc/header.php' ?>

<div class="row">
    <div class="col-lg-12 text-center">
        <h1 class="mt-5"><?= $_['header'] ?></h1>
        <p class="lead"><?= $_['lead'] ?></p>
        <ul class="list-unstyled">
            <li>Bootstrap 5.0</li>
            <li>jQuery 3.5.1</li>
        </ul>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 text-center">
        <button type="button" id="test-ajax" class="btn btn-primary mb-3">Test Ajax</button>
        <div class="alert alert-primary" id="test-text-out">
            <em>This text should be replaced with AJAX TEXT response.</em>
        </div>
    </div>
</div>

<div class="row ">
    <div class="col-lg-12 text-center border my-3 py-3" id="test-html-out">
        <em>This block should be replaced with AJAX HTML response.</em>
    </div>
</div>

<script>
    $(document).on({
        click: function() {

            $.ajax({

                url: "/ajax/test",
                dataType: 'json',
                data: {
                    name: "John",
                    age: 35
                },

                success: function(data) {

                    $('#test-text-out').html(data.text);
                    $('#test-html-out').html(data.html);

                },

                error: function(jqXHR, textStatus, errorThrown) {
                    console.log('Error occurred during AJAX request:');
                    console.log(getErrorDescr(jqXHR).state);
                    console.log(getErrorDescr(jqXHR).status);
                }

            });

        }
    }, '#test-ajax');
</script>

<?php include PATH_VIEWS . 'inc/footer.php' ?>