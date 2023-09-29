<?php include_once 'templates/header.php' ?>
<header class="header">
    <div class="container">
        <div class="header-hero">
            <h1>Welcome to WhatsApp Security Awareness</h1>
            <p>WhatsApp Security Awareness is a website that aims to educate and empower WhatsApp users to protect themselves against social engineering attacks.</p>
            <div class=" ">
                <button class="btn btn-primary btn-">Learn More</button>
                <button class="btn btn-primary btn-outline">Register</button>
            </div>
        </div>
    </div>
</header>
<section class="section" id="">
    <div class="container">
        <div class="text-center section_full ">
            <div class="">
                <h2 class="text-secondary text-2xl">About WhatsApp</h2>
            </div>
            <div class="">
                <p class=" text-xl ">
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quibusdam libero distinctio, ducimus facere minima saepe debitis asperiores dolores! Eos, numquam. Nam odio ex rerum tempora nisi architecto excepturi officia quod.
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Iste id libero eaque itaque expedita vero beatae. Quos voluptate, repellendus quae rerum, in corporis quisquam vero doloremque voluptatum aspernatur aliquid ratione.
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ducimus accusantium iste iusto culpa dignissimos cupiditate tempora, corporis, aspernatur quibusdam optio eveniet ut, odit obcaecati nemo explicabo? Ullam accusantium animi id.
                </p>
            </div>
        </div>
    </div>
</section>



<section class="section" id="">
    <div class="container">
        <div class="section_full ">
            <div class="">
                <h2 class="text-secondary text-2xl">components </h2>
            </div>

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
                    <a href="components.php?components_id=' . $id . '" class="navbar_menu-btn navbar_menu-btn-default">Go too </a>
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
</section>
<?php include_once 'templates/footer.php' ?>