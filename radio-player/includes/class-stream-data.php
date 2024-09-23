<?php

defined( 'ABSPATH' ) || exit;
class Radio_Player_Stream_Data {
    private static $instance = null;

    private $url;

    public function __construct( $url ) {
        $this->url = $url;
    }

    public function get_stream_data() {
        $stream_type = $this->get_stream_type();
        $stream_data = [];
        // Try Shoutcast
        if ( 'shoutcast' == $stream_type ) {
            $sid = 1;
            if ( preg_match( '/stream\\/(\\d+)/', $this->url, $match ) ) {
                $sid = $match[1];
            }
            $shoutcast_url = apply_filters( 'radio_player/shoutcast_metadata_url', $this->get_shoutcast_base_url() . "/currentsong?sid={$sid}" );
            $title = $this->get_remote_response( $shoutcast_url );
            if ( !empty( $title ) ) {
                $stream_data['title'] = $title;
            }
        } elseif ( 'icecast' == $stream_type ) {
            // Try Icecast
            if ( empty( $title ) ) {
                $icecast_url = apply_filters( 'radio_player/icecast_metadata_url', $this->get_icecast_base_url() . '/status-json.xsl' );
                $meta = $this->fetch_and_decode( $icecast_url );
                if ( !empty( $meta ) ) {
                    $source = $meta['icestats']['source'];
                    if ( empty( $source[0] ) ) {
                        $stream_data['title'] = $source['title'];
                    } else {
                        $source_item = array_filter( $source, function ( $item ) {
                            return strpos( $item['listenurl'], $this->url ) !== false;
                        } );
                        if ( !empty( $source_item ) ) {
                            $stream_data['title'] = reset( $source_item )['title'];
                        } else {
                            $source_item = array_filter( $source, function ( $item ) {
                                return !empty( $item['title'] );
                            } );
                            if ( !empty( $source_item ) ) {
                                $stream_data['title'] = reset( $source_item )['title'];
                            }
                        }
                    }
                }
            }
        } elseif ( 'live365' == $stream_type ) {
            // Try Live365
            if ( !empty( $this->get_live_365_id() ) ) {
                $live365_url = apply_filters( 'radio_player/live365_metadata_url', 'https://live365.com/station/' . $this->get_live_365_id() );
                $response = $this->get_remote_response( $live365_url );
                if ( $response ) {
                    $dom = new DOMDocument();
                    @$dom->loadHTML( $response );
                    $xpath = new DOMXPath($dom);
                    $title_element = $xpath->query( '//p[@class="MuiTypography-root MuiTypography-body1 mui-style-1iobe0l"]' );
                    $artwork_element = $xpath->query( '//img[@class="MuiBox-root mui-style-3rwnws"]/@src' );
                    $artist_element = $xpath->query( '//p[@class="MuiTypography-root MuiTypography-body1 mui-style-1x0uvdd"]' );
                    if ( $title_element->length > 0 ) {
                        $stream_data['title'] = $title_element->item( 0 )->nodeValue;
                    }
                    if ( $artwork_element->length > 0 ) {
                        $stream_data['art'] = $artwork_element->item( 0 )->nodeValue;
                    }
                    if ( $artist_element->length > 0 ) {
                        $stream_data['artist'] = $artist_element->item( 0 )->nodeValue;
                    }
                }
            }
        }
        // Try to get title from URL
        if ( empty( $stream_data['title'] ) ) {
            if ( function_exists( 'rpp_fs' ) && rpp_fs()->can_use_premium_code__premium_only() && radio_player_get_setting( 'metadataProxy', false ) ) {
                $meta_data_url = apply_filters( 'radio_player/meta_data_url', $this->url, 'title' );
                $meta_data = $this->get_remote_response( $meta_data_url );
                if ( !empty( $meta_data ) ) {
                    $stream_data = json_decode( $meta_data, true );
                }
            } else {
                $stream_data['title'] = $this->fetch_stream_title( $this->url );
            }
        }
        if ( !empty( $stream_data['title'] ) && strlen( $stream_data['title'] ) > 3 && empty( $stream_data['art'] ) ) {
        }
        return $stream_data;
    }

