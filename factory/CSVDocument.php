<?php

namespace Factory;
class CSVDocument implements Document {

    public function generate()
    {
        echo "Creating document for CSV";
    }
}