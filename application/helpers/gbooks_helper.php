<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
// ------------------------------------------------------------------------

/**
 * CodeIgniter Google Books Helper
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		Arfeen Arif | pwoxisolutions.com
 */
// ------------------------------------------------------------------------
// Books Search
function gbook_search ($title)
{
    $ci = & get_instance();
    $output = array();

    $url = 'https://www.googleapis.com/books/v1/volumes?q=' . urlencode($title) . '&maxResults=20&orderBy=relevance&key=' . $ci->config->item('gbooks_api') . '';

    $ci->curl->create($url);
    $ci->curl->option(CURLOPT_RETURNTRANSFER, 1);
    $ci->curl->option(CURLOPT_SSL_VERIFYPEER, false);
    $json = $ci->curl->execute();

    $http_code = $ci->curl->info['http_code'];

    if ($http_code == 200)
    {
        $results = json_decode($json);

        $i = 0;
        foreach (@$results->items as $result)
        {
            $i++;
            $output[$i]['title'] = ucwords($result->volumeInfo->title);
            $output[$i]['gbook_id'] = $result->id;
            $output[$i]['isbn'] = '-';
            $output[$i]['description'] = '';
            $output[$i]['authors'] = '';
            $output[$i]['published'] = '-';
            $output[$i]['thumbnail'] = base_url() . 'uploads/books/default.png';
            if (@$result->volumeInfo->industryIdentifiers)
            {
                foreach (@$result->volumeInfo->industryIdentifiers as $idt)
                {
                    if (@$idt->type == 'ISBN_13')
                    {
                        $output[$i]['isbn'] = $idt->identifier;
                    }
                }
            }
            if (@$result->volumeInfo->authors)
            {
                $output[$i]['authors'] = implode(", ", $result->volumeInfo->authors);
            }
            if (@$result->volumeInfo->description)
            {
                $output[$i]['description'] = strip_tags($result->volumeInfo->description);
            }
            if (@$result->volumeInfo->imageLinks)
            {
                $output[$i]['thumbnail'] = $result->volumeInfo->imageLinks->thumbnail;
            }
            if (@$result->volumeInfo->publishedDate)
            {
                $unix = human_to_unix($result->volumeInfo->publishedDate . ' 00:00:00 AM');
                $datestring = "%F %d %Y";
                $output[$i]['published'] = mdate($datestring, $unix);
                //$output[$i]['published'] = $result->volumeInfo->publishedDate;
            }

            // checking for already added
            $ci->load->model('books_model');
            $book_exists = $ci->books_model->book_exists($output[$i]['isbn'], $result->volumeInfo->title);
            $output[$i]['read'] = $book_exists;
        }
    }
    return $output;
}

?>