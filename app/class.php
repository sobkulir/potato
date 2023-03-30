<html> 
    <body>
        <h1>  Header </h1>
        <?php
            class Typek {
                public $name;
                public $color;

                function set_name($name) {
                    $this->name = $name;
                }

                function get_name() {
                    return $this->name;
                }

            }

            $drbko = new Typek();
            $drbko->set_name("Drboslav druhy");

            $david = new Typek();
            $david->set_name("Tupy chuj");

            echo $david->get_name();
            echo "<br>";
            echo $drbko->get_name();

        ?>
    </body>
</html>

