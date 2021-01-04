<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/moncompte/adresses' => [[['_route' => 'account_adresse', '_controller' => 'App\\Controller\\AccountAdresseController::index'], null, null, null, false, false, null]],
        '/moncompte/ajouter-adresse' => [[['_route' => 'add_adresse', '_controller' => 'App\\Controller\\AccountAdresseController::add'], null, null, null, false, false, null]],
        '/moncompte' => [[['_route' => 'account', '_controller' => 'App\\Controller\\AccountController::index'], null, null, null, false, false, null]],
        '/compte/mes-commandes' => [[['_route' => 'account_order', '_controller' => 'App\\Controller\\AccountOrderController::index'], null, null, null, false, false, null]],
        '/moncompte/modifier-mon-mot-de-passe' => [[['_route' => 'account_password', '_controller' => 'App\\Controller\\AccountPasswordController::index'], null, null, null, false, false, null]],
        '/admin' => [[['_route' => 'admin', '_controller' => 'App\\Controller\\Admin\\DashboardController::index'], null, null, null, false, false, null]],
        '/mon-panier' => [[['_route' => 'cart', '_controller' => 'App\\Controller\\CartController::index'], null, null, null, false, false, null]],
        '/cart/remove' => [[['_route' => 'remove_my_cart', '_controller' => 'App\\Controller\\CartController::remove'], null, null, null, false, false, null]],
        '/' => [[['_route' => 'home', '_controller' => 'App\\Controller\\HomeController::index'], null, null, null, false, false, null]],
        '/commande' => [[['_route' => 'order', '_controller' => 'App\\Controller\\OrderController::index'], null, null, null, false, false, null]],
        '/commande/recapitulatif' => [[['_route' => 'order_recap', '_controller' => 'App\\Controller\\OrderController::add'], null, ['POST' => 0], null, false, false, null]],
        '/nos-produits' => [[['_route' => 'products', '_controller' => 'App\\Controller\\ProductController::index'], null, null, null, false, false, null]],
        '/inscription' => [[['_route' => 'registrer', '_controller' => 'App\\Controller\\RegistrerController::index'], null, null, null, false, false, null]],
        '/mot-de-passe-oublie' => [[['_route' => 'reset_password', '_controller' => 'App\\Controller\\ResetPasswordController::index'], null, null, null, false, false, null]],
        '/connexion' => [[['_route' => 'app_login', '_controller' => 'App\\Controller\\SecurityController::login'], null, null, null, false, false, null]],
        '/deconnexion' => [[['_route' => 'app_logout', '_controller' => 'App\\Controller\\SecurityController::logout'], null, null, null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/mo(?'
                    .'|ncompte/(?'
                        .'|modifier\\-adresse/([^/]++)(*:50)'
                        .'|effacer\\-adresse/([^/]++)(*:82)'
                    .')'
                    .'|difier\\-mot\\-de\\-passe/([^/]++)(*:121)'
                .')'
                .'|/c(?'
                    .'|om(?'
                        .'|pte/mes\\-commandes/([^/]++)(*:167)'
                        .'|mande/(?'
                            .'|erreur/([^/]++)(*:199)'
                            .'|merci/([^/]++)(*:221)'
                            .'|create\\-session/([^/]++)(*:253)'
                        .')'
                    .')'
                    .'|art/(?'
                        .'|add/([^/]++)(*:282)'
                        .'|delete/([^/]++)(*:305)'
                        .'|reduce/([^/]++)(*:328)'
                    .')'
                .')'
                .'|/produit/([^/]++)(*:355)'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        50 => [[['_route' => 'edit_adresse', '_controller' => 'App\\Controller\\AccountAdresseController::edit'], ['id'], null, null, false, true, null]],
        82 => [[['_route' => 'delete_adresse', '_controller' => 'App\\Controller\\AccountAdresseController::delete'], ['id'], null, null, false, true, null]],
        121 => [[['_route' => 'update_password', '_controller' => 'App\\Controller\\ResetPasswordController::update'], ['token'], null, null, false, true, null]],
        167 => [[['_route' => 'account_order_show', '_controller' => 'App\\Controller\\AccountOrderController::show'], ['reference'], null, null, false, true, null]],
        199 => [[['_route' => 'order_cancel', '_controller' => 'App\\Controller\\OrderCancelController::index'], ['stripeSessionId'], null, null, false, true, null]],
        221 => [[['_route' => 'order_validate', '_controller' => 'App\\Controller\\OrderSuccessController::index'], ['stripeSessionId'], null, null, false, true, null]],
        253 => [[['_route' => 'stripe_create_session', '_controller' => 'App\\Controller\\StripeController::index'], ['reference'], null, null, false, true, null]],
        282 => [[['_route' => 'add_to_cart', '_controller' => 'App\\Controller\\CartController::add'], ['id'], null, null, false, true, null]],
        305 => [[['_route' => 'delete_to_cart', '_controller' => 'App\\Controller\\CartController::delete'], ['id'], null, null, false, true, null]],
        328 => [[['_route' => 'reduce_to_cart', '_controller' => 'App\\Controller\\CartController::reduce'], ['id'], null, null, false, true, null]],
        355 => [
            [['_route' => 'product', '_controller' => 'App\\Controller\\ProductController::show'], ['slug'], null, null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
