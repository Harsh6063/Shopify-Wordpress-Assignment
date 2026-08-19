<?php get_header(); ?>

<main>

<?php

$hero_image = get_theme_mod( 'nexora_hero_image' );

$hero_style = '';

if ( ! empty( $hero_image ) ) {

    $hero_style = "
        background-image:
        linear-gradient(
            90deg,
            rgba(4, 15, 30, .98) 0%,
            rgba(4, 15, 30, .92) 40%,
            rgba(4, 15, 30, .35) 70%,
            rgba(4, 15, 30, .10) 100%
        ),
        url('" . esc_url( $hero_image ) . "');
    ";
}

?>

<!-- HERO -->
<section
    class="hero"
    id="home"
    style="<?php echo esc_attr( $hero_style ); ?>"
>

    <div class="hero-overlay"></div>

    <div class="container">

        <!-- HEADER -->
        <header class="site-header">

            <a
                href="<?php echo esc_url( home_url( '/' ) ); ?>"
                class="logo"
            >
                <span class="logo-icon">N</span>
                <span>NEXORA</span>
            </a>


            <!-- DESKTOP MENU -->
            <nav class="desktop-nav">

                <a href="#home">Home</a>
                <a href="#about">About</a>
                <a href="#services">Services</a>
                <a href="#portfolio">Portfolio</a>
                <a href="#blog">Blog</a>
                <a href="#contact">Contact</a>

            </nav>


            <!-- DESKTOP ACTIONS -->
            <div class="header-actions">

                <span
                    class="theme-icon"
                    aria-hidden="true"
                >
                    ☼
                </span>

                <a
                    href="#contact"
                    class="btn btn-small"
                    aria-label="Get a quote from Nexora"
                >
                    Get a Quote
                </a>

            </div>


            <!-- MOBILE BUTTON -->
            <button
                class="mobile-menu-toggle"
                aria-label="Open menu"
                aria-expanded="false"
                aria-controls="mobile-navigation"
            >

                <span class="menu-open">☰</span>

                <span class="menu-close">×</span>

            </button>

        </header>


        <!-- MOBILE MENU -->
        <nav
            class="mobile-nav"
            id="mobile-navigation"
        >

            <a href="#home">Home</a>
            <a href="#about">About</a>
            <a href="#services">Services</a>
            <a href="#portfolio">Portfolio</a>
            <a href="#blog">Blog</a>
            <a href="#contact">Contact</a>

        </nav>


        <!-- HERO CONTENT -->
        <div class="hero-content">

            <p class="eyebrow">
                DIGITAL SOLUTIONS FOR GROWTH
            </p>


            <!-- EDITABLE HERO TITLE -->
            <h1>

                <?php

                echo esc_html(
                    get_theme_mod(
                        'hero_title',
                        'Building Digital Experiences That Drive Results'
                    )
                );

                ?>

            </h1>


            <!-- EDITABLE HERO DESCRIPTION -->
            <p class="hero-description">

                <?php

                echo esc_html(
                    get_theme_mod(
                        'hero_description',
                        'We help businesses grow with innovative digital solutions, strategic vision, and powerful execution.'
                    )
                );

                ?>

            </p>


            <!-- HERO BUTTONS -->
            <div class="hero-buttons">

                <a
                    href="#services"
                    class="btn"
                >
                    Our Services →
                </a>


                <a
                    href="#portfolio"
                    class="btn btn-outline"
                >
                    View Portfolio →
                </a>

            </div>

        </div>


       <!-- HERO STATS -->
<div class="hero-stats">

    <?php
    $default_stats = array(
        array( 'fa-award', '10+', 'Years Experience' ),
        array( 'fa-folder-open', '200+', 'Projects Completed' ),
        array( 'fa-users', '50+', 'Happy Clients' ),
        array( 'fa-headset', '24/7', 'Support Available' ),
    );

    for ( $i = 1; $i <= 4; $i++ ) :
        $default = $default_stats[ $i - 1 ];
    ?>

        <div>

            <i
                class="fa-solid <?php echo esc_attr(
                    get_theme_mod(
                        'hero_stat_' . $i . '_icon',
                        $default[0]
                    )
                ); ?>"
                aria-hidden="true"
            ></i>

            <div class="stat-text">

                <strong>
                    <?php echo esc_html(
                        get_theme_mod(
                            'hero_stat_' . $i . '_number',
                            $default[1]
                        )
                    ); ?>
                </strong>

                <span>
                    <?php echo esc_html(
                        get_theme_mod(
                            'hero_stat_' . $i . '_label',
                            $default[2]
                        )
                    ); ?>
                </span>

            </div>

        </div>

    <?php endfor; ?>

