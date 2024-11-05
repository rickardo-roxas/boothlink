<?php require 'view/page-fragments/Header.php'?>
<link rel="stylesheet" href="<?php echo BASE_URL?>/public/css/vendor/orgselector.css">
<main>
    <div id="salesboard" class="container">
        <div class="grid-container">
            <div class="Item1">
                <div id="logo" class="website-logo">
                    <h1>booth<span style="color:#1EBDEF">link</span></h1>
                </div>
            </div>

            <div class="tagline">
                <div class="tagline-paragraph">
                    <p>Organization Selector</p>
                </div>
            </div>

            <div class="org-selector">
                <div class="org-container" id="button-container">
                    <?php foreach ($organizations as $organization): ?>
                        <a href="/cs-312_boothlink/select_org?org_id=<?= htmlspecialchars($organization['id']); ?>" class="button">
                        <?= htmlspecialchars($organization['name']); ?>
                        </a>
                    <?php endforeach; ?>
                    <div class="add-button" id="add-button">
                        <img src="<?php echo BASE_URL?>/assets/images/plus-button.png" alt="Add Organization">
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php require 'view/page-fragments/Footer.php'?>
