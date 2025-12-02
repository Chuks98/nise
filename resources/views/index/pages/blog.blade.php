<div class="page-nav no-margin row">
    <div class="container">
        <div class="row">
            <h2>Our Blog</h2>
            <ul>
                <li><a href="{{ url('/') }}"><i class="fas fa-home"></i> Home</a></li>
                <li><i class="fas fa-angle-double-right"></i> Blog</li>
            </ul>
        </div>
    </div>
</div>

<!--  ************************* Blog Starts Here ************************** -->
<div id="blog" class="blog">
    <div class="container">
        <div class="row" id="blogContainer">
            <!-- Dynamic blog posts will load here -->
        </div>

        <!-- Pagination Controls -->
        <div class="d-flex justify-content-center mt-4" id="paginationControls"></div>
    </div>
</div>

<!-- ######## Blog End ####### -->

<div class="banner">
    <h2>Enrol Your Child Now!</h2>
    <a href="{{ url('admission-form') }}" class="enroll-btn">Enrol Now</a>
</div>
