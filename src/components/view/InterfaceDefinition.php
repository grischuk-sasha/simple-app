<?php
namespace src\components\view;

interface InterfaceDefinition
{
    const FORMAT_JSON   = 'srclication/json';
    const FORMAT_HTML   = 'text/html';
    const FORMAT_TXT    = 'text/plain';
    const FORMAT_XML    = 'text/xml';
    const FORMAT_RSS    = 'srclication/rss+xml';
    const FORMAT_FORMS  = 'srclication/x-www-form-urlencoded';
}