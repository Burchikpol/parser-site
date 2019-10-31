<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Parser
 */

get_header();
?>
    <section class="main">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h2>Domains List:</h2>
                    <form name="form" action="" method="get">
                        <input type="text" name="subject" id="subject" value="Car Loan">
                    </form>

                    <?php

                    $str = $_GET['subject'];;

                    // Function to convert string to array
                    $arr = explode(" ", $str);
?>


                    <?php
                    $brokenArr = [];
                    $worksArr = [];

                    foreach ($arr as &$value) {

                        $handle = curl_init($value);
                        curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);

                        /* Get the HTML or whatever is linked in $url. */
                        $response = curl_exec($handle);

                        /* Check for 404 (file not found). */
                        $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
                        if($httpCode == 200) {
                            echo $value . '<br>';
                            array_push($worksArr, $value);
                        } else {
                            echo '---' . $value . '---' . '<br>';
                            array_push($brokenArr, $value);
                        }

                        curl_close($handle);
                    }

                    ?>


                </div>

                <div class="col-lg-3">
                    <h2>Broken Domains:</h2>
                    <?php
                    foreach($brokenArr as $value){
?>
                        <a href="http://www.<?php echo $value; ?>"><?php echo $value; ?></a><br>

<?php
}
                    ?>

                </div>

                <div class="col-lg-3">
                    <h2>Works Domains:</h2>
                    <?php
                    foreach($worksArr as $value){

                        echo $value . '<br>';

                    }
                    ?>
                </div>
            </div>
        </div>
    </section>

<?php

get_footer();
