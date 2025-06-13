    <?php
    class database
    {
        private $host = "172.31.22.43";
        private $user = "Badr200625161";
        private $pass = "94kB3--Axv";
        private $dbname = "Badr200625161";
        protected $connection;
        // Creat our function
        public function __construct() {
            if(!isset($this->connection)) {
                $this->connection = new mysqli($this->host, $this->user, $this->pass, $this->dbname);
                if(!$this->connection) {
                    echo "<p>Could not connect to the database.</p>";
                    exit;
                }
            }
            return $this->connection;
        }
    }
    ?>