<?php

class Metro_Creativex_Message extends WP_Customize_Control{

    private $message = '';

    public function __construct( $manager, $id, $args = array(), $message ) {
        parent::__construct( $manager, $id, $args );
        $this->message = $message;
    }
    
    public function render_content(){
        echo '<span class="customize-control-title">'.$this->label.'</span>';
        echo $this->message;
    }

} 

?>