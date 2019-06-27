<?php

if ( ! is_user_logged_in() ) {
	wp_redirect( wp_login_url() );
	exit;
}

$ref_link = home_url() . '/?st_ref=' . $user_ID;

global $wpdb;

$table_name = ST_REFERRALS;
$ref_count  = $wpdb->get_var( "SELECT COUNT(id) FROM $table_name WHERE ref_user_id = $user_ID" );

if ( $ref_count == null or empty( $ref_count ) ) {
	$ref_count = 0;
}

$ref_list = $wpdb->get_results( "SELECT * FROM $table_name WHERE ref_user_id = $user_ID" );


?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>

    <link rel="stylesheet" href="<?= plugins_url( 'steeply-ref/public/css/steeply-ref-dashboard.css' ); ?>">

    <title>Referral Dashboard - <?= get_bloginfo(); ?></title>
</head>
<body>

<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="/">Referral Dashboard</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsDashboardDefault"
            aria-controls="navbarsDashboardDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsDashboardDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="/">Back to Site</a>
            </li>
        </ul>
    </div>
</nav>

<main role="main" class="container">

    <div class="row">

        <div class="col-md-5">
            <div class="std-widget">

                <h5>Your referral link</h5>

                <p style="font-size: 100px; color: #343a40; text-align: center; margin-bottom: 2rem;">
                    <i class="far fa-smile-wink"></i>
                </p>

                <div class="input-group">
                    <input readonly type="text" class="form-control std-ref-input" value="<?= $ref_link; ?>"
                           aria-label="Your referral link" aria-describedby="btn-copy">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="button" id="btn-copy">Copy</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <a class="std-share btn-primary" href="#">Share with Telegram</a>
            <a class="std-share btn-primary" href="#">Share with Facebook</a>
            <a class="std-share btn-primary" href="#">Share with LinkedIn</a>
            <a class="std-share btn-primary" href="#">Share with Twitter</a>
            <a class="std-share btn-primary" href="#">Share with Pinterest</a>
        </div>

        <div class="col-md-4">
            <div class="std-widget">
                <h5>Your referral team</h5>

                <p style="font-size: 100px; color: #343a40; text-align: center; margin-bottom: 2rem; font-weight: 600;">
					<?= $ref_count; ?>
                </p>
            </div>
        </div>

    </div>

    <div class="row mt-4">

        <div class="col-md-12">

            <div class="mb-4">
                <h4>Referrals List</h4>
            </div>

            <div style="overflow-x:auto; overflow-y: hidden;">
                <table class="std-table">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
					<?php if ( ! empty( $ref_list ) ) { ?>
						<?php foreach ( $ref_list as $item ) {
							$user_data = get_userdata( $item->user_id ); ?>
                            <tr>
                                <td><?= $item->id; ?></td>
                                <td><?= $user_data->display_name; ?></td>
                                <td><?= $user_data->user_email; ?></td>
                                <td><?= $item->date; ?></td>
                                <td>-</td>
                            </tr>
						<?php } ?>
					<?php } else { ?>
                        <tr>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                            <td>-</td>
                        </tr>
					<?php } ?>
                </table>
            </div>
        </div>

    </div>

</main><!-- /.container -->

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/3d21067913.js"></script>

<script src="<?= plugins_url( 'steeply-ref/public/js/steeply-ref-dashboard.js' ); ?>"
</body>
</html>