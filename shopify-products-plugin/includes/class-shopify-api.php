<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Shopify_API {

    /**
     * Get an access token from Shopify.
     */
    public function get_access_token() {

        $response = wp_remote_post(
            'https://' . SHOPIFY_SHOP . '.myshopify.com/admin/oauth/access_token',
            array(
                'headers' => array(
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ),
                'body' => array(
                    'grant_type'    => 'client_credentials',
                    'client_id'     => SHOPIFY_CLIENT_ID,
                    'client_secret' => SHOPIFY_CLIENT_SECRET,
                ),
                'timeout' => 30,
            )
        );

        if ( is_wp_error( $response ) ) {
            return $response;
        }

        $body = json_decode(
            wp_remote_retrieve_body( $response ),
            true
        );

        if ( empty( $body['access_token'] ) ) {
            return new WP_Error(
                'shopify_auth_error',
                'Unable to obtain Shopify access token.'
            );
        }

        return $body['access_token'];
    }


    /**
     * Fetch products from Shopify.
     */
    public function get_products( $limit = 50 ) {

        $access_token = $this->get_access_token();

        if ( is_wp_error( $access_token ) ) {
            return $access_token;
        }

        $query = <<<'GRAPHQL'
query GetProducts($first: Int!) {
    products(first: $first) {
        nodes {
            id
            title
            description
            handle
            vendor
            productType
            status
            featuredImage {
                url
                altText
            }
            variants(first: 1) {
                nodes {
                    price
                }
            }
        }
    }
}
GRAPHQL;

        $response = wp_remote_post(
            'https://' . SHOPIFY_SHOP . '.myshopify.com/admin/api/2026-07/graphql.json',
            array(
                'headers' => array(
                    'Content-Type'          => 'application/json',
                    'X-Shopify-Access-Token' => $access_token,
                ),
                'body' => wp_json_encode(
                    array(
                        'query'     => $query,
                        'variables' => array(
                            'first' => $limit,
                        ),
                    )
                ),
                'timeout' => 30,
            )
        );

        if ( is_wp_error( $response ) ) {
            return $response;
        }

        $body = json_decode(
            wp_remote_retrieve_body( $response ),
            true
        );

        if ( ! empty( $body['errors'] ) ) {
            return new WP_Error(
                'shopify_api_error',
                wp_json_encode( $body['errors'] )
            );
        }

        return $body['data']['products']['nodes'] ?? array();
    }
}