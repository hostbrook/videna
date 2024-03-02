<?php include 'admin/inc/header.php' ?>

    <!-- CONTENT -->
    <div id="content" data-uk-height-viewport="expand: true">
        <div class="uk-container uk-container-expand">

            <div class="col-lg-12 text-center">
                
                <h3 class="mt-5">Application log file</h3>

                <div id="log" class="uk-panel uk-panel-scrollable" uk-height-viewport="expand: true">

                </div>

                <p>
                    <button class="uk-button uk-button-primary" id="update-log">Update</button>
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
 * Update log file  (Example GET)
 */

// Choose element:
const btnUpdateLog = document.querySelector('#update-log');

// Set event listener for selected element:
    btnUpdateLog.addEventListener('click', function () {
    UpdateLogFile();
});

// Update file function:
const UpdateLogFile = async () => {
    try {
        const response = await fetch('/admin/ajax/update-log');
        if (response.ok) {
            const jsonResponse = await response.json();
            document.getElementById('log').innerHTML = jsonResponse.html;
        }
    }
    catch (error) {
        console.log(error);
    }
}


UpdateLogFile();

/**
 * Delete log file (Example POST)
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
        <?= $csrf->json ?>
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
            if (jsonResponse.response != 200) document.getElementById('log').innerHTML = jsonResponse.html;
        }
    } catch (error) {
        console.log(error);
    }
}

</script>


<?php include 'admin/inc/footer.php' ?>