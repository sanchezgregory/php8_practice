<?php

namespace Factory;
class PDFDocument implements Document {

    public function generate()
    {
        echo "Creating document for";
    }
}