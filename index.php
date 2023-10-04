<?php include_once 'templates/header.php' ?>
<header class="header">
    <div class="container">
        <div class="header-hero">
            <h1 class="text-bg ">Welcome to the WhatsApp Security Awareness Framework</h1>
            <p class="text-bg text-xl">Enabling You to Protect Your Digital World</p>
            <div class=" ">
                <a href="#about" class="btn btn-primary btn-">Learn More</a>
                <a href="register.php" class="btn btn-primary btn-outline">Register</a>
            </div>
        </div>
    </div>
</header>
<section class="section" id="about">
    <div class="container">
        <div class="text-center section_full ">
            <div class="">
                <h2 class="text-secondary text-2xl">About!</h2>
            </div>
            <div class="">
                <div class="">
                    <p class=" text-xl text-justify ">
                        In an age where connectivity and communication flourish online, protecting your digital presence has never been more vital. Welcome to the WhatsApp Security Awareness Framework, an initiative designed to enable users with the knowledge and skills needed to protect themselves against evolving cybersecurity threats, particularly social engineering attacks.
                    </p>
                    <p class=" text-xl " style=" margin-block:2rem;">Our framework is a comprehensive resource that provides you with three key components of defence.</p>
                </div>
                <div class="">
                    <img src="assets/frm.png" alt="" class="">
                </div>

            </div>
        </div>
    </div>
</section>



<section class="section" id="">
    <div class="container">
        <div class="section_full ">
            <div class="">
                <h2 class="text-secondary text-2xl">Framework Components </h2>
            </div>
            <div class="section_grid">
                <?php
                $result = mysqli_query($conn, "SELECT * FROM components");

                // Check if there are any components
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = $row["id"];
                        $name = $row["name"];
                        $description = $row["description"];
                        // Output the HTML structure with dynamic component data
                        echo '

            <div class="section_card">
                <div class=" section_card-item  bg-secondary">
                    <h3 class="">' . $name . '</h3>
                </div>
                <div class=" section_card-item bg-primary">
                    <p class="">' . $description . '</p>
                    <a href="components.php?components_id=' . $id . '" class="navbar_menu-btn navbar_menu-btn-default">More Details </a>
                </div>
            </div>';
                    }
                } else {
                    echo "No components found.";
                }

                // Close the MySQL connection
                mysqli_close($conn);
                ?>
            </div>

        </div>
        <div class="section_full">
            <p class=" text-xl text-justify " style=" margin-block:2rem;">
                By engaging with our framework, you will acquire the tools and insights necessary to navigate the digital landscape with confidence. Remember, cybersecurity is a shared responsibility, and together, we can create a safer WhatsApp community.
            </p>
            <p class=" text-xl text-center " style=" margin-block:1rem;">
                Stay informed, stay vigilant, and stay secure.
            </p>
        </div>
    </div>
</section>
<?php include_once 'templates/footer.php' ?>