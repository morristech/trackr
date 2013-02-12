<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
// ------------------------------------------------------------------------

/**
 * CodeIgniter trakt.tv Helper
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		Arfeen Arif | pwoxisolutions.com
 */
// ------------------------------------------------------------------------
// 
// Movie Search
function trakt_movie_search ($title)
{
    $ci = & get_instance();
    $output = array();

    $url = 'http://api.trakt.tv/search/movies.json/' . $ci->config->item('trakt_api') . '/' . urlencode($title) . '';

    $json = $ci->curl->simple_get($url);

    //  echo $proxy_url . $proxy_parameter;

    $http_code = $ci->curl->info['http_code'];

    if ($http_code == 200)
    {
        $results = json_decode($json);
        $i = 0;
        foreach ($results as $result)
        {
            $i++;
            $output[$i]['title'] = $result->title;
            $output[$i]['year'] = $result->year;
            $output[$i]['overview'] = $result->overview;
            $output[$i]['tmdb_id'] = $result->tmdb_id;
            $output[$i]['imdb_id'] = $result->imdb_id;
            // API poster hack start - for small size posters
            if ($result->images->poster)
            {
                $ext = strrchr($result->images->poster, '.');
                $post_url_without_ext = substr($result->images->poster, 0, -strlen($ext));
                $output[$i]['poster'] = $post_url_without_ext . '-138.jpg';
                if ($result->images->poster == 'http://vicmackey.trakt.tv/images/poster-small.jpg')
                {
                    $output[$i]['poster'] = base_url() . 'uploads/movies/default.png';
                }
            }
            else
            {
                $output[$i]['poster'] = base_url() . 'uploads/movies/default.png';
            }
            // API poster hack ended
            $output[$i]['trailer'] = $result->trailer;

            // checking for already added movies
            $ci->load->model('movies_model');
            $movie_exists = $ci->movies_model->movie_exists($result->imdb_id, $result->tmdb_id);
            $output[$i]['watched'] = $movie_exists;
        }
    }
    return $output;
}

// TV Show Search
function trakt_tvshow_search ($title)
{
    $ci = & get_instance();
    $output = array();
    $url = 'http://api.trakt.tv/search/shows.json/' . $ci->config->item('trakt_api') . '/' . urlencode($title) . '';
    $json = $ci->curl->simple_get($url);
    $http_code = $ci->curl->info['http_code'];
    if ($http_code == 200)
    {
        $results = json_decode($json);
        $i = 0;
        foreach ($results as $result)
        {
            $i++;
            $output[$i]['title'] = $result->title;
            $output[$i]['year'] = $result->year;
            $output[$i]['first_aired'] = $result->first_aired;
            $output[$i]['overview'] = $result->overview;
            $output[$i]['tvdb_id'] = $result->tvdb_id;
            $output[$i]['imdb_id'] = $result->imdb_id;
            $output[$i]['tvrage_id'] = $result->tvrage_id;
            $output[$i]['network'] = $result->network;
            $output[$i]['air_day'] = $result->air_day;
            $output[$i]['air_time'] = $result->air_time;
            // API poster hack start - for small size posters
            if ($result->images->poster)
            {
                $ext = strrchr($result->images->poster, '.');
                $post_url_without_ext = substr($result->images->poster, 0, -strlen($ext));
                $output[$i]['poster'] = $post_url_without_ext . '-138.jpg';
                if ($result->images->poster == 'http://vicmackey.trakt.tv/images/poster-small.jpg')
                {
                    $output[$i]['poster'] = base_url() . 'uploads/tvshows/shows/default.png';
                }
            }
            else
            {
                $output[$i]['poster'] = base_url() . 'uploads/tvshows/shows/default.png';
            }
            // API poster hack ended
            // checking for already added movies
            $ci->load->model('tv_model');
            $tvshow_exists = $ci->tv_model->tvshow_exists($result->imdb_id, $result->tvdb_id, $result->title);
            $output[$i]['added'] = $tvshow_exists;
        }
    }
    return $output;
}

// TV Show Seasons
function trakt_tvshow_seasons ($tvdb_id)
{
    $output = array();
    $ci = & get_instance();
    $url = 'http://api.trakt.tv/show/seasons.json/' . $ci->config->item('trakt_api') . '/' . $tvdb_id . '';
    $json = $ci->curl->simple_get($url);
    $http_code = $ci->curl->info['http_code'];
    if ($http_code == 200)
    {
        $results = json_decode($json);
        sort($results);
        $i = 0;
        foreach ($results as $result)
        {
            $i++;
            $output[$i]['season'] = $result->season;
            $output[$i]['episodes'] = $result->episodes;
            // API poster hack start - for small size posters
            if ($result->images->poster)
            {
                $ext = strrchr($result->images->poster, '.');
                $post_url_without_ext = substr($result->images->poster, 0, -strlen($ext));
                $output[$i]['poster'] = $post_url_without_ext . '-138.jpg';
                if ($result->images->poster == 'http://vicmackey.trakt.tv/images/poster-small.jpg')
                {
                    $output[$i]['poster'] = base_url() . 'uploads/tvshows/seasons/default.png';
                }
            }
            else
            {
                $output[$i]['poster'] = base_url() . 'uploads/tvshows/seasons/default.png';
            }
            // API poster hack ended
        }
    }
    return $output;
}

// TV Show Season's Episodes
function trakt_tvshow_season_episodes ($tvdb_id, $season)
{
    $ci = & get_instance();
    $output = array();
    $url = 'http://api.trakt.tv/show/season.json/' . $ci->config->item('trakt_api') . '/' . $tvdb_id . '/' . $season . '';
    $json = $ci->curl->simple_get($url);
    $http_code = $ci->curl->info['http_code'];
    if ($http_code == 200)
    {
        $results = json_decode($json);
        $i = 0;
        foreach ($results as $result)
        {
            $i++;
            // checking for already added movies
            $ci->load->model('tv_model');
            $tvshow_episode_exists = $ci->tv_model->tvshow_episode_exists($tvdb_id, $season, $result->episode);
            if ($tvshow_episode_exists)
            {
                $output[$i]['watched'] = TRUE;
                $output[$i]['season'] = $tvshow_episode_exists['season'];
                $output[$i]['episode'] = $tvshow_episode_exists['episode'];
                $output[$i]['title'] = $tvshow_episode_exists['title'];
                $output[$i]['overview'] = $tvshow_episode_exists['overview'];
                $output[$i]['first_aired'] = $tvshow_episode_exists['first_aired'];
                $output[$i]['screen'] = base_url() . config_item('image_path_tvepisodes') . $tvshow_episode_exists['screen'];
                $output[$i]['watchedtime'] = $tvshow_episode_exists['watchedtime'];
            }
            else
            {
                $output[$i]['watched'] = FALSE;
                $output[$i]['season'] = $result->season;
                $output[$i]['episode'] = $result->episode;
                $output[$i]['title'] = $result->title;
                $output[$i]['overview'] = $result->overview;
                $output[$i]['first_aired'] = $result->first_aired;
                $output[$i]['screen'] = $result->images->screen;
                $output[$i]['watchedtime'] = FALSE;
            }
        }
    }
    return $output;
}

function format_episode_name ($season, $episode)
{
    if ($season == 0)
    {
        $season = "pecial";
    }
    else
    {
        $season = sprintf("%02s", $season);
    }

    $episode = sprintf("%02s", $episode);

    return 'S' . $season . 'E' . $episode . '';
}

function format_season_name ($season)
{
    if ($season == 0)
    {
        $season = "Special";
    }
    else
    {
        $season = sprintf("%02s", $season);
    }
    return $season;
}

?>