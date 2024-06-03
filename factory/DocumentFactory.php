<?php

namespace Factory;

class DocumentFactory
{

    public function pdf()
    {
        return new PDFDocument();
    }

    public function csv()
    {
        return new CSVDocument();
    }

    public function html()
    {
        return new HTMLDocument();
    }
}