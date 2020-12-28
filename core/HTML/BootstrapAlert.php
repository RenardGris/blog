<?php

namespace Core\HTML;

class BootstrapAlert
{

    /**
     *
     * Generate Html code to return a Bootstrap Alert
     *
     * @param string $message
     * @param string $type
     * @return string
     */
    public function notification($message, $type)
    {
        return  '<div class="alert alert-' .$type. '" alert-dismissible">' .$message. '</div>';
    }

}
