<?php
interface DeveloperSay {
    function recommend();
}
class JavaDeveloperSay implements DeveloperSay {
    function recommend()
    {
     return 'I am a Java developer';
    }
}
class PhpDeveloperSay implements DeveloperSay {
    function recommend()
    {
        return 'I am PHP developer';
    }
}
class DeveloperService {
    protected  $developerSay;
    public function __construct(DeveloperSay $java)
    {
        $this->developerSay = $java;
    }
    public function introduce() {
        return $this->developerSay->recommend();
    }
}
class  PTTController {
    private $devService;
    public function __construct(DeveloperService $service)
    {
        $this->devService = $service;
    }
    public function test()
    {
        return $this->devService->introduce();
    }
}
