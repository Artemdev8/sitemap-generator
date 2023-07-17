<?php


class SitemapException extends Exception
{

}
class ItemsException extends SitemapException
{
    protected $message = 'Incorrect data sent.';
}
class DirectoryException extends SitemapException
{
    protected $message = 'Wrong directory.';
}
class ModeException extends SitemapException
{
    protected $message = 'Wrong mode.';
}