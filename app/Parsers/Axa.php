<?php

namespace App\Parsers;

use Illuminate\Support\Facades\Storage;
use simplehtmldom\HtmlWeb;
use simplehtmldom\HtmlDocument;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class Axa
{
    public $axaHtml;

    function __construct() {
        $this->axaHtml = $this->getStartHtml();
    }

    public function getStartHtml():HtmlDocument 
    {

        $axaHtml = new HtmlWeb();
        $axaHtml = $axaHtml->load(config('parser.axa'));

        return $axaHtml;
    
    }

    public function getSubPage(string $link):HtmlDocument
    {

        $axaSubPageHtml = new HtmlWeb();
        $axaSubPageHtml = $axaSubPageHtml->load($link);

        return $axaSubPageHtml;

    }

    public function getTitlesAndLinks():Collection
    {

        $titlesAndLinks = collect($this->axaHtml->find('a[rel=bookmark]'));

        $titlesAndLinks = $titlesAndLinks->map(function ($titlesAndLinks) {
        return [
            $titlesAndLinks->title,
            $titlesAndLinks->href = config('parser.axa'). $titlesAndLinks->href
            ];
        });

    return $titlesAndLinks;

    }

    public function getEndDates():Collection 
    {
    
        $endDates = collect($this->axaHtml->find('.post-content p'));

        $endDates = $endDates->map(function ($endDate) {
            return [
                $endDate->_[5] = Carbon::parse(str_replace('DATA ZAKONCZENIA AUKCJI: ','',$endDate->_[5]))
            ];
        });
    
        return $endDates;

    }

    public function getContentTables():array
    {
        
        $links = $this->getTitlesAndLinks();
        $links = $links->map(function ($link) {
            return substr($link[1],strlen(config('parser.axa')));
        });

        $i = 0;

        foreach ($links as $link) {
           $subPagesHtml[] = $this->getSubPage($link);
           $tables[] = $subPagesHtml[$i]->find('.table-striped');
           $panels[] = $subPagesHtml[$i]->find('.panel-default');
           $content[] = preg_replace('|<div id="comments_wrap">[.\s\W\w]*<.div>|',
           '',
           $tables[$i][0].$tables[$i][1].$tables[$i][2].$tables[$i][3].$panels[$i][0].$panels[$i][1].$panels[$i][2].$panels[$i][3].$panels[$i][5].$panels[$i][6].$panels[$i][7]);
           $i++;
        }

        return $content;

    }

    public function save() {

        $this->getTitlesAndLinks();
        $this->getEndDates();
        $this->getContentTables();
        
    }
}
