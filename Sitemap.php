<?php
require_once 'SitemapException.php';

class Sitemap {
    protected $items;
    protected $mode;
    protected $directory;

    public function __construct($items = [], $mode = null, $directory = null) {
        $this->items = $items;
        $this->mode = $mode;
        $this->directory = $directory;
    }

    public function addItem($item) {
        $this->items[] = $item;
    }

    public function setMode($mode) {
        $this->mode = $mode;
    }

    public function setDirectory($directory) {
        $this->directory = $directory;

        $separator = strripos($this->directory, '/');
        $directory = substr($this->directory, 0, ++$separator);

        if(!file_exists(__DIR__.$directory)) {
            mkdir(__DIR__.$directory, 0755, true);
        }
    }

    protected function checkItems() {
        $keys = ['loc', 'lastmod', 'priority', 'changefreq'];
        foreach ($this->items as $item) {
            if(0 !== count(array_diff($keys, array_keys($item)))) {
                return false;
            }
        }
        return true;
    }

    protected function checkDirectory() {
        if(strlen($this->directory) < strlen('.'.$this->mode)) {
            throw new DirectoryException();
        }
        if(strpos($this->directory, '.'.$this->mode, -strlen($this->mode) - 1)) {
            return true;
        } else {
            throw new DirectoryException();
        }
    }

    protected function createXml() {
        $dom = new DOMDocument('1.0', 'UTF-8');
        $urlset = $dom->createElement('urlset');
        $urlset->setAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');

        if($this->checkItems()) {
            foreach ($this->items as $item) {
                $url = $dom->createElement('url');

                $loc = $dom->createElement('loc');
                $text = $dom->createTextNode(htmlentities($item['loc'], ENT_QUOTES));
                $loc->appendChild($text);
                $url->appendChild($loc);

                $lastmod = $dom->createElement('lastmod');
                $text = $dom->createTextNode($item['lastmod']);
                $lastmod->appendChild($text);
                $url->appendChild($lastmod);

                $priority = $dom->createElement('priority');
                $text = $dom->createTextNode($item['priority']);
                $priority->appendChild($text);
                $url->appendChild($priority);

                $changefreq = $dom->createElement('changefreq');
                $text = $dom->createTextNode($item['changefreq']);
                $changefreq->appendChild($text);
                $url->appendChild($changefreq);

                $urlset->appendChild($url);
            }
        } else {
            throw new ItemsException();
        }

        $dom->appendChild($urlset);
        $doc = $dom->saveXML();

        $this->setDirectory($this->directory);
        file_put_contents(__DIR__.$this->directory, $doc);
    }

    protected function createCsv() {
        if($this->checkItems()) {
            $this->setDirectory($this->directory);

            $file = fopen(__DIR__.$this->directory, 'w');
            fputcsv($file, ['loc', 'lastmod', 'priority', 'changefreq'], ';');
            foreach ($this->items as $item) {
                fputcsv($file, $item, ';');
            }
            fclose($file);
        } else {
            throw new ItemsException();
        }
    }

    protected function createJson() {
        if($this->checkItems()) {
            $this->setDirectory($this->directory);
            $file = fopen(__DIR__ . $this->directory, 'w');
            fwrite($file, json_encode($this->items, JSON_UNESCAPED_SLASHES));
            fclose($file);
        } else {
            throw new ItemsException();
        }
    }

    public function execute() {
        if($this->mode === 'xml' && $this->checkDirectory()) {
            $this->createXml();
        }
        elseif($this->mode === 'csv' && $this->checkDirectory()) {
            $this->createCsv();
        }
        elseif($this->mode === 'json' && $this->checkDirectory()) {
            $this->createJson();
        } else {
            throw new ModeException();
        }
    }
}