</div>

    </div>

</section>


<!-- FEATURES -->
<section class="features">

    <div class="container">

        <div class="feature-grid">

            <?php
            $default_features = array(
                array(
                    'fa-lightbulb',
                    'Custom Solutions',
                    'Tailored solutions designed to meet your unique business requirements.'
                ),
                array(
                    'fa-gem',
                    'Modern Design',
                    'Stunning, user-friendly designs that create lasting impressions.'
                ),
                array(
                    'fa-gear',
                    'Latest Technology',
                    'We utilize cutting-edge technologies to build scalable solutions.'
                ),
                array(
                    'fa-headset',
                    'Dedicated Support',
                    'Our team is always here to support you every step of the way.'
                ),
            );

            for ( $i = 1; $i <= 4; $i++ ) :
                $feature = $default_features[ $i - 1 ];
            ?>

                <div class="feature-card">

                    <div class="feature-icon">

                        <i
                            class="fa-solid <?php echo esc_attr(
                                get_theme_mod(
                                    'feature_' . $i . '_icon',
                                    $feature[0]
                                )
                            ); ?>"
                            aria-hidden="true"
                        ></i>

                    </div>

                    <div>

                        <h3>
                            <?php echo esc_html(
                                get_theme_mod(
                                    'feature_' . $i . '_title',
                                    $feature[1]
                                )
                            ); ?>
                        </h3>

                        <p>
                            <?php echo esc_html(
                                get_theme_mod(
                                    'feature_' . $i . '_description',
                                    $feature[2]
                                )
                            ); ?>
                        </p>

                    </div>

                </div>

            <?php endfor; ?>

        </div>

    </div>

</section>


<!-- SERVICES -->
<section class="services section" id="services">

    <div class="container">

        <div class="section-heading">

           <span>
    <?php echo esc_html(
        get_theme_mod(
            'services_eyebrow',
            'OUR SERVICES'
        )
    ); ?>
</span>

<h2>
    <?php echo esc_html(
        get_theme_mod(
            'services_title',
            'What We Do'
        )
    ); ?>
</h2>

<p>
    <?php echo esc_html(
        get_theme_mod(
            'services_description',
            'We provide end-to-end digital solutions to help your business grow and thrive in the digital world.'
        )
    ); ?>
</p>

        </div>

        <div class="service-grid">

           <?php

$default_services = array(
    array(
        '⌨',
        'Web Development',
        'Custom websites and web applications for exceptional performance and scalability.'
    ),
    array(
        '▣',
        'E-commerce Solutions',
        'Powerful online stores designed to maximize customer experience.'
    ),
    array(
        '◈',
        'UI/UX Design',
        'Beautiful intuitive user experiences with engagement and satisfaction.'
    ),
    array(
        '↗',
        'Digital Marketing',
        'Data-driven marketing strategies that deliver measurable results.'
    ),
    array(
        '▰',
        'Brand Identity',
        'Shape your brand identity and stand out from the competition.'
    ),
    array(
        '◇',
        'SEO Optimization',
        'Improve your search rankings and generate traffic to your website.'
    ),
);

for ( $i = 1; $i <= 6; $i++ ) :

    $service = $default_services[ $i - 1 ];

?>

    <article class="service-card">

        <div class="service-icon">

            <?php echo esc_html(
                get_theme_mod(
                    'service_' . $i . '_icon',
                    $service[0]
                )
            ); ?>

        </div>

        <h3>

            <?php echo esc_html(
                get_theme_mod(
                    'service_' . $i . '_title',
                    $service[1]
                )
            ); ?>

        </h3>

        <p>

            <?php echo esc_html(
                get_theme_mod(
                    'service_' . $i . '_description',
                    $service[2]
                )
            ); ?>

        </p>

    </article>

<?php endfor; ?>
        </div>

    </div>

</section>


