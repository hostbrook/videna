<?php include PATH_VIEWS . 'inc/header.php' ?>

<div class="row">
    <div class="col-lg-12 text-center">
        <h1 class="mt-5">Log file</h1>
        <?php if ($log) : ?>
            <table>
                <tr>
                    <th style="text-align:left">Parameter</th>
                    <th style="text-align:left">Value</th>
                </tr>
                <?php foreach ($log as $line) : ?>
                    <tr>
                        <td style="text-align:left"><small><code><?= $line[0]; ?></code></small></td>
                        <td style="text-align:left"><small><code><?= $line[1]; ?></code></small></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        <?php else : ?>
            <p>Log file not found</p>
        <?php endif; ?>
    </div>
</div>

<?php include PATH_VIEWS . 'inc/footer.php' ?>