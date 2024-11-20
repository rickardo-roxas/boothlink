<?php
$pageTitle = "Select Organization";
require ('vendor/view/page-fragments/Header.php');
?>
<link rel="stylesheet" href="<?php echo BASE_URL?>/public/css/vendor/orgselector.css">
<main>
    <div id="salesboard" class="container">
        <div class="grid-container">
            <div class="logo-tagline">
                <div id="logo" class="website-logo">
                    <h1>booth<span style="color:#1EBDEF">link</span></h1>
                </div>

                <div class="tagline">
                    <div class="tagline-paragraph">
                        <p>Organization Selector</p>
                    </div>
                </div>
            </div>

            <div class="org-selector">
                <div class="org-container" id="button-container">
                    <?php foreach ($organizations as $organization): ?>
                        <a href="/cs-312_boothlink/select_org?org_id=<?= htmlspecialchars($organization['org_id']); ?>" class="button">
                            <?= htmlspecialchars($organization['org_name']); ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</main>
<?php require ('vendor/view/page-fragments/Footer.php') ?>