<!-- STATISTICS -->
<section class="statistics">

    <div class="container">

        <div class="stats-grid">

            <div class="stat-item">
                <strong
                    class="counter"
                    data-target="<?php echo esc_attr( get_theme_mod( 'stat_1_number', '10' ) ); ?>"
                >
                    0
                </strong>

               
                <span>
                    <?php
                    echo esc_html(
                        get_theme_mod(
                            'stat_1_label',
                            'Years Experience'
                        )
                    );
                    ?>
                </span>
            </div>


            <div class="stat-item">
                <strong
                    class="counter"
                    data-target="<?php echo esc_attr( get_theme_mod( 'stat_2_number', '200' ) ); ?>"
                >
                    0
                </strong>

               
                <span>
                    <?php
                    echo esc_html(
                        get_theme_mod(
                            'stat_2_label',
                            'Projects Completed'
                        )
                    );
                    ?>
                </span>
            </div>


            <div class="stat-item">
                <strong
                    class="counter"
                    data-target="<?php echo esc_attr( get_theme_mod( 'stat_3_number', '50' ) ); ?>"
                >
                    0
                </strong>

               

                <span>
                    <?php
                    echo esc_html(
                        get_theme_mod(
                            'stat_3_label',
                            'Happy Clients'
                        )
                    );
                    ?>
                </span>
            </div>


            <div class="stat-item">
                <strong
                    class="counter"
                    data-target="<?php echo esc_attr( get_theme_mod( 'stat_4_number', '15' ) ); ?>"
                >
                    0
                </strong>

            

                <span>
                    <?php
                    echo esc_html(
                        get_theme_mod(
                            'stat_4_label',
                            'Team Members'
                        )
                    );
                    ?>
                </span>
            </div>


            <div class="stat-item special-stat">
                <strong>
                    <?php
                    echo esc_html(
                        get_theme_mod(
                            'stat_5_number',
                            '24/7'
                        )
                    );
                    ?>
                </strong>

                <span>
                    <?php
                    echo esc_html(
                        get_theme_mod(
                            'stat_5_label',
                            'Support Available'
                        )
                    );
                    ?>
                </span>
            </div>

        </div>

    </div>

</section>
<!-- TESTIMONIALS -->
<section class="testimonials section">

    <div class="container">

        <div class="section-heading">

            <span>TESTIMONIALS</span>

            <h2>What Our Clients Say</h2>

        </div>

        <div class="testimonial-grid">

            <?php
            $testimonials = array(
                array( '★★★★★', 'There is a notable attention to detail and professional work. The team is responsive, creative, and delivers exceptional results.', 'James Carter', 'CEO, TechBridge' ),
                array( '★★★★★', 'Highly recommended! They understood our needs perfectly and delivered a solution that exceeded our expectations.', 'Sarah Mitchell', 'Marketing Director, GreenHub' ),
                array( '★★★★★', 'Excellent communication, on-time delivery, and outstanding support. We are very happy with the results!', 'David Anderson', 'Founder, NextDay' ),
            );

            foreach ( $testimonials as $testimonial ) :
            ?>

                <article class="testimonial-card">

                    <div class="stars">
                        <?php echo esc_html( $testimonial[0] ); ?>
                    </div>

                    <p>
                        "<?php echo esc_html( $testimonial[1] ); ?>"
                    </p>

                    <div class="client">

                        <div class="avatar">
                            <?php echo esc_html( substr( $testimonial[2], 0, 1 ) ); ?>
                        </div>

                        <div>
                            <strong><?php echo esc_html( $testimonial[2] ); ?></strong>
                            <span><?php echo esc_html( $testimonial[3] ); ?></span>
                        </div>

                    </div>

                </article>

            <?php endforeach; ?>

        </div>

    </div>

</section>


