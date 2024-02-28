<?php include 'admin/inc/header.php' ?>

    <!-- CONTENT -->
    <div id="content" data-uk-height-viewport="expand: true">
        <div class="uk-container uk-container-expand">

            <div class="col-lg-12 text-center">
                
                <h3 class="mt-5">Application log file</h3>

                <div class="uk-panel uk-panel-scrollable" uk-height-viewport="expand: true">
                    <?php if ($log) : ?>
                        <?php foreach ($log as $line) : ?>
                        <?php
                            preg_match('/^\[(.*)\] (.*)$/Uism', $line, $match);

                            if (!empty($match)) {
                                $datetime = '[<span class="uk-text-success">' . $match[1] . '</span>]';

                                $recordType = $match[2];
                                $level = ' <span class="uk-text-primary">' . $recordType . '</span>';

                                preg_match('/.*(?:'.FATAL.'|'.EMERGENCY.'|'.ERROR.'|'.CRITICAL.').*/ism', $recordType, $match);
                                if (!empty($match)) $level = ' <span class="uk-text-danger">' . $recordType . '</span>';

                                preg_match('/.*(?:'.ALERT.'|'.WARNING.'|'.NOTICE.').*/ism', $recordType, $match);
                                if (!empty($match)) $level = ' <span class="uk-text-warning">' . $recordType . '</span>';
                
                                $line = '<span class="uk-text-muted">' . $datetime . $level . '</span>';
                            }
                            else {
                                preg_match('/^Stack trace(.*)$/Uism', $line, $match);
                
                                if ( !empty($match) )  {
                                    $line = '<span class="uk-text-muted">' . $match[0] . '</span>';
                                }
                                else {
                                    preg_match('/^#\d .*$/Uism', $line, $match);
                                    if ( !empty($match) )  {
                                        $line = '<span class="uk-text-muted">' . $match[0] . '</span>';
                                    }
                                    else {
                                        $line = '<span class="uk-text-secondary">' . $line . '</span>';
                                    }
                                }
                            }
                        ?>
                        <code class="uk-text-small"><?= $line ?></code><br>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p class="uk-text-success">Log file not found.</p>
                    <?php endif; ?>
                </div>

                <p>
                    <a class="uk-button uk-button-primary" href="/show-log">Update</a>
                    <button class="uk-button uk-button-danger" id="delete-log">Delete</button>
                </p>

            </div>

            <footer class="uk-section uk-section-small uk-text-center">
                <hr>
                <p class="uk-text-small uk-text-center">Copyright 2019 - <a
                        href="https://github.com/zzseba78/Kick-Off">Created by KickOff</a> | Built with <a
                        href="http://getuikit.com" title="Visit UIkit 3 site" target="_blank" data-uk-tooltip><span
                            data-uk-icon="uikit"></span></a> </p>
            </footer>
        </div>
    </div>
    <!-- /CONTENT -->

<script>
/**
 * Update log file
 */

// Choose element:
const btnDeleteLog = document.querySelector('#delete-log');

// Set event listener for selected element:
btnDeleteLog.addEventListener('click', function () {
    DeleteLogFile();
});

// Delete file function:
async function DeleteLogFile() {
    //user.crsf_token = document.querySelector('meta[name="csrf_token"]').getAttribute("content");
    let data = {
      "csrf_token": "<?= $csrf->token ?>"
    }

    try {
        const response = await fetch("/admin/ajax/delete-log", {
            method: 'DELETE',
            body: JSON.stringify(data),
            headers: {
                'Content-type': 'application/json'
            }
        });

        if(response.ok) {
            
            const jsonResponse = await response.json();
            if (jsonResponse.response != 200) console.log(jsonResponse.status);

            setTimeout(function() {window.location.replace("/show-log");}, 500);

        }
    } catch (error) {
        console.log(error);
    }
}

</script>


<?php include 'admin/inc/footer.php' ?>