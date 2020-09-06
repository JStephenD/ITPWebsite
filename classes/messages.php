<?php
namespace classes;

class Messages {
    function __construct() {
        if (!isset($_SESSION['messages'])) {
            $_SESSION['messages'] = [];
        }
    }

    public static function add($message, $type) {
        array_push($_SESSION['messages'], 
            ["message" => $message, "type" => $type]
        );
    }

    public function show() {
        foreach ($_SESSION['messages'] as $row) {
            $message = $row['message'];
            $type = $row['type'];
            ?>
            
            <div class="alert alert-<?= $type ;?>" alert-dismissible fade show role="alert">
                <?= $message ;?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
        <?php }

        $_SESSION['messages'] = [];
    }
}

?>