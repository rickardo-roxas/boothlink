<header>
<div class="logo">
        <a href="dashboard.html" target="_self" class="container">
            <img src="../../assets/icons/logo-black-outline.png" alt="BoothLink logo">
            <h1>booth<span class="sky-blue">link</span></h1>
        </a>
    </div>
    <nav>
        <ul>
            <li><a href="dashboard.html" target="_self" class="active">Home</a></li>
            <li><a href="" target="_self">Reservations</a></li>
            <li><a href="" target="_self">Products</a></li>
            <li><a href="" target="_self">Schedule</a></li>
            <li><a href="" target="_self">Sales</a></li>
        </ul>
    </nav>
    <div class="container">
        <button>Add New Listing</button>
        <ul class="profile">

           <!-- <li><img src="../../assets/images/placeholder.jpeg" alt="Organization picture"></li> /-->
            <!-- <li><p>Organization Name</p></li> /-->

            <li><img alt= "Organization picture" src= <?php echo $orgPhoto ?>  ></li>
            <li><p> <?php echo $orgName ?></p></li>
        </ul>
    </div>
</header>
