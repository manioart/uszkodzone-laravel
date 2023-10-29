<?php

namespace App\Parsers;

use Illuminate\Support\Facades\Storage;
use simplehtmldom\HtmlWeb;
use simplehtmldom\HtmlDocument;
use Carbon\Carbon;
use Illuminate\Support\Collection;

class Axa
{
    private $axaHtml;
    private $links;

    function __construct() {
        $this->axaHtml = $this->getStartHtml();
        $this->links = $this->getLinks(); 
    }

    public function getStartHtml():HtmlDocument 
    {

        $axaHtml = new HtmlWeb();
        $axaHtml = $axaHtml->load(config('parser.axa'));

        return $axaHtml;
    
    }

    public function getHtml(string $link):HtmlDocument 
    {

        $axaHtml = new HtmlWeb();
        $axaHtml = $axaHtml->load($link);

        return $axaHtml;
    
    }

    public function getLinks()
    {

        $links = collect($this->axaHtml->find('a[rel=bookmark]'));

        $links = $links->map(function ($links) {
        return $links->href = config('parser.axa'). $links->href;
        });

    return $links;

    }

    public function getTitles():Collection
    {

        $titles = collect($this->axaHtml->find('a[rel=bookmark]'));

        $titles = $titles->map(function ($titles) {
        return $titles->title;
        });

    return $titles;

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

        $i = 0;

        foreach ($this->links as $link) {
           $subPagesHtml[] = $this->getHtml($link);
           $tables[] = $subPagesHtml[$i]->find('.table-striped');
           $panels[] = $subPagesHtml[$i]->find('.panel-default');
           $content[] = preg_replace('|<div id="comments_wrap">[.\s\W\w]*<.div>|',
           '',
           $tables[$i][0].$tables[$i][1].$tables[$i][2].$tables[$i][3].$panels[$i][0].$panels[$i][1].$panels[$i][2].$panels[$i][3].$panels[$i][5].$panels[$i][6].$panels[$i][7]);
           $i++;
        }

        return $content;

    }

    public function getImages():array
    {

        $i = 0;
        $j = 0;

        foreach ($this->links as $link) {
           $subPagesHtml[] = $this->getHtml($link);
           $images[$i] = $subPagesHtml[$i]->find('.size-full');
           foreach ($images[$i] as $image) {
                $src[$i][$j] = $image->getAttribute('src');
                $j++;
           }
           $i++;
        }

        return $src;

    }

    public function getYears():array
    {

        $i = 0;

        foreach ($this->links as $link) {
           $subPagesHtml[] = $this->getHtml($link);
           $years = collect($subPagesHtml[$i]->find('.articledetail tr td'));
           $yearsOfProd[] = (int)substr(preg_replace("/[^0-9]/", "", $years[3]->_[5] ), -4);
           $i++;
        }

        return $yearsOfProd;

    }

    public function save() {

        // dump($this->getTitles());
        // dump($this->getLinks());
        // dump($this->getEndDates());
        // return $this->getImages();
        // return $this->getYears();
        // return $this->getContentTables();
    }
}
