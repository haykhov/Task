<?php
    /* Require libraries from folder libraries */
    require_once 'libraries/Core.php';
    require_once 'libraries/Controller.php';
    require_once 'libraries/Database.php';
    require_once 'config/config.php';
    require_once 'helpers/UploadFile.php';
    require_once 'helpers/ReadFile.php';

    require_once 'helpers/matches/Matched.php';
    require_once 'helpers/matches/MatchedInterface.php';
    require_once 'helpers/matches/Timezone.php';
    require_once 'helpers/matches/Age.php';
    require_once 'helpers/matches/Division.php';

    /* Instantiate core class */
    try {
        $init = new Core();
    } catch (Exception $e) {
        echo 'Error: ',  $e->getMessage(), "\n";
    }


