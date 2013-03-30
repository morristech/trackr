<?php

if ( !defined( 'BASEPATH' ) )
    exit( 'No direct script access allowed' );

// --------------------------------------------------------------------------
// Engine Init Class - V1.0
// --------------------------------------------------------------------------

/**
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * THIS SOFTWARE AND DOCUMENTATION IS PROVIDED "AS IS," AND COPYRIGHT
 * HOLDERS MAKE NO REPRESENTATIONS OR WARRANTIES, EXPRESS OR IMPLIED,
 * INCLUDING BUT NOT LIMITED TO, WARRANTIES OF MERCHANTABILITY OR
 * FITNESS FOR ANY PARTICULAR PURPOSE OR THAT THE USE OF THE SOFTWARE
 * OR DOCUMENTATION WILL NOT INFRINGE ANY THIRD PARTY PATENTS,
 * COPYRIGHTS, TRADEMARKS OR OTHER RIGHTS.COPYRIGHT HOLDERS WILL NOT
 * BE LIABLE FOR ANY DIRECT, INDIRECT, SPECIAL OR CONSEQUENTIAL
 * DAMAGES ARISING OUT OF ANY USE OF THE SOFTWARE OR DOCUMENTATION.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://gnu.org/licenses/>.
 */
class Engineinit {

    function Engineinit() {
        $CI = & get_instance();
    }

    /**
     * General site data retrival
     *
     * @access public
     * @return mixed
     */
    function boot_engine() {
        $CI = &get_instance();
        $data['site_name'] = $CI->config->item( 'site_name' );
        $data['base_url'] = $CI->config->item( 'base_url' );
        $data['site_email'] = $CI->config->item( 'site_email' );
        $data['site_version'] = $CI->config->item( 'site_version' );
        log_message( 'info', $data['site_name'] . ' ' . $data['site_version'] . ' Booted.' );
        return $data;
    }

    /**
     * Get User ID from the logged in session.
     *
     * @access private
     * @return string
     */
    function _get_session_uid() {
        $CI = & get_instance();
        $uid = $CI->session->userdata( 'uid' );
        return $uid;
    }

    /**
     * Get Email from the logged in session.
     *
     * @access private
     * @return string
     */
    function _get_session_email() {
        $CI = & get_instance();
        $uid = $CI->session->userdata( 'email' );
        return $uid;
    }

    /**
     * Get Full Name from the logged in session.
     *
     * @access private
     * @return string
     */
    function _get_session_fullname() {
        $CI = & get_instance();
        $uid = $CI->session->userdata( 'fullname' );
        return $uid;
    }

    /**
     * Redirect user if already logged in
     *
     * @access private
     */
    function _is_logged_in_redirect( $redirect_url ) {
        $CI = & get_instance();
        $is_logged_in = $CI->session->userdata( 'user_is_logged_in' );
        if ( $is_logged_in == '1' ) {
            // @todo CI is initialized twice due the redirect, need to verify and fix it.
            redirect( $redirect_url );
        }
    }

    /**
     * Redirect user if user is not logged in
     *
     * @access private
     */
    function _is_not_logged_in_redirect( $redirect_url ) {
        $CI = & get_instance();
        $is_logged_in = $CI->session->userdata( 'user_is_logged_in' );
        if ( $is_logged_in == '0' ) {
            // @todo CI is initialized twice due the redirect, need to verify and fix it.
            redirect( $redirect_url );
        }
    }

    /**
     * Redirect user to error if user is not admin.
     *
     * @access  private
     */
    function _is_not_admin() {
        $CI = & get_instance();
        $uid = $CI->session->userdata( 'uid' );
        if ( $uid != 1 ) {
            show_error( 'Not authorized to view this project.', 401 );
            exit();
        }

    }



}

?>