    public function fetch_stream_title( $stream_url ) {
        $result = '';
        if ( empty( $stream_url ) ) {
            return $result;
        }
        $icy_metaint = -1;
        $needle = 'StreamTitle=';
        $ua = 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/27.0.1453.110 Safari/537.36';
        $opts = array(
            'http' => array(
                'method'     => 'GET',
                'header'     => 'Icy-MetaData: 1',
                'user_agent' => $ua,
            ),
            "ssl"  => array(
                'allow_self_signed' => true,
                "verify_peer"       => false,
                "verify_peer_name"  => false,
            ),
        );
        $default = stream_context_set_default( $opts );
        if ( !($stream = @fopen( $stream_url, 'r' )) ) {
            return $result;
        }
        if ( $stream && ($meta_data = stream_get_meta_data( $stream )) && isset( $meta_data['wrapper_data'] ) ) {
            foreach ( $meta_data['wrapper_data'] as $header ) {
                if ( strpos( strtolower( $header ), 'icy-metaint' ) !== false ) {
                    $tmp = explode( ":", $header );
                    $icy_metaint = trim( $tmp[1] );
                    break;
                }
            }
            if ( $icy_metaint != -1 ) {
                $buffer = stream_get_contents( $stream, 300, $icy_metaint );
                if ( strpos( $buffer, $needle ) !== false ) {
                    $title = explode( $needle, $buffer );
                    $title = trim( $title[1] );
                    if ( $title !== '' ) {
                        $result = substr( $title, 1, strpos( $title, ';' ) - 2 );
                    }
                }
            }
            if ( $stream ) {
                fclose( $stream );
            }
        }
        return $result;
    }

    public function fetch_and_decode( $url ) {
        $response = $this->get_remote_response( $url );
        if ( $response ) {
            return json_decode( $response, 1 );
        }
        return null;
    }

    public function get_remote_response( $url ) {
        $response = wp_remote_get( $url );
        if ( !is_wp_error( $response ) && wp_remote_retrieve_response_code( $response ) == 200 ) {
            return wp_remote_retrieve_body( $response );
        }
        return false;
    }

    public function get_stream_type() {
        $urls = (array) get_transient( 'radio_player_stream_urls' );
        if ( !isset( $urls[$this->url] ) ) {
            if ( $this->is_shoutcast_url() ) {
                $type = 'shoutcast';
            } elseif ( $this->is_icecast_url() ) {
                $type = 'icecast';
            } elseif ( $this->is_live365_url() ) {
                $type = 'live365';
            } else {
                $type = 'unknown';
            }
            $urls[$this->url] = $type;
            set_transient( 'radio_player_stream_urls', $urls, 7 * DAY_IN_SECONDS );
        }
        return $urls[$this->url];
    }

    public function is_shoutcast_url() {
        $headers = get_headers( $this->url );
        if ( !empty( $headers ) ) {
            foreach ( $headers as $header ) {
                if ( strpos( strtolower( $header ), 'shoutcast' ) !== false ) {
                    return true;
                }
            }
        }
        return false;
    }

    public function get_shoutcast_base_url() {
        // Extract scheme, domain, and port
        if ( preg_match( '/^(https?:\\/\\/[^\\/:]+)(?::(\\d+))?/', $this->url, $matches ) ) {
            $base_url = $matches[1];
            if ( isset( $matches[2] ) ) {
                // If port exists
                $base_url .= ':' . $matches[2];
            } else {
                // If no port is provided in the URL, but the path starts with "/radio", we assume port 8000 by default
                if ( strpos( $this->url, '/radio' ) !== false ) {
                    $base_url .= ':8000';
                }
            }
            return $base_url;
        }
        return false;
    }

    public function is_icecast_url() {
        $headers = get_headers( $this->url );
        if ( !empty( $headers ) ) {
            foreach ( $headers as $header ) {
                if ( strpos( strtolower( $header ), 'ice-audio-info' ) !== false ) {
                    return true;
                }
            }
        }
        return false;
    }

    function get_icecast_base_url() {
        $parsed_url = parse_url( $this->url );
        $base_url = $parsed_url['scheme'] . '://' . $parsed_url['host'];
        if ( isset( $parsed_url['port'] ) ) {
            $base_url .= ':' . $parsed_url['port'];
        }
        return $base_url;
    }

    public function is_live365_url() {
        $headers = get_headers( $this->url, 1 );
        if ( isset( $headers['Server'] ) && is_string( $headers['Server'] ) ) {
            if ( strpos( $headers['Server'], 'Live365' ) !== false ) {
                return true;
            }
        }
        return false;
    }

    function get_live_365_id() {
        preg_match( '/\\/(a[\\w\\d]+)(\\?|$)/', $this->url, $matches );
        return $matches[1] ?? null;
    }

    public static function instance( $url ) {
        if ( null === self::$instance ) {
            self::$instance = new self($url);
        }
        return self::$instance;
    }

}
