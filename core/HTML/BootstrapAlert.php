<?php

namespace Core\HTML;

class BootstrapAlert
{

    public function notification($message, $type)
    {
        return  '<div class="alert alert-' .$type. '" alert-dismissible">' .$message. '</div>';
    }

}