<!-- ARTICLES -->
<section class="section articles" id="blog">

    <div class="container">

        <div class="section-heading">

            <span>LATEST INSIGHTS</span>

            <h2>Latest Articles</h2>

            <p>
                Explore insights, strategies, and ideas to help your business grow.
            </p>

        </div>


        <div class="article-grid">

            <?php

            $nexora_articles = new WP_Query(
                array(
                    'post_type'      => 'post',
                    'posts_per_page' => 3,
                    'post_status'    => 'publish',
                )
            );

            if ( $nexora_articles->have_posts() ) :

                while ( $nexora_articles->have_posts() ) :

                    $nexora_articles->the_post();

            ?>

                <article <?php post_class( 'article-card' ); ?>>

                    <?php if ( has_post_thumbnail() ) : ?>

                        <a
                            href="<?php the_permalink(); ?>"
                            class="article-image"
                            aria-label="<?php echo esc_attr( get_the_title() ); ?>"
                        >

                            <?php

                            the_post_thumbnail(
                                'nexora-article',
                                array(
                                    'loading' => 'lazy',
                                    'alt'     => esc_attr(
                                        get_the_title()
                                    ),
                                )
                            );

                            ?>

                        </a>

                    <?php endif; ?>


                    <div class="article-content">

                        <?php

                        $categories = get_the_category();

                        if ( ! empty( $categories ) ) :

                        ?>

                            <span class="article-category">

                                <?php
                                echo esc_html(
                                    $categories[0]->name
                                );
                                ?>

                            </span>

                        <?php endif; ?>


                        <h3>

                            <a href="<?php the_permalink(); ?>">

                                <?php the_title(); ?>

                            </a>

                        </h3>


                        <p>

                            <?php

                            echo esc_html(
                                wp_trim_words(
                                    get_the_excerpt(),
                                    18,
                                    '...'
                                )
                            );

                            ?>

                        </p>


                        <div class="article-bottom">

                            <span class="article-date">

                                <i
                                    class="fa-regular fa-calendar"
                                    aria-hidden="true"
                                ></i>

                                <?php
                                echo esc_html(
                                    get_the_date( 'F j, Y' )
                                );
                                ?>

                            </span>


                            <a
                                href="<?php the_permalink(); ?>"
                                class="article-read-more"
                            >

                                Read More →

                            </a>

                        </div>

                    </div>

                </article>

            <?php

                endwhile;

                wp_reset_postdata();

            else :

            ?>

                <p>No articles found.</p>

            <?php endif; ?>

        </div>


        <div class="center-button">

            <a
                href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>"
                class="btn"
            >

                View All Articles →

            </a>

        </div>

    </div>

</section>
<!-- FOOTER -->
<footer class="site-footer" id="contact">

    <div class="container footer-grid">

        <!-- NEWSLETTER -->
        <div class="newsletter">

            <h3>Subscribe to Our Newsletter</h3>

            <p>
                Get the latest updates, insights, and offers delivered straight to your inbox.
            </p>

            <form>
                <input
                    type="email"
                    placeholder="Your email address"
                    aria-label="Email address"
                >

                <button type="submit">
                    Subscribe
                </button>
            </form>

        </div>


        <!-- QUICK LINKS -->
        <div class="footer-column">

            <h4>Quick Links</h4>

            <a href="#home">Home</a>
            <a href="#about">About Us</a>
            <a href="#services">Services</a>
            <a href="#portfolio">Portfolio</a>
            <a href="#blog">Blog</a>
            <a href="#contact">Contact</a>

        </div>


        <!-- SERVICES -->
        <div class="footer-column">

            <h4>Our Services</h4>

            <a href="#">Web Development</a>
            <a href="#">E-commerce Solutions</a>
            <a href="#">UI/UX Design</a>
            <a href="#">Digital Marketing</a>
            <a href="#">Brand Identity</a>

        </div>


        <!-- CONTACT -->
        <div class="footer-column contact-info">

            <h4>Contact Info</h4>

            <p>📍 123 Innovation Street<br>New York, NY 10001</p>

            <p>📞 +1 (555) 123-4567</p>

            <p>✉ info@nexora.com</p>

        </div>


        <!-- FOLLOW US -->
        <div class="footer-column follow-us">

            <h4>Follow Us</h4>

            <div class="social-links">

                <a href="#" aria-label="Facebook">
                    <i class="fa-brands fa-facebook-f"></i>
                </a>

                <a href="#" aria-label="Twitter">
                    <i class="fa-brands fa-x-twitter"></i>
                </a>

                <a href="#" aria-label="LinkedIn">
                    <i class="fa-brands fa-linkedin-in"></i>
                </a>

                <a href="#" aria-label="Instagram">
                    <i class="fa-brands fa-instagram"></i>
                </a>

            </div>

        </div>

    </div>


    <!-- FOOTER BOTTOM -->
    <div class="footer-bottom">

        <div class="container">

            <span>© 2024 Nexora. All rights reserved.</span>

            <div class="footer-legal">
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
                <a href="#">Cookie Policy</a>
            </div>

        </div>

    </div>

</footer>

</main>

<?php get_footer(); ?>