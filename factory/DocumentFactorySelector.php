<?php

namespace Factory;
class DocumentFactorySelector
{
    protected $docFactory;

    public function __construct(DocumentFactory $docFactory)
    {
        $this->docFactory = $docFactory;
    }
    public function generate($type)
    {
        $type = strtolower($type);

        if (method_exists($this->docFactory, $type)) {
            return $this->docFactory->$type();
        } else {
            throw new UnsupportedDocumentTypeException("Document type {$type} not supported.");
        }
    }
}