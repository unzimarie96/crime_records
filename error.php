    <?php

    // Checking if there is an error 
    if (!empty($_GET['error-txt'])) {
        // Assign Variable
        $txt = $_GET['error-txt'];

        // Switch storen values
        switch ($txt) {
            case '1':
    ?>
    <div class="alert alert-danger a-toast">
        <b>Message</b>
        <p>Failed to update status</p>
    </div>
    <?php
                break;
            case '2':
    ?>
    <div class="alert alert-success a-toast">
        <b>Message</b>
        <p>You have logged out</p>
    </div>
    <?php
                break;
            case '3':
    ?>
    <div class="alert alert-primary a-toast">
        <b>Message</b>
        <p>Login to continue access</p>
    </div>
    <?php
                break;
            case '4':
    ?>
    <div class="alert alert-danger a-toast">
        <b>Message</b>
        <p>Failed to change satus of user</p>
    </div>
    <?php
            break;
        case '5':
    ?>
    <div class="alert alert-success b-toast">
        <b>Message</b>
        <p>You still logged in</p>
    </div>
    <?php
                break;
            case '6':
    ?>
    <div class="alert alert-danger b-toast">
        <b>Message</b>
        <p>No action choosed to perform</p>
    </div>
    <?php
                break;
            case '7':
    ?>
    <div class="alert alert-danger b-toast">
        <b>Message</b>
        <p>Failed to delete an officer</p>
    </div>
    <?php
                break;
            case '8':
    ?>
    <div class="alert alert-success b-toast">
        <b>Message</b>
        <p>An officer has been removed</p>
    </div>
    <?php
                break;
            case '9':
    ?>
    <div class="alert alert-success b-toast">
        <b>Message</b>
        <p>An officer info has been updated</p>
    </div>
    <?php
                break;
            case '10':
    ?>
    <div class="alert alert-danger b-toast">
        <b>Message</b>
        <p>Failed to update officer info</p>
    </div>
    <?php
                break;
            case '11':
    ?>
    <div class="alert alert-success b-toast">
        <b>Message</b>
        <p>An officer info has been added successful</p>
    </div>
    <?php
                break;
            case '12':
    ?>
    <div class="alert alert-danger b-toast">
        <b>Message</b>
        <p>Failed to add an officer into system</p>
    </div>
    <?php
                break;
            case '13':
    ?>
    <div class="alert alert-success b-toast">
        <b>Message</b>
        <p>An users has been removed successful</p>
    </div>
    <?php
                break;
            case '14':
    ?>
    <div class="alert alert-danger b-toast">
        <b>Message</b>
        <p>Failed to delete an user from system</p>
    </div>
    <?php
                break;
            case '15':
    ?>
    <div class="alert alert-success b-toast">
        <b>Message</b>
        <p>A user category has been updated successful</p>
    </div>
    <?php
                break;
            case '16':
    ?>
    <div class="alert alert-danger b-toast">
        <b>Message</b>
        <p>Failed to update user category, try again</p>
    </div>
    <?php
                break;
            case '17':
    ?>
    <div class="alert alert-danger b-toast">
        <b>Message</b>
        <p>You <b>"status"</b> have been changed</p>
    </div>
    <?php
                break;
            case '18':
    ?>
    <div class="alert alert-danger c-toast">
        <b>Message</b>
        <p>Failed to add a crime into the system.</p>
    </div>
    <?php
                break;
            case '19':
    ?>
    <div class="alert alert-success c-toast">
        <b>Message</b>
        <p>You have added <b>"crime"</b> into system</p>
    </div>
    <?php
                break;
            case '20':
    ?>
    <div class="alert alert-danger c-toast">
        <b>Message</b>
        <p>Failed to delete a crime from system.</p>
    </div>
    <?php
                break;
            case '21':
    ?>
    <div class="alert alert-success c-toast">
        <b>Message</b>
        <p>You have removed <b>"crime"</b> from system</p>
    </div>
    <?php
                break;
            case '22':
    ?>
    <div class="alert alert-danger c-toast">
        <b>Message</b>
        <p>Failed to update a <b>"crime"</b> in system.</p>
    </div>
    <?php
                break;
            case '23':
    ?>
    <div class="alert alert-success c-toast">
        <b>Message</b>
        <p>Updating a <b>"crime"</b> is successful done in system.</p>
    </div>
    <?php
                break;
        
        default:
            echo "";
            break;
    }
}else{
    echo "";
}
        
?>