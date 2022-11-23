<?php
    class Entity_Department {
        public $IDPB;
        public $Tenpb;
        public $Mota;
        public function __construct($IDPB, $Tenpb, $Mota) {
            $this->IDPB = $IDPB;
            $this->Tenpb = $Tenpb;
            $this->Mota = $Mota;
        }



    }



?>