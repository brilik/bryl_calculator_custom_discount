<?php
/**
 * Created by PhpStorm.
 * User: Vitalii Bryl
 * Date: 11.04.2019
 * Time: 14:15
 */

class Calculator
{
    /**
     * Calculator constructor.
     */
    public function __construct()
    {
        add_shortcode('Author', array($this, 'isAuthor'));

        add_shortcode('Calculator', array($this, 'calculator_custom'));

        add_filter('widget_text', 'do_shortcode');

    }


    /**
     * Who Author Shortcode [Author]
     * @return string
     */
    public function isAuthor()
    {
        return 'Author plugined Vitalii Bryl.';
    }

    /** MAIN
     * Add Calculator Shortcode [Calculator]
     * @param $arg
     * @return string
     */
    public function calculator_custom($arg)
    {
//        print_r($arg);

//        $view = $this->calc_generate_table($arg['title'], $arg['select'], $arg['price']);

        $view = $this->calc_generate_form($arg['title'], $arg['select'], $arg['price']);

        return $view;
    }

    private function calc_generate_form($title, $arrSelect, $price)
    {
        $cururl = 'http' . (($_SERVER['HTTPS'] == 'on') ? 's' : '') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

        $arrSelect = $this->calc_select_array_explode($arrSelect);

        return
            '
        <form id="calc-form" action="' . $cururl . '">
            <h4>' . $title . '</h4>
            <div class="group-select">
                <span class="title">One column</span>
                ' . $this->calc_generate_select($arrSelect) . '
            </div>
            <div class="group-discount">
                <span class="title">Discount</span>
                <span id="discount">0</span>
                <input type="hidden" name="discount" value="' . $arrSelect[0][1] . '">
            </div>
            <div class="group-price">
                <span class="title">Price</span>
                <span id="calc-price">' . $price . '</span>
                <input type="hidden" name="price" value="' . $price . '">
            </div>
            <div class="group-output">
                <span class="title">Output: </span>
                <span id="calc-res">' . $this->get_val_formul($price, $arrSelect[0][1]) . '</span>
                <input type="hidden" name="res" value="' . $this->get_val_formul($price, $arrSelect[0][1]) . '">
            </div>
            <input type="hidden" name="url" value="' . $cururl . '">
            <div class="group-btn-sumbit">
                <input id="calc-send" type="submit">
            </div>
            <div class="message"></div>
        </form>
        ';

    }


    /**
     * Get value calculated by the formula
     * @param $price
     * @param $discount
     * @return float|int
     */
    private function get_val_formul($price, $discount)
    {
        return $price + ( $price - ( $price * $discount ) );
    }

    /**
     * We divide the array with commas ( , ) and then with a colon ( : )
     * @param $arrSelect
     * @return array
     */
    private function calc_select_array_explode($arrSelect)
    {
        $arr = $this->calc_select_explode($arrSelect, ',');

        $arrSelect = array();

        foreach ($arr as $item) {
            array_push($arrSelect, $this->calc_select_explode($item, ':'));
        }

        return $arrSelect;
    }

    /**
     * Explode text to array.
     * <br/> <b>[Example]</b>: 1,two,hello
     * <br/> <b>[Output]</b> <br/> [0]->1 <br/> [1]->two <br/> [2]->hello
     * @param $string
     * @param $delimiter
     * @return array
     */
    private function calc_select_explode($string, $delimiter)
    {
        return explode($delimiter, $string);
    }

    /**
     * Generated Select
     * @param $array
     * @return string
     */
    private function calc_generate_select($array)
    {
        $content = '';
        $content .= '<select id="calc-select" name="select" data-cur-dicount="0">';
        foreach ($array as $item) {
            $content .= '<option value="' . $item[0] . '" data-discount="0.' . $item[1] . '">' . $item[0] . '</option>';
        }
        $content .= '</select>';

        return $content;

    }

    /**
     * Generate table with values
     * @param $title
     * @param $arrSelect
     * @param $price
     * @return string
     */
    private function calc_generate_table($title, $arrSelect, $price)
    {
        $arrSelect = $this->calc_select_array_explode($arrSelect);

        $table = '<table id="calc-table">';
        $table .= '<caption>' . $title . '</caption>';
        $table .= '<tr>';
        $table .= '<td>' . $this->calc_generate_select($arrSelect) . '</td>';
        $table .= '<td>' . $price . '</td>';
        $table .= '<td id="sum">0</td>';
        $table .= '</tr>';
        $table .= '</table>';

        return $table;
    }
}