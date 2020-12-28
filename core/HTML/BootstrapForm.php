<?php

namespace Core\HTML;

/**
 * Class BootstrapForm
 * Generate Bootstrap html code for forms
 *
 */
class BootstrapForm extends Form
{

    /**
     *
     * surround params with div
     *
     * @param string $html
     * @return string
     */
    protected function surround($html)
    {
        return "<div class=\"form-group\"> $html </div>";
    }

    /**
     *
     * Generate bootstrap input html code
     *
     * @param string $name
     * @param string $label
     * @param array $option
     * @return string
     */
    public function input($name, $label, $option = [])
    {

        $type = isset($option['type']) ? $option['type'] : 'text';

        $label = '<label>' . $label . '</label>';

        if ($type === 'textarea') {
            $input = '<textarea
                        name="' . $name . '"
                        class="form-control">'
            . $this->getValue($name) .
                '</textarea>';
        } else {
            $input = '<input type="' . $type . '"
            name="' . $name . '"
            value="' . $this->getValue($name) . '"
            class="form-control"
        >';

        }
        return $this->surround($label . $input);
    }

    /**
     *
     * Generate a bootstrap submit button
     *
     * @param string $name
     * @return string
     */
    public function submit($name)
    {
        return $this->surround('<button type="submit" class="btn btn-primary">'.$name.'</button>');
    }

    /**
     *
     * generate a Bootstrap select input
     *
     * @param string $name
     * @param string $label
     * @param array $options
     * @return string
     */
    public function select($name, $label, $options)
    {
        if ($label != null) {
            $label = '<label>' . $label . '</label>';
        }

        $input = '<select name="' . $name . '" class="form-control">';

        foreach ($options as $k => $v) {

            $attrib = $k == $this->getValue($name) ? ' selected' : '';
            $input .= "<option value=" . $k . " $attrib>" . $v . "</options>";
        }

        $input .= '</select>';

        return $this->surround($label . $input);

    }

}
