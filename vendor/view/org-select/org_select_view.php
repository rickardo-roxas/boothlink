<?php
$pageTitle = "Select Organization";
require('view/page-fragments/Header.php');
?>
<link rel="stylesheet" href="<?php echo BASE_URL?>/vendor/public/css/orgselector.css">
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
                            <img src="<?= htmlspecialchars(BASE_URL . '/shared/assets/images/org/' . $organization['org_img']); ?>"
                                 alt="<?= htmlspecialchars($organization['org_name']); ?>" class="org-image">
                            <span><?= htmlspecialchars($organization['org_name']); ?></span>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</main>
<?php require('view/page-fragments/Footer.php') ?>
